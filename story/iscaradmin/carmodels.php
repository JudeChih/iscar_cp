<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/2
 * Time: 15:29
 */
include ('header.php');
function advpage($total, $thispage, $page_size=10, $url='', $k='', $r=''){
    global $lang_carmodels;
    
    $pagecount = ceil($total/$page_size);//总页数
    $url = empty($url) ? $_SERVER['REQUEST_URI'] : $url;
    $centernum = 5;//中间分页显示的个数
    $order = g('order');
    $page='<ul class="pagination fr">';
    if($pagecount <= 1){
        $back='';//'.$lang_carmodels['首页'].'+上一页
        $next='';//'.$lang_carmodels['尾页'].'+下一页
        $center='';
    }else{
        $back='';//'.$lang_carmodels['首页'].'+上一页
        $next='';//'.$lang_carmodels['尾页'].'+下一页
        $center='';
        if($thispage==1){
            $back .= '<li class="disabled"><a>'.$lang_carmodels['首页'].'</a></li>';
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
                            $center .= '<li><a href="' . $url . '&r='.$r.'&_page=' . $i . '">' . $i . '</a></li>';
                        }
                    }
                }else{
                    $center .= '<li class="active"><a>'.$i.'<span class="sr-only">(current)</span></a></li>';
                }
            }
            if(!empty($k)){
                if(isset($order)){
                    $next .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&k=' . $k . '&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&k=' . $k . '&_page=' . $pagecount . '">'.$lang_carmodels['尾页'].'</a></li>';
                }else {
                    $next .= '<li><a href="' . $url . '&r='.$r.'&k=' . $k . '&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&k=' . $k . '&_page=' . $pagecount . '">'.$lang_carmodels['尾页'].'</a></li>';
                }
            }else {
                if(isset($order)){
                    $next .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&_page=' . $pagecount . '">'.$lang_carmodels['尾页'].'</a></li>';
                }else {
                    $next .= '<li><a href="' . $url . '&r='.$r.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&_page=' . $pagecount . '">'.$lang_carmodels['尾页'].'</a></li>';
                }
            }
        }elseif($thispage==$pagecount){//当前页为最后一页
            if(!empty($k)){
                if(isset($order)){
                    $back .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&k=' . $k . '&_page=1">'.$lang_carmodels['首页'].'</a></li>';
                    $back .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&k=' . $k . '&_page=' . ($thispage - 1) . '">«</a></li>';
                }else {
                    $back .= '<li><a href="' . $url . '&r='.$r.'&k=' . $k . '&_page=1">'.$lang_carmodels['首页'].'</a></li>';
                    $back .= '<li><a href="' . $url . '&r='.$r.'&k=' . $k . '&_page=' . ($thispage - 1) . '">«</a></li>';
                }
            }else {
                if(isset($order)){
                    $back .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&_page=1">'.$lang_carmodels['首页'].'</a></li>';
                    $back .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&_page=' . ($thispage - 1) . '">«</a></li>';
                }else {
                    $back .= '<li><a href="' . $url . '&r='.$r.'&_page=1">'.$lang_carmodels['首页'].'</a></li>';
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
            $next .= '<li class="disabled"><a>'.$lang_carmodels['尾页'].'</a></li>';
        }else{//单页，既不是第一页也不是最后一页
            if(!empty($k)){
                if(isset($order)){
                    $back .='<li><a href="' . $url . '&r='.$r.'&order='.$order.'&k='.$k.'&_page=1">'.$lang_carmodels['首页'].'</a></li>';
                    $back .='<li><a href="' . $url . '&r='.$r.'&order='.$order.'&k='.$k.'&_page='.($thispage-1).'">«</a></li>';
                }else{
                    $back .='<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=1">'.$lang_carmodels['首页'].'</a></li>';
                    $back .='<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page='.($thispage-1).'">«</a></li>';
                }
            }else {
                if(isset($order)){
                    $back .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&_page=1">'.$lang_carmodels['首页'].'</a></li>';
                    $back .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&_page=' . ($thispage - 1) . '">«</a></li>';
                }else{
                    $back .= '<li><a href="' . $url . '&r='.$r.'&_page=1">'.$lang_carmodels['首页'].'</a></li>';
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
                    $next .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&k='.$k.'&_page=' . $pagecount . '">'.$lang_carmodels['尾页'].'</a></li>';
                }else{
                    $next .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&k='.$k.'&_page=' . $pagecount . '">'.$lang_carmodels['尾页'].'</a></li>';
                }
            }else {
                if(isset($order)){
                    $next .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&order='.$order.'&_page=' . $pagecount . '">'.$lang_carmodels['尾页'].'</a></li>';
                }else{
                    $next .= '<li><a href="' . $url . '&r='.$r.'&_page=' . ($thispage + 1) . '">»</a></li>';
                    $next .= '<li><a href="' . $url . '&r='.$r.'&_page=' . $pagecount . '">'.$lang_carmodels['尾页'].'</a></li>';
                }
            }
        }
    }
    $page .= $back.$center.$next;
    $page .='<li><a>'.$lang_carmodels['总共'].$pagecount.$lang_carmodels['页'].'</a></li></ul>';
    echo $page; //输出分页

}
?>
<title><?=$lang_carmodels['车系管理']?></title>
<style>
    #list{
        cursor: pointer;
    }
</style>
<script>
    $(function(){
        var getRegion = localStorage.getItem('region');
        if(getRegion == null){
            localStorage.region='';
        }else {
            if (getRegion != '<?=g('r')?>') {
                window.location.href = '<?=URL?>iscaradmin/?p=carmodels&r=' + getRegion;
            }
        }
    });
    function reg(){
        var reg = $('#region option:selected').val();
        localStorage.region=reg;
        window.location.href="<?=URL?>iscaradmin/?p=carmodels&r="+reg;
        <?php setcookie('region',g('r'),time()+3600*24*365,'/story');?>
    }
</script>
</head>
<body>
<a href="<?=URL?>wp-admin" class="btn btn-primary"><?=$lang_carmodels['返回后台']?></a>
<a onclick="add()" class="btn btn-primary"><?=$lang_carmodels['新建']?></a>
<select class="form-control" id="region" style="width: 150px;display: inline;" name="cm_region" onchange="reg()">
    <option value=""><?=$lang_carmodels['请选择区域']?></option>
    <?php foreach($terms_re as $v):?>
        <option value="<?=$v['keyword']?>" <?=g('r')==$v['keyword']?'selected':''?>><?=$v['value']?></option>
    <?php endforeach;?>
</select>
<div id="body">
    <h2><?=$lang_carmodels['车系管理']?></h2>
    <form name="form" action="<?=URL?>iscaradmin/?p=carmodels" method="get">
        <input type="hidden" name="p" value="carmodels">
        <input type="hidden" name="r" value="<?=g('r')?>">
        <div class="input-group fr" style="width:300px;">
            <input type="text" class="form-control" name="k" placeholder="<?=$lang_carmodels['厂牌']?>/<?=$lang_carmodels['车系']?>">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><?=$lang_carmodels['搜索']?></button>
          </span>
        </div><!-- /input-group -->
    </form>
    <div class="mtfive">
        <table class="table table-striped">
            <thead>
            <tr>
<!--                <th width="100px" ><span id="list">--><?//=$lang_carmodels['序号']?><!--<span class="--><?//=g('order')==1?'glyphicon glyphicon-chevron-up':'glyphicon glyphicon-chevron-down'?><!--"></span></span></th>-->
                <th width="200px"><?=$lang_carmodels['厂牌']?></th>
                <th width="200px"><?=$lang_carmodels['车系']?></th>
                <th width="150px"><?=$lang_carmodels['车系昵称']?></th>
                <th width="150px"><?=$lang_carmodels['缩写']?></th>
                <th width="100px"><?=$lang_carmodels['热门']?></th>
                <th width="180px"><?=$lang_carmodels['创建日期']?></th>
                <th width="100px"><?=$lang_carmodels['区域']?></th>
                <th><?=$lang_carmodels['操作']?></th>
            </tr>
            </thead>

            <tbody>
            <?php foreach($result as $v):?>
                <tr>
<!--                    <td>--><?//=$v['cm_list_order']?><!--</td>-->
                    <td><?=$v['cb_fullname']?></td>
                    <td><?=$v['cm_fullname']?></td>
                    <td><?=$v['cm_nickname']?></td>
                    <td><?=$v['cm_short_name']?></td>
                    <th><?=$v['cm_hot_item_tag'] == 1 ?  '否' : '是'?></th>
                    <td><?=$v['cm_create_date']?></td>
                    <td><?=$v['cm_region']?></td>
                    <td width="150px">
                        <a onclick="detail(this)" class="btn btn-info btn-xs"><?=$lang_carmodels['详情']?></a>
                        <input type="hidden" value="<?=$v['cm_id']?>" class="cb_id">
                        <a onclick="edit(this)" class="btn btn-info btn-xs"><?=$lang_carmodels['编辑']?></a>
                        <input type="hidden" value="<?=$v['cm_id']?>" class="cb_id">
                        <a onclick="del(this)" class="btn btn-danger btn-xs"><?=$lang_carmodels['删除']?></a>
                        <input type="hidden" value="<?=$v['cm_id']?>" class="cm_id">
                    </td>
                </tr>
            <?php endforeach;?>
            </tbody>

        </table>
        <?php echo advpage($total, $thispage, PAGES, '?p=carmodels', $keyword, g('r'));?>
    </div>
</div>
<script>
    function add(){
        var reg = $('#region option:selected').val();
        if($.trim(reg)) {
            layer.open({
                type: 2,
                title: '<?=$lang_carmodels['新建车系']?>',
                shadeClose: true,
                shade: false,
                maxmin: true, //开启最大化最小化按钮
                area: ['800px', '600px'],
                content: ['<?=URL?>iscaradmin/?p=carmodels&r='+reg+'&a=add&reg=' + reg, 'yes']
            });
        }else{
            layer.msg('<?=$lang_carmodels['请先选择区域']?>');
        }
    }
    function detail(e){
        var reg = $('#region option:selected').val();
        var cb_id = $(e).next('input').val();
        layer.open({
            type: 2,
            title: '<?=$lang_carmodels['车系详情']?>',
            shadeClose: true,
            shade: false,
            maxmin: true, //开启最大化最小化按钮
            area: ['800px', '600px'],
            content: ['<?=URL?>iscaradmin/?p=carmodels&r='+reg+'&a=detail&id='+cb_id+'&reg='+reg,'yes']
        });
    }
    function edit(e){
        var reg = $('#region option:selected').val();
        var cb_id = $(e).next('input').val();
        if($.trim(reg)) {
            layer.open({
                type: 2,
                title: '<?=$lang_carmodels['车系编辑']?>',
                shadeClose: true,
                shade: false,
                maxmin: true, //开启最大化最小化按钮
                area: ['800px', '600px'],
                content: ['<?=URL?>iscaradmin/?p=carmodels&r='+reg+'&a=edit&id=' + cb_id + '&reg=' + reg, 'yes']
            });
        }else{
            layer.msg('<?=$lang_carmodels['请先选择区域']?>');
        }
    }
    $("#list").click(function(){
        var type='1';
        var order = '<?=$_GET['order']?>';
        var k = '<?=$_GET['k']?>';
        var r = '<?=$_GET['r']?>';
        if(order == 1) type='2';
        if(k){
            window.location="<?=URL?>iscaradmin/?p=carmodels&r="+r+"&order="+type+"&k="+k;
        }else{
            window.location="<?=URL?>iscaradmin/?p=carmodels&r="+r+"&order="+type;
        }
    });
    function del(e){
        var cm_id = $(e).next('input').val();
        console.log(cm_id);
        $.ajax({
            url:'<?=URL?>iscaradmin/?p=carmodels',
            type:'post',
            data:{'a':'del','id':cm_id,'v':'verify'},
            dataType:'json',
            error:function(){
                layer.msg('<?=$lang_carmodels['删除失败']?>',{icon:2});
            },
            success:function(res){
                if(res.data==1){
                    layer.confirm('<?=$lang_carmodels['确定删除吗']?>', {icon: 3, title:'<?=$lang_carmodels['提示']?>'}, function(index){
                        $.ajax({
                            url:'<?=URL?>iscaradmin/?p=carmodels',
                            type:'post',
                            data:{'a':'del','id':cm_id},
                            dataType:'json',
                            error:function(){
                                layer.msg('<?=$lang_carmodels['删除失败']?>',{icon:2});
                            },
                            success:function(res){
                                if(res.data==3) {
                                    layer.msg('<?=$lang_carmodels['删除成功']?>', {icon: 6},function(){
                                        window.location.reload();
                                    });
                                }else{
                                    layer.msg('<?=$lang_carmodels['删除失败']?>', {icon: 2});
                                }
                            }
                        });

                        layer.close(index);
                    });
                }else if(res.data==2){
                    layer.msg('<?=$lang_carmodels['下级存在数据']?>',{icon:2});
                }
            }
        });
    }
</script>
</body>
<?php include ('footer.php');?>