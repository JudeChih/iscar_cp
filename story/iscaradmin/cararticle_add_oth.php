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
    $(document).ready(function() {

        var MaxInputs       = 10; //maximum input boxes allowed
        var InputsWrapper   = $("#InputsWrapper"); //Input boxes wrapper ID
        var AddButton       = $("#AddMoreFileBox"); //Add button ID

        var x = InputsWrapper.length; //initlal text box count
        var FieldCount=1; //to keep track of text box added
        $(AddButton).click(function (e)  //on add input button click
        {
            if(x <= MaxInputs) //max input box allowed
            {
                FieldCount++; //text box added increment
                //add input box
                $(InputsWrapper).append('<div class="removeele mt"><div class="input-group"><input type="text" class="inline form-control " id="search_art_key'+FieldCount+'" onkeyup="searchShow(\'search_art_key'+FieldCount+'\',\'suggestions_art'+FieldCount+'\',\'autoSuggestionsList_art'+FieldCount+'\',1,\''+FieldCount+'\')"  onblur="fill()" required><span class="input-group-btn"><button class="btn removeclass" type="button"><span class="glyphicon glyphicon-remove"></span></button></span></div><div class="form-control suggestionsBox" id="suggestions_art'+FieldCount+'" style="display:none;width: 500px;height: inherit;"><div class="suggestionList" id="autoSuggestionsList_art'+FieldCount+'"></div></div><input type="hidden" id="articleid'+FieldCount+'" class="a_articleid" name="article_id[]"></div>');
                x++; //text box increment
            }else{
                layer.msg('<?=$lang_cararticle['不能再增加啦']?>!');
            }
            return false;
        });
        $("body").on("click",".removeclass", function(e){ //user click on remove text
            if( x > 1 ) {
                $(this).parents('.removeele').remove(); //remove text box
                x--; //decrement textbox
            }
            return false;
        })

    });
    function searchShow(a,b,c,d,e) {

        if($("#"+a).val().length == 0) {
            $('#'+b).hide();
        } else {
            var searchText = myHtmlEncode($('#'+a).val());
            $('#'+b).show();
            $.ajax({
                url:'<?=URL?>iscaradmin/?p=cararticle',
                type:'post',
                dataType:'html',
                data:{"a":"ajax_search","searchContent":searchText,"type":d,"ele":e},
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
    <form action="<?=URL?>iscaradmin/?p=cararticle&a=add_oth" method="post" enctype="multipart/form-data" onsubmit="return verify()">
        <div style="width: 100%; overflow: auto;">
            <table width="500px" style="line-height: 18px;" class="fl">
                <tr>
                    <td><label><?=$lang_cararticle['汽车信息']?>:</label>(<?=$lang_cararticle['查询之前请先关闭浏览器表单自动提示功能']?>)</td>
                </tr>
                <tr>
                    <td>
                        <input type="text" class="inline form-control " autocomplete="off" id="search_ci_key" onkeyup="searchShow('search_ci_key','suggestions_ci','autoSuggestionsList_ci',2)" onblur="fill()"  required>
                        <div class="form-control suggestionsBox" id="suggestions_ci" style="display:none;width: 500px;height: inherit;">
                            <div class="suggestionList" id="autoSuggestionsList_ci"></div>
                        </div>
                        <input type="hidden" id="ciid"  name="ci_id">
                    </td>
                </tr>
            </table>
            <table width="500px" style="line-height: 18px;margin-left: 520px;" >
                <tr>
                    <td><label><?=$lang_cararticle['文章标题']?>:</label>(<?=$lang_cararticle['查询之前请先关闭浏览器表单自动提示功能']?>)</td>
                </tr>
                <tr>
                    <td>
                        <div id="InputsWrapper">
                            <div>
                                <div class="input-group">
                                    <input type="text" class="inline form-control " autocomplete="off" id="search_art_key1" onkeyup="searchShow('search_art_key1','suggestions_art1','autoSuggestionsList_art1',1,1)"  onblur="fill()" required>
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" id="AddMoreFileBox"><span class="glyphicon glyphicon-plus"></span></button>
                                </span>
                                </div>
                                <div class="form-control suggestionsBox" id="suggestions_art1" style="display:none;width: 500px;height: inherit;">
                                    <div class="suggestionList" id="autoSuggestionsList_art1"></div>
                                </div>
                                <input type="hidden" id="articleid1" class="a_articleid" name="article_id[]">
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
        <div>
            <button type="submit" class="btn btn-default"><?=$lang_cararticle['提交']?></button>
            <a id="canc" class="btn btn-primary"><?=$lang_cararticle['取消']?></a>
        </div>
    </form>
</div>
<script>
    function verify(){
        var a_val = $("#ciid").val();
        var art_val = $(".a_articleid").val();
        var bool = true;
        if(!$.trim(a_val)){
            layer.msg('<?=$lang_cararticle['汽车选择错误']?>', {icon:2});
            bool =false;
        }else if(!$.trim(art_val)){
            layer.msg('<?=$lang_cararticle['文章选择错误']?>', {icon:2});
            bool =false;
        }
        return bool;
    }
    $("#canc").click(function(){
        var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
        parent.layer.close(index); //再执行关闭
    });
</script>
</body>
<?php include ('footer.php');?>