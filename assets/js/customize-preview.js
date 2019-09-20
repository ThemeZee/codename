/**
 * Customizer Live Preview
 *
 * Reloads changes on Theme Customizer Preview asynchronously for better usability
 *
 * @package Codename
 */

( function( $ ) {

	// Site Title textfield.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );

	// Site Description textfield.
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Site Title checkbox.
	wp.customize( 'codename_theme_options[site_title]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.site-title' );
			} else {
				showElement( '.site-title' );
			}
		} );
	} );

	// Site Description checkbox.
	wp.customize( 'codename_theme_options[site_description]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				hideElement( '.site-description' );
			} else {
				showElement( '.site-description' );
			}
		} );
	} );

	// Theme Layout.
	wp.customize( 'codename_theme_options[theme_layout]', function( value ) {
		value.bind( function( newval ) {
			if ( 'wide' === newval ) {
				$( 'body' ).addClass( 'wide-theme-layout' );
			} else {
				$( 'body' ).removeClass( 'wide-theme-layout' );
			}
		} );
	} );

	// Header Layout.
	wp.customize( 'codename_theme_options[header_layout]', function( value ) {
		value.bind( function( newval ) {
			if ( 'vertical' === newval ) {
				$( 'body' ).addClass( 'vertical-header-layout' );
			} else {
				$( 'body' ).removeClass( 'vertical-header-layout' );
			}
		} );
	} );

	// Blog Layout.
	wp.customize( 'codename_theme_options[blog_layout]', function( value ) {
		value.bind( function( newval ) {
			$( 'body' ).removeClass( 'blog-layout-horizontal-list' );
			$( 'body' ).removeClass( 'blog-layout-horizontal-list-alt' );
			$( 'body' ).removeClass( 'blog-layout-vertical-list' );
			$( 'body' ).removeClass( 'blog-layout-two-column-grid' );
			$( 'body' ).removeClass( 'blog-layout-three-column-grid' );

			if ( 'horizontal-list' === newval || 'horizontal-list-alt' === newval ) {
				$( 'body' ).addClass( 'blog-layout-horizontal-list' );
			} else if ( 'vertical-list' === newval || 'vertical-list-alt' === newval ) {
				$( 'body' ).addClass( 'blog-layout-vertical-list' );
			} else if ( 'two-column-grid' === newval ) {
				$( 'body' ).addClass( 'blog-layout-two-column-grid' );
			} else if ( 'three-column-grid' === newval ) {
				$( 'body' ).addClass( 'blog-layout-three-column-grid' );
			}

			if ( 'horizontal-list-alt' === newval ) {
				$( 'body' ).addClass( 'blog-layout-horizontal-list-alt' );
			}
		} );
	} );

	// Read More Link textfield.
	wp.customize( 'codename_theme_options[read_more_link]', function( value ) {
		value.bind( function( to ) {
			$( 'a.more-link' ).text( to );
		} );
	} );

	// Post Date checkbox.
	wp.customize( 'codename_theme_options[meta_date]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				$( 'body' ).addClass( 'date-hidden' );
			} else {
				$( 'body' ).removeClass( 'date-hidden' );
			}
		} );
	} );

	// Post Author checkbox.
	wp.customize( 'codename_theme_options[meta_author]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				$( 'body' ).addClass( 'author-hidden' );
			} else {
				$( 'body' ).removeClass( 'author-hidden' );
			}
		} );
	} );

	// Post Comments checkbox.
	wp.customize( 'codename_theme_options[meta_comments]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				$( 'body' ).addClass( 'comments-hidden' );
			} else {
				$( 'body' ).removeClass( 'comments-hidden' );
			}
		} );
	} );

	// Post Category checkbox.
	wp.customize( 'codename_theme_options[meta_categories]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				$( 'body' ).addClass( 'categories-hidden' );
			} else {
				$( 'body' ).removeClass( 'categories-hidden' );
			}
		} );
	} );

	// Post Tags checkbox.
	wp.customize( 'codename_theme_options[meta_tags]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				$( 'body' ).addClass( 'tags-hidden' );
			} else {
				$( 'body' ).removeClass( 'tags-hidden' );
			}
		} );
	} );

	// Post Navigation checkbox.
	wp.customize( 'codename_theme_options[post_navigation]', function( value ) {
		value.bind( function( newval ) {
			if ( false === newval ) {
				$( 'body' ).addClass( 'post-navigation-hidden' );
			} else {
				$( 'body' ).removeClass( 'post-navigation-hidden' );
			}
		} );
	} );

	// Featured Header Image checkbox.
	wp.customize( 'codename_theme_options[post_image_single]', function( value ) {
		value.bind( function( newval ) {
			if ( 'header-image' !== newval ) {
				$( 'body' ).addClass( 'single-post-header-image-hidden' );
			} else {
				$( 'body' ).removeClass( 'single-post-header-image-hidden' );
			}
		} );
	} );

	function hideElement( element ) {
		$( element ).css({
			clip: 'rect(1px, 1px, 1px, 1px)',
			position: 'absolute',
			width: '1px',
			height: '1px',
			overflow: 'hidden',
		});
	}

	function showElement( element ) {
		$( element ).css({
			clip: 'auto',
			position: 'relative',
			width: 'auto',
			height: 'auto',
			overflow: 'visible',
		});
	}

} )( jQuery );
