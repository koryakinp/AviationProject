<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/navigation.css">
    </head>
    <body>
        <header>
            <div class="nav">
                <ul>
                    <?php if (isset($_SESSION['activation'])): ?>
                        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                        <li><a href="forum.php"></i>Forum</a></li>
                        <li><a href="rules.php"></i>Rules</a></li>
                        <li><a href="contacts.php">Contact</a></li>
                        <a href="logout.php" class="right"><i class="fa fa-sign-out"></i>LogOut</a>
                        <a href="profile.php" class="right"><i class="fa fa-gear"></i></a>
                        <?php if($_SESSION['role']=='administrator'):?>
                            <a href="admin.php" class="right"><i class="fa fa-bell-o"></i></a>
                        <?php endif; ?>
                    <?php else: ?>                        
                        <li><a href="index.php"><i class="fa fa-home"></i></a></li>
                        <li><a href="forum.php"></i>Forum</a></li>
                        <li><a href="rules.php"></i>Rules</a></li>
                        <li><a href="registration.php"></i>Register</a></li>
                        <li><a href="contacts.php">Contact</a></li>
                        <a href="login.php" class="right"><i class="fa fa-sign-in"></i>LogIn</a>                       
                    <?php endif; ?>
                </ul>
            </div>
        </header>
    </body>
</html>