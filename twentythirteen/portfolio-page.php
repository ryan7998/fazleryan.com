<?php

/*
Template Name: Page Of Posts
*/
/* This example is for a child theme of Twenty Thirteen: 
*  You'll need to adapt it the HTML structure of your own theme.
*/
get_header(); ?>
	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
			<header class="entry-header"><h1><?php the_title(); ?></h1></header>
			<div class="entry-content">
        <?php 
		$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
		$args = array(
			'category_name' => 'portfolio', 
			'paged' => $paged,
			'post_status'      => 'publish'
		);
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) :
			$count = 0;
			while ( $the_query->have_posts() ) : $the_query->the_post();
			$url_str = $the_query->posts[$count]->post_content;
			preg_match_all('#\bhttps?://[^\s()<>]+(?:\([\w\d]+\)|([^[:punct:]\s]|/))#', $url_str, $string);
			$url = $string[0][0];
			$count++;
			
		?>
		 <div class="post widget">
			<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?> </a></h2>
			<a class="portfolio-left-bar" href="<?php print $url; ?>" title="<?php the_title_attribute(); ?>">
				<?php the_post_thumbnail('medium'); ?>
				<div class="portfolio-left-bar-text"><h3>Take me to <?php the_title(); ?>'s Site </h3></div>	
			</a>
			<div class="portfolio-right-bar">
				<?php the_excerpt(); ?>
				<a href="<?php the_permalink(); ?>"><h5>Find Technologies used</h5></a>
			</div>
		<div class="clear"></div>
		 </div> <!-- closes the post div -->


		<?php endwhile; ?>
		<?php wp_reset_postdata(); ?>
		<?php endif; ?>	
		
		<div class="post widget"><a href="/fazle-ryan/skills-portfolio/">See Other Portfolio Items</a></div>
		<?php twentythirteen_paging_nav(); ?>
			</div> <!-- closes the entry content -->
		</div><!-- #content -->
	</div><!-- #primary -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>