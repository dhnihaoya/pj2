//picNumber是网页上的图片id 即调用的数据库的imageID
function jumpToPicDetail( picNumber) {
    //定位，找到html的图片
    var pictureId = "pic" + picNumber;
    var pic = document.getElementById(pictureId);
    //调用src元素
    var prePicSrc = pic.src+"";
    //其实不确定这样对不对 但是square-medium好像有点小
    var picSrc = prePicSrc.replace("square-medium","medium");
    //操作cookie 用来后面在网页里调用
    var picId = picNumber;
    //作废时间定个十分钟就好反正也没啥用
    var expTime = new Date().getTime() + 10*60*1000;
    document.cookie = "picSrc="+ picSrc +"; expires="+expTime+"; path=/pj2/";
    document.cookie = "picId="+ picId +"; expires="+expTime+"; path=/pj2/";
    //显然 这一句是网页跳转
    window.location.href = "../pj2/src/picDetail.php";

}
