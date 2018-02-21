<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/7
 * Time: 15:58
 */
function d($post){
    $post['object'] = $post['cb_fullname'].'-'.$post['cm_fullname'].'-'.$post['cs_fullname'].'-'.$post['oid'];

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
        if(g('k')){
            $keyword = g('k');
            $str_sql = "SELECT jw_users.user_login,myfavorite.*,cs.cs_fullname,cm.cm_fullname,cb.cb_fullname
                        FROM (`myfavorite` LEFT JOIN (((`carinfo` ci
                              LEFT JOIN carstyles cs ON cs.cs_id=ci.ci_model_style)
                              LEFT JOIN carmodels cm on cm.cm_id=ci.ci_brand_model)
                              LEFT JOIN carbrands cb on cb.cb_id=ci.ci_car_brand) on ci.ci_id=myfavorite.oid)
                        LEFT JOIN jw_users on jw_users.id=myfavorite.uid
                        WHERE (jw_users.user_login LIKE '%$keyword%')
                        AND myfavorite.status=1
                        ORDER BY myfavorite.create_date DESC";
        }else {
            $keyword = '';
            $str_sql = "SELECT jw_users.user_login,myfavorite.*,cs.cs_fullname,cm.cm_fullname,cb.cb_fullname
                        FROM (`myfavorite` LEFT JOIN (((`carinfo` ci
                              LEFT JOIN carstyles cs ON cs.cs_id=ci.ci_model_style)
                              LEFT JOIN carmodels cm on cm.cm_id=ci.ci_brand_model)
                              LEFT JOIN carbrands cb on cb.cb_id=ci.ci_car_brand) on ci.ci_id=myfavorite.oid)
                        LEFT JOIN jw_users on jw_users.id=myfavorite.uid
                        WHERE myfavorite.status=1
                        ORDER BY myfavorite.create_date DESC";
        }
        $post = $pdo->query($str_sql);
        $total = count($post);
        if(!g('_page')){
            $thispage=1;
        }else{
            $thispage=g('_page');
        }
        $limit = PAGES*($thispage-1); //本页记录数起始位置
        $str = $str_sql.' limit '.$limit.','.PAGES;
        $result=$pdo->query($str);
        $result = array_map('d', $result);
        $terms_re = getTerms("区域");
        break;
}