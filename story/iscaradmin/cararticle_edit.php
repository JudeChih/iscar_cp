<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/9
 * Time: 15:44
 */
include ('header.php');
?>
<title><?=$lang_cararticle['汽车文章关联管理']?></title>
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
</style>
<script type="text/javascript">
    function searchShow(a,b,c,d) {

        if($("#"+a).val().length == 0) {
            $('#'+b).hide();
        } else {
            var searchText = myHtmlEncode($('#'+a).val());
            $('#'+b).show();
            $.ajax({
                url:'<?=URL?>iscaradmin/?p=cararticle',
                type:'post',
                dataType:'html',
                data:{"a":"ajax_search","searchContent":searchText,"type":d},
                error: function(){
                    alert('Error loading document');
                },
                success: function(msg){
                    $("#"+c).html(msg);
                }
            })
        }
    }

    function fill(thisValue,id,a,b,c) {
        $('#'+a).val(thisValue);
        $('#'+b).val(id);
        $('#'+c).hide();
    }
</script>
</head>
<body>
<div id="body">
    <h2><?=$lang_cararticle['汽车文章编辑']?></h2>
    <form action="<?=URL?>iscaradmin/?p=cararticle&a=edit&id=<?=$post['id']?>" method="post" enctype="multipart/form-data">
        <table width="500px" style="line-height: 18px;" class="mt">
            <tr>
                <td><label><?=$lang_cararticle['文章标题']?>:</label></td>
            </tr>
            <tr>
                <td>
                    <input type="text" class="inline form-control " autocomplete="off" value="<?=$post['post_title']?>" id="search_art_key" onkeyup="searchShow('search_art_key','suggestions_art','autoSuggestionsList_art',1)" onblur="fill()"  required>
                    <div class="form-control suggestionsBox" id="suggestions_art" style="display:none;width: 500px;height: inherit;">
                        <div class="suggestionList" id="autoSuggestionsList_art"></div>
                    </div>
                    <input type="hidden" id="articleid" name="article_id" value="<?=$post['article_id']?>">
                </td>
            </tr>
            <tr>
                <td><label><?=$lang_cararticle['汽车信息']?>:</label></td>
            </tr>
            <tr>
                <td>
                    <input type="text" class="inline form-control " autocomplete="off" value="<?=$post['car_title']?>" id="search_ci_key" onkeyup="searchShow('search_ci_key','suggestions_ci','autoSuggestionsList_ci',2)"  onblur="fill()" required>
                    <div class="form-control suggestionsBox" id="suggestions_ci" style="display:none;width: 500px;height: inherit;">
                        <div class="suggestionList" id="autoSuggestionsList_ci"></div>
                    </div>
                    <input type="hidden" id="ciid" name="ci_id" value="<?=$post['ci_id']?>">
                </td>
            </tr>
        </table>
        <div style="margin-top: 30px;">
            <button type="submit" class="btn btn-default"><?=$lang_cararticle['提交']?></button>
            <a id="canc" class="btn btn-primary"><?=$lang_cararticle['取消']?></a>
        </div>
    </form>
</div>
<script>
    $("#canc").click(function(){
        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
        parent.layer.close(index); //再执行关闭
    });
</script>
</body>
<?php include ('footer.php');?>