<?php include 'View/header.php'; ?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/tinymce.css">
        <link rel="stylesheet" type="text/css" href="styles/newsStyle.css">
    </head>
    <body>
        <div id="content">
            <?php foreach ($newses as $news): ?>
                <div class="news">
                    <p class="newsHeader">
                        News:<span class="title"><?php echo $news['newsTitle'] ?></span><span class="newsDate"><?php echo gmdate("Y-m-d H:i:s", $news['datePosted']); ?></span>
                    </p>
                    <p class="newsHeaderAuthor">
                        Written by: <a href="forum.php?user=<?php echo $news['userID'] ?>"><span class="newsAuthor"><?php echo $news['username'] ?></span></a>
                    </p>
                    <div>
                        <?php echo $news['newsBody'] ?>
                    </div>
                </div>
            <?php endforeach; ?>
            <div>
            <a href="rss_aviation.php" id="rss_aviation" onclick="document.location = this.id + '.php'; return false;" >
                <img width="18" vspace="0" hspace="7" height="17" align="left" name="" alt="Aviation RSS" src="images/rss-feed-icon.jpg" class="thumbnails" />RSS
            </a>
            </div>
            <div class="spacer" style="clear: both;"></div>
        </div>
    </body>
</html>
<?php include 'View/footer.php' ?>


