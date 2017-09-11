<?php

namespace App;

/**
 * Allow the editing of NASA Official within the admin
 * panel Category Edit screen
 */
function nasa_official_edit($tag) {
	$t_id = $tag->term_id;
  $cat_meta = get_option( "category_$t_id");

	$args = array(
		'name' => 'nasa_official',
		'selected' => $cat_meta['nasa_official'],
		'show_option_none' => 'None'
	);
	?>

	<tr class="form-field">
		<th scope="row" valign="top"><label for="extra1"><?php _e('NASA Official'); ?></label></th>
		<td>
		<?php wp_dropdown_users( $args ); ?>
		<br />
		 	<span class="description"><?php _e('Select NASA Official for this category'); ?></span>
		</td>
	</tr>
	<?php
}
add_action ( 'edit_category_form_fields', 'App\\nasa_official_edit');

/**
 * Save NASA Official within the category edit page
 */
 function nasa_official_save($term_id) {
	 // Loop through meta fields
	 if ( isset( $_POST['nasa_official'] ) ) {
		 	$cat_meta['nasa_official'] = $_POST['nasa_official'];

			if($cat_meta['nasa_official'] == -1) {
				$cat_meta['nasa_official'] = '';
			}

			// Save the official
      update_option( "category_$term_id", $cat_meta );
    }
 }
add_action ( 'edited_category', 'App\\nasa_official_save');

/**
 * Retrieve NASA Official for a page
 */
 function get_nasa_official($page_id) {
	 // Get the array of categories this page is in
	 $catArray = get_the_category($page_id);
	 $officialIds = array();
	 $nasaOfficial;

	 // Loop through to find the lowest category with a NASA Official
	 foreach($catArray as $cat) {
		 $curCat = $cat;
		 $catMeta = get_option("category_".$curCat->term_id);
		 $officialId = $catMeta['nasa_official'];

		 // Follow the tree up until we find an official
		 while($curCat->category_parent != 0 && !$officialId) {
			 $curCat = $curCat->category_parent;
			 $catMeta = get_option("category_".$curCat);
			 $officialId = $catMeta['nasa_official'];
		 }

		 // Add to list of officials
		 if($officialId)
		 	array_push($officialIds, $officialId);
	 }

	 // Use default site official
	 // TODO: This shouldn't be hard-coded...
   // todo-config
	 if(!count($officialIds)) {
		 $nasaOfficial = get_user_by('login', 'rkurak');
	 } else {
		 $nasaOfficial = get_userdata( $officialIds[0] );
	 }

	 // Display the official
	 _e($nasaOfficial->display_name);
 }

