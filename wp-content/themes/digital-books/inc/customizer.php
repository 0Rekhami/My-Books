<?php
/**
 * Digital Books Theme Customizer
 *
 * @link: https://developer.wordpress.org/themes/customize-api/customizer-objects/
 *
 * @package Digital Books
 */

if ( ! defined( 'DIGITAL_BOOKS_URL' ) ) {
    define( 'DIGITAL_BOOKS_URL', esc_url( 'https://www.themagnifico.net/products/book-store-wordpress-theme', 'digital-books') );
}
if ( ! defined( 'DIGITAL_BOOKS_TEXT' ) ) {
    define( 'DIGITAL_BOOKS_TEXT', __( 'Digital Books Pro','digital-books' ));
}
if ( ! defined( 'DIGITAL_BOOKS_BUY_TEXT' ) ) {
    define( 'DIGITAL_BOOKS_BUY_TEXT', __( 'Buy Digital Books Pro','digital-books' ));
}

use WPTRT\Customize\Section\Digital_Books_Button;

add_action( 'customize_register', function( $manager ) {

    $manager->register_section_type( Digital_Books_Button::class );

    $manager->add_section(
        new Digital_Books_Button( $manager, 'digital_books_pro', [
            'title'       => esc_html( DIGITAL_BOOKS_TEXT,'digital-books' ),
            'priority'    => 0,
            'button_text' => __( 'GET PREMIUM', 'digital-books' ),
            'button_url'  => esc_url( DIGITAL_BOOKS_URL )
        ] )
    );

} );

// Load the JS and CSS.
add_action( 'customize_controls_enqueue_scripts', function() {

    $version = wp_get_theme()->get( 'Version' );

    wp_enqueue_script(
        'digital-books-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/js/customize-controls.js' ),
        [ 'customize-controls' ],
        $version,
        true
    );

    wp_enqueue_style(
        'digital-books-customize-section-button',
        get_theme_file_uri( 'vendor/wptrt/customize-section-button/public/css/customize-controls.css' ),
        [ 'customize-controls' ],
        $version
    );

} );

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function digital_books_customize_register($wp_customize){

     // Pro Version
    class Digital_Books_Customize_Pro_Version extends WP_Customize_Control {
        public $type = 'pro_options';

        public function render_content() {
            echo '<span>For More <strong>'. esc_html( $this->label ) .'</strong>?</span>';
            echo '<a href="'. esc_url($this->description) .'" target="_blank">';
                echo '<span class="dashicons dashicons-info"></span>';
                echo '<strong> '. esc_html( DIGITAL_BOOKS_BUY_TEXT,'digital-books' ) .'<strong></a>';
            echo '</a>';
        }
    }

    // Custom Controls
    function Digital_Books_sanitize_custom_control( $input ) {
        return $input;
    }

    $wp_customize->get_setting('blogname')->transport = 'postMessage';
    $wp_customize->get_setting('blogdescription')->transport = 'postMessage';
    $wp_customize->get_setting('header_textcolor')->transport = 'postMessage';

    //Logo
    $wp_customize->add_setting('digital_books_logo_max_height',array(
        'default'   => '24',
        'sanitize_callback' => 'digital_books_sanitize_number_absint'
    ));
    $wp_customize->add_control('digital_books_logo_max_height',array(
        'label' => esc_html__('Logo Width','digital-books'),
        'section'   => 'title_tagline',
        'type'      => 'number'
    ));

    $wp_customize->add_setting('digital_books_logo_title_text', array(
        'default' => true,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'digital_books_logo_title_text',array(
        'label'          => __( 'Enable Disable Title', 'digital-books' ),
        'section'        => 'title_tagline',
        'settings'       => 'digital_books_logo_title_text',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('digital_books_theme_description', array(
        'default' => false,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'digital_books_theme_description',array(
        'label'          => __( 'Enable Disable Tagline', 'digital-books' ),
        'section'        => 'title_tagline',
        'settings'       => 'digital_books_theme_description',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('digital_books_logo_title_color', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'digital_books_logo_title_color', array(
        'label'    => __('Site Title Color', 'digital-books'),
        'section'  => 'title_tagline'
    )));

    $wp_customize->add_setting('digital_books_logo_tagline_color', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'digital_books_logo_tagline_color', array(
        'label'    => __('Site Tagline Color', 'digital-books'),
        'section'  => 'title_tagline'
    )));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_logo', array(
        'sanitize_callback' => 'Digital_Books_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Digital_Books_Customize_Pro_Version ( $wp_customize,'pro_version_logo', array(
        'section'     => 'title_tagline',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'digital-books' ),
        'description' => esc_url( DIGITAL_BOOKS_URL ),
        'priority'    => 100
    )));

    // General Settings
     $wp_customize->add_section('digital_books_general_settings',array(
        'title' => esc_html__('General Settings','digital-books'),
        'priority'   => 30,
    ));

    $wp_customize->add_setting('digital_books_preloader_hide', array(
        'default' => 0,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'digital_books_preloader_hide',array(
        'label'          => __( 'Show Theme Preloader', 'digital-books' ),
        'section'        => 'digital_books_general_settings',
        'settings'       => 'digital_books_preloader_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting( 'digital_books_preloader_bg_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'digital_books_preloader_bg_color', array(
        'label' => esc_html__('Preloader Background Color','digital-books'),
        'section' => 'digital_books_general_settings',
        'settings' => 'digital_books_preloader_bg_color'
    )));

    $wp_customize->add_setting( 'digital_books_preloader_dot_1_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'digital_books_preloader_dot_1_color', array(
        'label' => esc_html__('Preloader First Dot Color','digital-books'),
        'section' => 'digital_books_general_settings',
        'settings' => 'digital_books_preloader_dot_1_color'
    )));

    $wp_customize->add_setting( 'digital_books_preloader_dot_2_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'digital_books_preloader_dot_2_color', array(
        'label' => esc_html__('Preloader Second Dot Color','digital-books'),
        'section' => 'digital_books_general_settings',
        'settings' => 'digital_books_preloader_dot_2_color'
    )));

    $wp_customize->add_setting('digital_books_sticky_header', array(
        'default' => false,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'digital_books_sticky_header',array(
        'label'          => __( 'Show Sticky Header', 'digital-books' ),
        'section'        => 'digital_books_general_settings',
        'settings'       => 'digital_books_sticky_header',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('digital_books_scroll_hide', array(
        'default' => false,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'digital_books_scroll_hide',array(
        'label'          => __( 'Show Theme Scroll To Top', 'digital-books' ),
        'section'        => 'digital_books_general_settings',
        'settings'       => 'digital_books_scroll_hide',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('digital_books_scroll_top_position',array(
        'default' => 'Right',
        'sanitize_callback' => 'digital_books_sanitize_choices'
    ));
    $wp_customize->add_control('digital_books_scroll_top_position',array(
        'label'       => esc_html__( 'Scroll To Top Positions','digital-books' ),
        'type' => 'radio',
        'section' => 'digital_books_general_settings',
        'choices' => array(
            'Right' => __('Right','digital-books'),
            'Left' => __('Left','digital-books'),
            'Center' => __('Center','digital-books')
        ),
    ) );

    $wp_customize->add_setting( 'digital_books_scroll_bg_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'digital_books_scroll_bg_color', array(
        'label' => esc_html__('Scroll Top Background Color','digital-books'),
        'section' => 'digital_books_general_settings',
        'settings' => 'digital_books_scroll_bg_color'
    )));

    $wp_customize->add_setting( 'digital_books_scroll_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'digital_books_scroll_color', array(
        'label' => esc_html__('Scroll Top Color','digital-books'),
        'section' => 'digital_books_general_settings',
        'settings' => 'digital_books_scroll_color'
    )));

    $wp_customize->add_setting('digital_books_scroll_font_size',array(
        'default'   => '16',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('digital_books_scroll_font_size',array(
        'label' => __('Scroll Top Font Size','digital-books'),
        'description' => __('Put in px','digital-books'),
        'section'   => 'digital_books_general_settings',
        'type'      => 'number'
    ));

    $wp_customize->add_setting( 'digital_books_scroll_to_top_border_radius', array(
        'default'              => '4',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'digital_books_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'digital_books_scroll_to_top_border_radius', array(
        'label'       => esc_html__( 'Scroll To Top Border Radius','digital-books' ),
        'section'     => 'digital_books_general_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    // Product Columns
    $wp_customize->add_setting( 'digital_books_products_per_row' , array(
        'default'           => '3',
        'transport'         => 'refresh',
        'sanitize_callback' => 'digital_books_sanitize_select',
    ) );

    $wp_customize->add_control('digital_books_products_per_row', array(
        'label' => __( 'Product per row', 'digital-books' ),
        'section'  => 'digital_books_general_settings',
        'type'     => 'select',
        'choices'  => array(
            '2' => '2',
            '3' => '3',
            '4' => '4',
        ),
    ) );

    $wp_customize->add_setting('digital_books_product_per_page',array(
        'default'   => '9',
        'sanitize_callback' => 'digital_books_sanitize_float'
    ));
    $wp_customize->add_control('digital_books_product_per_page',array(
        'label' => __('Product per page','digital-books'),
        'section'   => 'digital_books_general_settings',
        'type'      => 'number'
    ));

    //Woocommerce shop page Sidebar
    $wp_customize->add_setting('digital_books_woocommerce_shop_page_sidebar', array(
        'default' => true,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'digital_books_woocommerce_shop_page_sidebar',array(
        'label'          => __( 'Hide Shop Page Sidebar', 'digital-books' ),
        'section'        => 'digital_books_general_settings',
        'settings'       => 'digital_books_woocommerce_shop_page_sidebar',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('digital_books_shop_page_sidebar_layout',array(
        'default' => 'Right Sidebar',
        'sanitize_callback' => 'digital_books_sanitize_choices'
    ));
    $wp_customize->add_control('digital_books_shop_page_sidebar_layout',array(
        'type' => 'select',
        'label' => __('Woocommerce Shop Page Sidebar','digital-books'),
        'section' => 'digital_books_general_settings',
        'choices' => array(
            'Left Sidebar' => __('Left Sidebar','digital-books'),
            'Right Sidebar' => __('Right Sidebar','digital-books'),
        ),
    ) );

    $wp_customize->add_setting( 'digital_books_woo_product_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'digital_books_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'digital_books_woo_product_image_box_shadow', array(
        'label'       => esc_html__( 'Product Image Box Shadow','digital-books' ),
        'section'     => 'digital_books_general_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    $wp_customize->add_setting('digital_books_woocommerce_product_sale',array(
        'default' => 'Left',
        'sanitize_callback' => 'digital_books_sanitize_choices'
    ));
    $wp_customize->add_control('digital_books_woocommerce_product_sale',array(
        'label'       => esc_html__( 'Woocommerce Product Sale Positions','digital-books' ),
        'type' => 'radio',
        'section' => 'digital_books_general_settings',
        'choices' => array(
            'Right' => __('Right','digital-books'),
            'Left' => __('Left','digital-books'),
            'Center' => __('Center','digital-books')
        ),
    ) );

    $wp_customize->add_setting( 'digital_books_woo_product_sale_border_radius', array(
        'default'              => '',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'digital_books_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'digital_books_woo_product_sale_border_radius', array(
        'label'       => esc_html__( 'Woocommerce Product Sale Border Radius','digital-books' ),
        'section'     => 'digital_books_general_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    // Related Product
    $wp_customize->add_setting('digital_books_woocommerce_related_product_show_hide', array(
        'default' => true,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'digital_books_woocommerce_related_product_show_hide',array(
        'label'          => __( 'Show / Hide Related product', 'digital-books' ),
        'section'        => 'digital_books_general_settings',
        'settings'       => 'digital_books_woocommerce_related_product_show_hide',
        'type'           => 'checkbox',
    )));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_general_setting', array(
        'sanitize_callback' => 'Digital_Books_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Digital_Books_Customize_Pro_Version ( $wp_customize,'pro_version_general_setting', array(
        'section'     => 'digital_books_general_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'digital-books' ),
        'description' => esc_url( DIGITAL_BOOKS_URL ),
        'priority'    => 100
    )));

    // Post Settings
     $wp_customize->add_section('digital_books_post_settings',array(
        'title' => esc_html__('Post Settings','digital-books'),
        'priority'   =>40,
    ));

     $wp_customize->add_setting('digital_books_post_page_title',array(
        'sanitize_callback' => 'digital_books_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('digital_books_post_page_title',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Title', 'digital-books'),
        'section'     => 'digital_books_post_settings',
        'description' => esc_html__('Check this box to enable title on post page.', 'digital-books'),
    ));

    $wp_customize->add_setting('digital_books_post_page_meta',array(
        'sanitize_callback' => 'digital_books_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('digital_books_post_page_meta',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Meta', 'digital-books'),
        'section'     => 'digital_books_post_settings',
        'description' => esc_html__('Check this box to enable meta on post page.', 'digital-books'),
    ));

    $wp_customize->add_setting('digital_books_post_page_thumb',array(
        'sanitize_callback' => 'digital_books_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('digital_books_post_page_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Thumbnail', 'digital-books'),
        'section'     => 'digital_books_post_settings',
        'description' => esc_html__('Check this box to enable thumbnail on post page.', 'digital-books'),
    ));

    $wp_customize->add_setting( 'digital_books_post_page_image_border_radius', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'digital_books_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'digital_books_post_page_image_border_radius', array(
        'label'       => esc_html__( 'Post Page Image Border Radius','digital-books' ),
        'section'     => 'digital_books_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    $wp_customize->add_setting( 'digital_books_post_page_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'digital_books_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'digital_books_post_page_image_box_shadow', array(
        'label'       => esc_html__( 'Post Page Image Box Shadow','digital-books' ),
        'section'     => 'digital_books_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    $wp_customize->add_setting('digital_books_post_page_content',array(
        'sanitize_callback' => 'digital_books_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('digital_books_post_page_content',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Content', 'digital-books'),
        'section'     => 'digital_books_post_settings',
        'description' => esc_html__('Check this box to enable content on post page.', 'digital-books'),
    ));

    $wp_customize->add_setting('digital_books_post_page_cat',array(
        'sanitize_callback' => 'digital_books_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('digital_books_post_page_cat',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Post Page Category and Tags', 'digital-books'),
        'section'     => 'digital_books_post_settings',
        'description' => esc_html__('Check this box to enable category and tags on post page.', 'digital-books'),
    ));

    $wp_customize->add_setting('digital_books_single_post_thumb',array(
        'sanitize_callback' => 'digital_books_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('digital_books_single_post_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Thumbnail', 'digital-books'),
        'section'     => 'digital_books_post_settings',
        'description' => esc_html__('Check this box to enable post thumbnail on single post.', 'digital-books'),
    ));

    $wp_customize->add_setting( 'digital_books_single_post_page_image_border_radius', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'digital_books_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'digital_books_single_post_page_image_border_radius', array(
        'label'       => esc_html__( 'Single Post Page Image Border Radius','digital-books' ),
        'section'     => 'digital_books_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    $wp_customize->add_setting( 'digital_books_single_post_page_image_box_shadow', array(
        'default'              => '0',
        'transport'            => 'refresh',
        'sanitize_callback'    => 'digital_books_sanitize_number_range'
    ) );
    $wp_customize->add_control( 'digital_books_single_post_page_image_box_shadow', array(
        'label'       => esc_html__( 'Single Post Page Image Box Shadow','digital-books' ),
        'section'     => 'digital_books_post_settings',
        'type'        => 'range',
        'input_attrs' => array(
            'step'             => 1,
            'min'              => 1,
            'max'              => 50,
        ),
    ) );

    $wp_customize->add_setting('digital_books_single_post_meta',array(
        'sanitize_callback' => 'digital_books_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('digital_books_single_post_meta',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Meta', 'digital-books'),
        'section'     => 'digital_books_post_settings',
        'description' => esc_html__('Check this box to enable single post meta such as post date, author, category, comment etc.', 'digital-books'),
    ));

    $wp_customize->add_setting('digital_books_single_post_title',array(
            'sanitize_callback' => 'digital_books_sanitize_checkbox',
            'default'           => 1,
    ));
    $wp_customize->add_control('digital_books_single_post_title',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Title', 'digital-books'),
        'section'     => 'digital_books_post_settings',
        'description' => esc_html__('Check this box to enable title on single post.', 'digital-books'),
    ));

    $wp_customize->add_setting('digital_books_single_post_page_content',array(
        'sanitize_callback' => 'digital_books_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('digital_books_single_post_page_content',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Page Content', 'digital-books'),
        'section'     => 'digital_books_post_settings',
        'description' => esc_html__('Check this box to enable content on single post page.', 'digital-books'),
    ));

    $wp_customize->add_setting('digital_books_single_post_cat',array(
        'sanitize_callback' => 'digital_books_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('digital_books_single_post_cat',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Post Category And Tags', 'digital-books'),
        'section'     => 'digital_books_post_settings',
        'description' => esc_html__('Check this box to enable post category and tags on single post.', 'digital-books'),
    ));

    $wp_customize->add_setting('digital_books_single_post_navigation_show_hide',array(
        'default' => true,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control('digital_books_single_post_navigation_show_hide',array(
        'type' => 'checkbox',
        'label' => __('Show / Hide Post Navigation','digital-books'),
        'section' => 'digital_books_post_settings',
    ));

    $wp_customize->add_setting('digital_books_single_post_comment_title',array(
        'default'=> 'Leave a Reply',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('digital_books_single_post_comment_title',array(
        'label' => __('Add Comment Title','digital-books'),
        'input_attrs' => array(
        'placeholder' => __( 'Leave a Reply', 'digital-books' ),
        ),
        'section'=> 'digital_books_post_settings',
        'type'=> 'text'
    ));

    $wp_customize->add_setting('digital_books_single_post_comment_btn_text',array(
        'default'=> 'Post Comment',
        'sanitize_callback' => 'sanitize_text_field'
    ));

    $wp_customize->add_control('digital_books_single_post_comment_btn_text',array(
        'label' => __('Add Comment Button Text','digital-books'),
        'input_attrs' => array(
            'placeholder' => __( 'Post Comment', 'digital-books' ),
        ),
        'section'=> 'digital_books_post_settings',
        'type'=> 'text'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_post_setting', array(
        'sanitize_callback' => 'Digital_Books_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Digital_Books_Customize_Pro_Version ( $wp_customize,'pro_version_post_setting', array(
        'section'     => 'digital_books_post_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'digital-books' ),
        'description' => esc_url( DIGITAL_BOOKS_URL ),
        'priority'    => 100
    )));

    // Page Settings
    $wp_customize->add_section('digital_books_page_settings',array(
        'title' => esc_html__('Page Settings','digital-books'),
        'priority'   =>50,
    ));

    $wp_customize->add_setting('digital_books_single_page_title',array(
            'sanitize_callback' => 'digital_books_sanitize_checkbox',
            'default'           => 1,
    ));
    $wp_customize->add_control('digital_books_single_page_title',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Page Title', 'digital-books'),
        'section'     => 'digital_books_page_settings',
        'description' => esc_html__('Check this box to enable title on single page.', 'digital-books'),
    ));

    $wp_customize->add_setting('digital_books_single_page_thumb',array(
        'sanitize_callback' => 'digital_books_sanitize_checkbox',
        'default'           => 1,
    ));
    $wp_customize->add_control('digital_books_single_page_thumb',array(
        'type'        => 'checkbox',
        'label'       => esc_html__('Enable Single Page Thumbnail', 'digital-books'),
        'section'     => 'digital_books_page_settings',
        'description' => esc_html__('Check this box to enable page thumbnail on single page.', 'digital-books'),
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_single_page_setting', array(
        'sanitize_callback' => 'Digital_Books_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Digital_Books_Customize_Pro_Version ( $wp_customize,'pro_version_single_page_setting', array(
        'section'     => 'digital_books_page_settings',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'digital-books' ),
        'description' => esc_url( DIGITAL_BOOKS_URL ),
        'priority'    => 100
    )));

    // Theme Color
    $wp_customize->add_section('digital_books_color_option',array(
        'title' => esc_html__('Theme Color','digital-books'),
        'priority'   => 10,
    ));

    $wp_customize->add_setting( 'digital_books_theme_color', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'digital_books_theme_color', array(
        'label' => esc_html__('First Color Option','digital-books'),
        'section' => 'digital_books_color_option',
        'settings' => 'digital_books_theme_color'
    )));

    $wp_customize->add_setting( 'digital_books_theme_color_2', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_hex_color'
    ));
    $wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'digital_books_theme_color_2', array(
        'label' => esc_html__('Second Color Option','digital-books'),
        'section' => 'digital_books_color_option',
        'settings' => 'digital_books_theme_color_2'
    )));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_color_option', array(
        'sanitize_callback' => 'Digital_Books_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Digital_Books_Customize_Pro_Version ( $wp_customize,'pro_version_color_option', array(
        'section'     => 'digital_books_color_option',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'digital-books' ),
        'description' => esc_url( DIGITAL_BOOKS_URL ),
        'priority'    => 100
    )));

    // Social Link
    $wp_customize->add_section('digital_books_social_link',array(
        'title' => esc_html__('Social Links','digital-books'),
    ));

    $wp_customize->add_setting('digital_books_social_on_of_setting', array(
        'default' => 0,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'digital_books_social_on_of_setting',array(
        'label'          => __( 'Show Social Icon', 'digital-books' ),
        'section'        => 'digital_books_social_link',
        'settings'       => 'digital_books_social_on_of_setting',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('digital_books_facebook_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('digital_books_facebook_icon',array(
        'label' => esc_html__('Add Facebook Icon','digital-books'),
        'section' => 'digital_books_social_link',
        'setting' => 'digital_books_facebook_icon',
        'type'  => 'text',
        'default' => 'fab fa-facebook-f',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-facebook-f','digital-books')
    ));

    $wp_customize->add_setting('digital_books_facebook_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('digital_books_facebook_url',array(
        'label' => esc_html__('Facebook Link','digital-books'),
        'section' => 'digital_books_social_link',
        'setting' => 'digital_books_facebook_url',
        'type'  => 'url'
    ));
    $wp_customize->add_setting('digital_books_twitter_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('digital_books_twitter_icon',array(
        'label' => esc_html__('Add Twitter Icon','digital-books'),
        'section' => 'digital_books_social_link',
        'setting' => 'digital_books_twitter_icon',
        'type'  => 'text',
        'default' => 'fab fa-twitter',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-twitter','digital-books')
    ));

    $wp_customize->add_setting('digital_books_twitter_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('digital_books_twitter_url',array(
        'label' => esc_html__('Twitter Link','digital-books'),
        'section' => 'digital_books_social_link',
        'setting' => 'digital_books_twitter_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('digital_books_intagram_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('digital_books_intagram_icon',array(
        'label' => esc_html__('Add Intagram Icon','digital-books'),
        'section' => 'digital_books_social_link',
        'setting' => 'digital_books_intagram_icon',
        'type'  => 'text',
        'default' => 'fab fa-instagram',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-instagram','digital-books')
    ));

    $wp_customize->add_setting('digital_books_intagram_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('digital_books_intagram_url',array(
        'label' => esc_html__('Intagram Link','digital-books'),
        'section' => 'digital_books_social_link',
        'setting' => 'digital_books_intagram_url',
        'type'  => 'url'
    ));

    $wp_customize->add_setting('digital_books_linkedin_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('digital_books_linkedin_icon',array(
        'label' => esc_html__('Add Linkedin Icon','digital-books'),
        'section' => 'digital_books_social_link',
        'setting' => 'digital_books_linkedin_icon',
        'type'  => 'text',
        'default' => 'fab fa-linkedin-in',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-linkedin-in','digital-books')
    ));

    $wp_customize->add_setting('digital_books_linkedin_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('digital_books_linkedin_url',array(
        'label' => esc_html__('Linkedin Link','digital-books'),
        'section' => 'digital_books_social_link',
        'setting' => 'digital_books_linkedin_url',
        'type'  => 'url'
    ));
    $wp_customize->add_setting('digital_books_pintrest_icon',array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('digital_books_pintrest_icon',array(
        'label' => esc_html__('Add Pinterest Icon','digital-books'),
        'section' => 'digital_books_social_link',
        'setting' => 'digital_books_pintrest_icon',
        'type'  => 'text',
        'default' => 'fab fa-pinterest-p',
        'description' =>  __('Select font awesome icons <a target="_blank" href="https://fontawesome.com/v5/search?m=free">Click Here</a> for select icon. for eg:-fab fa-pinterest-p','digital-books')
    ));

    $wp_customize->add_setting('digital_books_pintrest_url',array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw'
    ));
    $wp_customize->add_control('digital_books_pintrest_url',array(
        'label' => esc_html__('Pinterest Link','digital-books'),
        'section' => 'digital_books_social_link',
        'setting' => 'digital_books_pintrest_url',
        'type'  => 'url'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_social_setting', array(
        'sanitize_callback' => 'Digital_Books_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Digital_Books_Customize_Pro_Version ( $wp_customize,'pro_version_social_setting', array(
        'section'     => 'digital_books_social_link',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'digital-books' ),
        'description' => esc_url( DIGITAL_BOOKS_URL ),
        'priority'    => 100
    )));


    //Slider
    $wp_customize->add_section('digital_books_top_slider',array(
        'title' => esc_html__('Slider Settings','digital-books'),
        'description' => esc_html__('Here you have to add 3 different pages in below dropdown. Note: Image Dimensions 1400 x 550 px','digital-books')
    ));

    $wp_customize->add_setting('digital_books_top_slider_section_setting', array(
        'default' => 1,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'digital_books_top_slider_section_setting',array(
        'label'          => __( 'Enable Disable Slider', 'digital-books' ),
        'section'        => 'digital_books_top_slider',
        'settings'       => 'digital_books_top_slider_section_setting',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('digital_books_slider_loop', array(
        'default' => 0,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'digital_books_slider_loop',array(
        'label'          => __( 'On Of Slider Loop', 'digital-books' ),
        'section'        => 'digital_books_top_slider',
        'settings'       => 'digital_books_slider_loop',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('digital_books_slider_title_setting', array(
        'default' => 1,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'digital_books_slider_title_setting',array(
        'label'          => __( 'Enable Disable Slider Title', 'digital-books' ),
        'section'        => 'digital_books_top_slider',
        'settings'       => 'digital_books_slider_title_setting',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('digital_books_slider_content_setting', array(
        'default' => 1,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'digital_books_slider_content_setting',array(
        'label'          => __( 'Enable Disable Slider Content', 'digital-books' ),
        'section'        => 'digital_books_top_slider',
        'settings'       => 'digital_books_slider_content_setting',
        'type'           => 'checkbox',
    )));

    $wp_customize->add_setting('digital_books_slider_button_setting', array(
        'default' => 1,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'digital_books_slider_button_setting',array(
        'label'          => __( 'Enable Disable Slider Button', 'digital-books' ),
        'section'        => 'digital_books_top_slider',
        'settings'       => 'digital_books_slider_button_setting',
        'type'           => 'checkbox',
    )));

    for ( $digital_books_count = 1; $digital_books_count <= 3; $digital_books_count++ ) {

        $wp_customize->add_setting( 'digital_books_top_slider_page' . $digital_books_count, array(
            'default'           => '',
            'sanitize_callback' => 'digital_books_sanitize_dropdown_pages'
        ) );
        $wp_customize->add_control( 'digital_books_top_slider_page' . $digital_books_count, array(
            'label'    => __( 'Select Slide Page', 'digital-books' ),
            'description' => __('Slider image size (1400 x 550)','digital-books'),
            'section'  => 'digital_books_top_slider',
            'type'     => 'dropdown-pages'
        ) );
    }

    //Slider button text
    $wp_customize->add_setting('digital_books_slider_button_text',array(
        'default'=> '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('digital_books_slider_button_text',array(
        'label' => __('Slider Button Text','digital-books'),
        'section'=> 'digital_books_top_slider',
        'type'=> 'text'
    ));

    //Opacity
    $wp_customize->add_setting('digital_books_slider_opacity_color',array(
      'default'              => '',
      'sanitize_callback' => 'digital_books_sanitize_choices'
    ));

    $wp_customize->add_control( 'digital_books_slider_opacity_color', array(
    'label'       => esc_html__( 'Slider Image Opacity','digital-books' ),
    'section'     => 'digital_books_top_slider',
    'type'        => 'select',
    'choices' => array(
      '0' =>  esc_attr('0','digital-books'),
      '0.1' =>  esc_attr('0.1','digital-books'),
      '0.2' =>  esc_attr('0.2','digital-books'),
      '0.3' =>  esc_attr('0.3','digital-books'),
      '0.4' =>  esc_attr('0.4','digital-books'),
      '0.5' =>  esc_attr('0.5','digital-books'),
      '0.6' =>  esc_attr('0.6','digital-books'),
      '0.7' =>  esc_attr('0.7','digital-books'),
      '0.8' =>  esc_attr('0.8','digital-books'),
      '0.9' =>  esc_attr('0.9','digital-books')
    ),
    ));

    //Slider height
    $wp_customize->add_setting('digital_books_slider_img_height',array(
        'default'=> '',
        'sanitize_callback' => 'sanitize_text_field'
    ));
    $wp_customize->add_control('digital_books_slider_img_height',array(
        'label' => __('Slider Height','digital-books'),
        'description'   => __('Add the slider height in px(eg. 500px).','digital-books'),
        'input_attrs' => array(
            'placeholder' => __( '500px', 'digital-books' ),
        ),
        'section'=> 'digital_books_top_slider',
        'type'=> 'text'
    ));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_slider_setting', array(
        'sanitize_callback' => 'Digital_Books_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Digital_Books_Customize_Pro_Version ( $wp_customize,'pro_version_slider_setting', array(
        'section'     => 'digital_books_top_slider',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'digital-books' ),
        'description' => esc_url( DIGITAL_BOOKS_URL ),
        'priority'    => 100
    )));

    //Featured Product
    $wp_customize->add_section('digital_books_home_product_category',array(
        'title' => esc_html__('Featured Product','digital-books'),
        'description' => esc_html__('Here you have to select product category which will display perticular featured product in the home page.','digital-books')
    ));

    $wp_customize->add_setting('digital_books_product_section_setting', array(
        'default' => 1,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control( new WP_Customize_Control($wp_customize,'digital_books_product_section_setting',array(
        'label'          => __( 'Enable Disable Product', 'digital-books' ),
        'section'        => 'digital_books_home_product_category',
        'settings'       => 'digital_books_product_section_setting',
        'type'           => 'checkbox',
    )));

    $digital_books_args = array(
       'type'                     => 'product',
        'child_of'                 => 0,
        'parent'                   => '',
        'orderby'                  => 'term_group',
        'order'                    => 'ASC',
        'hide_empty'               => false,
        'hierarchical'             => 1,
        'number'                   => '',
        'taxonomy'                 => 'product_cat',
        'pad_counts'               => false
    );
    $categories = get_categories( $digital_books_args );
    $cats = array();
    $i = 0;
    foreach($categories as $category){
        if($i==0){
            $default = $category->slug;
            $i++;
        }
        $cats[$category->slug] = $category->name;
    }
    $wp_customize->add_setting('digital_books_home_product',array(
        'sanitize_callback' => 'digital_books_sanitize_select',
    ));
    $wp_customize->add_control('digital_books_home_product',array(
        'type'    => 'select',
        'choices' => $cats,
        'label' => __('Select Product Category','digital-books'),
        'section' => 'digital_books_home_product_category',
    ));

    for ( $i = 1; $i <= 4; $i++ ) {
        $wp_customize->add_setting('digital_books_home_product_number'.$i,array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control('digital_books_home_product_number'.$i,array(
            'label' => esc_html__('Number','digital-books'),
            'description' => esc_html__('Add Counter Number','digital-books'),
            'section' => 'digital_books_home_product_category',
            'setting' => 'digital_books_home_product_number',
            'type'    => 'text'
        ));
        $wp_customize->add_setting('digital_books_home_product_text'.$i,array(
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field'
        ));
        $wp_customize->add_control('digital_books_home_product_text'.$i,array(
            'label' => esc_html__('Text','digital-books'),
            'description' => esc_html__('Add Counter Text','digital-books'),
            'section' => 'digital_books_home_product_category',
            'setting' => 'digital_books_home_product_text',
            'type'    => 'text'
        ));
    }

    // Pro Version
    $wp_customize->add_setting( 'pro_version_product_setting', array(
        'sanitize_callback' => 'Digital_Books_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Digital_Books_Customize_Pro_Version ( $wp_customize,'pro_version_product_setting', array(
        'section'     => 'digital_books_home_product_category',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'digital-books' ),
        'description' => esc_url( DIGITAL_BOOKS_URL ),
        'priority'    => 100
    )));

    // Footer
    $wp_customize->add_section('digital_books_site_footer_section', array(
        'title' => esc_html__('Footer', 'digital-books'),
    ));

    $wp_customize->add_setting('digital_books_show_hide_footer',array(
        'default' => true,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control('digital_books_show_hide_footer',array(
        'type' => 'checkbox',
        'label' => __('Show / Hide Footer','digital-books'),
        'section' => 'digital_books_site_footer_section',
        'priority' => 1,
    ));

    $wp_customize->add_setting('digital_books_footer_background_color', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'digital_books_footer_background_color', array(
        'label'    => __('Footer Background Color', 'digital-books'),
        'section'  => 'digital_books_site_footer_section',
    )));

     $wp_customize->add_setting('digital_books_footer_bg_image',array(
        'default'   => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control( new WP_Customize_Image_Control($wp_customize,'digital_books_footer_bg_image',array(
        'label' => __('Footer Background Image','digital-books'),
        'section' => 'digital_books_site_footer_section',
    )));

    $wp_customize->add_setting('digital_books_footer_bg_image_position',array(
        'default'=> 'scroll',
        'sanitize_callback' => 'digital_books_sanitize_choices'
    ));
    $wp_customize->add_control('digital_books_footer_bg_image_position',array(
        'type' => 'select',
        'label' => __('Footer Background Image Position','digital-books'),
        'choices' => array(
            'fixed' => __('fixed','digital-books'),
            'scroll' => __('scroll','digital-books'),
        ),
        'section'=> 'digital_books_site_footer_section',
    ));

    $wp_customize->add_setting('digital_books_footer_widget_heading_alignment',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'digital_books_sanitize_choices'
    ));
    $wp_customize->add_control('digital_books_footer_widget_heading_alignment',array(
        'type' => 'select',
        'label' => __('Footer Widget Heading Alignment','digital-books'),
        'section' => 'digital_books_site_footer_section',
        'choices' => array(
            'Left' => __('Left','digital-books'),
            'Center' => __('Center','digital-books'),
            'Right' => __('Right','digital-books')
        ),
    ) );

    $wp_customize->add_setting('digital_books_footer_widget_content_alignment',array(
        'default' => 'Left',
        'transport' => 'refresh',
        'sanitize_callback' => 'digital_books_sanitize_choices'
    ));
    $wp_customize->add_control('digital_books_footer_widget_content_alignment',array(
        'type' => 'select',
        'label' => __('Footer Widget Content Alignment','digital-books'),
        'section' => 'digital_books_site_footer_section',
        'choices' => array(
            'Left' => __('Left','digital-books'),
            'Center' => __('Center','digital-books'),
            'Right' => __('Right','digital-books')
        ),
    ) );

    $wp_customize->add_setting('digital_books_show_hide_copyright',array(
        'default' => true,
        'sanitize_callback' => 'digital_books_sanitize_checkbox'
    ));
    $wp_customize->add_control('digital_books_show_hide_copyright',array(
        'type' => 'checkbox',
        'label' => __('Show / Hide Copyright','digital-books'),
        'section' => 'digital_books_site_footer_section',
    ));

    $wp_customize->add_setting('digital_books_footer_text_setting', array(
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('digital_books_footer_text_setting', array(
        'label' => esc_html__('Replace the copyright text', 'digital-books'),
        'section' => 'digital_books_site_footer_section',
        'type' => 'text',
    ));

    $wp_customize->add_setting('digital_books_copyright_content_alignment',array(
        'default' => 'Right',
        'transport' => 'refresh',
        'sanitize_callback' => 'digital_books_sanitize_choices'
    ));
    $wp_customize->add_control('digital_books_copyright_content_alignment',array(
        'type' => 'select',
        'label' => __('Copyright Content Alignment','digital-books'),
        'section' => 'digital_books_site_footer_section',
        'choices' => array(
            'Left' => __('Left','digital-books'),
            'Center' => __('Center','digital-books'),
            'Right' => __('Right','digital-books')
        ),
    ) );

    $wp_customize->add_setting('digital_books_copyright_background_color', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_hex_color',
    ));
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'digital_books_copyright_background_color', array(
        'label'    => __('Copyright Background Color', 'digital-books'),
        'section'  => 'digital_books_site_footer_section',
    )));

    // Pro Version
    $wp_customize->add_setting( 'pro_version_footer_setting', array(
        'sanitize_callback' => 'Digital_Books_sanitize_custom_control'
    ));
    $wp_customize->add_control( new Digital_Books_Customize_Pro_Version ( $wp_customize,'pro_version_footer_setting', array(
        'section'     => 'digital_books_site_footer_section',
        'type'        => 'pro_options',
        'label'       => esc_html__( 'Customizer Options', 'digital-books' ),
        'description' => esc_url( DIGITAL_BOOKS_URL ),
        'priority'    => 100
    )));
}
add_action('customize_register', 'digital_books_customize_register');

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function digital_books_customize_partial_blogname(){
    bloginfo('name');
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function digital_books_customize_partial_blogdescription(){
    bloginfo('description');
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function digital_books_customize_preview_js(){
    wp_enqueue_script('digital-books-customizer', esc_url(get_template_directory_uri()) . '/assets/js/customizer.js', array('customize-preview'), '20151215', true);
}
add_action('customize_preview_init', 'digital_books_customize_preview_js');


/*
** Load dynamic logic for the customizer controls area.
*/
function digital_books_panels_js() {
    wp_enqueue_style( 'digital-books-customizer-layout-css', get_theme_file_uri( '/assets/css/customizer-layout.css' ) );
    wp_enqueue_script( 'digital-books-customize-layout', get_theme_file_uri( '/assets/js/customize-layout.js' ), array(), '1.2', true );
}
add_action( 'customize_controls_enqueue_scripts', 'digital_books_panels_js' );

