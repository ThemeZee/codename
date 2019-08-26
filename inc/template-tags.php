<?php
/**
 * Template Tags
 *
 * This file contains several template functions which are used to print out specific HTML markup
 * in the theme. You can override these template functions within your child theme.
 *
 * @package Codename
 */

if ( ! function_exists( 'codename_site_title' ) ) :
	/**
	 * Displays the site title in the header area
	 */
	function codename_site_title() {

		if ( is_home() ) : ?>

			<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>

		<?php else : ?>

			<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>

		<?php
		endif;
	}
endif;


if ( ! function_exists( 'codename_site_description' ) ) :
	/**
	 * Displays the site description in the header area
	 */
	function codename_site_description() {

		$description = get_bloginfo( 'description', 'display' ); /* WPCS: xss ok. */

		if ( $description || is_customize_preview() ) :
			?>

			<p class="site-description"><?php echo $description; ?></p>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'codename_header_image' ) ) :
	/**
	 * Displays the custom header image below the navigation menu
	 */
	function codename_header_image() {

		// Display featured image as header image on single posts and pages.
		if ( is_single() && has_post_thumbnail() && 'header-image' === codename_get_option( 'post_image_single' )
			|| is_page() && has_post_thumbnail()
			|| is_single() && is_customize_preview() && has_post_thumbnail()
		) :
			?>

			<div id="headimg" class="header-image featured-header-image">

				<?php the_post_thumbnail( 'codename-featured-header-image' ); ?>

			</div>

			<?php
		elseif ( has_header_image() ) : // Display header image.
			?>

			<div id="headimg" class="header-image default-header-image">

				<img src="<?php header_image(); ?>" srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( get_custom_header()->attachment_id, 'full' ) ); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>">

			</div>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'codename_archive_header' ) ) :
	/**
	 * Displays the header title on archive pages.
	 */
	function codename_archive_header() {
		?>

		<header class="archive-header entry-header">

			<?php the_archive_title( '<h1 class="archive-title entry-title">', '</h1>' ); ?>
			<?php the_archive_description( '<div class="archive-description">', '</div>' ); ?>

		</header><!-- .archive-header -->

		<?php
	}
endif;


if ( ! function_exists( 'codename_search_header' ) ) :
	/**
	 * Displays the header title on search results.
	 */
	function codename_search_header() {
		?>

		<header class="search-header entry-header">

			<h1 class="search-title entry-title">
				<?php
				// translators: Search Results title.
				printf( esc_html__( 'Search Results for: %s', 'codename' ), '<span>' . get_search_query() . '</span>' );
				?>
			</h1>
			<?php get_search_form(); ?>

		</header><!-- .search-header -->

		<?php
	}
endif;


if ( ! function_exists( 'codename_post_image_archives' ) ) :
	/**
	 * Displays the featured image on archive posts.
	 */
	function codename_post_image_archives() {
		if ( ! has_post_thumbnail() ) {
			return;
		}

		// Set image size.
		$blog_layout = codename_get_option( 'blog_layout' );
		$image_size  = ( 'horizontal-list' === $blog_layout || 'horizontal-list-alt' === $blog_layout ) ? 'codename-horizontal-list-post' : 'post-thumbnail';

		// Display Post Thumbnail if activated.
		if ( true === codename_get_option( 'post_image_archives' ) && has_post_thumbnail() ) :
			?>

			<figure class="post-image post-image-archives">
				<a class="wp-post-image-link" href="<?php the_permalink(); ?>" rel="bookmark" aria-hidden="true">
					<?php the_post_thumbnail( $image_size ); ?>
				</a>
			</figure>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'codename_post_image_single' ) ) :
	/**
	 * Displays the featured image on single posts.
	 */
	function codename_post_image_single() {
		if ( ! has_post_thumbnail() ) {
			return;
		}
		?>

		<figure class="post-image post-image-single">
			<?php the_post_thumbnail(); ?>
		</figure>

		<?php
	}
endif;


if ( ! function_exists( 'codename_entry_meta' ) ) :
	/**
	 * Displays the date and author of a post
	 */
	function codename_entry_meta() {

		$postmeta  = codename_entry_date();
		$postmeta .= codename_entry_author();
		$postmeta .= codename_entry_categories();

		echo '<div class="entry-meta">' . $postmeta . '</div>';
	}
endif;


if ( ! function_exists( 'codename_entry_date' ) ) :
	/**
	 * Returns the post date
	 */
	function codename_entry_date() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$posted_on = sprintf(
			/* translators: %s: post date. */
			esc_html_x( 'Posted on %s', 'post date', 'codename' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);

		return '<span class="posted-on">' . $posted_on . '</span>';
	}
endif;


if ( ! function_exists( 'codename_entry_author' ) ) :
	/**
	 * Returns the post author
	 */
	function codename_entry_author() {

		$author_string = sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			// translators: post author link.
			esc_attr( sprintf( esc_html__( 'View all posts by %s', 'codename' ), get_the_author() ) ),
			esc_html( get_the_author() )
		);

		$posted_by = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'codename' ),
			$author_string
		);

		return '<span class="posted-by"> ' . $posted_by . '</span>';
	}
endif;


if ( ! function_exists( 'codename_entry_categories' ) ) :
	/**
	 * Displays the post categories
	 */
	function codename_entry_categories() {

		// Return early if post has no category.
		if ( ! has_category() ) {
			return;
		}

		$posted_in = sprintf(
			/* translators: %s: post category. */
			esc_html_x( 'in %s', 'post category', 'codename' ),
			get_the_category_list( ', ' )
		);

		return '<span class="posted-in"> ' . $posted_in . '</span>';
	}
endif;


if ( ! function_exists( 'codename_entry_tags' ) ) :
	/**
	 * Displays the post tags on single post view
	 */
	function codename_entry_tags() {
		// Get tags.
		$tag_list = get_the_tag_list( esc_html__( 'Tags: ', 'codename' ), ', ' );

		// Display tags.
		if ( $tag_list ) :
			echo '<p class="entry-tags">' . $tag_list . '</p>';
		endif;
	}
endif;


if ( ! function_exists( 'codename_more_link' ) ) :
	/**
	 * Displays the more link on posts
	 */
	function codename_more_link() {

		// Get Read More Text.
		$read_more = codename_get_option( 'read_more_link' );

		if ( '' !== $read_more || is_customize_preview() ) :
			?>

			<a href="<?php echo esc_url( get_permalink() ); ?>" class="more-link"><?php echo esc_html( $read_more ); ?></a>

			<?php
		endif;
	}
endif;


if ( ! function_exists( 'codename_pagination' ) ) :
	/**
	 * Displays pagination on archive pages
	 */
	function codename_pagination() {

		the_posts_pagination( array(
			'mid_size'  => 2,
			'prev_text' => '&laquo<span class="screen-reader-text">' . esc_html_x( 'Previous Posts', 'pagination', 'codename' ) . '</span>',
			'next_text' => '<span class="screen-reader-text">' . esc_html_x( 'Next Posts', 'pagination', 'codename' ) . '</span>&raquo;',
		) );
	}
endif;
