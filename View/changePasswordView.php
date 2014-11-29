<?php include 'View/header.php'; ?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/formPages.css">
    </head>
    <body>
        <div id="content">
            <form action="" method="post">
                <fieldset>
                    <legend>
                        <h2>Change Password</h2>
                    </legend>
                    <table>
                        <?php echo $fields->getField('error')->getHTML(); ?>
                        <tr>
                            <td><label for="name">Current Password:</label></td>
                            <td>
                                <input type="password" name="password" id="password" class="textbox"> 
                                <span class="error"><?php echo $fields->getField('password')->getHTML(); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="newPassword">New Password:</label></td>
                            <td>
                                <input type="password" name="newPassword" class="textbox" id="newPassword">
                                <span><?php echo $fields->getField('newPassword')->getHTML(); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="passwordAgain">New Password Again:</label></td>
                            <td>
                                <input type="password" name="passwordAgain" class="textbox" id="passwordAgain">
                                <span><?php echo $fields->getField('passwordAgain')->getHTML(); ?></span>
                            </td>
                        </tr>
                    </table>
                    <p class="buttons">
                        <button type="submit" class="button" value="Change" name="Change">
                            <span class="buttonIcon"><i class="fa fa-exchange"></i></span>Submit
                        </button>
                    </p>
                </fieldset> 
            </form>
        </div>
    </body>
</html>
<?php include 'View/footer.php' ?>
