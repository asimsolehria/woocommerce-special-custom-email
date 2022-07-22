<style>

	

</style>

<?php
/**
 * Email Order Items
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-items.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

$text_align  = is_rtl() ? 'right' : 'left';
$margin_side = is_rtl() ? 'left' : 'right';

foreach ( $items as $item_id => $item ) :
	$product       = $item->get_product();
	$sku           = '';
	$purchase_note = '';
	$image         = '';

	if ( ! apply_filters( 'woocommerce_order_item_visible', true, $item ) ) {
		continue;
	}

	if ( is_object( $product ) ) {
		$sku           = $product->get_sku();
		$purchase_note = $product->get_purchase_note();
		$image         = $product->get_image( $image_size );
	}

	?>



		

<tbody>
	<tr>
		<td style="color:#969696;font-size:12px;font-weight:bold"
			width="10%"
			align="left">
			<?php if ( $show_image ) {
				echo wp_kses_post( apply_filters( 'woocommerce_order_item_thumbnail', $image, $item ) );
			} ?>
		</td>
		
		<td width="30%"
			align="left">
			<table
				width="100%"
				cellspacing="0"
				cellpadding="0"
				border="0">
				<tbody>
					<tr>
						<td style="font-weight:bold;width:100%"
							align="left">
							<?php echo $item->get_name(); ?> <?php 
				if($product->get_sku()) {
					echo "- ";
					echo  $product->get_sku();
				}
			?><br>
						</td>
					</tr>
				</tbody>
			</table>
		</td>
		</td>
			<td style="color:#969696;font-size:12px;font-weight:bold"
				width="25%"
				align="center">
				<table
					width="100%"
					cellspacing="0"
					cellpadding="0"
					border="0">
					<tbody>
						<tr>
							<td style="font-size:12px;font-weight:bold"
								align="center">
								<img src="https://hive.gg/wp-content/uploads/2020/09/Primary_Logo_Without_text.png"
									width="36">
							</td>
						</tr>
					</tbody>
				</table>
			</td>
		<td style="font-size:12px;width:112"
			width="13%"
			align="center">
			<table>
				<tbody>
					<tr>
						<td style="line-height:14px;font-weight:bold;color:#ffffff;width:18px;min-height:18px;border-radius:50%"
							width="18"
							height="18"
							bgcolor="#c3c6c8"
							align="center">
							<?php echo $item->get_quantity(); ?>
						</td>
					</tr>
				</tbody>
			</table>
		</td>
		<td style="font-size:12px;width:20"
			width="8%"
			align="center">
		</td>
		<td style="font-size:12px"
			width="14%"
			align="right">
			<?php echo $item->get_total(); ?> USD
		</td>
	</tr>
</tbody>
	

		
	

	<?php

	if ( $show_purchase_note && $purchase_note ) {
		?>
		<tr>
			<td colspan="3" style="text-align:<?php echo esc_attr( $text_align ); ?>; vertical-align:middle; font-family: 'Pridi', serif;">
				<?php
				echo wp_kses_post( wpautop( do_shortcode( $purchase_note ) ) );
				?>
			</td>
		</tr>
		<?php
	}
	?>

<?php endforeach; ?>



