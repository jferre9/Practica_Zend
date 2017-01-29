<?php

class LoginController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $form = new Zend_Form();
        $csv = new Zend_Form_Element_File('csv');
        $csv->setLabel("Importar dades en format csv:")
                ->addValidator('Count', false, 1)
                ->addValidator('Extension', false, 'csv')
                ->setRequired();
        
        $form->setAction('/login/importar');
        $form->setMethod('post');
        $form->addElement($csv);
    }


}

