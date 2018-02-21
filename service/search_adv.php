<?php
header('Content-type:text/json');
/**
 * Created by PhpStorm.
 * User: hesongshui
 * Date: 2016/12/26
 * Time: 上午9:43
 */
//产地
$carsource_sql="SELECT
 DISTINCT ct.VALUE AS value,
 ci.ci_carsource AS carsource_id
FROM
	carterms ct
LEFT JOIN carinfo ci ON ci.ci_carsource = ct.keyword
WHERE
	ct.term = '产地' AND ci.ci_published=3 AND ct.ct_region=".$_language;

//车身
$carbody_sql="SELECT DISTINCT
	cb.cbt_id ,
	cb.cbt_fullname AS fullname,
	cb.cbt_nickname AS nickname
FROM
	carinfo AS cr
INNER JOIN carbodytypes AS cb ON cb.cbt_id = ci_car_bodytype
AND cb.cbt_published = 3 AND cbt_region=".$_language." AND cr.ci_published=3 ";
//车门数
$car_doors_sql="SELECT DISTINCT ci_car_doors AS car_doors FROM carinfo WHERE ci_car_doors IS NOT NULL AND  ci_published=3";
//
$fueltype_sql="SELECT
 DISTINCT ct.VALUE AS value,
ci.ci_fueltype AS fueltype
FROM
	carterms ct
LEFT JOIN carinfo ci ON ci.ci_fueltype = ct.keyword
WHERE
	ct.term = '引擎燃料' AND ci.ci_published=3 AND ct.ct_region=".$_language;
//变速系统
$transmission_sql="SELECT DISTINCT
	ct.VALUE AS value,ci.ci_transmission_system AS transmission_id
FROM
	carterms ct
LEFT JOIN carinfo ci ON ci.ci_transmission_system = ct.keyword
WHERE
	ct.term = '变速系统'
AND ci.ci_published = 3 AND ct.ct_region=".$_language;
//排气量
$displacement_sql="SELECT DISTINCT ci_displacement value FROM carinfo WHERE ci_published=3";

//车辆配备
$equiptments_sql="SELECT DISTINCT cm.value evalue FROM carinfo ci LEFT JOIN (ci_car_equip ce LEFT JOIN carterms cm on ce.ce_key=cm.keyword) on ce.ci_id=ci.ci_id
     WHERE ci.ci_published = 3 AND cm.term='车辆配备' AND cm.ct_region=".$_language;
//驱动方式
$drive_mode_sql="SELECT DISTINCT
	ct.VALUE AS value,ci.ci_drive_mode AS drive_mode_id
FROM
	carterms ct
LEFT JOIN carinfo ci ON ci.ci_drive_mode = ct.keyword
WHERE
	ct.term = '驱动方式'
     AND ci.ci_published = 3 AND ct.ct_region=".$_language;
//厂牌
$brand_sql="SELECT DISTINCT
	car.ci_car_brand AS car_bid,
	cb.cb_fullname bvalue
FROM
	carbrands cb
INNER JOIN carinfo car ON cb.cb_id = car.ci_car_brand AND cb_region=".$_language."
AND car.ci_published = 3";

//车型
$model_sql="SELECT DISTINCT
	car.ci_brand_model AS car_mid, 
	cm.cm_fullname mvalue
FROM
	carmodels cm
INNER JOIN carinfo car ON cm.cm_id = car.ci_brand_model AND cm.cb_id=car.ci_car_brand AND cm_region=".$_language." AND car.ci_published = 3";

$caryear_sql = "SELECT DISTINCT
	info.ci_car_year_style
FROM
	carinfo AS info
WHERE
	info.ci_published = 3
AND info.ci_region = ".$_language."
ORDER BY
	info.ci_car_year_style DESC";


$data[carsource] = $pdo->query($carsource_sql);
$data[carbody]= $pdo->query($carbody_sql);
$data[car_doors]= $pdo->query($car_doors_sql);
$data[fueltype]= $pdo->query($fueltype_sql);
$data[transmission]= $pdo->query($transmission_sql);
$data[displacement]= $pdo->query($displacement_sql);
$data[equiptments]= $pdo->query($equiptments_sql);
$data[drive_mode]= $pdo->query($drive_mode_sql);
$data[brand]= $pdo->query($brand_sql);
$data[model]= $pdo->query($model_sql);
$data[caryear]= $pdo->query($caryear_sql);

$data=json_encode($data);
print_r($data);