<?php
/**
 * Created by PhpStorm.
 * User: hesongshui
 * Date: 2017/1/5
 * Time: 下午4:38
 */
$not_recording=g('login_status');
if($not_recording=='not_recording'){
    session_destroy();
}else {
    $uid=g('uid');
    $nickname=g('nickname');
    $email=g('email');
    $avatar_url=g('avatar_url');
    $sql="SELECT COUNT(*) AS line FROM users WHERE uid='$uid'";
    $line=$pdo->query($sql);
    if($u_id!=$uid) {
        $a=$pdo->update("myfavorite",array('uid'=>$uid),array('status'=>'1','uid'=>$u_id));
    }
    //print_r($a);
    if($line[0][line]<1){
        $login_sql="
INSERT INTO users(
    uid ,
    nickname ,
    email,
    avatar_url,
    sid,
    register_date
)
VALUES
	(
	?,
	?,
	?,
	?,
	?,
     NOW()
     )";
        $abc= $pdo->execute($login_sql,array($uid, $nickname, $email, $avatar_url, $sid));
        print_r('1');
    }else{
        print_r('2');
    }
    $_SESSION['uid']=$uid;
    $_SESSION['u_name']=$nickname;
    setLog($nickname,0,$sid,10,'登入');
}


