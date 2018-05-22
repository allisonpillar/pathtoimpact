
<?php
// Header
get_header();

global $dmf;
$current_category = get_queried_object();
$thisCat = $current_category->term_id;

?>


<main class="site-content" role="main">
	<div class="hero-block">
		<picture>
			<!--[if IE 9]><video style="display: none;"><![endif]-->
			<source srcset="<?php the_field('blog_image_desktop', 'options'); ?>" media="(min-width: 768px)">
			<!--[if IE 9]></video><![endif]-->
			<img srcset="<?php the_field('blog_image_mobile', 'options'); ?>" alt="">
		</picture>
		<div class="hero-overlay hero-sm">
			<div class="container">
				<div class="row">
					<div class="col-sm-12">
						<h1 class="page-title">Resources</h1>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!--Search-->
	<?php get_template_part('parts/search_resources'); ?>

	

	<!--Resources Block-->
	<section class="resources-block container">
		
		<!-- Resource Intro -->
		<?php get_template_part('parts/resource_intro'); ?>
		

		<div class="article-heading row">
			<div class="col-sm-12">
				<div class="article-title">Category:</div>
				<div class="category-dropdown dropdown">
					<a class="btn btn-default dropdown-toggle" type="button" id="filterMenu" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
						<?php echo $current_category->name; ?>
					</a>
					<ul class="dropdown-menu" aria-labelledby="filterMenu">
						<li><a href="/resources">All Resources</a></li>
						<?php
                            $resource_categories = get_terms( 'resource-category' );

                            foreach ($resource_categories as $category) :
                                $curr_class = "";
                                if(is_category( $category->name )) {
                                    $curr_class = "current-cat";
                                }
                        ?>
							<?php if($category->term_id == $thisCat): ?>
								<li class="selected"><a href="/resource-category/<?php echo $category->slug; ?>"><?php echo $category->name; ?></a></li>
							<?php else: ?>
								<li><a href="/resource-category/<?php echo $category->slug; ?>"><?php echo $category->name; ?></a></li>
							<?php endif; ?>

						<?php endforeach; ?>

					</ul>
				</div>
			</div>
		</div>

		<div class="resources-content row">

			<div class="col-sm-12">
				<?php $y=1; if(have_posts()) : while(have_posts()) : the_post(); ?>


						<div class="resource-item media">
							<a href="<?php echo get_permalink($post->ID); ?>" class="item-wrap" title="">
								<div class="media-left">
									<img src="/assets/img/placeholders/resource-thumb-1.svg" alt="" height="55" width="66">
									<?php /*
									<?php if(get_field('featured_post_image', $post->ID)): ?>
										<img src="<?php the_field('featured_post_image', $post->ID); ?>" alt="" height="241" width="385">
									<?php else: ?>
										<img src="/assets/img/blank.jpg" alt="" height="241" width="385">
									<?php endif; ?>
									*/ ?>
								</div>
								<div class="media-body">
									<h3><?php echo the_title(); ?></h3>
									<?php echo $dmf->custom_content(25, false, get_the_content()); ?>
									<span class="link-more arrow-right red" title="">View Resource</span>
								</div>
							</a>
							<?php
								$primary_cat = new WPSEO_Primary_Term( 'resource-category', $post->ID );
								$primary_cat = $primary_cat->get_primary_term();
								$cat = get_category( $primary_cat );

							?>
							<span class="article-category <?php echo get_field('category_color', 'term_'.$primary_cat); ?>"><?php echo $cat->name; ?></span>
						</div>
				

				<?php $y++; endwhile; endif; ?>

			</div>

		</div>

		<div class="row">
			<div class="col-xs-12 pagination">
				<?php $dmf->wp_numeric_posts_nav(); ?>
			</div>
		</div>


		
	</section>

</main>

<?php get_footer(); ?>
