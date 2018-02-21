var _region = 'tw'; //地區名稱
if (window.location.href.match('tw-') || window.location.href.match('tw.')) {
    _region = 'tw';
} else if (window.location.href.match('cn-') || window.location.href.match('cn.')) {
    _region = 'cn';
} else if (window.location.href.match('sh-') || window.location.href.match('sh.')) {
    _region = 'sh';
}
var server_type = 'alpha-'; //主機名稱
var _main = server_type+'main';