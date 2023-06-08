<?php
/**
 * Woo Address Book
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address-book.php.
 *
 * HOWEVER, on occasion Woo Address Book will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @package WooCommerce Address Book/Templates
 * @version 1.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// update_user_meta(get_current_user_id(), 'wc_address_book_billing', array());
// update_user_meta(get_current_user_id(), 'wc_address_book_shipping', array());

$wc_address_book = ABFW_Address_Book::get_instance();

$abfw_address_book_customer_id           = get_current_user_id();
$abfw_address_book_billing_address_book  = $wc_address_book->get_address_book( $abfw_address_book_customer_id, 'billing' );

// Do not display on address edit pages.
if ( ! $type ) {
	$abfw_address_book_billing_address = get_user_meta( $abfw_address_book_customer_id, 'billing_address_1', true );

	// Hide the billing address book if there are no addresses to show and no ability to add new ones.
	$count_section = count( $abfw_address_book_billing_address_book );

	// Only display if primary addresses are set and not on an edit page.
	if ( ! empty( $abfw_address_book_billing_address ) ) {
		?>

		<div class="address_book billing_address_book" data-addresses='<?php echo $count_section; ?>'>
			<header>
				<h3><?php esc_html_e( 'Saved Addresses', 'address-book-for-woocommerce' ); ?></h3>
				<?php
				// Add link/button to the my accounts page for adding addresses.
				$wc_address_book->add_additional_address_button( 'billing' );
				?>
			</header>

			<p class="myaccount_address"><?php echo esc_html( apply_filters( 'woocommerce_my_account_my_address_book_description', __( 'The following addresses are available during the checkout process.', 'address-book-for-woocommerce' ) ) ); ?></p>
			<div class="col2-set addresses address-book">
				<?php

				foreach ( $abfw_address_book_billing_address_book as $abfw_address_book_name => $abfw_address_book_fields ) {
					// Prevent default billing from displaying here.
					if ( 'billing' === $abfw_address_book_name ) {
						continue;
					}

					$abfw_address_book_address = apply_filters(
						'woocommerce_my_account_my_address_formatted_address',
						array(
							'first_name' => get_user_meta( $abfw_address_book_customer_id, $abfw_address_book_name . '_first_name', true ),
							'last_name'  => get_user_meta( $abfw_address_book_customer_id, $abfw_address_book_name . '_last_name', true ),
							'company'    => get_user_meta( $abfw_address_book_customer_id, $abfw_address_book_name . '_company', true ),
							'address_1'  => get_user_meta( $abfw_address_book_customer_id, $abfw_address_book_name . '_address_1', true ),
							'address_2'  => get_user_meta( $abfw_address_book_customer_id, $abfw_address_book_name . '_address_2', true ),
							'city'       => get_user_meta( $abfw_address_book_customer_id, $abfw_address_book_name . '_city', true ),
							'state'      => get_user_meta( $abfw_address_book_customer_id, $abfw_address_book_name . '_state', true ),
							'postcode'   => get_user_meta( $abfw_address_book_customer_id, $abfw_address_book_name . '_postcode', true ),
							'country'    => get_user_meta( $abfw_address_book_customer_id, $abfw_address_book_name . '_country', true ),
						),
						$abfw_address_book_customer_id,
						$abfw_address_book_name
					);

					$abfw_address_book_formatted_address = WC()->countries->get_formatted_address( $abfw_address_book_address );

					if ( $abfw_address_book_formatted_address ) {
						?>

						<div class="wc-address-book-address">
							<div class="wc-address-book-meta">
								<a href="<?php echo esc_url( $wc_address_book->get_address_book_endpoint_url( $abfw_address_book_name, 'billing' ) ); ?>" class="wc-address-book-edit"><?php echo esc_attr__( 'Edit', 'address-book-for-woocommerce' ); ?></a>
								<a id="<?php echo esc_attr( $abfw_address_book_name ); ?>" class="wc-address-book-delete"><?php echo esc_attr__( 'Delete', 'address-book-for-woocommerce' ); ?></a>
								<a data-type="billing" id="<?php echo esc_attr( $abfw_address_book_name ); ?>" class="wc-address-book-make-primary"><?php echo esc_attr__( 'Set as Default Billing Address', 'address-book-for-woocommerce' ); ?></a>
								<a data-type="shipping" id="<?php echo esc_attr( $abfw_address_book_name ); ?>" class="wc-address-book-make-primary"><?php echo esc_attr__( 'Set as Default Shipping Address', 'address-book-for-woocommerce' ); ?></a>
							</div>
							<address>
								<?php echo wp_kses( $abfw_address_book_formatted_address, array( 'br' => array() ) ); ?>
							</address>
						</div>

						<?php
					}
				}
				?>
			</div>
		</div>
		<?php
	}
}

?> 

<div style="margin-bottom: 100px;"></div>

<?php
