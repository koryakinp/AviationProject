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
                        <h3>LogIn</h3>
                    </legend>
                    <table>
                        <tr>
                            <td><label for="username">Username:</label></td>
                            <td>
                                <input type="text" name="username" id="username" class="textbox" value="<?php preloadText('username')?>"> 
                                <span><?php echo $fields->getField('username')->getHTML() ?></span>
                            </td>
                        </tr>           
                        <tr>
                            <td><label for="password">Password:</label></td>
                            <td>
                                <input type="password" name="password" class="textbox" id="password" value="<?php preloadText('username')?>">
                                <span><?php echo $fields->getField('password')->getHTML() ?></span>
                                <span><?php echo $fields->getField('error')->getHTML() ?></span>
                            </td>
                        </tr>                                           
                    </table>
                    <p class="buttons">
                        <button type="submit" class="button" value="Login" name="Login">
                            <span class="buttonIcon"><i class="fa fa-key"></i></span>Login
                        </button>
                    </p>

                </fieldset> 
            </form>
        </div>
    </body>
</html>
<?php include 'View/footer.php' ?>
