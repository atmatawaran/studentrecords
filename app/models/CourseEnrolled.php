<?php 

class CourseEnrolled extends DB\SQL\Mapper{

    public function __construct(DB\SQL $db){
        parent::__construct($db,'student_course_enrolled'); //table name
    }

    public function all(){
        $this->load(); //load is from Mapper
        return $this->query;
    }

    public function getById($id){
        $this->load(array('s_c_e_id=?',$id));
        return $this->query;
    }

    public function getByStudent($id){
        $this->load(array('student_id=?', $id));
        return $this->query;
    }

    public function getByCourse($id){
        $this->load(array('course_id=?', $id));
        return $this->query;
    }

    public function add(){
        $this->copyFrom('POST'); //f3 will automatically map elements from POST to DB elements basta same key
        $this->save();
    }

    public function delete($student_id, $course_id){
        $this->load(array('student_id=? AND course_id=?', $student_id, $course_id));
        $this->erase();
    }
}