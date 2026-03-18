<?php
if(!defined('ABSPATH')) exit;

add_filter('woocommerce_product_data_tabs', 'eazyproo_product_data_tabs_back'); // add all custom tabs

add_action("woocommerce_product_data_panels", "eazyproo_display_overview_tab_content"); // render overview tab
add_action("woocommerce_process_product_meta", "save_overview_tab_content"); // save overview tab

add_action("woocommerce_product_data_panels", "eazyproo_display_system_requirement_tab_content"); // render system requirement tab
add_action('woocommerce_process_product_meta', 'save_system_requrement_custom_fields'); // save system requirement tab

add_action('woocommerce_product_data_panels', 'eazyproo_meta_contents_data_panel'); // render meta fields tab
add_action('woocommerce_process_product_meta', 'eazyproo_save_meta_contents_data_panel_fields'); // save meta fields tab

add_action("woocommerce_product_data_panels", "eazyproo_display_include_apps_tab_content"); // render include apps tab
add_action("woocommerce_process_product_meta", "eazyproo_save_include_apps_meta"); // save include apps tab

add_action("woocommerce_product_data_panels", "eazyproo_display_key_features_tab_content"); // render include apps tab
add_action("woocommerce_process_product_meta", "eazyproo_save_key_features"); // save include apps tab

add_action("woocommerce_product_data_panels", "eazyproo_display_notice_tab_content"); // render notice tab
add_action('woocommerce_process_product_meta', 'save_notice_system_requrement_custom_fields'); // save notice tab

add_action("woocommerce_product_data_panels", "eazyproo_faq_tab_content"); // render faq tab
add_action('woocommerce_process_product_meta', 'eazyproo_save_faq_tab_content'); // save faq tab

add_action("woocommerce_product_data_panels", "eazyproo_title_tag_tab_content"); // render title tag
add_action('woocommerce_process_product_meta', 'eazyproo_save_title_tag_tab_content'); // save title tag

add_action("woocommerce_product_data_panels", "eazyproo_delivery_notice_tab_content"); // render delivery notice
add_action('woocommerce_process_product_meta', 'eazyproo_save_delivery_notice_tab_content'); // save delivery notice



add_filter('woocommerce_product_tabs', 'eazyproo_add_product_tab_front', 99);
add_action("wp", 'eazyproo_unknown');
add_action('init', 'eazyproo_hooks');
add_action("woocommerce_single_product_summary", "eazyproo_display_meta_contents", 8);
add_action("woocommerce_single_product_summary", "eazyproo_display_include_apps_meta", 15);
add_action("woocommerce_single_product_summary", "eazyproo_display_key_features_meta", 15);
add_action('woocommerce_after_single_product', 'eazyproo_woocommerce_after_single_product', 20);

function eazyproo_product_data_tabs_back($tabs)
{
    $tabs['overview_tab_content'] = array(
        'label'    => __('EPro Overview', 'woocommerce'),
        'target'   => 'add_overview_tab_content',
        'class'    => array('show_if_simple'),
        'priority' => 12,
    );
    $tabs['system_requement_setup'] = array(
        'label'    => __('EPro System Reqs', 'woocommerce'),
        'target'   => 'system_requirement_tab_content',
        'class'    => array('show_if_simple'),
        'priority' => 12,
    );
    $tabs['eazyproo_meta_fields'] = array(
        'label'    => __('EPro Meta Fields', 'woocommerce'),
        'target'   => 'eazyproo_meta_contents_product_data',
        'class'    => array('show_if_simple'),
        'priority' => 12,
    );
    $tabs['include_apps_meta_tab'] = array(
        'label'    => __('EPro Included Apps', 'woocommerce'),
        'target'   => 'include_apps_meta_panel',
        'class'    => array('show_if_simple'),
        'priority' => 12,
    );
    $tabs['key_features_tab'] = array(
        'label'    => __('EPro Key Features', 'woocommerce'),
        'target'   => 'key_features_panel',
        'class'    => array('show_if_simple'),
        'priority' => 12,
    );
    $tabs['sp_notice_meta_tab'] = array(
        'label'    => __('EPro Notices', 'woocommerce'),
        'target'   => 'notice_requirement_tab_content',
        'class'    => array('show_if_simple'),
        'priority' => 12,
    );
    $tabs['sp_faq_meta_tab'] = array(
        'label'    => __('EPro FAQs', 'woocommerce'),
        'target'   => 'faq_tab_content',
        'class'    => array('show_if_simple'),
        'priority' => 12,
    );
    $tabs['sp_title_tag_meta_tab'] = array(
        'label'    => __('Title Tags', 'woocommerce'),
        'target'   => 'title_tag_tab_content',
        'priority' => 12,
    );
    $tabs['sp_deliver_notice_meta_tab'] = array(
        'label'    => __('Delivery Notices', 'woocommerce'),
        'target'   => 'deliver_notice_tab_content',
        'priority' => 13,
    );
    return $tabs;
}

function eazyproo_display_overview_tab_content()
{
    global $post;
    $overview_infos = get_post_meta($post->ID, "_eazyproo_overview_info", true) ?? [];
    $overview_flag_info = get_post_meta($post->ID, "_eazyproo_overview_flag_info", true) ?? [];
    $overview_titles = eazyproo_get_settings('tic_meta_overview');
    if (empty($overview_titles) || !is_array($overview_titles)) {
        return;
    }
    // echo '<pre>';
    // var_dump($overview_infos);
    // echo '</pre>';
    // die();
    ?>
    <div id='add_overview_tab_content' class='panel woocommerce_options_panel'>
        <div id="overview-wrapper" class="eazyproo-repeater" data-count="<?php echo !empty( $overview_infos ) ? esc_attr(count($overview_infos)) : esc_attr(1); ?>">
            <div class="inner-wrapper">
                <table class="eazyproo-table form-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Content</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="options_group">
                            <td>
                                <input type="text" class="full" name="eazyproo_overview_flag[title]" id="eazyproo_overview_flag[title]" placeholder="Example: Language" value="<?php echo isset($overview_flag_info['title']) ? esc_attr($overview_flag_info['title']) : 'Supported Languages'; ?>">
                            </td>
                            <td colspan="2">
                                <select id="ez_all_countries" class="short" name="eazyproo_overview_flag[content][]" multiple="multiple">
                                    <?php                                    
                                    $countries_obj   = new WC_Countries();
                                    $countries   = $countries_obj->__get('countries');
                                    $saved_countries = isset($overview_flag_info['content']) && !empty($overview_flag_info['content']) && is_array($overview_flag_info['content']) ? $overview_flag_info['content'] : [];
                                    foreach ($countries as $key => $value) {
                                        ?>
                                        <option value="<?php echo esc_attr($key); ?>" <?php  selected(in_array($key, $saved_countries)); ?>><?php echo esc_html($value . ' (' . $key . ')'); ?></option>
                                        
                                        <?php
                                    }
                                    ?>                            
                                </select>
                            </td>
                        </tr>
                        <?php 
                        if ( !empty($overview_titles) ) :
                            foreach ($overview_titles as $key => $item) : ?>
                            <tr>
                                <td>
                                    <div>
                                        <span><?php echo esc_html($item->title); ?></span>
                                        <input type="hidden" value="<?php echo esc_attr($item->id); ?>" name="eazyproo_overview[<?php echo esc_attr($key); ?>][title]">
                                    </div>
                                </td>
                                <td>
                                    <input type="text" class="full overview_content_input" name="eazyproo_overview[<?php echo esc_attr($key); ?>][content]" id="eazyproo_overview[<?php echo esc_attr($key); ?>][content]" value="<?php
                                    foreach ($overview_infos as $value) {
                                        if ($value['title'] == $item->id) {
                                            echo esc_attr($value['content']);
                                        }
                                    }
                                    ?>">
                                </td>
                                <td><button type="button" class="ez_remover_overview button button-danger">Remove</button></td>
                            </tr>
                                <?php 
                            endforeach; 
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>        

    </div>
    <?php
}

function save_overview_tab_content($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    

    if (isset($_POST["eazyproo_overview_flag"]) && !empty($_POST["eazyproo_overview_flag"])) {
        if( isset( $_POST["eazyproo_overview_flag"]['title'] ) && isset( $_POST["eazyproo_overview_flag"]['content'] ) ){
            $_POST["eazyproo_overview_flag"]['title'] = sanitize_text_field($_POST["eazyproo_overview_flag"]['title']);
            $_POST["eazyproo_overview_flag"]['content'] = array_map( 'sanitize_text_field', $_POST["eazyproo_overview_flag"]['content'] );
        }
        update_post_meta($post_id, "_eazyproo_overview_flag_info", $_POST["eazyproo_overview_flag"]);
    }

    if (isset($_POST["eazyproo_overview"]) && !empty($_POST["eazyproo_overview"])) {
        $eazyproo_overview = $_POST["eazyproo_overview"];

        foreach ($eazyproo_overview as $key => $value) {
            if (empty($value['content'])) {
                unset($eazyproo_overview[$key]);
            } else {
                $value['title'] = sanitize_text_field($value['title']);

                if (isset($value['content']) && is_array($value['content'])) {
                    $value['content'] = array_map('sanitize_text_field', $value['content']);
                } else {
                    $value['content'] = sanitize_text_field($value['content']);
                }
            }
        }

        update_post_meta($post_id, "_eazyproo_overview_info", $eazyproo_overview);
    } else {
        update_post_meta($post_id, "_eazyproo_overview_info", array());
    }
}

function eazyproo_display_system_requirement_tab_content()
{
    global $post;

    if ( empty( $post ) || ! is_object( $post ) ) {
        return;
    }

    // $sys_req__titles = get_option('eazyproo_sys_reqs_title_fields');
    $sys_req__titles = eazyproo_get_settings('tic_meta_sys_reqs');

    // Minimum Requirements
    $system_requirement_infos = get_post_meta( $post->ID, "_update_system_requirement_info", true ) ?? [];
    
    // Recommended Requirements
    $system_recommends_infos = get_post_meta( $post->ID, "_update_system_recommend_info", true ) ?? [];

    $system_requirement_recommend = get_post_meta( $post->ID, "system_requirement_recommend", true ) ?? [];



    ?>
    <div id="system_requirement_tab_content" class="panel woocommerce_options_panel">
        <div id="system_wrapper_requirements" class="eazyproo-repeater">
            <div class="inner-wrapper">
                <h3><?php esc_html_e('System Requirements and Recommends', 'eazyproo-product-meta'); ?></h3>                
                <table class="eazyproo-table form-table">
                    <thead>
                        <tr>
                            <th>Components</th>
                            <th>Requirements</th>
                            <th>Recommends</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php 
                    foreach ( $sys_req__titles as $key => $item ) : ?>
                        <tr>
                            <td>
                                <span><?php echo esc_html( $item->title ); ?></span>
                                <input type="hidden" name="system_requirement_recommend[<?php echo esc_attr( $key ); ?>][component]" value="<?php echo esc_attr( $item->title ); ?>" />
                            </td>
                            <td><input type="text" class="full" name="system_requirement_recommend[<?php echo esc_attr( $key ); ?>][requirement]" placeholder="Example: 2GB of RAM" value="<?php
                            echo isset( $system_requirement_recommend[$key]['requirement'] ) ? esc_attr( $system_requirement_recommend[$key]['requirement'] ) : ''; 
                            ?>"></td>
                            <td><input type="text" class="full" name="system_requirement_recommend[<?php echo esc_attr( $key ); ?>][recommend]" placeholder="Example: 2GB of RAM" value="<?php
                            echo isset( $system_requirement_recommend[$key]['recommend'] ) ? esc_attr( $system_requirement_recommend[$key]['recommend'] ) : '';
                            ?>"></td>
                            <td><button type="button" data-action="requirement" class="ez_remover_reqs button">Clear</button></td>
                        </tr>
                        <?php
                    endforeach; ?>
                    </tbody>
                </table>                    
            </div>
        </div>

        <div id="system_wrapper_requirements" class="eazyproo-repeater">
            <div class="inner-wrapper">
                <h3><?php esc_html_e('System Requirements', 'eazyproo-product-meta'); ?></h3>
                <table class="eazyproo-table form-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Content</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ( ! empty( $system_requirement_infos ) && is_array( $system_requirement_infos ) ) {
                            $count = 0;
                            foreach ( $system_requirement_infos as $system_requirement_info ) { ?>
                                <tr class="options_group">
                                    <td>
                                        <select name="system_requirement_info[<?php echo esc_attr( $count ); ?>][title]" id="">
                                            <option>Select</option>
                                            <?php foreach ( $sys_req__titles as $item ) : ?>
                                                <option value="<?php echo esc_attr( $item->id ); ?>" <?php selected( $system_requirement_info['title'] == $item->id ); ?>><?php echo esc_html( $item->title ); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="full" name="system_requirement_info[<?php echo esc_attr( $count ); ?>][info]" id="system_requirement_info[<?php echo esc_attr( $count ); ?>][info]" placeholder="Example: 2GB of RAM" value="<?php echo esc_attr( $system_requirement_info['info'] ); ?>">
                                    </td>
                                    <td>
                                        <button type="button" data-action="requirement" class="ez_remover_reqs button">Remove</button>
                                    </td>
                                </tr>
                                <?php 
                                $count++;
                            }
                        }else {
                            ?>
                            <tr class="options_group">
                                <td>
                                    <select name="system_requirement_info[0][title]">
                                        <option>Select</option>
                                        <?php foreach ( $sys_req__titles as $item ) : ?>
                                            <option value="<?php echo esc_attr( $item->id ); ?>"><?php echo esc_html( $item->title ); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="full" name="system_requirement_info[0][info]" id="system_requirement_info[0][info]" placeholder="Example: 2GB of RAM" value="">
                                </td>
                                <td>
                                    <button type="button" data-action="requirement" class="ez_remover_reqs button">Remove</button>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>                        
                    </tbody>
                </table>
                <button type="button" id="add-system-repeater" data-action="requirement" class="button button-primary button-large"><?php _e('Add More', 'eazyproo-product-meta'); ?></button>
            </div>
        </div>

        <div id="system_wrapper_recommends" class="eazyproo-repeater">
            <div class="inner-wrapper">
                <h3><?php esc_html_e('System Recommends', 'eazyproo-product-meta'); ?></h3>
                <table class="eazyproo-table form-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Content</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ( ! empty( $system_recommends_infos ) && is_array( $system_recommends_infos ) ) {
                            $count = 0;
                            foreach ( $system_recommends_infos as $system_recommends_info ) { ?>
                                <tr class="options_group">
                                    <td>
                                        <select name="system_recommend_info[<?php echo esc_attr( $count ); ?>][title]" id="">
                                            <option>Select</option>
                                            <?php foreach ( $sys_req__titles as $item ) : ?>
                                                <option value="<?php echo esc_attr( $item->id ); ?>" <?php selected( $system_recommends_info['title'] == $item->id ); ?>><?php echo esc_html( $item->title ); ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                    <td>
                                        <input type="text" class="full" name="system_recommend_info[<?php echo esc_attr( $count ); ?>][info]" id="system_recommends_info[<?php echo esc_attr( $count ); ?>][info]" placeholder="Example: 2GB of RAM" value="<?php echo esc_attr( $system_recommends_info['info'] ); ?>">
                                    </td>
                                    <td>
                                        <button type="button" data_action="recommend" class="ez_remover_reqs button">Remove</button>
                                    </td>
                                </tr>
                                <?php 
                                $count++;
                            }
                        }else {
                            ?>
                            <tr class="options_group">
                                <td>
                                    <select name="system_recommend_info[0][title]">
                                        <option>Select</option>
                                        <?php foreach ( $sys_req__titles as $item ) : ?>
                                            <option value="<?php echo esc_attr( $item->id ); ?>"><?php echo esc_html( $item->title ); ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" class="full" name="system_recommend_info[0][info]" id="system_recommends_info[0][info]" placeholder="Example: 2GB of RAM" value="">
                                </td>
                                <td>
                                    <button type="button" data_action="recommend" class="ez_remover_reqs button">Remove</button>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>                        
                    </tbody>
                </table>
                <button type="button" id="add-system-repeater" data-action="recommend" class="button button-primary button-large"><?php _e('Add More', 'eazyproo-product-meta'); ?></button>
            </div>
        </div>
    </div>
    <?php

}

function save_system_requrement_custom_fields($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST['system_requirement_recommend']) && !empty($_POST['system_requirement_recommend'])){
        $data = $_POST['system_requirement_recommend'];
        foreach ($data as $key => $value) {
            // var_dump($value, empty($value['requirement']) && empty($value['recommend']));
            if (empty($value['requirement']) && empty($value['recommend'])) {
                unset($data[$key]);
            }else{
                $value['requirement'] = sanitize_text_field($value['requirement']);
                $value['recommend'] = sanitize_text_field($value['recommend']);
            }
        }
        if (count($data) > 0) {
            update_post_meta($post_id, 'system_requirement_recommend', $data);
        } else {
            delete_post_meta($post_id, 'system_requirement_recommend');
        }
    }

    if (isset($_POST['system_requirement_info']) && !empty($_POST['system_requirement_info'])) {

        $requirements = $_POST['system_requirement_info'];
        foreach ($requirements as $key => $value) {
            if (empty($value['title']) || empty($value['info'])) {
                unset($requirements[$key]);
            }else{
                $value['title'] = sanitize_text_field($value['title']);
                $value['info'] = sanitize_text_field($value['info']);
            }
        }

        if (count($requirements) > 0) {
            update_post_meta($post_id, '_update_system_requirement_info', $requirements);
        } else {
            delete_post_meta($post_id, '_update_system_requirement_info');
        }
    }else{
        delete_post_meta($post_id, '_update_system_requirement_info');
    }
    
    if (isset($_POST['system_recommend_info']) && !empty($_POST['system_recommend_info'])) {

        $recommends = $_POST['system_recommend_info'];
        foreach ($recommends as $key => $value) {
            if (empty($value['title']) || empty($value['info'])) {
                unset($recommends[$key]);
            }else{
                $value['title'] = sanitize_text_field($value['title']);
                $value['info'] = sanitize_text_field($value['info']);
            }
        }

        if (count($recommends) > 0) {
            update_post_meta($post_id, '_update_system_recommend_info', $recommends);
        } else {
            delete_post_meta($post_id, '_update_system_recommend_info');
        }
    }else{
        delete_post_meta($post_id, '_update_system_recommend_info');
    }
}

function eazyproo_meta_contents_data_panel()
{
    global $post;
    if (empty($post)) {
        return;
    }

    $hooks = array(
        'eazyproo_display_custom_field_before_price' => 'Before Price',
        'eazyproo_display_content_after_price' => 'After Price',
        'eazyproo_display_content_after_add_to_cart' => 'After Add to Cart',
    );

    $hooks = apply_filters('eazyproo_custom_hooks', $hooks);
    $custom_fields = get_post_meta($post->ID, '_custom_repeater_field', true) ?: [];
    $custom_fields_titles = eazyproo_get_settings('tic_meta_custom');
    if (empty($custom_fields_titles)) {
        return;
    }
    // echo '<pre>';
    // var_dump($custom_fields_titles, $custom_fields);
    // echo '</pre>';
    // die();

    ?>
    <div id='eazyproo_meta_contents_product_data' class='panel woocommerce_options_panel'>
        <div id="ezproo-meta" class="eazyproo-repeater" data-count="<?php echo !empty( $custom_fields ) ? esc_attr(count($custom_fields)) : 0; ?>">
            <div class="inner-wrapper">
                <h3><?php _e('Custom Fields', 'eazyproo-product-meta'); ?></h3>
                <table class="eazyproo-table form-table">
                    <thead>
                        <tr>
                            <th colspan="2">Components</th>
                            <th>Content</th>
                            <th>Position</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($custom_fields_titles as $item) :
                            $thumb = wp_get_attachment_image_src($item->image, 'thumbnail');
                            ?>
                            <tr>
                                <td>
                                    <?php if( $thumb ) { ?>
                                    <img src="<?php echo esc_url($thumb[0]); ?>" alt="<?php esc_attr($item->title); ?>" width="30" height="30" />
                                    <?php } ?>
                                </td>
                                <td>
                                    <div>                                        
                                        <span><?php echo esc_html($item->title); ?></span>
                                        <input type="hidden" name="custom_repeater_field[<?php echo esc_attr($item->id); ?>][key]" value="<?php echo esc_attr($item->id); ?>">
                                    </div>
                                </td>
                                <td>
                                    <input class="full content-input" type="text" name="custom_repeater_field[<?php echo esc_attr($item->id) ?>][value]" placeholder="<?php echo esc_attr($item->title); ?>" value="<?php
                                        if (is_array($custom_fields) && count($custom_fields) > 0){
                                            foreach( $custom_fields as $kd => $data){
                                                if($item->id == $kd){
                                                    echo esc_html($data['value']);
                                                }
                                            }
                                        }
                                    ?>" />
                                </td>
                                <td>
                                    <select name="custom_repeater_field[<?php echo esc_attr($item->id) ?>][hook_name]" id="custom_field_hook_list" class="meta_hook">
                                        <option value="">Select Location</option>
                                        <?php
                                        foreach ($hooks as $hook => $title) :
                                            ?>
                                            <option value="<?php echo esc_attr($hook) ?>" <?php
                                                foreach($custom_fields as $kd => $data){
                                                    if($kd == $item->id){
                                                        selected($data['hook_name'], $hook);
                                                    }else{
                                                        selected("eazyproo_display_custom_field_before_price", $hook);
                                                    }
                                                }
                                            ?>><?php echo esc_html($title) ?></option>
                                            <?php
                                        endforeach;?>
                                    </select>
                                </td>
                                <td><button type="button" class="ez_remover_meta button btn-outline-danger"><?php echo esc_html__('Clear', 'eazyproo-product-meta') ?> </button></td>
                            </tr>
                            <?php
                        endforeach;
                        ?>                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php
}

function eazyproo_save_meta_contents_data_panel_fields($post_id)
{
    if (isset($_POST['custom_repeater_field']) && is_array($_POST['custom_repeater_field'])) {

        $raw_items = $_POST['custom_repeater_field'];       
        foreach ($raw_items as $key => $item) {
            if ( empty($item['key']) || empty($item['value'])) {
                unset($raw_items[$key]);
            }else{
                $item['key'] = sanitize_text_field($item['key']);
                $item['value'] = sanitize_text_field($item['value']);
                if (isset($item['hook_name']) && !empty($item['hook_name'])) {
                    $item['hook_name'] = sanitize_text_field($item['hook_name']);
                }
            }
        }

        if (count($raw_items) == 0) {
            delete_post_meta($post_id, '_custom_repeater_field');
        } else if (count($raw_items) > 0) {
            update_post_meta($post_id, '_custom_repeater_field', $raw_items);
        }
    }else{
        delete_post_meta($post_id, '_custom_repeater_field');
    }
}

function eazyproo_display_include_apps_tab_content()
{
    global $post;
    $include_apps = get_post_meta($post->ID, "_include_apps_list", true);
    $apps = eazyproo_get_settings('tic_meta_apps') ?: [];
    ?>
    <div id="include_apps_meta_panel" class="panel woocommerce_options_panel">
        <div id="inlcude_apps_wrapper" class="eazyproo-repeater" data-count="<?php echo !empty( $include_apps ) ? esc_attr(count($include_apps)) : 0; ?>">
            <div class="inner-wrapper">
                <h3>Apps</h3>
                <?php
                if(empty($apps)){
                    echo '<p>No apps found</p>';
                    echo '<a class="button" href="'. admin_url('post-new.php?post_type=type_app') .'">'. __('Add Apps', 'eazyproo-product-meta') .'</a>';
                } else {
                    ?>
                    <div class="app-header-container">
                        <select id="ez_all_apps">
                            <option>Select apps</option>
                            <?php
                            foreach ($apps as $app) { ?>
                                <option value="<?php echo esc_attr($app->id); ?>"><?php echo isset($app->title) ? esc_attr($app->title) : ''; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                    <?php
                }
                ?>
                <div id="ez-apps-wrapper" class="below-wrapper">
                    <?php
                    if (!empty($include_apps)) {
                        echo '<ul id="selected_apps_wrapper">';
                        foreach ($include_apps as $app) { 
                            if( !is_numeric($app) ){ continue; }
                            $label = eazyproo_get_title_data_by_id('tic_meta_apps', $app);
                            if(empty($label->title)){ continue; }
                            ?>
                            <li data-title="<?php echo esc_attr($label->title); ?>" class="options_group">
                                <div class="item-inner">
                                    <input type="hidden" class="title_hidden" name="include_apps_info[]" value="<?php echo esc_attr($label->id); ?>">
                                    <?php if(!empty($label->image)): 
                                        $thumb = wp_get_attachment_image_src($label->image, 'thumbnail');
                                        ?>
                                        <img src="<?php echo esc_url($thumb[0]); ?>" width="150" height="150">
                                    <?php endif; ?>
                                    <?php if(!empty($label->title)): ?>
                                        <span class="title"><?php echo esc_html($label->title); ?></span>
                                    <?php endif; ?>
                                    <span class="remove_item_button">X</span>
                                </div>
                            </li>
                            <?php
                        }
                        echo '</ul>';
                    } else { ?>
                        <div class="include-apps-field-wrapper">
                            <ul id="selected_apps_wrapper"></ul>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php
}
function eazyproo_display_key_features_tab_content()
{
    global $post;
    $key_features = get_post_meta($post->ID, "_key_features_list", true);
    $all_features = eazyproo_get_settings('tic_key_features') ?: [];
    ?>
    <div id="key_features_panel" class="panel woocommerce_options_panel">
        <div id="key_features_wrapper" class="eazyproo-repeater" data-count="<?php echo !empty( $key_features ) ? esc_attr(count($key_features)) : 0; ?>">
            <div class="inner-wrapper">
                <h3>Key Features</h3>
                <?php
                if(empty($all_features)){
                    echo '<p>No Key Features found</p>';
                    echo '<a class="button" href="'. admin_url('?page=eazyproo-settings&tab=features') .'">'. __('Add New Key Feature', 'eazyproo-product-meta') .'</a>';
                } else {
                    ?>
                    <div class="app-header-container">
                        <ul class="key-list">
                            <?php
                            foreach ($all_features as $feature) { 
                                ?>
                                <li class="key key-<?php echo esc_attr($feature->id); ?>">
                                    <input type="checkbox" aria-hidden="true" id="feature-<?php echo esc_attr($feature->id); ?>" name="key_features[]" tabindex="-1" value="<?php echo esc_attr($feature->id); ?>" <?php echo is_array($key_features) && in_array($feature->id, $key_features) ? 'checked' : ''; ?> />
                                    <label for="feature-<?php echo esc_attr($feature->id); ?>" class="key-label">
                                        <div class="feature-wrapper">
                                            <?php if(empty($feature->icon) && !empty($feature->image)){ 
                                                $thumb = wp_get_attachment_image_src($feature->image, 'thumbnail');
                                                ?>
                                                <img src="<?php echo esc_url( $thumb[0] ); ?>" width="30" height="30" alt="<?php echo esc_attr($feature->title)?>" class="rounded" />
                                            <?php } ?>
                                            <?php if(!empty($feature->icon)){ ?>
                                                <i class="<?php echo esc_attr($feature->icon); ?>"></i>
                                            <?php } ?>
                                            <span><?php echo esc_html($feature->title)?></span>
                                        </div>
                                    </label>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </div>
    <?php
}

function eazyproo_save_key_features($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST["key_features"]) && is_array($_POST["key_features"])) {
        update_post_meta($post_id, "_key_features_list", array_map('sanitize_text_field', $_POST["key_features"]));
    } else {
        delete_post_meta($post_id, "_key_features_list");
    }
}
function eazyproo_save_include_apps_meta($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    if (isset($_POST["include_apps_info"]) && is_array($_POST["include_apps_info"])) {
        update_post_meta($post_id, "_include_apps_list", array_map('sanitize_text_field', $_POST["include_apps_info"]));
    } else {
        delete_post_meta($post_id, "_include_apps_list");
    }
}

function eazyproo_display_notice_tab_content()
{
    global $post;

    if (empty($post) || !is_object($post)) {
        return;
    }

    $notice_system_requirement_infos = get_post_meta($post->ID, "_update_notice_system_requirement_info", true) ?? [];
    ?>
    <div id="notice_requirement_tab_content" class="panel woocommerce_options_panel">
        <div id="notice_system_wrapper" class="eazyproo-repeater" data-count="<?php echo is_array($notice_system_requirement_infos) ? esc_attr(count($notice_system_requirement_infos)) : 0; ?>">
            <div class="inner-wrapper">
                <h3><?php _e('All Notices', 'eazyproo-product-meta'); ?></h3>
                <table class="eazyproo-table form-table">
                    <thead>
                        <tr>
                            <th>Notice</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (!empty($notice_system_requirement_infos)) {
                            $count = 0;
                            foreach ($notice_system_requirement_infos as $system_requirement_info) {
                                ?>
                                <tr class="options_group">
                                    <td>
                                        <input type="text" name="notice_system_requirement_info[<?php echo esc_attr($count); ?>][title]" value="<?php echo esc_attr($system_requirement_info['title']); ?>" class="notice-input full" placeholder="Type your notice here. e.g: This is a digital downloadable software not a license key.">
                                    </td>
                                    <td>
                                        <button type="button" class="notice_system_repeater_remove_btn button">Remove</button>
                                    </td>
                                </tr>
                                <?php
                                $count++;
                            }
                        } else { ?>
                            <tr class="options_group">
                                <td>
                                    <input type="text" name="notice_system_requirement_info[0][title]" class="notice-input full" placeholder="Type your notice here. e.g: This is a digital downloadable software not a license key.">
                                </td>
                                <td>
                                    <button type="button" class="notice_system_repeater_remove_btn button">Remove</button>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <button type="button" id="add-notice-system-repeater" class="button button-primary button-large"><?php _e('Add More', 'eazyproo-product-meta'); ?></button>
            </div>
        </div>
    </div>
    <?php
}

function save_notice_system_requrement_custom_fields($post_id)
{
    if (empty($_POST['notice_system_requirement_info'])) {
        delete_post_meta($post_id, '_update_notice_system_requirement_info');
        return;
    }

    $raw_items = $_POST['notice_system_requirement_info'];
    $sanitized_items = [];
    foreach ($raw_items as $key => $item) {
        if (isset($item['title']) && !empty($item['title'])) {
            $sanitized_items[$key]['title'] = sanitize_text_field($item['title']);
        }
    }

    if (empty($sanitized_items)) {
        delete_post_meta($post_id, '_update_notice_system_requirement_info');
    } else {
        update_post_meta($post_id, '_update_notice_system_requirement_info', $sanitized_items);
    }
}

function eazyproo_faq_tab_content()
{
    global $post;
    if (empty($post)) {
        return;
    }

    $faqs_data = get_post_meta($post->ID, "_update_product_faqs", true);
    if (empty($faqs_data)) {
        $faqs_data = [];
    }
    ?>
    <div id="faq_tab_content" class="panel woocommerce_options_panel">
        <div id="faqs_wrapper" class="eazyproo-repeater" data-count="<?php echo count($faqs_data); ?>">
            <div class="inner-wrapper">
                <h3><?php _e('All FAQs', 'eazyproo-product-meta'); ?></h3>
                <table class="eazyproo-table form-table">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>Answer</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (count($faqs_data) > 0) {
                            $count = 0;
                            foreach ($faqs_data as $faq) {
                                ?>
                                <tr class="options_group">
                                    <td>
                                        <textarea name="product_faqs[<?php echo esc_attr($count); ?>][title]" class="faq-title-input full" placeholder="Write FAQ title here"><?php echo isset( $faq['title'] ) ? esc_attr( $faq['title'] ) : ''; ?></textarea>
                                    </td>
                                    <td>
                                        <textarea name="product_faqs[<?php echo esc_attr($count); ?>][answer]" class="faq-answer-input full" placeholder="Write FAQ answer here"><?php echo isset( $faq['answer'] ) ? esc_attr( $faq['answer'] ) : ''; ?></textarea>
                                    </td>
                                    <td><button type="button" class="faq_remover_btn button">Remove</button></td>
                                </tr>
                                <?php
                                $count++;
                            }
                        } else { ?>
                            <tr class="options_group">
                                <td>
                                    <textarea name="product_faqs[0][title]" class="faq-title-input full" placeholder="Write FAQ title here"></textarea>
                                </td>
                                <td>
                                    <textarea name="product_faqs[0][answer]" class="faq-answer-input full" placeholder="Write FAQ answer here"></textarea>
                                </td>
                                <td><button type="button" class="faq_remover_btn button">Remove</button></td>
                            </tr>
                            <?php
                        } ?>

                    </tbody>
                </table>
                <button type="button" id="add-new-faq" class="button button-primary button-large"><?php _e('Add More', 'eazyproo-product-meta'); ?></button>
            </div>
        </div>
    </div>
    <?php    
}

function eazyproo_save_faq_tab_content($post_id)
{
    if (isset($_POST['product_faqs'])) {
        $faqs = $_POST['product_faqs'];
        
        foreach ($faqs as $key => $faq) {
            if (empty($faq['title']) || empty($faq['answer'])) {
                unset($faqs[$key]);
            }else{
                $faq['title'] = sanitize_text_field($faq['title']);
                $faq['info'] = sanitize_text_field($faq['answer']);
            }
        }
        if (count($faqs) == 0) {
            delete_post_meta($post_id, '_update_product_faqs');
        }
        if (count($faqs) > 0) {
            update_post_meta($post_id, '_update_product_faqs', $faqs);
        }
    }else{
        delete_post_meta($post_id, '_update_product_faqs');
    }
}

function eazyproo_title_tag_tab_content()
{
    global $post;
    if (empty($post)) {
        return;
    }

    $title_tag_data = json_decode(get_post_meta($post->ID, "_product_title_tags", true)) ?? [];

    // get all woocommerce product tags
    $args = array(
        'taxonomy' => 'product_tag',
        'hide_empty' => false,
    );
    $product_tags = get_terms($args);
    ?>
    <div id="title_tag_tab_content" class="panel woocommerce_options_panel">
        <div id="title_tag_wrapper" class="">
            <div class="inner-wrapper">
                <h3><?php _e('Title Tags', 'eazyproo-product-meta'); ?></h3>
                <table class="eazyproo-table form-table">
                    <thead>
                        <tr>
                            <td>
                                <select id="ez_all_tags" class="short" name="product_title_tags[]" multiple="multiple">
                                    <option value="">Select Tag</option>  
                                    <?php
                                    if (count($product_tags) > 0) {
                                        foreach ($product_tags as $tag) {
                                            echo '<option value="' . $tag->term_id . '" ' . (in_array($tag->term_id, $title_tag_data) ? 'selected="selected"' : '') . '>' . $tag->name . '</option>';
                                        }
                                    }
                                    ?>                          
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>Select tags to show them before Product Title</p>
                                <p>Tags must have <a href="https://fontawesome.com/v5/search?m=free" target="_blank">Font Awesome Icon</a> class name without markup</p>
                                <p>For example: <code>fa fa-home</code></p>
                                <p>To update tags go to Product >> <a href="<?php echo esc_url(admin_url( 'edit-tags.php?taxonomy=product_tag&post_type=product' ))?>" target="_blank">Tags</a></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php    
}

function eazyproo_save_title_tag_tab_content($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST["product_title_tags"]) && !empty($_POST["product_title_tags"])) {

        $title_tags = sanitize_text_field(json_encode($_POST['product_title_tags']));
        update_post_meta($post_id, "_product_title_tags", $title_tags);
    }else{
        delete_post_meta($post_id, '_product_title_tags');
    }
}

function eazyproo_delivery_notice_tab_content()
{
    global $post;
    if (empty($post)) {
        return;
    }

    $deliver_notice = get_post_meta($post->ID, "product_delivery_notice", true) ?? false;

    

    $settings_data = json_decode( get_option("tic_others_settings"), true );
    $default_deliver_notice = isset($settings_data['delivery_notice']) ? $settings_data['delivery_notice'] : 'Deliver in 1-2 days';
    ?>
    <div id="deliver_notice_tab_content" class="panel woocommerce_options_panel">
        <div id="product_delivery_notice_wrapper" class="">
            <div class="inner-wrapper">
                <h3><?php _e('Deliver Notice', 'eazyproo-product-meta'); ?></h3>
                <table class="eazyproo-table form-table">
                    <thead>
                    <tr>
                            <td>
                                <p>Override global deliver notice</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <textarea name="product_delivery_notice" id="product_delivery_notice" cols="100" rows="5"
                                placeholder="<?php echo esc_attr($default_deliver_notice); ?>"><?php echo $deliver_notice ? wp_kses_data($deliver_notice) : ''; ?></textarea>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <p>To update global delivery notice go to <a href="<?php echo esc_url(admin_url( 'admin.php?page=eazyproo-settings&tab=others' ))?>" target="_blank">theme settings page</a></p>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php    
}

function eazyproo_save_delivery_notice_tab_content($post_id)
{
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (isset($_POST["product_delivery_notice"]) && !empty($_POST["product_delivery_notice"])) {

        $delivery_notice = wp_kses_data($_POST['product_delivery_notice']);
        update_post_meta($post_id, "product_delivery_notice", $delivery_notice);
    }else{
        delete_post_meta($post_id, 'product_delivery_notice');
    }
}

function eazyproo_add_product_tab_front($tabs)
{
    global $post;

    unset($tabs['reviews']);

    $overview = get_post_meta($post->ID, '_eazyproo_overview_info', true);
    $flag_overview = get_post_meta($post->ID, '_eazyproo_overview_flag_info', true);
    if ((is_array($overview) && !empty($overview)) || (is_array($flag_overview) && !empty($flag_overview))) {
        $tabs['overview'] = array(
            'title' => __('Overview', 'woocommerce'),
            'priority' => 50,
            'callback' => 'eazyproo_overview_tab_content',
        );
    }
    $system_requirement = get_post_meta($post->ID, '_update_system_requirement_info', true);
    $system_req_rec = get_post_meta($post->ID, 'system_requirement_recommend', true);
    if (
        (is_array($system_requirement) && !empty($system_requirement)) 
        || 
        (is_array($system_req_rec) && !empty($system_req_rec))
    ) {
        $tabs['system_requirement'] = array(
            'title' => __('System Requirements', 'woocommerce'),
            'priority' => 60,
            'callback' => 'eazyproo_system_requirement_tab_content',
        );
    }
    $faqs = get_post_meta($post->ID, '_update_product_faqs', true);
    if (is_array($faqs) && !empty($faqs)) {
        $tabs['faqs'] = array(
            'title' => __('FAQs', 'woocommerce'),
            'priority' => 70,
            'callback' => 'eazyproo_faq_tab_content_cb',
        );
    }
    return $tabs;
}

function eazyproo_overview_tab_content()
{
    global $post;
    $flag_overview = get_post_meta($post->ID, '_eazyproo_overview_flag_info', true);
    $overview = get_post_meta($post->ID, '_eazyproo_overview_info', true);
    if ((is_array($overview) && !empty($overview)) || (is_array($flag_overview) && !empty($flag_overview))) {
        ?>
        <h3>Overview</h3>
        <div class="ticone-tab-content overview-content light-green-bg">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="responsive-table">
                            <table class="table table-sm table-striped table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th class="heading">Features</th>
                                        <th class="content">Details</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        if (is_array($flag_overview) && !empty($flag_overview)) { ?>
                                            <tr>
                                                <td class="heading"><?php echo isset($flag_overview['title']) && !empty($flag_overview['title']) ? esc_html($flag_overview['title']) : 'Supported Language'; ?></td>
                                                <td class="content">
                                                <?php if(isset($flag_overview['content']) && is_array($flag_overview['content']) && !empty($flag_overview['content'])) {
                                                    foreach ($flag_overview['content'] as $code) {?>
                                                        <span class="flag-icon flag-icon-<?php echo esc_attr(strtolower($code)); ?> flag-icon-squared"></span>
                                                        <?php 
                                                    }
                                                } ?>
                                                </td>
                                            </tr>                                        
                                            <?php 
                                        }

                                        if (is_array($overview) && !empty($overview)) {
                                            foreach ($overview as $key => $value) {
                                                $label = eazyproo_get_title_data_by_id('tic_meta_overview', $value['title']);
                                                ?>
                                                <tr>
                                                    <td class="heading"><?php echo isset($label->title) ? esc_html($label->title) : ''; ?></td>
                                                    <td class="content"><?php echo isset($value['content']) ? esc_html($value['content']) : ''; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                    ?>                                        
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}

function eazyproo_system_requirement_tab_content()
{

    global $post;
    $system_requirement_infos = get_post_meta($post->ID, "_update_system_requirement_info", true);

    if (is_array($system_requirement_infos) && !empty($system_requirement_infos)) {
        foreach ($system_requirement_infos as $key => $system_requirement_info) {
            if (empty($system_requirement_info['title']) || empty($system_requirement_info['info'])) {
                unset($system_requirement_infos[$key]);
            }
        }
    }
    
    $system_recommend_infos = get_post_meta($post->ID, "_update_system_recommend_info", true);

    if (is_array($system_recommend_infos) && !empty($system_recommend_infos)) {
        foreach ($system_recommend_infos as $key => $system_recommend_info) {
            if (empty($system_recommend_info['title']) || empty($system_recommend_info['info'])) {
                unset($system_recommend_infos[$key]);
            }
        }
    }

    $system_requirement_recommend = get_post_meta($post->ID, "system_requirement_recommend", true);

    if( is_array($system_requirement_recommend) && count($system_requirement_recommend) > 0 ){
        ?>
        <div class="show-on-desktop">
            <h2><?php esc_html_e('System Requirements', 'eazyproo-product-meta'); ?></h2>
            <div class="ticone-tab-content system-requirements-content light-green-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="responsive-table">
                                <table class="table table-sm table-striped table-bordered table-hover desktop">
                                    <thead>
                                        <tr>
                                            <th class="heading">Components</th>
                                            <th>Requirements</th>
                                            <th>Recommends</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach( $system_requirement_recommend as $data ){
                                            ?>
                                            <tr>
                                                <td class="heading"><?php echo esc_html($data['component']); ?></td>
                                                <td><?php echo esc_html($data['requirement']); ?></td>
                                                <td><?php echo esc_html($data['recommend']); ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                
        </div>
        <div class="show-on-mobile">
            <h2><?php esc_html_e('System Requirements', 'eazyproo-product-meta'); ?></h2>
            <div class="ticone-tab-content system-requirements-content light-green-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="responsive-table">
                                <h3><?php esc_html_e('Minimum Requirements', 'eazyproo-product-meta'); ?></h3>
                                <table class="table table-sm table-striped table-bordered table-hover desktop">
                                    <thead>
                                        <tr>
                                            <th class="heading">Components</th>
                                            <th>Requirements</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach( $system_requirement_recommend as $data ){
                                            ?>
                                            <tr>
                                                <td class="heading"><?php echo esc_html($data['component']); ?></td>
                                                <td><?php echo esc_html($data['requirement']); ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>

                                <h3><?php esc_html_e('Recommended Requirements', 'eazyproo-product-meta'); ?></h3>
                                <table class="table table-sm table-striped table-bordered table-hover desktop">
                                    <thead>
                                        <tr>
                                            <th class="heading">Components</th>
                                            <th>Recommends</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach( $system_requirement_recommend as $data ){
                                            ?>
                                            <tr>
                                                <td class="heading"><?php echo esc_html($data['component']); ?></td>
                                                <td><?php echo esc_html($data['recommend']); ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }else
    if( (is_array($system_requirement_infos) && count($system_requirement_infos) > 0) || ( is_array($system_recommend_infos) && count($system_recommend_infos) > 0)){
    ?>
        <div class="show-on-desktop">
            <h2><?php esc_html_e('System Requirements', 'eazyproo-product-meta'); ?></h2>
            <div class="ticone-tab-content system-requirements-content light-green-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="responsive-table">
                                <table class="table table-sm table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="heading">Components</th>
                                            <th>Requirements</th>
                                            <th>Recommends</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (is_array($system_requirement_infos)){
                                            foreach( $system_requirement_infos as $data ){
                                                ?>
                                                <tr>
                                                    <td class="heading"><?php 
                                                    $label = eazyproo_get_title_data_by_id('tic_meta_sys_reqs', $data['title']);
                                                    echo esc_html($label->title); ?></td>
                                                    <td><?php echo esc_html($data['info']); ?></td>
                                                    <td><?php
                                                    if(is_array($system_recommend_infos)){
                                                        foreach( $system_recommend_infos as $data2 ){
                                                            if( $data['title'] == $data2['title'] ){
                                                                echo esc_html($data2['info']);
                                                            }
                                                        }
                                                    }
                                                    ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
    
                                </table>
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="show-on-mobile">
            <h2><?php esc_html_e('System Requirements', 'eazyproo-product-meta'); ?></h2>
            <div class="ticone-tab-content system-requirements-content light-green-bg">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="responsive-table">
                                <h3><?php esc_html_e('Minimum Requirements', 'eazyproo-product-meta'); ?></h3>
                                <table class="table table-sm table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="heading">Components</th>
                                            <th>Requirements</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if( is_array($system_requirement_infos) ){
                                            foreach( $system_requirement_infos as $data ){
                                                ?>
                                                <tr>
                                                    <td class="heading"><?php 
                                                    $label = eazyproo_get_title_data_by_id('tic_meta_sys_reqs', $data['title']);
                                                    echo esc_html($label->title); ?></td>
                                                    <td><?php echo esc_html($data['info']); ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>
    
                                </table>

                                <h3><?php esc_html_e('Recommended Requirements', 'eazyproo-product-meta'); ?></h3>
                                <table class="table table-sm table-striped table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th class="heading">Components</th>
                                            <th>Recommends</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if( is_array($system_requirement_infos)){
                                            foreach( $system_requirement_infos as $data ){
                                                ?>
                                                <tr>
                                                    <td class="heading"><?php 
                                                    $label = eazyproo_get_title_data_by_id('tic_meta_sys_reqs', $data['title']);
                                                    echo esc_html($label->title); ?></td>
                                                    <td><?php
                                                    if( is_array($system_recommend_infos) ){
                                                        foreach( $system_recommend_infos as $data2 ){
                                                            if( $data['title'] == $data2['title'] ){
                                                                echo esc_html($data2['info']);
                                                            }
                                                        }
                                                    }
                                                    ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </tbody>    
                                </table>    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    <?php
    }
}

function eazyproo_faq_tab_content_cb()
{
    global $post;
    $faqs = get_post_meta($post->ID, "_update_product_faqs", true);

    if (is_array($faqs) && !empty($faqs)) {
        foreach ($faqs as $key => $faq) {
            if (empty($faq['title']) || empty($faq['answer'])) {
                unset($faqs[$key]);
            }
        }
    }

    if( count($faqs) > 0 ){
        ?>
        <div id="faq" itemscope itemtype="https://schema.org/FAQPage">
            <h2 id="faq-heading"><?php esc_html_e('Frequently Asked Questions', 'eazyproo-product-meta'); ?></h2>
            <div class="faq-contents light-green-bg">
                
                <?php foreach ($faqs as $faq): ?>
                    <div class="faq-item" itemscope itemprop="mainEntity" itemtype="https://schema.org/Question">
                        <h3 itemprop="name"><?php echo isset($faq["title"]) ? esc_html($faq["title"]) : ''; ?></h3>
                        <div itemscope itemprop="acceptedAnswer" itemtype="https://schema.org/Answer">
                            <p itemprop="text"><?php echo isset($faq["answer"]) ? esc_html($faq["answer"]) : ''; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>    
        <?php
        }
    
}

function eazyproo_unknown() 
{
    if (!is_singular() && !is_product()) {
        return false;
    }
    global $post;
    $custom_fields = get_post_meta($post->ID, '_custom_repeater_field', true);
    if (isset($custom_fields) && is_array($custom_fields)) {
        foreach ($custom_fields as $field):
            if (!isset($field["key"]) || empty($field["key"])) {
                continue;
            }
            $meta_data = eazyproo_get_title_data_by_id('tic_meta_custom', $field["key"]);
            if (isset($field["hook_name"]) && !empty($field["hook_name"])) {
                add_action($field["hook_name"], function () use ($field, $meta_data) {
                    $thumb = wp_get_attachment_image_src($meta_data->image, 'thumbnail');
                    ?>
                    <div class="row">
                        <div class="detail-title">
                            <?php
                            if (isset($thumb[0]) && !empty($thumb[0])) {
                                echo '<img src="'. esc_url($thumb[0]) .'" alt="'. $meta_data->title .'" height="50" width="50" />';
                            }
                            echo isset($meta_data->title) ? $meta_data->title : '';
                            ?>

                        </div>
                        <div class="details-content">
                            <?php echo isset($field['value']) ? $field['value'] : ''; ?>
                        </div>
                    </div>
                    <?php
                });
            }
        endforeach;
    }
}

function eazyproo_hooks()
{
    // remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20 );
    add_action("eazyproo_single_product_right", "eazyproo_display_meta_contents");
}

function eazyproo_display_meta_contents()
{
    global $post;
    $custom_fields = get_post_meta($post->ID, '_custom_repeater_field', true);
    ?>
    <div class="sp_main_wrap">
        <div class="right-sidebar-centent">
            <?php
            if (!empty($custom_fields)) { ?>
                <div class="product_details">
                    <?php do_action("eazyproo_display_custom_field_before_price"); ?>
                </div>
                <?php
            }

            woocommerce_template_single_price();
            if(has_action("eazyproo_display_content_after_price")) {
                ?>
                <div class="product_details">
                    <?php do_action("eazyproo_display_content_after_price"); ?>
                </div>
                <?php
            }
            do_action('woocommerce_simple_add_to_cart');

            if(has_action("eazyproo_display_content_after_add_to_cart")) {
                ?>
                <div class="product_details">
                    <?php do_action("eazyproo_display_content_after_add_to_cart"); ?>
                </div>
                <?php
            }


            ?>
        </div>
        <div class="sp-icon-main">
            <span><?php echo esc_html("Pay securely with", "woodmart"); ?></span>
            <div class="payments_icons">
                <?php
                $attachment_ids = array();
                if (function_exists('display_multiple_images')) {
                    display_multiple_images($attachment_ids);
                } else {
                    eazyproo_display_payment_icons($attachment_ids);
                }
                ?>
            </div>

        </div>

    </div>
    <?php

}

/**
 * Fallback function when the ticone theme is not active.
 * Displays default payment icons bundled with the plugin.
 */
if (!function_exists('eazyproo_display_payment_icons')) {
    function eazyproo_display_payment_icons($attachment_ids = array())
    {
        if (empty($attachment_ids) || !is_array($attachment_ids)) {
            // Use WooCommerce payment gateway icons if available
            if (function_exists('WC')) {
                $gateways = WC()->payment_gateways()->get_available_payment_gateways();
                foreach ($gateways as $gateway) {
                    if ($gateway->get_icon()) {
                        echo $gateway->get_icon(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                    }
                }
            }
        } else {
            foreach ($attachment_ids as $attachment_id) {
                $image_url = wp_get_attachment_url($attachment_id);
                if ($image_url) {
                    echo '<img class="sp-payment-method-image" src="' . esc_url($image_url) . '" alt="">';
                }
            }
        }
    }
}


function eazyproo_display_include_apps_meta()
{
    global $post;
    $include_apps_list = get_post_meta($post->ID, '_include_apps_list', true);
    if (isset($include_apps_list) && !empty($include_apps_list)) {
    ?>
        <div class="include_apps_main">
            <div class="app_heading">
                <p class="head-txt-appsss">
                    <span>Included Apps</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle" viewBox="0 0 16 16">
                      <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293z"/>
                    </svg>
                </p>
            </div>
            <div class="include_apps">
                <?php
                // pretify($include_apps_list);
                foreach ($include_apps_list as $app):
                    if (!empty($app)) :
                        $app_data = eazyproo_get_title_data_by_id('tic_meta_apps', $app);
                        if(!$app_data){
                            return;
                        }
                        $thumb = wp_get_attachment_image_src($app_data->image, 'thumbnail');
                        ?>
                        <div class="items">
                            <div class="img_box">
                                <img src="<?php echo esc_url($thumb[0]); ?>" width="50" height="50" alt="<?php echo esc_attr($app_data->title); ?>" />
                            </div>
                            <div class="app-tile">
                                <?php echo esc_html($app_data->title); ?>
                            </div>
                        </div>
                        <?php
                    endif;
                endforeach;
                ?>
            </div>
        </div>
    <?php
    }
}

function eazyproo_display_key_features_meta()
{
    global $post;
    $key_features = get_post_meta($post->ID, '_key_features_list', true);
    if (isset($key_features) && !empty($key_features)) {
    ?>
        <div class="ticone-features-box">
            <h3>Key Features</h3>
            <div class="feature-list">
                <?php
                // pretify($key_features);
                foreach ($key_features as $feature_id):
                    if (!empty($feature_id)) :
                        $feature_data = eazyproo_get_title_data_by_id('tic_key_features', $feature_id);
                        if($feature_data){ ?>
                            <div class="feature">
                                <?php if(!empty($feature_data->image) && empty($feature_data->icon)){ 
                                    $thumb = wp_get_attachment_image_src($feature_data->image, 'thumbnail');
                                    ?>
                                    <img src="<?php echo esc_url($thumb[0]); ?>" width="50" height="50" alt="<?php echo esc_attr($feature_data->title); ?>" />
                                <?php } ?>
                                <?php if(!empty($feature_data->icon)){ ?>
                                    <i class="<?php echo esc_attr($feature_data->icon); ?>"></i>
                                <?php } ?>
                                <span><?php echo esc_html($feature_data->title); ?></span>
                            </div>
                            <?php 
                        }
                    endif;
                endforeach;
                ?>
            </div>
        </div>
    <?php
    }
}

function eazyproo_woocommerce_after_single_product()
{
    ?>
    <div class="container-ezaypro">
        <?php do_action('eazyproo_woodmart_after_single_product'); ?>
    </div>
    <?php
} 
