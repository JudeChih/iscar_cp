<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, user-scalable=no, minimal-ui">

    <title>isCar就是行-新車</title>

    <style>
        body {
            height: 100%;
            width: 100%;
            background-image: url(app/image/carbon_bg.jpg);
            background-repeat: no-repeat;
            background-position: center;
            background-attachment: fixed;
            background-size: cover;
        }
    </style>

</head>

<body>

</body>
<script src="js/config.js"></script>
<script src="http://tw-member.iscarmg.com/app/libs/js-cookie/src/js.cookie.js"></script>
<script>
    var strUrl = location.search;
    var getPara, ParaVal;
    var aryPara = [];

    if (strUrl.indexOf("?") != -1) {
        var getSearch = strUrl.split("?");
        getPara = getSearch[1].split("&");
        for (i = 0; i < getPara.length; i++) {
            ParaVal = getPara[i].split("=");
            aryPara.push(ParaVal[1]);
        }
        if (Cookies.get(_main) !== undefined) {
            //get
            var main = JSON.parse(Cookies.get(_main));
        } else {
            var main ={};
        }

        main.sat = aryPara[0];
        Cookies.set(_main,JSON.stringify(main), { domain: 'iscarmg.com' });
        window.location = "/"; //轉址路徑
        



        // var mainSg = JSON.parse(localStorage.getItem('main')) || {};
        // mainSg.sat = aryPara[0];
        // localStorage.setItem('main', JSON.stringify(mainSg));
        

    }else{
        window.location = "/";
    }
</script>

</html>