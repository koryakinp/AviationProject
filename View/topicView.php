<?php include 'View/header.php'; ?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/forumMain.css">
        <link rel="stylesheet" type="text/css" href="styles/topic.css">
    </head>
    <body>         
        <div id="content">
            <table class="forum">
                <tr class="tableHeaderRow">
                    <th colspan="2"></th>
                </tr>
                <?php if(isset($_SESSION['role']) && ($_SESSION['role']=='moderator' || $_SESSION['role']=='administrator')):?>
                <tr id="moderatorPanel">
                    <td colspan="2">
                        <fieldset>
                            <legend><h3>Moderator Panel</h3></legend>
                            <form name="moderatorPanel" action="" method="post">
                                <input type="hidden" name="topicID" value="<?php $curTopic ?>">
                                <table>
                                    <tr>
                                        <td>Status</td>
                                        <td>
                                            <select name="status">
                                                <option value="regular">Regular</option>
                                                <option value="pinned">Pinned</option>
                                                <option value="blocked">Blocked</option>
                                                <option value="deleted">Deleted</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td>
                                            <select name="categoryID">
                                                <?php foreach($categories as $category): ?>
                                                    <option value="<?php echo $category->getCategoryID()?>"><?php echo $category->getCategoryName()?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <?php ?>
                                        </td>
                                    </tr>                                   
                                </table>
                                <button type="submit" class="button" value="New Topic" name="submitModeratorPanel">
                                    <span class="buttonIcon"><i class="fa fa-exclamation"></i></span>Submit
                                </button>
                            </form>
                        </fieldset>
                    </td>
                </tr>
                <?php endif; ?>
                <?php
                $firstMessage = true;
                foreach ($topicViewData as $message):
                    ?>
                    <tr class="tableContentRow <?php echo $firstMessage ? 'first' : '' ?>">
                        <td colspan="2">
                            <table class="message">
                                <tr class="messageHeader" id="<?php echo 'mn' . $message['messageID'] ?>">
                                    <td><p><?php echo $message['username']; ?></p></td>
                                    <td>
                                    <?php echo $firstMessage ? $message['title'] : 'Re: ' . $message['title']; ?>
                                        <span class="messageDate"><?php echo $message['dateUpdated'] ?></span>
                                    </td>
                                </tr>
                                <tr class="messageBody">
                                    <td>
                                        <?php if(glob("users/".$message['userID']."/*.{jpg,png,gif}", GLOB_BRACE)): ?>
                                            <img src="<?php echo glob("users/".$message['userID']."/*.{jpg,png,gif}", GLOB_BRACE)[0]?>" height="150" width="150" alt="avatar">
                                        <?php else: ?>
                                            <img src="images/avatar.png" height="150" width="150" alt="avatar">
                                        <?php endif;?>
                                            
                                        <p><?php Display::displayOnlineStatus($message['lastActiveDate']) ?></p>
                                        <p class="userRole <?php echo $message['role'] == 'user' ? 'user' : 'admin' ?>"><?php echo $message['role'] ?></p>
                                        <p class="userMessageCounter">Messages: <span><?php echo $message['totalUserMessages'] ?></span></p>
                                    </td>
                                    <td>
                                        <p><?php echo $message['messageBody'] ?></p>
                                    </td>
                                </tr>
                                <tr class="messageFooter">
                                    <td></td>
                                    <td>
                                        <p>
                                            <a class="button" href="forum.php?user=<?php echo $message['userID']; ?>">
                                                <span class="buttonIcon"><i class="fa fa-user"></i></span>Profile
                                            </a>
                                            <?php if(isset($_SESSION['userID'])):?>
                                            <a class="button" href="forum.php?quote=<?php echo $message['messageID'] ?>">
                                                <span class="buttonIcon"><i class="fa fa-quote-right"></i></span>Quote
                                            </a>
                                            <?php if($_SESSION['userID']==$message['userID'] || $_SESSION['role'] == 'moderator' || $_SESSION['role'] == 'administrator'):?>
                                            <a class="button" href="forum.php?edit=<?php echo $message['messageID'] ?>">
                                                <span class="buttonIcon"><i class="fa fa-pencil-square-o"></i></span>Edit
                                            </a>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <?php if ($firstMessage) $firstMessage = false; ?>
                <?php endforeach; ?>
                <tr class="tableFooterRow">
                    <td>
                    <?php Display::displayPagination($messageCount, $curPage, 'href=forum.php?topic=' . $curTopic, MESSAGES_PER_PAGE); ?>
                    </td>
                    <td>
                        <?php if(isset($_SESSION['userID'])):?>
                        <a class="button" href="forum.php?reply=<?php echo $curTopic ?>">
                            <span class="buttonIcon"><i class="fa fa-reply"></i></span>Reply
                        </a>
                        <?php endif; ?>
                    </td>
                </tr>
            </table>
        </div>
    </body>
</html>
<?php include 'View/footer.php'; ?>