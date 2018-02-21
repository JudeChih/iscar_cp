<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/7
 * Time: 10:34
 */
include ('header.php');
?>
<title><?=$lang_carmodels['车系管理']?></title>
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
    <button class="btn btn-default" type="button" id="brand_s"><?=$lang_carmodels['搜索']?></button>
  </span>
    </div><!-- /input-group -->
    <div class="" style="padding: 10px;">
        <label class="radio-inline" v-for="item in post" style="margin-top: 20px;">
            <input type="radio" name="car_brands"  value="{{item.cb_id}}"><span>{{item.cb_fullname}}</span >
        </label>
    </div>
</div>
<!--厂牌名称 end-->
<div id="body">
    <form action="<?=URL?>iscaradmin/?p=carmodels&a=add" method="post" enctype="multipart/form-data" onsubmit="return verify()">
        <table width="100%" style="line-height: 18px;">
            <tr>
                <td>
                    <label><?=$lang_carmodels['厂牌名称']?>:<span id="carb" class="glyphicon glyphicon-plus-sign"></span></label>
                </td>
            </tr>
            <tr>
                <td>
                    <input type="text" class="inline form-control" disabled="disabled" id="carbrands_v" style="width: 150px;" >
                </td>
                <input type="hidden" id="carbrands" name="cb_id">
            </tr>
        </table>
        <div>
            <div style="width: 500px">
                <label><?=$lang_carmodels['车系名称']?>:</label>
                <input type="text" class="inline form-control " name="cm_fullname"  required>
            </div>
            <div style="width: 300px">
                <label><?=$lang_carmodels['车系昵称']?>:</label>
                <input type="text" class="inline form-control " name="cm_nickname"  >
            </div>
        </div>
        <div>
            <div style="width: 200px">
                <label><?=$lang_carmodels['缩写']?>:</label>
                <input type="text" class="inline form-control " name="cm_short_name" >
            </div>
<!--            <div style="width: 100px">-->
<!--                <label>--><?//=$lang_carmodels['序号']?><!--:</label>-->
<!--                <input type="text" class="inline form-control " id="list" name="cm_list_order" onblur="validate_num(this)" maxlength="8">-->
<!--            </div>-->
        </div>
        <table width="100%" style="line-height: 18px;margin-top: 10px;">
            <tr>
                <td><label><?=$lang_carmodels['区域选择']?>:</label></td>
            </tr>
            <tr>
                <td>
                    <select class="form-control" style="width: 150px" name="cm_region" required>
                        <option value=""><?=$lang_carmodels['请选择']?></option>
                        <?php foreach($terms_re as $v):?>
                            <option value="<?=$v['keyword']?>" <?=g('reg')==$v['keyword']?'selected':''?>><?=$v['value']?></option>
                        <?php endforeach;?>
                    </select>
                </td>
            </tr>
        </table>
        <!--<div class="" style="margin-top: 10px;">
            <label><?/*=$lang_carmodels['选择图标文件']*/?>:(<?/*=$lang_carmodels['图标大小建议']*/?>100*100)</label>
            <div class="file-box">
                <input type="text" class="txt" id="textfield" >
                <input type="button" class="btn-file" value="<?/*=$lang_carmodels['浏览']*/?>"id="btn_img">
                <input type="file" name="cm_icon_path" class="file" size="28" id="btn_img" onchange="document.getElementById('textfield').value=this.value">
            </div>
        </div>-->
        <div>
            <label><?=$lang_carmodels['热门标示']?>:</label><br>
            <span class="radio-inline">
                <input type="radio" name="cm_hot_item_tag" value="3"> <?=$lang_carmodels['是']?>
            </span>
            <span class="radio-inline">
                <input type="radio" name="cm_hot_item_tag" value="1"> <?=$lang_carmodels['否']?>
            </span>
            <div style="margin-top: 50px;">
                <button type="submit" class="btn btn-default"><?=$lang_carmodels['提交']?></button>
                <a id="canc" class="btn btn-primary"><?=$lang_carmodels['取消']?></a>
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
            layer.msg("<?=$lang_carmodels['请填写数字类型的数据']?>",function(){

            });
            $(e).focus()
        }
    }
    function verify() {
        var bool = true;
        var cb = $("#carbrands_v").val();
        var tag= $('input:radio[name="cm_hot_item_tag"]:checked').val();
        var cm_name = $('input[name="cm_fullname"]').val();
        var cb_id = $('input[name="cb_id"]').val();

        if (!$.trim(cb)){
            layer.msg('<?=$lang_carmodels['汽车厂牌不能为空']?>' ,{icon:2});
            bool = false;
        }else if (!$.trim(tag)){
            layer.msg('<?=$lang_carmodels['热门标识不能为空']?>' ,{icon:2});
            bool = false;
        }else if ($.trim(cm_name)) {
            $.ajax({
                url: '<?=URL?>iscaradmin/?p=carmodels',
                type: 'post',
                async: false,
                data: {'cm_name': cm_name, 'a': 'verify_cm_name', 'cb_id' : cb_id},
                dataType: 'json',
                error: function () {
                    layer.msg('Error loading document');
                    bool = false;
                },
                success: function (res) {
                    if (res.data != 1) {
                        layer.msg('<?=$lang_carmodels['车系名称不能重复']?>', {icon: 2});
                        bool = false;
                    }
                }
            });
        }
        return bool;
    }
    function ajax_get(s,v,r,e) {
        var index = layer.load(2, {
            shade: [0.1,'#fff'] //0.1透明度的白色背景
        });
        $.ajax({
            url:'<?=URL?>iscaradmin/?srv='+s,
            type:'post',
            data:{'search':e, 'reg':r},//搜索
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
            title:"<?=$lang_carmodels['厂牌名称']?>",
            content: $('.car_brands'), //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
            area: ['450px', '300px'],
            btn: ['<?=$lang_carmodels['确定']?>', '<?=$lang_carmodels['取消']?>'],
            yes: function(index, layero){
                var cb = $('input[name="car_brands"]:checked').val();
                var cb_v = $('input[name="car_brands"]:checked').next('span').html();
                $("#carbrands_v").val(cb_v);
                $("#carbrands").val(cb);

                layer.close(index);
            },
            cancel: function(){
                //右上角关闭回调
            }
        });
        ajax_get('carbrand',v_brands,reg)
    });
    $("#brand_s").click(function(){
        var brand_v = myHtmlEncode($.trim($("#brand_v").val()));
        if(!$.trim(brand_v)){
            layer.msg('<?=$lang_carmodels['请输入搜索内容']?>');
        }else{
            ajax_get('carbrand',v_brands,reg,brand_v);
        }
    });
    //////////////////////////////////////////////////////////////////////////////////////////
</script>
</body>
<?php include ('footer.php');?>