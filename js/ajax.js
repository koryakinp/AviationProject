$('#searchBtn').on('click', function() {
    var username = $("#username").val();
    var ud = $('#userDetails');
    var template = $('#template').html();
    $.ajax({
        url: 'auxiliary/ajax.php?q=' + username,
        dataType: 'json',
        type: 'GET',
        success: function(data) {
            ud.html('');
            ud.append(Mustache.to_html(template, data));
            
            $('#role').val(data.role);
            $('#status').val(data.status);
        },
        error: function() {
            ud.html('no records found');
        }
    });
});

$('body').on('click', '#submitManageUsers', function () {
    var ud = $('#userDetails');
    var data = {
        status: $('#status').val(),
        role: $('#role').val(),
        id: $('#userID').val()
    }  
    $.ajax({
        url: 'auxiliary/ajax.php',
        type: 'POST',
        data: data,      
        success: function(res) {
            ud.html('');
            ud.html(res);
        },
        error: function() {
            ud.html('no records found');
        }
    });
});


$('#rule').on('change', function() {
    $("#ruleTopic").val('Loading..');
    $("#ruleDescription").val('Loading..');
    var ruleID = $("#rule").val();
    $.ajax({
        url: 'auxiliary/ajax.php?rule=' + ruleID,
        dataType: 'json',
        type: 'GET',
        success: function(data) {
            $("#ruleTopic").val(data.ruleTopic);
            $("#ruleDescription").val(data.ruleContent);
            $("#ruleCategory").val(data.categoryID);
        }
    });
});

$('#ruleCategoryList').on('change', function() {
    $("#ruleCategoryName").val('Loading..');
    var ruleCategoryID = $("#ruleCategoryList").val();
    $.ajax({
        url: 'auxiliary/ajax.php?ruleCategory=' + ruleCategoryID,
        dataType: 'json',
        type: 'GET',
        success: function(data) {
            $("#ruleCategoryName").val(data.categoryName);
        }
    });
});

$('#category').on('change', function() {
    $("#catName").val('Loading..');
    $("#catDescription").val('Loading..');
    var categoryID = $("#category").val();
    $.ajax({
        url: 'auxiliary/ajax.php?category=' + categoryID,
        dataType: 'json',
        type: 'GET',
        success: function(data) {
            $("#catName").val(data.categoryName);
            $("#catDescription").val(data.categoryDescription);
            $("#rootcategory").val(data.rootCategoryID);
        }
    });
});