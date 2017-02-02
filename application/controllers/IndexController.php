<?php

class IndexController extends Zend_Controller_Action
{

    private $sessio = null;

    public function init()
    {
        /* Initialize action controller here */
        $this->sessio = new Zend_Session_Namespace();
        if ($this->sessio->usuari == NULL) $this->redirect ('login');
    }

    public function indexAction()
    {
        // action body
        $festa = new Application_Model_DbTable_Festa();
        $this->view->festes = $festa->getFestes($this->sessio->usuari["id"]);
        $this->view->festesPropies = $festa->getFestesAlumne($this->sessio->usuari["id"]);
        
        
        
        
    }

    public function detallsAction()
    {
        // action body
        $id = $this->sessio->usuari["id"];
        $idFesta = $this->_getParam('id');
        
    }

    public function apuntarAction()
    {
        $id = $this->sessio->usuari["id"];
        
        $idFesta = $this->_getParam('id');
        // action body
    }


}





