<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/2
 * Time: 15:29
 */
include ('header.php');
?>
<title><?=$lang_mylogs['用户日志']?></title>
<script>
    $(function(){
        var getRegion = localStorage.getItem('region');
        if(getRegion == null){
            localStorage.region='';
        }else {
            if (getRegion != '<?=g('r')?>') {
                window.location.href = '<?=URL?>iscaradmin/?p=mylogs&r=' + getRegion;
            }
        }
    });
    function reg(){
        var reg = $('#region option:selected').val();
        localStorage.region=reg;
        window.location.href="<?=URL?>iscaradmin/?p=mylogs&r="+reg;
        <?php setcookie('region',g('r'),time()+3600*24*365,'/story');?>
    }
</script>
</head>
<body>
<a href="<?=URL?>wp-admin" class="btn btn-primary"><?=$lang_mylogs['返回后台']?></a>
<select class="form-control" id="region" style="width: 150px;display: inline;"  onchange="reg()">
    <option value=""><?=$lang_mylogs['请选择区域']?></option>
    <?php foreach($terms_re as $v):?>
        <option value="<?=$v['keyword']?>" <?=g('r')==$v['keyword']?'selected':''?>><?=$v['value']?></option>
    <?php endforeach;?>
</select>
<div id="body">
    <h2><?=$lang_mylogs['用户日志']?></h2>
    <form name="form" action="<?=URL?>iscaradmin/?p=mylogs" method="get">
        <input type="hidden" name="p" value="mylogs">
        <input type="hidden" name="r" value="<?=g('r')?>">
        <div class="input-group fr" style="width:400px;">
            <input type="text" class="form-control" name="k" placeholder="<?=$lang_mylogs['用户名称']?>/<?=$lang_mylogs['log创建时间']?>(<?=$lang_mylogs['例']?>:2017-01-01)">
          <span class="input-group-btn">
            <button class="btn btn-default" type="submit"><?=$lang_mylogs['搜索']?></button>
          </span>
        </div><!-- /input-group -->
    </form>
    <div class="mtfive">
        <table class="table table-striped">
            <thead>
            <tr>
                <th width="150px"><?=$lang_mylogs['用户名称']?></th>
                <th width="180px"><?=$lang_mylogs['log创建时间']?></th>
                <th width="260px"><?=$lang_mylogs['log类型']?></th>
                <th><?=$lang_mylogs['说明']?></th>
            </tr>
            </thead>

            <tbody>
            <?php foreach($result as $v):?>
                <tr>
                    <td><?=$v['uid']?></td>
                    <td><?=$v['create_date']?></td>
                    <td><?=$v['log_type']?></td>
                    <td><?=$v['remark']?></td>
                </tr>
            <?php endforeach;?>
            </tbody>

        </table>
        <ul class="pagination fr">
            <?php echo $page?>
        </ul>
    </div>
</div>
</body>
<?php include ('footer.php');?>