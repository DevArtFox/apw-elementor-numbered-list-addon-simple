<?php
/**
 * Plugin Name: Apw Elementor Addon
 * Description: Аддон для Elementor
 * Plugin URI:  https://www.soliddigital.com/blog/...
 * Version:     1.0.0
 * Author:      Alexandr.pw
 * Author URI:  https://github.com/Trexiz/Elementor_Addon
 * Text Domain: apw-elementor-addons
 */
namespace ApwWebSite;
use Elementor\Plugin;

if ( ! defined( 'ABSPATH' ) ) exit;

add_action( 'elementor/widgets/widgets_registered', function() {
	wp_register_style('apw-elementor-style', plugins_url('inc/style.css', __FILE__));
	wp_enqueue_style('apw-elementor-style');

	require_once('widget.php');
	// Передаем имена виджетов
	$numbered_list = new Numbered_list_Widget();

	// Подключаем виджеты к Elementor
	Plugin::instance()->widgets_manager->register_widget_type( $numbered_list );
}); 