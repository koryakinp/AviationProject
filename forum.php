<?php
session_start();
include_once 'auxiliary/Database.php';
include_once 'auxiliary/Hash.php';
include_once 'auxiliary/Mail.php';
include_once 'auxiliary/Display.php';
include_once 'auxiliary/valuesPreloader.php';
include_once 'auxiliary/array_column.php';
include_once 'Model/Topic.php';
include_once 'Model/Message.php';
include_once 'Model/Category.php';
include_once 'Model/User.php';

if(isset($_SESSION['userID'])){
    $user = DataBase::getUser('userID', $_SESSION['userID']);
    DataBase::updateLastActiveTime($user->getUserID());
}

define("MESSAGES_PER_PAGE", 5);
define("TOPICS_PER_PAGE", 10);
 
if (isset($_POST['submitModeratorPanel'])) {
    $topic = DataBase::getTopic($_GET['topic']);
    $topic->setStatus($_POST['status']);
    $topic->setCategoryID($_POST['categoryID']);
    $topic->Update();
    header('Location: forum.php?category=' . $topic->getCategoryID() . '&page=1');
}

if (isset($_GET['category'])) {
    $curCategory = $_GET['category'];
    $curPage = $_GET['page'];
    $categoryViewData = DataBase::getCategoryViewData($curCategory, $curPage);
    include 'View/categoryView.php';
} else if (isset($_GET['topic'])) {
    $curPage = $_GET['page'];
    $curTopic = $_GET['topic'];
    $categories = DataBase::getCategories();
    $messageCount = DataBase::getPostsCount($curTopic)['postsCount'];
    $topicViewData = DataBase::getTopicViewData($curTopic, $curPage);
    include 'View/topicView.php';
} else if (isset($_GET['user'])) {
    $userID = $_GET['user'];
    $profileViewData = DataBase::getProfileViewData($userID);
    include 'View/userView.php';
} else if (isset($_GET['newtopic'])) {
    if(!isset($_SESSION['userID'])){
        header('Location: login.php');
        exit();
    }
    $curCategory = $_GET['newtopic'];
    include 'View/addTopicView.php';
} else if (isset($_GET['reply']) || isset($_GET['quote']) || isset($_GET['edit'])) {
    if(!isset($_SESSION['userID'])){
        header('Location: login.php');
        exit();
    }
    
    if (isset($_GET['edit']))
        $message = DataBase::getMessage($_GET['edit']);
    if (isset($_GET['quote']))
        $message = DataBase::getMessage($_GET['quote']);
    if (isset($_GET['reply']))
        $topicID = $_GET['reply'];
    include 'View/messageView.php';
} else {
    $forumViewData = DataBase::getForumViewData();
    $statistics = DataBase::getForumStatistics();
    include 'View/forumView.php';
}
