<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2016/12/13
 * Time: 13:58
 */
include ('header.php');
?>
<title><?=$lang_carinfo['汽车信息管理']?></title>
<style>
    .loading{
        margin-left: 280px;
        margin-top: 120px;
        display: none;
    }
</style>
<script>
    function importExcelData(filename){
        $.ajax({
            url:'<?=URL?>iscaradmin/?p=carinfo&a=importExcel',
            type:'get',
            dataType:'html',
            data:'filename='+filename,
            error: function(){
                $(".loading").hide();
                layer.msg('<?=$lang_carinfo['上传失败']?>', {icon: 5});
            },
            success: function(res){
                var res = JSON.parse(res);
                $(".loading").hide();
                if(res.msg==1) {
                    layer.msg('<?=$lang_carinfo['上传成功']?>', {icon: 6});
                    setTimeout("location.reload()",1000);
                }else if(res.msg==2){
                    layer.msg('<?=$lang_carinfo['部分数据被上传']?>', {icon: 5});
                }else if(res.msg==3){
                    layer.msg('<?=$lang_carinfo['上传失败,上传数据为空']?>', {icon: 5});
                }else if(res.msg==4){
                    layer.msg('<?=$lang_carinfo['上传失败']?>', {icon: 5});
                }
            }
        })
    }
</script>
</head>
<body>
<input id="inputfile" type="file" style="display:none">
<div class="input-group mt" style="margin-left: 40px;">
    <input type="text" class="form-control" id="fileCover">
    <span class="input-group-btn">
    <button class="btn btn-default" type="button" onclick="$('input[id=inputfile]').click();"><?=$lang_carinfo['选择文件']?></button>
    </span>
    <a class="btn btn-primary fl" id="upload"><?=$lang_carinfo['上传']?></a>
</div><!-- /input-group -->
<img src="img/loading.gif" class="loading"></img>
<script>
    $('input[id=inputfile]').change(function() {
        $('#fileCover').val($(this).val());
    });
    //响应文件添加成功事件
    $("#upload").click(function(){
        //创建FormData对象
        var data = new FormData();
        //为FormData对象添加数据
        $.each($('#inputfile')[0].files, function(i, file) {
            data.append('upload_file'+i, file);
        });
        $(".loading").show();   //显示加载图片
        //发送数据
        $.ajax({
            url:'<?=URL?>iscaradmin/?p=carinfo&a=ajax_import_excel',
            type:'POST',
            data:data,
            cache: false,
            contentType: false, //不可缺参数
            processData: false,     //不可缺参数
            success:function(res){
                var res = JSON.parse(res);
                if(res.msg==1) {
                    var filename = res.filename;
                    importExcelData(filename);
                }else{
                    $(".loading").hide();
                    layer.msg('<?=$lang_carinfo['上传失败']?>', {icon: 5});
                }
            },
            error:function(){
                $(".loading").hide();
                layer.msg('<?=$lang_carinfo['上传失败']?>', {icon: 5});
            }
    });
    });
</script>
</body>
<?php include ('footer.php');?>