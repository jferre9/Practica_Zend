<?php

class Application_Model_DbTable_Alumne extends Zend_Db_Table_Abstract {

    protected $_name = 'alumne';

    public function login($dni, $pass) {
        
        $select = $this->fetchRow($this->select()->where('dni = ?', $dni)->where('pass = ?',$pass));
//        $select = $this->fetchAll(
//                $this->select()->where('true')
//                );
        if ($select == NULL) return false;
        $usuari = array('id'=>$select->id,'dni'=>$select->dni,'nom'=>$select->nom);
        return $usuari;
    }

    public function insertarCSV($data) {
        $codi = md5(uniqid(rand(), true));
        
        $sql = "INSERT INTO alumne (dni,nom,mail,pass,codi) VALUES (:dni,:nom,:mail,:dni,:codi) "
                . "ON DUPLICATE KEY UPDATE nom = VALUES(nom), mail = VALUES(mail),pass = VALUES(pass)";

        $this->getAdapter()->query($sql, array(':dni' => $data[0], ':nom' => $data[1], ':mail' => $data[2],':codi'=>$codi));
    }

    public function getOrganitzadors($idFesta) {
        $select = $this->select()->from($this)->join('organitzador','organitzador.alumne_id = alumne.id')->where('organitzador.festa_id = ?',$idFesta)->setIntegrityCheck(false);
        return $this->fetchAll($select);
    }

    public function getParticipants($idFesta) {
        $select = $this->select()->from($this)->join(array('p'=>'participant'),'p.alumne_id = alumne.id')->where('p.festa_id = ?',$idFesta)->setIntegrityCheck(false);
        //echo $select->__toString();
        return $this->fetchAll($select);
    }

}
