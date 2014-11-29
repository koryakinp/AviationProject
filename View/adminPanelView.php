<?php include 'View/header.php'; ?>
<html>
    <head>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>       
        <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>
        <link rel="stylesheet" type="text/css" href ="styles/adminPanel_tabs.css">
        <link rel="stylesheet" type="text/css" href="styles/adminPanel.css">
        <link rel="stylesheet" type="text/css" href="styles/forumMain.css">
        <script type="text/javascript" src="minified/jquery.sceditor.bbcode.min.js"></script>
        <script type="text/javascript" src="js/sceditor.js"></script>
        <link rel="stylesheet" href="minified/themes/default.min.css" type="text/css" media="all" />
        <link rel="stylesheet" type="text/css" href="styles/sceditor.css">
    </head>
    <body>
        <script src="js/mustache.js" type="text/javascript"></script>
        <script>
            $(function() { $( "#tabs" ).tabs();});
        </script>
        <script id="template" type="text/template">
            <table>
            <tr>
            <td>Username</td>
            <td>{{username}}</td>
            </tr>
            <tr>
            <td>Email</td>
            <td>{{email}}</td>
            </tr>
            <tr>
            <td>Role</td>
            <td>
            <select id="role" name="role">
            <option value="user">User</option>
            <option value="moderator">Moderator</option>
            <option value="administrator">Administrator</option>
            </select>
            </td>
            </tr>
            <tr>
            <td>Status</td>
            <td>
            <select id="status" name="status">
            <option value="active">Active</option>
            <option value="banned">Banned</option>
            <option value="unverified">Unverified</option>
            </select>
            </td>
            </tr>
            </table>
            <input id="userID" type="hidden" name="userID" value="{{userID}}">
            <button id="submitManageUsers" class="button" type="button">
            <span class="buttonIcon"><i class="fa fa-check"></i></span>Submit
            </button>
        </script>
        <div id="content">
            <div id="adminPanelWrapper">
                <h1>Admin Panel</h1>
                <div id="adminPanel">
                    <div id="tabs">
                        <ul>
                            <li><a href="#tabs-1">Manage Categpries</a></li>
                            <li><a href="#tabs-2">Manage Users</a></li>
                            <li><a href="#tabs-3">Manage Rules</a></li>
                            <li><a href="#tabs-4">Add News</a></li>
                        </ul>
                        <div id="tabs-1">
                            <fieldset>
                                <legend><h3>Categories</h3></legend>
                                <form name="categories" action="" method="post">
                                    <table>
                                        <tr>
                                            <td>All Categories</td>
                                            <td colspan="2">
                                                <select name="category" id="category">
                                                    <?php foreach ($categories as $category): ?>
                                                        <option value="<?php echo $category->getCategoryID() ?>">
                                                            <?php echo $category->getCategoryName() ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>     
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Name</td>
                                            <td>
                                                <input type='text' name='catName' id="catName">
                                                <?php echo $fields->getField('catName')->getHTML(); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td>
                                                <input type='text' name='catDescription' id="catDescription">
                                                <?php echo $fields->getField('catDescription')->getHTML(); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Root Category</td>
                                            <td colspan="2">
                                                <select name="rootcategory" id="rootcategory">
                                                    <?php foreach ($categories as $category): ?>
                                                        <option value="<?php echo $category->getCategoryID() ?>">
                                                            <?php echo $category->getCategoryName() ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                    <option value="0">ROOT</option>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                    <?php if(isset($catRes)) echo $catRes; ?>
                                    <p class="buttons">
                                        <span class="leftButton">
                                            <button type="submit" class="button" value="submit" name="addCategory">
                                                <span class="buttonIcon"><i class="fa fa-plus"></i></span>Add
                                            </button>
                                        </span>
                                        <span class="rightButton">
                                            <button type="submit" class="button" value="submit" name="updateCategory">
                                                <span class="buttonIcon"><i class="fa fa-refresh"></i></span>Update
                                            </button>
                                        </span>
                                        <span class="rightButton">
                                            <button type="submit" class="button" value="submit" name="deleteCategory">
                                                <span class="buttonIcon"><i class="fa fa-trash"></i></span>Delete
                                            </button>
                                        </span>
                                    </p>
                                </form>
                            </fieldset>                                          
                        </div>
                        <div id="tabs-2">
                            <fieldset>
                                <legend><h3>Manage Users</h3></legend>                       
                                <div id="search">
                                    Enter username: 
                                    <input type="text" id="username">
                                    <button id="searchBtn" type="button" class="button">
                                        <span class="buttonIcon"><i class="fa fa-search"></i></span>Search
                                    </button>
                                </div>
                                <div id="userDetails">
                                </div>
                                <p><?php echo $resManageUsers; ?></p>
                            </fieldset>
                        </div>
                        <div id="tabs-3">
                            <fieldset>
                                <legend><h3>Rules</h3></legend>
                                <form name="rules" action="" method="post">
                                    <table>
                                        <tr>
                                            <td>All Rules</td>
                                            <td colspan="2">
                                                <select name="rule" id="rule">
                                                    <?php foreach ($allRules as $rule): ?>
                                                        <option value="<?php echo $rule->getRuleID() ?>">
                                                            <?php echo $rule->getRuleTopic() ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>     
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Rule</td>
                                            <td>
                                                <input type='text' name='ruleTopic' id="ruleTopic">
                                                <?php echo $fields->getField('ruleTopic')->getHTML(); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Description</td>
                                            <td>
                                                <input type='text' name='ruleDescription' id="ruleDescription">
                                                <?php echo $fields->getField('ruleDescription')->getHTML(); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Rule Category</td>
                                            <td colspan="2">
                                                <select name="ruleCategory" id="ruleCategory">
                                                    <?php foreach ($allRuleCategories as $ruleCategory): ?>
                                                        <option value="<?php echo $ruleCategory->getCategoryID() ?>">
                                                            <?php echo $ruleCategory->getCategoryName() ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                    <?php if(isset($ruleRes)) echo $ruleRes; ?>
                                    <p class="buttons">
                                        <span class="leftButton">
                                            <button type="submit" class="button" value="submit" name="addRule">
                                                <span class="buttonIcon"><i class="fa fa-plus"></i></span>Add
                                            </button>
                                        </span>
                                        <span class="rightButton">
                                            <button type="submit" class="button" value="submit" name="updateRule">
                                                <span class="buttonIcon"><i class="fa fa-refresh"></i></span>Update
                                            </button>
                                        </span>
                                        <span class="rightButton">
                                            <button type="submit" class="button" value="submit" name="deleteRule">
                                                <span class="buttonIcon"><i class="fa fa-trash"></i></span>Delete
                                            </button>
                                        </span>
                                    </p>
                                </form>
                            </fieldset>                          
                            <fieldset>
                                <legend><h3>Categories</h3></legend>
                                <form name="ruleCategories" action="" method="post">
                                    <table>                                           
                                        <tr>
                                            <td>All categories:</td>
                                            <td colspan="2">
                                                <select name="ruleCategory" id="ruleCategoryList">
                                                    <?php foreach ($allRuleCategories as $ruleCategory): ?>
                                                        <option value="<?php echo $ruleCategory->getCategoryID() ?>">
                                                            <?php echo $ruleCategory->getCategoryName() ?>
                                                        </option>
                                                    <?php endforeach; ?>
                                                </select>    
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>Category Name</td>
                                            <td>
                                                <input type='text' name='ruleCategoryName' id="ruleCategoryName">
                                                <?php echo $fields->getField('ruleCategoryName')->getHTML(); ?>
                                            </td>
                                        </tr>
                                    </table>
                                    <?php if(isset($ruleRes)) echo $ruleRes; ?>
                                    <p class="buttons">
                                        <span class="leftButton">
                                            <button type="submit" class="button" value="submit" name="addRuleCategory">
                                                <span class="buttonIcon"><i class="fa fa-plus"></i></span>Add
                                            </button>
                                        </span>
                                        <span class="rightButton">
                                            <button type="submit" class="button" value="submit" name="updateRuleCategory">
                                                <span class="buttonIcon"><i class="fa fa-refresh"></i></span>Update
                                            </button>
                                        </span>
                                        <span class="rightButton">
                                            <button type="submit" class="button" value="submit" name="deleteRuleCategory">
                                                <span class="buttonIcon"><i class="fa fa-trash"></i></span>Delete
                                            </button>
                                        </span>
                                    </p>
                                </form>
                            </fieldset>                          
                        </div>
                        <div id="tabs-4">
                            <a href="admin.php?addnews">add news</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/ajax.js"></script>
    </body>
</html>
<?php include 'View/footer.php'; ?>