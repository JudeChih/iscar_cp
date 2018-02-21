<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/22
 * Time: 17:39
 */
$key = g('search');
$id = g('ci_id');
$reg = g('reg');
if(!empty($key)&&empty($id)){
    if(!empty($reg)){
        $result = $pdo->query("SELECT value,keyword FROM carterms WHERE term='车辆配备' AND value LIKE '%$key%' AND ct_region={$reg}");
    }else{
        $result = $pdo->query("SELECT value,keyword FROM carterms WHERE term='车辆配备' AND value LIKE '%$key%' AND ct_region=3");
    }
    $res['data'] = $result;
}elseif(!empty($id)&&!empty($key)){
    if(!empty($reg)){
        $result = $pdo->query("SELECT value,keyword FROM carterms WHERE term='车辆配备' AND value LIKE '%$key%' AND ct_region={$reg}");
    }else{
        $result = $pdo->query("SELECT value,keyword FROM carterms WHERE term='车辆配备' AND value LIKE '%$key%' AND ct_region=3");
    }
    $term_dis = $pdo->query("SELECT * FROM ci_car_equip WHERE ci_id=".$id);
    foreach($result as $v){
        foreach($term_dis as $vd){
            if($v['keyword']==$vd['ce_key']){
                $v['status'] = 1;
            }
        }
        $resul[]=$v;
    }
    $res['data'] = $resul;
}else{
    $terms_di = getTerms("车辆配备", $reg);
    if(!empty($id)){
        $term_dis = $pdo->query("SELECT * FROM ci_car_equip WHERE ci_id=".$id);
        foreach($terms_di as $v){
            foreach($term_dis as $vd){
                if($v['keyword']==$vd['ce_key']){
                    $v['status'] = 1;
                }
            }
            $result[]=$v;
        }
        $res['data'] = $result;
    }else{
        $res['data'] = $terms_di;
    }

}
echo json_encode($res);