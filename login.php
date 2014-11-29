<?php

session_start();
require_once 'Model/Session.php';
require_once 'auxiliary/fields.php';
require_once 'auxiliary/validator.php';
require_once 'Model/User.php';
include_once 'auxiliary/Database.php';
include_once 'auxiliary/Hash.php';
include_once 'auxiliary/valuesPreloader.php';
include_once 'auxiliary/Mail.php';

$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('username');
$fields->addField('password');
$fields->addField('error');

if (isset($_POST['Login'])) {
    $validate->text('username', trim($_POST['username']), true);
    $validate->text('password', trim($_POST['password']), true);

    if (!$fields->hasErrors()) {
        $validate->ifUserisactive('error', trim($_POST['username']), trim($_POST['password']));
        if (!$fields->hasErrors()) {

            $user = DataBase::getUser('username', $_POST['username']);
            $user->setActivation(md5(time()));
            $user->Update();
            $_SESSION['userID'] = $user->getUserID();
            $_SESSION['username'] = $user->getUsername();
            $_SESSION['activation'] = $user->getActivation();
            $_SESSION['role'] = $user->getRole();
            
            header("location: index.php");
            exit();
        }
    }
}

include 'View/loginView.php';
