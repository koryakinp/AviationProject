<?php include 'View/header.php'; ?>
<html>
    <head>  
        <link rel="stylesheet" type="text/css" href ="styles/adminPanel_tabs.css">
        <link rel="stylesheet" type="text/css" href="styles/adminPanel.css">
        <link rel="stylesheet" type="text/css" href="styles/forumMain.css">
        <script type="text/javascript" src="minified/jquery.sceditor.bbcode.min.js"></script>
        <script type="text/javascript" src="js/sceditorNews.js"></script>
        <link rel="stylesheet" href="minified/themes/default.min.css" type="text/css" media="all" />
        <link rel="stylesheet" type="text/css" href="styles/sceditor.css">
    </head>
    <body>
        <div id="content">
            <div id="adminPanelWrapper">
                <h1>Admin Panel</h1>
                <div id="adminPanel">
                    <a href="admin.php">Admin Panel</a>
                    <form action="" method="post">
                    <div id="topic">                                            
                        <p id='topicTitle'>Title <input type="text" name="newsTitle" id="newsTitle"></p>
                        <textarea class="textarea" rows=15 id="newsBody" name="newsBody"></textarea>
                    </div>
                    <p class="buttons">
                        <span class="rightButton">
                            <button type="submit" class="button" value="submit" name="submitNews">
                                <span class="buttonIcon"><i class="fa fa-refresh"></i></span>Submit
                            </button>
                        </span>
                    </p>
                    </form>
                </div>
            </div>
        </div>
        <script src="js/ajax.js"></script>
    </body>
</html>
<?php include 'View/footer.php'; ?>