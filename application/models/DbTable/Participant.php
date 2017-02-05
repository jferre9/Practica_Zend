<?php

class Application_Model_DbTable_Participant extends Zend_Db_Table_Abstract
{

    protected $_name = 'participant';
    protected $_primary = array('festa_id', 'alumne_id');
    
    public function desapuntar($alumneId, $festaId) {
        $this->delete(array ('alumne_id = ?'=>$alumneId, 'festa_id = ?'=>$festaId));
    }

}

