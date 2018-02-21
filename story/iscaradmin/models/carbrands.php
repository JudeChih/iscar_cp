<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/5
 * Time: 16:02
 */
function d($post){
    $reg = '';
    $post['cb_region'] = getTerms("区域", $reg, $post['cb_region']);

    return $post;
}
switch ($_action) {
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $values = gs(array('cb_fullname', 'cb_nickname', 'cb_short_name', 'cb_list_order', 'cb_region', 'cb_hot_item_tag', 'cb_recommend'));
            $values['cb_create_date'] = date('Y-m-d H:i:s', time());
            $values['cb_last_update_date'] = date('Y-m-d H:i:s', time());

            //上传图片文件
            $values['cb_icon_path'] = uploadFile();
            $res = $pdo->insert('carbrands', $values);
            if($res){
                echo '<script>var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                              parent.layer.close(index); //再执行关闭
                              parent.location.reload();</script>';
            }
            exit();
        }
        $terms_re = getTerms("区域");
        break;
    case 'edit':
        if(g('id')){
            $_id = g('id');
            $post = $pdo->getRow("SELECT cb_id,cb_type,cb_list_order,cb_fullname,cb_nickname,cb_short_name,cb_hot_item_tag,cb_create_date,cb_icon_path,cb_region,cb_recommend
                                  FROM `carbrands`
                                  WHERE cb_id=? AND cb_published>1",array($_id));
            $terms_re = getTerms("区域");
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $values = gs(array('cb_fullname', 'cb_nickname', 'cb_hot_item_tag', 'cb_short_name', 'cb_list_order', 'cb_region', 'cb_recommend'));
                $values['cb_last_update_date'] = date('Y-m-d H:i:s', time());
                $upload = uploadFile();
                if(isset($upload)){
                    //上传图片文件
                    $values['cb_icon_path'] = $upload;
                }else{
                    $values['cb_icon_path'] = $post['cb_icon_path'];
                }

                $res = $pdo->update('carbrands', $values, array('cb_id'=>$_id));
                if($res){
                    echo '<script>var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                              parent.layer.close(index); //再执行关闭
                              parent.location.reload();</script>';
                }
                exit();
            }
        }

        break;
    case 'del':
        if(g('id')) {
            $cb_id = g('id');
            if(g('v')=='verify') {
                $res_m = $pdo->query("SELECT cb_id FROM carmodels WHERE cb_id='$cb_id' AND cm_published>1");
                $res_s = $pdo->query("SELECT cb_id FROM carstyles WHERE cb_id='$cb_id' AND cs_published>1");
                $res_c = $pdo->query("SELECT ci_car_brand FROM carinfo WHERE ci_car_brand='$cb_id' AND ci_published>1");
                $res_m_count = count($res_m);
                $res_s_count = count($res_s);
                $res_c_count = count($res_c);
                if (empty($res_m_count) && empty($res_s_count) && empty($res_c_count)) {
                    $res['data'] = 1;//可以删除
                } else {
                    $res['data'] = 2;//不可以删除
                }
            }else {
                $values['cb_published'] = 1;
                $result = $pdo->update('carbrands', $values, array('cb_id' => $cb_id));
                if($result){
                    $res['data'] = 3;//删除成功
                }
            }
            echo json_encode($res);
        }
        exit;
    case 'detail':
        if(g('id')){
            $_id = g('id');
            $post = $pdo->getRow("SELECT * FROM carbrands WHERE cb_id=? AND cb_published>1",array($_id));
            $reg = g('reg');
            $post['cb_region'] = getTerms("区域",$reg, $post['cb_region']);
        }
        break;
    case 'verify'://序号验证
        if(g('region')){
            $region = g('region');
            $list = array();
            $arr = array();
            $result_id = '';
            if(g('id')){
                $id = g('id');
                $result_id = $pdo->getRow("SELECT cb_list_order FROM carbrands WHERE cb_published>1 AND cb_list_order>0 AND cb_region = $region AND cb_id=?", array($id));
            }
            $result = $pdo->query("SELECT cb_list_order FROM carbrands WHERE cb_published>1 AND cb_list_order>0 AND cb_region = ".$region);
            $res_count = count($result);
            for($i=0;$i<10;$i++){
                $list[$i]['key'] = $i+1;
                if(!empty($result_id)&&($list[$i]['key'] == $result_id['cb_list_order'])){
                    $list[$i]['checked'] = 1;
                }
            }
            for($j=0;$j<$res_count;$j++){
                for($k=0;$k<10;$k++){
                    if($result[$j]['cb_list_order'] == $list[$k]['key']){
                        $list[$k]['status'] = 1;
                        if(!empty($result_id)&&($list[$k]['key'] == $result_id['cb_list_order'])){
                            $list[$k]['status'] = '';
                        }
                    }
                }
            }
            $res['data'] = $list;
            echo json_encode($res);
        }
        exit;
    case 'verify_cb_name':
        if(g('cb_name')){
            $cb_name = g('cb_name');
            $region = g('region');

            if(g('id')){
                $cb_id = g('id');
                $result = $pdo->getRow("SELECT count(*) as count FROM carbrands WHERE cb_fullname = ? AND cb_id <> $cb_id AND cb_published>1 AND cb_region = ?", array($cb_name, $region));
            }else {
                $result = $pdo->getRow("SELECT count(*) as count FROM carbrands WHERE cb_fullname = ? AND cb_published>1 AND cb_region = ?", array($cb_name, $region));
            }

            if($result['count'] < 1){
                $res['data'] = 1;
            }else{
                $res['data'] = -1;
            }

            echo json_encode($res);
        }
        exit;
    default:
        if(g('order') == '1') {
            $order = 'ASC';
        }else{
            $order = 'DESC';
        }
        if(g('k')||g('r')){
            $keyword = g('k');
            $reg = g('r');
            if(!empty($keyword)&&empty($reg)) {
                $str_sql = "SELECT cb_id,cb_list_order,cb_fullname,cb_nickname,cb_short_name,cb_hot_item_tag,cb_create_date,cb_region,cb_recommend
                    FROM `carbrands`
                    WHERE cb_published>1
                    AND (cb_fullname LIKE '%$keyword%' OR cb_nickname LIKE '%$keyword%')
                    ORDER BY cb_list_order " . $order;
            }elseif(!empty($keyword)&&!empty($reg)){
                $str_sql = "SELECT cb_id,cb_list_order,cb_fullname,cb_nickname,cb_short_name,cb_hot_item_tag,cb_create_date,cb_region,cb_recommend
                    FROM `carbrands`
                    WHERE cb_published>1
                    AND (cb_fullname LIKE '%$keyword%' OR cb_nickname LIKE '%$keyword%')
                    AND cb_region=$reg
                    ORDER BY cb_list_order " . $order;
            }else{
                $str_sql = "SELECT cb_id,cb_list_order,cb_fullname,cb_nickname,cb_short_name,cb_hot_item_tag,cb_create_date,cb_region,cb_recommend
                    FROM `carbrands`
                    WHERE cb_published>1
                    AND cb_region=$reg
                    ORDER BY cb_list_order ".$order;
            }
        }else {
            $keyword = '';
            $str_sql = "SELECT cb_id,cb_list_order,cb_fullname,cb_nickname,cb_short_name,cb_hot_item_tag,cb_create_date,cb_region,cb_recommend
                    FROM `carbrands`
                    WHERE cb_published>1
                    ORDER BY cb_list_order ".$order;
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
        $result=array_map('d', $result);
        $terms_re = getTerms("区域");
        break;
}