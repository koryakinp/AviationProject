<?php
class Rule {
    private $ruleID;
    private $ruleTopic;
    private $ruleContent;
    private $categoryID;
     
    function __construct($ruleID = '', $ruleTopic = '', $ruleContent = '', $categoryID = '') {

    }
    
    public function Add(){
        return DataBase::addRule($this);
    }
    
    public function Update(){
        DataBase::updateRule($this);
    }
    public function getRuleID() {
        return $this->ruleID;
    }

    public function getRuleTopic() {
        return $this->ruleTopic;
    }

    public function getRuleContent() {
        return $this->ruleContent;
    }

    public function getCategoryID() {
        return $this->categoryID;
    }

    public function setRuleID($ruleID) {
        $this->ruleID = $ruleID;
    }

    public function setRuleTopic($ruleTopic) {
        $this->ruleTopic = $ruleTopic;
    }

    public function setRuleContent($ruleContent) {
        $this->ruleContent = $ruleContent;
    }

    public function setCategoryID($categoryID) {
        $this->categoryID = $categoryID;
    }
    
    public function to_json() {             
        return json_encode(array(
            'ruleID' => $this->getRuleID(),
            'ruleTopic' => $this->getRuleTopic(),
            'ruleContent' => $this->getRuleContent(),
            'categoryID' => $this->getCategoryID()
        ));
    }
}
?>

