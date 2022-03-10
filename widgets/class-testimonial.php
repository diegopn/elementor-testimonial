<?php
/**
 * Testimonial class.
 *
 * @category   Class
 * @package    ElementorTestimonial
 * @subpackage WordPress
 * @author     Diego Pereira do Nascimento <diego.nascimento@dootax.com.br>
 * @copyright  2022 - Diego Pereira do Nascimento
 * @license    https://opensource.org/licenses/GPL-3.0 GPL-3.0-only
 * @link       link(https://www.dootax.com.br,
 *             Build Custom Elementor Widgets)
 * @since      1.0.0
 * php version 7.3.9
 */

namespace ElementorTestimonial\Widgets;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

// Security Note: Blocks direct access to the plugin PHP files.
defined( 'ABSPATH' ) || die();

/**
 * Testimonial widget class.
 *
 * @since 1.0.0
 */
class Testimonial extends Widget_Base {
	/**
	 * Class constructor.
	 *
	 * @param array $data Widget data.
	 * @param array $args Widget arguments.
	 */
	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
		
		wp_register_style(  'style-Testimonial',  plugins_url( '/assets/Testimonial.css',	ELEMENTOR_TESTIMONIAL ), [], '1.0.0' );
		wp_register_script( 'script-Testimonial',	plugins_url( '/assets/Testimonial.js',	ELEMENTOR_TESTIMONIAL ), [ 'elementor-frontend' ], '1.0.0', true );
	}

	/**
	 * Retrieve the widget name.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'testimonial';
	}

	/**
	 * Retrieve the widget title.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Testimonial', 'elementor-testimonial' );
	}

	/**
	 * Retrieve the widget icon.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'fa fa-pencil';
	}

	/**
	 * Retrieve the list of categories the widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * Note that currently Elementor supports only one category.
	 * When multiple categories passed, Elementor uses the first one.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return array( 'general' );
	}
	
	/**
	 * Enqueue styles.
	 */
	public function get_style_depends() {
		return [ 'style-testimonial' ];
	}
	
	/**
	 * Enqueue scripts.
	 */
	public function get_script_depends() {
		return [ 'script-testimonial' ];
	}

	/**
	 * Register the widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Testimonial', 'elementor-Testimonial' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'autoplay',
			[
				'label'		=> __( 'Autoplay', 'elementor-Testimonial-carousel' ),
				'type'		=> Controls_Manager::SELECT,
				'options'	=> [
					'default'	=> __( 'Padrão', 'elementor-Testimonial-carousel' ),
					'true'		=> __( 'Sim', 	 'elementor-Testimonial-carousel' ),
					'false'		=> __( 'Não', 	 'elementor-Testimonial-carousel' )
				],
				'default'	=> 'true',
			]
		);

		$this->add_control(
			'speed',
			[
				'label'		=> __( 'Tempo de transição', 'elementor-Testimonial-carousel' ),
				'type'		=> Controls_Manager::NUMBER,
				'min'		=> 500,
				'max'		=> 15000,
				'step'		=> 500,
				'default'	=> 2500
			]
		);
		
		
        $repeater = new \Elementor\Repeater();
        
        $repeater->add_control(
			'name',
			[
				'label'   => __( 'Nome Completo', 'elementor-Testimonial-carousel' ),
				'type'    => Controls_Manager::TEXT,
			]
		);
		
        $repeater->add_control(
			'job_title',
			[
				'label'   => __( 'Cargo', 'elementor-Testimonial-carousel' ),
				'type'    => Controls_Manager::TEXT,
			]
		);

        $repeater->add_control(
			'soluction',
			[
				'label'   => __( 'Solução', 'elementor-Testimonial-carousel' ),
				'type'    => Controls_Manager::TEXT,
			]
		);
		
		
        $repeater->add_control(
			'testimonial',
			[
				'label'   => __( 'Depoimento', 'elementor-Testimonial-carousel' ),
				'type'    => Controls_Manager::TEXTAREA,
			]
		);
		
        $repeater->add_control(
			'tags',
			[
				'label'       => __( 'Tags', 'elementor-Testimonial-carousel' ),
				'placeholder' => __( 'Tag A, Tag B, Tag C ...', 'elementor-Testimonial-carousel' ),
				'type'        => Controls_Manager::TEXT,
			]
		);
        
        $repeater->add_control(
			'url_video',
			[
				'label'       => __( 'Link do vídeo', 'elementor-Testimonial-carousel' ),
				'type'        => Controls_Manager::TEXT,
			]
		);
		
		$repeater->add_control(
			'image_testimonial',
			[
				'label'   => __( 'Imagem da capa', 'elementor-Testimonial-carousel' ),
				'type'    => Controls_Manager::MEDIA,
                /*'default' => [ 'url' => Utils::get_placeholder_image_src() ],*/
			]
		);
        
        $this->add_control(
            'list',
            [
                'label'   => __('Itens', 'cc'),
                'type'    => Controls_Manager::REPEATER,
                'fields'  => $repeater->get_controls(),
                'default' => [
                    [
                        'name'        => __( 'Dona Katarina',         'elementor-Testimonial-carousel' ),
                        'job_title'   => __( 'Designer',              'elementor-Testimonial-carousel' ),
                        'soluction'   => __( 'Pagamento de Tributos', 'elementor-Testimonial-carousel' ),
                        'testimonial' => __( 'Lorem ipsum dolor sit amet, tpat dictum purus, at malesuada tellus convallis et.', 'elementor-Testimonial-carousel' ),
                        'url_video'   => __( 'https://www.youtube.com/watch?v=sw7CJy6jzi8' ),
                    ],
                    [
                        'name'        => __( 'Irmão do Jorel',        'elementor-Testimonial-carousel' ),
                        'job_title'   => __( 'Gestor de Marketing',   'elementor-Testimonial-carousel' ),
                        'soluction'   => __( 'Gestão de Certidões',   'elementor-Testimonial-carousel' ),
                        'testimonial' => __( 'Lorem ipsum dolor sit amet, tpat dictum purus, at malesuada tellus convallis et.', 'elementor-Testimonial-carousel' ),
                        'url_video'   => __( 'https://www.youtube.com/watch?v=sw7CJy6jzi8' ),
                    ],
                    [
                        'name'        => __( 'Frederico',             'elementor-Testimonial-carousel' ),
                        'job_title'   => __( 'Analista de RH',        'elementor-Testimonial-carousel' ),
                        'soluction'   => __( 'Respositório DFe',      'elementor-Testimonial-carousel' ),
                        'testimonial' => __( 'Lorem ipsum dolor sit amet, tpat dictum purus, at malesuada tellus convallis et.', 'elementor-Testimonial-carousel' ),
                        'url_video'   => __( 'https://www.youtube.com/watch?v=sw7CJy6jzi8' ),
                    ],
                ],
                'title_field' => '{{{ name }}}',
            ]
        );

        $this->end_controls_section();
	}

	/**
	 * Render the widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 *
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		
		if ( $settings['list'] ) {

			$print_testimonial = '';

		    foreach (  $settings['list'] as $item ) {
		        
		        $tags = "";
		        
		        foreach ( explode( "," , $item["tags"] ) as $item_tag )
                    $tags .= "<li>" . $item_tag . "</li>";
                
                
		        $print_testimonial .= "<div class='item-case'>
                                    <div class='box-img'>
                                        <span class='soluction'>" . $item["soluction"] . "</span>
                                        <img src='" . $item["image_testimonial"]["url"] . "' alt='" . $item["name"] . "' class='img-testimonial' />
                                        <a href='" . $item["url_video"] . "' data-lity>
                                            <img src='" . plugin_dir_url( __DIR__ ) . "/assets/img/icon_play_case.svg' alt='Icon - Play' class='icon-play' />
                                        </a>
                                        <ul class='list_tags'>" . $tags . "</ul>
                                    </div>
                                    <div class='box-content'>
                                        <h4 class='name'>" . $item["name"] . "</h4>
                                        <span class='job_title'>" . $item["job_title"] . "</span>
                                        <p class='testimonial'>" . $item["testimonial"] . "</p>
                                    </div>
                                </div>";
		    }
?>
			<style>
			@font-face{
				font-family : slick;
				font-weight : 400;
				font-style	: normal;
				src			: url('<?=plugin_dir_url( __DIR__ );?>assets/fonts/slick.eot');
				src			: url('<?=plugin_dir_url( __DIR__ );?>assets/fonts//slick.eot?#iefix') format('embedded-opentype'),
							  url('<?=plugin_dir_url( __DIR__ );?>assets/fonts/slick.woff') format('woff'),
							  url('<?=plugin_dir_url( __DIR__ );?>assets/fonts/slick.ttf') format('truetype'),
							  url('<?=plugin_dir_url( __DIR__ );?>assets/fonts/slick.svg#slick') format('svg');
			}
			</style>

			<div class="box-Testimonial">
				<?php echo $print_testimonial . $print_testimonial; ?>
			</div>

			<script>
				$(document).ready(function(){
					$(".box-Testimonial").slick({
						autoplay		: <?=$settings["autoplay"];?>,
						autoplaySpeed	: <?=$settings["speed"];?>,
						infinite        : true,
						arrows          : true,
						centerMode		: true,
						slidesToShow	: 3,
						centerPadding	: "5px",
						responsive		: [
							{ breakpoint	: 768, settings	: { centerPadding: '20px', slidesToShow: 1 } }
						]
					});
				});
			</script>

<?php
		}
	}
}
