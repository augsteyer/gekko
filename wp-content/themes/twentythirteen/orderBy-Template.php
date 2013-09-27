<?php
/*
Template Name: Order By template
*/
get_header(); ?>

<div id="primary" class="content-area">
  <div id="content" class="site-content" role="main" style="width:920px; margin:auto;">
    <?php 
		 $orderby = $_GET['orderby'];
		 $pincode = $_POST['pincode'];
		 $orderbydate = $_POST['orderbydate'];
		 
		 
		 if($orderby == "price" || $orderby == "ASC" ||$orderby == "DESC")
		 {?>
        <b> Price Short By : </b>
        <a class="<?php if($orderby == "price" || $orderby == "ASC"){ echo 'active';}?>" href="<?php bloginfo('url');?>/search-results/?orderby=ASC">ASC</a>
        <a  class="<?php if($orderby == "DESC"){ echo 'active';}?>" href="<?php bloginfo('url');?>/search-results/?orderby=DESC">DESC</a>
     
     
         <?php  if($orderby == "ASC")
            {
				
			 echo'<h4>Dishes By price ascending Order.</h4>';
             query_posts( 'posts_per_page=50&post_type=oderfood&meta_key=cf_Price&orderby=cf_Price&order=ASC' );
			 
            }elseif($orderby == "DESC")
            {
				
			echo'<h4>Dishes By price Descending Order.</h4>';
			query_posts( 'posts_per_page=50&post_type=oderfood&meta_key=cf_Price&orderby=cf_Price&order=DESC' );
            
           }else{
			   echo'<h4>Dishes By price ascending Order.</h4>';
			  query_posts( 'posts_per_page=50&post_type=oderfood&meta_key=cf_Price&orderby=cf_Price&order=ASC' );
				
			}?>
             
          <?php } elseif($orderby == "day" || $orderbydate != "")
		 {?>
         
        <b> Short By Day : </b>
            <form method="post" action="<?php bloginfo('url');?>/search-results/">
            <input type="text" value="" id="availablity_date" name="orderbydate" placeholder="Choose Date" />
            <input type="submit" value="Search By date" name="submit" />
            </form>
   			<?php  if($orderbydate != "")
            {
		echo'<h4>Dishes By Date :</h4>';
		$args = array(
		'posts_per_page' => '50',  
		'post_type' => 'oderfood', 
		'meta_query' =>
            array(
                array(
                    'key' => array('wpuf_post_availablity','wpuf_post_availablity2','wpuf_post_availablity3'),
                    'value' => $orderbydate,
                    'compare' => 'IN',
                )
            )

    );
             query_posts( $args );
			 
            }else{
				query_posts( 'posts_per_page=50&post_type=oderfood&meta_key=wpuf_post_availablity&orderby=wpuf_post_availablity&order=ASC' );
				
			}?>
    <?php }elseif($orderby == "distance" || $pincode != "")
		 {?>
    <b> Short By Distance : </b>
    <form method="post" action="<?php bloginfo('url');?>/search-results/">
      <input type="text" value="" name="pincode" placeholder="Enter your ZIP" />
      <input type="submit" value="Submit Pin" name="submit" />
    </form>
    <?php  if($pincode != "")
			{
			echo'<h4>Dishes By Location Order.</h4>';
			$Incase_noresult = substr($pincode, 0, -1);
			
		// IF ZIP CODE FOUND THEN THIS QUERY WILL WORK	
			
			$querystr = "
			SELECT $wpdb->posts.* 
			FROM $wpdb->posts, $wpdb->postmeta
			WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id 
			AND $wpdb->postmeta.meta_key = 'cf_zip' 
			AND $wpdb->postmeta.meta_value ='$pincode' 
			AND $wpdb->posts.post_status = 'publish' 
			AND $wpdb->posts.post_type = 'oderfood'
			";
			
			$pageposts = $wpdb->get_results($querystr, OBJECT);
   				if ($pageposts): ?>
				<?php global $post; ?>
                <?php setup_postdata($post); ?>
                <?php $i =0; ?>
                <?php foreach ($pageposts as $post): ?>
                <?php setup_postdata($post); $i++; ?>
                        <article style="float:left; margin:30px 0;width:100%;">
                          <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
                          <div class="entry-thumbnail">
                            <?php the_post_thumbnail(array(100,100)); ?>
                          </div>
                          <div class="entry-summary" style="float: left; padding: 0px 13px; max-width: 505px;">
                            <h4 class="entry-title"> <a href="<?php the_permalink(); ?>" rel="bookmark">
                              <?php the_title(); ?>
                              </a> </h4>
                            <div class="show<?php echo $i; ?>"><?php echo substr(get_the_excerpt(), 0,100); ?> </div>
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
							$Country = get_post_meta( get_the_ID(), 'wpuf_post_state',true );
							$Zipcode = get_post_meta( get_the_ID(), 'wpuf_post_country',true );
							$wpuf_post_availablity = get_post_meta( get_the_ID(), 'wpuf_post_availablity',true );
							$wpuf_post_availablity2 = get_post_meta( get_the_ID(), 'wpuf_post_availablity2',true );
							$wpuf_post_availablity3 = get_post_meta( get_the_ID(), 'wpuf_post_availablity3',true );
							
							if($address != ""){ echo "<b>Address :</b>".$address."&nbsp; &nbsp;";
							if($City != ""){ echo " <b>City :</b>  ".$City."&nbsp; &nbsp;";}
							if($State != ""){ echo " <b>State :</b>  ".$State."&nbsp; &nbsp;";}
							if($Country != ""){ echo " <b>Country :</b> ".$Country."&nbsp; &nbsp;";}
							if($Zipcode != ""){ echo " <b>Zipcode :</b>  ".$Zipcode."&nbsp; &nbsp;";} 
							if($wpuf_post_availablity != ""){ echo " <b>Available :</b>  ".$wpuf_post_availablity."&nbsp; &nbsp;";} 
							if($wpuf_post_availablity2 != ""){ echo " <b>Available :</b>  ".$wpuf_post_availablity3."&nbsp; &nbsp;";} 
							if($wpuf_post_availablity3 != ""){ echo " <b>Available :</b>  ".$wpuf_post_availablity4."&nbsp; &nbsp;";} 
                            
                            } ?>
                            </div>
                            <a class="show_more" id="show_more<?php echo $i; ?>"  href="javascript:void();" onclick="show_more(<?php echo $i; ?>);">Show more</a> <a class="hide_more" id="hide_more<?php echo $i; ?>" onclick="hide_more(<?php echo $i; ?>);" href="javascript:void();">Hide</a> </div>
                          <!-- .entry-summary -->
                          <?php endif; ?>
                        </article>
   			 <?php endforeach; ?>
    <?php else : ?> 
   <!--IF ZIPCODE NOTMATCH IN DATABASE THEN ELSE QUERY WILLL WORK-->
    <?php
				$querystr2 = "
				SELECT $wpdb->posts.* 
				FROM $wpdb->posts, $wpdb->postmeta
				WHERE $wpdb->posts.ID = $wpdb->postmeta.post_id 
				AND $wpdb->postmeta.meta_key = 'cf_zip' 
				AND $wpdb->postmeta.meta_value LIKE '$Incase_noresult%' 
				AND $wpdb->posts.post_status = 'publish' 
				AND $wpdb->posts.post_type = 'oderfood'
				";
				
				$pageposts2 = $wpdb->get_results($querystr2, OBJECT);

				if ($pageposts2): ?>
				<?php $i =0; ?>
				<?php foreach ($pageposts2 as $post): ?>
				<?php setup_postdata($post); $i++; ?>
				<article style="float:left; margin:30px 0;width:100%;">
				  <?php if ( has_post_thumbnail() && ! post_password_required() ) : ?>
				  <div class="entry-thumbnail">
					<?php the_post_thumbnail(array(100,100)); ?>
				  </div>
				  <div class="entry-summary" style="float: left; padding: 0px 13px; max-width: 505px;">
					<h4 class="entry-title"> <a href="<?php the_permalink(); ?>" rel="bookmark">
					  <?php the_title(); ?>
					  </a> </h4>
					<div class="show<?php echo $i; ?>"><?php echo substr(get_the_excerpt(), 0,100); ?> </div>
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
							$Country = get_post_meta( get_the_ID(), 'wpuf_post_state',true );
							$Zipcode = get_post_meta( get_the_ID(), 'wpuf_post_country',true );
							$wpuf_post_availablity = get_post_meta( get_the_ID(), 'wpuf_post_availablity',true );
							$wpuf_post_availablity2 = get_post_meta( get_the_ID(), 'wpuf_post_availablity2',true );
							$wpuf_post_availablity3 = get_post_meta( get_the_ID(), 'wpuf_post_availablity3',true );
							
							if($address != ""){ echo "<b>Address :</b>".$address."&nbsp; &nbsp;";
							if($City != ""){ echo " <b>City :</b>  ".$City."&nbsp; &nbsp;";}
							if($State != ""){ echo " <b>State :</b>  ".$State."&nbsp; &nbsp;";}
							if($Country != ""){ echo " <b>Country :</b> ".$Country."&nbsp; &nbsp;";}
							if($Zipcode != ""){ echo " <b>Zipcode :</b>  ".$Zipcode."&nbsp; &nbsp;";} 
							if($wpuf_post_availablity != ""){ echo " <b>Available :</b>  ".$wpuf_post_availablity."&nbsp; &nbsp;";} 
							if($wpuf_post_availablity2 != ""){ echo " <b>Available :</b>  ".$wpuf_post_availablity3."&nbsp; &nbsp;";} 
							if($wpuf_post_availablity3 != ""){ echo " <b>Available :</b>  ".$wpuf_post_availablity4."&nbsp; &nbsp;";} 

					} ?>
					</div>
					<a class="show_more" id="show_more<?php echo $i; ?>"  href="javascript:void();" onclick="show_more(<?php echo $i; ?>);">Show more</a> <a class="hide_more" id="hide_more<?php echo $i; ?>" onclick="hide_more(<?php echo $i; ?>);" href="javascript:void();">Hide</a> </div>
				  <!-- .entry-summary -->
				  <?php endif; ?>
    </article>
    <?php endforeach; ?>
     <?php else : ?>
       <article style="float:left; margin:30px 0;width:100%;">
      <div class="entry-summary" style="float: left; padding: 0px 13px; max-width: 505px;">
        <?php get_template_part( 'content', 'none' ); ?>
      </div>
    </article>
     
    <?php endif ?>
    <?php endif ?>
    <?php  }else{
				query_posts( 'posts_per_page=50&post_type=oderfood' );
				
		}
			
			}?>   
    <?php if ( have_posts() ) : ?>
    <?php $i =0; ?>
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
        <div class="show<?php echo $i; ?>"><?php echo substr(get_the_excerpt(), 0,100); ?> </div>
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
		$Country = get_post_meta( get_the_ID(), 'wpuf_post_state',true );
		$Zipcode = get_post_meta( get_the_ID(), 'wpuf_post_country',true );
		$wpuf_post_availablity = get_post_meta( get_the_ID(), 'wpuf_post_availablity',true );
		$wpuf_post_availablity2 = get_post_meta( get_the_ID(), 'wpuf_post_availablity2',true );
		$wpuf_post_availablity3 = get_post_meta( get_the_ID(), 'wpuf_post_availablity3',true );
		
		if($address != ""){ echo "<b>Address :</b>".$address."&nbsp; &nbsp;";
		if($City != ""){ echo " <b>City :</b>  ".$City."&nbsp; &nbsp;";}
		if($State != ""){ echo " <b>State :</b>  ".$State."&nbsp; &nbsp;";}
		if($Country != ""){ echo " <b>Country :</b> ".$Country."&nbsp; &nbsp;";}
		if($Zipcode != ""){ echo " <b>Zipcode :</b>  ".$Zipcode."&nbsp; &nbsp;";} 
		if($wpuf_post_availablity != ""){ echo " <b>Available :</b>  ".$wpuf_post_availablity."&nbsp; &nbsp;";} 
		if($wpuf_post_availablity2 != ""){ echo " <b>Available :</b>  ".$wpuf_post_availablity3."&nbsp; &nbsp;";} 
		if($wpuf_post_availablity3 != ""){ echo " <b>Available :</b>  ".$wpuf_post_availablity4."&nbsp; &nbsp;";} 

		
		} ?>
        </div>
        <a class="show_more" id="show_more<?php echo $i; ?>"  href="javascript:void();" onclick="show_more(<?php echo $i; ?>);">Show more</a> <a class="hide_more" id="hide_more<?php echo $i; ?>" onclick="hide_more(<?php echo $i; ?>);" href="javascript:void();">Hide</a> </div>
      <!-- .entry-summary -->
      <?php endif; ?>
    </article>
    <?php endwhile; ?>
    <?php twentythirteen_paging_nav(); ?>
    <?php else : ?>
    <article style="float:left; margin:30px 0;width:100%;">
      <div class="entry-summary" style="float: left; padding: 0px 13px; max-width: 505px;">
        <?php get_template_part( 'content', 'none' ); ?>
      </div>
    </article>
    <?php endif; ?>
  </div>
  <!-- #content --> 
</div>
<!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>
