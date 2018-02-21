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
<style>
    .glyphicon-plus-sign{
        cursor: pointer;
    }
</style>
</head>
<body>
<!--参数名称-->
<div class="ct_term" style="display: none;" id="carterm">
    <div class="" style="padding: 10px;">
        <?php foreach($terms as $v):?>
        <label class="radio-inline"  style="margin-top: 20px;">
            <input type="radio" name="term"  value="<?=$v['term']?>"><span><?=$lang_carterms[$v['term']]?></span >
        </label>
        <?php endforeach;?>
    </div>
</div>
<!--参数名称 end-->
<div id="body">
    <form action="<?=URL?>iscaradmin/?p=carterms&a=add" method="post" enctype="multipart/form-data" onsubmit="return verify()" id="myform">
        <div>
            <div style="width: 200px">
                <label><?=$lang_carterms['参数名称']?>:<span id="term" class="glyphicon glyphicon-plus-sign"></span></label>
                <input type="text" class="inline form-control "  id="carterms_v"  disabled >
                <input type="hidden"  name="term" id="carterms" >
            </div>
            <div style="width: 200px">
                <label><?=$lang_carterms['值']?>:</label>
                <input type="text" class="inline form-control " name="value"   required>
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
                            <option value="<?=$v['keyword']?>" <?=g('reg')==$v['keyword']?'selected':''?>><?=$v['value']?></option>
                        <?php endforeach;?>
                    </select>
                </td>
            </tr>
        </table>
        <div style="margin-top: 50px;">
            <button type="submit" class="btn btn-default" ><?=$lang_carterms['提交']?></button>
            <a id="canc" class="btn btn-primary"><?=$lang_carterms['取消']?></a>
        </div>
    </form>
</div>
<script>
    $("#canc").click(function(){
        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
        parent.layer.close(index); //再执行关闭
    });

    var v_carterm = new Vue({
        el:'#carterm',
        data:{
            post:{}
        }
    });
    $("#term").click(function(){
        var region = <?=g('reg')?>;
        layer.open({
            type: 1,
            shade: 0,
            title:"<?=$lang_carterms['参数名称']?>",
            content: $('.ct_term'), //这里content是一个DOM，注意：最好该元素要存放在body最外层，否则可能被其它的相对元素所影响
            area: ['500px', '350px'],
            btn: ['<?=$lang_carterms['确定']?>', '<?=$lang_carterms['取消']?>'],
            yes: function(index, layero){
                var ct = $('input[name="term"]:checked').val();
                var ct_v = $('input[name="term"]:checked').next('span').html();
                $("#carterms_v").val(ct_v);
                $("#carterms").val(ct);

                layer.close(index);
            },
            cancel: function(){
                //右上角关闭回调
            }
        });
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
        var term = $("#term").val();
        var carterms_v = $("#carterms_v").val();
        var bool = true;
        var a = 1;
        if(!$.trim(carterms_v)){
            layer.msg('<?=$lang_carterms['参数名称不能为空']?>', {icon: 2});
            bool = false;
        }else if(a == 1){
            //询问框
            layer.confirm('<?=$lang_carterms['添加后该参数就无法删除']?>', {
                btn: ['<?=$lang_carterms['确定']?>','<?=$lang_carterms['取消']?>'] //按钮
                ,title:'<?=$lang_carterms['提示']?>'
            }, function(){
                document.getElementById("myform").submit();
            }, function(index){
                layer.close(index);
            });
            bool = false;
        }
        /*else if ($.trim(list)&& $.trim(term)) {
            $.ajax({
                url: '<?=URL?>iscaradmin/?p=carterms',
                type: 'post',
                async: false,
                data: {'list': list, 'term':term, 'a': 'verify'},
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
        }*/
        return bool;
    }
</script>
</body>
<?php include ('footer.php');?>