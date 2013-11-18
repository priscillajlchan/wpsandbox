<?php
/**
 * Master Template. This template will be used to display your blog posts and pages if page.php does not exist.
 *
 * @package blm_basic
 */

get_header(); ?>

<div id="main">
	
	<section id="content">
		
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			
			<h2><a href="<?php the_permalink() ?>" rel="bookmark"><?php the_title(); ?></a></h2>
			
			<?php the_date('F j, \'y', '<h2>Posted on:','</h2>', true); ?>

			<p class="post-date"><?php // echo get_the_date(); ?></p>

			<?php the_content( __( 'Read more', 'blm_basic' ) ); ?>

			<div class="post-line"></div>
				
			<?php get_template_part( 'inc/meta' ); ?>

			<?php 

			$meta_quote = get_post_meta($post->ID, 'quotation', true);
			if ($meta_quote) { 
				echo "<p>Quote: <strong>".$meta_quote."</strong></p>";
			}else{
				echo "you forgot to insert a quote";
			}
			?>

			<?php

			// $args = array( 'post_type' => 'testimonials', 'orderby' => 'rand',
			// 'posts_per_page' => '1');
			
			// $loop = new WP_Query( $args );

			// while ( $loop->have_posts() ) : $loop->the_post();
 		// 	//the_title();
 		// 	the_content();
			// endwhile;

			?> 

			<?php get_template_part('inc/meta'); ?>

		</article>
		
	<?php endwhile; endif; ?>
	
	<?php get_template_part( 'inc/nav' ); ?>
	
	</section><!-- #content -->


</div><!-- #main -->

<?php get_footer(); ?>