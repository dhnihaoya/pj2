
//收藏发出去1
function favorThis() {
    $('.fi-heart','#favorThisPic').attr({
        "class" : "fi-x"
    });
    $('label','#favorThisPic').text("不再收藏此图");
    $('#favorThisPic').attr({
        "onclick" : "unFavorThis()",
        "id" : "unFavorThisPic",
    });
    var xmlhttp =new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            $('p','#favNum').text(xmlhttp.responseText);
        }
    };
    var expTime = new Date().getTime() + 10*60*1000;
    document.cookie = "q="+ 1 +"; expires="+expTime+"; path=/pj2/";
    xmlhttp.open("GET","/pj2/php/favNumAJAX.php",true);
    xmlhttp.send();

}

//取消收藏发送-1
function unFavorThis(){
    $('.fi-x','#unFavorThisPic').attr({
        "class" : "fi-heart"
    });
    $('label','#unFavorThisPic').text("收藏此图");
    $('#unFavorThisPic').attr({
        "onclick" : "favorThis()",
        "id" : "favorThisPic",
    });
    var xmlhttp =new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            $('p','#favNum').text(xmlhttp.responseText);
        }
    };
    var expTime = new Date().getTime() + 10*60*1000;
    document.cookie = "q="+ -1 +"; expires="+expTime+"; path=/pj2/";
    xmlhttp.open("GET","/pj2/php/favNumAJAX.php",true);
    xmlhttp.send();
}


