<?php 

class Admin extends DB\SQL\Mapper{

    public function __construct(DB\SQL $db){
        parent::__construct($db,'admin'); //table name
    }

    public function all(){
        $this->load(); //load is from Mapper
        return $this->query;
    }

    public function getByName($username){
        $this->load(array('admin_username=?', $username));
        return $this->query;
    }
}