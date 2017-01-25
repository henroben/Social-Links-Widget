<?php

class Social_Links_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		parent::__construct(
			'social_links_widget', // Base ID
			esc_html__( 'Social Links Widget', 'sl_domain' ), // Name
			array( 'description' => esc_html__( 'Outputs social icons linked to profiles', 'sl_domain' ), ) // Args
		);
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		// outputs the content of the widget
		// get links
		$links = array(
			'facebook' => esc_attr($instance['facebook_link']),
			'twitter' => esc_attr($instance['twitter_link']),
			'linkedin' => esc_attr($instance['linkedin_link']),
			'googleplus' => esc_attr($instance['googleplus_link'])
		);
		// get icons
		$icons = array(
			'facebook' => esc_attr($instance['facebook_icon']),
			'twitter' => esc_attr($instance['twitter_icon']),
			'linkedin' => esc_attr($instance['linkedin_icon']),
			'googleplus' => esc_attr($instance['googleplus_icon'])
		);
		$icon_width = esc_attr($instance['icon_width']);

		echo $args['before_widget'];

		// Call Frontend function
		$this->getSocialLinks($links, $icons, $icon_width);

		echo $args['after_widget'];
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
		// outputs the options form on admin
		// call form function
		$this->getForm($instance);
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 */
	public function update( $new_instance, $old_instance ) {
		// processes widget options to be saved
		$instance = array(
			'facebook_link' => (!empty($new_instance['facebook_link'])) ? strip_tags($new_instance['facebook_link']) : '',
			'facebook_icon' => (!empty($new_instance['facebook_icon'])) ? strip_tags($new_instance['facebook_icon']) : '',
			'twitter_link' => (!empty($new_instance['twitter_link'])) ? strip_tags($new_instance['twitter_link']) : '',
			'twitter_icon' => (!empty($new_instance['twitter_icon'])) ? strip_tags($new_instance['twitter_icon']) : '',
			'linkedin_link' => (!empty($new_instance['linkedin_link'])) ? strip_tags($new_instance['linkedin_link']) : '',
			'linkedin_icon' => (!empty($new_instance['linkedin_icon'])) ? strip_tags($new_instance['linkedin_icon']) : '',
			'googleplus_link' => (!empty($new_instance['googleplus_link'])) ? strip_tags($new_instance['googleplus_link']) : '',
			'googleplus_icon' => (!empty($new_instance['googleplus_icon'])) ? strip_tags($new_instance['googleplus_icon']) : '',
			'icon_width' => (!empty($new_instance['icon_width'])) ? strip_tags($new_instance['icon_width']) : ''
		);

		return $instance;
	}

	/**
	 * Gets and displays form
	 * @param array $instance The widget options
	 */
	public function getForm( $instance ) {

		// Get Facebook Link
		if(isset($instance['facebook_link'])) {
			$facebook_link = esc_attr($instance['facebook_link']);
		} else {
			$facebook_link = 'https://www.facebook.com';
		}

		// Get Twitter Link
		if(isset($instance['twitter_link'])) {
			$twitter_link = esc_attr($instance['twitter_link']);
		} else {
			$twitter_link = 'https://www.twitter.com';
		}

		// Get LinkedIn Link
		if(isset($instance['linkedin_link'])) {
			$linkedin_link = esc_attr($instance['linkedin_link']);
		} else {
			$linkedin_link = 'https://www.linkedin.com';
		}

		// Get Google+ Link
		if(isset($instance['googleplus_link'])) {
			$googleplus_link = esc_attr($instance['googleplus_link']);
		} else {
			$googleplus_link = 'https://plus.google.com';
		}

		// ICONS

		// Get Facebook Icon
		if(isset($instance['facebook_icon'])) {
			$facebook_icon = esc_attr($instance['facebook_icon']);
		} else {
			$facebook_icon = plugins_url() . '/social-links/img/facebook.png';
		}

		// Get Twitter Icon
		if(isset($instance['twitter_icon'])) {
			$twitter_icon = esc_attr($instance['twitter_icon']);
		} else {
			$twitter_icon = plugins_url() . '/social-links/img/twitter.png';
		}

		// Get LinkedIn Icon
		if(isset($instance['linkedin_icon'])) {
			$linkedin_icon = esc_attr($instance['linkedin_icon']);
		} else {
			$linkedin_icon = plugins_url() . '/social-links/img/linkedin.png';
		}

		// Get Google+ Link
		if(isset($instance['googleplus_icon'])) {
			$googleplus_icon = esc_attr($instance['googleplus_icon']);
		} else {
			$googleplus_icon = plugins_url() . '/social-links/img/google.png';
		}

		// Get Icon Size
		if(isset($instance['icon_width'])) {
			$icon_width = esc_attr($instance['icon_width']);
		} else {
			$icon_width = 32;
		}

		?>
			<h4>Facebook</h4>
			<p>
				<label for="<?php echo $this->get_field_id('facebook_link'); ?>">
					<?php _e('Link'); ?>
				</label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('facebook_link'); ?>" name="<?php echo $this->get_field_name('facebook_link'); ?>" value="<?php echo esc_attr($facebook_link); ?>">
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('facebook_icon'); ?>">
					<?php _e('Icon'); ?>
				</label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('facebook_icon'); ?>" name="<?php echo $this->get_field_name('facebook_icon'); ?>" value="<?php echo esc_attr($facebook_icon); ?>">
			</p>

			<h4>Twitter</h4>
			<p>
				<label for="<?php echo $this->get_field_id('twitter_link'); ?>">
					<?php _e('Link'); ?>
				</label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('twitter_link'); ?>" name="<?php echo $this->get_field_name('twitter_link'); ?>" value="<?php echo esc_attr($twitter_link); ?>">
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('twitter_icon'); ?>">
					<?php _e('Icon'); ?>
				</label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('twitter_icon'); ?>" name="<?php echo $this->get_field_name('twitter_icon'); ?>" value="<?php echo esc_attr($twitter_icon); ?>">
			</p>

			<h4>LinkedIn</h4>
			<p>
				<label for="<?php echo $this->get_field_id('linkedin_link'); ?>">
					<?php _e('Link'); ?>
				</label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('linkedin_link'); ?>" name="<?php echo $this->get_field_name('linkedin_link'); ?>" value="<?php echo esc_attr($linkedin_link); ?>">
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('linkedin_icon'); ?>">
					<?php _e('Icon'); ?>
				</label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('linkedin_icon'); ?>" name="<?php echo $this->get_field_name('linkedin_icon'); ?>" value="<?php echo esc_attr($linkedin_icon); ?>">
			</p>

			<h4>Google+</h4>
			<p>
				<label for="<?php echo $this->get_field_id('googleplus_link'); ?>">
					<?php _e('Link'); ?>
				</label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('googleplus_link'); ?>" name="<?php echo $this->get_field_name('googleplus_link'); ?>" value="<?php echo esc_attr($googleplus_link); ?>">
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('googleplus_icon'); ?>">
					<?php _e('Icon'); ?>
				</label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('googleplus_icon'); ?>" name="<?php echo $this->get_field_name('googleplus_icon'); ?>" value="<?php echo esc_attr($googleplus_icon); ?>">
			</p>
			<p>
				<label for="<?php echo $this->get_field_id('icon_width'); ?>">
					<?php _e('Icons Width'); ?>
				</label>
				<input type="text" class="widefat" id="<?php echo $this->get_field_id('icon_width'); ?>" name="<?php echo $this->get_field_name('icon_width'); ?>" value="<?php echo esc_attr($icon_width); ?>">
			</p>
		<?php
	}

	/**
	 * Gets and displays Social Icons
	 * @param array $links Social links
	 * @param array $icons Social icons
	 * @param int $icon_width The width of an icon in px
	 */
	public function getSocialLinks( $links, $icons, $icon_width ) {
		?>
			<div class="social-links">
				<a target="_blank" href="<?php echo esc_attr($links['facebook']); ?>">
					<img src="<?php echo esc_attr($icons['facebook']); ?>" alt="Facebook" width="<?php echo esc_attr($icon_width); ?>">
				</a>
			</div>
			<div class="social-links">
				<a target="_blank" href="<?php echo esc_attr($links['twitter']); ?>">
					<img src="<?php echo esc_attr($icons['twitter']); ?>" alt="Twitter" width="<?php echo esc_attr($icon_width); ?>">
				</a>
			</div>
			<div class="social-links">
				<a target="_blank" href="<?php echo esc_attr($links['linkedin']); ?>">
					<img src="<?php echo esc_attr($icons['linkedin']); ?>" alt="LinkedIn" width="<?php echo esc_attr($icon_width); ?>">
				</a>
			</div>
			<div class="social-links">
				<a target="_blank" href="<?php echo esc_attr($links['googleplus']); ?>">
					<img src="<?php echo esc_attr($icons['googleplus']); ?>" alt="Google+" width="<?php echo esc_attr($icon_width); ?>">
				</a>
			</div>

		<?php
	}
}