<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2017/2/7
 * Time: 16:29
 */
if(g('reg')){
    $reg = g('reg');
    $result = $pdo->query("SELECT DISTINCT term FROM carterms ");

    $res['data'] = $result;
    echo json_encode($res);
}