<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/7
 * Time: 15:17
 */
function d($post){
    $reg = '';
    $post['log_type'] = getTerms("log类型", $reg, $post['log_type']);

    return $post;
}
switch ($_action) {
    case 'add':

        break;
    case 'edit':

        break;
    case 'del':

        exit;
    case 'detail':

        break;
    default:
        $time =date('Y-m-d', time());
        $reg = g('r');
        if(!g('_page')){
            $thispage=1;
        }else{
            $thispage=g('_page');
        }
        if(g('k')){
            $keyword = g('k');
            $str_sql = "SELECT mylogs.uid,mylogs.create_date,mylogs.log_type,mylogs.remark
                    FROM mylogs
                    WHERE (mylogs.uid LIKE '%$keyword%' OR date(mylogs.create_date)='$keyword')
                    ORDER BY mylogs.create_date DESC";

            $page='<li><a href="?p=mylogs&r='.$reg.'&k='.$keyword.'&_page=1">'.$lang_mylogs['首页'].'</a></li>';
            $page.='<li><a href="?p=mylogs&r='.$reg.'&k='.$keyword.'&_page='.($thispage+1).'">'.$lang_mylogs['下一页'].'</a></li>';
        }else {
            $str_sql = "SELECT mylogs.uid,mylogs.create_date,mylogs.log_type,mylogs.remark
                    FROM mylogs
                    ORDER BY mylogs.create_date DESC";

            $page='<li><a href="?p=mylogs&r='.$reg.'&_page=1">'.$lang_mylogs['首页'].'</a></li>';
            $page.='<li><a href="?p=mylogs&r='.$reg.'&_page='.($thispage+1).'">'.$lang_mylogs['下一页'].'</a></li>';
        }

        $limit = PAGES*($thispage-1); //本页记录数起始位置
        $str = $str_sql.' limit '.$limit.','.PAGES;
        $result=$pdo->query($str);
        $result = array_map('d', $result);
        $terms_re = getTerms("区域");
        break;
}