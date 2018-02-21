<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/7
 * Time: 13:38
 */
function d($post){
    $reg = '';
    $post['cs_region'] = getTerms("区域", $reg, $post['cs_region']);

    return $post;
}
switch ($_action) {
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $values = gs(array('cb_id', 'cm_id', 'cs_fullname', 'cs_nickname', 'cs_short_name', 'cs_list_order', 'cs_region'));
            $values['cs_create_date'] = date('Y-m-d H:i:s', time());
            $values['cs_last_update_date'] = date('Y-m-d H:i:s', time());
            //上传图片文件
//            $values['cs_icon_path'] = uploadFile();
            $res = $pdo->insert('carstyles', $values);
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
            $post = $pdo->getRow("SELECT cs_id,cm_id,cb_id,cs_list_order,cs_fullname,cs_nickname,cs_short_name,cs_hot_item_tag,cs_create_date,cs_icon_path,cs_region
                                  FROM `carstyles`
                                  WHERE cs_id=? AND cs_published>1",array($_id));
            $cb_result = $pdo->getRow("SELECT cb_fullname FROM carbrands WHERE cb_published>1 AND cb_id=?", array($post['cb_id']));
            $cm_result = $pdo->getRow("SELECT cm_fullname FROM carmodels WHERE cm_published>1 AND cm_id=?", array($post['cm_id']));
            $post['cb_fullname']= $cb_result['cb_fullname'];
            $post['cm_fullname']= $cm_result['cm_fullname'];
            $terms_re = getTerms("区域");
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $values = gs(array('cb_id','cm_id', 'cs_fullname', 'cs_nickname', 'cs_short_name', 'cs_list_order', 'cs_region'));
                $values['cs_last_update_date'] = date('Y-m-d H:i:s', time());
//                $upload = uploadFile();
                if(isset($upload)){
                    //上传图片文件
                    $values['cs_icon_path'] = $upload;
                }else{
                    $values['cs_icon_path'] = $post['cs_icon_path'];
                }
                $res = $pdo->update('carstyles', $values, array('cs_id'=>$_id));
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
            $cs_id = g('id');
            if(g('v')=='verify') {
                $res_c = $pdo->query("SELECT ci_model_style FROM carinfo WHERE ci_model_style='$cs_id' AND ci_published>1");
                $res_c_count = count($res_c);
                if (empty($res_c_count)) {
                    $res['data'] = 1;//可以删除
                } else {
                    $res['data'] = 2;//不可以删除
                }
            }else {
                $values['cs_published'] = 1;
                $result = $pdo->update('carstyles', $values, array('cs_id' => $cs_id));
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
            $post = $pdo->getRow("SELECT cb.cb_fullname,cm.cm_fullname,cs.*
                                  FROM carbrands cb LEFT JOIN
                                  (carstyles cs LEFT JOIN carmodels cm on cm.cm_id=cs.cm_id)
                                  ON cb.cb_id=cs.cb_id
                                  WHERE cs.cs_published>1 AND cs.cs_id=?", array($_id));
            $reg = g('reg');
            $post['cs_region'] = getTerms("区域",$reg,$post['cs_region']);
        }
        break;
    case 'verify_cs_name'://重复性验证
        if(g('cs_name')){
            $cs_name = g('cs_name');
            $cb_id = g('cb_id');
            $cm_id = g('cm_id');
            if(g('id')){
                $cs_id = g('id');
                $result = $pdo->getRow("SELECT count(*) as count FROM carstyles WHERE cs_fullname = ? AND cs_id <> $cs_id AND cb_id = ? AND cm_id = ? AND cs_published>1", array($cs_name,$cb_id,$cm_id));
            }else {
                $result = $pdo->getRow("SELECT count(*) as count FROM carstyles WHERE cs_fullname = ? AND cb_id = ? AND cm_id = ? AND cs_published>1", array($cs_name,$cb_id,$cm_id));
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
                $str_sql = "SELECT cb.cb_fullname,cm.cm_fullname,cs_id,cs_list_order,cs_fullname,cs_nickname,cs_short_name,cs_hot_item_tag,cs_create_date,cs_region
                        FROM carbrands cb LEFT JOIN
                        (carstyles cs LEFT JOIN carmodels cm on cm.cm_id=cs.cm_id)
                        ON cb.cb_id=cs.cb_id
                        WHERE cs.cs_published>1
                        AND (cs.cs_fullname LIKE '%$keyword%' OR cm.cm_fullname LIKE '%$keyword%' OR cb.cb_fullname LIKE '%$keyword%')
                        ORDER BY cs.cs_create_date " . $order;
            }elseif(!empty($keyword)&&!empty($reg)) {
                $str_sql = "SELECT cb.cb_fullname,cm.cm_fullname,cs_id,cs_list_order,cs_fullname,cs_nickname,cs_short_name,cs_hot_item_tag,cs_create_date,cs_region
                        FROM carbrands cb LEFT JOIN
                        (carstyles cs LEFT JOIN carmodels cm on cm.cm_id=cs.cm_id)
                        ON cb.cb_id=cs.cb_id
                        WHERE cs.cs_published>1
                        AND (cs.cs_fullname LIKE '%$keyword%' OR cm.cm_fullname LIKE '%$keyword%' OR cb.cb_fullname LIKE '%$keyword%')
                        AND cs_region=$reg
                        ORDER BY cs.cs_create_date " . $order;
            }else{
                $str_sql = "SELECT cb.cb_fullname,cm.cm_fullname,cs_id,cs_list_order,cs_fullname,cs_nickname,cs_short_name,cs_hot_item_tag,cs_create_date,cs_region
                        FROM carbrands cb LEFT JOIN
                        (carstyles cs LEFT JOIN carmodels cm on cm.cm_id=cs.cm_id)
                        ON cb.cb_id=cs.cb_id
                        WHERE cs.cs_published>1
                        AND cs_region=$reg
                        ORDER BY cs.cs_create_date ".$order;
            }
        }else {
            $keyword = '';
            $str_sql = "SELECT cb.cb_fullname,cm.cm_fullname,cs_id,cs_list_order,cs_fullname,cs_nickname,cs_short_name,cs_hot_item_tag,cs_create_date,cs_region
                        FROM carbrands cb LEFT JOIN
                        (carstyles cs LEFT JOIN carmodels cm on cm.cm_id=cs.cm_id)
                        ON cb.cb_id=cs.cb_id
                        WHERE cs.cs_published>1
                        ORDER BY cs.cs_create_date ".$order;
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