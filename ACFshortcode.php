add_shortcode('repeater', 'wporg_shortcode');
function wporg_shortcode( $atts = [], $content = null) {
    // do something to $content
    // always return
	
	if(!function_exists('the_repeater_field')){
		return null;
	}
    
	$repeater  = get_post_meta( get_the_ID() , 'what_we_do', true);
	 
	ob_start();
	if(!empty($repeater) ) {
		 
		echo '<ul class="as-what-we-do-ul">';
		while( the_repeater_field('what_we_do', get_the_ID()) ) {
			echo '<li>';
			echo '<h3 class="as-what-we-do-head"> ' . get_sub_field('service_name') . '</h3><div class="service-details">';
			
			$service_description = get_sub_field('service_descrpatoion');
			if($service_description){
				printf('<div class="service-description">%s</div>', $service_description);
			}
			
			$service_link = get_sub_field('service_link');
			if($service_link){
				printf('<div class="service-link"><a href="%s" target="_blank" class="elementor-button-link elementor-button elementor-size-sm" role="button">
					<span class="elementor-button-content-wrapper">
						<span class="elementor-button-icon elementor-align-icon-right"><i aria-hidden="true" class="fas fa-external-link-alt"></i></span>
						<span class="elementor-button-text">View</span>
					</span>
				</a></div>',
				$service_link
				);
			}
			echo '</div></li>';
				
		}
		echo '</li></ul>';
	}
	
	
	
    return ob_get_clean();
}