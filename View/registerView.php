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
                        <h3>Registration</h3>
                    </legend>
                    <table>
                        <tr>
                            <td><label for="username">Username</label></td>
                            <td>
                                <input type="text" name="username" id="username" class="textbox" value="<?php preloadText('username') ?>">
                                <span class="error"><?php echo $fields->getField('username')->getHTML(); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="email">Email</label></td>
                            <td>
                                <input type="email" name="email" class="textbox" id="email" value="<?php preloadText('email') ?>">
                                <span class="error"><?php echo $fields->getField('email')->getHTML(); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="password">Password</label></td>
                            <td>
                                <input type="password" name="password" class="textbox" value="<?php preloadText('password') ?>" id="password">
                                <span class="error"><?php echo $fields->getField('password')->getHTML(); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="confirmation">Confirmation</label></td>
                            <td>
                                <input type="password" name="confirmation" class="textbox" value="<?php preloadText('confirmation') ?>" id="confirmation">
                                <span><?php echo $fields->getField('confirmation')->getHTML(); ?></span>
                            </td>
                        </tr>
                    </table>
                    <p class="buttons">
                        <button type="submit" class="button" value="Register" name="Register">
                            <span class="buttonIcon"><i class="fa fa-key"></i></span>Register
                        </button>
                    </p>
                </fieldset> 
            </form>
        </div>
    </body>
</html>
<?php include 'View/footer.php' ?>



