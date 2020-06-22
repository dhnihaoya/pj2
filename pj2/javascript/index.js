
//没啥意思的内容，就是点一下之后密码框可见/不可见的变化
$('#demo').click(function () {
    var img = $('#demo');
    var input = $('#password');
    var currentInput = input.text();
    if(img.attr("class") === "input-group-addon glyphicon glyphicon-eye-close"){
        img.attr( {
            "class" : "input-group-addon glyphicon glyphicon-eye-open"
        });
        input.attr({
            "type" : "text" ,
            "value" : currentInput
        });
    }
    else {
        img.attr({
            "class" : "input-group-addon glyphicon glyphicon-eye-close"
        });
        input.attr({
            "type" : "password" ,
            "value" : currentInput
    });
    }
});



