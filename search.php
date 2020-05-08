<?php
/**
 * searchhh
 *
 *
 * @package monozuki
 */

get_header();
global $wp_query;
$total_results = $wp_query->found_posts;
$search_query = get_search_query();
?>
    <div class="contents-area">
        <main id="main" class="site-main">
            <div class="entry-page">
                <div class="entry-header">
                    <h1><?php if (isset($_GET['s']) && empty($_GET['s'])) {
                            echo '検索キーワード未入力';
                        } else {
                            echo '「' . $search_query . '」の検索結果：' . $total_results . '件';
                        }
                        ?></h1>
                </div><!-- ./entry-header -->
                <?php
                if ($total_results > 0) {
                    get_template_part('tpl/newslist', 'newslist');
                } else {
                    echo '見つかりませんでした。<br>他のキーワードでの検索をお試しください。';
                }
                ?>
            </div>
        </main><!-- #main -->
        <?php if ($side_chk != false) {
            get_sidebar();
        } ?>
    </div><!-- #wrapper -->
    <div class="breadcrumb">
        <ul class="breadcrumb-list">
            <li class="breadcrumb-item"><a href="<?php echo home_url('/'); ?>">home</a></li>
            <li class="breadcrumb-item"><?=$search_query;?>の検索結果</li>
        </ul>
    </div><!-- /.breadcrumb -->


<?php
get_footer();
