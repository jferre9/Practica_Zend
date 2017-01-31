<?php

class LoginController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
    }

    private function getForm() {
        $form = new Zend_Form();
        $form->setAttrib('enctype', 'multipart/form-data');
        $csv = new Zend_Form_Element_File('csv');
        $csv->setLabel("Importar dades en format csv:")
                ->addValidator('Count', false, 1)
                ->addValidator('Extension', false, 'csv')
                ->setRequired()
                ->setDestination(sys_get_temp_dir());

        $form->setAction($this->view->baseUrl() . '/login/csv');
        $form->setMethod('post');
        $form->addElement($csv);

        $submit = new Zend_Form_Element_Submit('enviar');
        $submit->setLabel('Enviar');
        $form->addElement($submit);
        return $form;
    }

    public function indexAction() {

        $alumne = new Application_Model_DbTable_Alumne();
        $sessio = new Zend_Session_Namespace();

        if ($this->getRequest()->isPost()) {
            $dni = $this->getRequest()->getParam('dni');
            $pass  = $this->getRequest()->getParam('pass');
            
            if ($dni === "admin" && $pass === "admin") {
                
            } else {
                $dades = $alumne->login($dni, $pass);
                if ($dades) {
                    
                }
            }
        }
    }

    public function csvAction() {
        if (!$this->getRequest()->isPost()) {
            $this->redirect('/');
            return;
        }
        $form = $this->getForm();
        if (!$form->isValid($_POST)) {
            echo "no es valid";
        }
        if (!$form->csv->receive()) {
            print "Error receiving the file";
        }
        
        $alumne = new Application_Model_DbTable_Alumne();
        $location = $form->csv->getFileName();
        
        $myfile = fopen($location, "r");
        
        while (($data = fgetcsv($myfile)) != null) {
            $alumne->insertarCSV($data);
        }
        fclose($myfile);
        
        //$this->redirect("login");
    }

}
