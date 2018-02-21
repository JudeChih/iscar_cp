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
        .suggestionsBox {
            position: absolute;
            z-index:100;
            overflow: auto;
        }
        .suggestionList {
            /*margin: 10px 4px 4px 4px;*/
            padding: 0px;
            background:#FFF;
            -moz-border-radius: 4px;
            -webkit-border-radius: 4px;
            border-radius: 4px;
        }

        .suggestionList li {
            margin: 1px 0px 2px 0px;
            padding: 3px;
            cursor: pointer;
            color:#2A1F00;
            list-style-type: none;
        }

        .suggestionList li:hover {
            background-color: #659CD8;
        }
        .ul_pics li{float:left;width:110px;height:110px;border:1px solid #ddd;padding:2px;text-align: center;margin:40px 5px 5px 0;list-style-type: none;}
        .ul_pics li .img{width: 100px;height: 100px;display: table-cell;vertical-align: middle;}
        .ul_pics li img{max-width: 100px;max-height: 100px;vertical-align: middle;}
        .progress{position:relative;padding: 1px; border-radius:3px; margin:60px 0 0 0;}
        .bar {background-color: green; display:block; width:0%; height:20px; border-radius:3px; }
        .percent{position:absolute; height:20px; display:inline-block;top:3px; left:2%; color:#fff }

        .order,.order_oth,.order_oth_interior{
            width: 30px;
            height: 20px;
            border-radius: 5px;
            outline:none;
        }
        .remove,.glyphicon,.layer-photos-demo{
            cursor: pointer;
        }
        table tr{margin-top: 10px;}
    </style>
    <script type="text/javascript">
        $(document).ready(function(){
            $("body").on("click",".remove", function(){ //user click on remove text
                $(this).parents('li').remove(); //remove text box
            })

            layer.photos({
                photos: '.layer-photos-demo'
                ,anim: 5 //0-6的选择，指定弹出图片动画类型，默认随机（请注意，3.0之前的版本用shift参数）
            });
        });
        function searchShow() {
            if(document.getElementById("search_box_key").value.length == 0) {
                $('#suggestions').hide();
            } else {
                var searchText = myHtmlEncode($('#search_box_key').val());
                $('#suggestions').show();
                $.ajax({
                    url:'<?=URL?>iscaradmin/?p=carinfo',
                    type:'post',
                    dataType:'html',
                    data:{"a":"ajax_search","searchContent":searchText},
                    error: function(){
                        alert('Error loading document');
                    },
                    success: function(msg){
                        $("#autoSuggestionsList").html(msg);
                    }
                })
            }
        }

        function fill(thisValue,id) {
            $('#search_box_key').val(thisValue);
            $('#articleid').val(id);
            setTimeout("$('#suggestions').hide();", 200);
        }
    </script>
    </head>
    <body>
    <!--制造商-->
    <div class="ci_manufactory" style="display: none;" id="manufact">
        <div class="input-group">
            <input type="text" class="form-control" id="manu_v">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" id="manu_s"><?=$lang_carinfo['搜索']?></button>
      </span>
        </div><!-- /input-group -->
        <div class="" style="padding: 10px;">
            <label class="radio-inline" v-for="item in post" style="margin-top: 20px;">
                <input type="radio" name="ci_manufactory" :checked="<?=$post['ci_manufactory']?>==item.keyword" value="{{item.keyword}}"><span>{{item.value}}</span >
            </label>
        </div>
    </div>
    <!--制造商 end-->
    <!--产地-->
    <div class="ci_carsource" style="display: none;" id="carsour">
        <div class="input-group">
            <input type="text" class="form-control" id="cars_v">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" id="cars_s"><?=$lang_carinfo['搜索']?></button>
      </span>
        </div><!-- /input-group -->
        <div class="" style="padding: 10px;">
            <label class="radio-inline" v-for="item in post" style="margin-top: 20px;">
                <input type="radio" name="ci_carsource"  :checked="<?=$post['ci_carsource']?>==item.keyword" value="{{item.keyword}}"><span>{{item.value}}</span >
            </label>
        </div>
    </div>
    <!--产地 end-->
    <!--技术合作-->
    <div class="ci_technical_cooperation" style="display: none;" id="technical">
        <div class="input-group">
            <input type="text" class="form-control" id="tech_v">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" id="tech_s"><?=$lang_carinfo['搜索']?></button>
      </span>
        </div><!-- /input-group -->
        <div class="" style="padding: 10px;">
            <label class="radio-inline" v-for="item in post" style="margin-top: 20px;">
                <input type="radio" name="ci_technical_cooperation" :checked="<?=$post['ci_technical_cooperation']?>==item.keyword" value="{{item.keyword}}"><span >{{item.value}}</span >
            </label>
        </div>
    </div>
    <!--技术合作 end-->
    <!--车身分类-->
    <div class="ci_car_bodytype" style="display: none;" id="bodytype">
        <div class="input-group">
            <input type="text" class="form-control" id="body_v">
      <span class="input-group-btn">
        <button class="btn btn-default" type="button" id="body_s"><?=$lang_carinfo['搜索']?></button>
      </span>
        </div><!-- /input-group -->
        <div class="" style="padding: 10px;">
            <label class="radio-inline" v-for="item in post" style="margin-top: 20px;">
                <input type="radio" name="ci_car_bodytype" :checked="<?=$post['ci_car_bodytype']?>==item.cbt_id" value="{{item.cbt_id}}"><span >{{item.cbt_fullname}}</span >
            </label>
        </div>
    </div>
    <!--车身分类 end-->
    <!--经销商/代理商-->
    <div class="ci_distribution_agent" style="display: none;" id="dist_age">
        <div class="input-group">
            <input type="text" class="form-control" id="dist_v">
  <span class="input-group-btn">
    <button class="btn btn-default" type="button" id="dist_s"><?=$lang_carinfo['搜索']?></button>
  </span>
        </div><!-- /input-group -->
        <div class="dis_a" style="padding: 10px;">
            <label class="radio-inline" v-for="item in post" style="margin-top: 20px;">
                <input type="checkbox" name="ci_distribution_agent"  value="{{item.keyword}}" :checked="item.status==1"><span >{{item.value}}</span >
            </label>
        </div>
    </div>
    <!--经销商/代理商 end-->
    <!--车辆配备-->
    <div class="ci_car_equiptments" style="display: none;" id="car_equip">
        <div class="input-group">
            <input type="text" class="form-control" id="care_v">
  <span class="input-group-btn">
    <button class="btn btn-default" type="button" id="care_s"><?=$lang_carinfo['搜索']?></button>
  </span>
        </div><!-- /input-group -->
        <div class="car_e" style="padding: 10px;">
            <label class="radio-inline" v-for="item in post" style="margin-top: 20px;">
                <input type="checkbox" name="ci_car_equiptments"  value="{{item.keyword}}" :checked="item.status==1"><span >{{item.value}}</span >
            </label>
        </div>
    </div>
    <!--车辆配备 end-->
    <!--汽车厂牌-->
    <div class="car_brands" style="display: none;" id="brands">
        <div class="input-group">
            <input type="text" class="form-control" id="brand_v">
<span class="input-group-btn">
<button class="btn btn-default" type="button" id="brand_s"><?=$lang_carinfo['搜索']?></button>
</span>
        </div><!-- /input-group -->
        <div class="" style="padding: 10px;">
            <label class="radio-inline" v-for="item in post" style="margin-top: 20px;">
                <input type="radio" name="car_brands" :checked="<?=$post['ci_car_brand']?>==item.cb_id" value="{{item.cb_id}}"><span>{{item.cb_fullname}}</span >
            </label>
        </div>
    </div>
    <!--汽车厂牌 end-->
    <!--汽车车型-->
    <div class="car_models" style="display: none;" id="models">
        <div class="input-group">
            <input type="text" class="form-control" id="model_v">
<span class="input-group-btn">
<button class="btn btn-default" type="button" id="model_s"><?=$lang_carinfo['搜索']?></button>
</span>
        </div><!-- /input-group -->
        <div class="" style="padding: 10px;">
            <label class="radio-inline" v-for="item in post" style="margin-top: 20px;">
                <input type="radio" name="car_models" :checked="<?=$post['ci_brand_model']?>==item.cm_id" value="{{item.cm_id}}"><span>{{item.cm_fullname}}</span >
            </label>
        </div>
    </div>
    <!--汽车车型 end-->
    <!--车款分类-->
    <div class="car_styles" style="display: none;" id="styles">
        <div class="input-group">
            <input type="text" class="form-control" id="style_v">
<span class="input-group-btn">
<button class="btn btn-default" type="button" id="style_s"><?=$lang_carinfo['搜索']?></button>
</span>
        </div><!-- /input-group -->
        <div class="" style="padding: 10px;">
            <label class="radio-inline" v-for="item in post" style="margin-top: 20px;">
                <input type="radio" name="car_styles" :checked="<?=$post['ci_model_style']?>==item.cs_id" value="{{item.cs_id}}"><span>{{item.cs_fullname}}</span >
            </label>
        </div>
    </div>
    <!--车款分类 end-->
    <div id="body">
        <form id="form" action="<?=URL?>iscaradmin/?p=carinfo&a=copy&id=<?=$post['ci_id']?>" method="post" enctype="multipart/form-data" onsubmit="return verify_order()">
            <table width="100%" style="line-height: 18px;">
                <tr>
                    <td><label><?=$lang_carinfo['汽车厂牌']?>(<?=$lang_carinfo['不能为空']?>):<span id="carb" class="glyphicon glyphicon-plus-sign"></span></label></td>
                    <td><label><?=$lang_carinfo['汽车车系']?>(<?=$lang_carinfo['不能为空']?>):<span id="carm" class="glyphicon glyphicon-plus-sign"></span></label></td>
                    <td><label><?=$lang_carinfo['汽车车型']?>(<?=$lang_carinfo['不能为空']?>):<span id="carbody" class="glyphicon glyphicon-plus-sign"></span></label></td>
                </tr>
                <tr>
                    <td>
                        <input type="text" class="inline form-control" disabled="disabled" id="carbrands_v" style="width: 200px;" value="<?=$post['cb_fullname']?>" >
                    </td>
                    <input type="hidden" id="carbrands" name="ci_car_brand" value="<?=$post['ci_car_brand']?>">
                    <td>
                        <input type="text" class="inline form-control" disabled="disabled" id="carmodels_v" style="width: 200px;" value="<?=$post['cm_fullname']?>" >
                    </td>
                    <input type="hidden" id="carmodels" name="ci_brand_model" value="<?=$post['ci_brand_model']?>">
                    <td><input type="text" class="inline form-control" disabled="disabled" id="car_bodytype_v" style="width: 200px;" value="<?=$post['cbt_fullname']?>" ></td>
                    <input type="hidden" id="car_bodytype" name="ci_car_bodytype" value="<?=$post['ci_car_bodytype']?>">
                </tr>
            </table>
            <table width="100%" style="line-height: 18px;margin-top: 20px;">
                <tr>
                    <td><label><?=$lang_carinfo['车款分类']?>:(<?=$lang_carinfo['不能为空']?>)<span id="carsty" class="glyphicon glyphicon-plus-sign"></span></label></td>
                </tr>
                <tr>
                    <td>
                        <input type="text" class="inline form-control" disabled="disabled" id="carstyles_v" style="width: 580px;" value="">
                    </td>
                    <input type="hidden" id="carstyles" name="ci_model_style" value="">
                </tr>
            </table>
            <table width="100%" style="line-height: 18px;" class="mt">
                <tr>
                    <td><label><?=$lang_carinfo['车辆概览文章']?><span id="cararticle" class="glyphicon glyphicon-plus-sign"></span>:</label>(<?=$lang_carinfo['查询之前请先关闭浏览器表单自动提示功能']?>)</td>
                    <td><label><?=$lang_carinfo['车辆年份']?>(<?=$lang_carinfo['例如']?>:2017):</label></td>
                </tr>
                <tr>
                    <td><input type="text" class="inline form-control "id="search_box_key" onkeyup="searchShow()" onblur="fill()" name="ci_article_title"  value="<?=$post['ci_article_title']?>"  autocomplete="off" style="width: 500px;">
                        <div class="form-control suggestionsBox" id="suggestions" style="display:none;width: 500px;height: inherit;">
                            <div class="suggestionList" id="autoSuggestionsList"></div>
                        </div>
                    </td>
                    <input type="hidden" id="articleid" name="article_id" value="<?=$post['ca_main_id']?>">
                    <td><input type="text" class="inline form-control " name="ci_car_year_style"  onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="4" style="width: 300px;" value="<?=$post['ci_car_year_style']?>" required></td>
                </tr>
            </table>
            <table width="100%" style="line-height: 28px;" class="mt">
                <tr>
                    <td><label><?=$lang_carinfo['乘客数']?>:</label></td>
                    <td><label><?=$lang_carinfo['车门数']?>:</label></td>
                    <td><label><?=$lang_carinfo['实际车价(万元)']?>:</label></td>
                    <td><label><?=$lang_carinfo['车长']?>(mm):</label></td>
                </tr>
                <tr>
                    <td><input type="text" class="inline form-control " name="ci_car_seats"  onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="2" style="width: 150px;" value="<?=$post['ci_car_seats']?>"></td>
                    <td><input type="text" class="inline form-control " name="ci_car_doors"  onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="2" style="width: 150px;" value="<?=$post['ci_car_doors']?>"></td>
                    <td><input type="text" class="inline form-control " name="ci_sale_price"  onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="8" style="width: 150px;" value="<?=$post['ci_sale_price']?>"></td>
                    <td><input type="text" class="inline form-control " name="ci_overall_length" onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="8"  style="width: 150px;" value="<?=$post['ci_overall_length']?>"></td>
                </tr>
                <tr>
                    <td><label><?=$lang_carinfo['车宽']?>(mm):</label></td>
                    <td><label><?=$lang_carinfo['车高']?>(mm):</label></td>
                    <td><label><?=$lang_carinfo['车重']?>(kg):</label></td>
                    <td><label><?=$lang_carinfo['轴距']?>(mm):</label></td>
                </tr>
                <tr>
                    <td><input type="text" class="inline form-control " name="ci_overall_width"  onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="8" style="width: 150px;" value="<?=$post['ci_overall_width']?>"></td>
                    <td><input type="text" class="inline form-control " name="ci_overall_height"  onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="8" style="width: 150px;" value="<?=$post['ci_overall_height']?>"></td>
                    <td><input type="text" class="inline form-control " name="ci_overall_weight"  onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="8" style="width: 150px;" value="<?=$post['ci_overall_weight']?>"></td>
                    <td><input type="text" class="inline form-control " name="ci_wheel_base"  onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="8" style="width: 150px;" value="<?=$post['ci_wheel_base']?>"></td>
                </tr>
                <tr>
                    <td><label><?=$lang_carinfo['后轮距']?>(mm):</label></td>
                    <td><label><?=$lang_carinfo['前轮距']?>(mm):</label></td>
                    <td><label><?=$lang_carinfo['行李箱容积']?>(L):</label></td>
                    <td><label><?=$lang_carinfo['回转半径']?>(M):</label></td>
                </tr>
                <tr>
                    <td><input type="text" class="inline form-control " name="ci_rear_track"  onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="8" style="width: 150px;" value="<?=$post['ci_rear_track']?>"></td>
                    <td><input type="text" class="inline form-control " name="ci_front_track"  onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="8" style="width: 150px;" value="<?=$post['ci_front_track']?>"></td>
                    <td><input type="text" class="inline form-control " name="ci_luggage_capacity"  onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="8" style="width: 150px;" value="<?=$post['ci_luggage_capacity']?>"></td>
                    <td><input type="text" class="inline form-control " name="ci_turning_radius"  onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="8" style="width: 150px;" value="<?=$post['ci_turning_radius']?>"></td>
                </tr>
                <tr>
                    <td><label><?=$lang_carinfo['前轮尺寸']?>:</label></td>
                    <td><label><?=$lang_carinfo['后轮尺寸']?>:</label></td>
                    <td><label><?=$lang_carinfo['风阻系数']?>:</label></td>
                    <td><label><?=$lang_carinfo['最小离地高度']?>(mm):</label></td>
                </tr>
                <tr>
                    <td><input type="text" class="inline form-control " name="ci_front_wheel_size"  maxlength="15"  style="width: 150px;" value="<?=$post['ci_front_wheel_size']?>"></td>
                    <td><input type="text" class="inline form-control " name="ci_rear_wheel_siae"  maxlength="15"  style="width: 150px;" value="<?=$post['ci_rear_wheel_siae']?>"></td>
                    <td><input type="text" class="inline form-control " name="ci_aerodynamic_drag" maxlength="10"   style="width: 150px;" value="<?=$post['ci_aerodynamic_drag']?>"></td>
                    <td><input type="text" class="inline form-control " name="ci_ground_clearance" maxlength="8" onblur="validate_num(this)"  onchange="validate_submit(this)"  style="width: 150px;" value="<?=$post['ci_ground_clearance']?>"></td>
                </tr>
                <tr>
                    <td><label><?=$lang_carinfo['油箱容量']?>(L):</label></td>
                    <td><label><?=$lang_carinfo['转向系统']?>:</label></td>
                    <td><label><?=$lang_carinfo['前轮悬吊']?>:</label></td>
                    <td><label><?=$lang_carinfo['后轮悬吊']?>:</label></td>
                </tr>
                <tr>
                    <td><input type="text" class="inline form-control " name="ci_tank_capacity" maxlength="8" onblur="validate_num(this)"  onchange="validate_submit(this)"  style="width: 150px;" value="<?=$post['ci_tank_capacity']?>"></td>
                    <td>
                        <select class="form-control" style="width: 150px" name="ci_steering_system" >
                            <option value=""><?=$lang_carinfo['请选择']?></option>
                            <?php foreach($terms_sts as $v):?>
                                <option value="<?=$v['keyword']?>" <?=$post['ci_steering_system']==$v['keyword']?'selected':''?>><?=$v['value']?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" style="width: 150px" name="ci_front_suspension" >
                            <option value=""><?=$lang_carinfo['请选择']?></option>
                            <?php foreach($terms_frs as $v):?>
                                <option value="<?=$v['keyword']?>" <?=$post['ci_front_suspension']==$v['keyword']?'selected':''?>><?=$v['value']?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" style="width: 150px" name="ci_rear_suspension" >
                            <option value=""><?=$lang_carinfo['请选择']?></option>
                            <?php foreach($terms_res as $v):?>
                                <option value="<?=$v['keyword']?>" <?=$post['ci_rear_suspension']==$v['keyword']?'selected':''?>><?=$v['value']?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label><?=$lang_carinfo['电池种类']?>:</label></td>
                    <td><label><?=$lang_carinfo['电池容量']?>:</label></td>
                    <td><label><?=$lang_carinfo['引擎燃料']?>:</label></td>
                    <td><label><?=$lang_carinfo['纯电池里程']?>(km):</label></td>
                </tr>
                <tr>
                    <td>
                        <select class="form-control" style="width: 150px" name="ci_battery_type" >
                            <option value=""><?=$lang_carinfo['请选择']?></option>
                            <?php foreach($terms_bat as $v):?>
                                <option value="<?=$v['keyword']?>" <?=$post['ci_battery_type']==$v['keyword']?'selected':''?>><?=$v['value']?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td><input type="text" class="inline form-control " name="ci_battery_capacity"  onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="8" style="width: 150px;" value="<?=$post['ci_battery_capacity']?>"></td>
                    <td>
                        <select class="form-control" style="width: 150px" name="ci_fueltype" >
                            <option value=""><?=$lang_carinfo['请选择']?></option>
                            <?php foreach($terms_ft as $v):?>
                                <option value="<?=$v['keyword']?>" <?=$post['ci_fueltype']==$v['keyword']?'selected':''?>><?=$v['value']?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td><input type="text" class="inline form-control " name="ci_max_milage"  onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="8" style="width: 150px;" value="<?=$post['ci_max_milage']?>"></td>
                </tr>
                <tr>
                    <td><label><?=$lang_carinfo['充电时间']?>(h):</label></td>
                    <td><label><?=$lang_carinfo['市区油耗']?>(L/100km):</label></td>
                    <td><label><?=$lang_carinfo['高速油耗']?>(L/100km):</label></td>
                    <td><label><?=$lang_carinfo['平均油耗']?>(L/100km):</label></td>
                </tr>
                <tr>
                    <td><input type="text" class="inline form-control " name="ci_recharge_time"  onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="8" style="width: 150px;" value="<?=$post['ci_recharge_time']?>"></td>
                    <td><input type="text" class="inline form-control " name="ci_urban_consumption"  onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="5" style="width: 150px;" value="<?=$post['ci_urban_consumption']?>"></td>
                    <td><input type="text" class="inline form-control " name="ci_high_speed_consumption"  onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="5" style="width: 150px;" value="<?=$post['ci_high_speed_consumption']?>"></td>
                    <td><input type="text" class="inline form-control " name="ci_average_consumption"  onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="5" style="width: 150px;" value="<?=$post['ci_average_consumption']?>"></td>
                </tr>
                <tr>
                    <td><label><?=$lang_carinfo['排气量']?>(CC):</label></td>
                    <td><label><?=$lang_carinfo['压缩比']?>:</label></td>
                    <td><label><?=$lang_carinfo['气缸构造']?>:</label></td>
                    <td><label><?=$lang_carinfo['引擎设计']?>:</label></td>
                </tr>
                <tr>
                    <td><input type="text" class="inline form-control " name="ci_displacement"  onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="8" style="width: 150px;" value="<?=$post['ci_displacement']?>"></td>
                    <td><input type="text" class="inline form-control " name="ci_compression_ratio"  maxlength="15"  style="width: 150px;" value="<?=$post['ci_compression_ratio']?>"></td>
                    <td>
                        <select class="form-control" style="width: 150px" name="ci_cylinder_structure" >
                            <option value=""><?=$lang_carinfo['请选择']?></option>
                            <?php foreach($terms_cyl as $v):?>
                                <option value="<?=$v['keyword']?>" <?=$post['ci_cylinder_structure']==$v['keyword']?'selected':''?>><?=$v['value']?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" style="width: 150px" name="ci_valve_gear" >
                            <option value=""><?=$lang_carinfo['请选择']?></option>
                            <?php foreach($terms_val as $v):?>
                                <option value="<?=$v['keyword']?>" <?=$post['ci_valve_gear']==$v['keyword']?'selected':''?>><?=$v['value']?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td><label><?=$lang_carinfo['引擎技术']?>:</label></td>
                    <td><label><?=$lang_carinfo['供油方式']?>:</label></td>
                    <td><label><?=$lang_carinfo['每缸气门数']?>:</label></td>
                    <td><label><?=$lang_carinfo['总气门数']?>:</label></td>
                </tr>
                <tr>
                    <td>
                        <select class="form-control" style="width: 150px" name="ci_engine_tech" >
                            <option value=""><?=$lang_carinfo['请选择']?></option>
                            <?php foreach($terms_eng as $v):?>
                                <option value="<?=$v['keyword']?>" <?=$post['ci_engine_tech']==$v['keyword']?'selected':''?>><?=$v['value']?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" style="width: 150px" name="ci_fuel_injection" >
                            <option value=""><?=$lang_carinfo['请选择']?></option>
                            <?php foreach($terms_fue as $v):?>
                                <option value="<?=$v['keyword']?>" <?=$post['ci_fuel_injection']==$v['keyword']?'selected':''?>><?=$v['value']?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td><input type="text" class="inline form-control " name="ci_valve_each_cylinder"  onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="8" style="width: 150px;" value="<?=$post['ci_valve_each_cylinder']?>"></td>
                    <td><input type="text" class="inline form-control " name="ci_total_valves"  onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="8" style="width: 150px;" value="<?=$post['ci_total_valves']?>"></td>
                </tr>
                <tr>
                    <td><label><?=$lang_carinfo['引擎位置']?>:</label></td>
                    <td><label><?=$lang_carinfo['进气方式']?>:</label></td>
                    <td><label><?=$lang_carinfo['最大马力']?>(hp):</label></td>
                    <td><label><?=$lang_carinfo['最大扭矩']?>(kgm):</label></td>
                </tr>
                <tr>
                    <td>
                        <select class="form-control" style="width: 150px" name="ci_engine_location" >
                            <option value=""><?=$lang_carinfo['请选择']?></option>
                            <?php foreach($terms_eng_l as $v):?>
                                <option value="<?=$v['keyword']?>" <?=$post['ci_engine_location']==$v['keyword']?'selected':''?>><?=$v['value']?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" style="width: 150px" name="ci_aspiration" >
                            <option value=""><?=$lang_carinfo['请选择']?></option>
                            <?php foreach($terms_asp as $v):?>
                                <option value="<?=$v['keyword']?>" <?=$post['ci_aspiration']==$v['keyword']?'selected':''?>><?=$v['value']?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td><input type="text" class="inline form-control " name="ci_max_horsepower"   maxlength="15" style="width: 150px;" value="<?=$post['ci_max_horsepower']?>"></td>
                    <td><input type="text" class="inline form-control " name="ci_max_torque"   maxlength="15" style="width: 150px;" value="<?=$post['ci_max_torque']?>"></td>
                </tr>
                <tr>
                    <td><label><?=$lang_carinfo['变速系统']?>:</label></td>
                    <td><label><?=$lang_carinfo['驱动方式']?>:</label></td>
                    <td><label><?=$lang_carinfo['刹车系统']?>:</label></td>
                    <td><label><?=$lang_carinfo['制造商']?>:<span id="manu" class="glyphicon glyphicon-plus-sign"></span></label></td>
                </tr>
                <tr>
                    <td>
                        <select class="form-control" style="width: 150px" name="ci_transmission_system" >
                            <option value=""><?=$lang_carinfo['请选择']?></option>
                            <?php foreach($terms_tra as $v):?>
                                <option value="<?=$v['keyword']?>" <?=$post['ci_transmission_system']==$v['keyword']?'selected':''?>><?=$v['value']?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" style="width: 150px" name="ci_drive_mode" >
                            <option value=""><?=$lang_carinfo['请选择']?></option>
                            <?php foreach($terms_dri as $v):?>
                                <option value="<?=$v['keyword']?>" <?=$post['ci_drive_mode']==$v['keyword']?'selected':''?>><?=$v['value']?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td>
                        <select class="form-control" style="width: 150px" name="ci_brake_system" >
                            <option value=""><?=$lang_carinfo['请选择']?></option>
                            <?php foreach($terms_bra as $v):?>
                                <option value="<?=$v['keyword']?>" <?=$post['ci_brake_system']==$v['keyword']?'selected':''?>><?=$v['value']?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                    <td><input type="text" class="inline form-control" disabled="disabled" id="manufactory_v" style="width: 150px;" value="<?=$post['ci_manufactory_v']?>"></td>
                    <input type="hidden" id="manufactory" name="ci_manufactory" value="<?=$post['ci_manufactory']?>">
                </tr>
                <tr>
                    <td><label><?=$lang_carinfo['产地']?>:<span id="cars" class="glyphicon glyphicon-plus-sign"></span></label></td>
                    <td><label><?=$lang_carinfo['技术合作']?>:<span id="tech" class="glyphicon glyphicon-plus-sign"></span></label></td>
                    <td><label><?=$lang_carinfo['特色说明']?>:</label></td>
                    <td><label><?=$lang_carinfo['多媒体链接']?>:</label></td>
                </tr>
                <tr>
                    <td><input type="text" class="inline form-control" disabled="disabled" id="carsource_v" style="width: 150px;" value="<?=$post['ci_carsource_v']?>"></td>
                    <input type="hidden" id="carsource" name="ci_carsource" value="<?=$post['ci_carsource']?>">
                    <td><input type="text" class="inline form-control" disabled="disabled" id="technical_cooperation_v" style="width: 150px;" value="<?=$post['ci_technical_cooperation_v']?>"></td>
                    <input type="hidden" id="technical_cooperation" name="ci_technical_cooperation" value="<?=$post['ci_technical_cooperation']?>">
                    <td><input type="text" class="inline form-control " name="ci_html_descript"    style="width: 150px;" value="<?=$post['ci_html_descript']?>"></td>
                    <td><input type="text" class="inline form-control " name="ci_car_video_link"    style="width: 150px;" value="<?=$post['ci_car_video_link']?>"></td>
                </tr>
                <tr>
                    <td><label><?=$lang_carinfo['网址']?>:</label></td>
                    <td><label><?=$lang_carinfo['燃料税']?>(<?=$lang_carinfo['元']?>):</label></td>
                    <td><label><?=$lang_carinfo['牌照税']?>(<?=$lang_carinfo['元']?>):</label></td>
<!--                    <td><label>--><?//=$lang_carinfo['车部件安装位置']?><!--:</label></td>-->
                </tr>
                <tr>
                    <td><input type="text" class="inline form-control " name="ci_web_address"    style="width: 150px;" value="<?=$post['ci_web_address']?>"></td>
                    <td><input type="text" class="inline form-control " name="ci_fuel_tax"  onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="8" style="width: 150px;" value="<?=$post['ci_fuel_tax']?>"></td>
                    <td><input type="text" class="inline form-control " name="ci_license_tax"  onblur="validate_num(this)"  onchange="validate_submit(this)" maxlength="8" style="width: 150px;" value="<?=$post['ci_license_tax']?>"></td>
<!--                    <td>-->
<!--                        <select class="form-control" style="width: 150px" name="cp_part_location" >-->
<!--                            <option value="">--><?//=$lang_carinfo['请选择']?><!--</option>-->
<!--                            --><?php //foreach($terms_pl as $v):?>
<!--                                <option value="--><?//=$v['keyword']?><!--" --><?//=$post['cp_part_location']==$v['keyword']?'selected':''?><?//=$v['value']?><!--</option>-->
<!--                            --><?php //endforeach;?>
<!--                        </select>-->
<!--                    </td>-->
                </tr>
                <tr>
<!--                    <td><label>--><?//=$lang_carinfo['部件名称']?><!--:</label></td>-->
<!--                    <td><label>--><?//=$lang_carinfo['气缸名称']?><!--:</label></td>-->
                    <td><label><?=$lang_carinfo['区域选择']?>:</label></td>
                </tr>
                <tr>
<!--                    <td><input type="text" class="inline form-control " name="cp_part_name"    style="width: 150px;" value="--><?//=$post['cp_part_name']?><!--"></td>-->
<!--                    <td>-->
<!--                        <select class="form-control" style="width: 150px" name="ci_cylinder_name" >-->
<!--                            <option value="">--><?//=$lang_carinfo['请选择']?><!--</option>-->
<!--                            --><?php //foreach($terms_cyl_n as $v):?>
<!--                                <option value="--><?//=$v['keyword']?><!--" --><?//=$post['ci_cylinder_name']==$v['keyword']?'selected':''?><?//=$v['value']?><!--</option>-->
<!--                            --><?php //endforeach;?>
<!--                        </select>-->
<!--                    </td>-->
                    <td>
                        <select class="form-control" style="width: 150px" name="ci_region" required>
                            <option value=""><?=$lang_carinfo['请选择']?></option>
                            <?php foreach($terms_re as $v):?>
                                <option value="<?=$v['keyword']?>" <?=g('reg')==$v['keyword']?'selected':''?>><?=$v['value']?></option>
                            <?php endforeach;?>
                        </select>
                    </td>
                </tr>
                <table width="100%" style="line-height: 18px;margin-top: 10px;">
                    <tr>
                        <td><label><?=$lang_carinfo['新闻标签']?>id:</label></td>
                    </tr>
                    <tr>
                        <td><input type="text" class="inline form-control " name="tag_id"  style="width: 300px;" value="<?=$post['tag_id']?>"></td>
                    </tr>
                </table>
                <table width="100%" style="line-height: 18px;">
                    <tr>
                        <td><label><?=$lang_carinfo['经销商/代理商']?>:<span id="dist" class="glyphicon glyphicon-plus-sign"></span></label></td>
                    </tr>
                    <tr>
                        <td>
                            <div id="distribution_agent_v" style="width: 600px;min-height: 50px;overflow: auto">
                                <?php foreach($term_di as $v):?>
                                    <input type="hidden" name="ci_distribution_agent[]" value="<?=$v['keyword']?>">
                                    <span><?=$v['value']?>,</span>
                                <?php endforeach;?>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td><label><?=$lang_carinfo['车辆配备']?>:<span id="care" class="glyphicon glyphicon-plus-sign"></span></label></td>
                    </tr>
                    <tr>
                        <td>
                            <div id="car_equiptments_v" style="width: 600px;min-height: 50px;overflow: auto">
                                <?php foreach($term_care as $v):?>
                                    <input type="hidden" name="ci_car_equiptments[]" value="<?=$v['keyword']?>">
                                    <span><?=$v['value']?>,</span>
                                <?php endforeach;?>
                            </div>
                        </td>
                    </tr>
                </table>
                <table width="100%" style="line-height: 18px;" class="">
                    <tr>
                        <td><label>Banner<?=$lang_carinfo['图']?>(<?=$lang_carinfo['尺寸']?>:420*250)</label></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group" style="width: 600px;">
                            <span class="input-group-btn">
                            <button class="btn btn-default" type="button" id="inputfile"><?=$lang_carinfo['选择图片']?></button>
                            </span>
                            </div><!-- /input-group -->
                            <ul id="ul_pics" class="ul_pics ">
                                <?php foreach($img as $v){
                                    if($v['meta_type']==11){
                                        ?>
                                        <li>
                                            <div class="img layer-photos-demo">
                                                <img layer-src="./<?=$v['meta_file_path']?>" src="./<?=$v['meta_file_path']?>">
                                            </div>
                                            <a class="glyphicon glyphicon-trash remove" style="margin-top: 10px;"></a><br>
                                            <input type="hidden" name="meta_id[]" value="<?=$v['meta_id']?>">
                                            <input type="hidden" name="meta_type[]" value="11">
                                            <input type="hidden" name="meta_file_path[]" value="<?=$v['meta_file_path']?>">
                                            <input class='order' type='text' name='order_id[]' value="<?=$v['order_id']?>">
                                        </li>
                                    <?php }}?>
                            </ul>
                        </td>
                    </tr>
                </table>
                <table width="100%" style="line-height: 18px;margin-top: 50px;" >
                    <tr>
                        <td><label><?=$lang_carinfo['外观图']?>(<?=$lang_carinfo['尺寸']?>:300*250)(<?=$lang_carinfo['请上传6张图片外观']?>)</label></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group" style="width: 600px;">
                            <span class="input-group-btn">
                            <button class="btn btn-default" type="button" id="otherfile"><?=$lang_carinfo['选择图片']?></button>
                            </span>
                            </div><!-- /input-group -->
                            <ul id="other_ul_pics" class="ul_pics ">
                                <?php foreach($img as $v){
                                    if($v['meta_type']==12){
                                        ?>
                                        <li>
                                            <div class="img layer-photos-demo">
                                                <img layer-src="./<?=$v['meta_file_path']?>" src="./<?=$v['meta_file_path']?>">
                                            </div>
                                            <a class="glyphicon glyphicon-trash remove" style="margin-top: 10px;"></a><br>
                                            <input type="hidden" name="meta_id[]" value="<?=$v['meta_id']?>">
                                            <input type="hidden" name="meta_type[]" value="12">
                                            <input type="hidden" name="meta_file_path[]" value="<?=$v['meta_file_path']?>">
                                            <input class='order_oth' type='text' name='order_id[]' value="<?=$v['order_id']?>">
                                        </li>
                                    <?php }}?>
                            </ul>
                            <ul id="other_meta_id"></ul>
                        </td>
                    </tr>
                </table>
                <table width="100%" style="line-height: 18px;margin-top: 50px;">
                    <tr>
                        <td><label><?=$lang_carinfo['内饰图']?>(<?=$lang_carinfo['尺寸']?>:300*250)(<?=$lang_carinfo['请上传6张图片内饰']?>)</label></td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group" style="width: 600px;">
                            <span class="input-group-btn">
                            <button class="btn btn-default" type="button" id="otherfile_interior"><?=$lang_carinfo['选择图片']?></button>
                            </span>
                            </div><!-- /input-group -->
                            <ul id="other_interior_ul_pics" class="ul_pics ">
                                <?php foreach($img as $v){
                                    if($v['meta_type']==13){
                                        ?>
                                        <li>
                                            <div class="img layer-photos-demo">
                                                <img layer-src="./<?=$v['meta_file_path']?>" src="./<?=$v['meta_file_path']?>">
                                            </div>
                                            <a class="glyphicon glyphicon-trash remove" style="margin-top: 10px;"></a><br>
                                            <input type="hidden" name="meta_id[]" value="<?=$v['meta_id']?>">
                                            <input type="hidden" name="meta_type[]" value="13">
                                            <input type="hidden" name="meta_file_path[]" value="<?=$v['meta_file_path']?>">
                                            <input class='order_oth_interior' type='text' name='order_id[]' value="<?=$v['order_id']?>">
                                        </li>
                                    <?php }}?>
                            </ul>
                            <ul id="other_interior_meta_id"></ul>
                        </td>
                    </tr>
                </table>
            </table>
            <div class="mt">
                <label><?=$lang_carinfo['是否推荐']?>:</label><br>
            <span class="radio-inline">
                <input type="radio" name="ci_recommend" value="2" <?=$post['ci_recommend']==2 ? 'checked' : ''?>> <?=$lang_carinfo['是']?>
            </span>
            <span class="radio-inline">
                <input type="radio" name="ci_recommend" value="1" <?=$post['ci_recommend']==1 ? 'checked' : ''?>> <?=$lang_carinfo['否']?>
            </span>
                <div style="margin-top: 50px;">
                    <button type="submit" class="btn btn-default" ><?=$lang_carinfo['提交']?></button>
                    <a id="canc" class="btn btn-primary"><?=$lang_carinfo['取消']?></a>
                </div>
            </div>
        </form>
    </div>
    <script>
        var reg = parent.$('#region_cp option:selected').val();//获得父页面的区域参数

        $("#canc").click(function(){
            var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
            parent.layer.close(index); //再执行关闭
        });

        function validate_num(e) {
            var s = $(e).val();
            if (isNaN(s)) {
                layer.msg("<?=$lang_carinfo['请填写数字类型的数据']?>", function () {

                });
                $(e).focus()
            }
        }

        function validate_submit(e){
            // 为form绑定监听提交表单事件
            form.addEventListener('submit', function(event) {
                var s = $(e).val();
                var form = document.getElementById('form');
                if (isNaN(s)) {
                    layer.msg("<?=$lang_carinfo['请填写数字类型的数据']?>", function () {

                    });
                    //阻止表单提交
                    event.preventDefault();
                    $(e).focus()
                }
            });
        }

        function verify_order(){
            var arr=[];
            var arr_oth=[];
            var arr_oth_interior=[];
            var bool = true;
            var cb = $("#carbrands_v").val();
            var cm = $("#carmodels_v").val();
            var cs = $("#carstyles_v").val();
            var cbt = $("#car_bodytype_v").val();

            if (!$.trim(cb)){
                layer.msg('<?=$lang_carinfo['汽车厂牌不能为空']?>' ,{icon:2});
                bool = false;
            }else if(!$.trim(cm)){
                layer.msg('<?=$lang_carinfo['汽车车系不能为空']?>',{icon:2});
                bool = false;
            }else if(!$.trim(cs)){
                layer.msg('<?=$lang_carinfo['车款分类不能为空']?>',{icon:2});
                bool = false;
            }else if(!$.trim(cbt)){
                layer.msg('<?=$lang_carinfo['车型分类不能为空']?>',{icon:2});
                bool = false;
            }

            //banner图
            $(".order").each(function(){
                if($.trim($(this).val())&&$(this).val()!='0') {
                    arr.push($(this).val());
                }
            });
            var nary=arr.sort();
            for(var i=0;i<arr.length;i++){
                if (nary[i]==nary[i+1]){
                    layer.msg("<?=$lang_carinfo['存在重复序号']?>", {icon:2});
                    bool = false;
                }
            }

            //外观图
            $(".order_oth").each(function(){
                if($.trim($(this).val())&&$(this).val()!='0') {
                    arr_oth.push($(this).val());
                }
            });
            var nary_oth=arr_oth.sort();
            for(var i=0;i<arr_oth.length;i++){
                if (nary_oth[i]==nary_oth[i+1]){
                    layer.msg("<?=$lang_carinfo['存在重复序号']?>", {icon:2});
                    bool = false;
                }
            }

            //内饰图
            $(".order_oth_interior").each(function(){
                if($.trim($(this).val())&&$(this).val()!='0') {
                    arr_oth_interior.push($(this).val());
                }
            });
            var nary_oth_interior=arr_oth_interior.sort();
            for(var i=0;i<arr_oth_interior.length;i++){
                if (nary_oth_interior[i]==nary_oth_interior[i+1]){
                    layer.msg("<?=$lang_carinfo['存在重复序号']?>", {icon:2});
                    bool = false;
                }
            }
            return bool;
        }
        function ajax_get(s,v,r,e,a,b) {
            var index = layer.load(2, {
                shade: [0.1,'#fff'] //0.1透明度的白色背景
            });
            $.ajax({
                url:'<?=URL?>iscaradmin/?srv='+s,
                type:'post',
                data:{'search':e,'ci_id':<?=$post['ci_id']?>,'cb_id':a, 'cm_id':b, 'reg':r},
                dataType:'html',
                error: function(){
                    alert('Error loading document');
                },
                success: function(msg){
                    var post = eval("("+msg+")");
                    post = post.data;
                    v.$set('post', post)
                },
                complete(){
                    layer.close(index);
                }
            })
        }
        //banner图
        var uploader = new plupload.Uploader({//创建实例的构造方法
            runtimes: 'html5,flash,silverlight,html4', //上传插件初始化选用那种方式的优先级顺序
            browse_button: inputfile, // 上传按钮
            url: "<?=URL?>iscaradmin/?p=carinfo", //远程上传地址
            multipart_params: {
                a: 'ajax_img',
                meta_type: 11
            },
            flash_swf_url: 'plupload/Moxie.swf', //flash文件地址
            silverlight_xap_url: 'plupload/Moxie.xap', //silverlight文件地址
            filters: {
                max_file_size: '10mb', //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
                mime_types: [//允许文件上传类型
                    {title: "files", extensions: "jpg,png,gif"}
                ]
            },
            multi_selection: true, //true:ctrl多文件上传, false 单文件上传
            init: {
                FilesAdded: function (up, files) { //文件上传前
                    if ($('#ul_pics').children("li").length > 10) {
                        layer.msg("<?=$lang_carinfo['您上传的图片太多了']?>", {icon: 5});
                        uploader.destroy();
                    } else {
                        var li = '';
                        plupload.each(files, function (file) { //遍历文件
                            li += "<li id='" + file['id'] + "'><div class='progress'><span class='bar'></span><span class='percent'>0%</span></div></li>";
                        });
                        $("#ul_pics").append(li);
                        uploader.start();
                    }
                },
                UploadProgress: function (up, file) { //上传中，显示进度条
                    var percent = file.percent;
                    $("#" + file.id).find('.bar').css({"width": percent + "%"});
                    $("#" + file.id).find(".percent").text(percent + "%");
                },
                FileUploaded: function (up, file, info) { //文件上传成功的时候触发
                    var data = eval("(" + info.response + ")");
                    $("#" + file.id).html("<div class='img layer-photos-demo'><img layer-src='" + data.pic + "' src='" + data.pic + "' alt='"+data.name+"'/></div><a class='glyphicon glyphicon-trash remove' style='margin-top: 10px;'></a><br><input type='hidden' name='meta_id[]' value='" + data.meta_id + "'><input class='order' type='text' name='order_id[]' value='0'>");
                },
                Error: function (up, err) { //上传出错的时候触发
                    layer.msg(err.message, {icon: 5});
                }
            }
        });
        uploader.init();

        //外观图
        var uploader_other = new plupload.Uploader({//创建实例的构造方法
            runtimes: 'html5,flash,silverlight,html4', //上传插件初始化选用那种方式的优先级顺序
            browse_button: otherfile, // 上传按钮
            url: "<?=URL?>iscaradmin/?p=carinfo", //远程上传地址
            multipart_params: {
                a: 'ajax_img',
                meta_type: 12
            },
            flash_swf_url: 'plupload/Moxie.swf', //flash文件地址
            silverlight_xap_url: 'plupload/Moxie.xap', //silverlight文件地址
            filters: {
                max_file_size: '10mb', //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
                mime_types: [//允许文件上传类型
                    {title: "files", extensions: "jpg,png,gif"}
                ]
            },
            multi_selection: false, //true:ctrl多文件上传, false 单文件上传
            init: {
                FilesAdded: function (up, files) { //文件上传前
                    if ($('#other_ul_pics').children("li").length > 5) {
                        layer.msg("<?=$lang_carinfo['您上传的图片太多了']?>", {icon: 5});
                        uploader_other.destroy();
                    } else {
                        var li = '';
                        plupload.each(files, function (file) { //遍历文件
                            li += "<li id='" + file['id'] + "'><div class='progress'><span class='bar'></span><span class='percent'>0%</span></div></li>";
                        });
                        $("#other_ul_pics").append(li);
                        uploader_other.start();
                    }
                },
                UploadProgress: function (up, file) { //上传中，显示进度条
                    var percent = file.percent;
                    $("#" + file.id).find('.bar').css({"width": percent + "%"});
                    $("#" + file.id).find(".percent").text(percent + "%");
                },
                FileUploaded: function (up, file, info) { //文件上传成功的时候触发
                    var data = eval("(" + info.response + ")");
                    $("#" + file.id).html("<div class='img layer-photos-demo'><img layer-src='" + data.pic + "' src='" + data.pic + "'/></div><a class='glyphicon glyphicon-trash remove' style='margin-top: 10px;'></a><br><input type='hidden' name='meta_id[]' value='" + data.meta_id + "'><input class='order_oth' type='text' name='order_id[]' value='0'>");
                },
                Error: function (up, err) { //上传出错的时候触发
                    layer.msg(err.message, {icon: 5});
                }
            }
        });
        uploader_other.init();

        //内饰图
        var uploader_other_interior = new plupload.Uploader({//创建实例的构造方法
            runtimes: 'html5,flash,silverlight,html4', //上传插件初始化选用那种方式的优先级顺序
            browse_button: otherfile_interior, // 上传按钮
            url: "<?=URL?>iscaradmin/?p=carinfo", //远程上传地址
            multipart_params: {
                a: 'ajax_img',
                meta_type: 13
            },
            flash_swf_url: 'plupload/Moxie.swf', //flash文件地址
            silverlight_xap_url: 'plupload/Moxie.xap', //silverlight文件地址
            filters: {
                max_file_size: '10mb', //最大上传文件大小（格式100b, 10kb, 10mb, 1gb）
                mime_types: [//允许文件上传类型
                    {title: "files", extensions: "jpg,png,gif"}
                ]
            },
            multi_selection: false, //true:ctrl多文件上传, false 单文件上传
            init: {
                FilesAdded: function (up, files) { //文件上传前
                    if ($('#other_interior_ul_pics').children("li").length > 5) {
                        layer.msg("<?=$lang_carinfo['您上传的图片太多了']?>", {icon: 5});
                        uploader_other_interior.destroy();
                    } else {
                        var li = '';
                        plupload.each(files, function (file) { //遍历文件
                            li += "<li id='" + file['id'] + "'><div class='progress'><span class='bar'></span><span class='percent'>0%</span></div></li>";
                        });
                        $("#other_interior_ul_pics").append(li);
                        uploader_other_interior.start();
                    }
                },
                UploadProgress: function (up, file) { //上传中，显示进度条
                    var percent = file.percent;
                    $("#" + file.id).find('.bar').css({"width": percent + "%"});
                    $("#" + file.id).find(".percent").text(percent + "%");
                },
                FileUploaded: function (up, file, info) { //文件上传成功的时候触发
                    var data = eval("(" + info.response + ")");
                    $("#" + file.id).html("<div class='img layer-photos-demo'><img src='" + data.pic + "'/></div><a class='glyphicon glyphicon-trash remove' style='margin-top: 10px;'></a><br><input type='hidden' name='meta_id[]' value='" + data.meta_id + "'><input class='order_oth_interior' type='text' name='order_id[]' value='0'>");
                },
                Error: function (up, err) { //上传出错的时候触发
                    layer.msg(err.message, {icon: 5});
                }
            }
        });
        uploader_other_interior.init();

        /***
         * 制造商
         */
        var v_manuf = new Vue({
            el:'#manufact',
            data:{
                post:{}
            }
        });
        $("#manu").click(function(){//制造商
            layer.open({
                type: 1,
                shade: 0,
                title:"<?=$lang_carinfo['制造商']?>",
                content: $('.ci_manufactory'), //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
                area: ['450px', '300px'],
                btn: ['<?=$lang_carinfo['确定']?>', '<?=$lang_carinfo['取消']?>'],
                yes: function(index, layero){
                    var ma = $('input[name="ci_manufactory"]:checked').val();
                    var ma_v = $('input[name="ci_manufactory"]:checked').next('span').html();
                    $("#manufactory_v").val(ma_v);
                    $("#manufactory").val(ma);

                    layer.close(index);
                },
                cancel: function(){
                    //右上角关闭回调
                }
            });
            ajax_get('manufactory',v_manuf, reg);
        });

        $("#manu_s").click(function(){
            var manu_v = myHtmlEncode($.trim($("#manu_v").val()));
            if(!$.trim(manu_v)){
                layer.msg('<?=$lang_carinfo['请输入搜索内容']?>');
            }else{
                ajax_get('manufactory',v_manuf,reg,manu_v);
            }
        });
        //////////////////////////////////////////////////////////////////////////////////////////

        /**
         *产地
         */
        var v_cars = new Vue({
            el:'#carsour',
            data:{
                post:{}
            }
        });
        $("#cars").click(function(){//产地
            layer.open({
                type: 1,
                shade: 0,
                title:"<?=$lang_carinfo['产地']?>",
                content: $('.ci_carsource'), //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
                area: ['450px', '300px'],
                btn: ['<?=$lang_carinfo['确定']?>', '<?=$lang_carinfo['取消']?>'],
                yes: function(index, layero){
                    var ca = $('input[name="ci_carsource"]:checked').val();
                    var ca_v = $('input[name="ci_carsource"]:checked').next('span').html();
                    $("#carsource_v").val(ca_v);
                    $("#carsource").val(ca);

                    layer.close(index);
                },
                cancel: function(){
                    //右上角关闭回调
                }
            });
            ajax_get('carsource',v_cars,reg);
        });
        $("#cars_s").click(function(){
            var cars_v = myHtmlEncode($.trim($("#cars_v").val()));
            if(!$.trim(cars_v)){
                layer.msg('<?=$lang_carinfo['请输入搜索内容']?>');
            }else{
                ajax_get('carsource',v_cars,reg,cars_v);
            }
        });
        //////////////////////////////////////////////////////////////////////////////////////////

        /**
         * 技术合作
         */
        var v_tech = new Vue({
            el:'#technical',
            data:{
                post:{}
            }
        });
        $("#tech").click(function(){//技术合作
            layer.open({
                type: 1,
                shade: 0,
                title:"<?=$lang_carinfo['技术合作']?>",
                content: $('.ci_technical_cooperation'), //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
                area: ['450px', '300px'],
                btn: ['<?=$lang_carinfo['确定']?>', '<?=$lang_carinfo['取消']?>'],
                yes: function(index, layero){
                    var te = $('input[name="ci_technical_cooperation"]:checked').val();
                    var te_v = $('input[name="ci_technical_cooperation"]:checked').next('span').html();
                    $("#technical_cooperation_v").val(te_v);
                    $("#technical_cooperation").val(te);

                    layer.close(index);
                },
                cancel: function(){
                    //右上角关闭回调
                }
            });
            ajax_get('technical',v_tech,reg)
        });
        $("#tech_s").click(function(){
            var tech_v = myHtmlEncode($.trim($("#tech_v").val()));
            if(!$.trim(tech_v)){
                layer.msg('<?=$lang_carinfo['请输入搜索内容']?>');
            }else{
                ajax_get('technical',v_tech,reg,tech_v);
            }
        });
        //////////////////////////////////////////////////////////////////////////////////////////

        /**
         * 	汽车车型
         */
        var v_body = new Vue({
            el:'#bodytype',
            data:{
                post:{}
            }
        });
        $("#carbody").click(function(){//汽车车型
            layer.open({
                type: 1,
                shade: 0,
                title:"<?=$lang_carinfo['汽车车型']?>",
                content: $('.ci_car_bodytype'), //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
                area: ['450px', '300px'],
                btn: ['<?=$lang_carinfo['确定']?>', '<?=$lang_carinfo['取消']?>'],
                yes: function(index, layero){
                    var cb = $('input[name="ci_car_bodytype"]:checked').val();
                    var cb_v = $('input[name="ci_car_bodytype"]:checked').next('span').html();
                    $("#car_bodytype_v").val(cb_v);
                    $("#car_bodytype").val(cb);

                    layer.close(index);
                },
                cancel: function(){
                    //右上角关闭回调
                }
            });
            ajax_get('bodytype',v_body,reg)
        });
        $("#body_s").click(function(){
            var body_v = myHtmlEncode($.trim($("#body_v").val()));
            if(!$.trim(body_v)){
                layer.msg('<?=$lang_carinfo['请输入搜索内容']?>');
            }else{
                ajax_get('bodytype',v_body,reg,body_v);
            }
        });
        //////////////////////////////////////////////////////////////////////////////////////////

        /**
         * 经销商/代理商
         */
        var v_dist = new Vue({
            el:'#dist_age',
            data:{
                post:{}
            }
        });
        $("#dist").click(function(){//经销商/代理商
            layer.open({
                type: 1,
                shade: 0,
                title:"<?=$lang_carinfo['经销商/代理商']?>",
                content: $('.ci_distribution_agent'), //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
                area: ['450px', '300px'],
                btn: ['<?=$lang_carinfo['确定']?>', '<?=$lang_carinfo['取消']?>'],
                yes: function(index, layero){
                    var input = ''
                    $(".dis_a label").each(function(){
                        if($(this).find("input[name='ci_distribution_agent']:checked").val() != undefined)
                        {
                            var di = $(this).find("input[name='ci_distribution_agent']:checked").val();
                            console.log(di);
                            input = input + "<input type='hidden' name='ci_distribution_agent[]' value="+di+">";

                        }
                    });
                    $("#distribution_agent_v").html(input);
                    $(".dis_a label").each(function(){
                        if($(this).find("input[name='ci_distribution_agent']:checked").val() != undefined)
                        {
                            var di_v = $(this).find("input[name='ci_distribution_agent']:checked").next('span').html();
                            console.log(di_v);
                            input = "<span>"+di_v+",  </span>";
                            $("#distribution_agent_v").append(input);
                        }
                    });
                    layer.close(index);
                },
                cancel: function(){
                    //右上角关闭回调
                }
            });
            ajax_get('distribution',v_dist,reg)
        });
        $("#dist_s").click(function(){
            var dist_v = myHtmlEncode($.trim($("#dist_v").val()));
            if(!$.trim(dist_v)){
                layer.msg('<?=$lang_carinfo['请输入搜索内容']?>');
            }else{
                ajax_get('distribution',v_dist,reg,dist_v);
            }
        });
        //////////////////////////////////////////////////////////////////////////////////////////

        /**
         * 车辆配备
         */
        var v_care = new Vue({
            el:'#car_equip',
            data:{
                post:{}
            }
        });
        $("#care").click(function(){//车辆配备
            layer.open({
                type: 1,
                shade: 0,
                title:"<?=$lang_carinfo['车辆配备']?>",
                content: $('.ci_car_equiptments'), //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
                area: ['450px', '300px'],
                btn: ['<?=$lang_carinfo['确定']?>', '<?=$lang_carinfo['取消']?>'],
                yes: function(index, layero){
                    var input = ''
                    $(".car_e label").each(function(){
                        if($(this).find("input[name='ci_car_equiptments']:checked").val() != undefined)
                        {
                            var di = $(this).find("input[name='ci_car_equiptments']:checked").val();
                            console.log(di);
                            input = input + "<input type='hidden' name='ci_car_equiptments[]' value="+di+">";

                        }
                    });
                    $("#car_equiptments_v").html(input);
                    $(".car_e label").each(function(){
                        if($(this).find("input[name='ci_car_equiptments']:checked").val() != undefined)
                        {
                            var di_v = $(this).find("input[name='ci_car_equiptments']:checked").next('span').html();
                            console.log(di_v);
                            input = "<span>"+di_v+",  </span>";
                            $("#car_equiptments_v").append(input);
                        }
                    });
                    layer.close(index);
                },
                cancel: function(){
                    //右上角关闭回调
                }
            });
            ajax_get('carequiptment',v_care,reg)
        });
        $("#care_s").click(function(){
            var care_v = myHtmlEncode($.trim($("#care_v").val()));
            if(!$.trim(care_v)){
                layer.msg('<?=$lang_carinfo['请输入搜索内容']?>');
            }else{
                ajax_get('carequiptment',v_care,reg,care_v);
            }
        });
        //////////////////////////////////////////////////////////////////////////////////////////
        /**
         * 汽车厂牌
         */
        var v_brands = new Vue({
            el:'#brands',
            data:{
                post:{}
            }
        });
        $("#carb").click(function(){//汽车厂牌
            layer.open({
                type: 1,
                shade: 0,
                title:"<?=$lang_carinfo['汽车厂牌']?>",
                content: $('.car_brands'), //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
                area: ['450px', '300px'],
                btn: ['<?=$lang_carinfo['确定']?>', '<?=$lang_carinfo['取消']?>'],
                yes: function(index, layero){
                    var cb = $('input[name="car_brands"]:checked').val();
                    var cb_v = $('input[name="car_brands"]:checked').next('span').html();
                    if($.trim(cb)) {
                        ajax_get('carmodel', v_models, reg, '', cb);
                    }
                    $("#carbrands_v").val(cb_v);
                    $("#carbrands").val(cb);
                    //汽车车系的值滞空
                    $("#carmodels_v").val('');
                    $("#carmodels").val('');
                    //汽车车款的值滞空
                    $("#carstyles_v").val('');
                    $("#carstyles").val('');

                    layer.close(index);
                },
                cancel: function(){
                    //右上角关闭回调
                }
            });
            ajax_get('carbrand',v_brands,reg);
        });
        $("#brand_s").click(function(){
            var brand_v = myHtmlEncode($.trim($("#brand_v").val()));
            if(!$.trim(brand_v)){
                layer.msg('<?=$lang_carinfo['请输入搜索内容']?>');
            }else{
                ajax_get('carbrand',v_brands,reg,brand_v);
            }
        });
        //////////////////////////////////////////////////////////////////////////////////////////
        /**
         * 汽车车系
         */
        var v_models = new Vue({
            el:'#models',
            data:{
                post:{}
            }
        });
        //初始化汽车车系
        var cb = $('input[name="ci_car_brand"]').val();
        if($.trim(cb)) {
            ajax_get('carmodel', v_models, reg, '', cb);
        }

        $("#carm").click(function(){//汽车车系
            layer.open({
                type: 1,
                shade: 0,
                title:"<?=$lang_carinfo['汽车车系']?>",
                content: $('.car_models'), //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
                area: ['450px', '300px'],
                btn: ['<?=$lang_carinfo['确定']?>', '<?=$lang_carinfo['取消']?>'],
                yes: function(index, layero){
                    var cm = $('input[name="car_models"]:checked').val();
                    var cm_v = $('input[name="car_models"]:checked').next('span').html();
                    var cb = $("#carbrands").val();
                    if($.trim(cb)&& $.trim(cm)) {
                        ajax_get('carstyle', v_styles, reg, '', cb, cm);
                    }
                    $("#carmodels_v").val(cm_v);
                    $("#carmodels").val(cm);

                    layer.close(index);
                },
                cancel: function(){
                    //右上角关闭回调
                }
            });
        });
        $("#model_s").click(function(){
            var model_v = myHtmlEncode($.trim($("#model_v").val()));
            if(!$.trim(model_v)){
                layer.msg('<?=$lang_carinfo['请输入搜索内容']?>');
            }else{
                ajax_get('carmodel',v_models,reg,model_v);
            }
        });
        //////////////////////////////////////////////////////////////////////////////////////////

        /**
         * 车款分类
         */
        var v_styles = new Vue({
            el:'#styles',
            data:{
                post:{}
            }
        });
        //初始化车款分类
        var cm = $('input[name="ci_brand_model"]').val();
        if($.trim(cb)&& $.trim(cm)) {
            ajax_get('carstyle', v_styles, reg, '', cb, cm);
        }

        $("#carsty").click(function(){//车款分类
            layer.open({
                type: 1,
                shade: 0,
                title:"<?=$lang_carinfo['车款分类']?>",
                content: $('.car_styles'), //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
                area: ['450px', '300px'],
                btn: ['<?=$lang_carinfo['确定']?>', '<?=$lang_carinfo['取消']?>'],
                yes: function(index, layero){
                    var cs = $('input[name="car_styles"]:checked').val();
                    var cs_v = $('input[name="car_styles"]:checked').next('span').html();
                    $("#carstyles_v").val(cs_v);
                    $("#carstyles").val(cs);

                    layer.close(index);
                },
                cancel: function(){
                    //右上角关闭回调
                }
            });
            if(!($('input[name="car_styles"]').val())){
                layer.msg("<?=$lang_carinfo['该车系下所有的车款都已建档']?>");
            }
        });
        $("#style_s").click(function(){
            var style_v = myHtmlEncode($.trim($("#style_v").val()));
            if(!$.trim(style_v)){
                layer.msg('<?=$lang_carinfo['请输入搜索内容']?>');
            }else{
                ajax_get('carstyle',v_styles,reg,style_v);
            }
        });
        //////////////////////////////////////////////////////////////////////////////////////////

        /**
         * 车辆概览文章
         */
        $("#cararticle").click(function(){
            layer.open({
                type: 2,
                title:'撰写新文章',
                shade: 0,
                moveOut:true,
                maxmin: true, //开启最大化最小化按钮
                content: '<?=URL?>wp-admin/post-new.php', //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
                area: ['1000px', '600px'],
                cancel: function(){
                    //右上角关闭回调
                }
            });
        });
        //////////////////////////////////////////////////////////////////////////////////////////
    </script>
    </body>
<?php include ('footer.php');?>