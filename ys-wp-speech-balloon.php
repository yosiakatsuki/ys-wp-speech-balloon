<?php
/**
 * Plugin Name:     Ys WP Speech Balloon
 * Description:     ショートコードで吹き出し機能をつくる為のプラグイン
 * Author:          yosiakatsuki
 * Author URI:      https://yosiakatsuki.net
 * Text Domain:     ys-wp-speech-balloon
 * Domain Path:     /languages
 * Version:         0.0.1
 *
 * @package         WP_Speech_Balloon
 */

/**
 * 吹き出しショートコード
 *
 * @param array  $atts    atts.
 * @param string $content content.
 *
 * @return string
 */
function yswpsb_speech_balloon( $atts, $content = '' ) {
	$atts = shortcode_atts(
		array(
			'image' => '',
			'alt'   => '',
			'type'  => 'r',
			'name'  => '',
		),
		$atts
	);
	/**
	 * チェック
	 */
	if ( '' == $atts['image'] && '' == $content ) {
		return '';
	}
	if ( 'r' != $atts['type'] && 'l' != $atts['type'] ) {
		$atts['type'] = 'r';
	}
	/**
	 * 変数準備
	 */
	$image      = $atts['image'];
	$type_class = 'yswpsb-type-' . $atts['type'];
	$name       = $atts['name'];
	$alt        = $atts['alt'];
	$template   = apply_filters( 'yswpsb_speech_balloon_template', plugin_dir_path( __FILE__ ) . 'template/template.php' );
	$stylesheet = yswpsb_get_stylesheet_url();
	if ( $stylesheet ) {
		wp_enqueue_style( 'yswp-speech-balloon', $stylesheet );
	}
	ob_start();
	include $template;

	return ob_get_clean();
}

add_shortcode( 'yswp_speech_balloon', 'yswpsb_speech_balloon' );

/**
 * プラグインのCSSファイルURLを取得
 *
 * @return string
 */
function yswpsb_get_stylesheet_url() {
	$url = plugin_dir_url( __FILE__ ) . 'css/ys-wp-speech-balloon.css';

	return apply_filters( 'yswpsb_get_stylesheet_url', $url );
}