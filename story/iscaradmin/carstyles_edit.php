<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/7
 * Time: 13:39
 */
include ('header.php');
?>
<title><?=$lang_carstyles['车款管理']?></title>
<style>
    .file-box{
        position: relative;
        width: 340px;
    }
    .txt{
        height: 22px;
        border:1px solid #cdcdcd;
        width:180px;
    }
    .btn-file{
        background-color: #FFF;
        border:1px solid #CDCDCD;
        height: 24px;
        width: 70px;
    }
    .file{
        position: absolute;
        top:0;
        filter:alpha(opacity=0);
        opacity: 0;
        width: 260px;
    }
    .glyphicon{
        cursor: pointer;
    }
</style>
</head>
<body>
<!--厂牌名称-->
<div class="car_brands" style="display: none;" id="brands">
    <div class="input-group">
        <input type="text" class="form-control" id="brand_v">
<span class="input-group-btn">
<button class="btn btn-default" type="button" id="brand_s"><?=$lang_carstyles['搜索']?></button>
</span>
    </div><!-- /input-group -->
    <div class="" style="padding: 10px;">
        <label class="radio-inline" v-for="item in post" style="margin-top: 20px;">
            <input type="radio" name="car_brands" :checked="<?=$post['cb_id']?>==item.cb_id" value="{{item.cb_id}}"><span>{{item.cb_fullname}}</span >
        </label>
    </div>
</div>
<!--厂牌名称 end-->
<!--车系名称-->
<div class="car_models" style="display: none;" id="models">
    <div class="input-group">
        <input type="text" class="form-control" id="model_v">
<span class="input-group-btn">
<button class="btn btn-default" type="button" id="model_s"><?=$lang_carstyles['搜索']?></button>
</span>
    </div><!-- /input-group -->
    <div class="" style="padding: 10px;">
        <label class="radio-inline" v-for="item in post" style="margin-top: 20px;">
            <input type="radio" name="car_models" :checked="<?=$post['cm_id']?>==item.cm_id" value="{{item.cm_id}}"><span>{{item.cm_fullname}}</span >
        </label>
    </div>
</div>
<!--车系名称 end-->
<div id="body">
    <h2><?=$lang_carstyles['汽车车款编辑']?></h2>
    <form action="<?=URL?>iscaradmin/?p=carstyles&a=edit&id=<?=$post['cs_id']?>" method="post" enctype="multipart/form-data" onsubmit="return verify()">
        <table width="100%" style="line-height: 18px;">
            <tr>
                <td>
                    <label><?=$lang_carstyles['厂牌名称']?>:<span id="carb" class="glyphicon glyphicon-plus-sign"></span></label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" class="inline form-control" value="<?=$post['cb_fullname']?>" disabled="disabled" id="carbrands_v" style="width: 150px;" >
                </td>
                <input type="hidden" id="carbrands" name="cb_id" value="<?=$post['cb_id']?>">
            </tr>
        </table>
        <table width="100%" style="line-height: 18px;">
            <tr>
                <td>
                    <label><?=$lang_carstyles['车系名称']?>:<span id="carm" class="glyphicon glyphicon-plus-sign"></span></label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" class="inline form-control" value="<?=$post['cm_fullname']?>" disabled="disabled" id="carmodels_v" style="width: 150px;" >
                </td>
                <input type="hidden" id="carmodels" name="cm_id" value="<?=$post['cm_id']?>">
            </tr>
        </table>
        <div>
            <div style="width: 500px">
                <label><?=$lang_carstyles['车款名称']?>:</label><br>
                <input type="text" class="inline form-control " name="cs_fullname"  value="<?=$post['cs_fullname']?>" required>
            </div>
            <div style="width: 300px">
                <label><?=$lang_carstyles['车款昵称']?>:</label>
                <input type="text" class="inline form-control " name="cs_nickname"  value="<?=$post['cs_nickname']?>" >
            </div>
        </div>
        <di>
            <div style="width: 200px">
                <label><?=$lang_carstyles['缩写']?>:</label><br>
                <input type="text" class="inline form-control " name="cs_short_name" value="<?=$post['cs_short_name']?>" >
            </div>
<!--            <div style="width: 100px">-->
<!--                <label>--><?//=$lang_carstyles['序号']?><!--:</label>-->
<!--                <input type="text" id="list" class="inline form-control " name="cs_list_order" value="--><?//=$post['cs_list_order']?><!--" onblur="validate_num(this)" maxlength="8">-->
<!--            </div>-->
        </di>
        <table width="100%" style="line-height: 18px;margin-top: 10px;">
            <tr>
                <td><label><?=$lang_carstyles['区域选择']?>:</label></td>
            </tr>
            <tr>
                <td>
                    <select class="form-control" style="width: 150px" name="cs_region" required>
                        <option value=""><?=$lang_carstyles['请选择']?></option>
                        <?php foreach($terms_re as $v):?>
                            <option value="<?=$v['keyword']?>" <?=$post['cs_region']==$v['keyword']?'selected':''?>><?=$v['value']?></option>
                        <?php endforeach;?>
                    </select>
                </td>
            </tr>
        </table>
        <!--<div>
            <label><?/*=$lang_carstyles['选择图标文件']*/?>:(<?/*=$lang_carstyles['图标大小建议']*/?>100*100)</label>
            <div class="file-box">
                <input type="text" class="txt" id="textfield" value="<?/*=$post['cs_icon_path']*/?>" >
                <input type="button" class="btn-file" value="<?/*=$lang_carstyles['浏览']*/?>"id="btn_img">
                <input type="file" name="cs_icon_path" class="file" size="28" id="btn_img" onchange="document.getElementById('textfield').value=this.value">
                <br><img style="max-width: 100px;max-height: 100px" src="./<?/*=$post['cs_icon_path']*/?>" class="img-rounded">
            </div>
        </div>-->
        <div>
            <!--<label><?/*=$lang_carstyles['热门标示']*/?>:</label><br>
            <span class="radio-inline">
                <input type="radio" name="cs_hot_item_tag" value="3" <?/*=$post['cs_hot_item_tag']==3 ? 'checked' : ''*/?>> <?/*=$lang_carstyles['是']*/?>
            </span>
            <span class="radio-inline">
                <input type="radio" name="cs_hot_item_tag" value="1" <?/*=$post['cs_hot_item_tag']==1 ? 'checked' : ''*/?>> <?/*=$lang_carstyles['否']*/?>
            </span>-->
            <div style="margin-top: 50px;">
                <button type="submit" class="btn btn-default"><?=$lang_carstyles['提交']?></button>
                <a id="canc" class="btn btn-primary"><?=$lang_carstyles['取消']?></a>
            </div>
        </div>
    </form>
</div>
<script>
    var reg = parent.$('#region option:selected').val();//获得父页面的区域参数

    $("#canc").click(function(){
        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
        parent.layer.close(index); //再执行关闭
    });

    function validate_num(e){
        var s = $(e).val();
        if(isNaN(s)){
            layer.msg("<?=$lang_carstyles['请填写数字类型的数据']?>",function(){

            });
            $(e).focus()
        }
    }
    function verify() {
        var bool = true;
        var cb = $("#carbrands_v").val();
        var cm = $("#carmodels_v").val();
        var cs_name = $('input[name="cs_fullname"]').val();
        var cb_id = $('input[name="cb_id"]').val();
        var cm_id = $('input[name="cm_id"]').val();
        var id = <?=$post['cs_id']?>;

        if (!$.trim(cb)){
            layer.msg('<?=$lang_carstyles['汽车厂牌不能为空']?>' ,{icon:2});
            bool = false;
        }else if(!$.trim(cm)){
            layer.msg('<?=$lang_carstyles['汽车车系不能为空']?>',{icon:2});
            bool = false;
        }else if ($.trim(cs_name)) {
            $.ajax({
                url: '<?=URL?>iscaradmin/?p=carstyles',
                type: 'post',
                async: false,
                data: {'cs_name': cs_name, 'a': 'verify_cs_name', 'cb_id' : cb_id, 'cm_id':cm_id, 'id':id},
                dataType: 'json',
                error: function () {
                    layer.msg('Error loading document');
                    bool = false;
                },
                success: function (res) {
                    if (res.data != 1) {
                        layer.msg('<?=$lang_carstyles['车款名称不能重复']?>', {icon: 2});
                        bool = false;
                    }
                }
            });
        }
        return bool;
    }

    function ajax_get(s,v,r,e,c) {
        var index = layer.load(2, {
            shade: [0.1,'#fff'] //0.1透明度的白色背景
        });
        $.ajax({
            url:'<?=URL?>iscaradmin/?srv='+s,
            type:'post',
            data:{'search':e,'cb_id':c,'reg':r},//搜索
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
    /**
     * 厂牌名称
     */
    var v_brands = new Vue({
        el:'#brands',
        data:{
            post:{}
        }
    });
    $("#carb").click(function(){//厂牌名称
        layer.open({
            type: 1,
            shade: 0,
            title:"<?=$lang_carstyles['厂牌名称']?>",
            content: $('.car_brands'), //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
            area: ['450px', '300px'],
            btn: ['<?=$lang_carstyles['确定']?>', '<?=$lang_carstyles['取消']?>'],
            yes: function(index, layero){
                var cb = $('input[name="car_brands"]:checked').val();
                var cb_v = $('input[name="car_brands"]:checked').next('span').html();
                if($.trim(cb)) {
                    ajax_get('carmodel', v_models, reg, '', cb);
                }
                $("#carbrands_v").val(cb_v);
                $("#carbrands").val(cb);

                $("#carmodels_v").val('');
                $("#carmodels").val('');

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
            layer.msg('<?=$lang_carstyles['请输入搜索内容']?>');
        }else{
            ajax_get('carbrand',v_brands,reg,brand_v);
        }
    });
    //////////////////////////////////////////////////////////////////////////////////////////
    /**
     * 车系名称
     */
    var v_models = new Vue({
        el:'#models',
        data:{
            post:{}
        }
    });
    $("#carm").click(function(){//车系名称
        layer.open({
            type: 1,
            shade: 0,
            title:"<?=$lang_carstyles['车系名称']?>",
            content: $('.car_models'), //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
            area: ['450px', '300px'],
            btn: ['<?=$lang_carstyles['确定']?>', '<?=$lang_carstyles['取消']?>'],
            yes: function(index, layero){
                var cm = $('input[name="car_models"]:checked').val();
                var cm_v = $('input[name="car_models"]:checked').next('span').html();
                $("#carmodels_v").val(cm_v);
                $("#carmodels").val(cm);

                layer.close(index);
            },
            cancel: function(){
                //右上角关闭回调
            }
        });
//        ajax_get('carbrand',v_brands)
    });
    $("#model_s").click(function(){
        var model_v = myHtmlEncode($.trim($("#model_v").val()));
        if(!$.trim(model_v)){
            layer.msg('<?=$lang_carstyles['请输入搜索内容']?>');
        }else{
            ajax_get('carmodel',v_models,reg,model_v);
        }
    });
    //////////////////////////////////////////////////////////////////////////////////////////
</script>
</body>
<?php include ('footer.php');?>