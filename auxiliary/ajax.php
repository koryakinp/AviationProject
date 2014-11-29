<?php
require_once 'DataBase.php';
require_once '../Model/User.php';
require_once '../Model/Category.php';
require_once '../Model/Rule.php';
require_once '../Model/RuleCategory.php';

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

if(isset($_GET['q'])){
    $user = DataBase::getUser('username', $_GET['q']);
    if($user == null) exit();
    header('Content-Type: application/json');
    $json = $user->to_json();
    echo $json;
}

if(isset($_GET['rule'])){
    $rule = DataBase::getRule($_GET['rule']);
    if($rule == null) exit();
    header('Content-Type: application/json');
    $json = $rule->to_json();
    echo $json;
}

if(isset($_GET['ruleCategory'])){
    $ruleCategory = DataBase::getRuleCategory($_GET['ruleCategory']);
    if($ruleCategory == null) exit();
    header('Content-Type: application/json');
    $json = $ruleCategory->to_json();
    echo $json;
}

if(isset($_GET['category'])){
    $category = DataBase::getCategory('categoryID', $_GET['category']);
    if($category == null) exit();
    header('Content-Type: application/json');
    $json = $category->to_json();
    echo $json;
}

