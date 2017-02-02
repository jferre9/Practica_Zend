<?php

class Application_Model_DbTable_Festa extends Zend_Db_Table_Abstract {

    protected $_name = 'festa';

    public function getFestesAlumne($alumne_id) {
        $sql = $this->getAdapter()->quoteInto(
                "Select f.id, f.data, count(p.alumne_id) as participants
        FROM festa f 
        JOIN participant p on p.festa_id = f.id
        JOIN organitzador o on o.festa_id = f.id
        where o.alumne_id = ?
        GROUP BY p.alumne_id", $alumne_id);

        //var_dump($sql);
        return $this->getAdapter()->query($sql)->fetchAll();
        //return Zend_Db_Table_Abstract::getDefaultAdapter()->fetchAll(Zend_Db_Table_Abstract::getDefaultAdapter()->query($sql));
    }

    public function getFestes($alumne_id) {
        $sql = $this->getAdapter()->quoteInto(
                "Select f.id, f.data, count(p.alumne_id) as participants,
        IFNULL ((select 1 from participant p2 where p2.festa_id = f.id AND p2.alumne_id = ?),'0') as apuntat
        FROM festa f 
        JOIN participant p on p.festa_id = f.id
        JOIN organitzador o on o.festa_id = f.id
        where o.alumne_id != ?
        GROUP BY p.alumne_id",  $alumne_id, $alumne_id);
        //var_dump($sql);
        return $this->getAdapter()->query($sql)->fetchAll();
    }

}
