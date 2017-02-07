<?php

class LoginController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        //$this->sessio = new Zend_Session_Namespace();
    }

    public function indexAction()
    {
        
        

        $sessio = new Zend_Session_Namespace();
        $sessio->admin = NULL;
        $sessio->usuari = NULL;
        $alumne = new Application_Model_DbTable_Alumne();
//        var_dump($sessio->usuari);

        if ($this->getRequest()->isPost()) {
            $dni = $this->getRequest()->getParam('dni');
            $pass  = $this->getRequest()->getParam('pass');
            
            if ($dni === "admin" && $pass === "admin") {
                $sessio->admin = TRUE;
                $this->redirect('administrador');
            } else {
                $dades = $alumne->login($dni, $pass);
                if ($dades) {
//                    var_dump($dades);
                    $sessio->usuari = $dades;
                    $this->redirect('');
                }
            }
        }
    }

    public function apuntarAction()
    {
        $idAlumne = $this->getParam('id');
        $idFesta = $this->getParam('festa');
        $codi = $this->getParam('codi');
        
        if ($idAlumne == NULL || $idFesta == NULL || $codi == NULL) {
            $this->redirect('login');
        }
        $modelAlumne = new Application_Model_DbTable_Alumne();
        $alumne = $modelAlumne->find($idAlumne)->current();
        if ($alumne == NULL || $alumne->codi !== $codi) {
            $this->redirect('login');
        }
        
        $festa = new Application_Model_DbTable_Festa();
        if ($festa->find($idFesta)->current() == NULL) {
            $this->redirect('login');
        }
        
        //miro que no sigui un organitzador
        $organitzador = new Application_Model_DbTable_Organitzador();
        if ($organitzador->find($idFesta,$idAlumne)->current() !== NULL) {
            $this->redirect('login');
        }
        
        
        //si ja hi esta inscrit no fa res i el logueja
        $participant = new Application_Model_DbTable_Participant();
        if ($participant->find($idFesta,$idAlumne)->current() == NULL) {
            $participant->insert(array('festa_id'=>$idFesta,'alumne_id'=>$idAlumne));
        }
        
        $dades = $modelAlumne->login($alumne->dni, $alumne->pass);
        $sessio = new Zend_Session_Namespace();
        $sessio->usuari = $dades;
        $this->redirect('');
        
        
    }


}


