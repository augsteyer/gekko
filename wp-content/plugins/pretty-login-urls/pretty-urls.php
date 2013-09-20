<?php
/**
 Plugin Name: Pretty Urls - Change Login and Register
 Plugin URI: http://www.masquewordpress.com/plugins/pretty-urls/
 Version: 1.0
 Description: Use pretty urls like /login instad of wp-login.php .With this plugin you can change the login or register url to whatever you want
 Author: Damian Logghe
 Author URI: http://www.masquewordpress.com
 */

class pretty_urls_plug extends WP_Widget
{
	function __construct() {
        
    add_action( 'admin_init', array(&$this,'register_options' ));
		
	add_action( 'admin_menu',array(&$this,'register_menu' ) );

	// Flush on plugin deactivation
	register_deactivation_hook( __FILE__, array(&$this,'flush_rules' ));
	
		
	}
	
		
	
	 	//function that register options 
 	 function register_options()
	{
		register_setting( 'purls_options', 'purls_option' );
		
		
	}
	
		//function that register the menu link in the settings menu	and editor section inside the option page
	 function register_menu()
	{
		add_options_page( 'Pretty Urls', 'Pretty Urls', 'manage_options', 'pretty-urls',array(&$this, 'options_page') );
		
		add_settings_section('purls_forms', 'Pretty Urls Settings', array(&$this, 'style_setting_form'), 'purls-settings');		
		
		add_settings_section('purls_support_id', 'Support the plugin', array(&$this, 'support_form'), 'purls-support');
	}
	
	
	 //function that display the options page
	 function options_page()
	{
		?>
		<div class="metabox-holder">
	    
	    <?php screen_icon(); echo "<h2>". __( 'Pretty Urls' ) ."</h2>"; ?>
	 
	    <div class="postbox" style="float:right;width:300px;"><?php do_settings_sections( 'purls-support' ); ?></div>
	    
	   	<form method="post" action="options.php" style="width:50%;" >
	 
	    <?php settings_fields( 'purls_options' );?>
	   
	   
	    
	    <div class="postbox"><?php do_settings_sections( 'purls-settings' ); ?></div>

		
	    </form>
	    </div>
	<?
		//If saved we apply rules
		if ($_GET['page'] == 'pretty-urls' && $_GET['settings-updated'] == 'true'){
			$this->rewrite_rules();
		}	

	}
	
	
	
	
	//function that display the textarea editor form
	function style_setting_form()
	{
	
		$options = get_option('purls_option');
		
		
		?>

		<div class="inside"><div class="intro"><p>Change login or register urls. By default it will activate /login and /register</p></div> 
		
			<p><strong>Login</strong><br> 
				<input type="text" name="purls_option[login]"  value="<?php echo $options['login'];?>">
			</p>
			
			<p><strong>Register</strong><br> 
				<input type="text" name="purls_option[register]"  value="<?php echo $options['register'];?>">
			</p>
			
	
		<?php
		if (get_bloginfo('version') >= '3.1') { submit_button('Save Changes','secondary'); } else { echo '<input type="submit" name="submit" id="submit" class="button-secondary" value="Save Changes"  />'; }	
		echo '</div><div style="clear:both;"></div>';
	}
	


	
	function support_form()
	{
			
		?>

		<div class="inside"><div class="intro"><p>Please Support this plugin</p></div> 
		<p> 
				<form action="https://www.paypal.com/cgi-bin/webscr" method="post">
				<input type="hidden" name="cmd" value="_s-xclick">
				<input type="hidden" name="hosted_button_id" value="3ZMTRLTEXQ9UW">
				<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
				<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
				</form>

		</p>
		<p><a href="http://wordpress.org/extend/plugins/twitter-like-box-reloaded/">Twitter Like Box Plugin</a></p>
		<p><a href="http://wordpress.org/extend/plugins/social-popup/">Social Popup Plugin</a></p>
		
		</div><div style="clear:both;"></div>
	<?	
	}
	
	
	function flush_rules() 
	{
		flush_rewrite_rules();
	}	
	
	function rewrite_rules()
	{
		
		
		$options = get_option('purls_option');
		
		$options['login'] == '' ? $login = 'login' : $login = $options['login'];
		$options['register'] == '' ? $register = 'register' : $register = $options['register'];

		

		add_rewrite_rule( "{$register}/?$", 'wp-login.php?action=register', 'top' );
		add_rewrite_rule( "{$login}/?$", 'wp-login.php', 'top' );
		
		
		
		$this->flush_rules();
	}
	

	
	
	
	
} //end of class



$pretty_urls_plug = new pretty_urls_plug;

