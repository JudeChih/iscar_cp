<?php
/**
 * Created by PhpStorm.
 * User: Jason
 * Date: 2016/12/9
 * Time: 15:44
 */
function d($post){
    global $pdo;
    $post['car_title'] = $post['cb_fullname'].'-'.$post['cm_fullname'].'-'.$post['cs_fullname'];
    $res = $pdo->getRow('SELECT name FROM jw_term_relationships jtr LEFT JOIN jw_terms jt ON jtr.term_taxonomy_id=jt.term_id WHERE jtr.object_id=?', array($post['jp_id']));
    $post['post_title'] = $post['post_title'].'--'.$res['name'];


    return $post;
}
switch ($_action) {
    case 'add':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {//新增文章关联汽车
            $ci_id = !empty($_POST['ci_id']) ? $_POST['ci_id'] : array();
            for($i=0; $i<count($ci_id); $i++){
                $values = gs(array('article_id'));
                $values['last_update_date'] = date('Y-m-d H:i:s', time());
                $values['ci_id'] = $ci_id[$i];
                //当数据库中存在该条数据时不再增加
                $res = $pdo->getRow("SELECT count(*) as count FROM cararticle WHERE ci_id=? AND article_id=?", array($values['ci_id'],$values['article_id']));
                if($res['count']!=1) {
                    $pdo->insert('cararticle', $values);
                }
            }
            echo '<script>var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                              parent.layer.close(index); //再执行关闭
                              parent.location.reload();</script>';

            exit();
        }
        break;
    case 'add_oth':
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {//新增汽车关联文章
            $article_id = !empty($_POST['article_id']) ? $_POST['article_id'] : array();
            for($i=0; $i<count($article_id); $i++){
                $values = gs(array('ci_id'));
                $values['last_update_date'] = date('Y-m-d H:i:s', time());
                $values['article_id'] = $article_id[$i];
                //当数据库中存在该条数据时不再增加
                $res = $pdo->getRow("SELECT count(*) as count FROM cararticle WHERE ci_id=? AND article_id=?", array($values['ci_id'],$values['article_id']));
                if($res['count']!=1) {
                    $pdo->insert('cararticle', $values);
                }
            }
            echo '<script>var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                              parent.layer.close(index); //再执行关闭
                              parent.location.reload();</script>';

            exit();
        }
        break;
    case 'edit':
        if(g('id')){
            $_id = g('id');
            $post = $pdo->getRow("SELECT jp.post_title,ca.*,cs.cs_fullname,cm.cm_fullname,cb.cb_fullname
                                FROM ((`cararticle` ca LEFT JOIN (((`carinfo` ci
                                      LEFT JOIN carstyles cs ON cs.cs_id=ci.ci_model_style)
                                      LEFT JOIN carmodels cm on cm.cm_id=ci.ci_brand_model)
                                      LEFT JOIN carbrands cb on cb.cb_id=ci.ci_car_brand) ON ci.ci_id=ca.ci_id)
                                LEFT JOIN jw_posts jp on jp.id=ca.article_id)
                                WHERE ca.id=? ORDER BY ca.last_update_date DESC",array($_id));
            $post['car_title'] = $post['cb_fullname'].'-'.$post['cm_fullname'].'-'.$post['cs_fullname'];
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $values = gs(array('article_id', 'ci_id'));
                $values['last_update_date'] = date('Y-m-d H:i:s', time());
                //当数据库中存在该条数据时不再增加
                $res = $pdo->getRow("SELECT count(*) as count FROM cararticle WHERE ci_id=? AND article_id=?", array($values['ci_id'],$values['article_id']));
                if($res['count']!=1) {
                    $pdo->update('cararticle', $values, array('id' => $_id));
                }
                echo '<script>var index = parent.layer.getFrameIndex(window.name); //先得到当前iframe层的索引
                              parent.layer.close(index); //再执行关闭
                              parent.location.reload();</script>';

                exit();
            }
        }

        break;
    case 'del':
        if(g('id')) {
            $res = $pdo->delete('cararticle', array('id' => g('id')));
            if($res){
                header('Location:'. $_SERVER[HTTP_REFERER]);
                exit();
            }
        }
        exit;
    case 'detail':

        break;
    case 'ajax_search':
        function ajax_d($post){
            global $pdo;
            $res = $pdo->getRow('SELECT name FROM jw_term_relationships jtr LEFT JOIN jw_terms jt ON jtr.term_taxonomy_id=jt.term_id WHERE jtr.object_id=?', array($post['id']));
            $post['post_title'] = $post['post_title'].'--'.$res['name'];
            $post['post_title'] = str_replace("'",'"',$post['post_title']);
            $post['post_title'] = htmlspecialchars($post['post_title'], ENT_QUOTES );

            return $post;
        }
        if(g('searchContent')) {
            $keyword = g('searchContent');
            if(g('type')==1) {//文章信息
                $message = $pdo->query("SELECT id,post_title
                                FROM jw_posts
                                WHERE post_status='publish'
                                AND post_title like '%$keyword%'
                                ORDER BY post_date DESC LIMIT 20");
                $message = array_map('ajax_d', $message);
                if ($message) {
                    $line == 0;
                    $num = count($message);
                    foreach ($message as $m) {
                        $line++;
                        if(g('ele')){
                            $ele = g('ele');
                            echo '<li onClick="fill(\'' . $m['post_title'] . '\', ' . $m['id'] . ',\'search_art_key'.$ele.'\', \'articleid'.$ele.'\', \'suggestions_art'.$ele.'\');">' . $m['post_title'] . '</li>';
                        }else {
                            echo '<li onClick="fill(\'' . $m['post_title'] . '\', ' . $m['id'] . ',\'search_art_key\', \'articleid\', \'suggestions_art\');">' . $m['post_title'] . '</li>';
                        }
                        if ($line < $num) {
                            echo "<hr />";
                        }
                    }
                }
            }elseif(g('type')==2){//汽车信息
                $message = $pdo->query("SELECT ci.ci_id,cs.cs_fullname,cm.cm_fullname,cb.cb_fullname
                                        FROM (((`carinfo` ci
                                              LEFT JOIN carstyles cs ON cs.cs_id=ci.ci_model_style)
                                              LEFT JOIN carmodels cm on cm.cm_id=ci.ci_brand_model)
                                              LEFT JOIN carbrands cb on cb.cb_id=ci.ci_car_brand)
                                        WHERE (cs_fullname LIKE '%$keyword%' OR cm_fullname LIKE '%$keyword%' OR cb_fullname LIKE '%$keyword%')
                                        AND ci_published>1
                                        ORDER BY ci.ci_create_date DESC LIMIT 20");
                $message = array_map('d', $message);
                if ($message) {
                    $line == 0;
                    $num = count($message);
                    foreach ($message as $m) {
                        $line++;
                        if(g('ele')) {//不同id传过来的参数
                            $ele=g('ele');
                            echo '<li onClick="fill(\'' . $m['car_title'] . '\', ' . $m['ci_id'] . ',\'search_ci_key'.$ele.'\', \'ciid'.$ele.'\', \'suggestions_ci'.$ele.'\');">' . $m['car_title'] . '</li>';
                        }else{
                            echo '<li onClick="fill(\'' . $m['car_title'] . '\', ' . $m['ci_id'] . ',\'search_ci_key\', \'ciid\', \'suggestions_ci\');">' . $m['car_title'] . '</li>';
                        }
                            if ($line < $num) {
                            echo "<hr />";
                        }
                    }
                }
            }
        }
        exit();
    default:
        if(g('k')){
            $keyword = g('k');
            $str_sql = "SELECT jp.post_title,jp.id as jp_id,ca.*,cs.cs_fullname,cm.cm_fullname,cb.cb_fullname
                        FROM ((`cararticle` ca LEFT JOIN (((`carinfo` ci
                              LEFT JOIN carstyles cs ON cs.cs_id=ci.ci_model_style)
                              LEFT JOIN carmodels cm on cm.cm_id=ci.ci_brand_model)
                              LEFT JOIN carbrands cb on cb.cb_id=ci.ci_car_brand) ON ci.ci_id=ca.ci_id)
                        LEFT JOIN jw_posts jp on jp.id=ca.article_id)
                        WHERE (post_title LIKE '%$keyword%' OR cs_fullname LIKE '%$keyword%' OR cm_fullname LIKE '%$keyword%' OR cb_fullname LIKE '%$keyword%')
                        ORDER BY ca.last_update_date DESC";
        }else {
            $keyword = '';
            $str_sql = "SELECT jp.post_title,jp.id as jp_id,ca.*,cs.cs_fullname,cm.cm_fullname,cb.cb_fullname
                        FROM ((`cararticle` ca LEFT JOIN (((`carinfo` ci
                              LEFT JOIN carstyles cs ON cs.cs_id=ci.ci_model_style)
                              LEFT JOIN carmodels cm on cm.cm_id=ci.ci_brand_model)
                              LEFT JOIN carbrands cb on cb.cb_id=ci.ci_car_brand) ON ci.ci_id=ca.ci_id)
                        LEFT JOIN jw_posts jp on jp.id=ca.article_id)
                        ORDER BY ca.last_update_date DESC";
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