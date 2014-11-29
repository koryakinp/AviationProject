<?php include 'header.php' ?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/forumMain.css">
        <link rel="stylesheet" type="text/css" href="styles/rulepage.css">
    </head>
    <title>Forum Rules</title>
    <body>
        <div id="content">
            <ol type="I">
                <?php foreach ($categorylist as $category) : ?>
                    <li>
                        <a href="rules.php?category=<?php echo $category->getCategoryID() ?>"><?php echo $category->getCategoryName() ?></a>
                    </li>
                <?php endforeach; ?>
            </ol>
            <table>
                <?php foreach ($rulelist as $rule): ?>
                    <tr>
                        <td>
                            <h3><?php echo $rule['ruleTopic'] ?></h3>
                            <p> <?php echo $rule['ruleContent'] ?></p>
                        <td>
                    </tr>
                <?php endforeach; ?>
            </table>
        </div>
    </body>
</html>
<?php include 'footer.php' ?>

