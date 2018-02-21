<?
require('service/og_head.php');
$og=og_head('car',$_GET['car_id']);
$title=$og[0]['brand_name'].$og[0]['model_name'].$og[0]['style_name'];
$description=$og[0]['post_content'];
if(mb_strlen($description, 'utf-8') > 200) {
    $description=substr($description,0,200).'...';
}
$image='/story/iscaradmin/'.$og[0]['banner'][0]['meta_file_path'];
$image='http://'.$_SERVER['SERVER_NAME'].$image;
$url='http://'.$_SERVER['SERVER_NAME'].$_SERVER["REQUEST_URI"];

?>
<!DOCTYPE html>
<html prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# iscar_tw: http://ogp.me/ns/fb/iscar_tw#" prefix="og: http://ogp.me/ns#" xmlns="http://www.w3.org/1999/xhtml" xml:lang="zh-tw" lang="zh-tw" dir="ltr" >

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
        <link rel="stylesheet" href="css/slide.css">
        <link rel="stylesheet" href="css/slick.css">
        <link rel="stylesheet" href="css/slick-theme.css">
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
        <style>
            /*.ck-slide {
                width:100%;
                height:300px;
            }
            .ck-slide ul.ck-slide-wrapper {
                width:100%;
                height:300px;
            }*/
        </style>
        <!--end of google analytics-->
    </head>

    <body id="car_details" ontouchstart v-cloak>
    <div class="hot-key"></div>
        <header class="ui-header ui-header-positive">
            <i class="ui-icon-fanhui" onclick="history.back()"></i><h1>{{language.车辆详情}}</h1>
<!--            <div class="ui-avatar-s user_icon"></div>-->
            <div class="ui-avatar-s iscar_member_icon  iscar_member_login"></div>
        </header>
        <section class="ui-container" style="background-color: #fff">
        	<!--<h1 class="c_name" >-->
                <!--{{details.model_name}}-->
                <!--{{details.style_name}}-->
            <!--</h1>-->
            <section id="slider">
                <div class="ui-slider">
                    <ul class="ui-slider-content" style="width: 300%">
                        <li v-for="item in banner"><span :style="item.new_meta_file_path"></span></li>
                    </ul>
                    <ul class="ui-justify ui-whitespace xq_tab" >
                        <li><p class="p_gailan">{{language.概览}}</p></li>
                        <li><p class="p_waiguan">{{language.外观}}</p></li>
                        <li><p class="p_neishi">{{language.内饰}}</p></li>
                        <li><p class="p_guige">{{language.规格}}</p></li>
                        <li><p class="p_wenzhang">{{language.文章}}</p></li>
                        <li><p class="p_xinwen">{{language.相关新闻}}</p></li>
                    </ul>
                    <ul class="ui-justify ui-whitespace xq_tab1"  style="display: none">
                        <li><p class="p_gailan">{{language.概览}}</p></li>
                        <li><p class="p_waiguan">{{language.外观}}</p></li>
                        <li><p class="p_neishi">{{language.内饰}}</p></li>
                        <li><p class="p_guige">{{language.规格}}</p></li>
                        <li><p class="p_wenzhang">{{language.文章}}</p></li>
                        <li><p class="p_xinwen">{{language.相关新闻}}</p></li>
                    </ul>
                </div>
            </section>
            <!--轮播图-->
            <section class="gailan"style="letter-spacing:2px">
                <h1 class="c_name">
                    {{details.brand_name}}
                    {{details.model_name}}
                    {{details.style_name}}
                </h1>
                <!--<p class="c_name_sm">{{{details.post_title}}}</p>-->
                <p class="xq">{{{details.post_content}}}</p>
            </section>
            <!--概览-->
            <div class="cardetail_div" v-if="content.car_year[0]">
                <div class="cardetail_header">
                    <span>{{{language.车款及售价}}}</span>
                    <span style="float: right">款式年式
                        <select id="sel" v-on:change="year()">
                          <option v-for="item in content.year_list" value="{{item}}">{{item}}</option>
                        </select>
                    </span>
                </div>
                <table class="cardetail_table">
                    <tr>
                        <td class="cardetail_td1">{{{language.车款}}}</td>
                        <td class="cardetail_td2">{{{language.售价}}}</td>
                    </tr>
                </table>
                <div class="cardetail_div1" v-for="item in content.new_car_year">
                    <hr class="cardetail_hr" />
                    <a href="car_detail.php?car_id={{item.car_id}}">
                        <table style="width: 100%;">
                            <tr>
                                <td class="cardetail_td3">{{item.style_name}}</td>
                                <td class="cardetail_td4">{{item.car_price?car_price(item.car_price):'未公佈價格'}}</td>
                            </tr>
                        </table>
                    </a>
                </div>
            </div>
        	<section class="waiguan" v-if="imgs[0]">
                <div class="title_small"><span>{{language.外观}}</span></div>
                <div class="waiguan-slide">
                    <div v-for="item in imgs">
                        <img :src="'/story/iscaradmin/'+item.img" style="width:100%;">
                    </div>
                    <!-- <ul class="ck-slide-wrapper">
                        <li v-for="item in imgs">
                            <img :src="'/story/iscaradmin/'+item.img" style="width:100%;">
                        </li>
                    </ul>
                    <div class="ck-slidebox">
                        <div class="slideWrap">
                            <ul class="dot-wrap">
                                <li v-for="item in imgs"  :class="$index==0 ? current: ''"><em>{{$index+1}}</em></li>
                            </ul>
                        </div>
                    </div> -->
                </div>
            </section>
            <section class="neishi" v-if="addimgs[0]">
                <div class="title_small"><span>{{language.内饰}}</span></div>
                <div class="neishi-slide">
                    <div v-for="item in addimgs">
                        <img :src="'/story/iscaradmin/'+item.img" style="width:100%;">
                    </div>
                    <!-- <ul class="ck-slide-wrapper">
                        <li v-for="item in addimgs">
                            <img :src="'/story/iscaradmin/'+item.img" style="width:100%;">
                        </li>
                    </ul>
                    <div class="ck-slidebox">
                        <div class="slideWrap">
                            <ul class="dot-wrap">
                                <li v-for="item in addimgs"  :class="$index==0 ? current: ''"><em>{{$index+！}}</em></li>
                            </ul>
                        </div>
                    </div> -->
                </div>
            </section>
            <!--外观与内饰-->
            <!--车辆概况、车型尺寸、技术参数、车辆配备-->
        	<section class="guige" >
            	<div class="title_small"><span>{{language.规格}}</span></div>
                <table class="title_small car_table" border="1"  bordercolor="#f8f8f8">
                    <tr>
                        <td width="18%" class="car_tb">{{{language.车辆概况}}}</td>
                        <td>
                            {{details.model_name}}
                            {{details.style_name}}
                            <p style="color:#ff5400;">{{details.ci_sale_price?car_price(details.ci_sale_price):'未公佈價格'}} <a v-if="details.ci_sale_price">{{language.wan}}元</a></p>
                            <p>年式&nbsp;：{{details.ci_car_year_style}}</p>
                            <p v-if="details.ci_fuel_tax">{{language.燃料税}}&nbsp;：{{details.ci_fuel_tax}}元</p>
                            <p v-if="details.ci_license_tax">{{language.牌照税}}&nbsp;：{{details.ci_license_tax}}元</p>
                        </td>
                    </tr>
                    <tr>
                        <td width="18%"class="car_tb">{{{language.车型尺寸}}}</td>
                        <td>
                            <table width="100%" border="1" bordercolor="#f8f8f8">
                                <tr>
                                    <td width="45%" height="30px">{{language.车型分类}}</td>
                                    <td>{{details.body_name}}</td>
                                </tr>
                                <tr>
                                    <td width="45%" height="30px">{{language.车长}}(mm)</td>
                                    <td>{{details.ci_overall_length}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.车宽}}(mm)</td>
                                    <td>{{details.ci_overall_width}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.车高}}(mm)</td>
                                    <td>{{details.ci_overall_height}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.轴距}}(mm)</td>
                                    <td>{{details.ci_wheel_base}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.后轮距}}(mm)</td>
                                    <td>{{details.ci_rear_track}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.前轮距}}(mm)</td>
                                    <td>{{details.ci_front_track}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.最小离地高度}}(mm)</td>
                                    <td>{{details.ci_ground_clearance}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.乘客数}}</td>
                                    <td>{{details.ci_car_seats}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.车门数}}</td>
                                    <td>{{details.ci_car_doors}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.车重}}(kg)</td>
                                    <td>{{details.ci_overall_weight}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.回转半径}}(M)</td>
                                    <td>{{details.ci_turning_radius}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.前轮尺寸}}</td>
                                    <td>{{details.ci_front_wheel_size}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.后轮尺寸}}</td>
                                    <td>{{details.ci_rear_wheel_siae}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.行李箱容积}}(L)</td>
                                    <td>{{details.ci_luggage_capacity}}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td width="18%" class="car_tb">{{{language.技术参数}}}</td>
                        <td>
                            <table width="100%" border="1"  bordercolor="#f8f8f8">
                                <tr>
                                    <td width="45%" height="30px">{{language.风阻系数}}</td>
                                    <td>{{details.ci_aerodynamic_drag}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.油箱容量}}(L)</td>
                                    <td>{{details.ci_tank_capacity}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.转向系统}}</td>
                                    <td>{{details.ci_steering_system}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.前轮悬吊}}</td>
                                    <td>{{details.ci_front_suspension}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.后轮悬吊}}</td>
                                    <td>{{details.ci_rear_suspension}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.引擎燃料}}</td>
                                    <td>{{details.ci_fueltype}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.电池种类}}</td>
                                    <td>{{details.ci_battery_type}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.电池容量}}</td>
                                    <td>{{details.ci_battery_capacity}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.纯电池里程}}(km)</td>
                                    <td>{{details.ci_max_milage}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.充电时间}}(h)</td>
                                    <td>{{details.ci_recharge_time}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.市区油耗}}(L/100km)</td>
                                    <td>{{details.ci_urban_consumption}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.高速油耗}}(L/100km)</td>
                                    <td>{{details.ci_high_speed_consumption}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.平均油耗}}(L/100km)</td>
                                    <td>{{details.ci_average_consumption}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.排气量}}(CC)</td>
                                    <td>{{details.ci_displacement}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.压缩比}}</td>
                                    <td>{{details.ci_compression_ratio}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.气缸构造}}</td>
                                    <td>{{details.ci_cylinder_structure}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.引擎设计}}</td>
                                    <td>{{details.ci_valve_gear}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.引擎技术}}</td>
                                    <td>{{details.ci_engine_tech}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.供油方式}}</td>
                                    <td>{{details.ci_fuel_injection}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.每缸气门数}}</td>
                                    <td>{{details.ci_valve_each_cylinder}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.总气门数}}</td>
                                    <td>{{details.ci_total_valves}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.引擎位置}}</td>
                                    <td>{{details.ci_engine_location}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.进气方式}}</td>
                                    <td>{{details.ci_aspiration}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.最大马力}}(hp)</td>
                                    <td>{{details.ci_max_horsepower}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.最大扭矩}}(kgm)</td>
                                    <td>{{details.ci_max_torque}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.变速系统}}</td>
                                    <td>{{details.ci_transmission_system}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.驱动方式}}</td>
                                    <td>{{details.ci_drive_mode}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.刹车系统}}</td>
                                    <td>{{details.ci_brake_system}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.产地}}</td>
                                    <td>{{details.ci_carsource}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.制造商}}</td>
                                    <td>{{details.ci_manufactory}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.技术合作}}</td>
                                    <td>{{details.ci_technical_cooperation}}</td>
                                </tr>
                                <tr>
                                    <td height="30px">{{language.经销商}}</td>
                                    <td>{{details.ci_distribution_agent}}</td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td width="18%" class="car_tb">{{{language.车辆配备}}}</td>
                        <td>
                            <div v-for="item in Equipment" style="width: 50%;float: left">{{item.value}}<br></div>
                        </td>
                    </tr>
                </table>
        	</section>
            <!--规格-->

            <!--<section id="share" class="magin_t" >-->
            <!--<div class="share"><span>{{language.分享}}：</span><i class="ui-icon-facebook"></i><i class="ui-icon-line"></i></div>--
            <!--</section>-->

        	<section  class="wenzhang" v-if="article[0]">
            	<div class="title_small"><span>{{language.文章}}</span></div>
                    <ul class="ui-list ui-list-link">
                        <li v-for="item in article" class="ui-border-b" onclick="window.location.href='article.php?car_id={{car_id}}&&article_id={{item.ID}}'">
                            <div class="ui-list-img">
                                <span :style="item.article_img"></span>
                            </div>
                            <div class="ui-list-info">
                                <h1 class="new_ui-nowrap ui-border-b new_background-image">{{{item.post_title}}}</h1>
                                <!--<p class="ui-nowrap-multi ui-whitespace">{{{item.post_excerpt}}}</p>-->
                            </div>
                        </li>

                    </ul>
        	</section>
            <!--文章-->

            <section  id="news" class="xinwen" v-if="new_list[0]">
            	<div class="title_small new" v-if="new_list"><span>{{language.相关新闻}}</span></div>
                <ul>
                    <li v-for="item in new_list">
                        <a target="_blank" onclick="toWeb('{{item.article_url}}')">
                            <img :src="item.imagepath">
                            <div class="ui-nowrap ui-whitespace title">{{item.title}}</div>
                        </a>
                    </li>
                </ul>
            </section>
            <!--相关新闻-->

        	<section  class="liuyan" v-if="details.post_title">
            	<div class="title_small"><span>{{language.留言评论}}</span></div>

                <div class="ui-form-item ui-form-item-textarea ui-border">
                    <textarea id="textarea_content" placeholder="{{language.见解}}"></textarea>
                </div>
                <form action="#">
                    <div class="ui-form-item ui-form-item-radio">
                        <label class="ui-radio" for="radio">
                            <input type="checkbox" name="radio">
                        </label>
                        <p>{{language.同步}}</p>
                    </div>
                </form>
                <div class="ui-btn-wrap">
                    <button id="btn-m"  class="button_disabled" style="width:100%;">
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
        <a class="ui-icon-cion49 go-top " id="gotop"></a>  <!--返回顶部-->
        <a class="ui-icon-search search " id="search"></a>   <!--搜索-->
        <a class="ui-icon-shouyeshouye go-index" id="go-index"></a><!--返回首页-->
        <i class="{{add_class}} collection icon_shoucang"></i>
        <!--ui-icon-shoucang-->
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
    <script src="js/slide.js"></script>
    <script src="js/jquery.SuperSlide.2.1.1.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/vue.min.js"></script>
    <script src="story/iscaradmin/js/layer/layer.js"></script>
    <script src="js/lib/sha256.js"></script>
    <script src="js/language.js"></script>
    <script type="text/javascript" src="js/gotop.js"></script>
    <script>
      $('.p_gailan').click(function () {
        var scroll_offset = $(".gailan").offset();
        $("body,html").animate({
          scrollTop:scroll_offset.top-87
        },200);
      });
      $('.p_waiguan').click(function () {
        var scroll_offset = $(".waiguan").offset();
        $("body,html").animate({
          scrollTop:scroll_offset.top-90
        },400);
      });
      $('.p_neishi').click(function () {
        var scroll_offset = $(".neishi").offset();
        $("body,html").animate({
          scrollTop:scroll_offset.top-90
        },500);
      });
      $('.p_guige').click(function () {
        var scroll_offset = $(".guige").offset();
        $("body,html").animate({
          scrollTop:scroll_offset.top-90
        },600);
      });
      $('.p_wenzhang').click(function () {
        var scroll_offset = $(".wenzhang").offset();
        $("body,html").animate({
          scrollTop:scroll_offset.top-90
        },800);
      });
      $('.p_xinwen').click(function () {
        var scroll_offset = $(".xinwen").offset();
        $("body,html").animate({
          scrollTop:scroll_offset.top-90
        },1000);
      });

      var car_id=getQueryString().car_id;
      var car_details= new Vue({
        el:'#car_details',
        data: {
          content:{},
          details: [],
          article:{},
          banner:{},
          imgs:{},
          addimgs:{},
          Equipment:{},
          commentary_list: [],
          new_list:{},
          language:language.car_detail,
          add_class:'',
          isphone:'',
          car_id:car_id,
          defaultImg: defaultImg
        },
        watch:{
          content:function () {
          }
        },
        methods: {
          car_price: function (e) {
            return e.replace(".00","")
          },
          year:function () {
            var val = $('#sel option:selected').val()
            var temporary = []
            $(car_details.content.car_year).each(function (k,v) {
              if (v.car_year==val) {
                temporary.push(v)
              }
            })
            car_details.$set('content.new_car_year', temporary);
          }
        }
      });
      $.ajax({
        url:'service/?a=car_details&car_id='+car_id,
        type:'get',
        dataType:'html',
        error: function(){
          console.log('Error loading document');
        },
        success: function(msg){
          var details = eval("("+msg+")");
          if(details.Collection_status=='true'){
            car_details.add_class='ui-icon-iconfontshoucang';
          }else {
            car_details.add_class='ui-icon-shoucang';
          }
          var abc=details.details.car_details[0];

          $(details.Condition).each(function (k,v) {
            v.term=v.term+v.keyword;
          });
          details.car_year= details.style_list
          details.year_list= []
          details.new_car_year= []
          $(details.car_year).each(function (k,v) {
            if (details.year_list.indexOf(v.car_year)==-1) {
              details.year_list.push(v.car_year)
            }
          })
          $(details.car_year).each(function (k,v) {
            if (v.car_year==details.year_list[0]) {
              details.new_car_year.push(v)
            }
          })
          function new_Parameter(value,e) {
            var r_value=' ';
            $(details.Condition).each(function (k,v) {
              if(v.term == value+e){
                r_value=v.value;
              }
            });
            return r_value;
          }
          abc.ci_front_suspension=new_Parameter("前轮悬吊",+abc.ci_front_suspension);
          abc.ci_rear_suspension=new_Parameter("后轮悬吊",+abc.ci_rear_suspension);
          abc.ci_fueltype=new_Parameter("引擎燃料",+abc.ci_fueltype);
          abc.ci_battery_type=new_Parameter("电池种类",+abc.ci_battery_type);
          abc.ci_cylinder_structure=new_Parameter("气缸构造",+abc.ci_cylinder_structure);
          abc.ci_engine_tech=new_Parameter("引擎技术",+abc.ci_engine_tech);
          abc.ci_valve_gear=new_Parameter("引擎设计",+abc.ci_valve_gear);
          abc.ci_fuel_injection=new_Parameter("供油方式",+abc.ci_fuel_injection);
          abc.ci_engine_location=new_Parameter("引擎位置",+abc.ci_engine_location);
          abc.ci_aspiration=new_Parameter("进气方式",+abc.ci_aspiration);
          abc.ci_transmission_system=new_Parameter("变速系统",+abc.ci_transmission_system);
          abc.ci_drive_mode=new_Parameter("驱动方式",+abc.ci_drive_mode);
          abc.ci_brake_system=new_Parameter("刹车系统",+abc.ci_brake_system);
          abc.ci_steering_system=new_Parameter("转向系统",+abc.ci_steering_system);
          abc.ci_cylinder_name=new_Parameter("气缸名称",+abc.ci_cylinder_name);
          abc.ci_carsource=new_Parameter("产地",+abc.ci_carsource);
          abc.ci_manufactory=new_Parameter("制造商",+abc.ci_manufactory);
          abc.ci_technical_cooperation=new_Parameter("技术合作",+abc.ci_technical_cooperation);
          abc.ci_distribution_agent=new_Parameter("经销商/代理商",+abc.ci_distribution_agent);

          car_details.$set('content',details);
          car_details.$set('article',details.article);
          $(car_details.article).each(function (k,v) {
            v.article_img="background-image:url("+(v.article_img?v.article_img:defaultImg)+");background-size: 100% 100%;";
          });
          car_details.$set('banner',details.banner);
          if (car_details.banner[0]) {
            $(car_details.banner).each(function (k,v) {
              v.new_meta_file_path='background-image:url('+('/story/iscaradmin/'+v.meta_file_path)+")";
            });
          } else {
            car_details.banner=[{new_meta_file_path:'background-image:url('+defaultImg+')'}]
          }
          car_details.$set('imgs',details.details.imgs);
          car_details.$set('addimgs',details.details.add_imgs);
          car_details.$set('Equipment',details.details.Equipment);
          car_details.$set('details',details.details.car_details[0]);
          setTimeout(function () {(function (){
            var slider = new fz.Scroll('.ui-slider', {
              role: 'slider',
              indicator: true,
              autoplay: true,
              interval: 3000
            });
            // $('.ck-slide').ckSlide({
            //   autoPlay:true
            // });
            $('.neishi-slide').slick({
                slidesToShow: 1,
                autoplay:true,
                autoplaySpeed: 2000,
                dots: true,
                nextArrow: false,
                prevArrow: false,
                appendDots:".neishi-slide"
            });
            $('.waiguan-slide').slick({
                slidesToShow: 1,
                autoplay:true,
                autoplaySpeed: 2000,
                dots: true,
                nextArrow: false,
                prevArrow: false,
                appendDots:".waiguan-slide"
            });
            $('.waiguan-slide img').each(function(){
                var hei = $('.waiguan-slide').height();
                if($(this).height() < hei){
                    var m_t = (hei-$(this).height())/2;
                    $(this).css('top',m_t+'px');
                }
            })
            $('.neishi-slide img').each(function(){
                var hei = $('.neishi-slide').height();
                if($(this).height() < hei){
                    var m_t = (hei-$(this).height())/2;
                    $(this).css('top',m_t+'px');
                }
            })
          })();
          },500);
          news(String(details.details.car_details[0].tag_id))
        }
      });
        $(window).resize(function() {
            $('.waiguan-slide img').each(function(){
                var hei = $('.waiguan-slide').height();
                if($(this).height() < hei){
                    var m_t = (hei-$(this).height())/2;
                    $(this).css('top',m_t+'px');
                }
            })
            $('.neishi-slide img').each(function(){
                var hei = $('.neishi-slide').height();
                if($(this).height() < hei){
                    var m_t = (hei-$(this).height())/2;
                    $(this).css('top',m_t+'px');
                }
            })
        });
      //            添加收藏
      $(document).on('click','.collection',function(e) {
        $.ajax({
          url:'service/?a=collection&car_id='+car_id,
          type:'post',
          dataType:'html',
          error: function(err){
            console.log(err);
          },
          success: function(msg){
            layer.msg(msg,{time:800});
            if(msg=='收藏成功'){
              car_details.add_class='ui-icon-iconfontshoucang';
            }else {
              car_details.add_class='ui-icon-shoucang';
            }
          }
        })
      });
      //       '获取评论列表
      $.ajax({
        url:'service/?a=commentary_list&type=car&com_id='+car_id,
        type:'get',
        dataType:'html',
        error: function(err){
          console.log(err);
        },
        success: function(msg){
          var commentary_list = eval("("+msg+")");
          car_details.$set('commentary_list', commentary_list)
          $(commentary_list).each(function (k,v) {
            v.avatar_url="background-image:url("+v.avatar_url+")";
          })
        }
      });
      //添加评论
      $(document).on('click','#btn-m',function(e) {
        if($('#textarea_content').val()){
          $.ajax({
            url:'service/?a=commentary&type=car&com_id='+car_id+'&content='+$('#textarea_content').val(),
            type:'post',
            dataType:'html',
            error: function(err){
              //console.log('错误');
            },
            success: function(msg){
              if (msg=='评论成功'){
                $('#textarea_content').val('');
                layer.msg(msg,{time:1200});
                // window.location.href=window.location.href;
              }
            }
          })
        }else {
          layer.msg('请填写内容',{time:800});
        }
      });
      //         新闻
      function news(e) {
        var data = {
          'menu_id':'',
          'tag_id':e||'',
          'startid': '',
          'queryamount': '5'
        };
        $.ajax({
          contentType: "application/json; charset=utf-8",
          type: 'POST',
          url: 'http://tw-app.iscarmg.com/news/newslistquery',
          data: JSON.stringify(JSON.stringify(data)),
          dataType: 'json',
          success: function(result) {
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
              });
              car_details.$set('new_list',new_list)
            }else {
              $('#news').remove();
            }
          },
          error: function(result) {
            console.log(result)
          }
        });
      }
      $(document).on('click','.newpage',function (e) {
        var len=($('.newpage').index(this));
        openNewPage(car_details.new_list[len].article_url)
      });

      userAvatarInit();
    </script>
</html>
