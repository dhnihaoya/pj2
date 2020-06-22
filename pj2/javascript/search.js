//标题搜索
$(function () {
    var url = "../php/search.php";
    $("#searchByTitle").change(function () {
        $('#searchByContent').val("");
        $.ajax({
            type : 'post',
            url : url,
            data :{
                type : "Title",
                content : $('#searchByTitle').val()
            },
            success:function (data) {
                document.getElementById('resultBar').innerHTML = data;
            }
        })
    })
});

$(function () {
    var url = "../php/search.php";
    $("#searchByContent").change(function () {
        $('#searchByTitle').val("");
        $.ajax({
            type : 'post',
            url : url,
            data :{
                type : "Content",
                content : $('#searchByContent').val()
            },
            success:function (data) {
                document.getElementById('resultBar').innerHTML = data;
            }
        })
    })
});

function jump(picId) {
    var id = picId;
    var src = $('img','#'+id).attr('src');
    var expTime = new Date().getTime() + 10*60*1000;
    document.cookie = "picId="+ id +"; expires="+expTime+"; path=/pj2/";
    document.cookie = "picSrc=" + src + "; expires=" + expTime + "; path=/pj2/";
    window.location.href = "../src/picDetail.php";




}