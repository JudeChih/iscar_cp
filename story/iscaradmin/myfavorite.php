<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/2
 * Time: 15:29
 */
include ('header.php');
function advpage($total, $thispage, $page_size=10, $url='', $k='', $r=''){
    global $lang_myfavorite;

    $pagecount = ceil($total/$page_size);//总页数
    $url = empty($url) ? $_SERVER['REQUEST_URI'] : $url;
    $centernum = 5;//中间分页显示的个数
    $page='<ul class="pagination fr">';
    if($pagecount <= 1){
        $back='';//'.$lang_myfavorite['首页'].'+上一页
        $next='';//'.$lang_myfavorite['尾页'].'+下一页
        $center='';
    }else{
        $back='';//'.$lang_myfavorite['首页'].'+上一页
        $next='';//'.$lang_myfavorite['尾页'].'+下一页
        $center='';
        if($thispage==1){
            $back .= '<li class="disabled"><a>'.$lang_myfavorite['首页'].'</a></li>';
            $back .= '<li class="disabled"><a>«</a></li>';
            for($i=1;$i<=$centernum;$i++){
                if($i>$pagecount){
                    break;
                }
                if($i != $thispage){
                    if(!empty($k)){
                        $center .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=' . $i . '">' . $i . '</a></li>';
                    }else {
                        $center .= '<li><a href="' . $url . '&r='.$r.'&_page=' . $i . '">' . $i . '</a></li>';
                    }
                }else{
                    $center .= '<li class="active"><a>'.$i.'<span class="sr-only">(current)</span></a></li>';
                }
            }
            if(!empty($k)){
                $next .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=' . ($thispage + 1) . '">»</a></li>';
                $next .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=' . $pagecount . '">'.$lang_myfavorite['尾页'].'</a></li>';
            }else {
                $next .= '<li><a href="' . $url . '&r='.$r.'&_page=' . ($thispage + 1) . '">»</a></li>';
                $next .= '<li><a href="' . $url . '&r='.$r.'&_page=' . $pagecount . '">'.$lang_myfavorite['尾页'].'</a></li>';
            }
        }elseif($thispage==$pagecount){//当前页为最后一页
            if(!empty($k)){
                $back .='<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=1">'.$lang_myfavorite['首页'].'</a></li>';
                $back .='<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page='.($thispage-1).'">«</a></li>';
            }else {
                $back .= '<li><a href="' . $url . '&r='.$r.'&_page=1">'.$lang_myfavorite['首页'].'</a></li>';
                $back .= '<li><a href="' . $url . '&r='.$r.'&_page=' . ($thispage - 1) . '">«</a></li>';
            }
            for ($i=$pagecount-$centernum+1;$i<=$pagecount;$i++){
                if ($i<1){
                    $i = 1;
                }
                if ($i != $thispage){
                    if(!empty($k)){
                        $center .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=' . $i . '">' . $i . '</a></li>';
                    }else {
                        $center .= '<li><a href="' . $url . '&r='.$r.'&_page=' . $i . '">' . $i . '</a></li>';
                    }
                }else{
                    $center .= '<li class="active"><a>'.$i.'<span class="sr-only">(current)</span></a></li>';
                }
            }
            $next .= '<li class="disabled"><a>»</a></li>';
            $next .= '<li class="disabled"><a>'.$lang_myfavorite['尾页'].'</a></li>';
        }else{//单页，既不是第一页也不是最后一页
            if(!empty($k)){
                $back .='<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=1">'.$lang_myfavorite['首页'].'</a></li>';
                $back .='<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page='.($thispage-1).'">«</a></li>';
            }else {
                $back .= '<li><a href="' . $url . '&r='.$r.'&_page=1">'.$lang_myfavorite['首页'].'</a></li>';
                $back .= '<li><a href="' . $url . '&r='.$r.'&_page=' . ($thispage - 1) . '">«</a></li>';
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
                    if(!empty($k)){
                        $center .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=' . $i . '">' . $i . '</a></li>';
                    }else {
                        $center .= '<li><a href="' . $url . '&r='.$r.'&_page=' . $i . '">' . $i . '</a></li>';
                    }
                }else{
                    $center .= '<li class="active"><a>'.$i.'<span class="sr-only">(current)</span></a></li>';
                }
            }
            if(!empty($k)){
                $next .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=' . ($thispage + 1) . '">»</a></li>';
                $next .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=' . $pagecount . '">'.$lang_myfavorite['尾页'].'</a></li>';
            }else {
                $next .= '<li><a href="' . $url . '&r='.$r.'&_page=' . ($thispage + 1) . '">»</a></li>';
                $next .= '<li><a href="' . $url . '&r='.$r.'&_page=' . $pagecount . '">'.$lang_myfavorite['尾页'].'</a></li>';
            }
        }
    }
    $page .= $back.$center.$next;
    $page .='<li><a>'.$lang_myfavorite['总共'].$pagecount.$lang_myfavorite['页'].'</a></li></ul>';
    echo $page; //输出分页

}
?>
<title><?=$lang_myfavorite['用户收藏']?></title>
<script>
    $(function(){
        var getRegion = localStorage.getItem('region');
        if(getRegion == null){
            localStorage.region='';
        }else {
            if (getRegion != '<?=g('r')?>') {
                window.location.href = '<?=URL?>iscaradmin/?p=myfavorite&r=' + getRegion;
            }
        }
    });
    function reg(){
        var reg = $('#region option:selected').val();
        localStorage.region=reg;
        window.location.href="<?=URL?>iscaradmin/?p=myfavorite&r="+reg;
        <?php setcookie('region',g('r'),time()+3600*24*365,'/story');?>
    }
</script>
</head>
<body>
<a href="<?=URL?>wp-admin" class="btn btn-primary"><?=$lang_myfavorite['返回后台']?></a>
<select class="form-control" id="region" style="width: 150px;display: inline;"  onchange="reg()">
    <option value=""><?=$lang_myfavorite['请选择区域']?></option>
    <?php foreach($terms_re as $v):?>
        <option value="<?=$v['keyword']?>" <?=g('r')==$v['keyword']?'selected':''?>><?=$v['value']?></option>
    <?php endforeach;?>
</select>
<div id="body">
    <h2><?=$lang_myfavorite['用户收藏']?></h2>
    <form name="form" action="<?=URL?>iscaradmin/?p=myfavorite" method="get">
        <input type="hidden" name="p" value="myfavorite">
        <input type="hidden" name="r" value="<?=g('r')?>">
        <div class="input-group fr" style="width:300px;">
            <input type="text" class="form-control" name="k" placeholder="<?=$lang_myfavorite['用户名称']?>">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><?=$lang_myfavorite['搜索']?></button>
          </span>
        </div><!-- /input-group -->
    </form>
    <div class="mtfive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th width="100px" ><?=$lang_myfavorite['用户']?>id</th>
                <th width="150px"><?=$lang_myfavorite['用户名称']?></th>
                <th><?=$lang_myfavorite['收藏对象']?></th>
                <th width="180px"><?=$lang_myfavorite['创建时间']?></th>
            </tr>
            </thead>

            <tbody>
            <?php foreach($result as $v):?>
                <tr>
                    <td><?=$v['uid']?></td>
                    <td><?=$v['user_login']?></td>
                    <td><?=$v['object']?></td>
                    <td><?=$v['create_date']?></td>
                </tr>
            <?php endforeach;?>
            </tbody>

        </table>
        <?php echo advpage($total, $thispage, PAGES, '?p=myfavorite', $keyword, g('r'));?>
    </div>
</div>
</body>
<?php include ('footer.php');?>