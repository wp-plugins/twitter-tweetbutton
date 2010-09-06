<?php /*
Plugin Name: tweetbutton
Plugin URI: http://prasanna.freeoda.com/blog/plugins/tweet-button/
Description:Show your tweets
Author:Prasanna 
Version: 1
Author URI:http://prasanna.freeoda.com/blog/*/

function tweetbuttonshow(){  
	$tweetusname = get_option('tweetusname');
	$type_button = get_option('type_button');
	
	 ?>
	 <a href="http://twitter.com/share" class="twitter-share-button" data-count="<?php echo $type_button;?>" data-via="<?php echo $tweetusname;?>">Tweet</a><script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script>
	 <?php
	 
}



function tweetbuttonadmin_option() 
{
	//include_once("extra.php");
	echo "<div class='wrap'>";
	echo "<h2>"; 
	echo wp_specialchars( "Tweet Button " ) ; 
	echo "</h2>";
    
	$tweetusname = get_option('tweetusname');
	$type_button = get_option('type_button');
	/*$imghwt = get_option('imghwt');
	$imgcl = get_option('imgcl');*/
	
	
	if ($_POST['cd_submit']) 
	{
		$tweetusname = stripslashes($_POST['tweetusname']);
		$type_button = stripslashes($_POST['type_button']);
		/*$imghwt = stripslashes($_POST['imghwt']);
		$imgcl = stripslashes($_POST['imgcl']);*/
		
		update_option('tweetusname', $tweetusname );
		update_option('type_button', $type_button );
		/*update_option('imghwt', $imghwt );
		update_option('imgcl', $imgcl );*/
	
	}
	?>
   

   
	<form name="cd_form" method="post" action="">
     <input name="hiddenid" type="hidden" id="hiddenid" value="<?php echo $edit_id; ?>">
        <input name="process" type="hidden" id="process" value="<?php echo $process; ?>">
   
	<table width="382" border="0" cellpadding="5" cellspacing="0">
  <tr>
    <td width="169">Tweet Button Code </td>
    <td width="203">

	  
	  <input type="text" name="tweetusname" id="tweetusname" value="<?php echo $tweetusname; ?>" />	  </td>
  </tr>
  <!--<tr>
    <td>Height</td>
    <td><input type="text" name="imght" id="imght"  value="<?php// echo $imght; ?>"/></td>
  </tr>
  <tr>
    <td>Width</td>
    <td><input type="text" name="imghwt" id="imghwt"  value="<?php// echo $imghwt; ?>"/></td>
  </tr>
  <tr>
    <td>Class</td>
    <td><input type="text" name="imgcl" id="imgcl"  value="<?php //echo $imgcl; ?>"/></td>
  </tr>-->
  <tr>
    <td>Choose your button</td>
    <td><select name="type_button">
	<option value="none" <?php if ($type_button=="none") {?> selected="selected"<?php }?>>No count</option>
	<option value="vertical" <?php if ($type_button=="vertical") {?> selected="selected"<?php }?>>Vertical Count</option>
	<option value="horziontal" <?php if ($type_button=="horziontal") {?> selected="selected"<?php }?>>Horziontal Count</option>
	</select></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input name="cd_submit" id="cd_submit" class="button-primary" value="Submit" type="submit" /></td>
  </tr>
</table>

</form>
<?php
	echo "</div>";
}



function tweetbuttoninstall () 
 {
     add_option('tweetusname', "pras88in");
	 add_option('type_button', "vertical");
	/* add_option('imghwt', "160px");
	 add_option('imgcl', ""); */
  
  
  }

function tweetbuttondeactivation() 
{
	delete_option('tweetusname');
	delete_option('type_button');
	/*delete_option('imghwt');
	delete_option('imgcl');*/

}
function tweetbuttonwidget($args) 
{
	extract($args);
	echo $before_widget . $before_title;
	echo "Tweet Button";
	echo $after_title;	
	tweetbuttonshow();
	echo $after_widget;
}


function tweetbuttoncontrol()
{
	echo '<p>Tweet Button.<br> Goto Tweet Button .';
	echo ' <a href="options-general.php?page=tweetbutton/tweetbutton.php">';
	echo 'click here</a></p>';
}


function tweetbuttonwidget_init() 
{
  	register_sidebar_widget(('Tweet Button'), 'tweetbuttonwidget');   
	
	if(function_exists('register_sidebar_widget')) 	
	{
		register_sidebar_widget('Tweet Button', 'tweetbuttonwidget');
	}
	
	if(function_exists('register_widget_control')) 	
	{
		register_widget_control(array('Tweet Button', 'widgets'), 'tweetbuttoncontrol');
	} 
}

function tweetbuttonadd_to_menu() 
{
 add_options_page('Tweet Button', 'Tweet Button', 3, __FILE__, 'tweetbuttonadmin_option' );
}

add_action('admin_menu', 'tweetbuttonadd_to_menu');
add_action("plugins_loaded", "tweetbuttonwidget_init");
register_activation_hook(__FILE__, 'tweetbuttoninstall');
register_deactivation_hook(__FILE__, 'tweetbuttondeactivation');
add_action('init', 'tweetbuttonwidget_init');







?>


