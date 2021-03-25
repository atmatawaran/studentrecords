<?php

class DashboardController extends Controller {

    function render(){
        $courses = new Course($this->db);
        $this->f3->set('courses', $courses->all());

        $this->f3->set('view', 'dashboard.htm');
        $template=new Template;
        echo $template->render('layout_admin.htm');
    }  
}