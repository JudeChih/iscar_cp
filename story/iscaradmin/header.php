<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- 新 Bootstrap 核心 CSS 文件 -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./css/mystyle.css">

    <!-- 可选的Bootstrap主题文件（一般不用引入） -->
<!--    <link rel="stylesheet" href="./css/bootstrap-theme.min.css">-->

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!--    自定义css文件-->
    <link href="css/iscar.css" rel="stylesheet">
    <!-- jQuery文件。务必在bootstrap.min.js 之前引入 -->
    <script src="./js/jquery.min.js"></script>

    <!-- 最新的 Bootstrap 核心 JavaScript 文件 -->
    <script src="./js/bootstrap.min.js"></script>
    <script src="./js/layer/layer.js"></script>
    <script src="./lib/plupload/plupload.full.min.js"></script>
    <script src="./js/vue.min.js"></script>
    <script src="./js/iscar.js"></script>
    <script language="javascript">
        function check_search(myform) {
            if(myform.k.value == "") {
                alert("请先输入关键字，再进行搜索！");
                myform.k.focus();
                return false;
            }
            myform.submit();
        }
    </script>
