<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

get_header(); ?>

<div id="primary" class="content-area">
  <div id="content" class="site-content" role="main" style="width:920px; margin:auto;">
    <?php query_posts( 'posts_per_page=50&post_type=oderfood&orderby=ID&order=DESC' ); ?>
    <?php $i =0; ?>
    <?php if ( have_posts() ) : ?>
    <?php while ( have_posts() ) : the_post();  $i++;?>
    <article style="float:left; margin:30px 0;width:100%;">
      <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
      <div class="entry-thumbnail">
        <?php the_post_thumbnail(array(100,100)); ?>
      </div>
      <div class="entry-summary" style="float: left; padding: 0px 13px; max-width: 505px;">
        <h4 class="entry-title"> <a href="<?php the_permalink(); ?>" rel="bookmark">
          <?php the_title(); ?>
          </a> </h4>
        <div class="show<?php echo $i; ?>"><?php echo substr(get_the_excerpt(), 0,100); ?>... </div>
        <div style="display:none;" class="hide<?php echo $i; ?>">
          <?php the_content();?>
        </div>
        <div class="post_meta">
          <?php
		 
		 $price = get_post_meta( get_the_ID(), 'cf_Price',true ); 
		 if($price != ""){ echo " <b>Price :</b>  $".$price."&nbsp; &nbsp;";}
		 
		


		 $address = get_post_meta( get_the_ID(), 'wpuf_post_address',true );
		 $City = get_post_meta( get_the_ID(), 'wpuf_post_city',true );
		 $State = get_post_meta( get_the_ID(), 'wpuf_post_state',true );
		 $Country = get_post_meta( get_the_ID(), 'wpuf_post_country',true );
		 $Zipcode = get_post_meta( get_the_ID(), 'wpuf_post_zip',true );
		 $wpuf_post_availablity = get_post_meta( get_the_ID(), 'wpuf_post_availablity',true );
		  $wpuf_post_availablity2 = get_post_meta( get_the_ID(), 'wpuf_post_availablity2',true );
		   $wpuf_post_availablity3 = get_post_meta( get_the_ID(), 'wpuf_post_availablity3',true );
			 
		  if($address != ""){ echo "<b>Address :</b>".$address."&nbsp; &nbsp;";
		 if($City != ""){ echo " <b>City :</b>  ".$City."&nbsp; &nbsp;";}
		 if($State != ""){ echo " <b>State :</b>  ".$State."&nbsp; &nbsp;";}
		 if($Country != ""){ echo " <b>Country :</b> ".$Country."&nbsp; &nbsp;";}
		 if($Zipcode != ""){ echo " <b>Zipcode :</b>  ".$Zipcode."&nbsp; &nbsp;";} 
		 if($wpuf_post_availablity != ""){ echo " <b>Available :</b>  ".$wpuf_post_availablity."&nbsp;, &nbsp;".$wpuf_post_availablity2."&nbsp; ,&nbsp;".$wpuf_post_availablity3."&nbsp; &nbsp;";} 
		
		} ?>
        </div>
        <a class="show_more" id="show_more<?php echo $i; ?>"  href="javascript:void();" onclick="show_more(<?php echo $i; ?>);">Show more</a> <a class="hide_more" id="hide_more<?php echo $i; ?>" onclick="hide_more(<?php echo $i; ?>);" href="javascript:void();">Hide</a> </div>
      <!-- .entry-summary -->
      <?php endif; ?>
    </article>
    <?php endwhile; ?>
    <?php twentythirteen_paging_nav(); ?>
    <?php else : ?>
    <?php get_template_part( 'content', 'none' ); ?>
    <?php endif; ?>
  </div>
  <!-- #content --> 
</div>
<!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
