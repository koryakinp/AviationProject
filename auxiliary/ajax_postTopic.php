<?php
require_once 'DataBase.php';
require_once '../Model/Topic.php';
require_once '../Model/Message.php';
require_once '../auxiliary/validator.php';
require_once '../auxiliary/fields.php';

$action = $_POST['action'];
$validate = new Validate();
$fields = $validate->getFields();

if($action == "newTopic"){
    $fields->addField('title');
    $fields->addField('body');    
    
    $validate->text('title', trim($_POST['title']), true, 5, 254);
    $validate->text('body', trim($_POST['body']), true, 1, '');
    if (!$fields->hasErrors()) {
        $newTopic = new Topic();
        $newTopic->setTitle($_POST['title']);
        $newTopic->setCategoryID($_POST['categoryID']);
        $newTopic->setUserID($_POST['userID']);
        $newTopicID = $newTopic->Add();

        $newMessage = new Message();
        $newMessage->setMessageBody($_POST['body']);
        $newMessage->setTopicID($newTopicID);
        $newMessage->setUserID($_POST['userID']);
        DataBase::addMessage($newMessage);
        
        header('Content-Type: application/json');      
        echo json_encode($newTopicID); 
    }
} else if($action == "new"){
    $fields->addField('body');
    
    $validate->text('body', trim($_POST['body']), true);
    if (!$fields->hasErrors()) {
        $message = new Message();
        $message->setMessageBody($_POST['body']);
        $message->setUserID($_POST['userID']);
        $message->setTopicID($_POST['topicID']);
        $message->Add();
        header('Content-Type: application/json');      
        echo json_encode($message->getTopicID());
    }
} else {
    $fields->addField('body');
    $validate->text('body', trim($_POST['body']), true);
    if (!$fields->hasErrors()) {
        $message = DataBase::getMessage($_POST['messageID']);
        $message->setMessageBody($_POST['body']);
        $message->Update();
        header('Content-Type: application/json');      
        echo json_encode($message->getTopicID());
    }
}
