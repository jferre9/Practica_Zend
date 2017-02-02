<?php

class Application_Model_DbTable_Participant extends Zend_Db_Table_Abstract
{

    protected $_name = 'participant';

    
    public function desapuntar($alumneId, $festaId) {
        $this->delete(array ('alumne_id = ?'=>$alumneId, 'festa_id = ?'=>$festaId));
    }

}

