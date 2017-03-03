<?php
/**
 * Single Product Thumbnails
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 */
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $post, $product, $woocommerce;
$attachment_ids = $product->get_gallery_attachment_ids(); ?>
<div class="thumbnails">
	<?php if ( $attachment_ids ) {
		?>
		<?php
		$loop = 0;
		$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 3 );
		foreach ( $attachment_ids as $attachment_id ) {
			$classes = array( 'zoom' );
			if ( $loop == 0 || $loop % $columns == 0 )
				$classes[] = 'first';
			if ( ( $loop + 1 ) % $columns == 0 )
				$classes[] = 'last';
			$image_link = wp_get_attachment_url( $attachment_id );
			if ( ! $image_link )
				continue;
			$image       = wp_get_attachment_image( $attachment_id, apply_filters( 'single_product_small_thumbnail_size', 'shop_thumbnail' ) );
			$image_class = esc_attr( implode( ' ', $classes ) );
			$image_title = esc_attr( get_the_title( $attachment_id ) );
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="%s" title="%s" data-rel="prettyPhoto[product-gallery]">%s</a>', $image_link, $image_class, $image_title, $image ), $attachment_id, $post->ID, $image_class );
			$loop++;
		}
		?>
		<?php
	}
	else
	{
		$image_title = esc_attr(get_the_title(get_post_thumbnail_id()));
		$image_link = wp_get_attachment_url(get_post_thumbnail_id());
		$image = get_the_post_thumbnail($post->ID);
		if (has_post_thumbnail()) {
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', sprintf( '<a href="%s" class="feature_image_thumbnail" title="%s" data-rel="prettyPhoto">%s</a>', $image_link,  $image_title, $image ), $post->ID );
		}
	} ?>
</div>