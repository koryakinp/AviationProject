<?php

class Category {
    private $categoryID;
    private $categoryName;
    private $categoryDescription;
    private $rootCategoryID;
    
    function __construct($categoryID = '', $categoryName = '', $categoryDescription = '', $rootCategoryID = '') {

    }

    
    public function Add(){
        return DataBase::addCategory($this);
    }
    
    public function Delete(){
        return DataBase::deleteCategory($this);
    }
    
    public function Update(){
        return DataBase::updateCategory($this);
    }

    public function getRootCategoryID() {
        return $this->rootCategoryID;
    }
    
    public function setRootCategoryID($rootCategoryID) {
        $this->rootCategoryID = $rootCategoryID;
    }
    
    public function setCategoryName($categoryName) {
        return $this->categoryName = $categoryName;
    }
    
    public function setCategoryDescription($categoryDescription) {
        return $this->categoryDescription = $categoryDescription;
    }

    public function getCategoryID() {
        return $this->categoryID;
    }
    
    public function getCategoryName() {
        return $this->categoryName;
    }
    
    public function getCategoryDescription() {
        return $this->categoryDescription;
    }
    
    public function to_json() {             
        return json_encode(array(
            'categoryID' => $this->getCategoryID(),
            'categoryName' => $this->getCategoryName(),
            'categoryDescription' => $this->getCategoryDescription(),
            'rootCategoryID' => $this->getRootCategoryID()
        ));
    }
}
