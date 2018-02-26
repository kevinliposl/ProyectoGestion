<?php

class RSA {

    private static $instance;
    private $rsa;

    private function __construct() {
        set_include_path('../util/phpseclib/');
        include_once('Crypt/RSA.php');
        $this->rsa = new Crypt_RSA();
    }

    static function getInstance() {
        if (self::$instance == null) {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function keygen() {
        $this->rsa->setPrivateKeyFormat(CRYPT_RSA_PRIVATE_FORMAT_PKCS1);
        $this->rsa->setPublicKeyFormat(CRYPT_RSA_PUBLIC_FORMAT_PKCS1);
        $keys = $this->rsa->createKey(1024);

        return $keys;
    }

    function publicKeyToHex($privatekey) {
        $this->rsa->loadKey($privatekey);
        $raw = $this->rsa->getPublicKey(CRYPT_RSA_PUBLIC_FORMAT_RAW);

        return $raw['n']->toHex();
    }

    function decrypt($privatekey, $encrypted) {
        $encrypteds = pack('H*', $encrypted);
        $this->rsa->loadKey($privatekey);
        $this->rsa->setEncryptionMode(CRYPT_RSA_ENCRYPTION_PKCS1);

        return $this->rsa->decrypt($encrypteds);
    }

}
