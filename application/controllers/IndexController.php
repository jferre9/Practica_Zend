<?php

class IndexController extends Zend_Controller_Action {

    private $sessio = null;

    public function init() {
        /* Initialize action controller here */
        $this->sessio = new Zend_Session_Namespace();
        if ($this->sessio->usuari == NULL)
            $this->redirect('login');
    }

    public function indexAction() {
        // action body
        $festa = new Application_Model_DbTable_Festa();
        $this->view->festes = $festa->getFestes($this->sessio->usuari["id"]);
        $this->view->festesPropies = $festa->getFestesAlumne($this->sessio->usuari["id"]);

        var_dump($this->view->festes);
    }

    public function detallsAction() {
        // action body
        $id = $this->sessio->usuari["id"];
        $idFesta = $this->_getParam('id');
    }

    public function apuntarAction() {
        $id = $this->sessio->usuari["id"];

        $idFesta = $this->_getParam('id');

        if ($idFesta !== NULL) {
            $festa = new Application_Model_DbTable_Festa();
            $festa->apuntar($id, $idFesta);
        }
        $this->redirect('');
    }

    function validateDate($date, $format = 'Y-m-d H:i') {
        $d = DateTime::createFromFormat($format, $date);
        return $d && $d->format($format) == $date;
    }

    public function crearAction() {

        $id = $this->sessio->usuari["id"];
        // action body
        $alumne = new Application_Model_DbTable_Alumne();
        $this->view->alumnes = $alumne->fetchAll(array('id != ?' => $this->sessio->usuari["id"]));

        if ($this->getRequest()->isPost()) {
            $organitzadors = $this->getParam('organitzadors');
            $dates = $this->getParam('data_naix');
            $data = $this->getParam('data');
            

            
            if ($dates != NULL && $data != NULL) {



                if (!$this->validateDate($data)) {
                    echo "Data $data no valida2";
                    //error data no valida
                    return;
                }

                if (!isset($dates[$id])) {
                    //el propi usuari no es organitzador
                    return;
                }
                foreach ($dates as $key => $value) {
                    if (!$this->validateDate($value, "Y-m-d")) {
                        echo "Data $value no valida";
                        //data no valida
                        return;
                    }
                }
                $festa = new Application_Model_DbTable_Festa();
                $festa->crear($dates,$data);
                $this->redirect('');
            } else {
                if ($organitzadors == NULL) {
                    $organitzadors = array($id);
                } else {
                    $organitzadors[] = $id;
                }
                $organitzadors2 = array();
                $error = false;
                for ($i = 0; $i < count($organitzadors); $i++) {
                    $o = $alumne->find($organitzadors[$i])->current();
                    if ($o == NULL) {
                        $error = true;
                        break;
                    }
                    $organitzadors2[] = $o;
                }
                if (!$error)
                    $this->view->organitzadors = $organitzadors2;
            }
        }
    }

    public function desapuntarAction() {
        // action body
        $id = $this->sessio->usuari["id"];

        $idFesta = $this->_getParam('id');

        if ($idFesta == NULL) {
            $this->redirect('');
        }
        $participant = new Application_Model_DbTable_Participant();
        $participant->desapuntar($id, $idFesta);
    }

}
