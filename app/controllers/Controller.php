<?php

// mother class
class Controller {
    protected $f3;
    protected $db;

    //session management
    function beforeroute(){
        if($this->f3->get('SESSION.student_username') == null && $this->f3->get('SESSION.admin_username') == null){
            $this->f3->reroute('/login');
            exit; // like break
        }
    }

    function afterroute(){
        // echo ' - after';
    }

    function __construct(){

        $f3=Base::instance();
        $this->f3 = $f3;

        $db=new DB\SQL(
            $f3->get('DB_NAME'),
            $f3->get('DB_USER'),
			$f3->get('DB_PASS'), 
            array(\PDO::ATTR_ERRMODE => \PDO::ERRMODE_EXCEPTION)
        );

        $this->db = $db;
    }

}

?>