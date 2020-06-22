//按左边的按键搜索
//按照城市搜索 (得到的参数是城市的具体名)
function selectByCity(cityName){
    var expTime = new Date().getTime() + 10*60*1000;
    document.cookie = "cityName="+ cityName +"; expires="+expTime+"; path=/pj2/";
    document.cookie = "searchType=city; expires="+expTime+"; path=/pj2/";
    //cookie传过去城市的名字
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            document.getElementById('demoPics').innerHTML = xmlhttp.responseText;
        }
    };
    xmlhttp.open("GET","/pj2/php/browserAJAX.php",true);
    xmlhttp.send();
}

//按照内容类型搜索
function selectByCategory(category){
    var expTime = new Date().getTime() + 10*60*1000;
    document.cookie = "category="+ category +"; expires="+expTime+"; path=/pj2/";
    document.cookie = "searchType=category; expires="+expTime+"; path=/pj2/";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
            document.getElementById('demoPics').innerHTML=xmlhttp.responseText;
            outPutPage();
            changePageByNum(1);
        }
    };
    xmlhttp.open("GET","/pj2/php/browserAJAX.php",true);
    xmlhttp.send();
}
//按照国家搜索
function selectByCountry(country){
    //console.log(country);
    var expTime = new Date().getTime() + 10*60*1000;
    document.cookie = "country="+ country +"; expires="+expTime+"; path=/pj2/";
    document.cookie = "searchType=country; expires="+expTime+"; path=/pj2/";
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange=function(){
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200)
        {
          document.getElementById('demoPics').innerHTML = xmlhttp.responseText;
          outPutPage();
          changePageByNum(1);
        }
    };
    xmlhttp.open("GET","/pj2/php/browserAJAX.php",true);
    xmlhttp.send();
}

function setPicCookie(picId){
   // console.log(picId);
    var expTime = new Date().getTime() + 10*60*1000;
    document.cookie = "picId=" + picId +"; expires=" + expTime+"; path= /pj2/";
    var src = $("img","#"+picId).attr("src");
    //console.log(src);
    document.cookie = "picSrc=" + src +"; expires=" + expTime + "; path = /pj2/";
    window.location.href = "http://localhost:63342/pj2/src/picDetail.php";
}


//二级联动搜索
$(function () {
    var url = '../php/level2AJAX.php';
    $('#goSearch').click(function () {
        $('#SearchInput').val('');
        if($("#currentcountry").val() !== "--国家--" )
            var country = $("#currentcountry").val();
        else
            country = 0;
        if ($("#city").val() !== "--城市--" && $("#city").val() !== "请选择城市")
        var city = $("#city").val();
        else
            city = 0;
        if($('#picContent').val()!=='内容')
            var content = $('#picContent').val();
        else
            content = 0;
 $.ajax({
            type: 'post',
            url:url,
            data:{
                countryCode: country,
                city:city,
                content:content
            },
            dataType: 'text',
            success:function (data) {
                if(country == 0 && city == 0 && content == 0 ) {
                    data = "<script>alert(\"至少选择点什么吧\")</script>";
                    document.getElementById("demoPics").innerHTML = data;
                }
                else
                    document.getElementById("demoPics").innerHTML = data;
            }
        });
        outPutPage();
    })
});


//ajax的二级联动
$(function(){
    //初始化数据
    var url ='../php/dbconnect.php'; //后台地址
    $("#currentcountry").change(function(){ //监听下拉列表的change事件
        var address = $(this).val(); //获取下拉列表选中的值
        //发送一个post请求
        $.ajax({
            type:'post',
            url:url,
            data:{key:address},
            dataType:'text',
            success:function(data){
                //请求成功回调函数
                var option = '<option>请选择城市</option>'; //默认值
                //console.log(data);
                if(data!=null) {
                    data1 = data.substring(2, data.length - 3);
                    var address = data1.split("\",\"");
                    for (var i = 0; i < address.length; i++) { //循环获取返回值，并组装成html代码
                        option += '<option>' + address[i] + '</option>';
                    }
                }
                $("#city").html(option); //js刷新第二个下拉框的值
            },
        });
    });
});
//根据搜索内容找
$(function (){
    var url = '../php/searchByInput.php';
    $('#Search').click(function () {
        var searchInput = $('#SearchInput').val();
        $.ajax({
            type:'get',
            url:url,
            data:{
                searchInput:searchInput,
                searchType :'Title'
            },
            dataType: 'text',
            success:function (data) {
                document.getElementById("demoPics").innerHTML = data;

                //console.log(searchInput)
            }
        });
        outPutPage();
    })
});

//页数



function outPutPage(){
    var tdNum = getCookie('numOfPic');
   // console.log(tdNum);
   // console.log(Math.ceil(tdNum/12));
    var output = "<li onclick='changePageByArrow(-1)' class='leftward'><a href=\"#\">&laquo;</a></li>";
    for (var i = 0 ; i < Math.ceil(tdNum/12) ; i++){
        var j = i+1;
        output += "<li id='li"+j+"' onclick='changePageByNum("+j+")'><a href=\"#\">"+j+"</a></li>";
    }
    output +=  "<li onclick='changePageByArrow(1)' class='rightward'><a href=\"#\">&raquo;</a></li>";

    document.getElementsByClassName('pagination')[0].innerHTML = output;

}



function changePageByNum(pageNum){
    var page = pageNum;
    //console.log(page);
    var tds = document.getElementsByTagName('td');
    for(var i = 0 ; i < tds.length ; i++){
        var id = tds[i].id.substr(2)
        //console.log(id);
        if(!(id >= (page-1)*12 && id < page*12)){
            $("#No"+i).attr({'style':'display:none'});
        }
        else{
            $("#No"+i).attr({'style': ''});
        }

    }
    $('#demoPics').attr({
        'class' : 'p'+ page
    })
}
//
function changePageByArrow(step){
    var currentPage = $('#demoPics').attr('class').substr(1);
    var dest;
    if(currentPage == 1 && step == -1)
        dest = 1;
    else if(currentPage == Math.ceil(getCookie('numOfPic')/12) && step ==1)
        dest = currentPage;
    else
        dest = parseInt(currentPage) + step;
    changePageByNum(dest);
    $('#demoPics').attr({
        'class' : 'p'+ dest
    })

}



function getCookie(cookie_name) {
    var allcookies = document.cookie;
    //索引长度，开始索引的位置
    var cookie_pos = allcookies.indexOf(cookie_name);

    // 如果找到了索引，就代表cookie存在,否则不存在
    if (cookie_pos != -1) {
        // 把cookie_pos放在值的开始，只要给值加1即可
        //计算取cookie值得开始索引，加的1为“=”
        cookie_pos = cookie_pos + cookie_name.length + 1;
        //计算取cookie值得结束索引
        var cookie_end = allcookies.indexOf(";", cookie_pos);

        if (cookie_end == -1) {
            cookie_end = allcookies.length;

        }
        //得到想要的cookie的值
        var value = unescape(allcookies.substring(cookie_pos, cookie_end));
    }
    return value;
}


/*
<ul class="pagination">
<li><a href="#">&laquo;</a></li>
<li><a href="#">1</a></li>
<li><a href="#">2</a></li>
<li><a href="#">3</a></li>
<li><a href="#">4</a></li>
<li><a href="#">5</a></li>
<li><a href="#">&raquo;</a></li>
</ul>
*/














