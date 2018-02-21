/**
 * Created by Jason on 2016/12/9.
 */
function myHtmlEncode(txt) {
    txt = txt.replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, "&quot;")
        .replace(/'/g, "&#39;");
    return txt;
}
