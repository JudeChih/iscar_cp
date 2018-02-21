<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/2
 * Time: 15:29
 */
include ('header.php');
?>
<title><?=$lang_carmodels['车系管理']?></title>
</head>
<body>
<h2><?=$lang_carmodels['汽车车系详情']?></h2>
<div style="max-width: 1000px;margin: auto" align="center">
    <table width="100%" style="line-height: 18px;">
        <tr>
<!--            <td><h4>--><?//=$lang_carmodels['序号']?><!--:--><?//=$post['cm_list_order']?><!--</h4></td>-->
            <td><h4><?=$lang_carmodels['厂牌名称']?>:<?=$post['cb_fullname']?></h4></td>
        </tr>
        <tr>
            <td><h4><?=$lang_carmodels['车系名称']?>:<?=$post['cm_fullname']?></h4></td>
            <td><h4><?=$lang_carmodels['车系昵称']?>:<?=$post['cm_nickname']?></h4></td>
        </tr>
        <tr>
            <td><h4><?=$lang_carmodels['缩写']?>:<?=$post['cm_short_name']?></h4></td>
            <td><h4><?=$lang_carmodels['热门标示']?>:<?=$post['cm_hot_item_tag']==1? $lang_carmodels["否"]:$lang_carmodels["是"]?></h4></td>
        </tr>
        <tr>
            <td><h4><?=$lang_carmodels['创建日期']?>:<?=$post['cm_create_date']?></h4></td>
        </tr>
        <tr>
            <td><h4><?=$lang_carmodels['区域']?>:<?=$post['cm_region']?></h4></td>
        </tr>
        <!--<tr>
            <td><h4><?/*=$lang_carmodels['图标文件']*/?>:</h4></td>
        </tr>
        <tr>
            <td ><img style="max-width: 100px;max-height: 100px" src="./<?/*=$post['cm_icon_path']*/?>" class="img-rounded"></td>
        </tr>-->
    </table>
</div>
</body>
<?php include ('footer.php');?>
