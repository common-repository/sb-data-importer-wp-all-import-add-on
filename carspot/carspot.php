<?php

if (!function_exists('sb_all_import_adforest')) {

    function sb_all_import_adforest() {

        $my_addon = new RapidAddon('Carspot - All import add-on', 'sb-data-importer');
        // Add fields to add-on.
        $my_addon->add_field('_carspot_poster_name', __('Ad poster name', 'sb-data-importer'), 'text', null, '');
        $my_addon->add_field('_carspot_poster_contact', __('Ad poster contact', 'sb-data-importer'), 'text', null, '');
        $my_addon->add_field('_carspot_ad_map_location', __('Ad location', 'sb-data-importer'), 'text', null, __('Ad poster location.', 'sb-data-importer'));

        $sb_data = array();
        $types = sb_all_import_get_cats('ad_type', 0);
        foreach ($types as $type) {
            $sb_data[$type->name] = $type->name;
        }

        $my_addon->add_field('_carspot_ad_type', __('Ad type', 'sb-data-importer'), 'text', $sb_data);

        $sb_data = array('' => __('None', 'sb-data-importer'));
        $types = sb_all_import_get_cats('ad_condition', 0);
        foreach ($types as $type) {
            $sb_data[$type->name] = $type->name;
        }
        $my_addon->add_field('_carspot_ad_condition', __('Ad condition', 'sb-data-importer'), 'text', $sb_data);


        $sb_data = array('' => __('None', 'sb-data-importer'));
        $types = sb_all_import_get_cats('ad_warranty', 0);
        foreach ($types as $type) {
            $sb_data[$type->name] = $type->name;
        }
        $my_addon->add_field('_carspot_ad_warranty', __('Ad warranty', 'sb-data-importer'), 'text', $sb_data);

        $sb_data = array('' => __('None', 'sb-data-importer'));
        $types = sb_all_import_get_cats('ad_years', 0);
        foreach ($types as $type) {
            $sb_data[$type->name] = $type->name;
        }
        $my_addon->add_field('_carspot_ad_years', __('Modal year', 'sb-data-importer'), 'text', $sb_data);

        $sb_data = array('' => __('None', 'sb-data-importer'));
        $types = sb_all_import_get_cats('ad_body_types', 0);
        foreach ($types as $type) {
            $sb_data[$type->name] = $type->name;
        }
        $my_addon->add_field('_carspot_ad_body_types', __('Body Type', 'sb-data-importer'), 'text', $sb_data);

        $sb_data = array('' => __('None', 'sb-data-importer'));
        $types = sb_all_import_get_cats('ad_transmissions', 0);
        foreach ($types as $type) {
            $sb_data[$type->name] = $type->name;
        }
        $my_addon->add_field('_carspot_ad_transmissions', __('Transmission type', 'sb-data-importer'), 'text', $sb_data);

        $sb_data = array('' => __('None', 'sb-data-importer'));
        $types = sb_all_import_get_cats('ad_engine_capacities', 0);
        foreach ($types as $type) {
            $sb_data[$type->name] = $type->name;
        }
        $my_addon->add_field('_carspot_ad_engine_capacities', __('Engine Capacity', 'sb-data-importer'), 'text', $sb_data);

        $sb_data = array('' => __('None', 'sb-data-importer'));
        $types = sb_all_import_get_cats('ad_engine_types', 0);
        foreach ($types as $type) {
            $sb_data[$type->name] = $type->name;
        }
        $my_addon->add_field('_carspot_ad_engine_types', __('Engine Type', 'sb-data-importer'), 'text', $sb_data);

        $sb_data = array('' => __('None', 'sb-data-importer'));
        $types = sb_all_import_get_cats('ad_assembles', 0);
        foreach ($types as $type) {
            $sb_data[$type->name] = $type->name;
        }
        $my_addon->add_field('_carspot_ad_assembles', __('Assemble', 'sb-data-importer'), 'text', $sb_data);

        $sb_data = array('' => __('None', 'sb-data-importer'));
        $types = sb_all_import_get_cats('ad_colors', 0);
        foreach ($types as $type) {
            $sb_data[$type->name] = $type->name;
        }
        $my_addon->add_field('_carspot_ad_colors', __('Color', 'sb-data-importer'), 'text', $sb_data);


        $sb_data = array('' => __('None', 'sb-data-importer'));
        $types = sb_all_import_get_cats('ad_insurance', 0);
        foreach ($types as $type) {
            $sb_data[$type->name] = $type->name;
        }
        $my_addon->add_field('_carspot_ad_insurance', __('Insurance', 'sb-data-importer'), 'text', $sb_data);

        $sb_data = array('' => __('None', 'sb-data-importer'));
        $types = sb_all_import_get_cats('ad_features', 0);
        foreach ($types as $type) {
            $sb_data[$type->name] = $type->name;
        }
        $my_addon->add_field('_carspot_ad_features', __('Features', 'sb-data-importer'), 'text', $sb_data);


        $my_addon->add_field('_carspot_ad_yvideo', __('Youtube video link', 'sb-data-importer'), 'text', null, '');


        $my_addon->add_field('_carspot_ad_price', __('Ad price', 'sb-data-importer'), 'text', null, __('Price or keep it empty if not applicable.', 'sb-data-importer'));

        $my_addon->add_field('_carspot_ad_price_type', __('Ad price type', 'sb-data-importer'), 'text', null, __('It can be fixed, negotiable or free or keep it empty if not applicable.', 'sb-data-importer'));

        $my_addon->add_field('_carspot_ad_avg_city', __('Average in city', 'sb-data-importer'), 'text', null, __('Average in city', 'sb-data-importer'));

        $my_addon->add_field('_carspot_ad_avg_hwy', __('Average on highway', 'sb-data-importer'), 'text', null, __('Average on highway', 'sb-data-importer'));

        $my_addon->add_field('_carspot_ad_mileage', __('Mileage', 'sb-data-importer'), 'text', null, __('Mileage', 'sb-data-importer'));

        $my_addon->add_field('_carspot_ad_map_lat', __('Latitude', 'sb-data-importer'), 'text', null, __('Latitude for map.', 'sb-data-importer'));

        $my_addon->add_field('_carspot_ad_map_long', __('Logitude', 'sb-data-importer'), 'text', null, __('Logitude for map.', 'sb-data-importer'));


        $my_addon->add_field('_carspot_ad_bidding', __('Allow bidding on Ad? Use 1 for ON and 0 for OFF', 'sb-data-importer'), 'radio', array(
            '0' => __('Off', 'sb-data-importer'),
            '1' => __('On', 'sb-data-importer')
                )
        );


        $my_addon->add_field('_carspot_ad_status_', __('Ad current status; use active, sold or expired', 'sb-data-importer'), 'text', array(
            'active' => __('Active', 'sb-data-importer'),
            'sold' => __('Sold', 'sb-data-importer'),
            'expired' => __('Expired', 'sb-data-importer')
                )
        );

        $my_addon->add_field('_carspot_is_feature', __('Ad class; use 0 for regular and 1 for featured.', 'sb-data-importer'), 'text', array(
            '0' => __('Regular', 'sb-data-importer'),
            '1' => __('Featured', 'sb-data-importer'),
                )
        );

        $my_addon->add_field('_carspot_is_feature_date', __('Featured date', 'sb-data-importer'), 'text', null, __('The date in which ad became featured.', 'sb-data-importer'));
        $my_addon->add_field('sb_post_views_count', __('Ad views', 'sb-data-importer'), 'text', null);
        $my_addon->add_field('carspot_photo_arrangement_', __('Ad Images (seperated by comma)', 'sb-data-importer'), 'text', null, '');
        // Register import function.
        $my_addon->set_import_function('carspot_addon_import_function');


        // Import function.
        if (!function_exists('carspot_addon_import_function')) {

            function carspot_addon_import_function($post_id, $data, $import_options, $article) {
                //$my_addon = new RapidAddon();
                $my_addon = new RapidAddon('Carspot - All import add-on', 'sb-data-importer');

                $fields = array(
                    '_carspot_poster_name',
                    '_carspot_poster_contact',
                    '_carspot_ad_map_location',
                    '_carspot_ad_type',
                    '_carspot_ad_condition',
                    '_carspot_ad_warranty',
                    '_carspot_ad_years',
                    '_carspot_ad_body_types',
                    '_carspot_ad_transmissions',
                    '_carspot_ad_engine_capacities',
                    '_carspot_ad_engine_types',
                    '_carspot_ad_assembles',
                    '_carspot_ad_colors',
                    '_carspot_ad_insurance',
                    '_carspot_ad_features',
                    '_carspot_ad_yvideo',
                    '_carspot_ad_price',
                    '_carspot_ad_price_type',
                    '_carspot_ad_avg_city',
                    '_carspot_ad_avg_hwy',
                    '_carspot_ad_mileage',
                    '_carspot_ad_map_lat',
                    '_carspot_ad_map_long',
                    '_carspot_ad_bidding',
                    '_carspot_ad_status_',
                    '_carspot_is_feature',
                    '_carspot_is_feature_date',
                    'sb_post_views_count',
                    'carspot_photo_arrangement_'
                );

                foreach ($fields as $field) {
                    if (empty($article['ID']) or $my_addon->can_update_meta($field, $import_options)) {
                        if ($data[$field] != '') {
                            $meta_value = '';
                            $sb_images = '';
                            if ($field == 'carspot_photo_arrangement_' && $data[$field] != '') {
                                $image_url_arr = explode(',', $data[$field]);
                                if (isset($image_url_arr) && $image_url_arr != '' && is_array($image_url_arr)) {
                                    foreach ($image_url_arr as $each_url) {

                                        if ($each_url != '') {
                                            $attach_id = sb_upload_file_from_url($each_url);
                                            if ($attach_id != '') {
                                                if ($sb_images == '') {
                                                    $sb_images = $attach_id;
                                                } else {
                                                    $sb_images = $sb_images . ',' . $attach_id;
                                                }
                                            }
                                        }
                                    }
                                }
                                if ($sb_images != '') {
                                    update_post_meta($post_id, $field, $sb_images);
                                }
                            } else {

                                $meta_value = $data[$field];
                                if ($field == '_carspot_ad_map_long') {
                                    //$meta_value  = sanitize_text_field( $meta_value );
                                    $meta_value = str_replace("'", "", $meta_value);
                                }
                                update_post_meta($post_id, $field, $meta_value);
                            }
                        }
                    }
                }
            }

        }

        // Specify when adforest theme is active.
        $my_addon->run(
                array(
                    "themes" => array("carspot", "carspot child")
                )
        );
    }

}
add_action('init', 'sb_all_import_adforest');
