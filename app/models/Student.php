<?php 

class Student extends DB\SQL\Mapper{

    public function __construct(DB\SQL $db){
        parent::__construct($db,'students'); //table name
    }

    public function all(){
        $this->load(); //load is from Mapper
        return $this->query;
    }

    public function getById($id){
        $this->load(array('student_id=?',$id));
        return $this->query;
    }

    public function getByName($username){
        $this->load(array('student_username=?', $username));
        return $this->query;
    }

    public function getByStudentNo($student_no){
        $this->load(array('student_no=?', $student_no));
        return $this->query;
    }

    public function add(){
        $this->copyFrom('POST'); //f3 will automatically map elements from POST to DB elements basta same key
        $this->save();
    }

    public function edit($id){
        $this->load(array('student_id=?',$id));
        $this->copyFrom('POST');
        $this->update();
    }

    public function delete($id){
        $this->load(array('student_id=?',$id));
        $this->erase();
    }
}