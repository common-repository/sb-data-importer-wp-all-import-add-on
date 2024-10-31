<?php
if ( ! function_exists( 'sb_all_import_dwt_listing' ) )
{
	function sb_all_import_dwt_listing()
	{
	// Initialize add-on.
	$my_addon = new RapidAddon('DWT Listing - All Import Add-on', 'sb-data-importer');
	
	// Add fields to add-on.
	$my_addon->add_field('dwt_listing_listing_contact', __('Listing Contact No', 'sb-data-importer' ), 'text',null, 'Contact Number');
	$my_addon->add_field('dwt_listing_listing_weburl', __('Listing Website URL', 'sb-data-importer' ), 'text',null, __('https://www.yourdomain.com/', 'sb-data-importer' ));
		
	$sb_data	=	array();
	$types	=	sb_all_import_get_cats('l_price_type' , 0 );
	foreach( $types as $type )
	{
		$sb_data[$type->term_id] = $type->name;
	}
	$my_addon->add_field('dwt_listing_listing_priceType',__('Select Price Type', 'sb-data-importer' ), 'radio', $sb_data);
	
	//Currency
	$sb_data_curr	=	array();
	$currenecy_types	=	sb_all_import_get_cats('l_currency' , 0 );
	foreach( $currenecy_types as $type )
	{
		$sb_data_curr[$type->term_id] = $type->name;
	}
	$my_addon->add_field('dwt_listing_listing_currencyType',__('Listing Currency', 'sb-data-importer' ), 'radio', $sb_data_curr);
	
	$my_addon->add_field('dwt_listing_listing_pricefrom', __('Price From', 'sb-data-importer' ), 'text',null, __('Listing Price From', 'sb-data-importer' ));
	
	
	
	$my_addon->add_field('dwt_listing_listing_priceto', __('Price To', 'sb-data-importer' ), 'text',null, __('Listing Price To', 'sb-data-importer' ));
	$my_addon->add_field('dwt_listing_listing_video', __('Video Link', 'sb-data-importer' ), 'text',null, __('eg https://www.youtube.com/watch?v=h9AOEIfDFZE', 'sb-data-importer' ));
	
	$my_addon->add_field('dwt_listing_listing_street', __('Listing Street Address', 'sb-data-importer' ), 'text',null, __('Arkansas, Kingman, United State', 'sb-data-importer' ));
	
	$my_addon->add_field('dwt_listing_listing_lat', __('Latitude', 'sb-data-importer' ), 'text',null, __('latitude for map view', 'sb-data-importer' ));
	$my_addon->add_field('dwt_listing_listing_long', __('Longitude', 'sb-data-importer' ), 'text',null, __('Longitude for map view', 'sb-data-importer' ));
	
	$my_addon->add_field('dwt_listing_listing_fb', __('Facebook URL', 'sb-data-importer' ), 'text',null, __('Social Media Page Link', 'sb-data-importer' ));
	$my_addon->add_field('dwt_listing_listing_tw', __('Twitter URL', 'sb-data-importer' ), 'text',null, __('Social Media Page Link', 'sb-data-importer' ));
	
	$my_addon->add_field('dwt_listing_listing_google', __('Google+ URL', 'sb-data-importer' ), 'text',null, __('Social Media Page Link', 'sb-data-importer' ));
	
	$my_addon->add_field('dwt_listing_listing_in', __('LinkedIn URL', 'sb-data-importer' ), 'text',null, __('Social Media Page Link', 'sb-data-importer' ));
	
	$my_addon->add_field('dwt_listing_coupon_title', __('Coupon Title', 'sb-data-importer' ), 'text',null, __('Title for your coupon code', 'sb-data-importer' ));
	
	$my_addon->add_field('dwt_listing_coupon_code', __('Coupon Code', 'sb-data-importer' ), 'text',null, __('Your Coupon Code ef #123-135', 'sb-data-importer' ));
	
	$my_addon->add_field('dwt_listing_coupon_refer', __('Coupon Reference WebLink', 'sb-data-importer' ), 'text',null, __('Link for your website', 'sb-data-importer' ));
	
	$my_addon->add_field('dwt_listing_coupon_desc', __('Coupon Description', 'sb-data-importer' ), 'textarea',null, __('Coupon Description', 'sb-data-importer' ));
	
	$my_addon->add_field('dwt_listing_coupon_expiry', __('Coupon Expiry Date', 'sb-data-importer' ), 'text',null, __('eg 09/28/2018 11:59 pm', 'sb-data-importer' ));

	
	$my_addon->add_field('dwt_listing_listing_status',__('Use 1 for Active listings and 0 for Inactive', 'sb-data-importer' ), 'radio',
		array(
			'1' => __('Active', 'sb-data-importer' ),
			'0' => __('Inactive', 'sb-data-importer' )
		)
	);
	
	$my_addon->add_field('dwt_listing_is_feature',__('Use 0 for simple listings and 1 for make it featured.', 'sb-data-importer' ), 'radio',
		array(
			'0' => __('Simple', 'sb-data-importer' ),
			'1' => __('Featured', 'sb-data-importer' ),
		)
	);
	$my_addon->add_field('dwt_listing_featured_for', __('Featured Date', 'sb-data-importer' ), 'text', null, __('The date in which listing became featured. eg Y-m-d', 'sb-data-importer' ));
	
	$my_addon->add_options( 
        $my_addon->add_field( 'dwt_listing_user_timezone', __('Listing Timezone <a href="http://php.net/manual/en/timezones.php" target="_blank">Timezone Lists</a>', 'sb-data-importer' ), 'text', '',__('Only valid timezone is required ', 'sb-data-importer' ) ),__('Select Business Hours', 'sb-data-importer' ),
        array(
                $my_addon->add_field( '_timingz_monday_to',__('Monday To', 'sb-data-importer' ), 'text', null, 'Example: 15:00:00' ),
                $my_addon->add_field( '_timingz_monday_from', __('Monday From', 'sb-data-importer' ), 'text', null, '18:20:00' ),
				$my_addon->add_field( '_timingz_monday_open', __('Is Opened/Closed', 'sb-data-importer' ), 'text', null, 'Use 1 for open and 0 for close' ),
				
				$my_addon->add_field( '_timingz_tuesday_to',__('Tuesday To', 'sb-data-importer' ), 'text', null, 'Example: 15:00:00' ),
                $my_addon->add_field( '_timingz_tuesday_from', __('Tuesday From', 'sb-data-importer' ), 'text', null, '18:20:00' ),
				$my_addon->add_field( '_timingz_tuesday_open', __('Is Opened/Closed', 'sb-data-importer' ), 'text', null, 'Use 1 for open and 0 for close' ),
				
				$my_addon->add_field( '_timingz_wednesday_to',__('Wednesday To', 'sb-data-importer' ), 'text', null, 'Example: 15:00:00' ),
                $my_addon->add_field( '_timingz_wednesday_from', __('Wednesday From', 'sb-data-importer' ), 'text', null, '18:20:00' ),
				$my_addon->add_field( '_timingz_wednesday_open', __('Is Opened/Closed', 'sb-data-importer' ), 'text', null, 'Use 1 for open and 0 for close' ),
				
				$my_addon->add_field( '_timingz_thursday_to',__('Thursday To', 'sb-data-importer' ), 'text', null, 'Example: 15:00:00' ),
                $my_addon->add_field( '_timingz_thursday_from', __('Thursday From', 'sb-data-importer' ), 'text', null, '18:20:00' ),
				$my_addon->add_field( '_timingz_thursday_open', __('Is Opened/Closed', 'sb-data-importer' ), 'text', null, 'Use 1 for open and 0 for close' ),
				
				$my_addon->add_field( '_timingz_friday_to',__('Friday To', 'sb-data-importer' ), 'text', null, 'Example: 15:00:00' ),
                $my_addon->add_field( '_timingz_friday_from', __('Friday From', 'sb-data-importer' ), 'text', null, '18:20:00' ),
				$my_addon->add_field( '_timingz_friday_open', __('Is Opened/Closed', 'sb-data-importer' ), 'text', null, 'Use 1 for open and 0 for close' ),
				
				$my_addon->add_field( '_timingz_saturday_to',__('Saturday To', 'sb-data-importer' ), 'text', null, 'Example: 15:00:00' ),
                $my_addon->add_field( '_timingz_saturday_from', __('Saturday From', 'sb-data-importer' ), 'text', null, '18:20:00' ),
				$my_addon->add_field( '_timingz_saturday_open', __('Is Opened/Closed', 'sb-data-importer' ), 'text', null, 'Use 1 for open and 0 for close' ),
				
				$my_addon->add_field( '_timingz_sunday_to',__('Sunday To', 'sb-data-importer' ), 'text', null, 'Example: 15:00:00' ),
                $my_addon->add_field( '_timingz_sunday_from', __('Sunday From', 'sb-data-importer' ), 'text', null, '18:20:00' ),
				$my_addon->add_field( '_timingz_sunday_open', __('Is Opened/Closed', 'sb-data-importer' ), 'text', null, 'Use 1 for open and 0 for close' ),
        )
);

$my_addon->add_field('dwt_listing_brand_name', __('Brand Name', 'sb-data-importer' ), 'text',null, __('Your brand name here', 'sb-data-importer' ));

$my_addon->add_field( 'dwt_listing_brand_img', __('Brand Featured Image', 'sb-data-importer' ), 'image', null, __('Select your brand image', 'sb-data-importer' ) );

	
	
	
	
	// Register import function.
	$my_addon->set_import_function('dwt_listing_addon_import_function');
	// Import function.
	if( !function_exists( 'dwt_listing_addon_import_function' ) )
	{
		function dwt_listing_addon_import_function( $post_id, $data, $import_options, $article ) {
		  //$my_addon = new RapidAddon();
		  $my_addon = new RapidAddon('DWT Listing - All Import Add-on', 'sb-data-importer');
		  $fields = array(
							'dwt_listing_listing_contact',
							'dwt_listing_listing_weburl',
							'dwt_listing_listing_priceType',
							'dwt_listing_listing_currencyType',
							'dwt_listing_listing_pricefrom',
							'dwt_listing_listing_priceto',
							'dwt_listing_listing_video',
							'dwt_listing_listing_street',
							'dwt_listing_listing_lat',
							'dwt_listing_listing_long',
							'dwt_listing_listing_fb',
							'dwt_listing_listing_tw',
							'dwt_listing_listing_google',
							'dwt_listing_listing_in',
							'dwt_listing_coupon_title',
							'dwt_listing_coupon_code',
							'dwt_listing_coupon_refer',
							'dwt_listing_coupon_desc',
							'dwt_listing_coupon_expiry',
							'dwt_listing_listing_status',
							'dwt_listing_is_feature',
							'dwt_listing_featured_for',
							'dwt_listing_user_timezone',
							'_timingz_monday_to',
							'_timingz_monday_from',
							'_timingz_monday_open',
							'_timingz_tuesday_to',
							'_timingz_tuesday_from',
							'_timingz_tuesday_open',
							'_timingz_wednesday_to',
							'_timingz_wednesday_from',
							'_timingz_wednesday_open',
							'_timingz_thursday_to',
							'_timingz_thursday_from',
							'_timingz_thursday_open',
							'_timingz_friday_to',
							'_timingz_friday_from',
							'_timingz_friday_open',
							'_timingz_saturday_to',
							'_timingz_saturday_from',
							'_timingz_saturday_open',
							'_timingz_sunday_to',
							'_timingz_sunday_from',
							'_timingz_sunday_open',
							'dwt_listing_brand_name',
							'dwt_listing_brand_img',
							
							
				);
		  foreach ( $fields as $field )
		  {
			if ( empty( $article['ID'] ) or $my_addon->can_update_meta( $field, $import_options ) ) {
				if($field == 'dwt_listing_listing_priceType')
				{
					$my_category = get_term_by('id', $data[ $field ], 'l_price_type');
					$id = $my_category->term_id;
					$name = $my_category->name;
					update_post_meta( $post_id, $field, $name ); 
				}
				else if($field == 'dwt_listing_listing_currencyType')
				{
					$price_type = get_term_by('id', $data[$field], 'l_currency');
					$term_id = $price_type->term_id;
					$term_name = $price_type->name;
					update_post_meta( $post_id, $field, $term_name ); 
				}
				else if($field == 'dwt_listing_user_timezone')
				{
					update_post_meta( $post_id, 'dwt_listing_user_timezone', $data[ $field ] ); 
					update_post_meta( $post_id, 'dwt_listing_is_hours_allow', 1 ); 
				}
				else if($field == 'dwt_listing_brand_img')
				{
					$attachment_id = '';
					$attachment_id = $data['dwt_listing_brand_img']['attachment_id'];
					update_post_meta( $post_id, 'dwt_listing_brand_img',$attachment_id); 
				}
				else
				{
			 		 update_post_meta( $post_id, $field, $data[ $field ] );      
				}
			}    
		  }  
		}
	}
	
	// Specify when adforest theme is active.
	$my_addon->run(
		array(
			"themes" => array("DWT Listing", "DWT Listing Child")
		)
	);
	}
}
add_action( 'init', 'sb_all_import_dwt_listing' );