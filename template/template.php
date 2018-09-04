<?php
/**
 * 吹き出し表示テンプレート
 *
 * @package WP_Speech_Balloon
 * @author  yosiakatsuki
 * @license GPL-2.0+
 */

?>
<div class="yswpsb-container <?php echo esc_attr( $type_class ); ?>">
    <div class="yswpsb-icon">
        <figure class="yswpsb-image">
            <img src="<?php echo esc_url_raw( $image ); ?>" alt="<?php echo esc_attr( $alt ); ?>">
        </figure>
		<?php if ( $name ) : ?>
            <div class="yswpsb-name"><?php echo esc_html( $name ); ?></div>
		<?php endif; ?>
    </div>
    <div class="yswpsb-content">
        <div class="yswpsb-balloon"><?php echo wpautop( wp_filter_post_kses( $content ) ); ?></div>
    </div>
</div>
