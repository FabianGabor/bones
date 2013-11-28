<form method="get" id="searchform" action="<?php echo home_url() ; ?>/">
	<div class="row collapse">
		<div class="small-10 columns">
			<input type="text" placeholder="Search" value="<?php echo esc_html($s, 1); ?>" name="s" id="s" maxlength="33">
		</div>
		<div class="small-2 columns">			
			<input class="button postfix" type="submit" value="Go">
		</div>
	</div>
</form>