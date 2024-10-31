<?php
if ( ! function_exists( 'sb_all_import_nokri' ) )
{
	function sb_all_import_nokri()
	{
		
	// Initialize add-on.
	$my_addon = new RapidAddon('Nokri - All import add-on', 'sb-data-importer');
	
	// Add fields to add-on.
	$my_addon->add_field('_job_date', __('Application deadline', 'sb-data-importer' ), 'text',null, 'm/d/Y eg: 04/03/2018');
	$my_addon->add_field('_job_posts', __('Number of vacancies', 'sb-data-importer' ), 'text',null);
	$my_addon->add_field('_job_address',__('Map Address', 'sb-data-importer' ), 'text',null, __('Address for map view', 'sb-data-importer' ));
	$my_addon->add_field('_job_lat',__('Latitude', 'sb-data-importer' ), 'text',null, __('Latitude for map view', 'sb-data-importer' ));
	$my_addon->add_field('_job_long',__('Longitude', 'sb-data-importer' ), 'text',null, __('Longitude for map view', 'sb-data-importer' ));
	
	$my_addon->add_field('_job_status',__('Job can be active or inactive', 'sb-data-importer' ), 'radio',
		array(
			'active' => __('Active', 'sb-data-importer' ),
			'inactive' => __('Inactive', 'sb-data-importer' )
		)
	);
	
	
	
	// Register import function.
	$my_addon->set_import_function('nokri_addon_import_function');
	
	
	// Import function.
	if( !function_exists( 'nokri_addon_import_function' ) )
	{
		 function nokri_addon_import_function( $post_id, $data, $import_options, $article ) {
		 $my_addon = new RapidAddon('Nokri - All import add-on', 'sb-data-importer');
		 $fields = array(
				'_job_date',
				'_job_posts',
				'_job_address',
				'_job_lat',
				'_job_long',
				'_job_status',
				  );
		        foreach ( $fields as $field )
				{
					if ( empty( $article['ID'] ) or $my_addon->can_update_meta( $field, $import_options ) )
				   {
						update_post_meta( $post_id, $field, $data[ $field ] );
				   }
		  		}  
		}
	}
	
	// Specify when Nokri theme is active.
	$my_addon->run(
		array(
			"themes" => array("Nokri", "Nokri child")
		)
	);
	}
}
add_action( 'init', 'sb_all_import_nokri' );