<?php include 'View/header.php'; ?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/formPages.css">
    </head>
    <body>
        <div id="content">
            <h1>Welcome back, <?php echo $user->getName() == '' ? 'User' : $user->getName(); ?>!</h1>
            <form action="" method="post">
                <fieldset>
                    <legend>
                        <h2>Profile</h2>
                    </legend>
                    <table>
                        <tr>
                            <td>Login</td>
                            <td>
                                <p><?php echo $user->getUsername() ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                <p><?php echo $user->getEmail() ?></p>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="name">Name:</label></td>
                            <td>
                                <input type="text" name="name" id="name" class="textbox" value="<?php echo $user->getName() ?>">
                                <span class="error"><?php echo $fields->getField('name')->getHTML(); ?></span>
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
                            <td><label for="sex">Sex:</label></td>
                            <td>
                        <lable for="male">male</lable>
                        <input <?php echo $user->getSex() == 'male' ? 'checked' : '' ?> type="radio" name="sex" id="male" value="male">
                        <lable for="female">female</lable>
                        <input <?php echo $user->getSex() == 'female' ? 'checked' : '' ?> type="radio" name="sex" id="female" value="female">
                        </td>
                        </tr>
                    </table>

                    <p class="buttons">
                        <button type="submit" class="button" value="saveProfile" name="saveProfile">
                            <span class="buttonIcon"><i class="fa fa-exchange"></i></span>Submit
                        </button>
                    </p>
                </fieldset> 
            </form>
            <form action="" method="post">
                <fieldset>
                    <legend>
                        <h2>Change Password</h2>
                    </legend>
                    <table>
                        <tr>
                            <td><label for="name">Current Password:</label></td>
                            <td>
                                <input type="password" name="password" id="password" class="textbox" value="<?php preloadText('password')?>">
                                <span class="error"><?php echo $fields->getField('error')->getHTML(); ?></span>
                                <span class="error"><?php echo $fields->getField('password')->getHTML(); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="newPassword">New Password:</label></td>
                            <td>
                                <input type="password" name="newPassword" class="textbox" id="newPassword" value="<?php preloadText('newPassword')?>">
                                <span><?php echo $fields->getField('newPassword')->getHTML(); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="passwordAgain">New Password Again:</label></td>
                            <td>
                                <input type="password" name="passwordAgain" class="textbox" id="passwordAgain" value="<?php preloadText('passwordAgain')?>">
                                <span><?php echo $fields->getField('passwordAgain')->getHTML(); ?></span>
                            </td>
                        </tr>
                    </table>
                    <p class="buttons">
                        <button type="submit" class="button" value="Change" name="changePassword">
                            <span class="buttonIcon"><i class="fa fa-exchange"></i></span>Submit
                        </button>
                    </p>
                </fieldset> 
            </form>
            <fieldset>
                <legend>
                    <h2>Upload Avatar</h2>
                </legend>
                <form action="" method="post" enctype="multipart/form-data">
                    Select image to upload:
                    <input type="file" name="fileToUpload" id="fileToUpload">
                    <p class="buttons">
                        <button type="submit" class="button" value="Upload Image" name="upload">
                            <span class="buttonIcon"><i class="fa fa-cloud-upload"></i></span>Submit
                        </button>
                    </p>
                </form>
                <p><?php echo $res; ?></p>
            </fieldset>
        </div>
    </body>
</html>
<?php include 'View/footer.php' ?>
