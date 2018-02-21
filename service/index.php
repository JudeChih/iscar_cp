<?php
session_start();
$my_session_id = md5(time());
function getClientIP()
{
    global $ip;
    if (getenv("HTTP_CLIENT_IP"))
        $ip = getenv("HTTP_CLIENT_IP");
    else if(getenv("HTTP_X_FORWARDED_FOR"))
        $ip = getenv("HTTP_X_FORWARDED_FOR");
    else if(getenv("REMOTE_ADDR"))
        $ip = getenv("REMOTE_ADDR");
    else $ip = "Unknow";
    return $ip;
}
$ip=getClientIP();
$sid = isset($_SESSION['sid']) ?  $_SESSION['sid'] : $_SESSION['sid']=$my_session_id;
$u_id = isset($_SESSION['uid']) ?  $_SESSION['uid'] : $_SESSION['uid']=$ip;
$u_name = isset($_SESSION['u_name']) ?  $_SESSION['u_name'] : $_SESSION['u_name']='游客'.$ip;

require_once('../includes/jw-config.php');
require_once ('../includes/functions.php');

function __autoload($_class) {
    require_once ('../classes/' . $_class . '.php');
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

$_action=g('a');
$_language=g('l',null,2);

require_once($_action.'.php');