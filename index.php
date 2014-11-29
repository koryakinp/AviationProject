<?php
session_start();
include_once 'auxiliary/DataBase.php';
require_once 'Model/User.php';
include_once 'Model/News.php';
if(isset($_SESSION['userID'])){
    $user = DataBase::getUser('userID', $_SESSION['userID']);
}

$newses = DataBase::getNews();
include 'View/indexView.php';
?>

