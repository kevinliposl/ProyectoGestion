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
            $query = $this->db->prepare("SELECT '" . $var . "' type, ac.*,tb.* FROM tbactor ac INNER JOIN tb" . $var . " tb ON ac.actorid = tb." . $var . "id WHERE ac.actormail=:mail AND tb." . $var . "password=:pass;");
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
        $profile = array('student' => 'student', 'professor' => 'professor', 'administrative' => 'administrative', 'adm' => 'adm');
        foreach ($profile as $var) {
            $query = $this->db->prepare("SELECT '" . $var . "' type, tb." . $var . "password, ac.actormail FROM tbactor ac INNER JOIN tb" . $var . " tb ON ac.actorid = tb." . $var . "id WHERE ac.actormail=:mail;");
            $query->execute(array('mail' => $login->getLoginMail()));
            $result = $query->fetch();
            $query->closeCursor();
            if (isset($result['actormail'])) {
                break;
            }
        }
        return $result;
    }

//    function studentLogin(Login $login) {
//        $query = $this->db->prepare("select ac.*, st.*, 'student' as type from tbactor as ac, tbstudent as st where ac.actorid=st.studentid and st.studentpassword='" . $login->getLoginPassword() . "' and ac.actormail='" . $login->getLoginMail() . "';");
//        $query->execute();
//        $result = $query->fetch();
//        $query->closeCursor();
//
//        return $result;
//    }
//
//    function professorLogin(Login $login) {
//        $query = $this->db->prepare("select ac.*, pr.*, 'professor' as type from tbactor as ac, tbprofessor as pr where ac.actorid=pr.professorid and pr.professorpassword='" . $login->getLoginPassword() . "' and ac.actormail='" . $login->getLoginMail() . "';");
//        $query->execute();
//        $result = $query->fetch();
//        $query->closeCursor();
//
//        return $result;
//    }
//
//    function administrativeLogin(Login $login) {
//        $query = $this->db->prepare("select ac.*, ad.*, 'administrative' as type from tbactor as ac, tbadministrative as ad where ac.actorid=ad.administrativeid and ad.administrativepassword='" . $login->getLoginPassword() . "' and ac.actormail='" . $login->getLoginMail() . "';");
//        $query->execute();
//        $result = $query->fetch();
//        $query->closeCursor();
//
//        return $result;
//    }
//
//    function admLogin(Login $login) {
//        $query = $this->db->prepare("select ac.*, ad.*, 'adm' as type from tbactor as ac, tbadm as ad where ac.actorid=ad.adminid and ad.password='" . $login->getLoginPassword() . "' and ac.actormail='" . $login->getLoginMail() . "';");
//        $query->execute();
//        $result = $query->fetch();
//        $query->closeCursor();
//
//        return $result;
//    }
}
