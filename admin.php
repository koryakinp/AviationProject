<?php
session_start();
require_once 'auxiliary/fields.php';
require_once 'auxiliary/validator.php';
include_once 'auxiliary/Database.php';
include_once 'auxiliary/Display.php';
include_once 'auxiliary/valuesPreloader.php';
include_once 'auxiliary/array_column.php';
include_once 'Model/Category.php';
include_once 'Model/User.php';
include_once 'Model/Rule.php';
include_once 'Model/News.php';
include_once 'Model/RuleCategory.php';

if(isset($_SESSION['userID'])){
    $user = DataBase::getUser('userID', $_SESSION['userID']);
    if($user->getRole()!='administrator') 
    {
        session_destroy();
        header("location: login.php");
        exit();
    }
}
else {
    header("location: login.php");
    exit();
}

$validate = new Validate();
$fields = $validate->getFields();

$fields->addField('ruleTopic');
$fields->addField('ruleDescription');
$fields->addField('catName');
$fields->addField('catDescription');
$fields->addField('rootCategoryID');
$fields->addField('categoryID');
$fields->addField('ruleCategoryName');

$resAddCategory = '';
$resDeleteCategory = '';
$resManageUsers = '';

if (isset($_POST['addCategory'])) {
    $validate->text('catName', trim($_POST['catName']), true, 1, 100);
    $validate->validateCategoryToAdd('catName', trim($_POST['catName']));
    $validate->text('catDescription', trim($_POST['catDescription']), true, 1, 300);

    if (!$fields->hasErrors()) {
        $category = new Category();
        $category->setCategoryName($_POST['catName']);
        $category->setCategoryDescription($_POST['catDescription']);
        $category->setRootCategoryID($_POST['rootcategory']);
        if ($category->Add() == 1) {
            $catRes = '<span class="response">The category "' . $category->getCategoryName() . '" has been added.</span>';
        }
    }
}

if (isset($_POST['updateCategory'])) {
    $validate->text('catName', trim($_POST['catName']), true, 1, 100);
    $validate->validateCategoryToAdd('catName', trim($_POST['catName']));
    $validate->text('catDescription', trim($_POST['catDescription']), true, 1, 300);

    if (!$fields->hasErrors()) {
        $category = DataBase::getCategory('categoryID', $_POST['category']);
        $category->setCategoryName($_POST['catName']);
        $category->setCategoryDescription($_POST['catDescription']);
        $category->setRootCategoryID($_POST['rootcategory']);
        if ($category->Update() == 1) {
            $catRes = '<span class="response">The category "' . $category->getCategoryName() . '" has been updated.</span>';
        }
    }
}

if (isset($_POST['deleteCategory'])) {
    $category = DataBase::getCategory('categoryID', $_POST['category']);
    DataBase::deleteCategory($category->getCategoryID());
    $catRes= '<span class="response">The category "' . $category->getCategoryName() . '" has been deleted.</span>';
}




if (isset($_POST['submitDeleteCategory'])) {
    $validate->validateCategoryToDelete('categoryID', trim($_POST['categoryID']));

    if (!$fields->hasErrors()) {
        if (DataBase::deleteCategory($_POST['categoryID']) == 1) {
            $res = '<span class="response">The category has been deleted.</span>';
        }
    }
}

if (isset($_POST['submitManageUsers'])) {
    if (!$fields->hasErrors()) {
        $user = DataBase::getUser('userID', $_POST['userID']);
        $user->setStatus($_POST['status']);
        $user->setRole($_POST['role']);
        if ($user->Update() == true) {
            $userRes = '<span class="response">The user "' . $user->getUsername() . '" has been updated.</span>';
        }
    }
}

if(isset($_POST['addRule'])) {
    $validate->text('ruleTopic', $_POST['ruleTopic'], true, 1, 255);
    $validate->text('ruleDescription', $_POST['ruleDescription'], true, 1, 999);
    if(!$fields->hasErrors()){
        $rule = new Rule();
        $rule->setRuleContent($_POST['ruleDescription']);
        $rule->setRuleTopic($_POST['ruleTopic']);
        $rule->setCategoryID($_POST['ruleCategory']);
        $rule->Add();
    }
}

if(isset($_POST['deleteRule'])) {
    DataBase::deleteRule($_POST['rule']);
}

if(isset($_POST['updateRule'])) {
    $validate->text('ruleTopic', $_POST['ruleTopic'], true, 1, 255);
    $validate->text('ruleDescription', $_POST['ruleDescription'], true, 1, 999);
    if(!$fields->hasErrors()){
        $rule = DataBase::getRule($_POST['rule']);
        $rule->setRuleContent($_POST['ruleDescription']);
        $rule->setRuleTopic($_POST['ruleTopic']);
        $rule->setCategoryID($_POST['ruleCategory']);
        if( $rule->Update() == 1){
            $ruleRes = '<span class="response">The rule "' . $rule->getRuleTopic() . '" has been updated.</span>';
        }
    }   
}

if(isset($_POST['addRuleCategory'])) {
    $validate->text('ruleCategoryName', $_POST['ruleCategoryName'], true, 1, 255);
    if(!$fields->hasErrors()){
        $ruleCategory = new RuleCategory();
        $ruleCategory->setCategoryName($_POST['ruleCategoryName']);
        if($ruleCategory->Add() == 1){
            $ruleRes = '<span class="response">The rule "' . $rule->getRuleTopic() . '" has been added.</span>';
        }
    }
}

if(isset($_POST['deleteRuleCategory'])) {
    if(DataBase::deleteRuleCategory($_POST['ruleCategory']) == 1){
        $ruleRes = '<span class="response">The rule "' . $rule->getRuleTopic() . '" has been deleted.</span>';
    }
}

if(isset($_POST['updateRuleCategory'])) {
    $validate->text('ruleCategoryName', $_POST['ruleCategoryName'], true, 1, 255);
    if(!$fields->hasErrors()){
        $ruleCategory = DataBase::getRuleCategory($_POST['ruleCategory']);
        $ruleCategory->setCategoryName($_POST['ruleCategoryName']);
        $ruleCategory->Update();
    }
}

if(isset($_POST['submitNews'])){
    $news = new News();
    $news->setNewsBody($_POST['newsBody']);
    $news->setNewsTitle($_POST['newsTitle']);
    $news->setUserID($user->getUserID());
    $news->setDatePosted(time());
    $news->Add();
}

$categories = DataBase::getCategories();
$allRules = DataBase::getRules();
$allRuleCategories = DataBase::getRuleCategories();

if(isset($_GET['addnews'])){
    include 'View/addNewsView.php';
} else {
    include 'View/adminPanelView.php';
}