<?php

class LoginData {

    private $db;

    function __construct() {
        include_once 'SPDO.php';
        $this->db = SPDO::singleton();
    }

    function authenticate(Login $login) {

        $user = $this->studentLogin($login);

        if ($user != NULL) {
            return $user;
        } else {
            $user = $this->professorLogin($login);
            if ($user != NULL) {
                return $user;
            } else {
                $user = $this->administrativeLogin($login);
                if ($user != NULL) {
                    return $user;
                } else {
                    $user['Estado'] = 'Usuario invalido o inexistente';
                }
            }
        }

        return $user;
    }

    function recoverPassword(Login $login) {
        $query = $this->db->prepare("select ac.*, st.* from tbactor as ac, tbstudent as st where ac.actorid=st.studentid and st.studentpassword='" . $login->getLoginPassword() . "' and ac.actormail='" . $login->getLoginMail() . "';");
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();

        return$result;
    }

    function studentLogin(Login $login) {

        $query = $this->db->prepare("select ac.*, st.*, 'student' as type from tbactor as ac, tbstudent as st where ac.actorid=st.studentid and st.studentpassword='" . $login->getLoginPassword() . "' and ac.actormail='" . $login->getLoginMail() . "';");
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();

        return $result;
    }

    function professorLogin(Login $login) {
        $query = $this->db->prepare("select ac.*, pr.*, 'professor' as type from tbactor as ac, tbprofessor as pr where ac.actorid=pr.professorid and pr.professorpassword='" . $login->getLoginPassword() . "' and ac.actormail='" . $login->getLoginMail() . "';");
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();

        return $result;
    }

    function administrativeLogin(Login $login) {
        $query = $this->db->prepare("select ac.*, ad.*, 'administrative' as type from tbactor as ac, tbadministrative as ad where ac.actorid=ad.administrativeid and ad.administrativepassword='" . $login->getLoginPassword() . "' and ac.actormail='" . $login->getLoginMail() . "';");
        $query->execute();
        $result = $query->fetch();
        $query->closeCursor();

        return $result;
    }

}
