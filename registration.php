<?php

session_start();
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
$fields->addField('email');
$fields->addField('password');
$fields->addField('confirmation');

if (isset($_POST['Register'])) {
    $validate->email('email', trim($_POST['email']), true);
    $validate->text('username', trim($_POST['username']), true, 5, 254);
    $validate->text('password', trim($_POST['password']), true, 5, 254);
    $validate->text('confirmation', trim($_POST['confirmation']), true, 5, 254);
    $validate->ifPasswordMatches('password', $_POST['password'], $_POST['confirmation']);
    $validate->ifPasswordMatches('confirmation', $_POST['password'], $_POST['confirmation']);
    if (!$fields->hasErrors()) {
        $validate->ifUsernameUnique('username', $_POST['username']);
        $validate->ifEmailUnique('email', $_POST['email']);
    }


    if (!$fields->hasErrors()) {
        $newUser = new User();
        $salt = Hash::salt(32);
        $newUser->setEmail($_POST['email']);
        $newUser->setPasswordHash(HASH::make($_POST['password'], $salt));
        $newUser->setUsername($_POST['username']);
        $newUser->setActivation(md5(time()));
        $newUser->setSalt($salt);
        $newUser->setRegistrationDate(time());
        $newUser->setLastActiveDate(time());
        if ($newUser->Add() != 0) {
            Mail::sendActivationMail($newUser->getEmail(), $newUser->getActivation());

            include 'View/successRegisterView.php';
            exit();
        }
    }
}

if (isset($_GET['activation'])) {
    $user2 = DataBase::getUser('activation', $_GET['activation']);
    if ($user2 != null) {
        $user2->setStatus('active');
        $user2->Update();
        mkdir("users/" . $user2->getUserID());
        include('View/activationView.php');
        exit();
    }
}
include 'View/registerView.php';

