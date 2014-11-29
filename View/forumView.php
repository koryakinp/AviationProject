<?php include 'View/header.php'; ?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/forum.css">
        <link rel="stylesheet" type="text/css" href="styles/forumMain.css">
    </head>
    <body>
        <div id="content">
            <table class="forum">
                <tr class="tableHeaderRow">
                    <th>Category</th>
                    <th>Topics</th>  
                    <th>Messages</th>  
                    <th>Last Message</th>  
                </tr>
                <?php foreach ($forumViewData as $category): ?>
                    <?php if ($category['rootCategoryID'] == 0): ?>
                        <tr class="tableContentRow">
                            <td>
                                <h3><a href=forum.php?category=<?php echo $category['categoryID'] ?>&page=1><?php echo $category['categoryName'] ?></a></h3>
                                <p><?php echo $category['categoryDescription'] ?></p>
                                <p>
                                    <?php
                                    $firstRecordFlag = true;
                                    foreach ($forumViewData as $q) {
                                        if ($category['categoryID'] == $q['rootCategoryID']) {
                                            if ($firstRecordFlag == true) {
                                                echo 'Subcategories:';
                                                $firstRecordFlag = false;
                                            }
                                            echo ' <a href=forum.php?category=' . $q['categoryID'] . '&page=1>' . $q['categoryName'] . '</a>';
                                        }
                                    }
                                    ?>
                                </p>
                            </td>

                            <td><?php echo $category['topics'] != 0 ? $category['topics'] : 'No topics' ?></td>
                            <td><?php echo $category['messages'] != 0 ? $category['messages'] : 'No messages' ?></td>            

                            <td>
                                <?php
                                if ($category["lastPostDate"] != '') {
                                    echo '<p>' . $category["lastPostDate"] . '</p>';
                                    echo '<p><a href=forum.php?user=' . $category['lastPostUserID'] . '>' . $category['lastPostUsername'] . '</a></p>';
                                } else
                                    echo '-';
                                ?>
                            </td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
                <tr class="tableFooterRow">
                    <td colspan="4">
                        <?php echo '<p>Total users: ' . $statistics['countUsers'] . ' | Total topics: ' . $statistics['countTopics'] . ' | Total messages: ' . $statistics['countMessages'] . '</p>'; ?>
                    </td>
                </tr>   
            </table>
        </div>
    </body>
</html>
<?php include 'View/footer.php'; ?>