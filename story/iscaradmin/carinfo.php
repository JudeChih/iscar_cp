<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/2
 * Time: 15:29
 */
include ('header.php');
//高级搜索后的分页
function advpage($total, $thispage, $page_size=10, $url='', $k='', $st_k='', $en_k='', $r=''){
    global $lang_carinfo;
    
    $pagecount = ceil($total/$page_size);//总页数
    $url = empty($url) ? $_SERVER['REQUEST_URI'] : $url;
    $centernum = 5;//中间分页显示的个数
    $order = g('recommend');
    $page='<ul class="pagination fr">';
    if($pagecount <= 1){
        $back='';//'.$lang_carinfo['首页'].'+上一页
        $next='';//'.$lang_carinfo['尾页'].'+下一页
        $center='';
    }else{
        $back='';//'.$lang_carinfo['首页'].'+上一页
        $next='';//'.$lang_carinfo['尾页'].'+下一页
        $center='';
        if($thispage==1){
            $back .= '<li class="disabled"><a>'.$lang_carinfo['首页'].'</a></li>';
            $back .= '<li class="disabled"><a>«</a></li>';
            for($i=1;$i<=$centernum;$i++){
                if($i>$pagecount){
                    break;
                }
                if($i != $thispage){
                    if(!empty($order)){
                        if(!empty($k)&&empty($st_k)&&empty($en_k)){
                            $center .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k='.$k.'&_page=' . $i . '">' . $i . '</a></li>';
                        }elseif(empty($k)&&!empty($st_k)&&!empty($en_k)){
                            $center .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . $i . '">' . $i . '</a></li>';
                        }elseif(!empty($k)&&!empty($st_k)&&!empty($en_k)){
                            $center .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k='.$k.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . $i . '">' . $i . '</a></li>';
                        }else {
                            $center .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&_page=' . $i . '">' . $i . '</a></li>';
                        }
                    }else{
                        if(!empty($k)&&empty($st_k)&&empty($en_k)){
                            $center .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=' . $i . '">' . $i . '</a></li>';
                        }elseif(empty($k)&&!empty($st_k)&&!empty($en_k)){
                            $center .= '<li><a href="' . $url . '&r='.$r.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . $i . '">' . $i . '</a></li>';
                        }elseif(!empty($k)&&!empty($st_k)&&!empty($en_k)){
                            $center .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . $i . '">' . $i . '</a></li>';
                        }else {
                            $center .= '<li><a href="' . $url . '&r='.$r.'&_page=' . $i . '">' . $i . '</a></li>';
                        }
                    }
                }else{
                    $center .= '<li class="active"><a>'.$i.'<span class="sr-only">(current)</span></a></li>';
                }
            }
            if(!empty($order)){
                if(!empty($k)&&empty($st_k)&&empty($en_k)){
                    $next .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k='.$k.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k='.$k.'&_page=' . $pagecount . '">'.$lang_carinfo['尾页'].'</a></li>';
                }elseif(empty($k)&&!empty($st_k)&&!empty($en_k)){
                    $next .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . $pagecount . '">'.$lang_carinfo['尾页'].'</a></li>';
                }elseif(!empty($k)&&!empty($st_k)&&!empty($en_k)){
                    $next .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k='.$k.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k='.$k.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . $pagecount . '">'.$lang_carinfo['尾页'].'</a></li>';
                }else {
                    $next .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&_page=' . $pagecount . '">'.$lang_carinfo['尾页'].'</a></li>';
                }
            }else{
                if(!empty($k)&&empty($st_k)&&empty($en_k)){
                    $next .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=' . $pagecount . '">'.$lang_carinfo['尾页'].'</a></li>';
                }elseif(empty($k)&&!empty($st_k)&&!empty($en_k)){
                    $next .= '<li><a href="' . $url . '&r='.$r.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . $pagecount . '">'.$lang_carinfo['尾页'].'</a></li>';
                }elseif(!empty($k)&&!empty($st_k)&&!empty($en_k)){
                    $next .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . $pagecount . '">'.$lang_carinfo['尾页'].'</a></li>';
                }else {
                    $next .= '<li><a href="' . $url . '&r='.$r.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&_page=' . $pagecount . '">'.$lang_carinfo['尾页'].'</a></li>';
                }
            }
        }elseif($thispage==$pagecount){//当前页为最后一页
            if(!empty($order)){
                if(!empty($k)&&empty($st_k)&&empty($en_k)){
                    $back .='<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k='.$k.'&_page=1">'.$lang_carinfo['首页'].'</a></li>';
                    $back .='<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k='.$k.'&_page='.($thispage-1).'">«</a></li>';
                }elseif(empty($k)&&!empty($st_k)&&!empty($en_k)){
                    $back .='<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=1">'.$lang_carinfo['首页'].'</a></li>';
                    $back .='<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k_start='.$st_k.'&k_end='.$en_k.'&_page='.($thispage-1).'">«</a></li>';
                }elseif(!empty($k)&&!empty($st_k)&&!empty($en_k)){
                    $back .='<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k='.$k.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=1">'.$lang_carinfo['首页'].'</a></li>';
                    $back .='<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k='.$k.'&k_start='.$st_k.'&k_end='.$en_k.'&_page='.($thispage-1).'">«</a></li>';
                }else {
                    $back .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&_page=1">'.$lang_carinfo['首页'].'</a></li>';
                    $back .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&_page=' . ($thispage - 1) . '">«</a></li>';
                }
            }else{
                if(!empty($k)&&empty($st_k)&&empty($en_k)){
                    $back .='<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=1">'.$lang_carinfo['首页'].'</a></li>';
                    $back .='<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page='.($thispage-1).'">«</a></li>';
                }elseif(empty($k)&&!empty($st_k)&&!empty($en_k)){
                    $back .='<li><a href="' . $url . '&r='.$r.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=1">'.$lang_carinfo['首页'].'</a></li>';
                    $back .='<li><a href="' . $url . '&r='.$r.'&k_start='.$st_k.'&k_end='.$en_k.'&_page='.($thispage-1).'">«</a></li>';
                }elseif(!empty($k)&&!empty($st_k)&&!empty($en_k)){
                    $back .='<li><a href="' . $url . '&r='.$r.'&k='.$k.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=1">'.$lang_carinfo['首页'].'</a></li>';
                    $back .='<li><a href="' . $url . '&r='.$r.'&k='.$k.'&k_start='.$st_k.'&k_end='.$en_k.'&_page='.($thispage-1).'">«</a></li>';
                }else {
                    $back .= '<li><a href="' . $url . '&r='.$r.'&_page=1">'.$lang_carinfo['首页'].'</a></li>';
                    $back .= '<li><a href="' . $url . '&r='.$r.'&_page=' . ($thispage - 1) . '">«</a></li>';
                }
            }
            for ($i=$pagecount-$centernum+1;$i<=$pagecount;$i++){
                if ($i<1){
                    $i = 1;
                }
                if ($i != $thispage){
                    if(!empty($order)){
                        if(!empty($k)&&empty($st_k)&&empty($en_k)){
                            $center .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k='.$k.'&_page=' . $i . '">' . $i . '</a></li>';
                        }elseif(empty($k)&&!empty($st_k)&&!empty($en_k)){
                            $center .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . $i . '">' . $i . '</a></li>';
                        }elseif(!empty($k)&&!empty($st_k)&&!empty($en_k)){
                            $center .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k='.$k.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . $i . '">' . $i . '</a></li>';
                        }else {
                            $center .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&_page=' . $i . '">' . $i . '</a></li>';
                        }
                    }else{
                        if(!empty($k)&&empty($st_k)&&empty($en_k)){
                            $center .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=' . $i . '">' . $i . '</a></li>';
                        }elseif(empty($k)&&!empty($st_k)&&!empty($en_k)){
                            $center .= '<li><a href="' . $url . '&r='.$r.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . $i . '">' . $i . '</a></li>';
                        }elseif(!empty($k)&&!empty($st_k)&&!empty($en_k)){
                            $center .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . $i . '">' . $i . '</a></li>';
                        }else {
                            $center .= '<li><a href="' . $url . '&r='.$r.'&_page=' . $i . '">' . $i . '</a></li>';
                        }
                    }
                }else{
                    $center .= '<li class="active"><a>'.$i.'<span class="sr-only">(current)</span></a></li>';
                }
            }
            $next .= '<li class="disabled"><a>»</a></li>';
            $next .= '<li class="disabled"><a>'.$lang_carinfo['尾页'].'</a></li>';
        }else{//单页，既不是第一页也不是最后一页
            if(!empty($order)){
                if(!empty($k)&&empty($st_k)&&empty($en_k)){
                    $back .='<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k='.$k.'&_page=1">'.$lang_carinfo['首页'].'</a></li>';
                    $back .='<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k='.$k.'&_page='.($thispage-1).'">«</a></li>';
                }elseif(empty($k)&&!empty($st_k)&&!empty($en_k)){
                    $back .='<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=1">'.$lang_carinfo['首页'].'</a></li>';
                    $back .='<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k_start='.$st_k.'&k_end='.$en_k.'&_page='.($thispage-1).'">«</a></li>';
                }elseif(!empty($k)&&!empty($st_k)&&!empty($en_k)){
                    $back .='<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k='.$k.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=1">'.$lang_carinfo['首页'].'</a></li>';
                    $back .='<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k='.$k.'&k_start='.$st_k.'&k_end='.$en_k.'&_page='.($thispage-1).'">«</a></li>';
                }else {
                    $back .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&_page=1">'.$lang_carinfo['首页'].'</a></li>';
                    $back .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&_page=' . ($thispage - 1) . '">«</a></li>';
                }
            }else{
                if(!empty($k)&&empty($st_k)&&empty($en_k)){
                    $back .='<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=1">'.$lang_carinfo['首页'].'</a></li>';
                    $back .='<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page='.($thispage-1).'">«</a></li>';
                }elseif(empty($k)&&!empty($st_k)&&!empty($en_k)){
                    $back .='<li><a href="' . $url . '&r='.$r.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=1">'.$lang_carinfo['首页'].'</a></li>';
                    $back .='<li><a href="' . $url . '&r='.$r.'&k_start='.$st_k.'&k_end='.$en_k.'&_page='.($thispage-1).'">«</a></li>';
                }elseif(!empty($k)&&!empty($st_k)&&!empty($en_k)){
                    $back .='<li><a href="' . $url . '&r='.$r.'&k='.$k.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=1">'.$lang_carinfo['首页'].'</a></li>';
                    $back .='<li><a href="' . $url . '&r='.$r.'&k='.$k.'&k_start='.$st_k.'&k_end='.$en_k.'&_page='.($thispage-1).'">«</a></li>';
                }else {
                    $back .= '<li><a href="' . $url . '&r='.$r.'&_page=1">'.$lang_carinfo['首页'].'</a></li>';
                    $back .= '<li><a href="' . $url . '&r='.$r.'&_page=' . ($thispage - 1) . '">«</a></li>';
                }
            }
            $left = $thispage - floor($centernum / 2) ;
            $right = $thispage + floor($centernum / 2) ;
            if($left < 1){
                $left=1;
                $right = $centernum < $pagecount ? $centernum:$pagecount;
            }
            if($right>$pagecount){
                $left = $centernum < $pagecount ? ($pagecount-$centernum+1):1;
                $right = $pagecount;
            }
            for ($i = $left; $i <= $right; $i++) {
                if ($i != $thispage){
                    if(!empty($order)){
                        if(!empty($k)&&empty($st_k)&&empty($en_k)){
                            $center .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k='.$k.'&_page=' . $i . '">' . $i . '</a></li>';
                        }elseif(empty($k)&&!empty($st_k)&&!empty($en_k)){
                            $center .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . $i . '">' . $i . '</a></li>';
                        }elseif(!empty($k)&&!empty($st_k)&&!empty($en_k)){
                            $center .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k='.$k.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . $i . '">' . $i . '</a></li>';
                        }else {
                            $center .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&_page=' . $i . '">' . $i . '</a></li>';
                        }
                    }else{
                        if(!empty($k)&&empty($st_k)&&empty($en_k)){
                            $center .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=' . $i . '">' . $i . '</a></li>';
                        }elseif(empty($k)&&!empty($st_k)&&!empty($en_k)){
                            $center .= '<li><a href="' . $url . '&r='.$r.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . $i . '">' . $i . '</a></li>';
                        }elseif(!empty($k)&&!empty($st_k)&&!empty($en_k)){
                            $center .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . $i . '">' . $i . '</a></li>';
                        }else {
                            $center .= '<li><a href="' . $url . '&r='.$r.'&_page=' . $i . '">' . $i . '</a></li>';
                        }
                    }
                }else{
                    $center .= '<li class="active"><a>'.$i.'<span class="sr-only">(current)</span></a></li>';
                }
            }
            if(!empty($order)){
                if(!empty($k)&&empty($st_k)&&empty($en_k)){
                    $next .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k='.$k.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k='.$k.'&_page=' . $pagecount . '">'.$lang_carinfo['尾页'].'</a></li>';
                }elseif(empty($k)&&!empty($st_k)&&!empty($en_k)){
                    $next .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . $pagecount . '">'.$lang_carinfo['尾页'].'</a></li>';
                }elseif(!empty($k)&&!empty($st_k)&&!empty($en_k)){
                    $next .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k='.$k.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&k='.$k.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . $pagecount . '">'.$lang_carinfo['尾页'].'</a></li>';
                }else {
                    $next .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&recommend='.$order.'&_page=' . $pagecount . '">'.$lang_carinfo['尾页'].'</a></li>';
                }
            }else{
                if(!empty($k)&&empty($st_k)&&empty($en_k)){
                    $next .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=' . $pagecount . '">'.$lang_carinfo['尾页'].'</a></li>';
                }elseif(empty($k)&&!empty($st_k)&&!empty($en_k)){
                    $next .= '<li><a href="' . $url . '&r='.$r.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . $pagecount . '">'.$lang_carinfo['尾页'].'</a></li>';
                }elseif(!empty($k)&&!empty($st_k)&&!empty($en_k)){
                    $next .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&k_start='.$st_k.'&k_end='.$en_k.'&_page=' . $pagecount . '">'.$lang_carinfo['尾页'].'</a></li>';
                }else {
                    $next .= '<li><a href="' . $url . '&r='.$r.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&_page=' . $pagecount . '">'.$lang_carinfo['尾页'].'</a></li>';
                }
            }
        }
    }
    $page .= $back.$center.$next;
    $page .='<li><a>'.$lang_carinfo['总共'].$pagecount.$lang_carinfo['页'].'</a></li></ul>';
    echo $page; //输出分页
}
?>
<title><?=$lang_carinfo['汽车信息管理']?></title>
<style>
    #recommend{
        cursor:pointer;
    }
    #region_copy{
        margin: 35px 0 0 70px;
    }
</style>
<script>
    function check_search_ci(myform) {
        myform.submit();
    }
    $(function(){
        var getRegion = localStorage.getItem('region');
        if(getRegion == null){
            localStorage.region='';
        }else {
            if (getRegion != '<?=g('r')?>') {
                window.location.href = '<?=URL?>iscaradmin/?p=carinfo&r=' + getRegion;
            }
        }
    });
    function reg(){
        var reg = $('#region option:selected').val();
        localStorage.region=reg;
        window.location.href="<?=URL?>iscaradmin/?p=carinfo&r="+reg;
        <?php setcookie('region',g('r'),time()+3600*24*365,'/story');?>
    }
</script>
</head>
<body>
<a href="<?=URL?>wp-admin" class="btn btn-primary"><?=$lang_carinfo['返回后台']?></a>
<a onclick="add()" class="btn btn-primary"><?=$lang_carinfo['新建']?></a>
<a class="btn btn-primary" id="impcar"><?=$lang_carinfo['导入汽车信息']?></a>
<select class="form-control" id="region" style="width: 150px;display: inline;" name="ci_region" onchange="reg()">
    <option value=""><?=$lang_carinfo['请选择区域']?></option>
    <?php foreach($terms_re as $v):?>
        <option value="<?=$v['keyword']?>" <?=g('r')==$v['keyword']?'selected':''?>><?=$v['value']?></option>
    <?php endforeach;?>
</select>
<div id="region_copy" style="display: none;">
    <select class="form-control" id="region_cp" style="width: 150px;display: inline;" name="ci_region">
        <?php foreach($terms_re as $v):?>
            <option value="<?=$v['keyword']?>" <?=g('r')==$v['keyword']?'selected':''?>><?=$v['value']?></option>
        <?php endforeach;?>
    </select>
</div>
<div id="body">
    <h2><?=$lang_carinfo['汽车信息管理']?></h2>
    <form name="form" action="<?=URL?>iscaradmin/?p=carinfo" method="get">
        <input type="hidden" name="p" value="carinfo">
        <input type="hidden" name="r" value="<?=g('r')?>">
        <div class="fr">
            <div class="input-group" style="width:500px;">
                <input type="text" class="form-control" name="k" placeholder="<?=$lang_carinfo['厂牌']?>/<?=$lang_carinfo['车系']?>/<?=$lang_carinfo['车款']?>/<?=$lang_carinfo['车身']?>/<?=$lang_carinfo['年份']?>">
              <span class="input-group-btn">
                <button class="btn btn-default" type="submit" onclick="return check_search_ci(form)"><?=$lang_carinfo['搜索']?></button>
                <button type="button" class="btn btn-default" id="more"><?=$lang_carinfo['更多']?>
                <span class="caret"></span>
              </span>
            </div><!-- /input-group -->
            <div id="showmore" style="display: none;">
                <table style="width: 100%;height: 80px;">
                    <tr>
                        <td>
                            <span><?=$lang_carinfo['创建起始日']?> :</span>
                        </td>
                        <td>
                            <input type="date" class="form-control" name="k_start" required>
                        </td>
                        <td>
                             ~<?=$lang_carinfo['创建截止日']?>
                        </td>
                        <td>
                            <input type="date" class="form-control" name="k_end" required>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
    <div class="mtfive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th><?=$lang_carinfo['厂牌']?></th>
                <th><?=$lang_carinfo['车系']?></th>
                <th><?=$lang_carinfo['车款']?></th>
                <th><?=$lang_carinfo['车身']?></th>
                <th><?=$lang_carinfo['年份']?></th>
                <th><?=$lang_carinfo['实际车价(万元)']?></th>
                <th width="100px"><span id="recommend"><?=$lang_carinfo['推荐车款']?><span class="<?=g('recommend')==1?'glyphicon glyphicon-chevron-up':'glyphicon glyphicon-chevron-down'?>"></span></span></th>
                <th width="150px"><?=$lang_carinfo['创建日期']?></th>
                <th width="100px"><?=$lang_carinfo['区域']?></th>
                <th><?=$lang_carinfo['操作']?></th>
            </tr>
            </thead>

            <tbody>
            <?php foreach($result as $v):?>
                <tr>
                    <td><?=$v['cb_fullname']?></td>
                    <td><?=$v['cm_fullname']?></td>
                    <td><?=$v['cs_fullname']?></td>
                    <td><?=$v['cbt_fullname']?></td>
                    <td><?=$v['ci_car_year_style']?></td>
                    <td><?=$v['ci_sale_price']?></td>
                    <td><?=$v['ci_recommend']==1?'否':'是'?></td>
                    <td><?=$v['ci_create_date']?></td>
                    <td><?=$v['ci_region']?></td>
                    <th width="180px">
                        <a onclick="detail(this)" class="btn btn-info btn-xs"><?=$lang_carinfo['详情']?></a>
                        <input type="hidden" value="<?=$v['ci_id']?>" class="cb_id">
                        <a onclick="copy(this)" class="btn btn-info btn-xs"><?=$lang_carinfo['复制']?></a>
                        <input type="hidden" value="<?=$v['ci_id']?>" class="cb_id">
                        <a onclick="edit(this)" class="btn btn-info btn-xs"><?=$lang_carinfo['编辑']?></a>
                        <input type="hidden" value="<?=$v['ci_id']?>" class="cb_id">
                        <a onclick="return confirm('<?=$lang_carinfo['您确认要删除此记录吗']?>');" href="<?=URL?>iscaradmin/?p=carinfo&a=del&id=<?=$v['ci_id']?>" class="btn btn-danger btn-xs"><?=$lang_carinfo['删除']?></a>
                    </th>
                </tr>
            <?php endforeach;?>
            </tbody>
        </table>
        <?php echo advpage($total, $thispage, PAGES, '?p=carinfo', $keyword, $st_keyword, $en_keyword, g('r'));?>
    </div>
</div>
<script>

    function add(){
        var reg = $('#region option:selected').val();
        console.log(reg);
        if($.trim(reg)) {
            layer.open({
                type: 2,
                title: '<?=$lang_carinfo['新建汽车信息']?>',
                shadeClose: true,
                shade: false,
                maxmin: true, //开启最大化最小化按钮
                area: ['1200px', '650px'],
                content: ['<?=URL?>iscaradmin/?p=carinfo&r='+reg+'&a=add&reg=' + reg, 'yes']
            });
        }else{
            layer.msg('<?=$lang_carinfo['请先选择区域']?>');
        }
    }
    function detail(e){
        var reg = $('#region option:selected').val();
        var ci_id = $(e).next('input').val();
        layer.open({
            type: 2,
            title: '<?=$lang_carinfo['汽车信息详情']?>',
            shadeClose: true,
            shade: false,
            maxmin: true, //开启最大化最小化按钮
            area: ['1000px', '600px'],
            content: ['<?=URL?>iscaradmin/?p=carinfo&r='+reg+'&a=detail&id='+ci_id+'&reg='+reg,'yes']
        });
    }
    function edit(e){
        var reg = $('#region option:selected').val();
        var ci_id = $(e).next('input').val();
        if($.trim(reg)) {
            layer.open({
                type: 2,
                title: '<?=$lang_carinfo['汽车信息编辑']?>',
                shadeClose: true,
                shade: false,
                maxmin: true, //开启最大化最小化按钮
                area: ['1200px', '650px'],
                content: ['<?=URL?>iscaradmin/?p=carinfo&r='+reg+'&a=edit&id=' + ci_id + '&reg=' + reg, 'yes']
            });
        }else{
            layer.msg('<?=$lang_carinfo['请先选择区域']?>');
        }
    }
    function copy(e){
        var ci_id = $(e).next('input').val();
        layer.open({
            type: 1,
            title: '<?=$lang_carinfo['请选择区域']?>',
            content: $('#region_copy'),
            area: ['300px', '230px'],
            btn: ['<?=$lang_carinfo['确定']?>', '<?=$lang_carinfo['取消']?>'],
            yes: function (index, layero) {
                var reg_cp = $('#region_cp').val();
                layer.open({
                    type: 2,
                    title: '<?=$lang_carinfo['复制汽车信息']?>',
                    shadeClose: true,
                    shade: false,
                    maxmin: true, //开启最大化最小化按钮
                    area: ['1200px', '650px'],
                    content: ['<?=URL?>iscaradmin/?p=carinfo&r='+reg_cp+'&a=copy&id=' + ci_id + '&reg=' + reg_cp, 'yes']
                });

                layer.close(index);
            },
            cancel: function () {
                //右上角关闭回调
            }
        });
    }
    $("#impcar").click(function(){
        var reg = $('#region option:selected').val();
        layer.open({
            type: 2,
            title: '<?=$lang_carinfo['导入汽车信息']?>',
            shadeClose: true,
            shade: false,
            maxmin: false, //开启最大化最小化按钮
            area: ['600px', '400px'],
            content: ['<?=URL?>iscaradmin/?p=carinfo&r='+reg+'&a=selectExcel','no']
        });
    });
    $("#more").click(function(){
        $("#showmore").slideToggle(200);
    });
    $("#recommend").click(function(){
        var reg = $('#region option:selected').val();
        var type='1';
        var recommend = '<?=$_GET['recommend']?>';
        var k = '<?=$_GET['k']?>';
        if(recommend == 1) type='2';
        if(k){
            window.location="<?=URL?>iscaradmin/?p=carinfo&r="+reg+"&recommend="+type+"&k="+k;
        }else{
            window.location="<?=URL?>iscaradmin/?p=carinfo&r="+reg+"&recommend="+type;
        }
    });
</script>
</body>
<?php include ('footer.php');?>