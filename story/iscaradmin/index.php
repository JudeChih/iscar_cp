<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/2
 * Time: 15:32
 */
session_start();
define('WPURL', 'http://'.$_SERVER['HTTP_HOST'].'/story');
define('URL',  WPURL.'/');
define('WP_LOGGED_IN_COOKIE', 'wordpress_logged_in_' . md5(WPURL));
$_SESSION['lo_session'] = $_COOKIE[WP_LOGGED_IN_COOKIE];
//列表每页的数量
define('PAGES', 10);
$arr = array('cararticle', 'carbrands', 'carbodytypes', 'carinfo', 'carmodels', 'carstyles', 'myfavorite', 'mylogs', 'carterms');
$a_arr = array('add', 'add_oth', 'edit', 'del', 'detail', 'selectExcel', 'importExcel', 'copy');
$p = htmlentities(trim($_GET['p']));
$services = htmlentities(trim($_GET['srv']));

if(isset($_COOKIE[WP_LOGGED_IN_COOKIE])&&isset($_SESSION['lo_session'])) {
    require_once('../../includes/jw-config.php');

    function __autoload($_class)
    {
        require_once('../../classes/' . $_class . '.php');
    }

    try {
        $pdo = new MySQLPDO(new pdo('mysql:host=' . $JWDB_HOST . ';port=3306;dbname=' . $JWDB_NAME . ';', $JWDB_USER, $JWDB_PASSWORD));
        require_once('../../includes/functions.php');

        if (!empty($services)) {
            require_once('./services/' . $services . '.php');
        }

        if (!empty($p)) {
            if (in_array($p, $arr)) {
                $_action = g('a');
                $_region = g('r');

                switch($_region){//语言选择
                    case '':
                        require_once('./lang/chs/lang_'.$p.'.php');//简体中文
                        break;
                    case 1:
                        require_once('./lang/chg/lang_'.$p.'.php');//港式中文
                        break;
                    case 2:
                        require_once('./lang/cht/lang_'.$p.'.php');//台式中文
                        break;
                    case 3:
                        require_once('./lang/chs/lang_'.$p.'.php');//简体中文
                        break;
                }
                require_once('./models/' . $p . '.php');

                if (isset($p) && isset($_action)) {
                    if (in_array($_action, $a_arr)) {
                        include('./' . $p . '_' . $_action . '.php');
                    } else {
                        include('./' . $p . '.php');
                    }
                } else {
                    include('./' . $p . '.php');
                }
            } else {
                include('./show_error.php');
            }
        }
    } catch (Exception $e) {
        print 'internal error, please contact site master. bob@itomix.com.cn';
//            print '<!--';
        print '<pre>';
        print_r($e);
        print  '</pre>';
//            print '//-->';
    }
}else{
    include('./show_error.php');
}
