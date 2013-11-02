<?php
/*
Template Name: Homepage
*/
?>

<?php get_header(); ?>
			
			<div id="content">
			
				<div id="main" class="twelve columns" role="main">
					
					<article role="article">
					
						<?php

						$orbit_slider = of_get_option('orbit_slider');
						if ($orbit_slider){

						?>
						
						<header>
					
							<div id="featured">

								<?php
									global $post;
									$tmp_post = $post;
									$args = array( 'numberposts' => 5, 
										'taxonomy' => 'category',
										'field' => 'slug',
										'terms' => array( 'homepage-scroll' ));	
									$myposts = get_posts( $args );
									foreach( $myposts as $post ) :	setup_postdata($post); 
										$post_thumbnail_id = get_post_thumbnail_id();
										$featured_src = wp_get_attachment_image_src( $post_thumbnail_id, 'wpf-home-featured' );
								?>
								<img data-caption="#img_<?php echo $post_thumbnail_id; ?>" src="<?php echo $featured_src[0]; ?>" width="<?php echo $featured_src[1]; ?>" height="<?php echo $featured_src[2]; ?>"/>
								<!--<div style="background-color: #F2F2F2;">
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<?php the_excerpt(); ?>
									<p><a href="<?php the_permalink(); ?>" class="button nice radius">Read more »</a></p>
								</div>-->
								<span class="orbit-caption" id="img_<?php echo $post_thumbnail_id; ?>">
									<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
									<?php the_excerpt(); ?>
									<p><a href="<?php the_permalink(); ?>" class="button nice radius">Read more »</a></p>
								</span>
								<?php endforeach; ?>
								<?php $post = $tmp_post; ?>

							</div>
							
						</header>

						<script type="text/javascript">
						   $(window).load(function() {
						       $('#featured').orbit({ 
						       	fluid: '16x6'
						       });
						   });
						</script>

						<?php } ?>

						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

						<section class="row post_content">
						
							<div class="home-main eight columns">
						
								<?php the_content(); ?>
								
							</div>
							
							<?php get_sidebar('sidebar2'); // sidebar 2 ?>
													
						</section> <!-- end article header -->
						
						<footer>
			
							<p class="clearfix"><?php the_tags('<span class="tags">Tags: ', ', ', '</span>'); ?></p>
							
						</footer> <!-- end article footer -->
					
					</article> <!-- end article -->
					
					<?php 
						// No comments on homepage
						//comments_template();
					?>
					
					<?php endwhile; ?>	
					
					<?php else : ?>
					
					<article id="post-not-found">
					    <header>
					    	<h1>Not Found</h1>
					    </header>
					    <section class="post_content">
					    	<p>Sorry, but the requested resource was not found on this site.</p>
					    </section>
					    <footer>
					    </footer>
					</article>
					
					<?php endif; ?>
			
				</div> <!-- end #main -->
    
				<?php //get_sidebar(); // sidebar 1 ?>
    
			</div> <!-- end #content -->

<?php get_footer(); ?>