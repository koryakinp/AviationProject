<?php include 'header.php'; ?>
<html>
    <head>
        <title>Plane Forum</title>
        <link rel="stylesheet" type="text/css" href="styles/formPages.css">
        <link rel="stylesheet" type="text/css" href="styles/contactsStyle.css">
    </head>
    <body>
        <div id="content">
            <form id="email_form" action="" method="post">
                <fieldset>
                    <legend>
                        <h2>Contact Form</h2>
                    </legend>
                    <table>
                        <tr>
                            <td>Username</td>
                            <td>
                                <input type="text" name="name" class="textbox" id="tb1" value="<?php preloadText('name') ?>" /> 
                                <span class="error"><?php echo $fields->getField('name')->getHTML(); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Email</td>
                            <td>
                                <input type="text" name="email" class="textbox" id="tb2" value="<?php preloadText('email') ?>"/>
                                <span class="error"><?php echo $fields->getField('email')->getHTML(); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>What is your message about</td>
                            <td>
                                <select name="problem" id="tb5" class="textbox"> 
                                    <option selected value="selected">[choose yours]</option>
                                    <option value="login">General feedback</option>
                                    <option value="password">Account issue</option>
                                    <option value="username">Commercial inquiry</option>
                                    <option value="topic">Complaint</option>
                                    <option value="Other">Other</option>
                                </select>
                                <span class="error"><?php echo $fields->getField('problem')->getHTML(); ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>What browser do you use</td>
                            <td>
                                <select name="browser" id="tb5" class="textbox">
                                    <option selected value="selected">[choose yours]</option>
                                    <option value="login">Safari</option>
                                    <option value="password">Chrome</option>
                                    <option value="username">Opera</option>
                                    <option value="topic">Mozilla Firefox</option>
                                    <option value="Other">Internet Explorer</option>
                                </select>
                                <span><?php echo $fields->getField('browser')->getHTML() ?></span>
                            </td>
                        </tr>
                        <tr>
                            <td>Are you a registered user</td>
                            <td>
                                <label><input type="radio" name="user" id="label1" value="Yes"/>Yes</label>
                                <label><input type="radio" name="user" id="label2" value="No" checked/>No</label>
                            </td>
                        </tr>
                        <tr>
                            <td>Message</td>
                            <td>
                                <textarea rows="7" cols="35" name="comments" id="textArea2" value="<?php preloadText('comments') ?>"></textarea>
                                <span><?php echo $fields->getField('comments')->getHTML(); ?></span>
                            </td>
                        </tr>
                    </table>
                    <p class="buttons">
                        <button type="submit" class="button" value="Send" name="Send_message">
                            <span class="buttonIcon"><i class="fa fa-envelope"></i></span>Send
                        </button>
                        <button type="submit" class="button" value="Clear" name="action">
                            <span class="buttonIcon"><i class="fa fa-eraser"></i></span>Clear
                        </button>
                    </p>
                </fieldset>
            </form>
            <div id="contact">
                <table>
                    <tr>
                        <td>
                            <h2>Offices</h2>
                            <p>205 Humber College Blvd.</p>
                            <p>Toronto, ON M9W 5L7</p>
                            <p>Phone Number: +1(647)111-1111</p>
                            <p>Email: <a href="mailto:aviaforum2015@gmail.com">aviaforum2015@gmail.com</a></p><br>
                            <h2>Staff</h2>
                            <p><a href="mailto:koryakinp@koryakinp.com">Koryakin Pavel</a></p>
                            <p><a href="mailto:rivadiva91@gmail.com:#">Julia Mikhaylova</a></p>
                            <p><a href="mailto:aashishvig89@gmail.com">Aashish Vig</a></p>
                        </td>
                        <td>
                            <div id = mappp>
                                <?php include 'auxiliary/maps.php'; ?>
                            </div>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </body>
</html>
<?php include 'footer.php' ?>

