/*
** Scripts within the customizer controls window.
*/

(function( $ ) {
	wp.customize.bind( 'ready', function() {

		var optPrefix = '#customize-control-digital_books_options-';
		
		// Label
		function digital_books_customizer_label( id, title ) {

			// Colors

			if ( id === 'digital_books_theme_color' || id === 'header_textcolor' || id === 'background_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-digital_books_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Site Identity

			if ( id === 'custom_logo' || id === 'site_icon' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-digital_books_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// General Setting

			if ( id === 'digital_books_preloader_hide' || id === 'digital_books_sticky_header' || id === 'digital_books_scroll_hide' || id === 'digital_books_products_per_row' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-digital_books_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Woocommerce product sale Setting

			if ( id === 'digital_books_woocommerce_product_sale' || id === 'digital_books_woocommerce_related_product_show_hide') {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-digital_books_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

            // Social Icon

			if ( id === 'digital_books_facebook_icon' || id === 'digital_books_twitter_icon' || id === 'digital_books_intagram_icon'|| id === 'digital_books_linkedin_icon'|| id === 'digital_books_pintrest_icon' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-digital_books_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Slider

			if ( id === 'digital_books_top_slider_section_setting' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-digital_books_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Header Image

			if ( id === 'header_image' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-digital_books_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}
			
			// Featured Product

			if ( id === 'digital_books_product_section_setting' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-digital_books_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Footer

			if ( id === 'digital_books_show_hide_footer' || id === 'digital_books_show_hide_copyright') {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-digital_books_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Single Post Setting

			if ( id === 'digital_books_single_post_thumb' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-digital_books_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Single Post Comment Setting

			if ( id === 'digital_books_single_post_comment_title' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-digital_books_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Post Setting

			if ( id === 'digital_books_post_page_title' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-digital_books_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}

			// Page Setting

			if ( id === 'digital_books_single_page_title' ) {
				$( '#customize-control-'+ id ).before('<li class="tab-title customize-control">'+ title  +'</li>');
			} else {
				$( '#customize-control-digital_books_options-'+ id ).before('<li class="tab-title customize-control">'+ title +'</li>');
			}
			
		}

		// Colors
		digital_books_customizer_label( 'digital_books_theme_color', 'Theme Color' );
		digital_books_customizer_label( 'header_textcolor', 'Colors' );
		digital_books_customizer_label( 'background_image', 'Image' );

		// Site Identity
		digital_books_customizer_label( 'custom_logo', 'Logo Setup' );
		digital_books_customizer_label( 'site_icon', 'Favicon' );

		// General Setting
		digital_books_customizer_label( 'digital_books_preloader_hide', 'Preloader' );
		digital_books_customizer_label( 'digital_books_sticky_header', 'Sticky Header' );
		digital_books_customizer_label( 'digital_books_scroll_hide', 'Scroll To Top' );
		digital_books_customizer_label( 'digital_books_products_per_row', 'Woocommerce Setting' );
		digital_books_customizer_label( 'digital_books_woocommerce_product_sale', 'Woocommerce Product Sale' );
		digital_books_customizer_label( 'digital_books_woocommerce_related_product_show_hide', 'Woocommerce Related Products' );

		// Social Icon
		digital_books_customizer_label( 'digital_books_facebook_icon', 'Facebook' );
		digital_books_customizer_label( 'digital_books_twitter_icon', 'Twitter' );
		digital_books_customizer_label( 'digital_books_intagram_icon', 'Intagram' );
		digital_books_customizer_label( 'digital_books_linkedin_icon', 'Linkedin' );
		digital_books_customizer_label( 'digital_books_pintrest_icon', 'Pintrest' );

		//Slider
		digital_books_customizer_label( 'digital_books_top_slider_section_setting', 'Slider' );

		//Header Image
		digital_books_customizer_label( 'header_image', 'Header Image' );

		//Featured Product
		digital_books_customizer_label( 'digital_books_product_section_setting', 'Featured Product' );

		//Footer
		digital_books_customizer_label( 'digital_books_show_hide_footer', 'Footer' );
		digital_books_customizer_label( 'digital_books_show_hide_copyright', 'Copyright' );
	
		//Single Post Setting
		digital_books_customizer_label( 'digital_books_single_post_thumb', 'Single Post Setting' );
		digital_books_customizer_label( 'digital_books_single_post_comment_title', 'Single Post Comment' );

		// Post Setting
		digital_books_customizer_label( 'digital_books_post_page_title', 'Post Setting' );

		// Page Setting
		digital_books_customizer_label( 'digital_books_single_page_title', 'Page Setting' );

	});

})( jQuery );
