<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/8
 * Time: 17:22
 */
include ('header.php');
?>
<title><?=$lang_carterms['预设参数设置']?></title>
</head>
<body>
<div id="body">
    <h2><?=$lang_carterms['预设参数编辑']?></h2>
    <form action="<?=URL?>iscaradmin/?p=carterms&a=edit&id=<?=$post['id']?>" method="post" enctype="multipart/form-data">
        <div>
            <div style="width: 200px">
                <label><?=$lang_carterms['参数名称']?>:</label>
                <input type="text" class="inline form-control " id="term" name="term" value="<?=$lang_carterms[$post['term']]?>" required disabled="disabled">
            </div>
            <div style="width: 200px">
                <label>key:</label>
                <input type="text" class="inline form-control " id="list" name="keyword" value="<?=$post['keyword']?>" onblur="validate_num(this)" readonly>
            </div>
            <div style="width: 200px">
                <label><?=$lang_carterms['值']?>:</label>
                <input type="text" class="inline form-control " name="value" value="<?=$post['value']?>"  required>
            </div>
        </div>
        <table width="100%" style="line-height: 18px;margin-top: 10px;">
            <tr>
                <td><label><?=$lang_carterms['区域选择']?>:</label></td>
            </tr>
            <tr>
                <td>
                    <select class="form-control" style="width: 150px" name="ct_region" required>
                        <option value=""><?=$lang_carterms['请选择']?></option>
                        <?php foreach($terms_re as $v):?>
                            <option value="<?=$v['keyword']?>" <?=$post['ct_region']==$v['keyword']?'selected':''?>><?=$v['value']?></option>
                        <?php endforeach;?>
                    </select>
                </td>
            </tr>
        </table>
        <div style="margin-top: 50px;">
            <button type="submit" class="btn btn-default"><?=$lang_carterms['提交']?></button>
            <a id="canc" class="btn btn-primary"><?=$lang_carterms['取消']?></a>
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
            layer.msg("<?=$lang_carterms['请填写数字类型的数据']?>",function(){

            });
            $(e).focus()
        }
    }
    function verify() {
        var list = $("#list").val();
        var term = $("#term").val();
        var bool = true;

        if(isNaN(list)){
            layer.msg("<?=$lang_carterms['请填写数字类型的数据']?>",function(){

            });
            $("#list").focus();
            bool = false;
        }else if ($.trim(list)&& $.trim(term)) {
            $.ajax({
                url: '<?=URL?>iscaradmin/?p=carterms',
                type: 'post',
                async: false,
                data: {'list': list, 'term':term, 'a': 'verify', 'e':<?=$post['id']?>},
                dataType: 'json',
                error: function () {
                    layer.msg('Error loading document');
                },
                success: function (res) {
                    if (res.data == 1) {
                        layer.msg('<?=$lang_carterms['存在重复']?>', {icon: 2});
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