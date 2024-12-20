<?php

    $digital_books_theme_css= "";

    /*--------------------------- Scroll to top -------------------*/

    $digital_books_scroll_position = get_theme_mod( 'digital_books_scroll_top_position','Right');
    if($digital_books_scroll_position == 'Right'){
        $digital_books_theme_css .='#button{';
            $digital_books_theme_css .='right: 20px;';
        $digital_books_theme_css .='}';
    }else if($digital_books_scroll_position == 'Left'){
        $digital_books_theme_css .='#button{';
            $digital_books_theme_css .='left: 20px;';
        $digital_books_theme_css .='}';
    }else if($digital_books_scroll_position == 'Center'){
        $digital_books_theme_css .='#button{';
            $digital_books_theme_css .='right: 50%;left: 50%;';
        $digital_books_theme_css .='}';
    }

    /*--------------------------- Scroll To Top Border Radius -------------------*/

    $digital_books_scroll_to_top_border_radius = get_theme_mod('digital_books_scroll_to_top_border_radius');
    $digital_books_scroll_bg_color = get_theme_mod('digital_books_scroll_bg_color');
    $digital_books_scroll_color = get_theme_mod('digital_books_scroll_color');
    $digital_books_scroll_font_size = get_theme_mod('digital_books_scroll_font_size');
    if($digital_books_scroll_to_top_border_radius != false || $digital_books_scroll_bg_color != false || $digital_books_scroll_color != false || $digital_books_scroll_font_size != false){
        $digital_books_theme_css .='#colophon a#button{';
            $digital_books_theme_css .='border-radius: '.esc_attr($digital_books_scroll_to_top_border_radius).'px; background-color: '.esc_attr($digital_books_scroll_bg_color).'; color: '.esc_attr($digital_books_scroll_color).' !important; font-size: '.esc_attr($digital_books_scroll_font_size).'px;';
        $digital_books_theme_css .='}';
    }

    /*--------------------------- Slider Opacity -------------------*/

    $digital_books_theme_lay = get_theme_mod( 'digital_books_slider_opacity_color','');
    if($digital_books_theme_lay == '0'){
        $digital_books_theme_css .='.slider-box img{';
            $digital_books_theme_css .='opacity:0';
        $digital_books_theme_css .='}';
        }else if($digital_books_theme_lay == '0.1'){
        $digital_books_theme_css .='.slider-box img{';
            $digital_books_theme_css .='opacity:0.1';
        $digital_books_theme_css .='}';
        }else if($digital_books_theme_lay == '0.2'){
        $digital_books_theme_css .='.slider-box img{';
            $digital_books_theme_css .='opacity:0.2';
        $digital_books_theme_css .='}';
        }else if($digital_books_theme_lay == '0.3'){
        $digital_books_theme_css .='.slider-box img{';
            $digital_books_theme_css .='opacity:0.3';
        $digital_books_theme_css .='}';
        }else if($digital_books_theme_lay == '0.4'){
        $digital_books_theme_css .='.slider-box img{';
            $digital_books_theme_css .='opacity:0.4';
        $digital_books_theme_css .='}';
        }else if($digital_books_theme_lay == '0.5'){
        $digital_books_theme_css .='.slider-box img{';
            $digital_books_theme_css .='opacity:0.5';
        $digital_books_theme_css .='}';
        }else if($digital_books_theme_lay == '0.6'){
        $digital_books_theme_css .='.slider-box img{';
            $digital_books_theme_css .='opacity:0.6';
        $digital_books_theme_css .='}';
        }else if($digital_books_theme_lay == '0.7'){
        $digital_books_theme_css .='.slider-box img{';
            $digital_books_theme_css .='opacity:0.7';
        $digital_books_theme_css .='}';
        }else if($digital_books_theme_lay == '0.8'){
        $digital_books_theme_css .='.slider-box img{';
            $digital_books_theme_css .='opacity:0.8';
        $digital_books_theme_css .='}';
        }else if($digital_books_theme_lay == '0.9'){
        $digital_books_theme_css .='.slider-box img{';
            $digital_books_theme_css .='opacity:0.9';
        $digital_books_theme_css .='}';
        }

    /*---------------------------Slider Height ------------*/

    $digital_books_slider_img_height = get_theme_mod('digital_books_slider_img_height');
    if($digital_books_slider_img_height != false){
        $digital_books_theme_css .='#top-slider .owl-carousel .owl-item img{';
            $digital_books_theme_css .='height: '.esc_attr($digital_books_slider_img_height).';';
        $digital_books_theme_css .='}';
    }

    /*--------------------------- Post Page Image Border Radius -------------------*/

    $digital_books_post_page_image_border_radius = get_theme_mod('digital_books_post_page_image_border_radius', 0);
    if($digital_books_post_page_image_border_radius != false){
        $digital_books_theme_css .='.article-box img{';
            $digital_books_theme_css .='border-radius: '.esc_attr($digital_books_post_page_image_border_radius).'px;';
        $digital_books_theme_css .='}';
    }

    /*--------------------------- Post Page Image Box Shadow -------------------*/

    $digital_books_post_page_image_box_shadow = get_theme_mod('digital_books_post_page_image_box_shadow',0);
    if($digital_books_post_page_image_box_shadow != false){
        $digital_books_theme_css .='.article-box img{';
            $digital_books_theme_css .='box-shadow: '.esc_attr($digital_books_post_page_image_box_shadow).'px '.esc_attr($digital_books_post_page_image_box_shadow).'px '.esc_attr($digital_books_post_page_image_box_shadow).'px #cccccc;';
        $digital_books_theme_css .='}';
    }

    /*---------------- Single post Settings ------------------*/

    $digital_books_single_post_navigation_show_hide = get_theme_mod('digital_books_single_post_navigation_show_hide',true);
    if($digital_books_single_post_navigation_show_hide != true){
        $digital_books_theme_css .='.nav-links{';
            $digital_books_theme_css .='display: none;';
        $digital_books_theme_css .='}';
    }

    /*--------------------------- Product Image Box Shadow -------------------*/

    $digital_books_woo_product_image_box_shadow = get_theme_mod('digital_books_woo_product_image_box_shadow',0);
    if($digital_books_woo_product_image_box_shadow != false){
        $digital_books_theme_css .='.woocommerce ul.products li.product a img{';
            $digital_books_theme_css .='box-shadow: '.esc_attr($digital_books_woo_product_image_box_shadow).'px '.esc_attr($digital_books_woo_product_image_box_shadow).'px '.esc_attr($digital_books_woo_product_image_box_shadow).'px #cccccc;';
        $digital_books_theme_css .='}';
    }

    /*--------------------------- Woocommerce Product Sale Positions -------------------*/

    $digital_books_product_sale = get_theme_mod( 'digital_books_woocommerce_product_sale','Right');
    if($digital_books_product_sale == 'Right'){
        $digital_books_theme_css .='.woocommerce ul.products li.product .onsale{';
            $digital_books_theme_css .='left: auto; right: 15px;';
        $digital_books_theme_css .='}';
    }else if($digital_books_product_sale == 'Left'){
        $digital_books_theme_css .='.woocommerce ul.products li.product .onsale{';
            $digital_books_theme_css .='left: 15px; right: auto;';
        $digital_books_theme_css .='}';
    }else if($digital_books_product_sale == 'Center'){
        $digital_books_theme_css .='.woocommerce ul.products li.product .onsale{';
            $digital_books_theme_css .='right: 50%;left: 50%;';
        $digital_books_theme_css .='}';
    }

    /*--------------------------- Woocommerce Product Border Radius -------------------*/

    $digital_books_woo_product_sale_border_radius = get_theme_mod('digital_books_woo_product_sale_border_radius');
    if($digital_books_woo_product_sale_border_radius != false){
        $digital_books_theme_css .='.woocommerce ul.products li.product .onsale{';
            $digital_books_theme_css .='border-radius: '.esc_attr($digital_books_woo_product_sale_border_radius).'px;';
        $digital_books_theme_css .='}';
    }

    /*--------------------------- Woocommerce Related Products -------------------*/

    $digital_books_woocommerce_related_product_show_hide = get_theme_mod('digital_books_woocommerce_related_product_show_hide',true);
    if($digital_books_woocommerce_related_product_show_hide != true){
        $digital_books_theme_css .='.related.products{';
            $digital_books_theme_css .='display: none;';
        $digital_books_theme_css .='}';
    }

    /*--------------------------- Footer background image -------------------*/

    $digital_books_footer_bg_image = get_theme_mod('digital_books_footer_bg_image');
    if($digital_books_footer_bg_image != false){
        $digital_books_theme_css .='#colophon, .footer-widgets{';
            $digital_books_theme_css .='background: url('.esc_attr($digital_books_footer_bg_image).');';
        $digital_books_theme_css .='}';
    }

    /*--------------------------- Footer Background Color -------------------*/

    $digital_books_footer_background_color = get_theme_mod('digital_books_footer_background_color');
    if($digital_books_footer_background_color != false){
        $digital_books_theme_css .='.footer-widgets{';
            $digital_books_theme_css .='background-color: '.esc_attr($digital_books_footer_background_color).' ;';
        $digital_books_theme_css .='}';
    }

    /*--------------------------- Single Post Page Image Box Shadow -------------------*/

    $digital_books_single_post_page_image_box_shadow = get_theme_mod('digital_books_single_post_page_image_box_shadow',0);
    if($digital_books_single_post_page_image_box_shadow != false){
        $digital_books_theme_css .='.single-post .entry-header img{';
            $digital_books_theme_css .='box-shadow: '.esc_attr($digital_books_single_post_page_image_box_shadow).'px '.esc_attr($digital_books_single_post_page_image_box_shadow).'px '.esc_attr($digital_books_single_post_page_image_box_shadow).'px #cccccc;';
        $digital_books_theme_css .='}';
    }

     /*--------------------------- Single Post Page Image Border Radius -------------------*/

    $digital_books_single_post_page_image_border_radius = get_theme_mod('digital_books_single_post_page_image_border_radius', 0);
    if($digital_books_single_post_page_image_border_radius != false){
        $digital_books_theme_css .='.single-post .entry-header img{';
            $digital_books_theme_css .='border-radius: '.esc_attr($digital_books_single_post_page_image_border_radius).'px;';
        $digital_books_theme_css .='}';
    }

    /*--------------------------- Footer Background Image Position -------------------*/

    $digital_books_footer_bg_image_position = get_theme_mod( 'digital_books_footer_bg_image_position','scroll');
    if($digital_books_footer_bg_image_position == 'fixed'){
        $digital_books_theme_css .='#colophon, .footer-widgets{';
            $digital_books_theme_css .='background-attachment: fixed !important; background-position: center !important;';
        $digital_books_theme_css .='}';
    }elseif ($digital_books_footer_bg_image_position == 'scroll'){
        $digital_books_theme_css .='#colophon, .footer-widgets{';
            $digital_books_theme_css .='background-attachment: scroll !important; background-position: center !important;';
        $digital_books_theme_css .='}';
    }

    /*--------------------------- Footer Widget Heading Alignment -------------------*/

    $digital_books_footer_widget_heading_alignment = get_theme_mod( 'digital_books_footer_widget_heading_alignment','Left');
    if($digital_books_footer_widget_heading_alignment == 'Left'){
        $digital_books_theme_css .='#colophon h5, h5.footer-column-widget-title{';
        $digital_books_theme_css .='text-align: left;';
        $digital_books_theme_css .='}';
    }else if($digital_books_footer_widget_heading_alignment == 'Center'){
        $digital_books_theme_css .='#colophon h5, h5.footer-column-widget-title{';
            $digital_books_theme_css .='text-align: center;';
        $digital_books_theme_css .='}';
    }else if($digital_books_footer_widget_heading_alignment == 'Right'){
        $digital_books_theme_css .='#colophon h5, h5.footer-column-widget-title{';
            $digital_books_theme_css .='text-align: right;';
        $digital_books_theme_css .='}';
    }

    /*--------------------------- Copyright Background Color -------------------*/

    $digital_books_copyright_background_color = get_theme_mod('digital_books_copyright_background_color');
    if($digital_books_copyright_background_color != false){
        $digital_books_theme_css .='.footer_info{';
            $digital_books_theme_css .='background-color: '.esc_attr($digital_books_copyright_background_color).' !important;';
        $digital_books_theme_css .='}';
    }

    /*--------------------------- Site Title And Tagline Color -------------------*/

    $digital_books_logo_title_color = get_theme_mod('digital_books_logo_title_color');
    if($digital_books_logo_title_color != false){
        $digital_books_theme_css .='p.site-title a, .navbar-brand a{';
            $digital_books_theme_css .='color: '.esc_attr($digital_books_logo_title_color).' !important;';
        $digital_books_theme_css .='}';
    }

    $digital_books_logo_tagline_color = get_theme_mod('digital_books_logo_tagline_color');
    if($digital_books_logo_tagline_color != false){
        $digital_books_theme_css .='.logo p.site-description, .navbar-brand p{';
            $digital_books_theme_css .='color: '.esc_attr($digital_books_logo_tagline_color).'  !important;';
        $digital_books_theme_css .='}';
    }

    /*--------------------------- Footer Widget Content Alignment -------------------*/

    $digital_books_footer_widget_content_alignment = get_theme_mod( 'digital_books_footer_widget_content_alignment','Left');
    if($digital_books_footer_widget_content_alignment == 'Left'){
        $digital_books_theme_css .='#colophon ul, #colophon p, .tagcloud, .widget{';
        $digital_books_theme_css .='text-align: left;';
        $digital_books_theme_css .='}';
    }else if($digital_books_footer_widget_content_alignment == 'Center'){
        $digital_books_theme_css .='#colophon ul, #colophon p, .tagcloud, .widget{';
            $digital_books_theme_css .='text-align: center;';
        $digital_books_theme_css .='}';
    }else if($digital_books_footer_widget_content_alignment == 'Right'){
        $digital_books_theme_css .='#colophon ul, #colophon p, .tagcloud, .widget{';
            $digital_books_theme_css .='text-align: right;';
        $digital_books_theme_css .='}';
    }

    /*--------------------------- Copyright Content Alignment -------------------*/

    $digital_books_copyright_content_alignment = get_theme_mod( 'digital_books_copyright_content_alignment','Right');
    if($digital_books_copyright_content_alignment == 'Left'){
        $digital_books_theme_css .='.footer-menu-left{';
        $digital_books_theme_css .='text-align: left;';
        $digital_books_theme_css .='}';
    }else if($digital_books_copyright_content_alignment == 'Center'){
        $digital_books_theme_css .='.footer-menu-left{';
            $digital_books_theme_css .='text-align: center;';
        $digital_books_theme_css .='}';
    }else if($digital_books_copyright_content_alignment == 'Right'){
        $digital_books_theme_css .='.footer-menu-left{';
            $digital_books_theme_css .='text-align: right;';
        $digital_books_theme_css .='}';
    }