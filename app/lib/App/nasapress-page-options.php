<?php
// Meta Box Class: NASAPress Page Options
// Get the field value: $metavalue = get_post_meta( $post_id, $field_id, true );
class nasapresspageoptionsMetabox {

	private $screen = array(
		'page',
	);

	private $meta_fields = array(
		array(
			'label' => 'Display Hero Header (Selecting NO will also cause the Header Image, Leading Paragraph and Page Title to not be displayed)?',
			'id' => 'options_display_hero',
			'default' => 'Yes',
			'type' => 'select',
			'options' => array(
				'Yes',
				'No',
			),
		),
		array(
			'label' => 'Header Image:',
			'id' => 'options_header_image_url',
			'returnvalue' => 'id',
			'type' => 'media',
		),
		array(
			'label' => 'Header Size (any valid CSS sizing tag will work. Example: 25rem):',
			'id' => 'options_header_size',
			'default' => '50rem',
			'type' => 'text',
		),
		array(
			'label' => 'Display the page title?',
			'id' => 'options_display_title',
			'default' => 'Yes',
			'type' => 'select',
			'options' => array(
				'Yes',
				'No',
			),
		),
		array(
			'label' => 'Display custom page title?',
			'id' => 'options_custom_title_select',
			'default' => 'No',
			'type' => 'select',
			'options' => array(
				'Yes',
				'No',
			),
		),
		array(
			'label' => 'Enter a custom page title (Only displayed if you set the above setting to Yes):',
			'id' => 'options_custom_title',
			'type' => 'text',
		),
		array(
			'label' => 'Leading Paragraph:',
			'id' => 'options_leading_paragraph',
			'type' => 'textarea',
		),
		array(
			'label' => 'Display the left navigation menu?',
			'id' => 'options_display_menu',
			'default' => 'Yes',
			'type' => 'select',
			'options' => array(
				'Yes',
				'No',
			),
		),
		array(
			'label' => 'Select the nagivation menu type:',
			'id' => 'options_menu_type',
			'default' => 'Single Page Menu',
			'type' => 'select',
			'options' => array(
				'Single Page Menu',
				'Multi-page Menu',
			),
		),
		array(
			'label' => 'Which header tags should be used to build the menu?',
			'id' => 'options_tag_types',
			'default' => 'h2,h3,h4',
			'type' => 'select',
			'options' => array(
				'h2',
				'h2,h3',
				'h2,h3,h4',
			),
		),
		array(
			'label' => 'How much space do you want between the bottom of the header or hero image and your page content?',
			'id' => 'options_top_padding',
			'default' => '6rem',
			'type' => 'select',
			'options' => array(
				'0rem',
				'1rem',
				'2rem',
				'3rem',
				'4rem',
				'5rem',
				'6rem',
				'7rem',
				'8rem',
				'9rem',
				'10rem',
			),
		),
		array(
			'label' => 'What width would you like this pages content to be?',
			'id' => 'options_full_width',
			'default' => 'Default',
			'type' => 'select',
			'options' => array(
				'Default',
				'100%',
				'95%',
				'90%',
				'85%',
				'80%',
				'75%',
				'70%',
				'65%',
				'60%',
				'55%',
				'50%',
			),
		),
	);

	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'admin_footer', array( $this, 'media_fields' ) );
		add_action( 'save_post', array( $this, 'save_fields' ) );
	}

	public function add_meta_boxes() {
		foreach ( $this->screen as $single_screen ) {
			add_meta_box(
				'nasapresspageoptions',
				__( 'NASAPress Page Options', 'textdomain' ),
				array( $this, 'meta_box_callback' ),
				$single_screen,
				'advanced',
				'high'
			);
		}
	}

	public function meta_box_callback( $post ) {
		wp_nonce_field( 'nasapresspageoptions_data', 'nasapresspageoptions_nonce' );
		echo 'Specify the pages options used for this page.';
		$this->field_generator( $post );
	}
	public function media_fields() {
		?><script>
			jQuery(document).ready(function($){
				if ( typeof wp.media !== 'undefined' ) {
					var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;
					$('.nasapresspageoptions-media').click(function(e) {
						var send_attachment_bkp = wp.media.editor.send.attachment;
						var button = $(this);
						var id = button.attr('id').replace('_button', '');
						_custom_media = true;
							wp.media.editor.send.attachment = function(props, attachment){
							if ( _custom_media ) {
								if ($('input#' + id).data('return') == 'url') {
									$('input#' + id).val(attachment.url);
								} else {
									$('input#' + id).val(attachment.id);
								}
								$('div#preview'+id).css('background-image', 'url('+attachment.url+')');
							} else {
								return _orig_send_attachment.apply( this, [props, attachment] );
							};
						}
						wp.media.editor.open(button);
						return false;
					});
					$('.add_media').on('click', function(){
						_custom_media = false;
					});
					$('.remove-media').on('click', function(){
						var parent = $(this).parents('td');
						parent.find('input[type="text"]').val('');
						parent.find('div').css('background-image', 'url()');
					});
				}
			});
		</script><?php
	}

	public function field_generator( $post ) {
		$output = '';
		foreach ( $this->meta_fields as $meta_field ) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
			$meta_value = get_post_meta( $post->ID, $meta_field['id'], true );
			if ( empty( $meta_value ) ) {
				if ( isset( $meta_field['default'] ) ) {
					$meta_value = $meta_field['default'];
				}
			}
			switch ( $meta_field['type'] ) {
				case 'media':
					$meta_url = '';
						if ($meta_value) {
							if ($meta_field['returnvalue'] == 'url') {
								$meta_url = $meta_value;
							} else {
								$meta_url = wp_get_attachment_url($meta_value);
							}
						}
					$input = sprintf(
						'<input style="display:none;" id="%s" name="%s" type="text" value="%s"  data-return="%s"><div id="preview%s" style="margin-right:10px;border:1px solid #e2e4e7;background-color:#fafafa;display:inline-block;width: 100px;height:100px;background-image:url(%s);background-size:cover;background-repeat:no-repeat;background-position:center;"></div><input style="width: 19%%;margin-right:5px;" class="button nasapresspageoptions-media" id="%s_button" name="%s_button" type="button" value="Select" /><input style="width: 19%%;" class="button remove-media" id="%s_buttonremove" name="%s_buttonremove" type="button" value="Clear" />',
						$meta_field['id'],
						$meta_field['id'],
						$meta_value,
						$meta_field['returnvalue'],
						$meta_field['id'],
						$meta_url,
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['id']
					);
					break;
				case 'select':
					$input = sprintf(
						'<select id="%s" name="%s">',
						$meta_field['id'],
						$meta_field['id']
					);
					foreach ( $meta_field['options'] as $key => $value ) {
						$meta_field_value = !is_numeric( $key ) ? $key : $value;
						$input .= sprintf(
							'<option %s value="%s">%s</option>',
							$meta_value === $meta_field_value ? 'selected' : '',
							$meta_field_value,
							$value
						);
					}
					$input .= '</select>';
					break;
				case 'textarea':
					$input = sprintf(
						'<textarea style="width: 100%%" id="%s" name="%s" rows="5">%s</textarea>',
						$meta_field['id'],
						$meta_field['id'],
						$meta_value
					);
					break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$meta_field['type'] !== 'color' ? 'style="width: 100%"' : '',
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}
			$output .= $this->format_rows( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}

	public function format_rows( $label, $input ) {
		return '<tr><th>'.$label.'</th><td>'.$input.'</td></tr>';
	}

	public function save_fields( $post_id ) {
		if ( ! isset( $_POST['nasapresspageoptions_nonce'] ) )
			return $post_id;
		$nonce = $_POST['nasapresspageoptions_nonce'];
		if ( !wp_verify_nonce( $nonce, 'nasapresspageoptions_data' ) )
			return $post_id;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
		foreach ( $this->meta_fields as $meta_field ) {
			if ( isset( $_POST[ $meta_field['id'] ] ) ) {
				switch ( $meta_field['type'] ) {
					case 'email':
						$_POST[ $meta_field['id'] ] = sanitize_email( $_POST[ $meta_field['id'] ] );
						break;
					case 'text':
						$_POST[ $meta_field['id'] ] = sanitize_text_field( $_POST[ $meta_field['id'] ] );
						break;
				}
				update_post_meta( $post_id, $meta_field['id'], $_POST[ $meta_field['id'] ] );
			} else if ( $meta_field['type'] === 'checkbox' ) {
				update_post_meta( $post_id, $meta_field['id'], '0' );
			}
		}
	}
}

if (class_exists('nasapresspageoptionsMetabox')) {
	new nasapresspageoptionsMetabox;
};