<?
require('includes/jw-config.php');

function __autoload($_class) {
    require_once ('classes/' . $_class . '.php');
}
try {
    $pdo = new MySQLPDO(new pdo('mysql:host='.$JWDB_HOST.';port=3306;dbname='.$JWDB_NAME.';',$JWDB_USER, $JWDB_PASSWORD));
}
catch (Exception $e) {
    print 'internal error, please contact site master. bob@itomix.com.cn';
    //print '<!--';
    print '<pre>';
    print_r($e);
    print  '</pre>';
    //print '//-->';
}

function og_head($type,$o_id)
{
    global $pdo;
    global $sql;
    global $banner;
    if($type=='car'){
        $sql="SELECT
	style.cs_fullname style_name,
	brands.cb_fullname brand_name,
	models.cm_fullname model_name,
	j.post_content post_content
FROM
	carinfo AS info
INNER JOIN carstyles style ON  info.ci_model_style = style.cs_id
INNER JOIN carmodels models ON info.ci_brand_model = models.cm_id
INNER JOIN carbrands brands ON info.ci_car_brand = brands.cb_id
LEFT JOIN jw_posts j ON ID = ca_main_id
WHERE
	info.ci_id=? AND  info.ci_published=3";
        $banner="SELECT meta_file_path FROM carmeta WHERE meta_type=11 and ci_id=?";
        $_og=$pdo->query($sql,array($o_id));
        $_og[0]['banner']=$pdo->query($banner,array($o_id));
        return $_og;
    }else{
        require_once ('includes/functions.php');
        $content = getContent($o_id);
        $banner_sql="SELECT guid article_img
		FROM jw_posts
		WHERE post_type = 'attachment' AND post_parent =?";
        $content[0]['article_img']=$pdo->query($banner_sql,array($o_id));
        return $content[0];
    }

}

?>