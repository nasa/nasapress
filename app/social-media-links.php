<?php

// Adds widget: Social Media Links
class Socialmedialinks_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'socialmedialinks_widget',
			esc_html__( 'Social Media Links', 'textdomain' ),
			array( 'description' => esc_html__( 'Add various social media links to your NASAPress WordPress site.', 'textdomain' ), ) // Args
		);
	}

	private $widget_fields = array(
		array(
			'label' => 'Facebook',
			'id' => 'sm_link_facebook',
			'type' => 'url',
		),
		array(
			'label' => 'Twitter',
			'id' => 'sm_link_twitter',
			'type' => 'url',
		),
		array(
			'label' => 'Youtube',
			'id' => 'sm_link_youtube',
			'type' => 'url',
		),
		array(
			'label' => 'Instagram',
			'id' => 'sm_link_instagram',
			'type' => 'url',
		),
		array(
			'label' => 'Flickr',
			'id' => 'sm_link_flickr',
			'type' => 'url',
		),
	);

	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		// Output generated fields
		
		if ( ! empty($instance['sm_link_facebook'])) {
			echo '<a class="usa-link-facebook" title="Follow us on Facebook" target="_blank" href="'.$instance['sm_link_facebook'].'"></a>';
		}
		
		if ( ! empty($instance['sm_link_twitter'])) {
			echo '<a class="usa-link-twitter" title="Follow us on Twitter" target="_blank" href="'.$instance['sm_link_twitter'].'"></a>';
		}
		
		if ( ! empty($instance['sm_link_youtube'])) {
			echo '<a class="usa-link-youtube" title="Follow us on YouTube" target="_blank" href="'.$instance['sm_link_youtube'].'"></a>';
		}
		
		if ( ! empty($instance['sm_link_instagram'])) {
			echo '<a class="usa-link-instagram" title="Follow us on Instagram" target="_blank" href="'.$instance['sm_link_instagram'].'"></a>';
		}
		
		if ( ! empty($instance['sm_link_flickr'])) {
			echo '<a class="usa-link-flickr" title="Follow us on Flickr" target="_blank" href="'.$instance['sm_link_flickr'].'"></a>';
		}
		
		echo $args['after_widget'];
	}

	public function field_generator( $instance ) {
		$output = '';
		foreach ( $this->widget_fields as $widget_field ) {
			$default = '';
			if ( isset($widget_field['default']) ) {
				$default = $widget_field['default'];
			}
			$widget_value = ! empty( $instance[$widget_field['id']] ) ? $instance[$widget_field['id']] : esc_html__( $default, 'textdomain' );
			switch ( $widget_field['type'] ) {
				default:
					$output .= '<p>';
					$output .= '<label for="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'">'.esc_attr( $widget_field['label'], 'textdomain' ).':</label> ';
					$output .= '<input class="widefat" id="'.esc_attr( $this->get_field_id( $widget_field['id'] ) ).'" name="'.esc_attr( $this->get_field_name( $widget_field['id'] ) ).'" type="'.$widget_field['type'].'" value="'.esc_attr( $widget_value ).'">';
					$output .= '</p>';
			}
		}
		echo $output;
	}

	public function form( $instance ) {
		$this->field_generator( $instance );
	}

	public function update( $new_instance, $old_instance ) {
		$instance = array();
		foreach ( $this->widget_fields as $widget_field ) {
			switch ( $widget_field['type'] ) {
				default:
					$instance[$widget_field['id']] = ( ! empty( $new_instance[$widget_field['id']] ) ) ? strip_tags( $new_instance[$widget_field['id']] ) : '';
			}
		}
		return $instance;
	}
}

function register_socialmedialinks_widget() {
    register_widget( __NAMESPACE__ . '\\Socialmedialinks_Widget' );
} 

add_action('widgets_init', __NAMESPACE__ . '\\register_socialmedialinks_widget');