<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/8
 * Time: 10:24
 */
function d($post){
    $reg = '';
    $post['cbt_region'] = getTerms("区域", $reg, $post['cbt_region']);

    return $post;
}
switch ($_action) {
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $values = gs(array('cbt_fullname', 'cbt_nickname', 'cbt_short_name', 'cbt_list_order', 'cbt_region'));
            $values['cbt_create_date'] = date('Y-m-d H:i:s', time());
            $values['cbt_last_update_date'] = date('Y-m-d H:i:s', time());

            //上传图片文件
            $values['cbt_icon_path'] = uploadFile();
            $res = $pdo->insert('carbodytypes', $values);
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
            $post = $pdo->getRow("SELECT cbt_id,cbt_list_order,cbt_fullname,cbt_nickname,cbt_short_name,cbt_hot_item_tag,cbt_create_date,cbt_icon_path,cbt_region
                                  FROM `carbodytypes`
                                  WHERE cbt_id=? AND cbt_published>1",array($_id));
            $terms_re = getTerms("区域");

            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $values = gs(array('cbt_fullname', 'cbt_nickname', 'cbt_short_name', 'cbt_list_order', 'cbt_region'));
                $values['cbt_last_update_date'] = date('Y-m-d H:i:s', time());
                $upload = uploadFile();
                if(isset($upload)){
                    //上传图片文件
                    $values['cbt_icon_path'] = $upload;
                }else{
                    $values['cbt_icon_path'] = $post['cbt_icon_path'];
                }
                $res = $pdo->update('carbodytypes', $values, array('cbt_id'=>$_id));
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
            $cbt_id = g('id');
            if(g('v')=='verify') {
                $res_c = $pdo->query("SELECT ci_car_bodytype FROM carinfo WHERE ci_car_bodytype='$cbt_id' AND ci_published>1");
                $res_c_count = count($res_c);
                if (empty($res_c_count)) {
                    $res['data'] = 1;//可以删除
                } else {
                    $res['data'] = 2;//不可以删除
                }
            }else {
                $values['cbt_published'] = 1;
                $result = $pdo->update('carbodytypes', $values, array('cbt_id' => $cbt_id));
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
            $post = $pdo->getRow("SELECT * FROM carbodytypes WHERE cbt_id=? AND cbt_published>1",array($_id));
            $reg = g('reg');
            $post['cbt_region'] = getTerms("区域",$reg,$post['cbt_region']);
        }
        break;
    case 'verify'://序号重复性验证
        if(g('list')){
            $list = g('list');
            $res_a = $pdo->query("SELECT cbt_list_order FROM carbodytypes WHERE cbt_published>1");
            $res_b = array_column($res_a, 'cbt_list_order');
            if(g('e')){
                $id = g('e');
                $res_e = $pdo->getRow("SELECT cbt_list_order FROM carbodytypes WHERE cbt_published>1 AND cbt_id=? AND cbt_list_order=?", array($id, $list));
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
        if(g('order') == '1') {
            $order = 'ASC';
        }else{
            $order = 'DESC';
        }
        if(!g('_page')){
            $thispage=1;
        }else{
            $thispage=g('_page');
        }
        if(g('k')||g('r')){
            $keyword = g('k');
            $reg = g('r');
            if(!empty($keyword)&&empty($reg)) {
                $str_sql = "SELECT cbt_id,cbt_list_order,cbt_fullname,cbt_nickname,cbt_short_name,cbt_hot_item_tag,cbt_create_date,cbt_region
                    FROM `carbodytypes`
                    WHERE cbt_published>1
                    AND (cbt_fullname LIKE '%$keyword%' OR cbt_nickname LIKE '%$keyword%')
                    ORDER BY cbt_create_date " . $order;
            }elseif(!empty($keyword)&&!empty($reg)){
                $str_sql = "SELECT cbt_id,cbt_list_order,cbt_fullname,cbt_nickname,cbt_short_name,cbt_hot_item_tag,cbt_create_date,cbt_region
                    FROM `carbodytypes`
                    WHERE cbt_published>1
                    AND (cbt_fullname LIKE '%$keyword%' OR cbt_nickname LIKE '%$keyword%')
                    AND cbt_region=$reg
                    ORDER BY cbt_create_date " . $order;
            }else{
                $str_sql = "SELECT cbt_id,cbt_list_order,cbt_fullname,cbt_nickname,cbt_short_name,cbt_hot_item_tag,cbt_create_date,cbt_region
                    FROM `carbodytypes`
                    WHERE cbt_published>1
                    AND cbt_region=$reg
                    ORDER BY cbt_create_date ".$order;
            }
        }else {
            $keyword = '';
            $str_sql = "SELECT cbt_id,cbt_list_order,cbt_fullname,cbt_nickname,cbt_short_name,cbt_hot_item_tag,cbt_create_date,cbt_region
                    FROM `carbodytypes`
                    WHERE cbt_published>1
                    ORDER BY cbt_create_date ".$order;
        }
        $post = $pdo->query($str_sql);
        $total = count($post);
        $limit = PAGES*($thispage-1); //本页记录数起始位置
        $str = $str_sql.' limit '.$limit.','.PAGES;
        $result=$pdo->query($str);
        $result=array_map('d', $result);
        $terms_re = getTerms("区域");
        break;
}