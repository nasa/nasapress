<?php

if(function_exists("register_field_group"))
{
	register_field_group(array (
		'id' => 'acf_on-this-page-settings',
		'title' => '"On this page" settings',
		'fields' => array (
			array (
				'key' => 'field_597229553989a',
				'label' => 'Hide "On this page" navigation',
				'name' => 'otp_hide',
				'type' => 'true_false',
				'message' => '',
				'default_value' => 0,
			),
			array (
				'key' => 'field_597229743989b',
				'label' => 'Heading tags to use',
				'name' => 'otp_heading_tags',
				'type' => 'radio',
				'instructions' => 'Select which tags get used to generate the "on this page" navigation.',
				'conditional_logic' => array (
					'status' => 1,
					'rules' => array (
						array (
							'field' => 'field_597229553989a',
							'operator' => '!=',
							'value' => '1',
						),
					),
					'allorany' => 'all',
				),
				'choices' => array (
					'h2,h3,h4' => 'h2, h3, and h4',
					'h2,h3' => 'h2 and h3',
					'h2' => 'h2',
				),
				'other_choice' => 0,
				'save_other_choice' => 0,
				'default_value' => 'h2,h3,h4',
				'layout' => 'horizontal',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'normal',
			'layout' => 'default',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
	register_field_group(array (
		'id' => 'acf_landing-page-settings',
		'title' => 'Landing page settings',
		'fields' => array (
			array (
				'key' => 'field_5976402d3afbf',
				'label' => 'Leading paragraph',
				'name' => 'lpt_leading_paragraph',
				'type' => 'textarea',
				'default_value' => '',
				'placeholder' => '',
				'maxlength' => 400,
				'rows' => '',
				'formatting' => 'br',
			),
		),
		'location' => array (
			array (
				array (
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'page',
					'order_no' => 0,
					'group_no' => 0,
				),
				array (
					'param' => 'page_template',
					'operator' => '==',
					'value' => 'views/template-landing.blade.php',
					'order_no' => 1,
					'group_no' => 0,
				),
			),
		),
		'options' => array (
			'position' => 'acf_after_title',
			'layout' => 'no_box',
			'hide_on_screen' => array (
			),
		),
		'menu_order' => 0,
	));
}
