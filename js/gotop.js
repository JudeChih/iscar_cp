var Base64={_keyStr:"ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=",encode:function(e){var t="";var n,r,i,s,o,u,a;var f=0;e=Base64._utf8_encode(e);while(f<e.length){n=e.charCodeAt(f++);r=e.charCodeAt(f++);i=e.charCodeAt(f++);s=n>>2;o=(n&3)<<4|r>>4;u=(r&15)<<2|i>>6;a=i&63;if(isNaN(r)){u=a=64}else if(isNaN(i)){a=64}t=t+this._keyStr.charAt(s)+this._keyStr.charAt(o)+this._keyStr.charAt(u)+this._keyStr.charAt(a)}return t},decode:function(e){var t="";var n,r,i;var s,o,u,a;var f=0;e=e.replace(/[^A-Za-z0-9+/=]/g,"");while(f<e.length){s=this._keyStr.indexOf(e.charAt(f++));o=this._keyStr.indexOf(e.charAt(f++));u=this._keyStr.indexOf(e.charAt(f++));a=this._keyStr.indexOf(e.charAt(f++));n=s<<2|o>>4;r=(o&15)<<4|u>>2;i=(u&3)<<6|a;t=t+String.fromCharCode(n);if(u!=64){t=t+String.fromCharCode(r)}if(a!=64){t=t+String.fromCharCode(i)}}t=Base64._utf8_decode(t);return t},_utf8_encode:function(e){e=e.replace(/rn/g,"n");var t="";for(var n=0;n<e.length;n++){var r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r)}else if(r>127&&r<2048){t+=String.fromCharCode(r>>6|192);t+=String.fromCharCode(r&63|128)}else{t+=String.fromCharCode(r>>12|224);t+=String.fromCharCode(r>>6&63|128);t+=String.fromCharCode(r&63|128)}}return t},_utf8_decode:function(e){var t="";var n=0;var r=c1=c2=0;while(n<e.length){r=e.charCodeAt(n);if(r<128){t+=String.fromCharCode(r);n++}else if(r>191&&r<224){c2=e.charCodeAt(n+1);t+=String.fromCharCode((r&31)<<6|c2&63);n+=2}else{c2=e.charCodeAt(n+1);c3=e.charCodeAt(n+2);t+=String.fromCharCode((r&15)<<12|(c2&63)<<6|c3&63);n+=3}}return t}}

var $_main = Cookies.get(_main) ? JSON.parse(Cookies.get(_main)) : '';
function One(mur){
  var $jsonString =
    {
      "mur":mur||'',
      "modacc":"tw_iscar_cp",
      "modvrf": SHA256('tw_iscar_cp' + '5tgb6tfc'),
      "redirect_uri":"http://"+window.location.host+"/cp-transform.php"
    };
  $jsonString = JSON.stringify($jsonString);
  $jsonString = Base64.encode($jsonString);
  $parameter = encodeURIComponent($jsonString);
  document.cookie="parameter=" + $parameter;
}
function Two() {
  var userStatus = $_main ? $_main.sat : '';
  if(userStatus){
    $.ajax({
      url:"service/?a=login&uid="+$_main.mdId+"&nickname="+$_main.md_cname+"&email=&avatar_url="+$_main.md_picturepath,
      type:'get',
      dataType:'html',
      error: function(){
        console.log('Error loading document');
      },
      success: function(msg){
        //console.log(msg);
      }
    });
  }else{
    $.ajax({
      url:"service/?a=login&login_status=not_recording",
      type:'get',
      dataType:'html',
      error: function(){
        console.log('Error loading document');
      },
      success: function(msg){
        //console.log(msg);
      }
    });
  }
}
if ($_main.murId) {
  One($_main.murId)
} else {
  getMurId(One)
}
//登入前


$('#language_1').click(function () {
  localStorage.l=1;
  sessionStorage.clear();
  window.location.href='./';
});
$('#language_2').click(function () {
  localStorage.l=2;
  sessionStorage.clear();
  window.location.href='./';
});
$('#language_3').click(function () {
  localStorage.l=3;
  sessionStorage.clear();
  window.location.href='./';
});

$('#search').click(function () {
  window.location.href='search_adv.html';
});
$('#go-index').click(function () {
  window.location.href='index.php';
});

//
$(window).scroll(function(){  //只要窗口滚动,就触发下面代码
  //var scrollt = document.documentElement.scrollTop + document.body.scrollTop; //获取滚动后的高度
  var iheight=$(this).scrollTop();
  if(iheight != 0 ){  //判断滚动后高度超过200px,就显示
    $("#gotop").fadeIn(300); //淡出
  }else{
    $("#gotop").stop().fadeOut(400); //如果返回或者没有超过,就淡入.必须加上stop()停止之前动画,否则会出现闪动
  }
  var scroll_top = $('#slider').height()-45;
  if(iheight>=scroll_top){
    $('.xq_tab1').show();
    $('.xq_tab').hide();
  }else {
    $('.xq_tab').show();
    $('.xq_tab1').hide();
  }
});
$("#gotop").click(function(){ //当点击标签的时候,使用animate在200毫秒的时间内,滚到顶部
  $("html,body").animate({scrollTop:"0px"},500);
});

//    屏幕宽度
var $width=$(window).width();
if($width>1000){
  var $_margin=($width/4);
  var $new_margin='0px '+$_margin+'px 0px '+$_margin+'px';
  $('.hot-key').css('left','30%');
  $('a.search').css('margin',$new_margin);
  $('a.go-top').css('margin',$new_margin);
  $('a.go-index').css('margin',$new_margin);
  $('.icon_shoucang').css('margin',$new_margin);
  $('.icon_del').css('margin',$new_margin);
  $('.ui-header .ui-logo').css('margin-top','1%');
  $('.ui-header .ui-logo').css('width','12%');
}
$(window).resize(function() {
    $width=$(window).width();
    if($width>1000){
        var $_margin=($width/4);
        var $new_margin='0px '+$_margin+'px 0px '+$_margin+'px';
        $('.hot-key').css('left','27%');
        $('a.search').css('margin',$new_margin);
        $('a.go-top').css('margin',$new_margin);
        $('a.go-index').css('margin',$new_margin);
        $('.icon_shoucang').css('margin',$new_margin);
        $('.icon_del').css('margin',$new_margin);
        // $('.ui-header .ui-logo').css('margin-top','1%');
        // $('.ui-header .ui-logo').css('width','12%');
    }else{
        $('.hot-key').css('left','2%');
        $('a.search').css('margin',0);
        $('a.go-top').css('margin',0);
        $('a.go-index').css('margin',0);
        $('.icon_shoucang').css('margin',0);
        $('.icon_del').css('margin',0);
    }
});
 var defaultImg = 'img/預設圖logo.jpg';

