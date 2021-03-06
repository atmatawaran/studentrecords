<?php

class CourseController extends Controller {

    function render(){

        // restrict this page to admin only
        if($this->f3->get('SESSION.student_id') != null) $this->f3->reroute('/');

        $courses = new Course($this->db);
        $this->f3->set('courses', $courses->all());

        $this->f3->set('view', 'dashboard_courses.htm');
        $template=new Template;
        echo $template->render('layout_admin.htm');
    }
    
    function crudCourses(){

        if($this->f3->get('POST.form') !== null){
            switch($this->f3->get('POST.form')){
                case "add": 

                    $code = $this->f3->get('POST.course_code');
                    $course = new Course($this->db);
                    $course->getByCode($code);

                    // check duplicate
                    if($course->course_code == $code){
                        echo "<script>console.log('Course already exists! " . $code . "' );</script>";
                    }
                    else{
                        echo "<script>console.log('New Course!');</script>";
                        $new_course = new Course($this->db);
                        $new_course->copyFrom('POST');
                        $new_course->save();
                        $new_course->reset();
                    }
                    
                    break; // "add" break
                
                case "delete": 

                    echo "<script>console.log('Deleting course...' );</script>";
                        
                    $course = new Course($this->db);
                    $course->delete($this->f3->get('POST.to_delete_course'));
                    $course->reset();

                    break; // "delete" break
                
                case "edit":

                    echo "<script>console.log('New Info: " . $this->f3->get('PARAMS.id') . "' );</script>";
                    
                    $course = new Course($this->db);
                    $course->edit($this->f3->get('PARAMS.id'));

                    $this->f3->reroute('/courses');
                    
                    break; // "edit" break
            }
        }

        $this->render();
    } 

    function renderUpdate(){
        // restrict this page to admin only
        if($this->f3->get('SESSION.student_id') != null) $this->f3->reroute('/');

        $id = $this->f3->get('PARAMS.id');

        $course = new Course($this->db);
        $course->getById($id);
        $course->copyTo('POST');

		$this->f3->set('view','course_update.htm');
		$template=new Template;
        echo $template->render('layout_admin.htm');
    }

}