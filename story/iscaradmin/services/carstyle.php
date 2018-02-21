<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/23
 * Time: 18:17
 */
$key = g('search');
$cb_id = g('cb_id');
$cm_id = g('cm_id');
$reg = g('reg');
//$ci_style = $pdo->query("SELECT DISTINCT ci_model_style FROM carinfo WHERE ci_car_brand = $cb_id AND ci_brand_model = $cm_id AND ci_published>1 ORDER BY ci_model_style");
//$ci_style_num = count($ci_style);
if(!empty($key)){
    if(!empty($reg)){
        $result = $pdo->query("SELECT cs_fullname,cs_id FROM carstyles WHERE cs_fullname LIKE '%$key%' AND cs_published>1 AND cs_region={$reg}");
    }else {
        $result = $pdo->query("SELECT cs_fullname,cs_id FROM carstyles WHERE cs_fullname LIKE '%$key%' AND cs_published>1 AND cs_region=3");
    }
//    $result_num = count($result);
//    for($i=0;$i<$ci_style_num;$i++){
//        for($j=0;$j<$result_num;$j++){
//            if($result[$j]['cs_id'] == $ci_style[$i]['ci_model_style']){
//                unset($result[$j]);
//            }
//        }
//    }
//    sort($result);
    $res['data'] = $result;
}else{
    if(!empty($reg)){
        $terms_cm = $pdo->query("SELECT cs_fullname,cs_id FROM carstyles WHERE cb_id={$cb_id} AND cm_id={$cm_id} AND cs_published>1 AND cs_region={$reg}");
    }else {
        $terms_cm = $pdo->query("SELECT cs_fullname,cs_id FROM carstyles WHERE cb_id={$cb_id} AND cm_id={$cm_id} AND cs_published>1 AND cs_region=3");
    }
//    $terms_cm_num = count($terms_cm);
//    for($i=0;$i<$ci_style_num;$i++){
//        for($j=0;$j<$terms_cm_num;$j++){
//            if($terms_cm[$j]['cs_id'] == $ci_style[$i]['ci_model_style']){
//                unset($terms_cm[$j]);
//            }
//        }
//    }
//    sort($terms_cm);
    $res['data'] = $terms_cm;
}
echo json_encode($res);