<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/5
 * Time: 16:01
 */
function d($post){
    $reg = '';
    $post['cm_region'] = getTerms("区域", $reg, $post['cm_region']);

    return $post;
}
switch ($_action) {
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $values = gs(array('cb_id', 'cm_fullname', 'cm_nickname', 'cm_short_name', 'cm_list_order', 'cm_region', 'cm_hot_item_tag'));
            $values['cm_create_date'] = date('Y-m-d H:i:s', time());
            $values['cm_last_update_date'] = date('Y-m-d H:i:s', time());

            //上传图片文件
//            $values['cm_icon_path'] = uploadFile();
            $res = $pdo->insert('carmodels', $values);
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
            $post = $pdo->getRow("SELECT cm_id,cb_id,cm_list_order,cm_fullname,cm_nickname,cm_short_name,cm_hot_item_tag,cm_create_date,cm_icon_path,cm_region
                                  FROM `carmodels`
                                  WHERE cm_id=? AND cm_published>1",array($_id));

            $cb_result = $pdo->getRow("SELECT cb_fullname FROM carbrands WHERE cb_published>1 AND cb_id=?", array($post['cb_id']));
            $post['cb_fullname']= $cb_result['cb_fullname'];
            $terms_re = getTerms("区域");
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $values = gs(array('cb_id', 'cm_fullname', 'cm_nickname', 'cm_hot_item_tag', 'cm_short_name', 'cm_list_order', 'cm_region'));
                $values['cm_last_update_date'] = date('Y-m-d H:i:s', time());
//                $upload = uploadFile();
                if(isset($upload)){
                    //上传图片文件
                    $values['cm_icon_path'] = $upload;
                }else{
                    $values['cm_icon_path'] = $post['cm_icon_path'];
                }
                $res = $pdo->update('carmodels', $values, array('cm_id'=>$_id));
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
            $cm_id = g('id');
            if(g('v')=='verify') {
                $res_s = $pdo->query("SELECT cm_id FROM carstyles WHERE cm_id='$cm_id' AND cs_published>1");
                $res_c = $pdo->query("SELECT ci_brand_model FROM carinfo WHERE ci_brand_model='$cm_id' AND ci_published>1");
                $res_s_count = count($res_s);
                $res_c_count = count($res_c);
                if (empty($res_s_count) && empty($res_c_count)) {
                    $res['data'] = 1;//可以删除
                } else {
                    $res['data'] = 2;//不可以删除
                }
            }else {
                $values['cm_published'] = 1;
                $result = $pdo->update('carmodels', $values, array('cm_id' => $cm_id));
                if($result){
                    $res['data'] = 3;//删除成功
                }
            }
            echo json_encode($res);
        }
        exit;
    case 'detail':
        if(g('id')) {
            $_id = g('id');
            $post = $pdo->getRow("SELECT cb.cb_fullname,cm.*
                                    FROM carbrands cb LEFT JOIN carmodels cm
                                    ON cb.cb_id=cm.cb_id
                                    WHERE cm.cm_published>1 AND cm_id=?", array($_id));
            $reg = g('reg');
            $post['cm_region'] = getTerms("区域",$reg,$post['cm_region']);
        }
        break;
    case 'verify_cm_name'://序号重复性验证
        if(g('cm_name')){
            $cm_name = g('cm_name');
            $cb_id = g('cb_id');
            if(g('id')){
                $cm_id = g('id');
                $result = $pdo->getRow("SELECT count(*) as count FROM carmodels WHERE cm_fullname = ? AND cm_id <> $cm_id AND cb_id = ? AND cm_published>1", array($cm_name,$cb_id));
            }else {
                $result = $pdo->getRow("SELECT count(*) as count FROM carmodels WHERE cm_fullname = ? AND cb_id = ? AND cm_published>1", array($cm_name,$cb_id));
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
                $str_sql = "SELECT cb.cb_fullname,cm_id,cm_list_order,cm_fullname,cm_nickname,cm_short_name,cm_hot_item_tag,cm_create_date,cm_region
                        FROM carbrands cb LEFT JOIN carmodels cm
                        ON cb.cb_id=cm.cb_id
                        WHERE cm.cm_published>1
                        AND (cm.cm_fullname LIKE '%$keyword%' OR cb.cb_fullname LIKE '%$keyword%')
                        ORDER BY cm_create_date " . $order;
            }elseif(!empty($keyword)&&!empty($reg)){
                $str_sql = "SELECT cb.cb_fullname,cm_id,cm_list_order,cm_fullname,cm_nickname,cm_short_name,cm_hot_item_tag,cm_create_date,cm_region
                        FROM carbrands cb LEFT JOIN carmodels cm
                        ON cb.cb_id=cm.cb_id
                        WHERE cm.cm_published>1
                        AND (cm.cm_fullname LIKE '%$keyword%' OR cb.cb_fullname LIKE '%$keyword%')
                        AND cm_region=$reg
                        ORDER BY cm_create_date " . $order;
            }else{
                $str_sql = "SELECT cb.cb_fullname,cm_id,cm_list_order,cm_fullname,cm_nickname,cm_short_name,cm_hot_item_tag,cm_create_date,cm_region
                        FROM carbrands cb LEFT JOIN carmodels cm
                        ON cb.cb_id=cm.cb_id
                        WHERE cm.cm_published>1
                        AND cm_region=$reg
                        ORDER BY cm_create_date ".$order;
            }
        }else {
            $keyword = '';
            $str_sql = "SELECT cb.cb_fullname,cm_id,cm_list_order,cm_fullname,cm_nickname,cm_short_name,cm_hot_item_tag,cm_create_date,cm_region
                        FROM carbrands cb LEFT JOIN carmodels cm
                        ON cb.cb_id=cm.cb_id
                        WHERE cm.cm_published>1
                        ORDER BY cm_create_date ".$order;
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