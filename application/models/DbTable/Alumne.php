<?php

class Application_Model_DbTable_Alumne extends Zend_Db_Table_Abstract {

    protected $_name = 'alumne';

    public function login($dni, $pass) {
        //$select = $this->select()->where('dni = ?', $dni);
//        $select = $this->fetchAll(
//                $this->select()->where('true')
//                );
        $select = $this->find(1);
        var_dump($select);
    }

    public function insertarCSV($data) {
        $sql = "INSERT INTO alumne (dni,nom,mail,pass) VALUES (:dni,:nom,:mail,:dni) "
                . "ON DUPLICATE KEY UPDATE nom = VALUES(nom), mail = VALUES(mail),pass = VALUES(pass)";

        $this->getAdapter()->query($sql, array(':dni' => $data[0], ':nom' => $data[1], ':mail' => $data[2]));
    }

}
