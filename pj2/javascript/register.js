//切换输入是否可见（偷懒
$('#demo').click(function () {
    var img = $('#demo');
    var anotherImg = $('#anotherDemo');
    var input = $('#password');
    var anotherInput = $("#anotherPassword");
    //如果是不显示的状态
    if(img.attr("class") === "input-group-addon glyphicon glyphicon-eye-close"){
        img.attr( {
            "class" : "input-group-addon glyphicon glyphicon-eye-open"
        });
        anotherImg.attr({
            "class" : "input-group-addon glyphicon glyphicon-eye-open"
        });
        input.attr({
            "type" : "text" ,
        });
        anotherInput.attr({
            "type" :"text",
        })
    }
    //如果是显示的状态
    else {
        img.attr({
            "class" : "input-group-addon glyphicon glyphicon-eye-close"
        });
        anotherImg.attr({
            "class" : "input-group-addon glyphicon glyphicon-eye-close"
        });
        input.attr({
            "type" : "password" ,
        });
        anotherInput.attr({
            "type" :"password",
        })
    }
});

//切换输入是否可见
$('#anotherDemo').click(function () {
    var img = $('#demo');
    var anotherImg = $('#anotherDemo');
    var input = $('#password');
    var anotherInput = $("#anotherPassword");
    //如果是不显示的状态
    if(img.attr("class") === "input-group-addon glyphicon glyphicon-eye-close"){
        img.attr( {
            "class" : "input-group-addon glyphicon glyphicon-eye-open"
        });
        anotherImg.attr({
            "class" : "input-group-addon glyphicon glyphicon-eye-open"
        });
        input.attr({
            "type" : "text" ,
        });
        anotherInput.attr({
            "type" :"text",
        })
    }
    //如果是显示的状态
    else {
        img.attr({
            "class" : "input-group-addon glyphicon glyphicon-eye-close"
        });
        anotherImg.attr({
            "class" : "input-group-addon glyphicon glyphicon-eye-close"
        });
        input.attr({
            "type" : "password" ,
        });
        anotherInput.attr({
            "type" :"password",
        })
    }
});
//检查输入
function checkInput(){
    var password = document.getElementById("password").value;
    var anotherPassword = document.getElementById("anotherPassword").value;
    //取得是mail的input框，不是字
    var mail = document.getElementById("email").value;
    var regOfMail = /^([a-zA-Z]|[0-9])(\w|\-)+@[a-zA-Z0-9]+\.([a-zA-Z]{2,4})+(\.([a-zA-Z]{2,4}))?$/;
    var alertOfPasswordNotSame = $()
    if(password !== anotherPassword) {
        window.alert("两次输入的密码不一致");
        document.getElementById("password").value = "";
        document.getElementById("anotherPassword").value = "";
        document.getElementById("anotherPassword").placeholder = "两次输入应该一致";
        document.getElementById("password").placeholder = "两次输入应该一致";
        $("#differentPassword").attr({
            "style" : "",
        })
    }
    if(password.length < 8){
        document.getElementById("password").value = "";
        document.getElementById("anotherPassword").value = "";
        document.getElementById("anotherPassword").placeholder = "密码至少8位";
        $("#shortPassword").attr({
            "style" : "",
        })
    }
    if(!regOfMail.test(mail)){
        document.getElementById("email").value = "";
        document.getElementById("email").placeholder = "请输入正确的邮箱";
        document.getElementById("email").style.border = '2px dotted red';
        $("#notAMail").attr({
            "style": "",
        })
    }
    return regOfMail.test(mail) && password === anotherPassword && password.length > 7;
}





