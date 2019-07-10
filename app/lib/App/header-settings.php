<?php
// Settings Page: Header Settings
// Retrieving values: get_option( 'your_field_id' )
class headersettings_Settings_Page {

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'wph_create_settings' ) );
		add_action( 'admin_init', array( $this, 'wph_setup_sections' ) );
		add_action( 'admin_init', array( $this, 'wph_setup_fields' ) );
		add_action( 'admin_footer', array( $this, 'media_fields' ) );
		add_action( 'admin_enqueue_scripts', 'wp_enqueue_media' );
	}

	public function wph_create_settings() {
		$page_title = 'Header Settings';
		$menu_title = 'Header Settings';
		$capability = 'manage_options';
		$slug = 'headersettings';
		$callback = array($this, 'wph_settings_content');
		add_theme_page($page_title, $menu_title, $capability, $slug, $callback);
	}

	public function wph_settings_content() { ?>
		<div class="wrap">
			<h1>Header Settings</h1>
			<?php settings_errors(); ?>
			<form method="POST" action="options.php">
				<?php
					settings_fields( 'headersettings' );
					do_settings_sections( 'headersettings' );
					submit_button();
				?>
			</form>
		</div> <?php
	}

	public function wph_setup_sections() {
		add_settings_section( 'headersettings_section', 'You can configure the look of your sites header with the following settings below.', array(), 'headersettings' );
	}

	public function wph_setup_fields() {
		$fields = array(
			array(
				'label' => 'Site Logo',
				'id' => 'header_settings_logo',
				'type' => 'media',
				'section' => 'headersettings_section',
				'returnvalue' => 'id',
				'desc' => 'Select a logo that will be displayed in the left side of the main navigation menu.',
			),
			array(
				'label' => 'Site Title - Line One',
				'id' => 'header_settings_title_one',
				'type' => 'text',
				'section' => 'headersettings_section',
				'desc' => 'This should be the text you want displayed on the upper line by the site logo. This text is larger than the bottom line of text.',
				'placeholder' => 'NASA',
			),
			array(
				'label' => 'Site Title - Line Two',
				'id' => 'header_settings_title_two',
				'type' => 'text',
				'section' => 'headersettings_section',
				'desc' => 'This should be the text you want displayed on the lower line by the site logo. This text is smaller than the top line of text.',
				'placeholder' => 'Headquarters',
			),
			array(
				'label' => 'Background Color',
				'id' => 'header_settings_background_color',
				'type' => 'color',
				'section' => 'headersettings_section',
				'desc' => 'This is the background color of the navigation menu. This only takes effect on pages that the hero header is not displayed on. The default color 33 for the Red, Green, and Blue values.',
				'placeholder' => '#212121',
			),
		);
		foreach( $fields as $field ){
			add_settings_field( $field['id'], $field['label'], array( $this, 'wph_field_callback' ), 'headersettings', $field['section'], $field );
			register_setting( 'headersettings', $field['id'] );
		}
	}

	public function wph_field_callback( $field ) {
		$value = get_option( $field['id'] );
		$placeholder = '';
		if ( isset($field['placeholder']) ) {
			$placeholder = $field['placeholder'];
		}
		switch ( $field['type'] ) {
				case 'media':
					$field_url = '';
					if ($value) {
						if ($field['returnvalue'] == 'url') {
							$field_url = $value;
						} else {
							$field_url = wp_get_attachment_url($value);
						}
					}
					printf(
						'<input style="display:none;" id="%s" name="%s" type="text" value="%s"  data-return="%s"><div id="preview%s" style="margin-right:10px;border:1px solid #e2e4e7;background-color:#fafafa;display:inline-block;width: 100px;height:100px;background-image:url(%s);background-size:cover;background-repeat:no-repeat;background-position:center;"></div><input style="width: 19%%;margin-right:5px;" class="button headersettings-media" id="%s_button" name="%s_button" type="button" value="Select" /><input style="width: 19%%;" class="button remove-media" id="%s_buttonremove" name="%s_buttonremove" type="button" value="Clear" />',
						$field['id'],
						$field['id'],
						$value,
						$field['returnvalue'],
						$field['id'],
						$field_url,
						$field['id'],
						$field['id'],
						$field['id'],
						$field['id']
					);
					break;
			default:
				printf( '<input name="%1$s" id="%1$s" type="%2$s" placeholder="%3$s" value="%4$s" />',
					$field['id'],
					$field['type'],
					$placeholder,
					$value
				);
		}
		if( isset($field['desc']) ) {
			if( $desc = $field['desc'] ) {
				printf( '<p class="description">%s </p>', $desc );
			}
		}
	}
	public function media_fields() {
		?><script>
			jQuery(document).ready(function($){
				if ( typeof wp.media !== 'undefined' ) {
					var _custom_media = true,
					_orig_send_attachment = wp.media.editor.send.attachment;
					$('.headersettings-media').click(function(e) {
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

}
new headersettings_Settings_Page();