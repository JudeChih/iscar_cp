/**
 * 获取querystring
 * @param url
 * @returns {{}}
 */
function getQueryString(url) {
    if (url) {
        url = url.substr(url.indexOf("?") + 1); //取问号后开始的内容
    }
    var result = {}, //创建一个对象，用于存name，和value
        queryString = url || location.search.substring(1), //没有url返回当前从问号开始的查询部分
        regexp = /([^&=]+)=([^&]*)/g, //获取参数的正则
        matched;
    while (matched = regexp.exec(queryString)) { //exec()正则表达式的匹配
        result[decodeURIComponent(matched[1])] = decodeURIComponent(matched[2]); //使用 decodeURIComponent()对编码后的URI进行解码
    }
    return result;
}