<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/8
 * Time: 9:47
 */
include ('header.php');
?>
<title><?=$lang_carinfo['汽车信息管理']?></title>
<style>
    .ul_pics li{float:left;width:100px;height:100px;border:1px solid #ddd;padding:2px;text-align: center;margin:0 5px 5px 0;list-style-type: none;}
    .ul_pics li .img{width: 100px;height: 90px;display: table-cell;vertical-align: middle;}
    .ul_pics li img{max-width: 100px;max-height: 90px;vertical-align: middle;}
    .layer-photos-demo{
        cursor: pointer;
    }
</style>
<script>
    $(document).ready(function(){
        layer.photos({
            photos: '.layer-photos-demo'
            ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
        });
    });
</script>
</head>
<body>
<h2><?=$lang_carinfo['汽车信息详情']?></h2>
<div id="body">
    <table width="100%" style="line-height: 18px;">
        <tr>
            <td><label><?=$lang_carinfo['汽车厂牌']?>:</label><?=$post['cb_fullname']?></td>
            <td><label><?=$lang_carinfo['汽车车系']?>:</label><?=$post['cm_fullname']?></td>
            <td><label><?=$lang_carinfo['汽车车型']?>:</label><?=$post['cbt_fullname']?></td>
        </tr>
    </table>
    <table width="100%" style="line-height: 18px;margin-top: 20px;">
        <tr>
            <td><label><?=$lang_carinfo['车款分类']?>:</label><?=$post['cs_fullname']?></td>
        </tr>
    </table>
    <table width="100%" style="line-height: 18px;" class="mt">
        <tr>
            <td><label><?=$lang_carinfo['车辆概览文章']?>:</label><?=$post['ci_article_title']?></td>
            <td><label><?=$lang_carinfo['车辆年份']?>:</label><?=$post['ci_car_year_style']?></td>
        </tr>
    </table>
    <table width="100%" style="line-height: 18px;" class="mt">
        <tr>
            <td><label><?=$lang_carinfo['乘客数']?>:</label><?=$post['ci_car_seats']?></td>
            <td><label><?=$lang_carinfo['车门数']?>:</label><?=$post['ci_car_doors']?></td>
            <td><label><?=$lang_carinfo['实际车价(万元)']?>:</label><?=$post['ci_sale_price']?></td>
            <td><label><?=$lang_carinfo['车长']?>(mm):</label><?=$post['ci_overall_length']?></td>
        </tr>
        <tr>
            <td><label><?=$lang_carinfo['车宽']?>(mm):</label><?=$post['ci_overall_width']?></td>
            <td><label><?=$lang_carinfo['车高']?>(mm):</label><?=$post['ci_overall_height']?></td>
            <td><label><?=$lang_carinfo['车重']?>(kg):</label><?=$post['ci_overall_weight']?></td>
            <td><label><?=$lang_carinfo['轴距']?>(mm):</label><?=$post['ci_wheel_base']?></td>
        </tr>
        <tr>
            <td><label><?=$lang_carinfo['后轮距']?>(mm):</label><?=$post['ci_rear_track']?></td>
            <td><label><?=$lang_carinfo['前轮距']?>(mm):</label><?=$post['ci_front_track']?></td>
            <td><label><?=$lang_carinfo['行李箱容积']?>(L):</label><?=$post['ci_luggage_capacity']?></td>
            <td><label><?=$lang_carinfo['回转半径']?>(M):</label><?=$post['ci_turning_radius']?></td>
        </tr>
        <tr>
            <td><label><?=$lang_carinfo['前轮尺寸']?>:</label><?=$post['ci_front_wheel_size']?></td>
            <td><label><?=$lang_carinfo['后轮尺寸']?>:</label><?=$post['ci_rear_wheel_siae']?></td>
            <td><label><?=$lang_carinfo['风阻系数']?>:</label><?=$post['ci_aerodynamic_drag']?></td>
            <td><label><?=$lang_carinfo['最小离地高度']?>(mm):</label><?=$post['ci_ground_clearance']?></td>
        </tr>
        <tr>
            <td><label><?=$lang_carinfo['油箱容量']?>(L):</label><?=$post['ci_tank_capacity']?></td>
            <td><label><?=$lang_carinfo['转向系统']?>:</label><?=$post['ci_steering_system']?></td>
            <td><label><?=$lang_carinfo['前轮悬吊']?>:</label><?=$post['ci_front_suspension']?></td>
            <td><label><?=$lang_carinfo['后轮悬吊']?>:</label><?=$post['ci_rear_suspension']?></td>
        </tr>
        <tr>
            <td><label><?=$lang_carinfo['电池种类']?>:</label><?=$post['ci_battery_type']?></td>
            <td><label><?=$lang_carinfo['电池容量']?>:</label><?=$post['ci_battery_capacity']?></td>
            <td><label><?=$lang_carinfo['引擎燃料']?>:</label><?=$post['ci_fueltype']?></td>
            <td><label><?=$lang_carinfo['纯电池里程']?>(km):</label><?=$post['ci_max_milage']?></td>
        </tr>
        <tr>
            <td><label><?=$lang_carinfo['充电时间']?>(h):</label><?=$post['ci_recharge_time']?></td>
            <td><label><?=$lang_carinfo['市区油耗']?>(L/100km):</label><?=$post['ci_urban_consumption']?></td>
            <td><label><?=$lang_carinfo['高速油耗']?>(L/100km):</label><?=$post['ci_high_speed_consumption']?></td>
            <td><label><?=$lang_carinfo['平均油耗']?>(L/100km):</label><?=$post['ci_average_consumption']?></td>
        </tr>
        <tr>
            <td><label><?=$lang_carinfo['排气量']?>(CC):</label><?=$post['ci_displacement']?></td>
            <td><label><?=$lang_carinfo['压缩比']?>:</label><?=$post['ci_compression_ratio']?></td>
            <td><label><?=$lang_carinfo['气缸构造']?>:</label><?=$post['ci_cylinder_structure']?></td>
            <td><label><?=$lang_carinfo['引擎设计']?>:</label><?=$post['ci_valve_gear']?></td>
        </tr>
        <tr>
            <td><label><?=$lang_carinfo['引擎技术']?>:</label><?=$post['ci_engine_tech']?></td>
            <td><label><?=$lang_carinfo['供油方式']?>:</label><?=$post['ci_fuel_injection']?></td>
            <td><label><?=$lang_carinfo['每缸气门数']?>:</label><?=$post['ci_valve_each_cylinder']?></td>
            <td><label><?=$lang_carinfo['总气门数']?>:</label><?=$post['ci_total_valves']?></td>
        </tr>
        <tr>
            <td><label><?=$lang_carinfo['引擎位置']?>:</label><?=$post['ci_engine_location']?></td>
            <td><label><?=$lang_carinfo['进气方式']?>:</label><?=$post['ci_aspiration']?></td>
            <td><label><?=$lang_carinfo['最大马力']?>(hp):</label><?=$post['ci_max_horsepower']?></td>
            <td><label><?=$lang_carinfo['最大扭矩']?>(kgm):</label><?=$post['ci_max_torque']?></td>
        </tr>
        <tr>
            <td><label><?=$lang_carinfo['变速系统']?>:</label><?=$post['ci_transmission_system']?></td>
            <td><label><?=$lang_carinfo['驱动方式']?>:</label><?=$post['ci_drive_mode']?></td>
            <td><label><?=$lang_carinfo['刹车系统']?>:</label><?=$post['ci_brake_system']?></td>
            <td><label><?=$lang_carinfo['制造商']?>:</label><?=$post['ci_manufactory']?></td>
        </tr>
        <tr>
            <td><label><?=$lang_carinfo['产地']?>:</label><?=$post['ci_carsource']?></td>
            <td><label><?=$lang_carinfo['技术合作']?>:</label><?=$post['ci_technical_cooperation']?></td>
            <td><label><?=$lang_carinfo['特色说明']?>:</label><?=$post['ci_html_descript']?></td>
            <td><label><?=$lang_carinfo['多媒体链接']?>:</label><?=$post['ci_car_video_link']?></td>
        </tr>
        <tr>
            <td><label><?=$lang_carinfo['网址']?>:</label><?=$post['ci_web_address']?></td>
            <td><label><?=$lang_carinfo['燃料税']?>(<?=$lang_carinfo['元']?>):</label><?=$post['ci_fuel_tax']?></td>
            <td><label><?=$lang_carinfo['牌照税']?>(<?=$lang_carinfo['元']?>):</label><?=$post['ci_license_tax']?></td>
<!--            <td><label>--><?//=$lang_carinfo['车部件安装位置']?><!--:</label>--><?//=$post['cp_part_location']?><!--</td>-->
        </tr>
        <tr>
<!--            <td><label>--><?//=$lang_carinfo['部件名称']?><!--:</label>--><?//=$post['cp_part_name']?><!--</td>-->
<!--            <td><label>--><?//=$lang_carinfo['气缸名称']?><!--:</label>--><?//=$post['ci_cylinder_name']?><!--</td>-->
            <td><label><?=$lang_carinfo['区域']?>:</label><?=$post['ci_region']?></td>
            <td><label><?=$lang_carinfo['是否推荐']?>:</label><?=$post['ci_recommend']==1?'否':'是'?></td>
        </tr>
        <table width="100%" style="line-height: 18px;">
            <tr>
                <td><label><?=$lang_carinfo['经销商/代理商']?>:</label></td>
            </tr>
            <tr>
                <td>
                    <div id="distribution_agent_v" style="width: 600px;min-height: 50px;overflow: auto">
                        <?php foreach($term_di as $v):?>
                            <span><?=$v['value']?>,</span>
                        <?php endforeach;?>
                    </div>
                </td>
            </tr>
            <tr>
                <td><label><?=$lang_carinfo['车辆配备']?>:</label></td>
            </tr>
            <tr>
                <td>
                    <div id="car_equiptments_v" style="width: 600px;min-height: 50px;overflow: auto">
                        <?php foreach($term_care as $v):?>
                            <span><?=$v['value']?>,</span>
                        <?php endforeach;?>
                    </div>
                </td>
            </tr>
        </table>
        <table width="100%" style="line-height: 18px;" class="mt">
            <tr>
                <td><label>Banner<?=$lang_carinfo['图']?></label></td>
            </tr>
            <tr>
                <td>
                    <ul id="ul_pics" class="ul_pics ">
                        <?php foreach($img as $v):
                                if($v['meta_type']==11){
                        ?>
                        <li><div class='img layer-photos-demo'><img layer-src="./<?=$v['meta_file_path']?>" src='./<?=$v['meta_file_path']?>'/></div></li>
                        <?php }endforeach;?>
                    </ul>
                </td>
            </tr>
        </table>
        <table width="100%" style="line-height: 18px;" class="mt">
            <tr>
                <td><label><?=$lang_carinfo['外观图']?></label></td>
            </tr>
            <tr>
                <td>
                    <ul id="other_ul_pics" class="ul_pics ">
                        <?php foreach($img as $v):
                            if($v['meta_type']==12){
                                ?>
                                <li><div class='img layer-photos-demo'><img layer-src="./<?=$v['meta_file_path']?>" src='./<?=$v['meta_file_path']?>'/></div></li>
                        <?php }endforeach;?>
                    </ul>
                </td>
            </tr>
        </table>
        <table width="100%" style="line-height: 18px;" class="mt">
            <tr>
                <td><label><?=$lang_carinfo['内饰图']?></label></td>
            </tr>
            <tr>
                <td>
                    <ul id="other_interior_ul_pics" class="ul_pics ">
                        <?php foreach($img as $v):
                            if($v['meta_type']==13){
                                ?>
                                <li><div class='img layer-photos-demo'><img layer-src="./<?=$v['meta_file_path']?>" src='./<?=$v['meta_file_path']?>'/></div></li>
                        <?php }endforeach;?>
                    </ul>
                </td>
            </tr>
        </table>
    </table>
</div>
</body>
<?php include ('footer.php');?>