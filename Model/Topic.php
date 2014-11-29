<?php

class Topic {
    private $topicID;
    private $title;
    private $categoryID;
    private $userID;
    private $status;
    
    function __construct($topicID = '', $title = '', $categoryID = '', $userID = '', $status = '') {

    }
    
    public function Add(){
        return DataBase::addTopic($this);
    }
    
    public function Update(){
        DataBase::updateTopic($this);
    }
    
    public function getTopicID() {
        return $this->topicID;
    }

    public function getTitle() {
        return $this->title;
    }

    public function getCategoryID() {
        return $this->categoryID;
    }

    public function getUserID() {
        return $this->userID;
    }

    public function getStatus() {
        return $this->status;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setCategoryID($categoryID) {
        $this->categoryID = $categoryID;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

    public function setStatus($status) {
        if($status == 'regular' || $status == 'pinned' || $status == 'blocked' || $status == 'deleted') {
            $this->status = $status;
        }
    }
}
