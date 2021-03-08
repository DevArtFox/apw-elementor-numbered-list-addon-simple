<?php
/**
 * Plugin Name: Elementor numbered list Simple
 * Description: Нумерованный список для Elementor. Версия Simple не включает в себя настройку стилей списка, так что придется делать вручную к шаблону
 * Plugin URI:  https://github.com/Trexiz/apw-elementor-numbered-list-addon-simple
 * Version:     1.0.0
 * Author:      Alexandr.pw
 * Author URI:  https://github.com/Trexiz
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
