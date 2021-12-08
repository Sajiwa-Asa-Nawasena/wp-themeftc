<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Elementor image widget.
 *
 * Elementor widget that displays an image into the page.
 *
 * @since 1.0.0
 */
class My_Account_Header extends Widget_Base {


	public function get_name() {
		return 'ftc_account_header';
	}

	public function get_title() {
		return __( 'FTC - My account', 'ftc-element' );
	}
	public function get_icon() {
		return 'ftc-icon';
	}
	public function get_categories() {
		return [ 'ftc-elements-header' ];
	}

	/**
	 * Register image widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function _register_controls() {
		$this->start_controls_section(
			'section_image',
			[
				'label' => __( 'FTC My account', 'ftc-element' ),
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => __( 'Choose Icon account', 'ftc-element' ),
				'type' => Controls_Manager::ICON,
				'dynamic' => [
					'active' => true,
				],
			]
		);

		$this->add_responsive_control(
			'align',
			[
				'label' => __( 'Alignment', 'ftc-element' ),
				'type' => Controls_Manager::CHOOSE,
				'options' => [
					'left' => [
						'title' => __( 'Left', 'ftc-element' ),
						'icon' => 'fa fa-align-left',
					],
					'center' => [
						'title' => __( 'Center', 'ftc-element' ),
						'icon' => 'fa fa-align-center',
					],
					'right' => [
						'title' => __( 'Right', 'ftc-element' ),
						'icon' => 'fa fa-align-right',
					],
				],
				'selectors' => [
					'{{WRAPPER}}' => 'text-align: {{VALUE}};',
				],
			]
		);
		$this->add_responsive_control(
			'icon_size',
			[
				'label'     => __( 'Icon size', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'unit' => 'px',
				],
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ftc_login i' => 'font-size: {{SIZE}}{{UNIT}};',
				],

			]
		);
		$this->add_responsive_control(
			'text_size',
			[
				'label'     => __( 'Text size', 'ftc-element' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => [
					'unit' => 'px',
				],
				'range'     => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .ftc_login' => 'font-size: {{SIZE}}{{UNIT}};',
				],

			]
		);
	
		$this->end_controls_section();
	}

	/**
	 * Render image widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();

		$set = $this->get_settings();
		$icon = ! empty( $set['icon'] ) ? $set['icon'] : '';
		
		global $smof_data;
          
          $login_url = '#';
        $register_url = '#';
        $profile_url = '#';
        $logout_url = wp_logout_url(get_permalink());

        if (ftc_has_woocommerce()) { /* Active woocommerce */
            $myaccount_page_id = get_option('woocommerce_myaccount_page_id');
            if ($myaccount_page_id) {
                $login_url = get_permalink($myaccount_page_id);
                $register_url = $login_url;
                $profile_url = $login_url;
            }
        } else {
            $login_url = wp_login_url();
            $register_url = wp_registration_url();
            $profile_url = admin_url('profile.php');
        }

        $redirect_to = ( is_ssl() ? 'https://' : 'http://' ) . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];

        $_user_logged = is_user_logged_in();
        ?>
        <div class="ftc-account">
            <div class="ftc_login">

                <?php if (!$_user_logged): ?>
                    <div class="login-text">
                        <a  class="login" href="<?php echo esc_url($login_url); ?>" title="<?php echo esc_attr('Login', 'karo'); ?>"><span><?php echo esc_html__('Login', 'karo'); ?></span></a>
                        <div class="ftc_account_form dropdown-container">
                            <form name="ftc-login-form" class="ftc-login-form" action="<?php echo esc_url(wp_login_url()); ?>" method="post">

                                <p class="login-username">
                                    <label><?php echo esc_html__('Username', 'karo'); ?></label>
                                    <input type="text" name="log" class="input" value="" size="20" autocomplete="off">
                                </p>
                                <p class="login-password">
                                    <label><?php echo esc_html__('Password', 'karo'); ?></label>
                                    <input type="password" name="pwd" class="input" value="" size="20">
                                </p>

                                <p class="login-submit">
                                    <input type="submit" name="wp-submit" class="button-secondary button" value="<?php echo esc_attr('Login', 'karo'); ?>">
                                    <input type="hidden" name="redirect_to" value="<?php echo esc_url(home_url( $wp->request )) ?>">
                                </p>

                            </form>

                            <p class="ftc_forgot_pass"><a href="<?php echo esc_url(wp_lostpassword_url()); ?>" title="<?php echo esc_attr('Forgot Your Password?', 'karo'); ?>"><?php echo esc_html__('Forgot Your Password?', 'karo'); ?></a></p>
                        </div>
                    </div>
                     / 
                    <a class="ftc_sign_up" href="<?php echo esc_url($register_url); ?>" title="<?php echo esc_attr('Create New Account', 'karo'); ?>"><span><?php echo esc_html__('Sign up', 'karo'); ?></span></a>
                    <?php else: ?>
                        <a class="my-account" href="<?php echo esc_url($profile_url); ?>" title="<?php echo esc_attr('My Account', 'karo'); ?>"><span><?php echo esc_html__('My Account', 'karo'); ?></span></a> / 
                        <a class="log-out" href="<?php echo esc_url($logout_url); ?>" title="<?php echo esc_attr('Logout', 'karo'); ?>"><span><?php echo esc_html__('Logout', 'karo'); ?></span></a>
                    <?php endif; ?>
                </div>
                
            </div>

        <?php
        
}
}
Plugin::instance()->widgets_manager->register_widget_type( new My_Account_Header() );
