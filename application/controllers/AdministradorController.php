<?php

class AdministradorController extends Zend_Controller_Action {

    public function init() {
        /* Initialize action controller here */
        $sessio = new Zend_Session_Namespace();
        if (!isset($sessio->admin))
            $this->redirect('login');
    }

    //nomes ho utilitzo per validar
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
        // action body
        $alumne = new Application_Model_DbTable_Alumne();
        $this->view->alumnes = $alumne->fetchAll();
        if (!$this->getRequest()->isPost()) {

            $form = $this->getForm();
            if (!$form->isValid($_POST)) {
                echo "no es valid";
                return;
            }
            if (!$form->csv->receive()) {
                print "Error receiving the file";
                return;
            }

            $alumne = new Application_Model_DbTable_Alumne();
            $location = $form->csv->getFileName();

            $myfile = fopen($location, "r");

            while (($data = fgetcsv($myfile)) != null) {
                $alumne->insertarCSV($data);
            }
            fclose($myfile);
        }
    }

}
