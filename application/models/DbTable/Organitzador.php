<?php

class Application_Model_DbTable_Organitzador extends Zend_Db_Table_Abstract
{

    protected $_name = 'organitzador';
    protected $_primary = array('festa_id', 'alumne_id');
    
    
}

