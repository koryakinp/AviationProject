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
                        <h2>Profile</h2>
                    </legend>
                    <table>
                        <tr>
                            <td><label for="name">Name:</label></td>
                            <td>
                                <input type="text" name="name" id="name" class="textbox" value="<?php echo $user->getName() ?>">
                                <span class="error"><?php echo $fields->getField('name')->getHTML(); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="email">Email:</label></td>
                            <td>
                                <input type="email" name="email" class="textbox" id="email" value="<?php echo $user->getEmail() ?>">
                                <span class="error"><?php echo $fields->getField('email')->getHTML(); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="location">Location:</label></td>
                            <td>
                                <input type="text" name="location" class="textbox" id="location" value="<?php echo $user->getLocation() ?>">
                                <span class="error"><?php echo $fields->getField('location')->getHTML(); ?></span>
                            </td>
                        </tr> 
                        <tr>
                            <td><label for="password">Password:</label></td>
                            <td>
                                <input type="password" name="password" class="textbox" id="password">
                                <span class="error"><?php echo $fields->getField('password')->getHTML(); ?></span>
                            </td>
                        </tr>
                    </table>
                    <p class="buttons">
                        <button type="submit" class="button" value="ChangePassword" name="ChangePassword">
                            <span class="buttonIcon"><i class="fa fa-exchange"></i></span>Submit
                        </button>
                    </p>
                </fieldset> 
            </form>
        </div>
    </body>
</html>
<?php include 'View/footer.php' ?>