<?php
require_once 'Model/Session.php';
require_once 'auxiliary/fields.php';
require_once 'auxiliary/validator.php';
require_once 'Model/User.php';
include_once 'auxiliary/Database.php';
include_once 'auxiliary/Hash.php';
include_once 'auxiliary/valuesPreloader.php';
session_start();
$user = DataBase::getUser('userID', $_SESSION['userID']);
$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('password');
$fields->addField('newPassword');
$fields->addField('passwordAgain');
$fields->addField('error');

if (isset($_POST['Change'])) {
    $validate->text('password', trim($_POST['password']), true, 5, 254);
    $validate->text('newPassword', trim($_POST['newPassword']), true, 5, 254);
    $validate->text('passwordAgain', trim($_POST['passwordAgain']), true, 5, 254);

    if (!$fields->hasErrors()) {
        $validate->ifPasswordCorrect('error', $_SESSION['userID'], $_POST['password'], $_POST['newPassword'], $_POST['passwordAgain']);
        if (!$fields->hasErrors()) {
            $salt = Hash::salt(32);
            $user->setPasswordHash(HASH::make($_POST['newPassword'], $salt));
            $user->setSalt($salt);
            DataBase::updatePassword($user);
            session_destroy();
            header("location: login.php");
            exit();
        }
    }
}

if (isset($_POST['MainPage'])) {
    header("location: index.php");
    exit();
}

include 'View/changePasswordView.php';
