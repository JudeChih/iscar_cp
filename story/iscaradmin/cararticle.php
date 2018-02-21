<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/2
 * Time: 15:29
 */
include ('header.php');
function advpage($total, $thispage, $page_size=10, $url='', $k='', $r=''){
    global $lang_cararticle;
    
    $pagecount = ceil($total/$page_size);//总页数
    $url = empty($url) ? $_SERVER['REQUEST_URI'] : $url;
    $centernum = 5;//中间分页显示的个数
    $order = g('order');
    $page='<ul class="pagination fr">';
    if($pagecount <= 1){
        $back='';//'.$lang_cararticle['首页'].'+上一页
        $next='';//'.$lang_cararticle['尾页'].'+下一页
        $center='';
    }else{
        $back='';//'.$lang_cararticle['首页'].'+上一页
        $next='';//'.$lang_cararticle['尾页'].'+下一页
        $center='';
        if($thispage==1){
            $back .= '<li class="disabled"><a>'.$lang_cararticle['首页'].'</a></li>';
            $back .= '<li class="disabled"><a>«</a></li>';
            for($i=1;$i<=$centernum;$i++){
                if($i>$pagecount){
                    break;
                }
                if($i != $thispage){
                    if(!empty($k)){
                        if(isset($order)){
                            $center .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&k=' . $k . '&_page=' . $i . '">' . $i . '</a></li>';
                        }else {
                            $center .= '<li><a href="' . $url . '&r='.$r.'&k=' . $k . '&_page=' . $i . '">' . $i . '</a></li>';
                        }
                    }else {
                        if(isset($order)) {
                            $center .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&_page=' . $i . '">' . $i . '</a></li>';
                        }else{
                            $center .= '<li><a href="' . $url .'&r='.$r. '&_page=' . $i . '">' . $i . '</a></li>';
                        }
                    }
                }else{
                    $center .= '<li class="active"><a>'.$i.'<span class="sr-only">(current)</span></a></li>';
                }
            }
            if(!empty($k)){
                if(isset($order)){
                    $next .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&k=' . $k . '&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&k=' . $k . '&_page=' . $pagecount . '">'.$lang_cararticle['尾页'].'</a></li>';
                }else {
                    $next .= '<li><a href="' . $url . '&r='.$r.'&k=' . $k . '&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&k=' . $k . '&_page=' . $pagecount . '">'.$lang_cararticle['尾页'].'</a></li>';
                }
            }else {
                if(isset($order)){
                    $next .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&_page=' . $pagecount . '">'.$lang_cararticle['尾页'].'</a></li>';
                }else {
                    $next .= '<li><a href="' . $url . '&r='.$r.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&_page=' . $pagecount . '">'.$lang_cararticle['尾页'].'</a></li>';
                }
            }
        }elseif($thispage==$pagecount){//当前页为最后一页
            if(!empty($k)){
                if(isset($order)){
                    $back .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&k=' . $k . '&_page=1">'.$lang_cararticle['首页'].'</a></li>';
                    $back .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&k=' . $k . '&_page=' . ($thispage - 1) . '">«</a></li>';
                }else {
                    $back .= '<li><a href="' . $url . '&r='.$r.'&k=' . $k . '&_page=1">'.$lang_cararticle['首页'].'</a></li>';
                    $back .= '<li><a href="' . $url . '&r='.$r.'&k=' . $k . '&_page=' . ($thispage - 1) . '">«</a></li>';
                }
            }else {
                if(isset($order)){
                    $back .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&_page=1">'.$lang_cararticle['首页'].'</a></li>';
                    $back .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&_page=' . ($thispage - 1) . '">«</a></li>';
                }else {
                    $back .= '<li><a href="' . $url . '&r='.$r.'&_page=1">'.$lang_cararticle['首页'].'</a></li>';
                    $back .= '<li><a href="' . $url . '&r='.$r.'&_page=' . ($thispage - 1) . '">«</a></li>';
                }
            }
            for ($i=$pagecount-$centernum+1;$i<=$pagecount;$i++){
                if ($i<1){
                    $i = 1;
                }
                if ($i != $thispage){
                    if(!empty($k)){
                        if(isset($order)){
                            $center .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&k=' . $k . '&_page=' . $i . '">' . $i . '</a></li>';
                        }else {
                            $center .= '<li><a href="' . $url . '&r='.$r.'&k=' . $k . '&_page=' . $i . '">' . $i . '</a></li>';
                        }
                    }else {
                        if(isset($order)){
                            $center .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&_page=' . $i . '">' . $i . '</a></li>';
                        }else {
                            $center .= '<li><a href="' . $url . '&r='.$r.'&_page=' . $i . '">' . $i . '</a></li>';
                        }
                    }
                }else{
                    $center .= '<li class="active"><a>'.$i.'<span class="sr-only">(current)</span></a></li>';
                }
            }
            $next .= '<li class="disabled"><a>»</a></li>';
            $next .= '<li class="disabled"><a>'.$lang_cararticle['尾页'].'</a></li>';
        }else{//单页，既不是第一页也不是最后一页
            if(!empty($k)){
                if(isset($order)){
                    $back .='<li><a href="' . $url . '&r='.$r.'&order='.$order.'&k='.$k.'&_page=1">'.$lang_cararticle['首页'].'</a></li>';
                    $back .='<li><a href="' . $url .'&r='.$r. '&order='.$order.'&k='.$k.'&_page='.($thispage-1).'">«</a></li>';
                }else{
                    $back .='<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=1">'.$lang_cararticle['首页'].'</a></li>';
                    $back .='<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page='.($thispage-1).'">«</a></li>';
                }
            }else {
                if(isset($order)){
                    $back .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&_page=1">'.$lang_cararticle['首页'].'</a></li>';
                    $back .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&_page=' . ($thispage - 1) . '">«</a></li>';
                }else{
                    $back .= '<li><a href="' . $url . '&r='.$r.'&_page=1">'.$lang_cararticle['首页'].'</a></li>';
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
                    if(!empty($k)){
                        if(isset($order)){
                            $center .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&k=' . $k . '&_page=' . $i . '">' . $i . '</a></li>';
                        }else {
                            $center .= '<li><a href="' . $url . '&r='.$r.'&k=' . $k . '&_page=' . $i . '">' . $i . '</a></li>';
                        }
                    }else {
                        if(isset($order)){
                            $center .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&_page=' . $i . '">' . $i . '</a></li>';
                        }else{
                            $center .= '<li><a href="' . $url . '&r='.$r.'&_page=' . $i . '">' . $i . '</a></li>';
                        }
                    }
                }else{
                    $center .= '<li class="active"><a>'.$i.'<span class="sr-only">(current)</span></a></li>';
                }
            }
            if(!empty($k)){
                if(isset($order)){
                    $next .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&k='.$k.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&k='.$k.'&_page=' . $pagecount . '">'.$lang_cararticle['尾页'].'</a></li>';
                }else{
                    $next .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=' . $pagecount . '">'.$lang_cararticle['尾页'].'</a></li>';
                }
            }else {
                if(isset($order)){
                    $next .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&_page=' . $pagecount . '">'.$lang_cararticle['尾页'].'</a></li>';
                }else{
                    $next .= '<li><a href="' . $url . '&r='.$r.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&_page=' . $pagecount . '">'.$lang_cararticle['尾页'].'</a></li>';
                }
            }
        }
    }
    $page .= $back.$center.$next;
    $page .='<li><a>'.$lang_cararticle['总共'].$pagecount.$lang_cararticle['页'].'</a></li></ul>';
    echo $page; //输出分页

}
?>
<title><?=$lang_cararticle['汽车文章关联管理']?></title>
<script>
    $(function(){
        var getRegion = localStorage.getItem('region');
        if(getRegion == null){
            localStorage.region='';
        }else {
            if (getRegion != '<?=g('r')?>') {
                window.location.href = '<?=URL?>iscaradmin/?p=cararticle&r=' + getRegion;
            }
        }
    });
    function reg(){
        var reg = $('#region option:selected').val();
        localStorage.region=reg;
        window.location.href="<?=URL?>iscaradmin/?p=cararticle&r="+reg;
        <?php setcookie('region',g('r'),time()+3600*24*365,'/story');?>
    }
</script>
</head>
<body>
<a href="<?=URL?>wp-admin" class="btn btn-primary"><?=$lang_cararticle['返回后台']?></a>
<a onclick="add()" class="btn btn-primary"><?=$lang_cararticle['新建文章关联汽车']?></a>
<a onclick="add_oth()" class="btn btn-primary"><?=$lang_cararticle['新建汽车关联文章']?></a>
<select class="form-control" id="region" style="width: 150px;display: inline;"  onchange="reg()">
    <option value=""><?=$lang_cararticle['请选择区域']?></option>
    <?php foreach($terms_re as $v):?>
        <option value="<?=$v['keyword']?>" <?=g('r')==$v['keyword']?'selected':''?>><?=$v['value']?></option>
    <?php endforeach;?>
</select>
<div id="body">
    <h2><?=$lang_cararticle['汽车文章关联管理']?></h2>
    <form name="form" action="<?=URL?>iscaradmin/?p=cararticle" method="get">
        <input type="hidden" name="p" value="cararticle">
        <input type="hidden" name="r" value="<?=g('r')?>">
        <div class="input-group fr" style="width:300px;">
            <input type="text" class="form-control" name="k" placeholder="<?=$lang_cararticle['文章标题']?>/<?=$lang_cararticle['汽车信息']?>">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><?=$lang_cararticle['搜索']?></button>
          </span>
        </div><!-- /input-group -->
    </form>
    <div class="mtfive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th><?=$lang_cararticle['文章标题']?></th>
                <th><?=$lang_cararticle['汽车信息']?></th>
                <th width="180px"><?=$lang_cararticle['创建日期']?></th>
                <th><?=$lang_cararticle['操作']?></th>
            </tr>
            </thead>

            <tbody>
            <?php foreach($result as $v):?>
                <tr>
                    <td><?=$v['post_title']?></td>
                    <td><?=$v['car_title']?></td>
                    <td width="120px"><?=$v['last_update_date']?></td>
                    <td width="150px">
                        <a onclick="edit(this)" class="btn btn-info btn-xs"><?=$lang_cararticle['编辑']?></a>
                        <input type="hidden" value="<?=$v['id']?>" class="id">
                        <a onclick="return confirm('<?=$lang_cararticle['您确认要删除此记录吗']?>');" href="<?=URL?>iscaradmin/?p=cararticle&a=del&id=<?=$v['id']?>" class="btn btn-danger btn-xs"><?=$lang_cararticle['删除']?></a>
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>

        </table>
        <?php echo advpage($total, $thispage, PAGES, '?p=cararticle', $keyword, g('r'));?>
    </div>
</div>
<script>
    function add(){
        var reg = $('#region option:selected').val();
        if($.trim(reg)) {
            layer.open({
                type: 2,
                title: '<?=$lang_cararticle['新建文章关联汽车']?>',
                shadeClose: true,
                shade: false,
                maxmin: true, //开启最大化最小化按钮
                area: ['1100px', '600px'],
                content: ['<?=URL?>iscaradmin/?p=cararticle&r=' + reg + '&a=add', 'yes']
            });
        }else{
            layer.msg('<?=$lang_cararticle['请先选择区域']?>');
        }
    }
    function add_oth(){
        var reg = $('#region option:selected').val();
        if($.trim(reg)) {
            layer.open({
                type: 2,
                title: '<?=$lang_cararticle['新建汽车关联文章']?>',
                shadeClose: true,
                shade: false,
                maxmin: true, //开启最大化最小化按钮
                area: ['1100px', '600px'],
                content: ['<?=URL?>iscaradmin/?p=cararticle&r=' + reg + '&a=add_oth', 'yes']
            });
        }else{
            layer.msg('<?=$lang_cararticle['请先选择区域']?>');
        }
    }
    function edit(e){
        var reg = $('#region option:selected').val();
        var id = $(e).next('input').val();
        if($.trim(reg)) {
            layer.open({
                type: 2,
                title: '<?=$lang_cararticle['文章关联编辑']?>',
                shadeClose: true,
                shade: false,
                maxmin: true, //开启最大化最小化按钮
                area: ['800px', '600px'],
                content: ['<?=URL?>iscaradmin/?p=cararticle&r=' + reg + '&a=edit&id=' + id, 'yes']
            });
        }else{
            layer.msg('<?=$lang_cararticle['请先选择区域']?>');
        }
    }
</script>
</body>
<?php include ('footer.php');?>