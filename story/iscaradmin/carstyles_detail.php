<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/7
 * Time: 13:39
 */
include ('header.php');
?>
<title><?=$lang_carstyles['车款管理']?></title>
</head>
<body>
<h2><?=$lang_carstyles['汽车车款详情']?></h2>
<div style="max-width: 1000px;margin: auto" align="center">
    <table width="100%" style="line-height: 18px;">
<!--        <tr>-->
<!--            <td><h4>--><?//=$lang_carstyles['序号']?><!--:--><?//=$post['cs_list_order']?><!--</h4></td>-->
<!--        </tr>-->
        <tr>
            <td><h4><?=$lang_carstyles['厂牌名称']?>:<?=$post['cb_fullname']?></h4></td>
            <td><h4><?=$lang_carstyles['车系名称']?>:<?=$post['cm_fullname']?></h4></td>
        </tr>
        <tr>
            <td><h4><?=$lang_carstyles['车款名称']?>:<?=$post['cs_fullname']?></h4></td>
            <td><h4><?=$lang_carstyles['车款昵称']?>:<?=$post['cs_nickname']?></h4></td>
        </tr>
        <tr>
            <td><h4><?=$lang_carstyles['缩写']?>:<?=$post['cs_short_name']?></h4></td>
<!--            <td><h4>--><?//=$lang_carstyles['热门标示']?><!--:--><?//=$post['cs_hot_item_tag']==1?'否':'是'?><!--</h4></td>-->
            <td><h4><?=$lang_carstyles['创建日期']?>:<?=$post['cs_create_date']?></h4></td>
        </tr>
        <tr>
            <td><h4><?=$lang_carstyles['区域']?>:<?=$post['cs_region']?></h4></td>
        </tr>
        <!--<tr>
            <td><h4><?/*=$lang_carstyles['图标文件']*/?>:</h4></td>
        </tr>
        <tr>
            <td ><img style="max-width: 100px;max-height: 100px" src="./<?/*=$post['cs_icon_path']*/?>" class="img-rounded"></td>
        </tr>-->
    </table>
</div>
</body>
<?php include ('footer.php');?>