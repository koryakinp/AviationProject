<?php include 'View/header.php'; ?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/category.css">
        <link rel="stylesheet" type="text/css" href="styles/forumMain.css">
    </head>
    <body>
        <div id="content">
        <table class="forum">
            <tr class="tableHeaderRow">
                <th>Title</th>
                <th>Author</th>  
                <th>Posts</th>  
                <th>Last Post</th>  
            </tr>   
            <?php foreach ($categoryViewData as $topic):?>
                <tr class="tableContentRow <?php echo $topic['status']=='pinned'?'pinned':''?>">
                    <td>
                        <p id="topicTitle">
                            <?php if($topic['status']=='pinned'):?>
                                <i class="fa fa-anchor"></i>
                            <?php endif; ?>
                            <?php if($topic['status']=='blocked'):?>
                                <i class="fa fa-lock"></i>
                            <?php endif; ?>
                            <a href=forum.php?topic=<?php echo $topic['topicID'] ?>&page=1><?php echo $topic['title'] ?></a>
                        </p>
                        <?php Display::displayPagination($topic['postsCount'], 0, 'href=forum.php?topic='.$topic['topicID'], MESSAGES_PER_PAGE); ?>
                    </td>
                    <td><a href=forum.php?user=<?php echo $topic['authorUserID'] ?>><?php echo $topic['authorUsername'] ?></a></td>
                    <td><?php echo $topic['postsCount'] ?></td>
                    <td>
                        <p><?php echo $topic['lastPostedDate'] ?></p>
                        <p><a href=forum.php?user=<?php echo $topic['lastPostUserID'] ?>><?php echo $topic['lastPostUsername'] ?></a></p>
                    </td>
                </tr>
            <?php endforeach; ?>
            <tr class="tableFooterRow">
                <td>
                    <?php Display::displayPagination(DataBase::getTopicsCount($curCategory)['topicsCount'], $curPage, 'href=forum.php?category='.$curCategory, TOPICS_PER_PAGE); ?>
                </td>
                <td colspan="3">
                    <?php if(isset($_SESSION['userID'])):?>
                    <a class="button" href="forum.php?newtopic=<?php echo $curCategory; ?>">
                        <span class="buttonIcon"><i class="fa fa-plus"></i></span>New topic
                    </a>
                    <?php endif; ?>
                </td>
            </tr>
        </table>
        </div>
    </body>
</html>

<?php include 'View/footer.php'; ?>

