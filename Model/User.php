<?php

class User {
    private $username;
    private $passwordHash;
    private $registrationDate;
    private $lastActiveDate;
    private $email;
    private $role;
    private $sex;
    private $location;
    private $status;
    private $userID;
    private $salt;
    private $activation;
    private $name;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

        public function getSalt() {
        return $this->salt;
    }

    public function getActivation() {
        return $this->activation;
    }

    public function setSalt($salt) {
        $this->salt = $salt;
    }

    public function setActivation($activation) {
        $this->activation = $activation;
    }

    function __construct($username = '', $passwordHash = '', $registrationDate = '', $lastActiveDate = '', $email = '', $role = '', $sex = '', $location = '', $status = '', $userID = '', $activation = '', $salt = '', $name='') {
    }

    function Add() {
        return DataBase::addUser($this);
    }
    
    function Update(){
        return DataBase::updateUser($this);
    }   
    
    public function getStatus() {
        return $this->status;
    }

    public function setStatus($status) {
        if($status == 'active' || $status == 'banned' || $status == 'unverified')
        $this->status = $status;
    }

    public function getUserID() {
        return $this->userID;
    }  
    
    public function getUsername() {
        return $this->username;
    }

    public function getPasswordHash() {
        return $this->passwordHash;
    }
    
    public function getRegistrationDate() {
        return $this->registrationDate;
    }

    public function setRegistrationDate($registrationDate) {
        $this->registrationDate = $registrationDate;
    }
    public function getLastActiveDate() {
        return $this->lastActiveDate;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRole() {
        return $this->role;
    }

    public function getSex() {
        return $this->sex;
    }

    public function getLocation() {
        return $this->location;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setPasswordHash($passwordHash) {
        $this->passwordHash = $passwordHash;
    }

    public function setLastActiveDate($lastActiveDate) {
        $this->lastActiveDate = $lastActiveDate;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setRole($role) {
        if($role == 'user' || $role == 'administrator' || $role == 'moderator')
        $this->role = $role;
    }

    public function setSex($sex) {
        if($sex == 'male' || $sex == 'female')
        $this->sex = $sex;
    }

    public function setLocation($location) {
        $this->location = $location;
    }
    
    public function updateLastActive(){
        DataBase::updateLastActiveTime($this->userID);
    }
    
    public function to_json() {             
        return json_encode(array(
            'username' => $this->getUsername(),
            'passwordHash' => $this->getPasswordHash(),
            'registrationDate' => $this->getRegistrationDate(),
            'lastActiveDate' => $this->getLastActiveDate(),
            'email' => $this->getEmail(),
            'role' => $this->getRole(),
            'sex' => $this->getSex(),
            'location' => $this->getLocation(),
            'status' => $this->getStatus(),
            'userID' => $this->getUserID(),
            'salt' => $this->getSalt(),
            'activation' => $this->getActivation(),
            'name' => $this->getName(),         
        ));
    }
}