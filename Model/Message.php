<?php

class Message {
    private $messageID;
    private $datePosted;
    private $dateUpdated;
    private $messageBody;
    private $topicID;
    private $userID;

    function __construct($messageID = '', $datePosted = '', $dateUpdated = '', $messageBody = '', $topicID = '', $userID = '') {
    }
    
    public function ifFirstMessage(){
        if($this->getMessageID() == DataBase::getTopicFirstMessage($this->getTopicID())){
            return true;
        } else {
            return false;
        }
    }
    
    public function Add(){
        DataBase::addMessage($this);
    }
    
    public function Update(){
        DataBase::updateMessage($this);
    }
    
    public function getMessageID() {
        return $this->messageID;
    }

    public function getDatePosted() {
        return $this->datePosted;
    }

    public function getDateUpdated() {
        return $this->dateUpdated;
    }

    public function getMessageBody() {
        return $this->messageBody;
    }

    public function getTopicID() {
        return $this->topicID;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function setDatePosted($datePosted) {
        $this->datePosted = $datePosted;
    }

    public function setMessageBody($messageBody) {
        $this->messageBody = $messageBody;
    }

    public function setTopicID($topicID) {
        $this->topicID = $topicID;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }
}
