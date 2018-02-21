<?php
header('Content-type:text/json');
$sql="SELECT DISTINCT
	info.ci_id AS car_id,
	info.ci_sale_price ,
	info.ci_average_consumption ,
	info.ci_car_year_style ,
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
INNER JOIN myfavorite AS my ON info.ci_id=my.oid AND my.status=1 AND my.uid='$u_id'
WHERE info.ci_published=3";

$data = $pdo->query($sql);
$data=json_encode($data);

setLog($u_name,0,$sid,4,'查看收藏列表');

echo($data);
