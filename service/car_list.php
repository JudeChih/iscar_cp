<?php
header('Content-type:text/json');
if(g('h')==0){
    if(g('sorting')=='sorting_c'){
        $orderby=' ORDER BY d.ci_car_year_style DESC';
    }elseif (g('sorting')=='sorting_b'){
        $orderby=' ORDER BY d.ci_sale_price DESC';
    }else{
        $orderby=' ORDER BY d.ci_car_year_style DESC';
    }
}else{
    if(g('sorting')=='sorting_c'){
        $orderby=' ORDER BY d.ci_car_year_style ASC';
    }elseif (g('sorting')=='sorting_b'){
        $orderby=' ORDER BY d.ci_sale_price ASC';
    }else{
        $orderby=' ORDER BY d.ci_car_year_style ASC';
    }
}

//查询分页
if(g('start')){
    $limit= " limit ".g('start').",10";
}else{
    $limit= " limit 0,10";
}
$where_c = '';
$where_caryear ='';
$where_body='';
$where_fueltype ='';
$where_transmission ='';
$where_drivemode ='';
$where_price ='';
$where_com ='';
$where_passenger ='';
$where_cardoor ='';
$where_displacement ='';
$where_equiptment ='';
$where_content ='';
$where_brand ='';
$where_model='';
//价格
if(gh('Price_sector')!=''){
    $price=explode('","',substr(gh('Price_sector'),2,strlen(gh('Price_sector'))-4));
    if($price&&$price[0]!=''){
        $price_sector = "";
        $str_cisaleprice = "";
        foreach ($price as $p){
            $p = trim($p);
            if($p == "200+") {$str_cisaleprice = 'info.ci_sale_price IS NULL ';}
            if($p == "-5") {$str_cisaleprice = 'info.ci_sale_price < 5 ';}
            if($p =="100-") { $str_cisaleprice = '100 <= info.ci_sale_price '; }
            if($p =="-80") { $str_cisaleprice = 'info.ci_sale_price < 80 OR info.ci_sale_price'; }
            if($p =="200-") { $str_cisaleprice = '200 <= info.ci_sale_price '; }
            if($p != "-5" && $p !="100-" && $p != "-80" && $p !="200-" && $p !="200+" && $p){
                $str_cisaleprice = '(info.ci_sale_price BETWEEN '.str_replace('-', ' AND ', $p).')' ;
            }
            $price_sector .= $str_cisaleprice . " OR ";
        }
        $price_sector = substr($price_sector, 0, strlen($price_sector)-3);
        $where_price=' AND ('.$price_sector.') ';
    }
}
//产地
if(g('carsource')!=''){
    $carsource=explode(',',substr(g('carsource'),1,strlen(g('carsource'))-2));
    if($carsource && $carsource[0]!=''){
        $carsource_s = " AND ";
        $carsource_val = "";
        foreach ($carsource as $c){
            $c = trim($c);
            $carsource_val.="info.ci_carsource=$c OR ";
        }
        $carsource_sector = substr($carsource_val, 0, strlen($carsource_val)-3);
        $where_c=$carsource_s.'('.$carsource_sector.')';
       // print_r($inner_c);exit;
    }
}
//年份

$icaryear = false;
if(g('caryear')!=''){
    $caryear=explode(',',substr(g('caryear'),1,strlen(g('caryear'))-2));
    if($caryear && $caryear[0]!=''){
        $icaryear = true;
        if(g('h')==0){
            if(g('sorting')=='sorting_c'){
                $orderby=' ORDER BY info.ci_car_year_style DESC';
            }elseif (g('sorting')=='sorting_b'){
                $orderby=' ORDER BY info.ci_sale_price DESC';
            }else{
                $orderby=' ORDER BY info.ci_car_year_style DESC';
            }
        }else{
            if(g('sorting')=='sorting_c'){
                $orderby=' ORDER BY info.ci_car_year_style ASC';
            }elseif (g('sorting')=='sorting_b'){
                $orderby=' ORDER BY info.ci_sale_price ASC';
            }else{
                $orderby=' ORDER BY info.ci_car_year_style ASC';
            }
        }
        $caryear_s = " AND ";
        $caryear_val = "";
        foreach ($caryear as $c){
            $c = trim($c);
            $caryear_val.="info.ci_car_year_style=$c OR ";
        }
        $caryear_sector = substr($caryear_val, 0, strlen($caryear_val)-3);
        $where_caryear=$caryear_s.'('.$caryear_sector.')';
    } else {
        $icaryear = false;
        if(g('h')==0){
            if(g('sorting')=='sorting_c'){
                $orderby=' ORDER BY d.ci_car_year_style DESC';
            }elseif (g('sorting')=='sorting_b'){
                $orderby=' ORDER BY d.ci_sale_price DESC';
            }else{
                $orderby=' ORDER BY d.ci_car_year_style DESC';
            }
        }else{
            if(g('sorting')=='sorting_c'){
                $orderby=' ORDER BY d.ci_car_year_style ASC';
            }elseif (g('sorting')=='sorting_b'){
                $orderby=' ORDER BY d.ci_sale_price ASC';
            }else{
                $orderby=' ORDER BY d.ci_car_year_style ASC';
            }
        }
    }
}
//油耗'
if(g('consumption')!=''){
    $consumption=g('consumption');
    if($consumption){
        if($consumption=='25'){
            $where_com=" AND (info.ci_average_consumption>25)";
        }else{
            $where_com=" AND (info.ci_average_consumption BETWEEN ".str_replace('-', ' AND ', $consumption).")";
        }
    }
}
// 车身分类
if(g('carbody')!=''){
    $body=explode(',',substr(g('carbody'),1,strlen(g('carbody'))-2));
    if($body&&$body[0]!=''){
        $body_s = " AND ";
        $body_val = "";
        foreach ($body as $b){
            $body_val.=" info.ci_car_bodytype = '$b' OR ";
        }
        $body_val_sector = substr($body_val, 0, strlen($body_val)-3);
        $where_body=$body_s.'('.$body_val_sector.')';
    }
}
//乘客数
if(gh('passenger')!=''){
    $passenger=explode('","',substr(gh('passenger'),2,strlen(gh('passenger'))-4));
    if($passenger&&$passenger[0]!=''){
        $passenger_val = " AND (";
        foreach ($passenger as $p){
            if ($p=='7人以上'){
                $passenger_s=' info.ci_car_seats>7 ';
            }elseif ($p=='2人'){
                $passenger_s=' info.ci_car_seats=2 ';
            }else{
                $passenger_s='(info.ci_car_seats BETWEEN '.str_replace('-', ' AND ', str_replace('人', '', $p)).')';
            }
            $passenger_val.=$passenger_s.' OR ';
        }
        $passenger_val = substr($passenger_val, 0, strlen($passenger_val)-3);
        $where_passenger=$passenger_val.')';
    }
}
//车门数
if(gh('cardoor')!=''){
    $cardoor=explode('","',substr(gh('cardoor'),2,strlen(gh('cardoor'))-4));
    if($cardoor && $cardoor[0]!=''){
        $cardoor_val=' AND(';
        foreach ($cardoor as $c){
            $cardoor_val.=' info.ci_car_doors='.str_replace('門', '', $c).' OR ';
        }
        $cardoor_val = substr($cardoor_val, 0, strlen($cardoor_val)-3);
        $where_cardoor=$cardoor_val.')';
    }
}
//引擎燃料fueltype
if(g('fueltype')!=''){
    $fueltype=explode(',',substr(g('fueltype'),1,strlen(g('fueltype'))-2));
    if($fueltype&&$fueltype[0]!=''){
        $fueltype_s = " AND (";
        foreach ($fueltype as $f){
            $fueltype_s.="info.ci_fueltype ='".$f."' OR ";
        }
        $fueltype_val = substr($fueltype_s, 0, strlen($fueltype_s)-3);
        $where_fueltype=$fueltype_val.')';
    }
}
//变速技术
if(g('transmission')!=''){
    $transmission=explode(',',substr(g('transmission'),1,strlen(g('transmission'))-2));
    if($transmission&&$transmission[0]!=''){
        $transmission_s= " AND (";
        foreach ($transmission as $t){
            $transmission_s.="info.ci_transmission_system=".$t." OR ";
        }
        $transmission_val = substr($transmission_s, 0, strlen($transmission_s)-3);
        $where_transmission=$transmission_val.')';
    }
}
///排气量displacement
if(gh('displacement')!=''){
    $displacement=explode('","',substr(gh('displacement'),2,strlen(gh('displacement'))-4));
    if($displacement&&$displacement[0]!=''){
        $displacement_sector = "";
        $str_displacement = "";
        foreach ($displacement as $p){
            $p = trim($p);
            if($p == "1200以下") {$str_displacement = 'info.ci_displacement < 1200 ';}
            if($p =="5401以上") { $str_displacement = '5400 < info.ci_displacement '; }
            if($p != "1200以下" && $p !="5401以上"){
                $str_displacement = '(info.ci_displacement BETWEEN '.str_replace('-', ' AND ', $p).')' ;
            }
            $displacement_sector .= $str_displacement . " OR ";
        }
        $displacement_sector = substr($displacement_sector, 0, strlen($displacement_sector)-3);
        $where_displacement=' AND ('.$displacement_sector.') ';
    }
}
//车辆配备
if(gh('equiptment')!=''){
    $equiptment=explode('","',substr(gh('equiptment'),2,strlen(gh('equiptment'))-4));
    if($equiptment&&$equiptment[0]!=''){
        $equiptment_s= " AND (info.ci_id in (SELECT ci.ci_id FROM carinfo ci LEFT JOIN (ci_car_equip ce LEFT JOIN carterms cm on ce.ce_key=cm.keyword) on ce.ci_id=ci.ci_id
     WHERE ci.ci_published = 3 AND cm.term='车辆配备' AND ";
        foreach ($equiptment as $e){
            $equiptment_s.=" value='".$e."' OR ";
        }
        $equiptment_val = substr($equiptment_s, 0, strlen($equiptment_s)-3);
        $where_equiptment=$equiptment_val.'))';
    }
}
//驱动方式
if(g('drivemode')!=''){
    $drivemode=explode(',',substr(g('drivemode'),1,strlen(g('drivemode'))-2));
    if($drivemode&&$drivemode[0]!=''){
        $drivemode_s = " AND (";
        foreach ($drivemode as $d){
            $drivemode_s.=" info.ci_drive_mode='$d' OR ";
        }
        $drivemode_s = substr($drivemode_s, 0, strlen($drivemode_s)-3);
        $where_drivemode=$drivemode_s.')';
    }
}
if(g('brand')!=''){
    $where_brand=" AND carbrand.cb_fullname='".g('brand')."'";
}
if(g('car_model')!=''){
    $where_model=" AND models.cm_fullname='".g('car_model')."'";
}
//key_content
if(g('key_content')!=''){
 $where_content=" AND (style.cs_fullname LIKE '%".g('key_content')."%'  OR models.cm_fullname  LIKE '%".g('key_content')."%' OR carbrand.cb_fullname  LIKE '%".g('key_content')."%' )";
}

if ($icaryear) {
    $sql="SELECT DISTINCT
     info.ci_id AS car_id ,
     info.ci_sale_price ,
     info.ci_average_consumption ,
     info.ci_car_year_style ,
     info.tag_id,
	style.cs_fullname style_name,
     models.cm_fullname model_name,
     carbrand.cb_fullname brand_name,
	(SELECT  
              meta_file_path 
              FROM carmeta cm 
              WHERE cm.meta_type=11 
              AND cm.ci_id=info.ci_id limit 0, 1
         ) AS car_img 
FROM
	carinfo AS info
	INNER JOIN carstyles style ON info.ci_model_style = style.cs_id
	INNER JOIN carmodels models ON  info.ci_brand_model = models.cm_id 
	INNER JOIN carbrands carbrand ON info.ci_car_brand = carbrand.cb_id 
WHERE info.ci_published=3 AND carbrand.cb_region=".$_language." AND models.cm_region=".$_language." AND style.cs_region=".$_language.$where_c.$where_caryear.$where_body.$where_fueltype.$where_transmission.$where_drivemode.$where_price.$where_com.$where_passenger.$where_cardoor.$where_displacement.$where_equiptment.$where_content.$where_brand.$where_model.$orderby.$limit;
} else {
    $sql="SELECT 
      d.ci_id car_id,
	d.ci_sale_price ,
	d.ci_average_consumption ,
	d.tag_id ,
	d.ci_car_year_style,
	style.cs_fullname style_name ,
	models.cm_fullname model_name ,
	carbrand.cb_fullname brand_name,
(
		SELECT
			meta_file_path
		FROM
			carmeta cm
		WHERE
			cm.meta_type = 11
		AND cm.ci_id = d.ci_id
		LIMIT 0,1
	) AS car_img
FROM (
SELECT a.ci_model_style,a.ci_car_year_style,MAX(b.ci_id) ci_id
FROM (
SELECT MAX(info.ci_car_year_style) ci_car_year_style,info.ci_model_style
FROM
	carinfo AS info
INNER JOIN carstyles style ON info.ci_model_style = style.cs_id
	INNER JOIN carmodels models ON  info.ci_brand_model = models.cm_id 
	INNER JOIN carbrands carbrand ON info.ci_car_brand = carbrand.cb_id 
WHERE info.ci_published=3 AND carbrand.cb_region=".$_language." AND models.cm_region=".$_language." AND style.cs_region=".$_language.$where_c.$where_caryear.$where_body.$where_fueltype.$where_transmission.$where_drivemode.$where_price.$where_com.$where_passenger.$where_cardoor.$where_displacement.$where_equiptment.$where_content.$where_brand.$where_model."
GROUP by info.ci_model_style
) a
INNER JOIN carinfo b ON a.ci_model_style=b.ci_model_style AND a.ci_car_year_style=b.ci_car_year_style AND b.ci_published = 3
GROUP by a.ci_model_style,a.ci_car_year_style
) c 
INNER JOIN carinfo d on c.ci_id=d.ci_id
INNER JOIN carstyles style ON d.ci_model_style = style.cs_id
INNER JOIN carmodels models ON d.ci_brand_model = models.cm_id
INNER JOIN carbrands carbrand ON d.ci_car_brand = carbrand.cb_id
".$orderby.$limit;
}


//热门车型
$car_model="SELECT DISTINCT
	car.ci_brand_model AS car_mid,
	cm.cm_fullname hot_carmodel
FROM
	carmodels cm
INNER JOIN carinfo car ON cm.cm_id = car.ci_brand_model AND cm.cb_id=car.ci_car_brand
AND cm_hot_item_tag=3 AND car.ci_published = 3 AND cm.cm_region=".$_language;

$result = $pdo->query($sql);
$data['car_list']=$result;
$hot_carmodel = $pdo->query($car_model);
$data['hot_carmodel']=$hot_carmodel;
//$data['sql']=$sql;

setLog($u_name,0,$sid,3,'查看汽车列表 region='.$_language.$where_c.$where_body.$where_fueltype.$where_transmission.$where_drivemode.$where_price.$where_com.$where_passenger.$where_cardoor.$where_displacement.$where_equiptment.$where_content.$where_brand.$where_model);

$data=json_encode($data);
print_r($data);