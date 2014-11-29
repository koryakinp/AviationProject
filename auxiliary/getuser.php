<?php
require_once 'DataBase.php';
require_once '../Model/User.php';

if(isset($_GET['q'])){
    $user = DataBase::getUser('username', $_GET['q']);
    if($user == null) exit();
    header('Content-Type: application/json');
    $json = $user->to_json();
    echo $json;
}

if(isset($_POST['id'])){
    $user = new User();
    $user = DataBase::getUser('userID', $_POST['id']);
    if($user == null) exit();
    $user->setRole($_POST['role']);
    $user->setStatus($_POST['status']);
    if($user->Update()==1){
        echo 'User "'.$user->getUsername().'" has been updated.';
    } else {
        echo 'Error occured while updating user "'.$user->getUsername().'".';
    }
}
