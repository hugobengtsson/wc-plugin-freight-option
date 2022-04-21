<?php

/*

    Plugin name: Drone Freight Option
    Version: 1.0
    Author: Hugo Bengtsson
	Description: Plugin for adding Drone Freight to your page.

*/


/**
 * Check if WooCommerce is active
 */
// if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

// 	function drone_shipping_method_init() {
// 		if ( ! class_exists( 'WC_Drone_Shipping_Method' ) ) {
// 			class WC_Drone_Shipping_Method extends WC_Shipping_Method {
// 				/**
// 				 * Constructor for your shipping class
// 				 *
// 				 * @access public
// 				 * @return void
// 				 */
// 				public function __construct() {
// 					$this->id                 = 'drone_shipping_method'; // Id for your shipping method. Should be uunique.
// 					$this->method_title       = __( 'Drone shipment' );  // Title shown in admin
// 					$this->method_description = __( 'Get your order delivered with a drone' ); // Description shown in admin

// 					$this->enabled            = "yes"; // This can be added as an setting but for this example its forced enabled
// 					$this->title              = "Drone Shipping"; // This can be added as an setting but for this example its forced.

// 					$this->init();
// 				}

// 				/**
// 				 * Init your settings
// 				 *
// 				 * @access public
// 				 * @return void
// 				 */
// 				function init() {
// 					// Load the settings API
// 					$this->init_form_fields(); // This is part of the settings API. Override the method to add your own settings
// 					$this->init_settings(); // This is part of the settings API. Loads settings you previously init.

// 					// Save settings in admin if you have any defined
// 					add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
// 				}

// 				/**
// 				 * calculate_shipping function.
// 				 *
// 				 * @access public
// 				 * @param mixed $package
// 				 * @return void
// 				 */
// 				public function calculate_shipping( $package = array() ) {
// 					$rate = array(
// 						'label' => $this->title,
// 						'cost' => '200,00',
// 						'calc_tax' => 'per_item'
// 					);

// 					// Register the rate
// 					$package->add_rate( $rate );
// 				}
// 			}
// 		}
// 	}

// 	add_action( 'woocommerce_shipping_init', 'drone_shipping_method_init' );

// 	function add_drone_shipping_method( $methods ) {
// 		$methods['drone_shipping_method'] = 'WC_Drone_Shipping_Method';
// 		return $methods;
// 	}

// 	add_filter( 'woocommerce_shipping_methods', 'add_drone_shipping_method' );
// }



if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

function your_shipping_method_init() {
    if ( ! class_exists( 'WC_Your_Shipping_Method' ) ) {
        class WC_Your_Shipping_Method extends WC_Shipping_Method {
            /**
             * Constructor for your shipping class
             *
             * @access public
             * @return void
             */
            public function __construct() {
                $this->id                 = 'drone_shipping_method'; // Id for your shipping method. Should be uunique.
                $this->method_title       = __( 'Drone Shipment' );  // Title shown in admin
                $this->method_description = __( 'Drone shipping to your house.' ); // Description shown in admin

                $this->enabled            = "yes"; // This can be added as an setting but for this example its forced enabled
                $this->title              = "Drone Shipping"; // This can be added as an setting but for this example its forced.

                $this->init();
            }

            /**
             * Init your settings
             *
             * @access public
             * @return void
             */
            function init() {
                // Load the settings API
                $this->init_form_fields(); // This is part of the settings API. Override the method to add your own settings
                $this->init_settings(); // This is part of the settings API. Loads settings you previously init.

                // Save settings in admin if you have any defined
                add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
            }

            /**
             * calculate_shipping function.
             *
             * @access public
             * @param mixed $package
             * @return void
             */
            public function calculate_shipping( $package = array() ) {
                $rate = array(
                    'label' => $this->title,
                    'cost' => '200.00',
                    'calc_tax' => 'per_item'
                );

                // Register the rate
                $this->add_rate( $rate );
            }
        }
    }
}

add_action( 'woocommerce_shipping_init', 'your_shipping_method_init' );

function add_your_shipping_method( $methods ) {
    $methods['your_shipping_method'] = 'WC_Your_Shipping_Method';
    return $methods;
}

add_filter( 'woocommerce_shipping_methods', 'add_your_shipping_method' );
}



?>