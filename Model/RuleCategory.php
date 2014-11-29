<?php
class RuleCategory {
    private $categoryID, $categoryName;
    
    function __construct($categoryID = '', $categoryName = '') {
    }

    public function Add(){
        return DataBase::addRuleCategory($this);
    }
    
    public function Update(){
        return DataBase::updateRuleCategory($this);
    }
    
    public function getCategoryID() {
        return $this->categoryID;
    }

    public function setCategoryID($categoryID) {
        $this->categoryID = $categoryID;
    }
    
    public function getCategoryName() {
        return $this->categoryName;
    }
    
    public function setCategoryName($categoryName) {
        $this->categoryName = $categoryName;
    }
    
    public function to_json() {             
        return json_encode(array(
            'categoryID' => $this->getCategoryID(),
            'categoryName' => $this->getCategoryName()
        ));
    }
}
?>

