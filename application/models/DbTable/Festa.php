<?php

class Application_Model_DbTable_Festa extends Zend_Db_Table_Abstract {

    protected $_name = 'festa';

    public function getFestesAlumne($alumne_id) {
        $sql = $this->getAdapter()->prepare(
                "Select f.id, f.data, count(p.alumne_id) as participants
        FROM festa f 
        LEFT JOIN participant p on p.festa_id = f.id
        LEFT JOIN organitzador o on o.festa_id = f.id
        where o.alumne_id = ?
        GROUP BY f.id");

        $sql->execute(array($alumne_id));
        return $sql->fetchAll();
        //return Zend_Db_Table_Abstract::getDefaultAdapter()->fetchAll(Zend_Db_Table_Abstract::getDefaultAdapter()->query($sql));
    }

    public function getFestes($alumne_id) {
        $sql = $this->getAdapter()->prepare(
                "Select f.id, f.data, count(p.alumne_id) as participants,
        IFNULL ((select 1 from participant p2 where p2.festa_id = f.id AND p2.alumne_id = ?),'0') as apuntat
        FROM festa f 
        LEFT JOIN participant p on p.festa_id = f.id
        where ? NOT IN (
            SELECT o.alumne_id FROM organitzador o where o.festa_id = f.id
        )
        GROUP BY f.id");
        $sql->execute(array($alumne_id, $alumne_id));
        //var_dump($sql);
        return $sql->fetchAll();
    }

    public function apuntar($alumneId, $festaId) {
        if ($this->find($festaId)->count() == 0)
            return false;
        $sql = $this->getAdapter()->prepare("Select 1 FROM festa f "
                . "LEFT JOIN organitzador o on o.festa_id = f.id "
                . "LEFT join participant p on p.festa_id = f.id "
                . "WHERE f.id = ? AND (o.alumne_id = ? OR p.alumne_id = ?)");
        $sql->execute(array($festaId, $alumneId, $alumneId));

        if ($sql->fetch()) {
            echo "qweqwe";
            return false;
        }

        $participant = new Application_Model_DbTable_Participant();
        $participant->insert(array('alumne_id' => $alumneId, 'festa_id' => $festaId));
        return true;

//        $this->getAdapter()->query($sql)->fetch();
    }

    /**
     * 
     * @param array $dates array de id => data dels organitzadors
     */
    public function crear($dates, $dia) {
        //falta comprovar que no canviin la id amb f12
        $organitzador = new Application_Model_DbTable_Organitzador();
        $id = $this->insert(array('data' => $dia));

        foreach ($dates as $key => $value) {
            $organitzador->insert(array('festa_id' => $id, 'alumne_id' => $key, 'data_naix' => $value));
        }
    }

}
