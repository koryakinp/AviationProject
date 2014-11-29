<?php
session_start();
include_once 'auxiliary/Database.php';
include_once 'auxiliary/Hash.php';
include_once 'auxiliary/valuesPreloader.php';
require_once 'auxiliary/fields.php';
require_once 'auxiliary/validator.php';
include_once 'auxiliary/Mail.php';

$validate = new Validate();
$fields = $validate->getFields();
$fields->addField('name');
$fields->addField('email');
$fields->addField('comments');
$fields->addField('problem');
$fields->addField('browser');

if (isset($_POST['Send_message'])) {
    $validate->text('name', trim($_POST['name']), false, 5, 254);
    $validate->email('email', trim($_POST['email']), true);
    $validate->text('comments', trim($_POST['comments']), true, 5, 254);
    $validate->isDropSelected('problem', $_POST['problem'], 'selected', true);
    $validate->isDropSelected('browser', $_POST['browser'], 'selected', true);

    if (!$fields->hasErrors()) {
        $xml = simplexml_load_file("auxiliary/config.xml") or die("Error: Cannot create object");
        $address = $xml->email->address . '';
        $message = 'User ' . $_POST['name'] . ' with ' . $_POST['browser'] . ' has ' . $_POST['problem'] . ' problem. ' . $_POST['comments'];
        Mail::sendContactMail($message);
        include 'View/successEmailView.php';        
        exit();
    }
}

include 'View/contactsView.php';

