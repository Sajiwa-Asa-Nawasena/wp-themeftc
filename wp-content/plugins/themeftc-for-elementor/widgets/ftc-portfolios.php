<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

class Ftc_Portfolios extends Widget_Base {

	public function get_name() {
		return 'ftc-portfolios';
	}

	public function get_title() {
		return __( 'FTC - Portfolios', 'ftc-element' );
	}

	public function get_icon() {
		// Icon name from the Elementor font file, as per http://dtbaker.net/web-development/creating-your-own-custom-elementor-widgets/
		return 'ftc-icon';
	}

	public function get_categories() {
		return [ 'ftc-elements' ];
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'section_main',
			[
				'label' => esc_html__( 'FTC -Portfolios', 'ftc-element' ),
			]
		);
		$this->add_control(
			'posts_per_page',
			[
				'label'   => __( 'Limit', 'ftc-element' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 6,
				'min'     => 0,
				'step'    => 1,
				'title'   => __( 'Total number of Portfolios to show', 'ftc-element' ),
			]
		);
		$this->add_control(
			'columns',
			[
				'label'   => __( 'Number of columns', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 3,
				'options' => [
					1 => __( '1', 'ftc-element' ),
					2 => __( '2', 'ftc-element' ),
					3 => __( '3', 'ftc-element' ),
					4 => __( '4', 'ftc-element' ),
					5 => __( '5', 'ftc-element' ),
				],
			]
		);
		$this->add_control(
			'categories',
			[
				'label'    => esc_html__( 'Select categories', 'ftc-element' ),
				'type'     => Controls_Manager::SELECT2,
				'default'  => array(),
				'options'  => apply_filters( 'ftc_elements_terms', 'ftc_portfolio_cat' ),
				'multiple' => true,
			]
		);
		$this->add_control(
    		'def_style',
    		[
    			'label' => esc_html__( 'Apply style default', 'ftc-element' ),
    			'type' => Controls_Manager::SELECT,
    			'options' => [
                    'yes' => __( 'Yes', 'ftc-element' ),
                    'no' => __( 'No', 'ftc-element' ),
                ],
    			'default' => 'no',
    		]
    	);
		$this->add_control(
			'def_style_option',
			[
				'label' => __( 'Default style', 'ftc-element' ),
				'type' => Controls_Manager::SELECT,
				'default' => 'def_style_1',
				'options' => [
					'def_style_1' => __( 'Default', 'ftc-element' ),
					'def_style_2' => __( 'No-padding', 'ftc-element' ),
					'def_style_3' => __( 'Content block', 'ftc-element' ),
					'def_style_4' => __( 'Style 4', 'ftc-element' ),
					// 'def_style_5' => __( 'Style 5', 'ftc-element' ),
					// 'def_style_6' => __( 'Style 6', 'ftc-element' ),
					// 'def_style_7' => __( 'Style 7', 'ftc-element' )
				],
				'condition' => ['def_style' => 'yes'],
			]
		);
		$this->add_control(
			'style',
			[
				'label'   => __( 'Customize style', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => '',
				'options' => [
					'' => __( 'Default', 'ftc-element' ),
					'style_1'   => __( 'Style 1', 'ftc-element' ),
					'style_2'   => __( 'Style 2', 'ftc-element' ),
					'style_3'   => __( 'Style 3', 'ftc-element' ),
					'style_4'   => __( 'Style 4', 'ftc-element' ),
					'style_5'   => __( 'Style 5', 'ftc-element' ),
				],
				'condition' => ['def_style!' => 'yes'],
			]
		);
		$this->add_control(
			'orderby',
			[
				'label'   => __( 'Orderby', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'none',
				'options' => [
					'none' => __( 'None', 'ftc-element' ),
					'ID' => __( 'ID', 'ftc-element' ),
					'date' => __( 'Date', 'ftc-element' ),
					'name' => __( 'Name', 'ftc-element' ),
					'title' => __( 'Title', 'ftc-element' ),
				],
			]
		);
		$this->add_control(
			'order',
			[
				'label'   => __( 'Order', 'ftc-element' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'DESC' => __( 'Descending', 'ftc-element' ),
					'ASC' => __( 'Ascending', 'ftc-element' ),
				],
			]
		);
		$this->add_control(
			'show_title',
			[
				'label'     => esc_html__( 'Show title', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'show_date',
			[
				'label'     => esc_html__( 'Show date', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'show_load_more',
			[
				'label'     => esc_html__( 'Show Load more', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'show_filter_bar',
			[
				'label'     => esc_html__( 'Show Filter', 'ftc-element' ),
				'type'      => Controls_Manager::SWITCHER,
				'label_off' => __( 'No', 'elementor' ),
				'label_on'  => __( 'Yes', 'elementor' ),
				'default'   => 'yes',
			]
		);
		$this->add_control(
			'load_more_text',
			array(
				'label'       => esc_html__( 'Load more Label', 'ftc-element' ),
				'type'        => Controls_Manager::TEXT,
				'default'     => esc_html__( 'Load more', 'ftc-element' ),
				'placeholder' => esc_html__( 'Load more', 'ftc-element' ),
				'condition'   => array(
					'show_load_more'      => 'yes',
				),
			)
		);
		$this->add_control(
			'hover_animation',
			[
				'label' => __( 'Hover animation', 'ftc-element' ),
				'type'  => Controls_Manager::HOVER_ANIMATION,
			]
		);
		$this->end_controls_section();

	}

	protected function render() {

		// get our input from the widget settings.
		$settings = $this->get_settings();
		$posts_per_page = ! empty( $settings['posts_per_page'] ) ? $settings['posts_per_page'] : 8;
		$columns = ! empty( $settings['columns'] ) ? $settings['columns'] : 4;
		$categories = ! empty( $settings['categories'] ) ? $settings['categories'] :  array();
		$def_style             = $settings['def_style'];
		$def_style_option      = $settings['def_style_option'];
		$style = ! empty( $settings['style'] ) ? $settings['style'] :  '';
		$orderby = ! empty( $settings['orderby'] ) ? $settings['orderby'] :  'none';
		$order = ! empty( $settings['order'] ) ? $settings['order'] :  'DESC';
		$show_title = ! empty( $settings['show_title'] ) ? $settings['show_title'] :  '';
		$show_date = ! empty( $settings['show_date'] ) ? $settings['show_date'] :  '';
		$show_load_more = ! empty( $settings['show_load_more'] ) ? $settings['show_load_more'] :  '';
		$show_filter_bar = ! empty( $settings['show_filter_bar'] ) ? $settings['show_filter_bar'] :  '';
		$load_more_text = ! empty( $settings['load_more_text'] ) ? $settings['load_more_text'] :  'Load more';
		$hover_animation = ! empty( $settings['hover_animation'] ) ? $settings['hover_animation'] :  '';


		if($def_style == 'yes'){
			$stylee = '';
			$def_style_optionn = $def_style_option;

		}
		else{
			$stylee = $style;
			$def_style_optionn = '';
		}

		// $por_shortcode = '[ftc_portfolio columns="3" per_page="6" show_title="1" show_date="0" show_filter_bar="1" show_load_more="1" load_more_text="Show me more"]';

		// echo do_shortcode( $short_code );
		$args = array(
			'post_type'				=> 'ftc_portfolio'
			,'posts_per_page'		=> $posts_per_page
			,'post_status'			=> 'publish'
			,'ignore_sticky_posts'	=> true
			,'orderby'				=> $orderby
			,'order'				=> $order
		);
		if( ! empty($categories) ){
			$args['tax_query']	= array(
				array(
					'taxonomy'	=> 'ftc_portfolio_cat'
					,'field'	=> 'slug'
					,'terms'	=> $categories
					,'operator' => 'IN'
				)
			);
		}
		global $post, $wp_query, $ftc_portfolios;
		$posts = get_posts( $args );
		if( ! empty($posts) ){
			$atts = compact('columns', 'per_page','categories', 'orderby', 'order', 'show_filter_bar', 'show_title', 'show_date');
			?>
			<div class="ftc-portfolio-wrapper ftc-portfolio-element <?php echo esc_attr($stylee); ?> <?php echo esc_attr($def_style_optionn); ?> columns-<?php echo esc_attr($columns); ?>" data-atts="<?php echo htmlentities(json_encode($atts)); ?>">
				<?php
				/* Get filter bar */
				if( $show_filter_bar ){
					$terms = array();
					foreach( $posts as $post){
						setup_postdata( $post );
						$post_terms = wp_get_post_terms($post->ID, 'ftc_portfolio_cat');
						if( is_array($post_terms) ){
							foreach( $post_terms as $term ){
								$terms[$term->slug] = $term->name;
							}
						}
					}

					if( !empty($terms) ){
						?>
						<ul class="filter-bar">
							<li data-filter="*" class="current"><?php esc_html_e('All', 'ftc-element'); ?></li>
							<?php
							foreach( $terms as $slug => $name ){
								?>
								<li data-filter="<?php echo '.'.$slug; ?>"><?php echo esc_attr($name) ?></li>
								<?php
							}
							?>
						</ul>
						<?php
					}
				}
				?>
				<?php
				?> <div class="portfolio-inner"> <?php
				foreach( $posts as $post){
					setup_postdata( $post );
					$classes = '';
					$cla = '';
					$post_terms = wp_get_post_terms($post->ID, 'ftc_portfolio_cat',true);
					if( is_array($post_terms) ){
						foreach( $post_terms as $term ){
							$terms[$term->slug] = $term->name;
							$classes .= $term->slug .' ';
							$cla .= $term->slug .' / ';
						}
					}
					$link = get_permalink();
					?>
					<div class="item <?php echo esc_attr($classes) ?> elementor-animation elementor-animation-<?php echo esc_attr($hover_animation) ?>">
						<div class="thumbnail">

							<figure class="">
								<?php 
								if( has_post_thumbnail() ){
									the_post_thumbnail('ftc_portfolio_thumb');
								}
								?>							

								<?php if( $show_date ){ ?>
									<span class="date-time">
										<?php echo get_the_time(get_option('date_format')); ?>
									</span>
								<?php } ?>

							</figure>
							<div class="figcaption">
								<?php if( $show_title ){ ?>
									<h3>
										<a href="<?php echo esc_url($link); ?>">
											<?php echo get_the_title(); ?>
										</a>

									</h3>
									<div class="term">
										<?php
										if( is_array($post_terms) ){
											foreach( $post_terms as $term ){
												$terms[$term->slug] = $term->name;
												$classes .= $term->slug .' ';
												$cla .= $term->slug .' / ';
												echo '<span>'.$term->name.'</span>';
											}
										} 

										?>
									</div>
								<?php } ?>

							</div>
							<div class="icon-group">
									<a href="<?php echo esc_url(wp_get_attachment_url( get_post_thumbnail_id($post->ID))); ?>" rel="prettyPhoto" class="zoom-img"></a>
									<div class="ftc-social">
										<ul class="ftc-sharing">

											<li class="twitter">
												<a href="https://twitter.com/share?url=<?php echo esc_url(get_permalink()); ?>" target="_blank"><i class="fa fa-twitter"></i> Tweet</a>
											</li>

											<li class="facebook">
												<a href="https://www.facebook.com/sharer.php?u=<?php echo esc_url(get_permalink()); ?>" target="_blank"><i class="fa fa-facebook"></i> Share</a>
											</li>

											<li class="google-plus">
												<a href="https://plus.google.com/share?url=<?php echo esc_url(get_permalink()); ?>" target="_blank"><i class="fa fa-google-plus"></i> Google+</a>
											</li>

											<li class="pinterest">
												<?php $image_link = wp_get_attachment_url(get_post_thumbnail_id()); ?>
												<a href="https://pinterest.com/pin/create/button/?url=<?php echo esc_url(get_permalink()); ?>&amp;media=<?php echo esc_url($image_link); ?>" target="_blank"><i class="fa fa-pinterest"></i> Pinterest</a>
											</li>

										</ul> 
									</div>
								</div>
						</div>
					</div>
					
					<?php
				}
				?></div> <?php
				?>
				<?php if( $show_load_more ){ ?>
					<div class="load-more-wrapper">
						<a href="#" class="load-more button" data-paged="2"><?php echo esc_html($load_more_text) ?></a>
					</div>
				<?php } ?>
			</div>

			<?php
		}

		wp_reset_postdata();
	}

	protected function content_template() {}

	public function render_plain_content( $instance = [] ) {}

}

Plugin::instance()->widgets_manager->register_widget_type( new Ftc_Portfolios() );
