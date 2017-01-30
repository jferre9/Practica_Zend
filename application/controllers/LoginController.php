<?php

class LoginController extends Zend_Controller_Action
{
    
    public function init()
    {
        /* Initialize action controller here */
    }

    private function getForm()
    {
        $form = new Zend_Form();
        $csv = new Zend_Form_Element_File('csv');
        $csv->setLabel("Importar dades en format csv:")
                ->addValidator('Count', false, 1)
                ->addValidator('Extension', false, 'csv')
                ->setRequired();
        
        $form->setAction($this->view->baseUrl().'/login/csv');
        $form->setMethod('post');
        $form->addElement($csv);
        
        $submit = new Zend_Form_Element_Submit('enviar');
        $submit->setLabel('Enviar');
        $form->addElement($submit);
        return $form;
    }

    public function indexAction()
    {
        
        
        $this->view->form = $this->getForm();
        
        
    }

    public function csvAction()
    {
        if (!$this->getRequest()->isPost()) {
            $this->redirect('/');
            return;
        }
        $form = $this->getForm();
        if (!$form->isValid($_POST)) {
            echo "no es valid";
        }
        
    }


}



