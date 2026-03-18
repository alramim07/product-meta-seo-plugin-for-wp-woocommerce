jQuery(document).ready(function ($) {
    $('#ez_overview_settings_wrapper #add-new-item').on('click', function () {
        const parent_el = $(this).closest(".eazyproo-repeater");
        let count = $(parent_el).attr("data-count");
        count++;
        $(parent_el).find("tbody").append(`
            <tr class="options_group gp-${count}">                        
                <td>
                    <input type="text" class="full" name="eazyproo_overview_title_fields[${count}][title]" id="eazyproo_overview_title_fields[${count}][title]" placeholder="Example: Developer">
                </td>
                <td>
                    <button type="button" class="system_repeater_remove_btn button button-danger">Remove</button>
                </td>
            </tr>
        `);        
        $(parent_el).attr("data-count", count);
    });
    
    
    $('#ez_sys_reqs_settings_wrapper #add-new-item').on('click', function () {
        const parent_el = $(this).closest(".eazyproo-repeater");
        let count = $(parent_el).attr("data-count");
        count++;
        $(parent_el).find("tbody").append(`
            <tr class="options_group gp-${count}">                        
                <td>
                    <input type="text" class="full" name="eazyproo_sys_reqs_title_fields[${count}][title]" id="eazyproo_sys_reqs_title_fields[${count}][title]" placeholder="Example: Developer">
                </td>
                <td>
                    <button type="button" class="system_repeater_remove_btn button button-danger">Remove</button>
                </td>
            </tr>
        `);
        
        $(parent_el).attr("data-count", count);
    });
    
    
    $('#ez_meta_fields_settings_wrapper #add-new-item').on('click', function () {
        const parent_el = $(this).closest(".eazyproo-repeater");
        let count = $(parent_el).attr("data-count");
        count++;
        $(parent_el).find("tbody").append(`
            <tr class="options_group gp-${count}">     
                <td>
                    <div class="img-wrapper">
                        <input type="hidden" name="eazyproo_meta_title_fields[${count}][image]" />
                        <button type="button" class="upload_image_button button">Upload/Add Image</button>
                        <div class="image_preview"></div>
                    </div>
                </td>                   
                <td>
                    <input type="text" class="full" name="eazyproo_meta_title_fields[${count}][title]" id="eazyproo_meta_title_fields[${count}][title]" placeholder="Example: Version, Platform">
                </td>
                <td>
                    <button type="button" class="system_repeater_remove_btn button button-danger">Remove</button>
                </td>
            </tr>
        `);
        
        $(parent_el).attr("data-count", count);
    });
    
    $('#ez_included_apps_settings_wrapper #add-new-item').on('click', function () {
        // alert("clicked")
        const parent_el = $(this).closest(".eazyproo-repeater");
        let count = $(parent_el).attr("data-count");
        count++;
        $(parent_el).find("tbody").append(`
            <tr class="options_group gp-${count}">     
                <td>
                    <div class="img-wrapper">
                        <input type="hidden" name="eazyproo_app_title_fields[${count}][image]" />
                        <button type="button" class="upload_image_button button">Upload/Add Image</button>
                        <div class="image_preview"></div>
                    </div>
                </td>                   
                <td>
                    <input type="text" class="full" name="eazyproo_app_title_fields[${count}][title]" id="eazyproo_app_title_fields[${count}][title]" placeholder="Example: Adobe, Autodesk">
                </td>
                <td>
                    <button type="button" class="system_repeater_remove_btn button button-danger">Remove</button>
                </td>
            </tr>
        `);
        
        $(parent_el).attr("data-count", count);
    });
    
    
    $('#ez_key_features_settings_wrapper #add-new-item').on('click', function () {
        const parent_el = $(this).closest(".eazyproo-repeater");
        let count = $(parent_el).attr("data-count");
        count++;
        $(parent_el).find("tbody").append(`
            <tr class="options_group gp-${count}">   
                <td>
                    <input type="text" class="full" name="eazyproo_feature_title_fields[${count}][title]" id="eazyproo_feature_title_fields[${count}][title]" placeholder="Example: Version, Platform">
                </td>
                <td>
                    <input type="text" class="full" name="eazyproo_feature_title_fields[${count}][icon]" id="eazyproo_feature_title_fields[${count}][icon]" placeholder="fas fa-tasks">
                </td>
                <td>
                    <div class="img-wrapper">
                        <input type="hidden" name="eazyproo_feature_title_fields[${count}][image]" />
                        <button type="button" class="upload_image_button button">Upload/Add Image</button>
                        <div class="image_preview"></div>
                    </div>
                </td>                      
                <td>
                    <button type="button" class="system_repeater_remove_btn button button-danger">Remove</button>
                </td>
            </tr>
        `);
        
        $(parent_el).attr("data-count", count);
    });

    $("#ez_key_features_settings_wrapper .upload_image_button").on('click', function (event) {
        event.preventDefault();
        var button = $(this);
        var input = button.prev();
        var imagePreview = button.nextAll('.image_preview');

        var file_frame = wp.media.frames.file_frame = wp.media({
            title: 'Select an image to upload',
            button: {
                text: 'Use this image',
            },
            multiple: false
        });

        file_frame.on('select', function () {
            var attachment = file_frame.state().get('selection').first().toJSON();
            input.val(attachment.id);
            imagePreview.html('<img width="150" height="113" src="' + attachment.url + '" class="attachment-thumbnail size-thumbnail" alt="">');
        });
        file_frame.open();
    });

    $('.eazyproo-repeater').on('click', '.system_repeater_remove_btn', function () {
        const $this = $(this);
        const meta_id = $($this).attr('data-meta_id') || '';
        const table = $($this).attr('data-action') || '';
        if ( meta_id !== '' && table !== '' ) {
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'ez_remove_meta_item',
                    table: table,
                    meta_id: meta_id
                },
                beforeSend: function () {
                    $($this).attr('disabled', 'disabled');
                },
                success: function (response) {
                    if (response) {
                        $($this).closest('.options_group').remove();
                    }
                }
            });
        }else{
            $($this).closest('.options_group').remove();
        }
        
    });
});