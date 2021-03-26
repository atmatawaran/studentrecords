<?php

class StudentController extends Controller {

    function render(){
        $students = new Student($this->db);
        $this->f3->set('students', $students->all());

        $this->f3->set('view', 'dashboard_students.htm');
        $template=new Template;
        echo $template->render('layout_admin.htm');
    }

    function crudStudents(){
    
        if($this->f3->get('POST.form') !== null){
            switch($this->f3->get('POST.form')){
                case "add": 

                    $student_no = $this->f3->get('POST.student_no');
                    $student = new Student($this->db);
                    $student->getByStudentNo($student_no);

                    // check duplicate
                    if($student->student_no == $student_no){
                        echo "<script>console.log('Student already exists! " . $student_no . "' );</script>";
                    }
                    else{
                        echo "<script>console.log('New Student!');</script>";
                        $new_student = new Student($this->db);
                        $new_student->copyFrom('POST');
                        $new_student->student_status = "not_enrolled";
                        $new_student->student_password = password_hash($this->f3->get('POST.student_password'), PASSWORD_DEFAULT);
                        $new_student->save();
                        $new_student->reset();
                    }

                    break; // "add" break

                case "delete":
                    
                    echo "<script>console.log('Deleting student...' );</script>";
                    
                    $student = new Student($this->db);
                    $student->delete($this->f3->get('POST.to_delete_student'));
                    $student->reset();

                    break; // "delete" break

                case "edit":

                    echo "<script>console.log('Editing student...' );</script>";
                    break; // "edit" break
            }
        }

        $this->render();
    }
}