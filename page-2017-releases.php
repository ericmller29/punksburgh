<?php /* Template Name: Releases */ ?>
	<style>
		html {
			box-sizing: border-box;
		}
		*, *:before, *:after {
			box-sizing: inherit;
		}
		body,html{
			font-size: 16px;
			line-height: 1.5;
			margin: 0;
			min-height: 100vh;
			padding: 0;
			width: 100%;
			font-family: Verdana;
		}

		.o-albums{
			display: flex;
			margin-left: -20px;
			margin-bottom: -20px;
			flex-direction: row;
			flex-wrap: wrap;
			width: 100%;
		}

		.m-album{
			margin-left: 20px;
			margin-bottom: 20px;
		}
		
		@media (min-width: 768px) {
			.m-album {
				width: calc(50% - 20px);
			}
		}

		.m-album__art{
			flex: 0 0 250px;
			margin-right: 20px;
			line-height: normal;
		}

		.m-album__art img{
			width: 100%;
			border: solid 1px #aaa;
			padding: 10px;
		}

		.m-album__info{
			font-size: 0.8em;
			display: flex;
			flex-direction: column;
		}
		.m-album__info h2, .m-album__info h3{
			margin: 0;
			line-height: normal;
		}
		.m-album__info h2{
			font-size: 1.8em;
		}
		.m-album__info h3{
			color: #aaa;
			font-weight: normal;
			font-style: italic;
		}

		.a-content{
			flex: 1;
		}

		.a-meta{
  		color: #aaa;
  		font-style: italic;
		}
		.a-meta span:before{
			content: '';
			width: 4px;
			height: 4px;
			background: #aaa;
			border-radius: 50%;
			margin: 0 10px;
			display: inline-block;
		}
		.a-meta span:first-child{
			margin-left: 0;
		}
		.a-meta span:first-child:before{
			display: none;
		}
	</style>

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

	<div class="o-albums">
		<?php if(have_rows('album_releases')): ?>

			<?php while(have_rows('album_releases')): the_row(); ?>
				<?php
					$art = get_sub_field('album_art');
					$band_name = get_sub_field('album_bandartist_name');
					$title = get_sub_field('album_release_title');
					$release_date = get_sub_field('album_release_date');
					$genre = get_sub_field('album_genre');
					$desc = get_sub_field('album_description');
					$purchase_url = get_sub_field('album_purchase_information');
					$release_type = get_sub_field('album_release_type');
				?>
				<div class="m-album">
					<div class="m-album__art">
						<?php if($art): ?>
							<img src="<?php echo $art; ?>" alt="<?php echo $band_name . ' - ' . $title; ?>">
						<?php else: ?>
							<img src="https://placegoat.com/500/500" alt="<?php echo $band_name . ' - ' . $title; ?>">
						<?php endif; ?>
					</div>
					<div class="m-album__info">
						<div class="a-content">
							<h2><?php echo $title; ?></h2>
							<h3><?php echo $band_name; ?></h3>
							<?php if($desc): ?>
							<p>
								<?php echo $desc; ?>
							</p>
							<?php endif; ?>
						</div>
						<div class="a-meta">
							<?php if($release_date): ?>
								<span><?php echo $release_date; ?></span>
							<?php endif; ?>
							<?php if($genre): ?>
								<span><?php echo $genre; ?></span>
							<?php endif; ?>
							<?php if($purchase_url): ?>
								<span>
									<a href="<?php echo $purchase_url; ?>" alt="Buy <?php echo $title; ?> now!" target="_blank" class="a-btn">Buy Now</a>
								</span>
							<?php endif; ?>
						</div>
					</div>
				</div>

			<?php endwhile; ?>

		<?php else: ?>

			No archives!

		<?php endif; ?>
	</div>

	</div><!-- .post-content -->

			</div><!-- .post -->

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
