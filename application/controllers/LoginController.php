<?php

class LoginController extends Zend_Controller_Action {

    //public $sessio;
    
    public function init() {
        /* Initialize action controller here */
        //$this->sessio = new Zend_Session_Namespace();
    }

    

    public function indexAction() {
        
        

        $sessio = new Zend_Session_Namespace();
        Zend_Session::namespaceUnset('default');
        $alumne = new Application_Model_DbTable_Alumne();
        var_dump($sessio->usuari);

        if ($this->getRequest()->isPost()) {
            $dni = $this->getRequest()->getParam('dni');
            $pass  = $this->getRequest()->getParam('pass');
            
            if ($dni === "admin" && $pass === "admin") {
                $sessio->admin = TRUE;
                $this->redirect('administrador');
            } else {
                $dades = $alumne->login($dni, $pass);
                if ($dades) {
                    var_dump($dades);
                    $sessio->usuari = $dades;
                    $this->redirect('');
                }
            }
        }
    }

   
}
