<?php
header('Content-type:text/json');
//获取评论列表

$type=g('type');
$car_id=g('com_id');
if($type=='car'){
    $tt='汽车';
    $val=" INNER JOIN carinfo ON carinfo.ca_main_id = jw_comments.comment_post_ID AND jw_comments.comment_approved = 1 AND carinfo.ci_id =$car_id ORDER BY comment_date DESC;";
}else{
    $tt='文章';
    $val=" WHERE jw_comments.comment_approved = 1 AND jw_comments.comment_post_ID=$car_id ORDER BY comment_date DESC;";
}
$sql="SELECT DISTINCT 
jw_comments.comment_content,
jw_comments.comment_date,
ifnull(users.nickname,'游客') nickname,
ifnull(users.avatar_url,'img/new_avatarl.png') avatar_url
FROM jw_comments LEFT JOIN users ON users.uid=jw_comments.user_id 
".$val;

$data = $pdo->query($sql);
$data=json_encode($data);
setLog($u_name,0,$sid,9,'获取'.$tt.'评论 ID'.$car_id);
print_r($data);





