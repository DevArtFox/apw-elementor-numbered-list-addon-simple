<?php
namespace ApwWebSite;

use Elementor\Repeater;
use Elementor\Widget_Base;

class Numbered_list_Widget extends Widget_Base {

	public static $slug = 'apw-numbered_list_widget';

	public function get_name() { return self::$slug; }

	public function get_title() { return __('Нумерованный список', self::$slug); }

	public function get_icon() { return 'eicon-bullet-list'; }

	public function get_categories() { return [ 'general' ]; }
  
	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			[
				'label' => __( 'Нумерованный список', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'number_list', [
				'label' => __( 'Номер', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( '01' , 'plugin-domain' ),
				'label_block' => true,
			]
		);
		$repeater->add_control(
			'list_title', [
				'label' => __( 'Название', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'List Title' , 'plugin-domain' ),
				'label_block' => true,
			]
		);

		$repeater->add_control(
			'list_content', [
				'label' => __( 'Описание', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::WYSIWYG,
				'default' => __( 'List Content' , 'plugin-domain' ),
				'show_label' => false,
			]
		);

		$this->add_control(
			'list',
			[
				'label' => __( 'Список', 'plugin-domain' ),
				'type' => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
				'default' => '',
				'title_field' => '{{{ list_title }}}',
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		if ( $settings['list'] ) {
			echo '<div class="apw-numbered_list"><ul>';
			foreach (  $settings['list'] as $item ) {
				$number_list = $item['number_list'];
				$title_list = $item['list_title'];
				$desc_list = $item['list_content'];
				echo '<li>';
					echo '<span>' . $number_list . '</span>';
					echo '<div class="list_content">';
						echo '<p class="title">' . $title_list . '</p>';
						echo '<p class="desc">' . $desc_list . '</p>';
					echo '</div>';
				echo '</li>';
			}
			echo '</ul></div>';
		}
	}
	protected function _content_template() {
	?>
	<# if ( settings.list.length ) { #>
	<div class="apw-numbered_list"><ul>
		<# _.each( settings.list, function( item ) { #>
			<li>
				<span>{{{ item.number_list }}}</span>
				<div class="list_content">
					<p class="title">{{{ item.list_title }}}</p>
					<p class="desc">{{{ item.list_content }}}</p>
				</div>
			</li>
		<# }); #>
	</ul></div>
	<# } #>
	<?php
	}
}