<div class="wrap" id="of_container">
	<div id="upgrage-pro-banner">
    	<div class="banner-title">
        	Upgrade to Author Theme PRO!
        </div><!--banner title-->
        <p>
        	You are using the lite version of Author Theme. Upgrade to PRO for extra features, Home Page Slider, Gallery Template, Contact Page Template, Multiple Colors and many many more featires that you are going to love for sure :)
        </p>
        <a href="#">Buy Author Theme PRO Now!</a>
    </div><!--upgrade pro banner-->
	<div id="of-popup-save" class="of-save-popup">
		<div class="of-save-save">Options Saved :)</div>
	</div>
	
	<div id="of-popup-reset" class="of-save-popup">
		<div class="of-save-reset">Options Reset!</div>
	</div>
	
	<div id="of-popup-fail" class="of-save-popup">
		<div class="of-save-fail">Error Saving :(</div>
	</div>
	
	<span style="display: none;" id="hooks"><?php echo json_encode(of_get_header_classes_array()); ?></span>
	<input type="hidden" id="reset" value="<?php if(isset($_REQUEST['reset'])) echo $_REQUEST['reset']; ?>" />
	<input type="hidden" id="security" name="security" value="<?php echo wp_create_nonce('of_ajax_nonce'); ?>" />
	<div id="left-smof-options">
	<form id="of_form" method="post" action="<?php echo esc_attr( $_SERVER['REQUEST_URI'] ) ?>" enctype="multipart/form-data" >
	
		<div id="header">
		
			<div class="logo">
				<h2><?php echo THEMENAME; ?></h2>
				<span><?php echo ('version: '. THEMEVERSION); ?></span>
			</div>
		
			<div id="js-warning">Warning- This options panel will not work properly without javascript!</div>
			<div class="icon-option"></div>
			<div class="clear"></div>
		
    	</div>

		<div id="info_bar">
				<div class="expand"><span style="font-weight:700">Hello <?php global $current_user; get_currentuserinfo(); echo $current_user->display_name ; ?></span>!</div>
			<button id="of_save" type="button" class="button-primary-smof save-all-changes-button">
				<?php _e('Save All Changes','author_ts');?>
			</button>
            <img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />
			<div class="clear"></div>
		</div><!--.info_bar--> 	
		
		<div id="main">
		
			<div id="of-nav">
				<ul>
				  <?php echo $options_machine->Menu ?>
				</ul>
			</div>

			<div id="content">
		  		<?php echo $options_machine->Inputs /* Settings */ ?>
		  	</div>
		  	
			<div class="clear"></div>
			
		</div>
		
		<div class="save_bar"> 
		
			
			<button id ="of_save" type="button" class="button-primary-smof save-all-changes-button"><?php _e('Save All Changes','author_ts');?></button>
            <img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-loading-img ajax-loading-img-bottom" alt="Working..." />			
			<button id ="of_reset" type="button" class="button-primary-smof submit-button reset-button" ><?php _e('Options Reset','author_ts');?></button>
			<img style="display:none" src="<?php echo ADMIN_DIR; ?>assets/images/loading-bottom.gif" class="ajax-reset-loading-img ajax-loading-img-bottom" alt="Working..." />
			<div class="clear"></div>
		</div><!--.save_bar--> 
 
	</form>
	</div><!--left smof options-->
    <!--right smof banners-->
    
	<div style="clear:both;"></div>

</div><!--wrap-->