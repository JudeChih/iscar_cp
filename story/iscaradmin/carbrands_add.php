<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/5
 * Time: 16:04
 */
include ('header.php');
?>
<title><?=$lang_carbrands['厂牌管理']?></title>
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

</style>
</head>
<body onload="list_order()">
<div id="body">
    <form action="<?=URL?>iscaradmin/?p=carbrands&a=add" method="post" enctype="multipart/form-data" onsubmit="return verify()">
        <div>
            <div style="width: 500px">
                <label><?=$lang_carbrands['厂牌名称']?>:</label>
                <input type="text" class="inline form-control " name="cb_fullname"  required>
            </div>
            <div style="width: 300px">
                <label><?=$lang_carbrands['厂牌昵称']?>:</label>
                <input type="text" class="inline form-control " name="cb_nickname"   >
            </div>
        </div>
        <div>
            <div style="width: 200px">
                <label><?=$lang_carbrands['缩写']?>:</label>
                <input type="text" class="inline form-control " name="cb_short_name"  >
            </div>
        </div>
        <table width="100%" style="line-height: 18px;margin-top: 10px;">
            <tr>
                <td><label><?=$lang_carbrands['区域选择']?>:</label></td>
            </tr>
            <tr>
                <td>
                    <select class="form-control" style="width: 150px" name="cb_region" required>
                        <option value=""><?=$lang_carbrands['请选择']?></option>
                        <?php foreach($terms_re as $v):?>
                            <option value="<?=$v['keyword']?>" <?=g('r')==$v['keyword']?'selected':''?> ><?=$v['value']?></option>
                        <?php endforeach;?>
                    </select>
                </td>
            </tr>
        </table>
        <div style="margin-top: 10px;">
            <label><?=$lang_carbrands['选择图标文件']?>:(<?=$lang_carbrands['图标大小建议']?>100*100)</label>
            <div class="file-box">
                <input type="text" class="txt" id="textfield" >
                <input type="button" class="btn-file" value="<?=$lang_carbrands['浏览']?>" id="btn_img">
                <input type="file" name="cb_icon_path" class="file" size="28" id="btn_img" onchange="document.getElementById('textfield').value=this.value">
            </div>
        </div>
        <div style="margin-top: 10px;">
            <label><?=$lang_carbrands['是否推荐到首页']?>:</label><br>
            <span class="radio-inline">
                <input type="radio" name="cb_recommend" value="1"> <?=$lang_carbrands['是']?>
            </span>
            <span class="radio-inline">
                <input type="radio" name="cb_recommend" value="2"> <?=$lang_carbrands['否']?>
            </span>
            <div style="width: 100px">
                <label><?=$lang_carbrands['序号']?>:</label>
                <select class="form-control" style="width: 100px" name="cb_list_order" id="list">
                    <option value=""><?=$lang_carbrands['请选择']?></option>
                    <option value=""></option>
                    <option v-for="item in post" :disabled="item.status==1" value="{{item.key}}">{{item.key}}</option>
                </select>
            </div>
            <div style="margin-top: 50px;">
                <button type="submit" class="btn btn-default"><?=$lang_carbrands['提交']?></button>
                <a id="canc" class="btn btn-primary"><?=$lang_carbrands['取消']?></a>
            </div>
        </div>
    </form>
</div>
<script>
    $("#canc").click(function(){
        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
        parent.layer.close(index); //再执行关闭
    });

    $("input[name='cb_recommend']").click(function(){
        var rec_val = $("input[name='cb_recommend']:checked").val();
        console.log(rec_val);
        if(rec_val == 2){
            $("#list").attr('disabled','disabled');
            $("#list").val('');
        }else if(rec_val == 1){
            $("#list").removeAttr('disabled');
        }
    });
    var v_list = new Vue({
        el:'#list',
        data:{
            post:{}
        }
    });

    function list_order(){
        var region = <?=g('r')?>;
        $.ajax({
            url: '<?=URL?>iscaradmin/?p=carbrands',
            type: 'post',
            data :{'a' : 'verify', 'region' : region},
            dataType: 'json',
            error: function(){
              layer.msg('Error loading document');
            },
            success: function(msg){
                var post = msg.data;
                v_list.$set('post', post);
            }
        });
    }
    function verify() {
        var bool = true;
        var recommend= $('input:radio[name="cb_recommend"]:checked').val();
        var cb_name= $('input[name="cb_fullname"]').val();
        var region = <?=g('r')?>;

        if (!$.trim(recommend)){
            layer.msg('<?=$lang_carbrands['是否推荐不能为空']?>' ,{icon:2});
            bool = false;
        }else if($.trim(cb_name)){
            $.ajax({
                url: '<?=URL?>iscaradmin/?p=carbrands',
                type: 'post',
                async: false,
                data: {'cb_name': cb_name, 'a': 'verify_cb_name', 'region':region},
                dataType: 'json',
                error: function () {
                    layer.msg('Error loading document');
                    bool = false;
                },
                success: function (res) {
                    if (res.data != 1) {
                        layer.msg('<?=$lang_carbrands['厂牌名称不能重复']?>', {icon: 2});
                        bool = false;
                    }
                }
            });
        }

        return bool;
    }
</script>
</body>
<?php include ('footer.php');?>
