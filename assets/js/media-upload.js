jQuery(document).ready(function ($) {
    $('#upload_book_image').on('click', function (e) {
        e.preventDefault();

        var image_frame;
        if (image_frame) {
            image_frame.open();
        }

        // Define image_frame as wp.media object
        image_frame = wp.media({
            title: 'Select Media',
            multiple: false,
            library: {
                type: 'image',
            },
            button: {
                text: 'Insert Image',
            },
        });

        image_frame.on('select', function () {
            var attachment = image_frame.state().get('selection').first().toJSON();
            $('#book_image').val(attachment.url);
            $('#book_image_preview').html('<img src="' + attachment.url + '" alt="" style="max-width: 100%; height: auto;" />');
        });

        image_frame.open();
    });



    // udpate

    $('#upload_book_image').click(function(e) {
        e.preventDefault();
        
        var custom_uploader = wp.media({
            title: 'Select Book Image',
            button: {
                text: 'Use this image'
            },
            multiple: false
        })
        .on('select', function() {
            var attachment = custom_uploader.state().get('selection').first().toJSON();
            $('#book_image').val(attachment.url);
            $('#book_image_preview').html('<img src="' + attachment.url + '" style="max-width:100%;" />');
        })
        .open();
    });
});
