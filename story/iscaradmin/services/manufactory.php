<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/21
 * Time: 9:53
 */
$key = g('search');
$reg = g('reg');
if(!empty($key)){
    if(!empty($reg)){
        $result = $pdo->query("SELECT value,keyword FROM carterms WHERE term='制造商' AND value LIKE '%$key%' AND ct_region={$reg}");
    }else {
        $result = $pdo->query("SELECT value,keyword FROM carterms WHERE term='制造商' AND value LIKE '%$key%' AND ct_region=3");
    }
    $res['data'] = $result;
}else{
    $terms_brs = getTerms("制造商", $reg);
    $res['data'] = $terms_brs;
}
echo json_encode($res);
