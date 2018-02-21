<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/8
 * Time: 10:30
 */
include ('header.php');
?>
<title><?=$lang_carbodytypes['车身管理']?></title>
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
<body>
<div id="body">
    <form action="<?=URL?>iscaradmin/?p=carbodytypes&a=add" method="post" enctype="multipart/form-data" onsubmit="return verify()">
        <div>
            <div style="width: 500px">
                <label><?=$lang_carbodytypes['车种名称']?>:</label>
                <input type="text" class="inline form-control " name="cbt_fullname"  required>
            </div>
            <div style="width: 300px">
                <label><?=$lang_carbodytypes['车种昵称']?>:</label>
                <input type="text" class="inline form-control " name="cbt_nickname"   >
            </div>
        </div>
        <div>
            <div style="width: 200px">
                <label><?=$lang_carbodytypes['缩写']?>:</label>
                <input type="text" class="inline form-control " name="cbt_short_name"  >
            </div>
<!--            <div style="width: 100px">-->
<!--                <label>--><?//=$lang_carbodytypes['序号']?><!--:</label>-->
<!--                <input type="text" id="list" class="inline form-control " name="cbt_list_order"  onblur="validate_num(this)" maxlength="8">-->
<!--            </div>-->
        </div>
        <table width="100%" style="line-height: 18px;margin-top: 10px;">
            <tr>
                <td><label><?=$lang_carbodytypes['区域选择']?>:</label></td>
            </tr>
            <tr>
                <td>
                    <select class="form-control" style="width: 150px" name="cbt_region" required>
                        <option value=""><?=$lang_carbodytypes['请选择']?></option>
                        <?php foreach($terms_re as $v):?>
                            <option value="<?=$v['keyword']?>" <?=g('r')==$v['keyword']?'selected':''?> ><?=$v['value']?></option>
                        <?php endforeach;?>
                    </select>
                </td>
            </tr>
        </table>
        <div class="mt">
            <label><?=$lang_carbodytypes['选择图标文件']?>:(<?=$lang_carbodytypes['图标大小建议']?>100*100)</label>
            <div class="file-box">
                <input type="text" class="txt" id="textfield" >
                <input type="button" class="btn-file" value="<?=$lang_carbodytypes['浏览']?>"id="btn_img">
                <input type="file" name="cbt_icon_path" class="file" size="28" id="btn_img" onchange="document.getElementById('textfield').value=this.value">
            </div>
        </div>
        <div>
            <!--<label><?/*=$lang_carbodytypes['热门标示']*/?>:</label><br>
            <span class="radio-inline">
                <input type="radio" name="cbt_hot_item_tag" value="3"> <?/*=$lang_carbodytypes['是']*/?>
            </span>
            <span class="radio-inline">
                <input type="radio" name="cbt_hot_item_tag" value="1"> <?/*=$lang_carbodytypes['否']*/?>
            </span>-->
            <div style="margin-top: 50px;">
                <button type="submit" class="btn btn-default"><?=$lang_carbodytypes['提交']?></button>
                <a id="canc" class="btn btn-primary"><?=$lang_carbodytypes['取消']?></a>
            </div>
        </div>
    </form>
</div>
<script>
    $("#canc").click(function(){
        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
        parent.layer.close(index); //再执行关闭
    });

    function validate_num(e){
        var s = $(e).val();
        if(isNaN(s)){
            layer.msg("<?=$lang_carbodytypes['请填写数字类型的数据']?>",function(){

            });
            $(e).focus()
        }
    }
    function verify() {
//        var list = $("#list").val();
        var bool = true;
        var tag= $('input:radio[name="cbt_hot_item_tag"]:checked').val();

//        if(isNaN(list)){
//            layer.msg("<?//=$lang_carbodytypes['请填写数字类型的数据']?>//",function(){
//
//            });
//            $("#list").focus();
//            bool = false;
//        }else
//        if (!$.trim(tag)){
//            layer.msg('<?//=$lang_carbodytypes['热门标识不能为空']?>//' ,{icon:2});
//            bool = false;
//        }else
        if ($.trim(list)) {
            $.ajax({
                url: '<?=URL?>iscaradmin/?p=carbodytypes',
                type: 'post',
                async: false,
                data: {'list': list, 'a': 'verify'},
                dataType: 'json',
                error: function () {
                    layer.msg('Error loading document');
                },
                success: function (res) {
                    if (res.data == 1) {
                        layer.msg('<?=$lang_carbodytypes['存在重复序号']?>', {icon: 2});
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