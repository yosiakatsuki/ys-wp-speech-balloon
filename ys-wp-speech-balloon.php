<?php
/**
 * Plugin Name:     Ys WP Speech Balloon
 * Description:     ショートコードで吹き出し機能をつくる為のプラグイン
 * Author:          yosiakatsuki
 * Author URI:      https://yosiakatsuki.net
 * Text Domain:     ys-wp-speech-balloon
 * Domain Path:     /languages
 * Version:         0.0.3
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
			'class' => '',
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
	$image = esc_url_raw( $atts['image'] );
	$type  = esc_attr( $atts['type'] );
	$name  = esc_html( $atts['name'] );
	$alt   = esc_attr( $atts['alt'] );
	$class = esc_attr( $atts['class'] );
	/**
	 * HTML作成
	 */
	$html = yswpsb_get_speech_balloon_html( $image, $type, $name, $alt, $content, $class );
	/**
	 * スタイルシート読み込み
	 */
	$stylesheet = yswpsb_get_stylesheet_url();
	if ( $stylesheet ) {
		wp_enqueue_style( 'yswp-speech-balloon', $stylesheet );
	}

	return $html;
}

add_shortcode( 'yswp_speech_balloon', 'yswpsb_speech_balloon' );

/**
 * 吹き出しHTML作成
 *
 * @param string $image   画像URL.
 * @param string $type    "r" または "l".
 * @param string $name    画像下に表示する名前.
 * @param string $alt     画像のalt.(default:"")
 * @param string $content 吹き出しのテキスト.
 * @param string $class   追加するクラス.
 *
 * @return string
 */
function yswpsb_get_speech_balloon_html( $image, $type, $name, $alt, $content, $class = '' ) {
	/**
	 * 名前部分の作成
	 */
	if ( $name ) {
		$name = '<div class="yswpsb-name">' . $name . '</div>';
	}
	/**
	 * クラスの加工
	 */
	if ( ! empty( $class ) ) {
		$class = ' ' . $class;
	}
	/**
	 * 本文加工
	 */
	$content = yswpsb_get_content( $content );
	/**
	 * HTML作成
	 */
	$html = <<<EOD
<div class="yswpsb-container yswpsb-type-${type}${class}">
    <div class="yswpsb-icon">
        <figure class="yswpsb-image">
            <img src="${image}" alt="${alt}">
        </figure>
        ${name}
    </div>
    <div class="yswpsb-content">
        <div class="yswpsb-balloon">${content}</div>
    </div>
</div>
EOD;

	return apply_filters(
		'yswpsb_get_speech_balloon_html',
		$html,
		$image,
		$type,
		$name,
		$alt,
		$content,
		$class
	);
}


/**
 * プラグインのCSSファイルURLを取得
 *
 * @return string
 */
function yswpsb_get_stylesheet_url() {
	$url = plugin_dir_url( __FILE__ ) . 'css/ys-wp-speech-balloon.css';

	return apply_filters( 'yswpsb_get_stylesheet_url', $url );
}


/**
 * 吹き出し内のコメント加工
 *
 * @param string $content content.
 *
 * @return string
 */
function yswpsb_get_content( $content ) {
	$content = wp_filter_post_kses( $content );
	if ( has_filter( 'the_content', 'wpautop' ) ) {
		$content = wpautop( $content );
	} else {
		$content = nl2br( $content );
	}

	return apply_filters( 'yswpsb_get_content', $content );
}