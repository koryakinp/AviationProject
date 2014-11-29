<?php
require_once 'DataBase.php';
require_once '../Model/RuleCategory.php';

if(isset($_GET['ruleCategory'])){
    $user = DataBase::getRuleCategory($_GET['ruleCategory']);
    if($user == null) exit();
    header('Content-Type: application/json');
    $json = $user->to_json();
    echo $json;
}
