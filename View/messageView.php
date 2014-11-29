<?php include "View/header.php"; ?>
<html>
    <head>
        <link rel="stylesheet" href="minified/themes/default.min.css" type="text/css" media="all" />
        <script type="text/javascript" src="minified/jquery.sceditor.bbcode.min.js"></script>
        <link rel="stylesheet" type="text/css" href="styles/sceditor.css">
        <script type="text/javascript" src="js/sceditor.js"></script>
        <link rel="stylesheet" type="text/css" href="styles/newMessageStyle.css">       
        <link rel="stylesheet" type="text/css" href="styles/forumMain.css">       
    </head>
    <body>
        <div id="content">
            <div id="topicWrapper">
                <h1>Post message</h1>
                <div id="topic">                                        
                    <textarea class="textarea" rows=15 id="body" name="messageBody">
                        <?php if (isset($_GET['quote'])): ?>
                                <blockquote><?php 
                                $initial = $message->getMessageBody();
                                $final = preg_replace('~>\\s+<~m', '><', $message->getMessageBody());
                                echo $final;                                        
                                        ?></blockquote>
                        <?php endif; ?>
                        <?php if (isset($_GET['edit'])): ?>
                            <?php echo $message->getMessageBody() ?>
                        <?php endif; ?>
                    </textarea>
                    <?php if (isset($_GET['edit'])): ?>
                        <input type="hidden" id="action" value="edit"/>
                        <input type="hidden" id="messageID" value="<?php echo $message->getMessageID()?>"/>                        
                    <?php endif; ?>                       
                    <?php if (isset($_GET['quote'])): ?>                           
                        <input type="hidden" id="action" value="new"/>
                        <input type="hidden" id="topicID" value="<?php echo $message->getTopicID()?>"/>
                        <!--Have to be overrwitten!!-->
                        <input type="hidden" id="userID" value="1"/>
                    <?php endif; ?>
                    <?php if (isset($_GET['reply'])): ?>
                        <input type="hidden" id="action" value="new"/>
                        <input type="hidden" id="topicID" value="<?php echo $topicID ?>"/>                       
                        <!--Have to be overrwitten!!-->
                        <input type="hidden" id="userID" value="1"/>
                    <?php endif; ?> 
                    <p id="buttons">
                        <button id="submitMessage" class="button">
                            <span class="buttonIcon"><i class="fa fa-plus"></i></span>Submit
                        </button>
                    </p>
                </div>
            </div>              
        </div>
    </body>
</html>
<?php include "View/footer.php" ?>