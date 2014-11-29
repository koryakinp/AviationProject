<?php include "View/header.php"; ?>
<html>
    <head>
        <script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>       
        <script type="text/javascript" src="minified/jquery.sceditor.bbcode.min.js"></script>
        <script type="text/javascript" src="js/sceditor.js"></script>
        <link rel="stylesheet" href="minified/themes/default.min.css" type="text/css" media="all" />
        <link rel="stylesheet" type="text/css" href="styles/newTopicStyle.css">       
        <link rel="stylesheet" type="text/css" href="styles/forumMain.css">
        <link rel="stylesheet" type="text/css" href="styles/sceditor.css">
    </head>
    <body>
        <div id="content">
            <div id="topicWrapper">
                <h1>Create new Topic</h1>
                <div id="topic">                                            
                    <p id='topicTitle'>Title <input type="text" id="title"></p>
                    <textarea class="textarea" rows=15 id="body" name="topicBody"></textarea>
                    <input type="hidden" id="categoryID" value="<?php echo $curCategory ?>">
                    <input type="hidden" id="userID" value="<?php echo 1; ?>">
                    <input type="hidden" id="action" value="newTopic">
                    <p id="buttons">
                        <button class="button" id="submitTopic">
                            <span class="buttonIcon"><i class="fa fa-plus"></i></span>Submit
                        </button>                           
                    </p>
                </div>
            </div>              
        </div>
    </body>
</html>
<?php include "View/footer.php" ?>