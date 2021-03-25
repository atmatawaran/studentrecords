<?php

class StudentController extends Controller {

    function displayStudentList(){
        $students = new Student($this->db);

        $this->f3->set('students', $students->all());
        $this->f3->set('view', 'student_page.htm');
        $template=new Template;
        echo $template->render('layout.htm');
    }
}