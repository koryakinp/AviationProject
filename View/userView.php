<?php include 'View/header.php'; ?>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="styles/forumMain.css">
        <link rel="stylesheet" type="text/css" href="styles/profile.css">
        <script src="jquery-1.10.2.js"></script>
    </head>
    <body>
        <div id="content">
            <div id="profileWrapper">
                <h1>User profile</h1>
                <div id="profile">                   
                    <div>
                        <div>
                            <h2><?php echo $profileViewData['username']; ?></h2>
                            <table id="userInfo">
                                <tr>
                                    <td rowspan="8"><?php if(glob("users/".$profileViewData['userID']."/*.{jpg,png,gif}", GLOB_BRACE)): ?>
                                            <img src="<?php echo glob("users/".$profileViewData['userID']."/*.{jpg,png,gif}", GLOB_BRACE)[0]?>" height="150" width="150" alt="avatar">
                                        <?php else: ?>
                                            <img src="images/avatar.png" height="150" width="150" alt="avatar">
                                        <?php endif;?>
                                    <td>
                                </tr>
                                <tr>
                                    <td colspan="2" class="userRole <?php echo $profileViewData['role'] == 'user' ? 'user' : 'admin' ?>"><?php echo $profileViewData['role'] ?></td>
                                </tr>
                                <tr>
                                    <td colspan="2"><?php Display::displayOnlineStatus($profileViewData['lastActiveDate']); ?></td>
                                </tr>                               
                                <tr>
                                    <td>Messages</td>
                                    <td id="messageCounter"><?php echo $profileViewData['messageCount']; ?></td>
                                </tr>
                                <tr>
                                    <td>Location</td>
                                    <td><?php echo $profileViewData['location']==''?'TBA':$profileViewData['location']; ?></td>
                                </tr>
                                <tr>
                                    <td>Sex</td>
                                    <td><?php echo $profileViewData['sex']==''?'TBA':$profileViewData['sex']; ?></td>
                                </tr>
                                <tr>
                                    <td>Last activity</td>
                                    <td><?php Display::diplayTimeDifference($profileViewData['lastActiveDate'], time()) ?></td>
                                </tr>
                                <tr>
                                    <td>Registration date</td>
                                    <td><?php echo gmdate("Y-m-d H:i:s", $profileViewData['registrationDate']); ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>              
        </div>       
    </body>
</html>
<?php include 'View/footer.php'; ?>