<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/8
 * Time: 10:35
 */
include ('header.php');
?>
<title><?=$lang_carbodytypes['车身管理']?></title>
</head>
<body>
<h2><?=$lang_carbodytypes['汽车车身详情']?></h2>
<div style="max-width: 1000px;margin: auto" align="center">
    <table width="100%" style="line-height: 18px;">
<!--        <tr>-->
<!--            <td><h4>--><?//=$lang_carbodytypes['序号']?><!--:--><?//=$post['cbt_list_order']?><!--</h4></td>-->
<!--        </tr>-->
        <tr>
            <td><h4><?=$lang_carbodytypes['车种名称']?>:<?=$post['cbt_fullname']?></h4></td>
            <td><h4><?=$lang_carbodytypes['车种昵称']?>:<?=$post['cbt_nickname']?></h4></td>
        </tr>
        <tr>
            <td><h4><?=$lang_carbodytypes['缩写']?>:<?=$post['cbt_short_name']?></h4></td>
<!--            <td><h4>--><?//=$lang_carbodytypes['热门标示']?><!--:--><?//=$post['cbt_hot_item_tag']==1?$lang_carbodytypes['否']:$lang_carbodytypes['是']?><!--</h4></td>-->
            <td><h4><?=$lang_carbodytypes['创建日期']?>:<?=$post['cbt_create_date']?></h4></td>
        </tr>
        <tr>
            <td><h4><?=$lang_carbodytypes['区域']?>:<?=$post['cbt_region']?></h4></td>
        </tr>
        <tr>
            <td><h4><?=$lang_carbodytypes['图标文件']?>:</h4></td>
        </tr>
        <tr>
            <td ><img style="max-width: 100px;max-height: 100px" src="./<?=$post['cbt_icon_path']?>" class="img-rounded"></td>
        </tr>
    </table>
</div>
</body>
<?php include ('footer.php');?>