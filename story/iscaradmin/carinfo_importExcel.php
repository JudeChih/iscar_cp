<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/13
 * Time: 16:04
 */
header('Content-Type: text/html; charset=UTF-8');
include ('./lib/PHPExcel/IOFactory.php');
$date = date('Y-m-d', time());
$time = date('Y-m-d H:i:s', time());
if(g('filename')){
    $fileName = g('filename');
    $filePath = './excel/'.$date.'/'.$fileName;
    $type = strtolower(pathinfo($fileName, PATHINFO_EXTENSION) );

    if (!file_exists($filePath)) {
        die('no file!');
    }

    //根据不同类型分别操作
    if( $type=='csv' ){
        $objReader = PHPExcel_IOFactory::createReader('CSV')
                    ->setDelimiter(',')
                    ->setInputEncoding('GBK') //不设置将导致中文列内容返回boolean(false)或乱码
                    ->setEnclosure('"')
                    ->setLineEnding("\r\n")
                    ->setSheetIndex(0);
        $objPHPExcel = $objReader->load($filePath);
    }else{
        die('Not supported file types!');
    }
    //选择标签页
    $sheet = $objPHPExcel->getSheet(0);

    //获取行数与列数,注意列数需要转换
    $highestRowNum = $sheet->getHighestRow();
    $highestColumn = $sheet->getHighestColumn();
    $highestColumnNum = PHPExcel_Cell::columnIndexFromString($highestColumn);

    if($highestRowNum>1) {
        //取得字段，这里测试表格中的第一行为数据的字段，因此先取出用来作后面数组的键名
        $filed = array();
        $filed[] = 'unique_carinfo_id';
        $filed[] = 'ci_car_year_style';
        $filed[] = 'ci_car_brand';
        $filed[] = 'ci_brand_model';
        $filed[] = 'ci_model_style';
        $filed[] = 'ci_car_bodytype';
        $filed[] = 'ci_car_seats';
        $filed[] = 'ci_car_doors';
        $filed[] = 'ci_sale_price';
        $filed[] = 'ci_fuel_tax';
        $filed[] = 'ci_license_tax';
        $filed[] = 'ci_overall_length';
        $filed[] = 'ci_overall_width';
        $filed[] = 'ci_overall_height';
        $filed[] = 'ci_overall_weight';
        $filed[] = 'ci_wheel_base';
        $filed[] = 'ci_rear_track';
        $filed[] = 'ci_front_track';
        $filed[] = 'ci_luggage_capacity';
        $filed[] = 'ci_turning_radius';
        $filed[] = 'ci_front_wheel_size';
        $filed[] = 'ci_rear_wheel_siae';
        $filed[] = 'ci_aerodynamic_drag';
        $filed[] = 'ci_ground_clearance';
        $filed[] = 'ci_tank_capacity';
        $filed[] = 'ci_steering_system';
        $filed[] = 'ci_front_suspension';
        $filed[] = 'ci_rear_suspension';
        $filed[] = 'ci_fueltype';
        $filed[] = 'ci_battery_type';
        $filed[] = 'ci_battery_capacity';
        $filed[] = 'ci_max_milage';
        $filed[] = 'ci_recharge_time';
        $filed[] = 'ci_urban_consumption';
        $filed[] = 'ci_high_speed_consumption';
        $filed[] = 'ci_average_consumption';
        $filed[] = 'ci_displacement';
        $filed[] = 'ci_compression_ratio';
        $filed[] = 'ci_cylinder_structure';
        $filed[] = 'ci_valve_gear';
        $filed[] = 'ci_engine_tech';
        $filed[] = 'ci_fuel_injection';
        $filed[] = 'ci_valve_each_cylinder';
        $filed[] = 'ci_total_valves';
        $filed[] = 'ci_engine_location';
        $filed[] = 'ci_aspiration';
        $filed[] = 'ci_max_horsepower';
        $filed[] = 'ci_max_torque';
        $filed[] = 'ci_transmission_system';
        $filed[] = 'ci_drive_mode';
        $filed[] = 'ci_brake_system';
        $filed[] = 'ci_manufactory';
        $filed[] = 'ci_carsource';
        $filed[] = 'ci_technical_cooperation';
        $filed[] = 'ci_html_descript';
        $filed[] = 'ci_car_video_link';
        $filed[] = 'ci_web_address';
        $filed[] = 'cp_part_location';
        $filed[] = 'cp_part_name';
        $filed[] = 'ci_cylinder_name';
        $filed[] = 'ci_region';
        $filed[] = 'ci_distribution_agent';//经销商/代理商
        $filed[] = 'ci_car_equiptments';//车辆配备

        //开始取出数据并存入数组
        $data = array();
        for ($i = 2; $i <= $highestRowNum; $i++) {//ignore row 1
            $row = array();
            for ($j = 0; $j < $highestColumnNum; $j++) {
                $cellName = PHPExcel_Cell::stringFromColumnIndex($j) . $i;
                $cellVal = $sheet->getCell($cellName)->getValue();
                $row[$filed[$j]] = $cellVal;
            }
            $data [] = $row;
        }

        //完成，可以存入数据库了
        for ($i = 0; $i < count($data); $i++) {
            $value = $data[$i];
            $value['ci_create_date'] = $time;

            $dist = $value['ci_distribution_agent'];
            $ce = $value['ci_car_equiptments'];
            $arr_dist = explode(",", $dist);
            $arr_ce = explode(",", $ce);
            $count = $pdo->getRow("SELECT COUNT(*) as count FROM carinfo WHERE unique_carinfo_id=?", array($value['unique_carinfo_id']));
            if ($count['count'] != 1) {
                $res_import = $pdo->insert("carinfo", $value);
                if($res_import){
                    $insert_id = $pdo->getRow("SELECT max(ci_id) as ci_id FROM carinfo");
                    if(sizeof($arr_dist)>0){
                        foreach($arr_dist as $d){
                            $val['dist_key'] = $d;
                            $val['ci_id'] = $insert_id['ci_id'];
                            $pdo->insert("ci_dist_agent", $val);
                        }
                    }
                    if(sizeof($arr_ce)>0){
                        foreach($arr_ce as $c){
                            $val_c['ce_key'] = $c;
                            $val_c['ci_id'] = $insert_id['ci_id'];
                            $pdo->insert("ci_car_equip", $val_c);
                        }
                    }
                }else{
                    $res_import = 4;
                }
            } else {
                $res_import = 2;
            }
        }
    }else{
        $res_import=3;
    }

    if($res_import==1){
        $res['msg']=1;//成功
    }elseif($res_import==2){
        $res['msg']=2;//失败，存在重复数据
    }elseif($res_import==3){
        $res['msg']=3;//失败，csv文件数据为空
    }elseif($res_import==4){
        $res['msg']=4;//失败
    }

    echo json_encode($res);

}else{
    die('Permission Deny!');
}