<?php

class Application_Model_DbTable_Alumne extends Zend_Db_Table_Abstract {

    protected $_name = 'alumne';

    public function login($dni, $pass) {
        $select = $this->select()->where('dni = ?', $dni)->where('pass = ?',$pass);
    }
    
    public function insertar($data) {
        $this->insert($data);
    }

}
