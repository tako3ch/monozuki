<?php
/**
 * customizer_
 *
 * @package monozuki
 */

// design
function mnzk_design_register($wp_customize) {
	$wp_customize->add_section( 'mnzk_design_sec', array(
		'title' =>'[monozuki]デザイン設定',
		'priority' => 0,
	));
	// color_change
	$wp_customize->add_setting('mnzk_chgcolor_txt', array(
		'type' => 'option',
		'default'   => 'default',
	));
	$wp_customize->add_control( 'mnzk_chgcolor_txt', array(
		'settings' => 'mnzk_chgcolor_txt',
		'label' => '色変更',
		'section' => 'mnzk_design_sec',
		'type'       => 'radio',
		'choices'    => array(
			'default' => 'デフォルト',
			'yami' => 'yami',
		)
	));
	// color_change
	$wp_customize->add_setting('mnzk_logosize', array(
		'type' => 'option',
		'default'   => 'default',
	));
	$wp_customize->add_control( 'mnzk_logosize', array(
		'settings' => 'mnzk_logosize',
		'label' => 'ロゴサイズ変更(max400px)',
		'section' => 'mnzk_design_sec',
		'type'       => 'radio',
		'choices'    => array(
			'small' => 'Small',
			'default' => 'Normal',
			'big' => 'Big',
		)
	));
}
add_action( 'customize_register', 'mnzk_design_register' );

define('HKS_LOGO_URL', 'hks_logo_url');
function mnzk_tag_register($wp_customize) {
	// Analyticsとかタグとか追加する用のやつ
	$wp_customize->add_section( 'mnzk_tag_name', array(
		'title' =>'[monozuki]OGP・タグ設定',
		'priority' => 10,
	));
	//
	$wp_customize->add_setting('mnzk_tag_txt', array(
		'type' => 'option',
	));
	// gaタグ
	$wp_customize->add_control( 'mnzk_tag_txt', array(
		'settings' => 'mnzk_tag_txt',
		'label' => '■ 解析タグなどはここに書いてください。',
		'section' => 'mnzk_tag_name',
		'type' => 'textarea',
		'description' => 'headの閉じタグ前(</head>前)に吐き出されます'
	));
	// OGP_img
	$wp_customize->add_setting(HKS_LOGO_URL, array(
		'type' => 'option',
	));
	$wp_customize->add_control(
		new WP_Customize_Image_Control(
			$wp_customize,
			HKS_LOGO_URL,
			array(
				'settings' => HKS_LOGO_URL,
				'label' => '■ 構造化データ用ロゴ画像',
				'section' => 'mnzk_tag_name',
				'description' => 'エラーになるので、何かしらいれましょう。',
			)
		)
	);
}
add_action( 'customize_register', 'mnzk_tag_register' );

// ロゴ画像呼び出し
function get_logo_image_url(){
	return esc_url( get_theme_mod( HKS_LOGO_URL ) );
}

// ad
function mnzk_addisp_register($wp_customize) {
	$wp_customize->add_section( 'mnzk_addisp_sec', array(
		'title' =>'[monozuki]広告表示設定',
		'priority' => 10,
	));

	$wp_customize->add_setting('mnzk_addisp_head', array(
		'type' => 'option'
	));
	$wp_customize->add_control( 'mnzk_addisp_head', array(
		'settings' => 'mnzk_addisp_head',
		'label' => '■ 【PC】広告タグ / 記事タイトル下',
		'section' => 'mnzk_addisp_sec',
		'type' => 'textarea',
		'description' => '(PC)記事のタイトル下に掲載されます。'
	));
	$wp_customize->add_setting('mnzk_addisp_snstop', array(
		'type' => 'option'
	));
	$wp_customize->add_control( 'mnzk_addisp_snstop', array(
		'settings' => 'mnzk_addisp_snstop',
		'label' => '■ 【PC】広告タグ / シェアボタン上',
		'section' => 'mnzk_addisp_sec',
		'type' => 'textarea',
		'description' => '(PC)記事のシェアボタン上に掲載されます。'
	));
	$wp_customize->add_setting('mnzk_addisp_toc', array(
		'type' => 'option'
	));
	$wp_customize->add_control( 'mnzk_addisp_toc', array(
		'settings' => 'mnzk_addisp_toc',
		'label' => '■ 【PC】広告タグ / 目次上',
		'section' => 'mnzk_addisp_sec',
		'type' => 'textarea',
		'description' => '(PC)記事の目次の上に掲載されます。(目次が有効化されていないとでないです)'
	));
	//
	$wp_customize->add_setting('mnzk_addisp_head_sp', array(
		'type' => 'option'
	));
	$wp_customize->add_control( 'mnzk_addisp_head_sp', array(
		'settings' => 'mnzk_addisp_head_sp',
		'label' => '■ 【SP】広告タグ / 記事タイトル下',
		'section' => 'mnzk_addisp_sec',
		'type' => 'textarea',
		'description' => '(SP)記事のタイトル下に掲載されます。'
	));
	$wp_customize->add_setting('mnzk_addisp_snstop_sp', array(
		'type' => 'option'
	));
	$wp_customize->add_control( 'mnzk_addisp_snstop_sp', array(
		'settings' => 'mnzk_addisp_snstop_sp',
		'label' => '■ 【SP】広告タグ / シェアボタン上',
		'section' => 'mnzk_addisp_sec',
		'type' => 'textarea',
		'description' => '(SP)記事のシェアボタン上に掲載されます。'
	));
	$wp_customize->add_setting('mnzk_addisp_toc_sp', array(
		'type' => 'option'
	));
	$wp_customize->add_control( 'mnzk_addisp_toc_sp', array(
		'settings' => 'mnzk_addisp_toc_sp',
		'label' => '■ 【SP】広告タグ / 目次上',
		'section' => 'mnzk_addisp_sec',
		'type' => 'textarea',
		'description' => '(SP)記事の目次の上に掲載されます。(目次が有効化されていないとでないです)'
	));
	$wp_customize->add_setting('mnzk_addisp_related', array(
		'type' => 'option'
	));
	$wp_customize->add_control( 'mnzk_addisp_related', array(
		'settings' => 'mnzk_addisp_related',
		'label' => '■ 【共通】広告タグ / 関連記事コンテンツ用',
		'section' => 'mnzk_addisp_sec',
		'type' => 'textarea',
		'description' => '記事末、関連記事箇所に掲載されます。'
	));

}
add_action( 'customize_register', 'mnzk_addisp_register' );

//
function mnzk_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'mnzk_customize_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'mnzk_customize_blogdescription',
		) );
	}
}
add_action( 'customize_register', 'mnzk_customize_register' );
function mnzk_customize_blogname() {
	bloginfo( 'name' );
}
function mnzk_customize_blogdescription() {
	bloginfo( 'description' );
}