<?php 

class Course extends DB\SQL\Mapper{

    public function __construct(DB\SQL $db){
        parent::__construct($db,'courses'); //table name
    }

    public function all(){
        $this->load(); //load is from Mapper
        return $this->query;
    }

    public function getById($id){
        $this->load(array('course_id=?',$id));
        return $this->query;
    }

    public function getByCode($code){
        $this->load(array('course_code=?', $code));
    }

    public function add(){
        $this->copyFrom('POST'); //f3 will automatically map elements from POST to DB elements basta same key
        $this->save();
    }

    public function edit($id){
        $this->load(array('course_id=?',$id));
        $this->copyFrom('POST');
        $this->update();
    }

    public function delete($id){
        $this->load(array('course_id=?',$id));
        $this->erase();
    }
}