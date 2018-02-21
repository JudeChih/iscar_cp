<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/2
 * Time: 15:29
 */
include ('header.php');
?>
<title><?=$lang_carbrands['厂牌管理']?></title>
</head>
<body>
<h2><?=$lang_carbrands['汽车厂牌详情']?></h2>
<div style="max-width: 1000px;margin: auto" align="center">
    <table width="100%" style="line-height: 18px;">
        <tr>
            <td><h4><?=$lang_carbrands['序号']?>:<?=$post['cb_list_order']?></h4></td>
        </tr>
        <tr>
            <td><h4><?=$lang_carbrands['厂牌名称']?>:<?=$post['cb_fullname']?></h4></td>
            <td><h4><?=$lang_carbrands['厂牌昵称']?>:<?=$post['cb_nickname']?></h4></td>
        </tr>
        <tr>
            <td><h4><?=$lang_carbrands['缩写']?>:<?=$post['cb_short_name']?></h4></td>
<!--            <td><h4>--><?//=$lang_carbrands['热门标示']?><!--:--><?//=$post['cb_hot_item_tag']==1?$lang_carbrands['否']:$lang_carbrands['是']?><!--</h4></td>-->
            <td><h4><?=$lang_carbrands['创建日期']?>:<?=$post['cb_create_date']?></h4></td>
        </tr>
        <tr>
            <td><h4><?=$lang_carbrands['区域']?>:<?=$post['cb_region']?></h4></td>
        </tr>
        <tr>
            <td><h4><?=$lang_carbrands['图标文件']?>:</h4></td>
        </tr>
        <tr>
            <td ><img style="max-width: 100px;max-height: 100px" src="./<?=$post['cb_icon_path']?>" class="img-rounded"></td>
        </tr>
    </table>
</div>
</body>
<?php include ('footer.php');?>
