<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/8
 * Time: 17:22
 */
include ('header.php');
function advpage($total, $thispage, $page_size=10, $url='', $k='', $r=''){
    global $lang_carterms;
    
    $pagecount = ceil($total/$page_size);//总页数
    $url = empty($url) ? $_SERVER['REQUEST_URI'] : $url;
    $centernum = 5;//中间分页显示的个数
    $page='<ul class="pagination fr">';
    if($pagecount <= 1){
        $back='';//'.$lang_carterms['首页'].'+上一页
        $next='';//'.$lang_carterms['尾页'].'+下一页
        $center='';
    }else{
        $back='';//'.$lang_carterms['首页'].'+上一页
        $next='';//'.$lang_carterms['尾页'].'+下一页
        $center='';
        if($thispage==1){
            $back .= '<li class="disabled"><a>'.$lang_carterms['首页'].'</a></li>';
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
                $next .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=' . $pagecount . '">'.$lang_carterms['尾页'].'</a></li>';
            }else {
                $next .= '<li><a href="' . $url . '&r='.$r.'&_page=' . ($thispage + 1) . '">»</a></li>';
                $next .= '<li><a href="' . $url . '&r='.$r.'&_page=' . $pagecount . '">'.$lang_carterms['尾页'].'</a></li>';
            }
        }elseif($thispage==$pagecount){//当前页为最后一页
            if(!empty($k)){
                $back .='<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=1">'.$lang_carterms['首页'].'</a></li>';
                $back .='<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page='.($thispage-1).'">«</a></li>';
            }else {
                $back .= '<li><a href="' . $url . '&r='.$r.'&_page=1">'.$lang_carterms['首页'].'</a></li>';
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
            $next .= '<li class="disabled"><a>'.$lang_carterms['尾页'].'</a></li>';
        }else{//单页，既不是第一页也不是最后一页
            if(!empty($k)){
                $back .='<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=1">'.$lang_carterms['首页'].'</a></li>';
                $back .='<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page='.($thispage-1).'">«</a></li>';
            }else {
                $back .= '<li><a href="' . $url . '&r='.$r.'&_page=1">'.$lang_carterms['首页'].'</a></li>';
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
                $next .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=' . $pagecount . '">'.$lang_carterms['尾页'].'</a></li>';
            }else {
                $next .= '<li><a href="' . $url . '&r='.$r.'&_page=' . ($thispage + 1) . '">»</a></li>';
                $next .= '<li><a href="' . $url . '&r='.$r.'&_page=' . $pagecount . '">'.$lang_carterms['尾页'].'</a></li>';
            }
        }
    }
    $page .= $back.$center.$next;
    $page .='<li><a>'.$lang_carterms['总共'].$pagecount.$lang_carterms['页'].'</a></li></ul>';
    echo $page; //输出分页

}
?>
<title><?=$lang_carterms['预设参数设置']?></title>
<script>
    $(function(){
        var getRegion = localStorage.getItem('region');
        if(getRegion == null){
            localStorage.region='';
        }else {
            if (getRegion != '<?=g('r')?>') {
                window.location.href = '<?=URL?>iscaradmin/?p=carterms&r=' + getRegion;
            }
        }
    });
    function reg(){
        var reg = $('#region option:selected').val();
        localStorage.region=reg;
        window.location.href="<?=URL?>iscaradmin/?p=carterms&r="+reg;
        <?php setcookie('region',g('r'),time()+3600*24*365,'/story');?>
    }
</script>
</head>
<body>
<a href="<?=URL?>wp-admin" class="btn btn-primary"><?=$lang_carterms['返回后台']?></a>
<a onclick="add()" class="btn btn-primary"><?=$lang_carterms['新建']?></a>
<select class="form-control" id="region" style="width: 150px;display: inline;" name="cm_region" onchange="reg()">
    <option value=""><?=$lang_carterms['请选择区域']?></option>
    <?php foreach($terms_re as $v):?>
        <option value="<?=$v['keyword']?>" <?=g('r')==$v['keyword']?'selected':''?>><?=$v['value']?></option>
    <?php endforeach;?>
</select>
<div id="body">
    <h2><?=$lang_carterms['预设参数设置']?></h2>
    <form name="form" action="<?=URL?>iscaradmin/?p=carterms" method="get">
        <input type="hidden" name="p" value="carterms">
        <input type="hidden" name="r" value="<?=g('r')?>">
        <div class="input-group fr" style="width:300px;">
            <input type="text" class="form-control" name="k" placeholder="<?=$lang_carterms['简体中文参数名称']?>">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><?=$lang_carterms['搜索']?></button>
          </span>
        </div><!-- /input-group -->
    </form>
    <div class="mtfive">
        <table class="table table-striped" >
            <thead>
            <tr>
                <th><?=$lang_carterms['参数名称']?></th>
                <th>key</th>
                <th><?=$lang_carterms['值']?></th>
                <th><?=$lang_carterms['创建时间']?></th>
                <th><?=$lang_carterms['区域']?></th>
                <th><?=$lang_carterms['操作']?></th>
            </tr>
            </thead>

            <tbody>
            <?php foreach($result as $v):?>
                <tr>
                    <td><?=$lang_carterms[$v['term']]?></td>
                    <td><?=$v['keyword']?></td>
                    <td><?=$v['value']?></td>
                    <td><?=$v['last_update_date']?></td>
                    <td><?=$v['ct_region']?></td>
                    <th width="150px">
                        <a onclick="edit(this)" class="btn btn-info btn-xs"><?=$lang_carterms['编辑']?></a>
                        <input type="hidden" value="<?=$v['id']?>" class="cb_id">
                        <!--<a onclick="del(this)" class="btn btn-danger btn-xs"><?/*=$lang_carterms['删除']*/?></a>
                        <input type="hidden" value="<?/*=$v['id']*/?>" class="cb_id">-->
                    </th>
                </tr>
            <?php endforeach;?>
            </tbody>

        </table>
        <?php echo advpage($total, $thispage, PAGES, '?p=carterms', $keyword, g('r'));?>
    </div>
</div>
<script>
    function add(){
        var reg = $('#region option:selected').val();
        if($.trim(reg)) {
            layer.open({
                type: 2,
                title: '<?=$lang_carterms['新建系统预设参数']?>',
                shadeClose: true,
                shade: false,
                maxmin: true, //开启最大化最小化按钮
                area: ['800px', '600px'],
                content: ['<?=URL?>iscaradmin/?p=carterms&r='+reg+'&a=add&reg=' + reg, 'yes']
            });
        }else{
            layer.msg('<?=$lang_carterms['请先选择区域']?>');
        }
    }
    function edit(e){
        var reg = $('#region option:selected').val();
        var id = $(e).next('input').val();
        if($.trim(reg)) {
            layer.open({
                type: 2,
                title: '<?=$lang_carterms['系统预设参数编辑']?>',
                shadeClose: true,
                shade: false,
                maxmin: true, //开启最大化最小化按钮
                area: ['800px', '600px'],
                content: ['<?=URL?>iscaradmin/?p=carterms&r='+reg+'&a=edit&id=' + id + '&reg=' + reg, 'yes']
            });
        }else{
            layer.msg('<?=$lang_carterms['请先选择区域']?>');
        }
    }
    /*function del(e){
        var id = $(e).next('input').val();
        layer.open({
            title: '<?=$lang_carterms['提示']?>',
            btn: ['<?=$lang_carterms['确定']?>', '<?=$lang_carterms['删除']?>'],
            content: '<?=$lang_carterms['检查']?>',
            btn2:function(index,layero){
                $.ajax({
                    url:'<?=URL?>iscaradmin/?p=carterms',
                    type:'post',
                    data:{'a':'del', 'id':id},
                    dataType:'json',
                    error:function(){
                        layer.msg('<?=$lang_carterms['删除失败']?>',{icon:2});
                    },
                    success:function(res){
                        if(res.data==1) {
                            layer.msg('<?=$lang_carterms['删除成功']?>', {icon: 6}, function () {
                            window.location.reload();
                            });
                        }else{
                            layer.msg('<?=$lang_carterms['删除失败']?>',{icon:2});
                        }
                    }
                });
            }
        });
    }*/
</script>
</body>
<?php include ('footer.php');?>