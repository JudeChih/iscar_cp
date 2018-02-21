<?
require('service/og_head.php');
$og=og_head('article',$_GET['article_id']);
$description=$og['post_content'];
$title=$og['post_title'];
if(mb_strlen($description, 'utf-8') > 200) {
    $description=substr($description,0,200).'...';
}
$image=$og['article_img'][0]['article_img'];
$url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="initial-scale=1, maximum-scale=1, user-scalable=no">
        <meta name="format-detection" content="telephone=no">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">
        <meta name="apple-mobile-web-app-capable" content="yes">

        <meta property='og:image' content="<?=$image?>" />
        <meta property='og:title' content="<?=$title?>" />
        <meta property='og:url' content="<?=$url?>" />

        <meta property="og:type" content="article"/>
        <meta property="og:description" content='<?=$description?>'/>
        <meta property="fb:app_id" content="875839542533172" />
        <meta property="og:locale" content="zh_tw" />
        <meta property="og:site_name" content="iscar!"/>

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
        <script>
          (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
              (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
          })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

          ga('create', 'UA-38808246-4', 'auto');
          ga('create', 'UA-38808246-6', 'auto');
          ga('send', 'pageview');
        </script>
        <!--end of google analytics-->
    </head>
    <body ontouchstart id="article_detaile" v-cloak>
    <div class="hot-key"></div>
        <header class="ui-header ui-header-positive ui-border-b">
            <i class="ui-icon-fanhui" onclick="history.back()"></i><h1>{{language.文章详情}}</h1>
<!--            <div class="ui-avatar-s user_icon"></div>-->
            <div class="ui-avatar-s iscar_member_icon  iscar_member_login"></div>
        </header>
        
        <section class="ui-container" style="background-color: #fff">
            <section class="wenzhang_xq">
            	<div><img :src="banner?banner.article_img:defaultImg" width="100%"></div>
                <h1 class="c_name magin_t">{{content.post_title}}</h1>
                <p class="xq ui-txt-justify" style="text-align: left;">
                    {{{content.post_content}}}
                </p>
            </section>
            <!--图片与文章-->
            
            <!--<section id="share" class="magin_t">-->
            <!--<div class="share"><span>{{language.分享}}：</span><i class="ui-icon-facebook"></i><i class="ui-icon-line"></i></div>-->
            <!--</section>-->
            
            <section id="fanpian" class="ui-border-b" >
                <ul class="ui-list ui-list-function ui-list-link">
                    <li onclick="window.location.href='article.php?car_id={{car_id}}&&article_id={{top.article_id}}';" v-if="top">
                          <div><i class="ui-icon-shangyige"></i></div>
                          <div class="ui-list-info">
                            <h4 class="ui-nowrap">{{language.上一篇}}&nbsp;&nbsp;{{{top.post_title}}}</h4>
                          </div>
                    </li>
                    <li onclick="window.location.href='article.php?car_id={{car_id}}&&article_id={{down.article_id}}'" v-if="down">
                        <div><i class="ui-icon-xiayige"></i></div>
                        <div class="ui-list-info">
                            <h4 class="ui-nowrap">{{language.下一篇}}&nbsp;&nbsp;{{{down.post_title}}}</h4>
                        </div>
                    </li>
                </ul>
            </section>
            <!--上一篇，下一篇-->


        	<section class="che" v-if="details.related_car">
            	<div class="title_small"><span>{{language.相关车辆}}</span></div>
                <ul class="ui-list ui-list-link car">
                    <li v-for="item in details.related_car" v-if="item.car_img" class="ui-border-t carrelated" style="cursor: pointer;">
                                <div class="ui-list-img new_car_search ">
                                    <span :style="item.car_img" class="new_div"></span>
                                </div>

                                <div class="ui-list-info">
                                    <h1 class="ui-nowrap font_size16">
                                        {{item.brand_name}}
                                        <span v-if="item.brand_name&&item.model_name"><br></span>
                                        {{item.model_name}}
                                    </h1>
                                    <h1 class="ui-nowrap font_size16">
                                        {{item.style_name}}
                                    </h1>
                                    <p class="ui-nowrap money"><span class="red">{{item.ci_sale_price?car_price(item.ci_sale_price):'未公佈價格'}}</span><span v-if="item.ci_sale_price">{{language.wan}}</span>&nbsp;&nbsp;{{item.ci_car_year_style}}</p>
                                    <!--<p class="ui-nowrap ui-border-t">{{language.平均油耗}}：<span class="black">{{item.ci_average_consumption}}</span></p>-->
                                    <!--<p class="ui-nowrap ui-border-t">{{language.年份}}：<span class="black">{{item.ci_car_year_style}}年</span></p>-->
                                </div>
                        </li>
                </ul>

        	</section>
            <!--相关  车辆-->


        	<section class="liuyan">
            	<div class="title_small"><span>{{language.留言评论}}</span></div>
                <div class="ui-form-item ui-form-item-textarea ui-border">
                    <textarea id="textarea_content" placeholder="{{language.见解}}"></textarea>
                </div>
                <form action="#">
                    <div class="ui-form-item ui-form-item-radio">
                        <label class="ui-radio" for="radio">
                            <input type="radio" name="radio">
                        </label>
                        <p>{{language.同步}}</p>
                    </div>
                </form>
                <div class="ui-btn-wrap">
                    <button id="btn-m" style="width:100%;" >
                        {{language.确定}}
                    </button>
                </div>  
                
                <ul class="ui-list liuyan_list ui-border-t">
                    <li v-for="item in commentary_list">
                        <div class="ui-avatar">
                            <span :style="item.avatar_url"></span>
                        </div>
                        <div class="ui-list-info">
                            <p class="ui-nowrap">{{item.nickname}}</p>
                            <h4>{{{item.comment_content}}}</h4>
                        </div>
                    </li>
                </ul>                
        	</section>
            <!--留言评论-->
        </section>
        
        <a class="ui-icon-cion49 go-top " id="gotop" ></a>  <!--返回顶部-->
        <a class="ui-icon-search search " id="search" ></a>   <!--搜索-->
        <a class="ui-icon-shouyeshouye go-index" id="go-index" ></a><!--返回首页-->
       </body>
    <script src="js/config.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script src="http://tw-member.iscarmg.com/app/libs/jquery-ui.js"></script>
    <script src="http://tw-member.iscarmg.com/app/libs/jquery.ui.touch-punch.min.js"></script>
    <script src="http://tw-member.iscarmg.com/app/libs/js-cookie/src/js.cookie.js"></script>
    <script type="text/javascript">
        document.write('<script type="text/javascript" src="http://' + server_type + _region + '-member.iscarmg.com/app/js/user.js"><\/script>');
    </script>
    <script type="text/javascript">
        document.write('<script type="text/javascript" src="http://' + server_type + _region + '-member.iscarmg.com/app/js/iPhone.js"><\/script>');
    </script>
    <script type="text/javascript">
        document.write('<script type="text/javascript" src="http://' + server_type + _region + '-member.iscarmg.com/app/js/generate_murid.js"><\/script>');
    </script>
    <script src="js/lib/zepto.min.js"></script>
    <script src="js/frozen.js"></script>
    <script src="js/function.js"></script>
    <script src="js/jquery.SuperSlide.2.1.1.js"></script>
    <script src="js/vue.min.js"></script>
    <script src="story/iscaradmin/js/layer/layer.js"></script>
    <script src="js/lib/sha256.js"></script>
    <script src="js/language.js"></script>
    <script src="js/gotop.js"></script>
    <script>
      var article_id=getQueryString().article_id;
      var car_id=getQueryString().car_id;
      var article_detaile= new Vue({
        el:'#article_detaile',
        data: {
          top:{},
          down:{},
          content:{},
          banner:{},
          details: [],
          commentary_list: [],
          car_id: car_id,
          language:language.article,
          defaultImg:defaultImg
        },
        watch:{
          content:function () {
          }
        },
        methods: {
          car_price: function (e) {
            return e.replace(".00","")
          }
        }
      });
      $.ajax({
        url:'service/?a=article_details&article_id='+article_id+'&car_id='+car_id,
        type:'get',
        dataType:'html',
        error: function(){
          console.log('Error loading document');
        },
        success: function(msg){
          var details = eval("("+msg+")");
          $(details.related_car).each(function (k,v) {
            v.car_img="background-image:url("+(v.car_img?("/story/iscaradmin/"+v.car_img):defaultImg)+");background-size: 100%;margin-top: 15px;";
//                   v.car_img="background-image:url(http://iscar.kmlab.com/story/iscaradmin/uploads/2016-12-30/148308099085790.jpg);background-size: 100%;margin-top: 15px;";
          });
          if(details.related_car.length<20){
            $('#More').hide();
          }
          article_detaile.$set('details', details);
          article_detaile.$set('top', details.up_article[0]);
          article_detaile.$set('down', details.down_article[0]);
          article_detaile.$set('content', details.content[0]);
          article_detaile.$set('banner', details.banner[0]);
        }
      });
      //            获取评论列表
      $.ajax({
//            car_id = article_id
        url:'service/?a=commentary_list&type=article&com_id='+article_id,
        type:'get',
        dataType:'html',
        error: function(err){
          console.log(err);
        },
        success: function(msg){
          var commentary_list = eval("("+msg+")");
          article_detaile.$set('commentary_list', commentary_list);
          $(commentary_list).each(function (k,v) {
            v.avatar_url="background-image:url("+v.avatar_url+")";
          })
        }
      });

      //添加评论
      $(document).on('click','#btn-m',function (e) {
        if($('#textarea_content').val()){
          $.ajax({
            url:'service/?a=commentary&type=article&com_id='+article_id+'&l='+localStorage.l+'&content='+$('#textarea_content').val(),
            type:'get',
            dataType:'html',
            error: function(err){
              console.log(err);
            },
            success: function(msg){
              if (msg=='评论成功'){
                $('#textarea_content').val('');
                layer.msg(msg,{time:1200});
              }
              // window.location.href=window.location.href;
            }
          })
        } else {
          layer.msg('请填写内容',{time:800});
        }
      });


      $(document).on('click','.carrelated',function (e) {
        var len=($('.carrelated').index(this));
        window.location.href='car_detail.php?car_id='+article_detaile.details.related_car[len].car_id
      });

      userAvatarInit();
    </script>
</html>