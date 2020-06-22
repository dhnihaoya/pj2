//点击图片页面跳转
function jump(picId){
    var expTime = new Date().getTime() + 10*60*1000;
    document.cookie = "picId="+ picId +"; expires="+expTime+"; path=/pj2/";
    const src = $('img','#'+picId).attr('src');
    document.cookie = "picSrc=" + src + "; expires=" + expTime + "; path=/pj2/";
    window.location.href = "../src/picDetail.php";
}

//
function unFavor(btnId){
    var btn = $("#"+btnId);
    var divId = btn.attr('id').substr(3);
    var favContentBar = $('#'+divId);
    //直接通过js让被取消收藏的图不再显示 避免前后台交换
    favContentBar.attr({
        "display" : "none"
    });
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            alert(xmlhttp.responseText);
        }
    };
    var expTime = new Date().getTime() + 60*1000;
    document.cookie = "picToUnFavID="+ divId +"; expires="+expTime+"; path=/pj2/";
    xmlhttp.open("GET","/pj2/php/unFavorAJAX.php",true);
    xmlhttp.send();

}
//根据页数选择展示内容 每页三张照片 并且按照照片内容输出页数
function demoPicByPageNum(){
    var picBars = document.getElementsByClassName("demoFavBar");
    var picNum = picBars.length;
    var pageNum = Math.ceil(picNum/3);
    var pageToDemo ;
    //不传入参数的话就默认显示第一页，传入参数就显示传入的数字
    if(arguments.length === 0)
        pageToDemo = 1;
    else
        pageToDemo = arguments[0];
    //预处理输出的列表
    var pageNumList = "";
    for(var i = 0 ; i < pageNum ; i++){
        var j = i + 1;
        pageNumList = pageNumList +
            "<li><a href='#' onclick='demoPicByPageNum("+j+")'>"+j+"</a></li>";
    }
    document.getElementsByClassName("pagination")[0].innerHTML = pageNumList;
    //不在范围内的导航和图片块改成不显示
    for(i = 0 ; i < picNum ; i++){
        j = i+1;
        if(!( j< (pageToDemo * 3 + 1) && (j>((pageToDemo-1)*3))&& j < picNum + 1)){
            picBars[i].setAttribute("style","display:none");
        }
        else {
            picBars[i].setAttribute("style","");
        }
    }

}
