<?php

if (!function_exists('sb_all_import_adforest')) {

    function sb_all_import_adforest() {

        $my_addon = new RapidAddon('Adforest - All import add-on', 'sb-data-importer');
        // Add fields to add-on.
        $my_addon->add_field('_adforest_poster_name', __('Ad poster name', 'sb-data-importer'), 'text', null, '');
        $my_addon->add_field('_sb_photo_arrangement_', __('Ad Images (seperated by comma)', 'sb-data-importer'), 'text', null, '');
        $my_addon->add_field('_adforest_poster_contact', __('Ad poster contact', 'sb-data-importer'), 'text', null, '');
        $my_addon->add_field('_adforest_ad_location', __('Ad location', 'sb-data-importer'), 'text', null, __('Ad poster location.', 'sb-data-importer'));

        $sb_data = array();
        $types = sb_all_import_get_cats('ad_type', 0);
        foreach ($types as $type) {
            $sb_data[$type->name] = $type->name;
        }

        $my_addon->add_field('_adforest_ad_type', __('Ad type', 'sb-data-importer'), 'radio', $sb_data);

        $sb_data = array('' => __('None', 'sb-data-importer'));
        $types = sb_all_import_get_cats('ad_condition', 0);
        foreach ($types as $type) {
            $sb_data[$type->name] = $type->name;
        }
        $my_addon->add_field('_adforest_ad_condition', __('Ad condition', 'sb-data-importer'), 'radio', $sb_data);


        $sb_data = array('' => __('None', 'sb-data-importer'));
        $types = sb_all_import_get_cats('ad_warranty', 0);
        foreach ($types as $type) {
            $sb_data[$type->name] = $type->name;
        }
        $my_addon->add_field('_adforest_ad_warranty', __('Ad warranty', 'sb-data-importer'), 'radio', $sb_data);


        $my_addon->add_field('_adforest_ad_price', __('Ad price', 'sb-data-importer'), 'text', null, __('Price or keep it empty if not applicable.', 'sb-data-importer'));

        $my_addon->add_field('_adforest_ad_price_type', __('Ad price type', 'sb-data-importer'), 'text', null, __('It can be fixed, negotiable or free or keep it empty if not applicable.', 'sb-data-importer'));

        $my_addon->add_field('_adforest_ad_currency', __('Currency', 'sb-data-importer'), 'text', null, __('Price in currency', 'sb-data-importer'));

        $my_addon->add_field('_adforest_ad_map_lat', __('Latitude', 'sb-data-importer'), 'text', null, __('Latitude for Google map.', 'sb-data-importer'));

        $my_addon->add_field('_adforest_ad_map_long', __('Logitude', 'sb-data-importer'), 'text', null, __('Logitude for Google map.', 'sb-data-importer'));


        $my_addon->add_field('_adforest_ad_bidding', __('Allow bidding on Ad? Use 1 for ON and 0 for OFF', 'sb-data-importer'), 'radio', array(
            '0' => __('Off', 'sb-data-importer'),
            '1' => __('On', 'sb-data-importer')
                )
        );

        $my_addon->add_field('_adforest_ad_bidding_date', __('Bidding end date', 'sb-data-importer'), 'text', null, __('If empty then bidding remain opened unless ad owner closed it.', 'sb-data-importer'));

        $my_addon->add_field('_adforest_ad_yvideo', __('Youtube video link', 'sb-data-importer'), 'text', null, '');

        $my_addon->add_field('_adforest_ad_status_', __('Ad current status; use active, sold or expired', 'sb-data-importer'), 'radio', array(
            'active' => __('Active', 'sb-data-importer'),
            'sold' => __('Sold', 'sb-data-importer'),
            'expired' => __('Expired', 'sb-data-importer')
                )
        );

        $my_addon->add_field('_adforest_is_feature', __('Ad class; use 0 for regular and 1 for featured.', 'sb-data-importer'), 'radio', array(
            '0' => __('Regular', 'sb-data-importer'),
            '1' => __('Featured', 'sb-data-importer'),
                )
        );
        $my_addon->add_field('_adforest_is_feature_date', __('Featured date', 'sb-data-importer'), 'text', null, __('The date in which ad became featured.', 'sb-data-importer'));
        $my_addon->add_field('sb_post_views_count', __('Ad views', 'sb-data-importer'), 'text', null);

        $my_addon->add_field('is_ad_booking_allow', __('Allow Booking/Appointment', 'sb-data-importer'), 'text', null ,__('1 or 0', 'sb-data-importer'));
        // Register import function.
        $my_addon->set_import_function('adforest_addon_import_function');
        // Import function.
        if (!function_exists('adforest_addon_import_function')) {
            function adforest_addon_import_function($post_id, $data, $import_options, $article) {
                //$my_addon = new RapidAddon();
                $my_addon = new RapidAddon('Adforest - All import add-on', 'sb-data-importer');
                $fields = array(
                    '_adforest_poster_name',
                    '_adforest_poster_contact',
                    '_adforest_ad_location',
                    '_adforest_ad_type',
                    '_adforest_ad_condition',
                    '_adforest_ad_warranty',
                    '_adforest_ad_price',
                    '_adforest_ad_price_type',
                    '_adforest_ad_currency',
                    '_adforest_ad_map_lat',
                    '_adforest_ad_map_long',
                    '_adforest_ad_bidding',
                    '_adforest_ad_bidding_date',
                    '_adforest_ad_yvideo',
                    '_adforest_ad_status_',
                    '_adforest_is_feature',
                    '_adforest_is_feature_date',
                    'sb_post_views_count',
                    '_sb_photo_arrangement_',
                    'is_ad_booking_allow'
                );

                foreach ($fields as $field) {
                    if (empty($article['ID']) or $my_addon->can_update_meta($field, $import_options)) {
                        if ($data[$field] != '') {
                            $sb_images = '';
                            if ($field == '_sb_photo_arrangement_' && $data[$field] != '') {
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
                                update_post_meta($post_id, $field, $data[$field]);
                            }
                        }
                    }
                }
            }

        }

        // Specify when adforest theme is active.
        $my_addon->run(
                array(
                    "themes" => array("adforest", "adforest child")
                )
        );
    }

}
add_action('init', 'sb_all_import_adforest');
