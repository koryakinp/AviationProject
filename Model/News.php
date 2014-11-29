<?php
class News {
    private $newsID;
    private $newsTitle;
    private $newsBody;
    private $userID;
    private $datePosted;
    public function getDatePosted() {
        return $this->datePosted;
    }

    public function setDatePosted($datePosted) {
        $this->datePosted = $datePosted;
    }

        public function getUserID() {
        return $this->userID;
    }

    public function setUserID($userID) {
        $this->userID = $userID;
    }

        
    function __construct($newsID = '', $newsTitle = '', $newsBody = '', $datePosted = '') {
    }

    public function getNewsID() {
        return $this->newsID;
    }

    public function getNewsTitle() {
        return $this->newsTitle;
    }

    public function getNewsBody() {
        return $this->newsBody;
    }

    public function setNewsID($newsID) {
        $this->newsID = $newsID;
    }

    public function setNewsTitle($newsTitle) {
        $this->newsTitle = $newsTitle;
    }

    public function setNewsBody($newsBody) {
        $this->newsBody = $newsBody;
    }

    public function Add(){
        DataBase::addNews($this);
    }
}
