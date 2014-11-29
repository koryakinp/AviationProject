<?php
class Session {
    private $sessionID;
    private $userID;
    private $hash;
  
     function __construct($sessionID = '', $userID = '', $hash = '') {
    }
    public function getSessionID() {
        return $this->sessionID;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function getHash() {
        return $this->hash;
    }

    public function setSessionID($sessionID) {
        $this->sessionID = $sessionID;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    public function setHash($hash) {
        $this->hash = $hash;
    }


}
