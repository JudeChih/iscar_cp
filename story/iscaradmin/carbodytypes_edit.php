<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/8
 * Time: 10:35
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
    <h2><?=$lang_carbodytypes['汽车车身编辑']?></h2>
    <form action="<?=URL?>iscaradmin/?p=carbodytypes&a=edit&id=<?=$post['cbt_id']?>" method="post" enctype="multipart/form-data" onsubmit="return verify()">
        <div>
            <div style="width: 500px">
                <label><?=$lang_carbodytypes['车种名称']?>:</label><br>
                <input type="text" class="inline form-control " name="cbt_fullname"  value="<?=$post['cbt_fullname']?>" required>
            </div>
            <div style="width: 300px">
                <label><?=$lang_carbodytypes['车种昵称']?>:</label>
                <input type="text" class="inline form-control " name="cbt_nickname"  value="<?=$post['cbt_nickname']?>" >
            </div>
        </div>
        <di>
            <div style="width: 200px">
                <label><?=$lang_carbodytypes['缩写']?>:</label><br>
                <input type="text" class="inline form-control " name="cbt_short_name" value="<?=$post['cbt_short_name']?>" >
            </div>
        </di>
        <table width="100%" style="line-height: 18px;margin-top: 10px;">
            <tr>
                <td><label><?=$lang_carbodytypes['区域选择']?>:</label></td>
            </tr>
            <tr>
                <td>
                    <select class="form-control" style="width: 150px" name="cbt_region" required>
                        <option value=""><?=$lang_carbodytypes['请选择']?></option>
                        <?php foreach($terms_re as $v):?>
                            <option value="<?=$v['keyword']?>" <?=$post['cbt_region']==$v['keyword']?'selected':''?>><?=$v['value']?></option>
                        <?php endforeach;?>
                    </select>
                </td>
            </tr>
        </table>
        <div class="mt">
            <label><?=$lang_carbodytypes['选择图标文件']?>:(<?=$lang_carbodytypes['图标大小建议']?>100*100)</label>
            <div class="file-box">
                <input type="text" class="txt" id="textfield" value="<?=$post['cbt_icon_path']?>" >
                <input type="button" class="btn-file" value="<?=$lang_carbodytypes['浏览']?>" id="btn_img">
                <input type="file" name="cbt_icon_path" class="file" size="28" id="btn_img" onchange="document.getElementById('textfield').value=this.value">
                <br><img style="max-width: 100px;max-height: 100px" src="./<?=$post['cbt_icon_path']?>" class="img-rounded">
            </div>
        </div>
        <div>
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
        var bool = true;

        return bool;
    }
</script>
</body>
<?php include ('footer.php');?>