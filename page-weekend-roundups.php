<?php //Template Name: Weekend Round Ups ?>

<?php get_header(); ?>
<div class="wrapper section-inner">

	<div class="content left">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="posts">

			<div class="post">

				<?php if ( has_post_thumbnail() ) : ?>

					<div class="featured-media">

						<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>">

							<?php the_post_thumbnail('post-image'); ?>

							<?php if ( !empty(get_post(get_post_thumbnail_id())->post_excerpt) ) : ?>

								<div class="media-caption-container">

									<p class="media-caption"><?php echo get_post(get_post_thumbnail_id())->post_excerpt; ?></p>

								</div>

							<?php endif; ?>

						</a>

					</div><!-- .featured-media -->

				<?php endif; ?>

				<div class="post-header">

				    <h1 class="post-title"><?php the_title(); ?></h1>

			    </div><!-- .post-header -->

				<div class="post-content">

					<?php the_content(); ?>

					<?php if ( current_user_can( 'manage_options' ) ) : ?>

						<p><?php edit_post_link( __( 'Edit', 'hemingway' ) ); ?></p>

					<?php endif; ?>

					<?php if(have_rows('weekend_events')): // first we'll make sure we have some. ?>

						<?php
							$roundUps = get_field('weekend_events'); // grab them all.
							$sortedRoundUps = []; // We're going to use this to group the round ups by date.

							foreach($roundUps as $r){
								// We're going to use this date to group shows together.
								$date = get_field('show_date');

								// If there's not currently this date in the sorted array, go ahead and add it.
								if(!isset($sortedRoundUps[$date])){
									$sortedRoundUps[$date] = [];
								}

								// Finally append the show to the certain date.
								$sortedRoundUps[$date] = $r;
							}
						?>
						<!-- So here we're going to look through the sorted shows display the date and dump all the shows that are on this date. -->
						<?php foreach($sortedRoundUps as $date => $shows): ?>
							<h1>~ <?php echo $date; ?> ~</h1>

							<div class="roundUps">
								<?php foreach($shows as $s): ?>
									<article class="roundUps__single">
										<div class="roundUps__single-image">
											<p>
												<img src="<?php echo $s['show_flyer']; ?>" class="aligncenter wp-image-10864 size-full">
											</p>
										</div>
										<div class="roundUps__single-content">
											<h3>
												<a href="<?php echo $s['show_link']; ?>" target="_blank" alt="<?php echo $s['show_name']; ?>">
													<?php echo $s['show_name']; ?>
												</a>
												[<?php echo $s['show_time']; ?> // <?php echo $s['show_venue']; ?> // <?php echo $s['show_cost']; ?>]
											</h3>
											<?php echo $s['show_description']; ?>
											<p>
												<?php echo $s['show_time']; ?> // <?php echo $s['show_cost']; ?> // <?php echo $s['show_age']; ?>
											</p>
										</div>
									</article>
								<?php endforeach; ?>
							</div>
						<?php endforeach; ?>

					<?php else: ?>	
						<p>No roundups this weekend!</p>
					<?php endif; ?>

				</div>
			</div>

			<?php if ( comments_open() || get_comments_number() != '' ) : ?>

				<?php comments_template( '', true ); ?>

			<?php endif; ?>

		</div><!-- .posts -->

		<?php endwhile;

		else: ?>

			<p><?php _e( "We couldn't find any posts that matched your query. Please try again.", "hemingway" ); ?></p>

		<?php endif; ?>

		<div class="clear"></div>

	</div><!-- .content left -->

	<?php get_sidebar(); ?>

	<div class="clear"></div>

</div><!-- .wrapper -->

<?php get_footer(); ?>