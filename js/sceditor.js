$( document ).ready(function() {
    $("textarea").sceditor({
        style: "styles/sceditor.css",
        toolbar: "bold,italic,underline|quote"
    });
});

$('body').on('click', '#submitTopic', function () {
    var body = $("#body").sceditor("instance").val();
    var title = $("#title").val();
    var categoryID = $("#categoryID").val();
    var userID = $("#userID").val();
    var action = $("#action").val();
      
    var data = {       
        action: action,
        body: body,
        title: title,
        categoryID: categoryID,
        userID: userID
    }
    
    $.ajax({
        url: 'auxiliary/ajax_postTopic.php',
        type: 'POST',
        dataType: 'json',
        data: data,      
        success: function(res) {
            window.location.href="forum.php?topic="+res+"&page=1";
        },
        error: function() {
        }
    });
});

$('body').on('click', '#submitMessage', function () {
    var body = $("#body").sceditor("instance").val();
    var messageID = $("#messageID").val();
    var action = $("#action").val();
    var userID = $("#userID").val();
    var topicID = $("#topicID").val();
    
    var data = {       
        action: action,
        body: body,
        messageID: messageID,
        userID: userID,
        topicID: topicID
    }
    
    $.ajax({
        url: 'auxiliary/ajax_postTopic.php',
        type: 'POST',
        dataType: 'json',
        data: data,      
        success: function(res) {
            window.location.href="forum.php?topic="+res+"&page=1";
        },
        error: function() {
        }
    });
});