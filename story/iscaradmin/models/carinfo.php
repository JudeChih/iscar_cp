<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/8
 * Time: 9:48
 */
function d($post){
    $reg = '';
    $post['ci_region'] = getTerms("区域", $reg, $post['ci_region']);

    return $post;
}
switch ($_action) {
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $values = gs(array(
                        'ci_car_brand', 'ci_brand_model', 'ci_model_style', 'ci_car_bodytype', 'ci_article_title',
                        'ci_car_year_style', 'ci_car_seats', 'ci_car_doors', 'ci_sale_price', 'ci_fuel_tax',
                        'ci_overall_length', 'ci_overall_width', 'ci_overall_height', 'ci_overall_weight', 'ci_wheel_base',
                        'ci_rear_track', 'ci_front_track', 'ci_license_tax', 'ci_luggage_capacity', 'ci_turning_radius',
                        'ci_front_wheel_size', 'ci_rear_wheel_siae', 'ci_aerodynamic_drag', 'ci_ground_clearance', 'ci_tank_capacity',
                        'ci_steering_system', 'ci_front_suspension', 'ci_rear_suspension', 'ci_battery_type', 'ci_battery_capacity',
                        'ci_fueltype', 'ci_max_milage', 'ci_recharge_time', 'ci_urban_consumption', 'ci_high_speed_consumption',
                        'ci_average_consumption', 'ci_displacement', 'ci_compression_ratio', 'ci_cylinder_structure', 'ci_valve_gear',
                        'ci_engine_tech', 'ci_fuel_injection', 'ci_valve_each_cylinder', 'ci_total_valves', 'ci_engine_location',
                        'ci_aspiration', 'ci_max_horsepower', 'ci_max_torque', 'ci_transmission_system', 'ci_drive_mode',
                        'ci_brake_system', 'ci_manufactory', 'ci_carsource', 'ci_technical_cooperation', 'ci_html_descript',
                        'ci_car_video_link', 'ci_web_address', 'cp_part_location',
                        'cp_part_name', 'ci_cylinder_name', 'ci_region', 'tag_id', 'ci_recommend'
                        ));
            $values['ci_create_date'] = date('Y-m-d H:i:s', time());
            $values['ca_main_id'] = g('article_id');

            $res=$pdo->insert('carinfo', $values);
            if($res) {
                $insert_id = $pdo->getRow("SELECT max(ci_id) as ci_id FROM carinfo");

                //选中的经销商/代理商id插入到ci_dist_agent
                $dist_age = !empty($_POST['ci_distribution_agent']) ? $_POST['ci_distribution_agent'] : array();
                $dist_len = count($dist_age);
                for($i=0; $i<$dist_len; $i++){
                    $vd['ci_id'] = $insert_id['ci_id'];
                    $vd['dist_key'] = $dist_age[$i];
                    $pdo->insert('ci_dist_agent', $vd);
                }

                //选中的车辆配备id插入到ci_car_equip
                $car_e = !empty($_POST['ci_car_equiptments']) ? $_POST['ci_car_equiptments'] : array();
                $car_e_len = count($car_e);
                for($i=0; $i<$car_e_len; $i++){
                    $v['ci_id'] = $insert_id['ci_id'];
                    $v['ce_key'] = $car_e[$i];
                    $pdo->insert('ci_car_equip', $v);
                }

                //更新与汽车信息关联的meta表
                $metas = !empty($_POST['meta_id']) ? $_POST['meta_id'] : array();
                $metas_len = count($metas);
                $order = !empty($_POST['order_id']) ? $_POST['order_id'] : array();
                for ($i = 0; $i < $metas_len; $i++) {
                    $vm['ci_id'] = $insert_id['ci_id'];
                    $vm['order_id'] = $order[$i];
                    $pdo->update('carmeta', $vm, array('meta_id' => $metas[$i]));
                }
                //汽车信息与文章关联
                $value = gs(array('article_id'));
                $value['last_update_date'] = date("Y-m-d H:i:s", time());
                $value['ci_id'] = $insert_id['ci_id'];
                
                if($value['article_id']>1) {
                    $pdo->insert('cararticle', $value);
                }

                echo '<script>var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                          parent.layer.close(index); //再执行关闭
                          parent.location.reload();</script>';
            }
            exit();
        }
            $reg = g('reg');
            $terms_ft = getTerms("引擎燃料", $reg);
            $terms_tt = getTerms("车辆税类别", $reg);
            $terms_pl = getTerms("车部件安装位置", $reg);
            $terms_re = getTerms("区域");
            $terms_frs = getTerms("前轮悬吊", $reg);
            $terms_res = getTerms("后轮悬吊", $reg);
            $terms_sts = getTerms("转向系统", $reg);
            $terms_bat = getTerms("电池种类", $reg);
            $terms_cyl = getTerms("气缸构造", $reg);
            $terms_val = getTerms("引擎设计", $reg);
            $terms_eng = getTerms("引擎技术", $reg);
            $terms_fue = getTerms("供油方式", $reg);
            $terms_eng_l = getTerms("引擎位置", $reg);
            $terms_asp = getTerms("进气方式", $reg);
            $terms_dri = getTerms("驱动方式", $reg);
            $terms_cyl_n = getTerms("气缸名称", $reg);
            $terms_tra = getTerms("变速系统", $reg);
            $terms_bra = getTerms("刹车系统", $reg);

        break;
    case 'edit':
        if(g('id')){
            $_id = g('id');
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $values = gs(array(
                    'ci_car_brand', 'ci_brand_model', 'ci_model_style', 'ci_car_bodytype', 'ci_article_title',
                    'ci_car_year_style', 'ci_car_seats', 'ci_car_doors', 'ci_sale_price', 'ci_fuel_tax',
                    'ci_overall_length', 'ci_overall_width', 'ci_overall_height', 'ci_overall_weight', 'ci_wheel_base',
                    'ci_rear_track', 'ci_front_track', 'ci_license_tax', 'ci_luggage_capacity', 'ci_turning_radius',
                    'ci_front_wheel_size', 'ci_rear_wheel_siae', 'ci_aerodynamic_drag', 'ci_ground_clearance', 'ci_tank_capacity',
                    'ci_steering_system', 'ci_front_suspension', 'ci_rear_suspension', 'ci_battery_type', 'ci_battery_capacity',
                    'ci_fueltype', 'ci_max_milage', 'ci_recharge_time', 'ci_urban_consumption', 'ci_high_speed_consumption',
                    'ci_average_consumption', 'ci_displacement', 'ci_compression_ratio', 'ci_cylinder_structure', 'ci_valve_gear',
                    'ci_engine_tech', 'ci_fuel_injection', 'ci_valve_each_cylinder', 'ci_total_valves', 'ci_engine_location',
                    'ci_aspiration', 'ci_max_horsepower', 'ci_max_torque', 'ci_transmission_system', 'ci_drive_mode',
                    'ci_brake_system', 'ci_manufactory', 'ci_carsource', 'ci_technical_cooperation', 'ci_distribution_agent',
                    'ci_car_equiptments', 'ci_html_descript', 'ci_car_video_link', 'ci_web_address', 'cp_part_location',
                    'cp_part_name', 'ci_cylinder_name', 'ci_recommend','ci_region','tag_id'
                ));
                $values['ci_last_update_date'] = date('Y-m-d H:i:s', time());
                $values['ca_main_id'] = g('article_id');
                if(empty($values['ca_main_id'])){
                    $values['ci_article_title'] = '';
                }
                $res = $pdo->update('carinfo', $values, array('ci_id'=>$_id));
                if($res){
                    //选中的经销商/代理商id插入到ci_dist_agent
                    $dist_age = !empty($_POST['ci_distribution_agent']) ? $_POST['ci_distribution_agent'] : array();
                    $dist_len = count($dist_age);
                    if($dist_len>0){
                        $val_d['dist_key'] = null;
                        $val_d['ci_id'] = null;
                        $pdo->update('ci_dist_agent', $val_d,array('ci_id'=>$_id));
                    }
                    for($i=0; $i<$dist_len; $i++){
                        $vv['dist_key'] = $dist_age[$i];
                        $vv['ci_id'] = $_id;
                        $pdo->insert('ci_dist_agent', $vv);
                    }

                    //选中的车辆配备id插入到ci_car_equip
                    $car_e = !empty($_POST['ci_car_equiptments']) ? $_POST['ci_car_equiptments'] : array();
                    $car_e_len = count($car_e);
                    if($car_e_len>0){
                        $val['ce_key'] = null;
                        $val['ci_id'] = null;
                        $pdo->update('ci_car_equip', $val,array('ci_id'=>$_id));
                    }
                    for($i=0; $i<$car_e_len; $i++){
                        $vc['ce_key'] = $car_e[$i];
                        $vc['ci_id'] = $_id;
                        $pdo->insert('ci_car_equip', $vc);
                    }

                    $v['ci_id']=null;
                    $pdo->update('carmeta', $v, array('ci_id'=>$_id));
                    //更新与汽车信息关联的meta表
                    $metas = !empty($_POST['meta_id']) ? $_POST['meta_id'] : array();
                    $metas_len = count($metas);
                    $order = !empty($_POST['order_id']) ? $_POST['order_id'] : array();
                    for ($i = 0; $i < $metas_len; $i++) {
                        $vm['ci_id'] = $_id;
                        $vm['order_id'] = $order[$i];
                        $pdo->update('carmeta', $vm, array('meta_id' => $metas[$i]));
                    }
                    //汽车信息与文章关联
                    $value = gs(array('article_id'));
                    $ci_count=$pdo->getRow("SELECT count(*) as count FROM cararticle WHERE ci_id=? AND article_id=?", array($_id, $value['article_id']));
                    if($ci_count['count'] > 0) {
                        $pdo->update('cararticle', $value, array('ci_id' => $_id, 'article_id'=>$value['article_id']));
                    }else{
                        $value['last_update_date'] = date("Y-m-d H:i:s", time());
                        $value['ci_id'] = $_id;
                        if($value['article_id']>0) {
                            $pdo->insert('cararticle', $value);
                        }
                    }

                    echo '<script>var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                          parent.layer.close(index); //再执行关闭
                          parent.location.reload();</script>';
                }

                exit();
            }
            $post = $pdo->getRow("SELECT * FROM `carinfo` WHERE ci_id=? AND ci_published>1",array($_id));
            $cb_result = $pdo->getRow("SELECT cb_id,cb_fullname FROM carbrands WHERE cb_published>1 AND cb_id=?",array($post['ci_car_brand']));
            $cm_result = $pdo->getRow("SELECT cm_id,cm_fullname FROM carmodels WHERE cm_published>1 AND cm_id=?",array($post['ci_brand_model']));
            $cs_result = $pdo->getRow("SELECT cs_id,cs_fullname FROM carstyles WHERE cs_published>1 AND cs_id=?",array($post['ci_model_style']));
            $cbt_result = $pdo->getRow("SELECT cbt_fullname FROM carbodytypes WHERE cbt_published>1 AND cbt_id=?", array($post['ci_car_bodytype']));

            $reg = g('reg');
            $post['ci_manufactory_v']           = getTerms("制造商", $reg, $post['ci_manufactory']);
            $post['ci_carsource_v']             = getTerms("产地", $reg, $post['ci_carsource']);
            $post['ci_technical_cooperation_v'] = getTerms("技术合作", $reg, $post['ci_technical_cooperation']);
            $post['cbt_fullname']          = $cbt_result['cbt_fullname'];
            $post['cb_fullname']             = $cb_result['cb_fullname'];
            $post['cm_fullname']           = $cm_result['cm_fullname'];
            $post['cs_fullname']           = $cs_result['cs_fullname'];

            $terms_ft = getTerms("引擎燃料", $reg);
            $terms_tt = getTerms("车辆税类别", $reg);
            $terms_pl = getTerms("车部件安装位置", $reg);
            $terms_re = getTerms("区域");
            $terms_frs = getTerms("前轮悬吊", $reg);
            $terms_res = getTerms("后轮悬吊", $reg);
            $terms_ca = getTerms("产地", $reg);
            $terms_brs = getTerms("制造商", $reg);
            $terms_tec = getTerms("技术合作", $reg);
            $terms_sts = getTerms("转向系统", $reg);
            $terms_bat = getTerms("电池种类", $reg);
            $terms_cyl = getTerms("气缸构造", $reg);
            $terms_val = getTerms("引擎设计", $reg);
            $terms_eng = getTerms("引擎技术", $reg);
            $terms_fue = getTerms("供油方式", $reg);
            $terms_eng_l = getTerms("引擎位置", $reg);
            $terms_asp = getTerms("进气方式", $reg);
            $terms_dri = getTerms("驱动方式", $reg);
            $terms_cyl_n = getTerms("气缸名称", $reg);
            $terms_tra = getTerms("变速系统", $reg);
            $terms_bra = getTerms("刹车系统", $reg);

            $img=$pdo->query("SELECT cm.meta_id, order_id, cm.meta_file_path,cm.meta_type
                                FROM carmeta cm LEFT JOIN carinfo ci
                                on ci.ci_id=cm.ci_id WHERE cm.ci_id=$_id");
            $term_di = $pdo->query("SELECT value FROM
                                    ci_dist_agent a LEFT JOIN carterms b
                                    on a.dist_key=b.keyword
                                    WHERE b.term='经销商/代理商' AND a.ci_id=".$_id);//经销商/代理商
            $term_care = $pdo->query("SELECT value FROM
                                    ci_car_equip a LEFT JOIN carterms b
                                    on a.ce_key=b.keyword
                                    WHERE b.term='车辆配备' AND a.ci_id=".$_id);//车辆配备
        }
        break;
    case 'copy':
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $values = gs(array(
                    'ci_car_brand', 'ci_brand_model', 'ci_model_style', 'ci_car_bodytype', 'ci_article_title',
                    'ci_car_year_style', 'ci_car_seats', 'ci_car_doors', 'ci_sale_price', 'ci_fuel_tax',
                    'ci_overall_length', 'ci_overall_width', 'ci_overall_height', 'ci_overall_weight', 'ci_wheel_base',
                    'ci_rear_track', 'ci_front_track', 'ci_license_tax', 'ci_luggage_capacity', 'ci_turning_radius',
                    'ci_front_wheel_size', 'ci_rear_wheel_siae', 'ci_aerodynamic_drag', 'ci_ground_clearance', 'ci_tank_capacity',
                    'ci_steering_system', 'ci_front_suspension', 'ci_rear_suspension', 'ci_battery_type', 'ci_battery_capacity',
                    'ci_fueltype', 'ci_max_milage', 'ci_recharge_time', 'ci_urban_consumption', 'ci_high_speed_consumption',
                    'ci_average_consumption', 'ci_displacement', 'ci_compression_ratio', 'ci_cylinder_structure', 'ci_valve_gear',
                    'ci_engine_tech', 'ci_fuel_injection', 'ci_valve_each_cylinder', 'ci_total_valves', 'ci_engine_location',
                    'ci_aspiration', 'ci_max_horsepower', 'ci_max_torque', 'ci_transmission_system', 'ci_drive_mode',
                    'ci_brake_system', 'ci_manufactory', 'ci_carsource', 'ci_technical_cooperation', 'ci_html_descript',
                    'ci_car_video_link', 'ci_web_address', 'cp_part_location',
                    'cp_part_name', 'ci_cylinder_name', 'ci_region', 'tag_id', 'ci_recommend'
                ));
                $values['ci_create_date'] = date('Y-m-d H:i:s', time());
                $values['ca_main_id'] = g('article_id');

                $res=$pdo->insert('carinfo', $values);
                if($res) {
                    $insert_id = $pdo->getRow("SELECT max(ci_id) as ci_id FROM carinfo");

                    //选中的经销商/代理商id插入到ci_dist_agent
                    $dist_age = !empty($_POST['ci_distribution_agent']) ? $_POST['ci_distribution_agent'] : array();
                    $dist_len = count($dist_age);
                    for($i=0; $i<$dist_len; $i++){
                        $vd['ci_id'] = $insert_id['ci_id'];
                        $vd['dist_key'] = $dist_age[$i];
                        $pdo->insert('ci_dist_agent', $vd);
                    }

                    //选中的车辆配备id插入到ci_car_equip
                    $car_e = !empty($_POST['ci_car_equiptments']) ? $_POST['ci_car_equiptments'] : array();
                    $car_e_len = count($car_e);
                    for($i=0; $i<$car_e_len; $i++){
                        $v['ci_id'] = $insert_id['ci_id'];
                        $v['ce_key'] = $car_e[$i];
                        $pdo->insert('ci_car_equip', $v);
                    }

                    //新增与汽车信息关联的meta表
                    $metas = !empty($_POST['meta_id']) ? $_POST['meta_id'] : array();
                    $metas_len = count($metas);
                    $order = !empty($_POST['order_id']) ? $_POST['order_id'] : array();
                    $meta_type = !empty($_POST['meta_type']) ? $_POST['meta_type'] : array();
                    $meta_file_path = !empty($_POST['meta_file_path']) ? $_POST['meta_file_path'] : array();
                    $meta_date = date('Y-m-d H:i:s', time());
                    for ($i = 0; $i < $metas_len; $i++) {
                        $vm['ci_id'] = $insert_id['ci_id'];
                        $vm['order_id'] = $order[$i];
                        $vm['meta_type'] = $meta_type[$i];
                        $vm['meta_file_path'] = $meta_file_path[$i];
                        $vm['last_update_date'] = $meta_date;
                        $pdo->insert('carmeta', $vm);
                    }

                    //汽车信息与文章关联
                    $value = gs(array('article_id'));
                    $value['last_update_date'] = date("Y-m-d H:i:s", time());
                    $value['ci_id'] = $insert_id['ci_id'];
                    if($value['article_id']>1) {
                        $pdo->insert('cararticle', $value);
                    }

                    echo '<script>var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                          parent.layer.close(index); //再执行关闭
                          parent.location.reload();</script>';
                }
                exit();
            }
        if(g('id')){
            $_id = g('id');
            $reg = g('reg');
            $post = $pdo->getRow("SELECT * FROM `carinfo` WHERE ci_id=? AND ci_published>1",array($_id));
            $cb_result = $pdo->getRow("SELECT cb_id,cb_fullname FROM carbrands WHERE cb_published>1 AND cb_id=?",array($post['ci_car_brand']));
            $cm_result = $pdo->getRow("SELECT cm_id,cm_fullname FROM carmodels WHERE cm_published>1 AND cm_id=?",array($post['ci_brand_model']));
            $cs_result = $pdo->getRow("SELECT cs_id,cs_fullname FROM carstyles WHERE cs_published>1 AND cs_id=?",array($post['ci_model_style']));
            $cbt_result = $pdo->getRow("SELECT cbt_fullname FROM carbodytypes WHERE cbt_published>1 AND cbt_id=?", array($post['ci_car_bodytype']));

            $post['ci_manufactory_v']           = getTerms("制造商", $reg, $post['ci_manufactory']);
            $post['ci_carsource_v']             = getTerms("产地", $reg, $post['ci_carsource']);
            $post['ci_technical_cooperation_v'] = getTerms("技术合作", $reg, $post['ci_technical_cooperation']);

            $terms_ft = getTerms("引擎燃料", $reg);
            $terms_tt = getTerms("车辆税类别", $reg);
            $terms_pl = getTerms("车部件安装位置", $reg);
            $terms_re = getTerms("区域");
            $terms_frs = getTerms("前轮悬吊", $reg);
            $terms_res = getTerms("后轮悬吊", $reg);
            $terms_ca = getTerms("产地", $reg);
            $terms_brs = getTerms("制造商", $reg);
            $terms_tec = getTerms("技术合作", $reg);
            $terms_sts = getTerms("转向系统", $reg);
            $terms_bat = getTerms("电池种类", $reg);
            $terms_cyl = getTerms("气缸构造", $reg);
            $terms_val = getTerms("引擎设计", $reg);
            $terms_eng = getTerms("引擎技术", $reg);
            $terms_fue = getTerms("供油方式", $reg);
            $terms_eng_l = getTerms("引擎位置", $reg);
            $terms_asp = getTerms("进气方式", $reg);
            $terms_dri = getTerms("驱动方式", $reg);
            $terms_cyl_n = getTerms("气缸名称", $reg);
            $terms_tra = getTerms("变速系统", $reg);
            $terms_bra = getTerms("刹车系统", $reg);

            $img=$pdo->query("SELECT cm.meta_id, order_id, cm.meta_file_path,cm.meta_type
                                FROM carmeta cm LEFT JOIN carinfo ci
                                on ci.ci_id=cm.ci_id WHERE cm.ci_id=$_id");

            if($post['ci_region']==$reg) {//当传过来的区域等于该汽车信息的区域，则显示
                $post['cbt_fullname'] = $cbt_result['cbt_fullname'];
                $post['cb_fullname'] = $cb_result['cb_fullname'];
                $post['cm_fullname'] = $cm_result['cm_fullname'];
                $post['cs_fullname'] = $cs_result['cs_fullname'];
                $term_di = $pdo->query("SELECT keyword,value FROM
                                    ci_dist_agent a LEFT JOIN carterms b
                                    on a.dist_key=b.keyword
                                    WHERE b.term='经销商/代理商' AND a.ci_id=" . $_id);//经销商/代理商
                $term_care = $pdo->query("SELECT keyword,value FROM
                                    ci_car_equip a LEFT JOIN carterms b
                                    on a.ce_key=b.keyword
                                    WHERE b.term='车辆配备' AND a.ci_id=" . $_id);//车辆配备
            }
        }
        break;
    case 'del':
        if(g('id')) {
            $values['ci_published'] = 1;
            $res = $pdo->update('carinfo', $values, array('ci_id' => g('id')));
            if($res){
                header('Location:'. $_SERVER[HTTP_REFERER]);
                exit();
            }
        }
        exit;
    case 'detail':
        if(g('id')) {
            $_id = g('id');
            $post = $pdo->getRow("SELECT cbt.cbt_fullname,cs.cs_fullname,cm.cm_fullname,cb.cb_fullname,ci.*
                                  FROM ((((`carinfo` ci
                                  LEFT JOIN carbodytypes cbt on cbt.cbt_id=ci.ci_car_bodytype)
                                  LEFT JOIN carstyles cs ON cs.cs_id=ci.ci_model_style)
                                  LEFT JOIN carmodels cm on cm.cm_id=ci.ci_brand_model)
                                  LEFT JOIN carbrands cb on cb.cb_id=ci.ci_car_brand) WHERE ci.ci_id=? AND ci.ci_published>1",array($_id));
            $reg = g('reg');
            $post['ci_fueltype']                = getTerms("引擎燃料", $reg, $post['ci_fueltype']);
            $post['ct_tax_type']                = getTerms("车辆税类别", $reg, $post['ct_tax_type']);
            $post['cp_part_location']           = getTerms("车部件安装位置", $reg, $post['cp_part_location']);
            $post['ci_region']                  = getTerms("区域", $reg, $post['ci_region']);
            $post['ci_front_suspension']        = getTerms("前轮悬吊", $reg, $post['ci_front_suspension']);
            $post['ci_rear_suspension']         = getTerms("后轮悬吊", $reg, $post['ci_rear_suspension']);
            $post['ci_distribution_agent']      = getTerms("经销商/代理商", $reg, $post['ci_distribution_agent']);
            $post['ci_carsource']               = getTerms("产地", $reg, $post['ci_carsource']);
            $post['ci_manufactory']             = getTerms("制造商", $reg, $post['ci_manufactory']);
            $post['ci_technical_cooperation']   = getTerms("技术合作", $reg, $post['ci_technical_cooperation']);
            $post['ci_steering_system']         = getTerms("转向系统", $reg, $post['ci_steering_system']);
            $post['ci_battery_type']            = getTerms("电池种类", $reg, $post['ci_battery_type']);
            $post['ci_cylinder_structure']      = getTerms("气缸构造", $reg, $post['ci_cylinder_structure']);
            $post['ci_valve_gear']              = getTerms("引擎设计", $reg, $post['ci_valve_gear']);
            $post['ci_engine_tech']             = getTerms("引擎技术", $reg, $post['ci_engine_tech']);
            $post['ci_fuel_injection']          = getTerms("供油方式", $reg, $post['ci_fuel_injection']);
            $post['ci_engine_location']         = getTerms("引擎位置", $reg, $post['ci_engine_location']);
            $post['ci_aspiration']              = getTerms("进气方式", $reg, $post['ci_aspiration']);
            $post['ci_drive_mode']              = getTerms("驱动方式", $reg, $post['ci_drive_mode']);
            $post['ci_cylinder_name']           = getTerms("气缸名称", $reg, $post['ci_cylinder_name']);
            $post['ci_transmission_system']     = getTerms("变速系统", $reg, $post['ci_transmission_system']);
            $post['ci_brake_system']            = getTerms("刹车系统", $reg, $post['ci_brake_system']);

            $img=$pdo->query("SELECT cm.meta_file_path,cm.meta_type
                                FROM carmeta cm LEFT JOIN carinfo ci
                                on ci.ci_id=cm.ci_id WHERE cm.ci_id=$_id");

            $term_di = $pdo->query("SELECT value FROM
                                    ci_dist_agent a LEFT JOIN carterms b
                                    on a.dist_key=b.keyword
                                    WHERE b.term='经销商/代理商' AND a.ci_id=".$_id);//经销商/代理商
            $term_care = $pdo->query("SELECT value FROM
                                    ci_car_equip a LEFT JOIN carterms b
                                    on a.ce_key=b.keyword
                                    WHERE b.term='车辆配备' AND a.ci_id=".$_id);//车辆配备
        }
        break;
    case 'ajax_search':
        function ajax_d($post){
            global $pdo;
            $res = $pdo->getRow('SELECT name FROM jw_term_relationships jtr LEFT JOIN jw_terms jt ON jtr.term_taxonomy_id=jt.term_id WHERE jtr.object_id=?', array($post['id']));
            $post['post_title'] = $post['post_title'].'--'.$res['name'];
            $post['post_title'] = str_replace("'",'"',$post['post_title']);
            $post['post_title'] = htmlspecialchars($post['post_title'], ENT_QUOTES );

            return $post;
        }
        if(g('searchContent')) {
            $keyword = g('searchContent');
            $message = $pdo->query("SELECT id,post_title
                                FROM jw_posts
                                WHERE post_status='publish'
                                AND post_title like '%$keyword%'
                                ORDER BY post_date DESC LIMIT 20");
            $message = array_map('ajax_d', $message);
            if ($message) {
                $line == 0;
                $num = count($message);
                foreach ($message as $m) {
                    $line++;
                    echo '<li onClick="fill(\''.$m['post_title'].'\', ' . $m['id'] . ');">' . $m['post_title'] . '</li>';
                    if ($line < $num) {
                        echo "<hr />";
                    }
                }
            }
        }
        exit;
    case 'ajax_import_excel':
        uploadexcel();
        exit;
    case 'ajax_img':
        $typeArr = array("jpg", "png", "gif");//允许上传文件格式
        $date = date('Y-m-d', time());
        $doc = '../iscaradmin/';
        $up = 'uploads/'.$date.'/';//上传路径
        $path = $doc.$up;
        if(! file_exists($path)) {
            if(! mkdir($path, 0755 ,true)) {
                die("failed to create save folder $path");
            }
        }
        if (isset($_POST)) {
            $name = $_FILES['file']['name'];
            $size = $_FILES['file']['size'];
            $name_tmp = $_FILES['file']['tmp_name'];
            if (empty($name)) {
                echo json_encode(array("error"=>"您还未选择图片"));
                exit;
            }
            $type = strtolower(substr(strrchr($name, '.'), 1)); //获取文件类型

            if (!in_array($type, $typeArr)) {
                echo json_encode(array("error"=>"请上传jpg,png或gif类型的图片！"));
                exit;
            }
            if ($size > (10000 * 1024)) {
                echo json_encode(array("error"=>"图片大小已超过10mb！"));
                exit;
            }

            $pic_name = time() . rand(10000, 99999) . "." . $type;//图片名称
            $pic_url = $path . $pic_name;//上传后图片路径+名称
            if (move_uploaded_file($name_tmp, $pic_url)) { //临时文件转移到目标文件夹
                $values['meta_type'] = g('meta_type');
                $values['last_update_date'] = date('Y-m-d H:i:s', time());
                $values['meta_file_path'] = $up.$pic_name;

                $res = $pdo->insert('carmeta', $values);
                if($res) {
                    $mid = $pdo->getRow("SELECT max(meta_id) as meta_id FROM carmeta");
                    $meta_id = $mid['meta_id'];
                    echo json_encode(array("error" => "0", "pic" => $pic_url, "name" => $pic_name, "meta_id" => $meta_id));
                }else{
                    echo json_encode(array("error"=>"上传有误！"));
                }
            } else {
                echo json_encode(array("error"=>"上传有误，清检查服务器配置！"));
            }
        }
        exit();
    default:
        if(g('recommend') == '1') {
            $order = 'ASC';
        }else{
            $order = 'DESC';
        }
        if(!empty(g('recommend'))){
            if (g('k') || g('k_start') || g('k_end') || g('r')) {
                $keyword = g('k');
                $reg = g('r');
                $st_keyword = g('k_start');
                $en_keyword = g('k_end');
                if (!empty($keyword) && empty($st_keyword) && empty($en_keyword) && empty($reg)) {
                    $str_sql = "SELECT cbt.cbt_fullname,cs.cs_fullname,cm.cm_fullname,cb.cb_fullname,ci_id,ci_article_title,ci_car_year_style,ci_sale_price,ci_create_date,ci_recommend,ci_region
                                  FROM ((((`carinfo` ci
                                  LEFT JOIN carbodytypes cbt on cbt.cbt_id=ci.ci_car_bodytype)
                                  LEFT JOIN carstyles cs ON cs.cs_id=ci.ci_model_style)
                                  LEFT JOIN carmodels cm on cm.cm_id=ci.ci_brand_model)
                                  LEFT JOIN carbrands cb on cb.cb_id=ci.ci_car_brand) WHERE ci.ci_published>1
                                AND (ci.ci_article_title LIKE '%$keyword%' OR ci.ci_car_year_style LIKE '%$keyword%'
                                     OR cb.cb_fullname LIKE '%$keyword%' OR cm.cm_fullname LIKE '%$keyword%'
                                     OR cbt.cbt_fullname LIKE '%$keyword%' OR cs.cs_fullname LIKE '%$keyword%')
                                ORDER BY ci.ci_recommend $order,ci.ci_create_date $order";
                } elseif (!empty($st_keyword) && !empty($en_keyword) && empty($keyword) && empty($reg)) {
                    $str_sql = "SELECT cbt.cbt_fullname,cs.cs_fullname,cm.cm_fullname,cb.cb_fullname,ci_id,ci_article_title,ci_car_year_style,ci_sale_price,ci_create_date,ci_recommend,ci_region
                                  FROM ((((`carinfo` ci
                                  LEFT JOIN carbodytypes cbt on cbt.cbt_id=ci.ci_car_bodytype)
                                  LEFT JOIN carstyles cs ON cs.cs_id=ci.ci_model_style)
                                  LEFT JOIN carmodels cm on cm.cm_id=ci.ci_brand_model)
                                  LEFT JOIN carbrands cb on cb.cb_id=ci.ci_car_brand) WHERE ci.ci_published>1
                                AND (date(ci.ci_create_date) BETWEEN '$st_keyword' AND '$en_keyword')
                                ORDER BY ci.ci_recommend $order,ci.ci_create_date $order";
                } elseif (!empty($st_keyword) && !empty($en_keyword) && !empty($keyword) && empty($reg)) {
                    $str_sql = "SELECT cbt.cbt_fullname,cs.cs_fullname,cm.cm_fullname,cb.cb_fullname,ci_id,ci_article_title,ci_car_year_style,ci_sale_price,ci_create_date,ci_recommend,ci_region
                                  FROM ((((`carinfo` ci
                                  LEFT JOIN carbodytypes cbt on cbt.cbt_id=ci.ci_car_bodytype)
                                  LEFT JOIN carstyles cs ON cs.cs_id=ci.ci_model_style)
                                  LEFT JOIN carmodels cm on cm.cm_id=ci.ci_brand_model)
                                  LEFT JOIN carbrands cb on cb.cb_id=ci.ci_car_brand) WHERE ci.ci_published>1
                    AND (date(ci.ci_create_date) BETWEEN '$st_keyword' AND '$en_keyword')
                    AND (ci.ci_article_title LIKE '%$keyword%' OR ci.ci_car_year_style LIKE '%$keyword%'
                         OR cb.cb_fullname LIKE '%$keyword%' OR cm.cm_fullname LIKE '%$keyword%'
                         OR cbt.cbt_fullname LIKE '%$keyword%' OR cs.cs_fullname LIKE '%$keyword%')
                    ORDER BY ci.ci_recommend $order,ci.ci_create_date $order";
                } else if (!empty($keyword) && !empty($st_keyword) && !empty($en_keyword) && !empty($reg)) {
                    $str_sql = "SELECT cbt.cbt_fullname,cs.cs_fullname,cm.cm_fullname,cb.cb_fullname,ci_id,ci_article_title,ci_car_year_style,ci_sale_price,ci_create_date,ci_recommend,ci_region
                                  FROM ((((`carinfo` ci
                                  LEFT JOIN carbodytypes cbt on cbt.cbt_id=ci.ci_car_bodytype)
                                  LEFT JOIN carstyles cs ON cs.cs_id=ci.ci_model_style)
                                  LEFT JOIN carmodels cm on cm.cm_id=ci.ci_brand_model)
                                  LEFT JOIN carbrands cb on cb.cb_id=ci.ci_car_brand) WHERE ci.ci_published>1
                                AND (date(ci.ci_create_date) BETWEEN '$st_keyword' AND '$en_keyword')
                                AND (ci.ci_article_title LIKE '%$keyword%' OR ci.ci_car_year_style LIKE '%$keyword%'
                                     OR cb.cb_fullname LIKE '%$keyword%' OR cm.cm_fullname LIKE '%$keyword%'
                                     OR cbt.cbt_fullname LIKE '%$keyword%' OR cs.cs_fullname LIKE '%$keyword%')
                                AND ci_region=$reg
                                ORDER BY ci.ci_recommend $order,ci.ci_create_date $order";
                } else if (!empty($keyword) && empty($st_keyword) && empty($en_keyword) && !empty($reg)) {
                    $str_sql = "SELECT cbt.cbt_fullname,cs.cs_fullname,cm.cm_fullname,cb.cb_fullname,ci_id,ci_article_title,ci_car_year_style,ci_sale_price,ci_create_date,ci_recommend,ci_region
                                  FROM ((((`carinfo` ci
                                  LEFT JOIN carbodytypes cbt on cbt.cbt_id=ci.ci_car_bodytype)
                                  LEFT JOIN carstyles cs ON cs.cs_id=ci.ci_model_style)
                                  LEFT JOIN carmodels cm on cm.cm_id=ci.ci_brand_model)
                                  LEFT JOIN carbrands cb on cb.cb_id=ci.ci_car_brand) WHERE ci.ci_published>1
                                AND (ci.ci_article_title LIKE '%$keyword%' OR ci.ci_car_year_style LIKE '%$keyword%'
                                     OR cb.cb_fullname LIKE '%$keyword%' OR cm.cm_fullname LIKE '%$keyword%'
                                     OR cbt.cbt_fullname LIKE '%$keyword%' OR cs.cs_fullname LIKE '%$keyword%')
                                AND ci_region=$reg
                                ORDER BY ci.ci_recommend $order,ci.ci_create_date $order";
                } elseif (!empty($st_keyword) && !empty($en_keyword) && empty($keyword) && !empty($reg)) {
                    $str_sql = "SELECT cbt.cbt_fullname,cs.cs_fullname,cm.cm_fullname,cb.cb_fullname,ci_id,ci_article_title,ci_car_year_style,ci_sale_price,ci_create_date,ci_recommend,ci_region
                                  FROM ((((`carinfo` ci
                                  LEFT JOIN carbodytypes cbt on cbt.cbt_id=ci.ci_car_bodytype)
                                  LEFT JOIN carstyles cs ON cs.cs_id=ci.ci_model_style)
                                  LEFT JOIN carmodels cm on cm.cm_id=ci.ci_brand_model)
                                  LEFT JOIN carbrands cb on cb.cb_id=ci.ci_car_brand) WHERE ci.ci_published>1
                                AND (date(ci.ci_create_date) BETWEEN '$st_keyword' AND '$en_keyword')
                                AND ci_region=$reg
                                ORDER BY ci.ci_recommend $order,ci.ci_create_date $order";
                } else if (!empty(g('r'))) {
                    $reg = g('r');
                    $str_sql = "SELECT cbt.cbt_fullname,cs.cs_fullname,cm.cm_fullname,cb.cb_fullname,ci_id,ci_article_title,ci_car_year_style,ci_sale_price,ci_create_date,ci_recommend,ci_region
                                  FROM ((((`carinfo` ci
                                  LEFT JOIN carbodytypes cbt on cbt.cbt_id=ci.ci_car_bodytype)
                                  LEFT JOIN carstyles cs ON cs.cs_id=ci.ci_model_style)
                                  LEFT JOIN carmodels cm on cm.cm_id=ci.ci_brand_model)
                                  LEFT JOIN carbrands cb on cb.cb_id=ci.ci_car_brand) WHERE ci.ci_published>1
                                  AND ci_region = $reg
                    ORDER BY ci.ci_recommend $order,ci.ci_create_date $order";
                } else {
                    return false;
                }
            } else {
                $keyword = '';
                $str_sql = "SELECT cbt.cbt_fullname,cs.cs_fullname,cm.cm_fullname,cb.cb_fullname,ci_id,ci_article_title,ci_car_year_style,ci_sale_price,ci_create_date,ci_recommend,ci_region
                                  FROM ((((`carinfo` ci
                                  LEFT JOIN carbodytypes cbt on cbt.cbt_id=ci.ci_car_bodytype)
                                  LEFT JOIN carstyles cs ON cs.cs_id=ci.ci_model_style)
                                  LEFT JOIN carmodels cm on cm.cm_id=ci.ci_brand_model)
                                  LEFT JOIN carbrands cb on cb.cb_id=ci.ci_car_brand) WHERE ci.ci_published>1
                    ORDER BY ci.ci_recommend $order,ci.ci_create_date $order";
            }
        }else {
            if (g('k') || g('k_start') || g('k_end') || g('r')) {
                $keyword = g('k');
                $reg = g('r');
                $st_keyword = g('k_start');
                $en_keyword = g('k_end');
                if (!empty($keyword) && empty($st_keyword) && empty($en_keyword) && empty($reg)) {
                    $str_sql = "SELECT cbt.cbt_fullname,cs.cs_fullname,cm.cm_fullname,cb.cb_fullname,ci_id,ci_article_title,ci_car_year_style,ci_sale_price,ci_create_date,ci_recommend,ci_region
                                  FROM ((((`carinfo` ci
                                  LEFT JOIN carbodytypes cbt on cbt.cbt_id=ci.ci_car_bodytype)
                                  LEFT JOIN carstyles cs ON cs.cs_id=ci.ci_model_style)
                                  LEFT JOIN carmodels cm on cm.cm_id=ci.ci_brand_model)
                                  LEFT JOIN carbrands cb on cb.cb_id=ci.ci_car_brand) WHERE ci.ci_published>1
                                AND (ci.ci_article_title LIKE '%$keyword%' OR ci.ci_car_year_style LIKE '%$keyword%'
                                     OR cb.cb_fullname LIKE '%$keyword%' OR cm.cm_fullname LIKE '%$keyword%'
                                     OR cbt.cbt_fullname LIKE '%$keyword%' OR cs.cs_fullname LIKE '%$keyword%')
                                ORDER BY ci.ci_create_date DESC";
                } elseif (!empty($st_keyword) && !empty($en_keyword) && empty($keyword) && empty($reg)) {
                    $str_sql = "SELECT cbt.cbt_fullname,cs.cs_fullname,cm.cm_fullname,cb.cb_fullname,ci_id,ci_article_title,ci_car_year_style,ci_sale_price,ci_create_date,ci_recommend,ci_region
                                  FROM ((((`carinfo` ci
                                  LEFT JOIN carbodytypes cbt on cbt.cbt_id=ci.ci_car_bodytype)
                                  LEFT JOIN carstyles cs ON cs.cs_id=ci.ci_model_style)
                                  LEFT JOIN carmodels cm on cm.cm_id=ci.ci_brand_model)
                                  LEFT JOIN carbrands cb on cb.cb_id=ci.ci_car_brand) WHERE ci.ci_published>1
                                AND (date(ci.ci_create_date) BETWEEN '$st_keyword' AND '$en_keyword')
                                ORDER BY ci.ci_create_date DESC";
                } elseif (!empty($st_keyword) && !empty($en_keyword) && !empty($keyword) && empty($reg)) {
                    $str_sql = "SELECT cbt.cbt_fullname,cs.cs_fullname,cm.cm_fullname,cb.cb_fullname,ci_id,ci_article_title,ci_car_year_style,ci_sale_price,ci_create_date,ci_recommend,ci_region
                                  FROM ((((`carinfo` ci
                                  LEFT JOIN carbodytypes cbt on cbt.cbt_id=ci.ci_car_bodytype)
                                  LEFT JOIN carstyles cs ON cs.cs_id=ci.ci_model_style)
                                  LEFT JOIN carmodels cm on cm.cm_id=ci.ci_brand_model)
                                  LEFT JOIN carbrands cb on cb.cb_id=ci.ci_car_brand) WHERE ci.ci_published>1
                    AND (date(ci.ci_create_date) BETWEEN '$st_keyword' AND '$en_keyword')
                    AND (ci.ci_article_title LIKE '%$keyword%' OR ci.ci_car_year_style LIKE '%$keyword%'
                         OR cb.cb_fullname LIKE '%$keyword%' OR cm.cm_fullname LIKE '%$keyword%'
                         OR cbt.cbt_fullname LIKE '%$keyword%' OR cs.cs_fullname LIKE '%$keyword%')
                    ORDER BY ci.ci_create_date DESC";
                } else if (!empty($keyword) && !empty($st_keyword) && !empty($en_keyword) && !empty($reg)) {
                    $str_sql = "SELECT cbt.cbt_fullname,cs.cs_fullname,cm.cm_fullname,cb.cb_fullname,ci_id,ci_article_title,ci_car_year_style,ci_sale_price,ci_create_date,ci_recommend,ci_region
                                  FROM ((((`carinfo` ci
                                  LEFT JOIN carbodytypes cbt on cbt.cbt_id=ci.ci_car_bodytype)
                                  LEFT JOIN carstyles cs ON cs.cs_id=ci.ci_model_style)
                                  LEFT JOIN carmodels cm on cm.cm_id=ci.ci_brand_model)
                                  LEFT JOIN carbrands cb on cb.cb_id=ci.ci_car_brand) WHERE ci.ci_published>1
                                AND (date(ci.ci_create_date) BETWEEN '$st_keyword' AND '$en_keyword')
                                AND (ci.ci_article_title LIKE '%$keyword%' OR ci.ci_car_year_style LIKE '%$keyword%'
                                     OR cb.cb_fullname LIKE '%$keyword%' OR cm.cm_fullname LIKE '%$keyword%'
                                     OR cbt.cbt_fullname LIKE '%$keyword%' OR cs.cs_fullname LIKE '%$keyword%')
                                AND ci_region=$reg
                                ORDER BY ci.ci_create_date DESC";
                } else if (!empty($keyword) && empty($st_keyword) && empty($en_keyword) && !empty($reg)) {
                    $str_sql = "SELECT cbt.cbt_fullname,cs.cs_fullname,cm.cm_fullname,cb.cb_fullname,ci_id,ci_article_title,ci_car_year_style,ci_sale_price,ci_create_date,ci_recommend,ci_region
                                  FROM ((((`carinfo` ci
                                  LEFT JOIN carbodytypes cbt on cbt.cbt_id=ci.ci_car_bodytype)
                                  LEFT JOIN carstyles cs ON cs.cs_id=ci.ci_model_style)
                                  LEFT JOIN carmodels cm on cm.cm_id=ci.ci_brand_model)
                                  LEFT JOIN carbrands cb on cb.cb_id=ci.ci_car_brand) WHERE ci.ci_published>1
                                AND (ci.ci_article_title LIKE '%$keyword%' OR ci.ci_car_year_style LIKE '%$keyword%'
                                     OR cb.cb_fullname LIKE '%$keyword%' OR cm.cm_fullname LIKE '%$keyword%'
                                     OR cbt.cbt_fullname LIKE '%$keyword%' OR cs.cs_fullname LIKE '%$keyword%')
                                AND ci_region=$reg
                                ORDER BY ci.ci_create_date DESC";
                } elseif (!empty($st_keyword) && !empty($en_keyword) && empty($keyword) && !empty($reg)) {
                    $str_sql = "SELECT cbt.cbt_fullname,cs.cs_fullname,cm.cm_fullname,cb.cb_fullname,ci_id,ci_article_title,ci_car_year_style,ci_sale_price,ci_create_date,ci_recommend,ci_region
                                  FROM ((((`carinfo` ci
                                  LEFT JOIN carbodytypes cbt on cbt.cbt_id=ci.ci_car_bodytype)
                                  LEFT JOIN carstyles cs ON cs.cs_id=ci.ci_model_style)
                                  LEFT JOIN carmodels cm on cm.cm_id=ci.ci_brand_model)
                                  LEFT JOIN carbrands cb on cb.cb_id=ci.ci_car_brand) WHERE ci.ci_published>1
                                AND (date(ci.ci_create_date) BETWEEN '$st_keyword' AND '$en_keyword')
                                AND ci_region=$reg
                                ORDER BY ci.ci_create_date DESC";
                } else if (!empty(g('r'))) {
                    $reg = g('r');
                    $str_sql = "SELECT cbt.cbt_fullname,cs.cs_fullname,cm.cm_fullname,cb.cb_fullname,ci_id,ci_article_title,ci_car_year_style,ci_sale_price,ci_create_date,ci_recommend,ci_region
                                  FROM ((((`carinfo` ci
                                  LEFT JOIN carbodytypes cbt on cbt.cbt_id=ci.ci_car_bodytype)
                                  LEFT JOIN carstyles cs ON cs.cs_id=ci.ci_model_style)
                                  LEFT JOIN carmodels cm on cm.cm_id=ci.ci_brand_model)
                                  LEFT JOIN carbrands cb on cb.cb_id=ci.ci_car_brand) WHERE ci.ci_published>1
                                  AND ci_region = $reg
                    ORDER BY ci.ci_create_date DESC";
                } else {
                    return false;
                }
            } else {
                $keyword = '';
                $str_sql = "SELECT cbt.cbt_fullname,cs.cs_fullname,cm.cm_fullname,cb.cb_fullname,ci_id,ci_article_title,ci_car_year_style,ci_sale_price,ci_create_date,ci_recommend,ci_region
                                  FROM ((((`carinfo` ci
                                  LEFT JOIN carbodytypes cbt on cbt.cbt_id=ci.ci_car_bodytype)
                                  LEFT JOIN carstyles cs ON cs.cs_id=ci.ci_model_style)
                                  LEFT JOIN carmodels cm on cm.cm_id=ci.ci_brand_model)
                                  LEFT JOIN carbrands cb on cb.cb_id=ci.ci_car_brand) WHERE ci.ci_published>1
                    ORDER BY ci.ci_create_date DESC";
            }
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
        $result = $pdo->query($str);
        $result = array_map('d', $result);
        $terms_re = getTerms("区域");
        break;
}