<?php

class MainController extends Controller {

    function render(){

        // restrict this page to student only
        if($this->f3->get('SESSION.admin_username') != null) $this->f3->reroute('/courses');

        echo "<script>console.log('SESSION.student_username: " . $this->f3->get('SESSION.student_username') . "' );</script>";

        // list of all courses in DB
        $courses = new Course($this->db);
        $this->f3->set('courses', $courses->all());
        
        // get current user
        $stud = new Student($this->db);
        $username = $this->f3->get('SESSION.student_username');
        $stud->getByName($username);
        $this->f3->set('current_user', $stud);

        // check student's status: enrolled or not
        if($stud->student_status == "enrolled"){
            $this->f3->set('status', "hidden");
            $this->f3->set('unenroll_status', "");
            $this->f3->set('title', "My Enrolled Courses:");

            $courses_enrolled = new CourseEnrolled($this->db);
            $courses_enrolled = $courses_enrolled->getByStudent($stud->student_id);

            $course = new Course($this->db);
            $final_enrolled = array();

            $total_units = 0;
            foreach($courses_enrolled as $c){
                $course->getById($c->course_id);
                $total_units += $course->course_units;
                array_push($final_enrolled, clone $course);
            }

            $this->f3->set('final_cart', $final_enrolled);
            $this->f3->set('total_units', $total_units);


        }
        else{ //cart
            $this->f3->set('status',"");
            $this->f3->set('unenroll_status', "hidden");
            $this->f3->set('title', "My Cart:");

            // student's courses in cart; only pair of ids not objects
            $courses_in_cart = new CourseInCart($this->db);
            $courses_in_cart = $courses_in_cart->getByStudent($stud->student_id);

            $course = new Course($this->db); 
            $final_cart = array(); // course objects

            $total_units = 0;
            foreach($courses_in_cart as $a){
                $course->getById($a->course_id);
                $total_units += $course->course_units;
                array_push($final_cart, clone $course);
            }

            $this->f3->set('final_cart', $final_cart);
            $this->f3->set('total_units', $total_units);
        }

        $this->f3->set('view', 'homepage.htm');
        $template=new Template;
        echo $template->render('layout.htm');
    }

    function addOrRemoveFromCart(){

        $user_id = $this->f3->get('SESSION.student_id');

        // student's enrolled courses; only pair of ids not objects
        $courses_in_cart = new CourseInCart($this->db);
        $courses_in_cart = $courses_in_cart->getByStudent($user_id);

        $total_units = 0;
        $course = new Course($this->db); 
        foreach($courses_in_cart as $a){
            $course->getById($a->course_id);
            $total_units += $course->course_units;
        }

        $student = new Student($this->db);
        $student->getById($user_id);

        if($this->f3->get('POST.form') !== null){
            switch($this->f3->get('POST.form')){
                case "add": 
                    // check for duplicates in cart
                    $flag = 0;
                    foreach($courses_in_cart as $co){
                        if($co->course_id == $this->f3->get('POST.added_course')){
                            $flag=1;
                            echo "<script>console.log('ERROR: Duplicate course in cart! ID = " . $co->course_id . "' );</script>";
                            break;
                        }
                    }

                    if($flag == 0){

                        // check if adding new subject will exceed student's allowable load
                        $checker = new Course($this->db);
                        $checker->getById($this->f3->get('POST.added_course'));

                        if(($total_units + $checker->course_units) > $student->student_max_units){
                            echo "<script>console.log('ERROR: Adding this course will exceed your allowable load' );</script>";
                        }
                        else{
                            $new_course = new CourseInCart($this->db);
                            $new_course->student_id = $user_id;
                            $new_course->course_id = $this->f3->get('POST.added_course');
                            $new_course->save();
                            echo "<script>console.log('Course successfully added to cart! ID = " . $new_course->course_id . "');</script>";
                        }
                    }

                    break; // "add" break

                case "remove": 
                    echo "<script>console.log('Course to be removed found! ID = " . $this->f3->get('POST.removed_course') . "');</script>";

                    $courses_in_cart = new CourseInCart($this->db);
                    $courses_in_cart->delete($user_id, $this->f3->get('POST.removed_course'));

                    break; // "remove" break

                case "enroll":
                    echo "<script>console.log('Enrolling.....');</script>";
                    $this->enrollCourses();
                    break; // "enroll" break

                case "unenroll":
                    echo "<script>console.log('Unenrolling.....');</script>";
                    $this->unenrollCourses();
                    break;
            }   
        }

        $this->render();
    }

    function enrollCourses(){
        // get current user
        $stud = new Student($this->db);
        $username = $this->f3->get('SESSION.student_username');
        $stud->getByName($username);

        // student's courses in cart; only pair of ids not objects
        $courses_in_cart = new CourseInCart($this->db);
        $courses_in_cart = $courses_in_cart->getByStudent($stud->student_id);

        $course = new Course($this->db); 
        $course_to_enroll = new CourseEnrolled($this->db);

        foreach($courses_in_cart as $c){
            $course->getById($c->course_id);    
            $course_to_enroll->student_id = $stud->student_id;
            $course_to_enroll->course_id = $course->course_id;
            $course_to_enroll->save();
            $course_to_enroll->reset();
        }

        // delete all courses in cart by student
        $to_delete=new CourseInCart($this->db);
        foreach($courses_in_cart as $co){
            $to_delete->deleteByStudent($stud->student_id);
        }

        // update student status
        $stud->student_status = "enrolled";
        $stud->save();

        $this->reduceSlotsEnrolled($courses_in_cart);
        
    }

    function reduceSlotsEnrolled($courses_in_cart){

        $all_courses = new Course($this->db);
        $all_courses->all();
        $course = new Course($this->db);
        
        foreach($courses_in_cart as $cart){
            $course->getById($cart->course_id);
            $course->course_max_students--;
            $course->save();
            $course->reset();
        }
    }

    function unenrollCourses(){
        $stud = new Student($this->db);
        $stud->getById($this->f3->get('SESSION.student_id'));

        $courses_enrolled = new CourseEnrolled($this->db);
        $courses_enrolled = $courses_enrolled->getByStudent($stud->student_id);
        
        // ibalik sa course cart
        foreach($courses_enrolled as $co){
            $new_course = new CourseInCart($this->db);
            $new_course->student_id = $stud->student_id;
            $new_course->course_id = $co->course_id;
            $new_course->save();
        }

        // delete sa student_course_enrolled
        $to_delete = new CourseEnrolled($this->db);
        foreach($courses_enrolled as $co){
            $to_delete->deleteByStudent($stud->student_id);
        }

        // update student status
        $stud->student_status = "not_enrolled";
        $stud->save();

        $this->bringbackSlots($courses_enrolled);
    }

    function bringbackSlots($courses_enrolled){
        // ibalik yung slots sa courses
        $course = new Course($this->db);
        $final_enrolled = array();

        foreach($courses_enrolled as $c){
            $course->getById($c->course_id);
            array_push($final_enrolled, clone $course);
        }
                    
        $to_add = new Course($this->db);
        foreach($final_enrolled as $final){
            $to_add->getById($final->course_id);
            $to_add->course_max_students++;
            $to_add->save();
            echo "<script>console.log('Matched! ID = " . $to_add->course_id . "');</script>";
        }
    }

}