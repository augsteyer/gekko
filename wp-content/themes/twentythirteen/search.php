<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main" style="width:800px; margin:auto;">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'twentythirteen' ), get_search_query() ); ?></h1>
			</header>

			 <?php $i =0; ?>
			<?php while ( have_posts() ) : the_post();  $i++;?>
		<article style="float:left; margin:30px 0;width:100%;">

		<?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(array(100,100)); ?>
		</div>
        <div class="entry-summary" style="float:right; max-width:650px">
           <h4 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h4>
		<div class="show<?php echo $i; ?>"><?php echo substr(get_the_excerpt(), 0,100); ?></div>
        <div style="display:none;" class="hide<?php echo $i; ?>"><?php the_content();?></div>
        <div class="post_meta">
         <?php
		 
		 $price = get_post_meta( get_the_ID(), 'price',true ); 
		 if($price != ""){ echo " <b>Price :</b> ".$price."&nbsp; &nbsp;";}
		 
		


		 $date = get_post_meta( get_the_ID(), 'date',true );
		  if($date != ""){ echo "<b>Date :</b>"; $date2 = new DateTime(get_field('date'));
		echo $date2->format('d F'); // should print 07 August
		//echo $date->format('h:i A'); // should print 09:30 PM }		 
		} ?>
        
        </div>
          <a class="show_more" id="show_more<?php echo $i; ?>"  href="javascript:void();" onclick="show_more(<?php echo $i; ?>);">Show more</a>
          <a class="hide_more" id="hide_more<?php echo $i; ?>" onclick="hide_more(<?php echo $i; ?>);" href="javascript:void();">Hide</a>
  </div><!-- .entry-summary -->
		<?php endif; ?>
        
        
      
	
</article>
			<?php endwhile; ?>

			<?php twentythirteen_paging_nav(); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>