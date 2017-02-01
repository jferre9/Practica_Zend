<?php

class IndexController extends Zend_Controller_Action
{
    private $sessio;
    
    public function init()
    {
        /* Initialize action controller here */
        $this->sessio = new Zend_Session_Namespace();
        if ($this->sessio == NULL) $this->redirect ('login');
    }
    

    public function indexAction()
    {
        // action body
        
        
    }


}

