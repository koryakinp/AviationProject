<?php

session_start();
require_once 'auxiliary/fields.php';
require_once 'auxiliary/validator.php';
require_once 'Model/User.php';
include_once 'auxiliary/Database.php';
include_once 'auxiliary/Hash.php';
include_once 'auxiliary/valuesPreloader.php';

$user = DataBase::getUser('userID', $_SESSION['userID']);
$res = '';
$validate = new Validate();
$fields = $validate->getFields();

$fields->addField('email');
$fields->addField('password');
$fields->addField('location');
$fields->addField('name');
$fields->addField('password');
$fields->addField('newPassword');
$fields->addField('passwordAgain');
$fields->addField('error');

if (isset($_POST['saveProfile'])) {
    $validate->text('name', trim($_POST['name']), true, 2, 254);
    $validate->text('location', trim($_POST['location']), true, 2, 254);

    if (!$fields->hasErrors()) {
            $user->setName($_POST['name']);
            $user->setLocation($_POST['location']);
            $user->setSex($_POST['sex']);
            DataBase::updateDetails($user);
    }
}

if (isset($_POST['changePassword'])) {
    $validate->text('newPassword', trim($_POST['newPassword']), true, 5, 254);
    $validate->text('passwordAgain', trim($_POST['passwordAgain']), true, 5, 254);
    if (!$fields->hasErrors()) {
        $validate->ifPasswordCorrect('error', $_SESSION['userID'], $_POST['password'], $_POST['newPassword'], $_POST['passwordAgain']);
        if (!$fields->hasErrors()) {
            $user->setPasswordHash(HASH::make($_POST['newPassword'], $user->getSalt()));
            DataBase::updatePassword($user);
            session_destroy();
            header("location: login.php");
            exit();
        }
    }
}


if (isset($_POST['upload'])) {
    $target_dir = "users/".$user->getUserID()."/";
    $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
    $uploadOk = 1;
    $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            $res = "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            $res = "File is not an image.";
            $uploadOk = 0;
        }
    }
    
    $files = glob($target_dir."*");
    foreach($files as $file){ // iterate files
        unlink($file); // delete file
    }
// Check file size
    if ($_FILES["fileToUpload"]["size"] > 500000) {
        $res = "Sorry, your file is too large.";
        $uploadOk = 0;
    }
// Allow certain file formats
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $res = "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }
// Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        $res = "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
    } else {
        if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
            $res = "The file " . basename($_FILES["fileToUpload"]["name"]) . " has been uploaded.";
        } else {
            $res = "Sorry, there was an error uploading your file.";
        }
    }
}
include 'View/profileView.php';
