<?php 

class UserController extends Controller{
    function render(){
        $template = new Template;
        echo $template->render('login.htm');
    }

    function beforeroute(){} 

    function authenticate(){
        $username = $this->f3->get('POST.username');
        $password = $this->f3->get('POST.password');

        if($this->f3->get('POST.login') !== null){
            echo "<script>console.log('user type: " . $this->f3->get('POST.login') . "' );</script>";
            echo "<script>console.log('username: " . $this->f3->get('POST.username') . "' );</script>";
            echo "<script>console.log('password: " . $this->f3->get('POST.password') . "' );</script>";

            switch($this->f3->get('POST.login')){
                case "admin": 

                    $admin = new Admin($this->db);
                    $admin->getByName($username);

                    if($admin->dry()){
                        $this->f3->reroute('/login');
                    }

                    if(password_verify($password, $admin->admin_password)) {
                        $this->f3->set('SESSION.admin_username', $admin->admin_username);
                        // echo "Password matched.";
                        $this->f3->reroute('/courses');
                        
                    } else {
                        // echo "Password did not match.";
                        $this->f3->reroute('/login');
                        
                    }
                    
                    break; // "admin" break

                case "student": 

                    $stud = new Student($this->db);
                    $stud->getByName($username);

                    if($stud->dry()) {
                        echo "User does not exist.";
                        $this->f3->reroute('/login');
                    }

                    if(password_verify($password, $stud->student_password)) {
                        $this->f3->set('SESSION.student_id', $stud->student_id);
                        $this->f3->set('SESSION.student_username', $stud->student_username);
                        // echo "Password matched.";
                        $this->f3->reroute('/');
                        
                    } else {
                        // echo "Password did not match.";
                        $this->f3->reroute('/login');
                        
                    }
                    
                    break; // "student" break
            }
        }

    }
}