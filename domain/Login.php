<?php

class Login {

    //Attributes
    private $loginMail;
    private $loginPassword;

    function __construct() {
        ;
    }

    function getLoginMail() {
        return $this->loginMail;
    }//end getLoginMail()

    function getLoginPassword() {
        return $this->loginPassword;
    }//end getLoginPassword()

    function setLoginMail($loginMail) {
        $this->loginMail = $loginMail;
    }//end setLoginMail($loginMail)

    function setLoginPassword($loginPassword) {
        $this->loginPassword = $loginPassword;
    }//end setLoginPassword($loginPassword)



//End class Career
}
