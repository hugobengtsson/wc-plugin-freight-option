<?php

/*

    Plugin name: Drone Freight Option
    Version: 1.0
    Author: Hugo Bengtsson
	Description: Plugin for adding Drone Freight to your page.

*/

if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {

    function drone_method_init() {
        if ( ! class_exists( 'WC_Drone_Shipping_Method' ) ) {

            // Drone Shipping class extending the WooCommerce shipment API.
            class WC_Drone_Shipping_Method extends WC_Shipping_Method {

                // Constructing the new class.
                public function __construct() {
                    $this->id                 = 'drone_shipping_method'; // ID for your shipping method. Should be uunique.
                    $this->method_title       = __( 'Drone Shipment' );  // Title shown in admin
                    $this->method_description = __( 'Drone shipping to your house.' ); // Description shown in admin

                    $this->enabled            = "yes";
                    $this->title              = "Drone Shipping";

                    $this->init();
                }


                function init() {
                    // Load the settings API
                    $this->init_form_fields();
                    $this->init_settings();

                    // Saves settings in admin if you have any defined
                    add_action( 'woocommerce_update_options_shipping_' . $this->id, array( $this, 'process_admin_options' ) );
                }

                // Function for calculate the shipping cost.
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
    
    // Hook that is called after the plugins are loaded.
    add_action( 'woocommerce_shipping_init', 'drone_method_init' );
    
    function add_drone_shipping_method( $methods ) {
        $methods['your_shipping_method'] = 'WC_Drone_Shipping_Method';
        return $methods;
    }
    
    add_filter( 'woocommerce_shipping_methods', 'add_drone_shipping_method' );
    }


?>