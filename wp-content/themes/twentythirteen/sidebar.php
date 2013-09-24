<?php
/**
 * The sidebar containing the secondary widget area, displays on posts and pages.
 *
 * If no active widgets in this sidebar, it will be hidden completely.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
	<div id="tertiary" class="sidebar-container" role="complementary">
		<div class="sidebar-inner">
			<div class="widget-area">
				<?php dynamic_sidebar( 'sidebar-2' ); ?>
                
                 <h2> Short By </h2>
				<a href="<?php bloginfo('url');?>/search-results/?orderby=price"><h5>Price</h5></a>
                <a href="<?php bloginfo('url');?>/search-results/?orderby=day"><h5>day</h5></a>
                <a href="<?php bloginfo('url');?>/search-results/?orderby=distance"><h5>Distance</h5></a>
			</div><!-- .widget-area -->
            
            
           
           
			
		</div><!-- .sidebar-inner -->
	</div><!-- #tertiary -->
<?php endif; ?>