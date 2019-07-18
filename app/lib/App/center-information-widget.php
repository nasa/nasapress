<?php

// Adds widget: NASA Center Information
class centerinformation_Widget extends WP_Widget {

	function __construct() {
		parent::__construct(
			'nasacenterinformatio_widget',
			esc_html__( 'NASA Center Information', 'textdomain' ),
			array( 'description' => esc_html__( 'Add your NASA Centers information to your NASAPress WordPress Site.'), ) // Args
		);
	}

	private $widget_fields = array(
		array(
			'label' => 'Center Name',
			'id' => 'ci_name',
			'default' => 'Langley Research Center',
			'type' => 'text',
		),
		array(
			'label' => 'Street Address',
			'id' => 'ci_street_addres',
			'default' => '1 Nasa Drive',
			'type' => 'text',
		),
		array(
			'label' => 'City, State Zip Code',
			'id' => 'ci_city_state_zip',
			'default' => 'Hampton, VA 23666',
			'type' => 'text',
		),
		array(
			'label' => 'Phone Number',
			'id' => 'ci_phone',
			'default' => '(757) 864-1000',
			'type' => 'text',
		),
	);

	public function widget( $args, $instance ) {
		echo $args['before_widget'];

		// Output generated fields
		echo '<address>';
		echo '<h4 style="margin-bottom: -.5em;">'.$instance['ci_name'].'</h4>';
		echo '<p>'.$instance['ci_street_addres'].'<br>'.$instance['ci_city_state_zip'].'<br>'.$instance['ci_phone'].'</p>';
		echo '</address>';

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

function register_centerinformation_widget() {
    register_widget( __NAMESPACE__ . '\\centerinformation_Widget' );
} 

add_action('widgets_init', __NAMESPACE__ . '\\register_centerinformation_widget');