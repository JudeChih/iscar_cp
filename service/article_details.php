<?php
header('Content-type:text/json');
//文章详情getAttachments

$article_id=g('article_id');
$car_id=g('car_id');
$content = getContent($article_id);


//相关汽车列表
$related_car_sql="SELECT DISTINCT
	info.ci_id AS car_id,
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
    JOIN cararticle AS c ON c.ci_id = info.ci_id
WHERE c.article_id =".$article_id." limit 5";
$related_car = $pdo->query($related_car_sql);

//上一篇 下一篇


$article_sql_up="SELECT
	j.ID AS article_id ,
	j.post_title
FROM
	jw_posts j
INNER JOIN cararticle c ON c.ci_id=".$car_id." AND c.article_id=j.ID AND c.article_id>".$article_id."
WHERE
	post_status = 'publish' ORDER BY j.ID ASC LIMIT 1";

$article_sql_down="SELECT
	j.ID AS article_id ,
	j.post_title
FROM
	jw_posts j
INNER JOIN cararticle c ON c.ci_id=".$car_id." AND c.article_id=j.ID AND c.article_id<".$article_id."
WHERE
	post_status = 'publish' ORDER BY j.ID ASC LIMIT 1";
//banner
$banner_sql="SELECT guid article_img
		FROM jw_posts 
		WHERE post_type = 'attachment' AND post_parent =".$article_id;
$up_article = $pdo->query($article_sql_up);
$down_article = $pdo->query($article_sql_down);
$banner= $pdo->query($banner_sql);
$data[content]=$content;
$data[related_car]=$related_car;
$data[up_article]=$up_article;
$data[down_article]=$down_article;
$data[banner]=$banner;

$data=json_encode($data);

setLog($u_name,$article_id,$sid,2,'查看文章详情、文章ID'.$article_id);

print_r($data);
