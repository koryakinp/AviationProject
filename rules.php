<?php
session_start();
require_once 'Model/Rule.php';
require_once 'Model/RuleCategory.php';
include_once 'auxiliary/Database.php';

if (isset($_GET['category'])) {
    $rulelist = DataBase::getRulesByCategory($_GET['category']);
} else {
    $rulelist = DataBase::getRulesByCategory(1);
}

$categorylist = DataBase::getRuleCategories();

include('View/ruleView.php');
?>
