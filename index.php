<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">
        <title>iscar</title>
        <link rel="stylesheet" href="css/frozen.css">
        <link rel="stylesheet" href="iconfont/iconfont.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" href="http://tw-member.iscarmg.com/app/css/user.css" type="text/css">
        <script type="text/javascript">
          _atrk_opts = { atrk_acct:"1/G9i1aoZM00yu", domain:"iscarmg.com",dynamic: true};
          (function() { var as = document.createElement('script'); as.type = 'text/javascript'; as.async = true; as.src = "https://d31qbv1cthcecs.cloudfront.net/atrk.js"; var s = document.getElementsByTagName('script')[0];s.parentNode.insertBefore(as, s); })();
        </script>
        <noscript><img src="https://d5nxst8fruw4z.cloudfront.net/atrk.gif?account=1/G9i1aoZM00yu" style="display:none" height="1" width="1" alt="" /></noscript>
        <!-- End Alexa Certify Javascript -->
        <!--google analytics-->
        <!-- Global site tag (gtag.js) - Google Analytics -->
        <!-- Global site tag (gtag.js) - Google Analytics - 20180131 -->
        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-38808246-6"></script>
        <script>
          window.dataLayer = window.dataLayer || [];
          function gtag(){dataLayer.push(arguments);}
          gtag('js', new Date());

          gtag('config', 'UA-38808246-6');
        </script>
        <!-- <script>

          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
              (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-38808246-4', 'auto');
          ga('create', 'UA-38808246-6', 'auto');
          ga('send', 'pageview');
        </script> -->
            <!--end of google analytics-->
        <style>
            .ui-border{
                border: 0;
            }
        </style>
    </head>
    <body ontouchstart id="home">
    <div class="hot-key"></div>
        <header class="ui-header ui-header-positive ui-border-b" v-cloak>
            <i class="ui-icon-caidan"></i>
            <ul class="nav">
<!--            	<li id="a_car_brand" >{{language.推荐车款}}</li>-->
<!--                <li class="ui-border-t" id="a_news" >{{language.焦点新闻}}</li>-->
                <li class="ui-border-t"><a href="my_favorite.html">{{language.我的最爱}}</a></li>
<!--                <li class="ui-border-t language">-->
<!--                    <h3><span>{{language.切换语系}}</span><em class="ui-icon-xiayige red"></em></h3>-->
<!--                    <ul class="types">-->
<!--                        <li class="ui-border-t" id="language_2">{{language.台湾繁体}}</li>-->
<!--                        <li class="ui-border-t" id="language_3">{{language.简体中文}}</li>-->
<!--                        <li class="ui-border-t" id="language_1">{{language.香港繁体}}</li>-->
<!--                    </ul>-->
<!--                </li>-->
            </ul>
            <img :src="language.logo" class="ui-logo">
            <div class="ui-avatar-s iscar_member_icon  iscar_member_login"></div>
<!--            <div class="ui-avatar-s user_icon" from="CP"></div>-->
        </header>
<div style="background-color: #fff">
        <section class="ui-container" >
            <section id="slider">
                <div class="ui-slider">
                    <ul class="ui-slider-content" style="width: 300%">
                        <li v-for="item in brand.banner"><span :style="item.img_url"></span></li>
                    </ul>
                </div>
            </section>
            <!--轮播图-->

            <section id="tab">
                <div class="ui-tab">
                    <ul class="ui-tab-nav ui-border-b">
                        <li class="current ui-border-r" v-cloak>{{language.品牌}}</li>
                        <li class="ui-border-r" v-cloak>{{language.价格}}</li>
                        <li v-cloak>{{language.车型}}</li>
                    </ul>
                    <ul class="ui-tab-content" style="width:300%">
                        <li  class="ui-border current">
                            <ul class="ui-justify ui-whitespace pinpai">
                                <li class="brand" :class="$index <5 ? 'pinpai' :''"  v-for="item in brand.brand"  style="width: 20%">
                                    <div class="test-img">
                                        <img :src="item.brand_img?'/story/iscaradmin/'+item.brand_img:defaultImg" style="width: 95%;">
                                    </div>
                                    <!--<p>{{item.name}}</p>-->
                                </li>
<!--                                <li onclick="window.location.href='search_adv.html'"><div class="test-img"><img src="img/logo10.png"></div>-->
                                    <!--<p>更多</p>-->
<!--                                </li>-->
                            </ul>

                        </li>
                        <li  class="ui-border" style="height: 0px">
                            <ul class="price clearfix">
                                <li v-for="item in language.price" class="ui-border" id="{{item.id}}"><p>{{item.value}}</p></li>
                            </ul>
                        </li >
                        <li  class="ui-border" style="height: 0px">
                            <ul class="ui-justify ui-whitespace pinpai carbody">
                                <li class="ui-border" :class="$index <5 ? 'pinpai' :''"  v-for="item in brand.carbody" style="width: 20%">
                                    <div class="test-img">
                                        <img :src="item.cbt_img?'/story/iscaradmin/'+item.cbt_img:defaultImg" style="width: 95%;">
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </section>
            <!--快速筛选-->

       	    <section id="car_brand" v-if="content.length!=0" v-cloak>
            <center><img :src="language.model_img" class="title-big"></center>
                <ul class="ui-grid-halve tuijian">
                    <template v-for="item in content">
                        <li v-if="$index%2==0" class="magin_r ui-border" v-on:click="cardetail($index)">
                            <div class="ui-grid-halve-img">
                                <span><img :src="item.car_img?'/story/iscaradmin/'+item.car_img:defaultImg"></span>
                            </div>
                            <div class="ui-nowrap-flex_add ui-whitespace name">
                                {{item.brand_name}}<br>{{item.model_name}}<br>{{item.style_name}}
                            </div>
                            <div class="ui-nowrap-flex_add ui-whitespace money magin_b"><span class="red">{{
                                    car_price(item.car_price)}}</span><span v-if="item.car_price">{{language.wan}}</span></div>

                            <div class="ui-nowrap-flex_add ui-whitespace money magin_b" >
  <button id="btn-ck">{{language.查看详情}}</button></div>

                        </li>
                        <li v-else class="ui-border" v-on:click="cardetail($index)">
                            <div class="ui-grid-halve-img">
                                <span><img :src="item.car_img?'/story/iscaradmin/'+item.car_img:defaultImg"></span>
                            </div>
                            <div class="ui-nowrap-flex_add ui-whitespace name">
                                {{item.brand_name}}<br>{{item.model_name}}<br>{{item.style_name}}
                            </div>
                            <div class="ui-nowrap-flex_add ui-whitespace money magin_b"><span class="red">{{item.car_price?car_price(item.car_price):'未公佈價格'}}</span><span v-if="item.car_price">{{language.wan}}</span></div>

                            <div class="ui-nowrap-flex_add ui-whitespace money magin_b" ><button id="btn-ck">{{language.查看详情}}</button></div>
                        </li>
                    </template>
                </ul>
            </section>
            <!--推荐车款-->
            <section id="news" v-if="new_list" v-cloak>
            <center><img :src="language.new_img" class="title-big"></center>
            <ul>
            <li v-for="item in new_list">
                <a target="_blank" onclick="toWeb('{{item.article_url}}')">
                    <img :src="item.imagepath">
                    <div class="ui-nowrap ui-whitespace title">{{item.title}}</div>
                </a>
<!--                <a  v-else class="newpage">-->
<!--                    <img :src="item.imagepath">-->
<!--                    <div class="ui-nowrap ui-whitespace title">{{item.title}}</div>-->
<!--                </a>-->
            </li>
            </ul>
            </section>
        <!--焦点新闻-->

        </section>
        <a class="ui-icon-cion49 go-top " id="gotop" ></a>  <!--返回顶部-->
        <a href="search_adv.html" class="ui-icon-search search " id="search" ></a><!--搜索-->
</div>
    </body>
    <script src="js/config.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="http://tw-member.iscarmg.com/app/libs/jquery-ui.js"></script>
    <script src="http://tw-member.iscarmg.com/app/libs/jquery.ui.touch-punch.min.js"></script>
    <script src="http://tw-member.iscarmg.com/app/libs/js-cookie/src/js.cookie.js"></script>
    <!-- <script type="text/javascript" src="http://tw-member.iscarmg.com/app/js/user.js"></script> -->
    <script type="text/javascript">
        document.write('<script type="text/javascript" src="http://' + server_type + _region + '-member.iscarmg.com/app/js/user.js"><\/script>');
    </script>
    <script type="text/javascript">
        document.write('<script type="text/javascript" src="http://' + server_type + _region + '-member.iscarmg.com/app/js/iPhone.js"><\/script>');
    </script>
    <!-- <script src="http://tw-member.iscarmg.com/app/js/iPhone.js"></script> -->

    <!-- 瀏覽器裝置機碼 -->
    <script type="text/javascript">
        document.write('<script type="text/javascript" src="http://' + server_type + _region + '-member.iscarmg.com/app/js/generate_murid.js"><\/script>');
    </script>
    <!-- <script type="text/javascript" src="http://tw-member.iscarmg.com/app/js/generate_murid.js"></script> -->
    <script src="js/lib/zepto.min.js"></script>
    <script src="js/frozen.js"></script>
    <script src="js/lib/sha256.js"></script>
    <script type="text/javascript" src="js/gotop.js"></script>
    <script src="js/vue.min.js"></script>
    <script src="js/language.js"></script>
    <script>
      $(document).ready(function() {
        //<!--轮番图延迟0.5秒-->
        setTimeout(function () {(function (){
          var slider = new fz.Scroll('.ui-slider', {
            role: 'slider',
            indicator: true,
            autoplay: true,
            interval: 3000
          });

          slider.on('beforeScrollStart', function(fromIndex, toIndex) {
//                    console.log(fromIndex,toIndex)
          });

          slider.on('scrollEnd', function(cruPage) {
//                    console.log(cruPage)
          });
        })();
          (function (){
            var tab = new fz.Scroll('.ui-tab', {
              role: 'tab',
              autoplay: false,
            });
              /* 滑动开始前 */
            tab.on('beforeScrollStart', function(fromIndex, toIndex) {
//                        console.log(fromIndex,toIndex);// from 为当前页，to 为下一页
            })
          })();
        },500);


        $(".ui-icon-caidan").click(function(){
          $(".nav").toggle(300);
        });
        $(".language h3").click(function(){
          $(".types").toggle("");
        });


        //请求数据
        //        推荐车款
        var home= new Vue({
          el:'#home',
          data: {
            content: [],
            brand:[],
            new_list:[],
            language:language.home,
            isphone:'',
            defaultImg: defaultImg
          },
          methods: {
            car_price: function (e) {
              return e.replace(".00","")
            },
            cardetail: function (e) {
              window.location.href='car_detail.php?car_id='+home.content[e].car_id
            }
          },
          watch:{
            content:function () {
              //判断是否为移动端
//                    var isPC = function ()
//                    {
//                        var userAgentInfo = navigator.userAgent.toLowerCase();
//                        var Agents = new Array("android", "iphone", "symbianOS", "windows phone", "ipad", "ipod");
//                        var flag = true;
//                        for (var v = 0; v < Agents.length; v++) {
//                            if (userAgentInfo.indexOf(Agents[v]) > 0) { flag = false; break; }
//                        }
//                        return flag;
//                    };
//                    var isPC = isPC();
//                    if(!isPC){
//                        home.isphone=true;
//                    }else {
//                        home.isphone=false;
//                    }
            }
          }
        });

        var new_list=[];
        $.ajax({
          url:'service/?a=recommend_car&l='+localStorage.l,
          type:'get',
          dataType:'html',
          error: function(){
            console.log('Error loading document');
          },
          success: function(msg){
            var post = eval("("+msg+")");
            if(post.length%2!=0){
              post.pop();
            }
            home.$set('content', post)
          }
        });
        $.ajax({
          url:'service/?a=home_condition&l='+localStorage.l,
          type:'get',
          dataType:'html',
          error: function(){
            console.log('Error loading document');
          },
          success: function(msg){
            var post = eval("("+msg+")");
            $(post.banner).each(function (k,v) {
              v.img_url="background-image:url("+(v.img_url?v.img_url:defaultImg)+")";
            });
            home.$set('brand',post)
          }
        });
        //        文章接口
        var data = {
          'menu_id': '1317',
          'tag_id': '',
          'startid': '',
          'queryamount': '5'
        };

        $.ajax({
          contentType: "application/json; charset=utf-8",
          type: 'POST',
          url: 'http://tw-app.iscarmg.com/news/newslistquery',
          data: JSON.stringify(JSON.stringify(data)),
          dataType: 'json',
          success: function (result) {
            var new_list=result.newslistqueryresult.newslistarray;
            if(new_list&&new_list[0]!=undefined){
              $(new_list).each(function (k,v) {
                v.title=decodeURI(v.title);
                v.article_url=decodeURIComponent(v.article_url);
                v.catname=decodeURI(v.catname);
                v.created_by=decodeURI(v.created_by);
                v.createdate=decodeURI(v.createdate);
                v.id=decodeURI(v.id);
                v.imagepath=decodeURIComponent(v.imagepath);
              })
            }else {
              $('#news').remove();
            }
            home.$set('new_list',new_list)
          },
          error: function (result) {
            console.log(result)
          }
        });
        $(document).on('click','.brand',function (e) {
          var val=home.brand.brand[($(this).index())].name;
          sessionStorage.brand=val;
          window.location.href='search.html'
        });

        $(document).on('click','.price li',function (e) {
          var Price_sector=$(this).attr('id');
          if(sessionStorage.Price_sector){
            var data=JSON.parse(sessionStorage.Price_sector);
            if(data.indexOf(Price_sector)==-1){
              data.push(Price_sector);
              sessionStorage.Price_sector=JSON.stringify(data);
            }
          }else{
            var data=[];
            data.push(Price_sector);
            sessionStorage.Price_sector=JSON.stringify(data);
          }
          window.location.href='search.html'
        });

        $(document).on('click','.carbody li',function (e) {
          var val=+home.brand.carbody[($(this).index())].cbt_id;
          if(sessionStorage.carbody){
            var data=JSON.parse(sessionStorage.carbody);
            if(data.indexOf(+val)==-1){
              data.push(+val);
              sessionStorage.carbody=JSON.stringify(data);
            }
          }else{
            var data=[];
            data.push(val);
            sessionStorage.carbody=JSON.stringify(data);
          }
          window.location.href='search.html'
        });
        //        移动端打开新窗口
        //        $(document).on('click','.newpage',function (e) {
        //          var len=($('.newpage').index(this));
        //          openNewPage(home.new_list[len].article_url)
        //        });
        //            请求筛选条件
        sessionStorage.clear();
        userAvatarInit();
        loginInit(Two);
      })
    </script>
</html>