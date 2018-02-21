<?php
header('Content-type:text/json');
$sql="SELECT
	car.ci_id AS car_id ,
	car.ci_sale_price AS car_price ,
    brands.cb_fullname brand_name,
	style.cs_fullname style_name,
    models.cm_fullname model_name,
	(
	     SELECT  
		meta_file_path 
		FROM carmeta cm 
		WHERE cm.meta_type=11 
		AND cm.ci_id=car.ci_id limit 0, 1
	) AS car_img 
FROM carinfo AS car
INNER JOIN carbrands brands ON  car.ci_car_brand = brands.cb_id 
INNER JOIN carstyles style ON car.ci_model_style = style.cs_id
INNER JOIN carmodels models ON  car.ci_brand_model = models.cm_id 
WHERE
	car.ci_recommend = 2 AND car.ci_published=3 AND car.ci_region=".$_language." limit 0,10";
$result = $pdo->query($sql);
$result=json_encode($result);

//setLog($u_name,0,$sid,7,'获取推荐车');
print_r($result);
