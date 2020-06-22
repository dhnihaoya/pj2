//浏览bar的js

//点日间模式切换css（daytime.css)
$('#daytime').click(function () {
    var styleCss = $('#style');
    if( styleCss.attr("class") === "nighttime" ){
        styleCss.attr({
            "class" : "daytime",
            "href" : "../css/daytime.css"
        })
        $('#styleChanger').text("日间模式");
    }
});
//点夜间模式切换css（drecula.css)
$('#nighttime').click(function () {
    var styleCss = $('#style');
    if( styleCss.attr("class") === "daytime" ){
        styleCss.attr({
            "class" : "nighttime",
            "href" : "../css/drecula.css"
        })
    $('#styleChanger').text("夜间模式");
    }
});