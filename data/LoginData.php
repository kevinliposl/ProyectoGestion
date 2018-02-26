<?php

class LoginData {

    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    function authenticate(Login $login) {
        $profile = array('student' => 'student', 'professor' => 'professor', 'administrative' => 'administrative', 'admin' => 'admin');
        foreach ($profile as $var) {
            $query = $this->db->prepare("SELECT '" . $var . "' type, ac.*,tb.* FROM tbactor ac INNER JOIN tb" . $var . " tb ON ac.actorid = tb." . $var . "id WHERE ac.actormail=:mail AND tb." . $var . "password=:pass AND " . $var . "state=1;");
            $query->execute(array('mail' => $login->getLoginMail(), 'pass' => $login->getLoginPassword()));
            $result = $query->fetch();
            $query->closeCursor();
            if (isset($result['actormail'])) {
                break;
            }
        }
        return $result;
    }

    function recoverPassword(Login $login) {
        $profile = array('student' => 'student', 'professor' => 'professor', 'administrative' => 'administrative', 'admin' => 'admin');
        foreach ($profile as $var) {
            $query = $this->db->prepare("SELECT '" . $var . "' type, tb." . $var . "password, ac.actormail FROM tbactor ac INNER JOIN tb" . $var . " tb ON ac.actorid = tb." . $var . "id WHERE ac.actormail = :mail " . $var . "state=1;");
            $query->execute(array('mail' => $login->getLoginMail()));
            $result = $query->fetch();
            $query->closeCursor();
            if (isset($result['actormail'])) {
                break;
            }
        }
        return $result;
    }
}
