<?php
header('Content-type:text/json');
//相关文章
$car_id=g('car_id');
$sql="SELECT DISTINCT
	j.post_excerpt,
	j.ID,
	j.post_title,(
		SELECT guid 
		FROM jw_posts 
		WHERE post_type = 'attachment' AND post_parent =j.ID 
		LIMIT 1
	) AS article_img
FROM
	jw_posts AS j
JOIN cararticle AS c ON c.article_id = j.ID
WHERE 
	c.ci_id =$car_id AND j.post_status='publish' AND j.ID<>(SELECT ifnull(ca_main_id,0) FROM carinfo WHERE ci_id=$car_id)";

//banner
$banner="SELECT meta_file_path FROM carmeta WHERE meta_type=11 and ci_id=$car_id";
//外观与内饰
$imgs="SELECT meta_file_path AS img FROM carmeta WHERE meta_type=12 and ci_id=$car_id";
$add_imgs="SELECT meta_file_path AS img FROM carmeta WHERE meta_type=13 and ci_id=$car_id";

//车辆详细信息
$car_details="SELECT
	info.*, style.cs_fullname style_name ,brands.cb_fullname brand_name ,
	models.cm_fullname model_name ,
	j.post_content ,
	j.post_title,
	body.cbt_fullname body_name 
FROM
	carinfo AS info
INNER JOIN carstyles style ON  info.ci_model_style = style.cs_id
INNER JOIN carmodels models ON info.ci_brand_model = models.cm_id
INNER JOIN carbrands brands ON info.ci_car_brand = brands.cb_id
LEFT JOIN jw_posts j ON ID = ca_main_id
INNER JOIN carbodytypes body ON info.ci_car_bodytype=body.cbt_id
WHERE
	info.ci_id=$car_id AND  info.ci_published=3";
//车辆配备
$Equipment="SELECT
	term.`value`
FROM
	ci_car_equip AS car
LEFT JOIN carterms AS term ON car.ce_key = term.keyword
WHERE
	term.term = '车辆配备'
AND ci_id = $car_id";


$style_list="SELECT DISTINCT ca.ci_car_year_style car_year,ca.ci_id car_id,ca.ci_sale_price car_price,ca.ci_model_style,cs.cs_fullname style_name FROM carinfo ca
INNER JOIN carinfo ci ON ca.ci_brand_model=ci.ci_brand_model AND ci.ci_id=$car_id AND ca.ci_published=3  
INNER JOIN carstyles cs ON ca.ci_model_style=cs.cs_id ORDER BY ca.ci_car_year_style DESC";
$result = $pdo->query($sql);
$banner_img = $pdo->query($banner);
$imgs = $pdo->query($imgs);
$add_imgs = $pdo->query($add_imgs);
$style_list = $pdo->query($style_list);
$car_details = $pdo->query($car_details);
$_language=$car_details[0]['ci_region'];

$Condition=$pdo->query("SELECT term,keyword,value,ct_region FROM carterms WHERE (term='前轮悬吊' OR term ='后轮悬吊' OR term='引擎燃料' OR term='电池种类' OR term='气缸构造' OR term='引擎技术' OR term='引擎设计' OR term='供油方式' OR term='引擎位置' OR term='进气方式' OR term='变速系统' OR term='驱动方式' OR term='刹车系统' OR term='转向系统' OR term='气缸名称' OR term='产地' OR term='制造商' OR term='技术合作' OR term='经销商/代理商') AND ct_region=".$_language);

$Collection_status="SELECT COUNT(*) AS line from myfavorite WHERE uid='$u_id' AND oid=$car_id AND status = 1";
$Collection_status_line = $pdo->query($Collection_status);
if($Collection_status_line[0]['line']==1){
    $data['Collection_status']='true';
}else{
    $data['Collection_status']='false';
}

$data['Condition']=$Condition;
$data['style_list']=$style_list;
$data['banner']=$banner_img;
$data['article']=$result;
$data['details']['imgs']=$imgs;
$data['details']['add_imgs']=$add_imgs;
$data['details']['car_details']=$car_details;
$data['details']['Equipment']=$pdo->query($Equipment);

$data=json_encode($data);

setLog($u_name,$car_id,$sid,1,'查看汽车详情、汽车ID'.$car_id);

print_r($data);


