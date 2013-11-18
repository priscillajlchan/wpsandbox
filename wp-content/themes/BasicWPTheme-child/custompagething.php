<?php
/* 
	Template Name: Priscilla's Custom Page */

get_header(); ?>

<div id="main">
	
	<section id="content">

		<p>CHANGE!</p>
		
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			
		<article <?php post_class() ?> id="post-<?php the_ID(); ?>">
			
			<h1><?php the_title(); ?></h1>
			
			
			<?php the_content(); ?>
			
		</article>
		
		<?php endwhile; endif; ?>
		
	</section><!-- #content -->

<?php get_sidebar(); ?>

	 $meta_quote = get_post_meta($post->ID, 'quotation', true);
        if ($meta_quote) { 
        echo "<img class='callout' src='wp-content/themes/BasicWPTheme-child/assets/quote.png' alt='callout'>";        
        echo "<p class='side-quote'>".$meta_quote."</p>"; 
        } else { 
        echo "You forgot to insert a quote…";
        }
?>

</div><!-- #main -->

<?php get_footer(); ?>