<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/8
 * Time: 17:23
 */
function d($post){
    $reg = '';
    $post['ct_region'] = getTerms("区域", $reg, $post['ct_region']);

    return $post;
}
switch ($_action) {
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $values = gs(array('term', 'value', 'ct_region'));
            $values['last_update_date'] = date('Y-m-d H:i:s', time());
            $term = $values["term"];
            $max_key = $pdo->getRow("SELECT max(keyword) as max_k FROM carterms WHERE term= '$term'");
            $values['keyword'] = $max_key['max_k']+1;
            $res = $pdo->insert('carterms', $values);
            if($res){
                echo '<script>var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                              parent.layer.close(index); //再执行关闭
                              parent.location.reload();</script>';
            }
            exit();
        }
        $terms_re = getTerms("区域");
        $terms = $pdo->query("SELECT DISTINCT term FROM carterms ");
        break;
    case 'edit':
        if(g('id')){
            $_id = g('id');
            $post = $pdo->getRow("SELECT *
                                  FROM `carterms`
                                  WHERE id=?",array($_id));
            $terms_re = getTerms("区域");

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $values = gs(array('keyword', 'value', 'ct_region'));

                $res = $pdo->update('carterms', $values, array('id'=>$_id));
                echo '<script>var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                          parent.layer.close(index); //再执行关闭
                          parent.location.reload();</script>';
                exit();
            }
        }

        break;
    case 'del':
        /*if(g('id')) {
            $res = $pdo->delete('carterms', array('id' => g('id')));
            if($res){
                $result['data'] = 1;
            }else{
                $result['data'] = 2;
            }
            echo json_encode($result);
        }*/
        exit;
    case 'detail':

        break;
    case 'verify'://序号重复性验证
        if(g('list')&&g('term')){
            $list = g('list');
            $term = g('term');
            $res_a = $pdo->query("SELECT keyword FROM carterms WHERE term='$term'");
            $res_b = array_column($res_a, 'keyword');
            if(g('e')){
                $id = g('e');
                $res_e = $pdo->getRow("SELECT keyword FROM carterms WHERE id=? AND keyword=?", array($id, $list));
                if(!empty($res_e)){
                    foreach ($res_b as $key=>$value)
                    {
                        if ($value === $list)
                            unset($res_b[$key]);
                    }
                }
            }
            if(in_array($list,$res_b)){
                $res['data'] = 1;//重复
            }else{
                $res['data'] = 2;//不重复
            }

            echo json_encode($res);
        }
        exit;
    default:
        if(g('k')||g('r')){
            $keyword = g('k');
            $reg = g('r');
            if(!empty($keyword)&&empty($reg)) {
                $str_sql = "SELECT *
                    FROM `carterms`
                    WHERE term LIKE '%$keyword%'
                    ORDER BY last_update_date DESC";
            }elseif(!empty($keyword)&&!empty($reg)){
                $str_sql = "SELECT *
                    FROM `carterms`
                    WHERE term LIKE '%$keyword%'
                    AND ct_region=$reg
                    ORDER BY last_update_date DESC";
            }else{
                $str_sql = "SELECT *
                    FROM `carterms`
                    WHERE ct_region=$reg
                    ORDER BY last_update_date DESC";
            }
        }else {
            $keyword = '';
            $str_sql = "SELECT *
                    FROM `carterms`
                    ORDER BY last_update_date DESC";
        }
        $post = $pdo->query($str_sql);
        $total = count($post);
        if(!g('_page')){
            $thispage=1;
        }else{
            $thispage=g('_page');
        }
        $limit = PAGES*($thispage-1); //本页记录数起始位置
        $str = $str_sql.' limit '.$limit.','.PAGES;
        $result=$pdo->query($str);
        $result = array_map('d', $result);
        $terms_re = getTerms("区域");
        break;
}