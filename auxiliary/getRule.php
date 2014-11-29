<?php
require_once 'DataBase.php';
require_once '../Model/Rule.php';

if(isset($_GET['rule'])){
    $rule = DataBase::getRule($_GET['rule']);
    if($rule == null) exit();
    header('Content-Type: application/json');
    $json = $rule->to_json();
    echo $json;
}
