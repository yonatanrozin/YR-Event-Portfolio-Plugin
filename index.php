<?php 
/*
 * Plugin Name: YR Custom Blocks
 * Description: Custom blocks and post types for simple artist portfolios.
 * Author: Yonatan Rozin
 * Author URI: https://yonatanrozin.com
 */


//register Event post type
add_action( 'init', function() {
	register_post_type( 'event', array(
        'labels' => array(
            'name' => 'Events',
            'singular_name' => 'Event',
            'menu_name' => 'Events',
            'all_items' => 'All Events',
            'edit_item' => 'Edit Event',
            'view_item' => 'View Event',
            'view_items' => 'View Events',
            'add_new_item' => 'Add New Event',
            'add_new' => 'Add New Event',
            'new_item' => 'New Event',
            'parent_item_colon' => 'Parent Event:',
            'search_items' => 'Search Events',
            'not_found' => 'No events found',
            'not_found_in_trash' => 'No events found in Trash',
            'archives' => 'Event Archives',
            'attributes' => 'Event Attributes',
            'insert_into_item' => 'Insert into event',
            'uploaded_to_this_item' => 'Uploaded to this event',
            'filter_items_list' => 'Filter events list',
            'filter_by_date' => 'Filter events by date',
            'items_list_navigation' => 'Events list navigation',
            'items_list' => 'Events list',
            'item_published' => 'Event published.',
            'item_published_privately' => 'Event published privately.',
            'item_reverted_to_draft' => 'Event reverted to draft.',
            'item_scheduled' => 'Event scheduled.',
            'item_updated' => 'Event updated.',
            'item_link' => 'Event Link',
            'item_link_description' => 'A link to a event.',
        ),
        'public' => true,
        'hierarchical' => true,
        'show_in_rest' => true,
        'menu_icon' => 'dashicons-calendar-alt',
        'supports' => array(
            0 => 'title',
            1 => 'editor',
            2 => 'excerpt',
            3 => 'thumbnail',
            4 => 'custom-fields',
        ),
        'taxonomies' => array(
            0 => 'event-type',
            1 => 'artist-program',
        ),
        'has_archive' => 'events',
        'rewrite' => array(
            'feeds' => false,
        ),
        'delete_with_user' => false,
    ) );
} );


//register ACF blocks
add_action('acf/init', function() {
    register_block_type(__DIR__. '/blocks/acf-dates');
    register_block_type(__DIR__. '/blocks/acf-times');
    register_block_type(__DIR__. '/blocks/event-calendar');
    register_block_type(__DIR__. '/blocks/featured-items-carousel');
});
    
add_action('init', function() {
    register_block_type(__DIR__. '/build/post-type-filter');
});


//register ACF fields
add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

    //event post type
	acf_add_local_field_group( array(
        'key' => 'group_671a92937db27',
        'title' => 'Event Details',
        'fields' => array(
            array(
                'key' => 'field_671a92935f113',
                'label' => 'Date',
                'name' => 'date',
                'aria-label' => '',
                'type' => 'date_picker',
                'instructions' => '',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'display_format' => 'M j, Y',
                'return_format' => 'M j, Y',
                'first_day' => 1,
                'allow_in_bindings' => 0,
                'default_to_current_date' => 0,
            ),
            array(
                'key' => 'field_671a92b9fe1c7',
                'label' => 'End date',
                'name' => 'end_date',
                'aria-label' => '',
                'type' => 'date_picker',
                'instructions' => 'Set to start date for single-day events.',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'display_format' => 'M j, Y',
                'return_format' => 'M j, Y',
                'first_day' => 1,
                'allow_in_bindings' => 0,
                'default_to_current_date' => 0,
            ),
            array(
                'key' => 'field_671a94d1491a3',
                'label' => 'Time',
                'name' => 'time',
                'aria-label' => '',
                'type' => 'time_picker',
                'instructions' => 'Ignore for all-day events.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'display_format' => 'g:ia',
                'return_format' => 'g:ia',
                'allow_in_bindings' => 0,
            ),
            array(
                'key' => 'field_671a95018c6e8',
                'label' => 'End time',
                'name' => 'end_time',
                'aria-label' => '',
                'type' => 'time_picker',
                'instructions' => 'Ignore for all-day events or events with no specified duration/end time.',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_671a94d1491a3',
                            'operator' => '!=empty',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'display_format' => 'g:ia',
                'return_format' => 'g:ia',
                'allow_in_bindings' => 1,
            ),
            array(
                'key' => 'field_6732338d57a3f',
                'label' => 'Location',
                'name' => 'location',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'The name of the event location/venue.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'maxlength' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_69668a54ae793',
                'label' => 'Location URL',
                'name' => 'location_url',
                'aria-label' => '',
                'type' => 'url',
                'instructions' => '(optional) Link to a dedicated website for the event location. NOT the event website!',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
            ),
            array(
                'key' => 'field_676326dc7aa54',
                'label' => 'Address',
                'name' => 'address',
                'aria-label' => '',
                'type' => 'textarea',
                'instructions' => 'Full address of event location, NOT including the name of the venue! Use "location" field above for name of venue.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'maxlength' => '',
                'allow_in_bindings' => 1,
                'rows' => 3,
                'placeholder' => '',
                'new_lines' => 'br',
            ),
            array(
                'key' => 'field_69668ac1d2009',
                'label' => 'Website',
                'name' => 'website',
                'aria-label' => '',
                'type' => 'url',
                'instructions' => '(optional) URL of a dedicated website for the event. NOT the event venue!',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'post_type',
                    'operator' => '==',
                    'value' => 'event',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'side',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 1,
        'display_title' => '',
    ) );

    //acf dates block
	acf_add_local_field_group( array(
        'key' => 'group_694c2a075be74',
        'title' => 'ACF Dates Block Fields',
        'fields' => array(
            array(
                'key' => 'field_694c2a0778ba4',
                'label' => 'Start Date Field Name',
                'name' => 'start_date_field_name',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'The name of the ACF field containing the start date',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'date',
                'maxlength' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_694c2af179965',
                'label' => 'PHP Date Format',
                'name' => 'format',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'The PHP date format string to use for the start date.',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'F j, Y',
                'maxlength' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_694c2a3778ba5',
                'label' => 'End Date Field Name',
                'name' => 'end_date_field_name',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'The name of the ACF field containing the end date. Leave blank to hide the end date.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'end_date',
                'maxlength' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_694c2b4c79967',
                'label' => 'PHP End Date Format',
                'name' => 'end_format',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'The PHP date format string to use for the end date.',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_694c2a3778ba5',
                            'operator' => '!=empty',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'F j, Y',
                'maxlength' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_694c2ed618f21',
                'label' => 'Same Year Start Date Format',
                'name' => 'same_year_start_format',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'An optional PHP date format to use for the start date if the start and end dates are on the same year.',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_694c2a3778ba5',
                            'operator' => '!=empty',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'F j',
                'maxlength' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'yr/acf-dates',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
        'display_title' => '',
    ) );

    //acf times block
	acf_add_local_field_group( array(
        'key' => 'group_69573f05382a0',
        'title' => 'ACF Times Block Fields',
        'fields' => array(
            array(
                'key' => 'field_69573f053e50b',
                'label' => 'Start Time Field Name',
                'name' => 'start_time_field_name',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'The name of the ACF field containing the (start) time',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'time',
                'maxlength' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_69573f0542139',
                'label' => 'PHP Time Format',
                'name' => 'format',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'The PHP time format string to use for the starting time.',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'g:ia',
                'maxlength' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_69573f0545abd',
                'label' => 'End Time Field Name',
                'name' => 'end_time_field_name',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'The name of the ACF field containing the end time. Leave blank to hide the end time.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'end_time',
                'maxlength' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_69573f0549403',
                'label' => 'PHP End Time Format',
                'name' => 'end_format',
                'aria-label' => '',
                'type' => 'text',
                'instructions' => 'The PHP time format string to use for the end time.',
                'required' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_69573f0545abd',
                            'operator' => '!=empty',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 'g:ia',
                'maxlength' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'yr/acf-times',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
        'display_title' => '',
    ) );

    //featured items carousel block
    acf_add_local_field_group( array(
        'key' => 'group_6967c658cbe81',
        'title' => 'Featured Items Carousel Options',
        'fields' => array(
            array(
                'key' => 'field_694c71039b779',
                'label' => 'Auto-Scroll Interval',
                'name' => 'scroll_interval',
                'aria-label' => '',
                'type' => 'number',
                'instructions' => 'A time interval (in seconds) at which the carousel will auto-scroll to the next item if not moused over.',
                'required' => 1,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => 5,
                'min' => '',
                'max' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'step' => '.5',
                'prepend' => '',
                'append' => 'sec',
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'yr/featured-items-carousel',
                )
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
        'display_title' => '',
    ) );

    //event calendar block
    acf_add_local_field_group( array(
		'key' => 'group_694d69c845d70',
		'title' => 'Event Calendar Options',
		'fields' => array(
			array(
				'key' => 'field_694d69cac3488',
				'label' => 'Has Event Color',
				'name' => 'has_event_color',
				'aria-label' => '',
				'type' => 'color_picker',
				'instructions' => 'Specify the color to use to highlight days with ongoing events.',
				'required' => 1,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '#000000',
				'enable_opacity' => 0,
				'return_format' => 'string',
				'allow_in_bindings' => 0,
				'show_custom_palette' => 1,
				'custom_palette_source' => 'themejson',
				'show_color_wheel' => 1,
				'palette_colors' => '',
			),
			array(
				'key' => 'field_694da2cbe5f25',
				'label' => 'Selected Day Outline Color',
				'name' => 'selected_day_color',
				'aria-label' => '',
				'type' => 'color_picker',
				'instructions' => 'Specify the color of the selected day outline or leave blank to disable day selection.',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'default_value' => '#000000',
				'enable_opacity' => 0,
				'return_format' => 'string',
				'allow_in_bindings' => 0,
				'show_custom_palette' => 1,
				'custom_palette_source' => 'themejson',
				'show_color_wheel' => 1,
				'palette_colors' => '',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'block',
					'operator' => '==',
					'value' => 'yr/event-calendar',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'show_in_rest' => 0,
		'display_title' => '',
	) );
} );


//event index main query args
add_action( 'pre_get_posts', function( $query ) {
    if ( ! is_admin() && $query->is_main_query() && is_post_type_archive( 'event' ) ) {
                
        $dateParam = $_GET['date'];
        $calendarDate = date_create_from_format("Ym", $dateParam);
        if (!$calendarDate) $calendarDate = new DateTime();
        $yearView = $calendarDate->format("Y");
        $monthView = $calendarDate->format("m");
        
        $queryDate = new DateTime(); 
        $queryDateEnd = new DateTime(); 
        
        $query->set( 'posts_per_page', -1 );

        //order by start date
        $query->set( 'meta_key', 'date' );
        $query->set( 'orderby', 'meta_value_num' );
        $query->set( 'order', 'ASC' );

        //query starts at start of month
        $queryDate->setDate($yearView, $monthView, 1);

        //date specified? query ends at start of following month
        if (isset($dateParam)) $queryDateEnd->setDate($yearView, $monthView + 1, 1);
        else $queryDateEnd->setDate($yearView+1000, $monthView, 1);

        $query->set( 'meta_query', array(
            'relation' => 'AND',
            array(
                'key' => 'date',
                'compare' => '<=',
                'value' => $queryDateEnd->format( 'Ymd' ),
                'type' => 'NUMERIC'
            ),
            array(
                'key' => 'end_date',
                'compare' => '>=',
                'value' => $queryDate->format( 'Ymd' ),
                'type' => 'NUMERIC'
            )
        ) );
    }
});
