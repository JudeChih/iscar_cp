<?php
/**
 * Created by PhpStorm.
 * User: hesongshui
 * Date: 2016/12/19
 * Time: 下午4:34
 */
header('Content-type:text/json');


if($_language=='3'){
    $tag=getTitleList(18);
}elseif($_language=='1'){
    $tag=getTitleList(22);
}else{
    $tag=getTitleList(23);
}

if($tag){
    $banner=getAttachments($tag[0][ID]);
}

$brand_sql="SELECT
    cb_id ,
    cb_fullname AS 'name' ,
    cb_icon_path AS brand_img
FROM
    carbrands
WHERE
    cb_published = 3 AND cb_region=".$_language." AND cb_recommend=1 ORDER BY IF(ISNULL(cb_list_order),1,0),cb_list_order  ASC  limit 10";

$carbody_sql="SELECT DISTINCT
	cb.cbt_id ,
	cb.cbt_fullname AS value,
	cb.cbt_icon_path AS cbt_img
FROM
	carinfo AS cr
INNER JOIN carbodytypes AS cb ON cb.cbt_id = ci_car_bodytype
AND cb.cbt_published = 3 AND cbt_region=".$_language." AND cr.ci_published=3";

$data[brand]=$pdo->query($brand_sql);
$data[carbody]=$pdo->query($carbody_sql);
$data[banner]=$banner;
$data=json_encode($data);
setLog($u_name,0,$sid,8,'获取首页banner,车型,厂牌 ');
print_r($data);