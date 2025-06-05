jQuery(document).ready(function($) {
    $('.dii-send-message').on('click', function () {
        const bookId = $(this).data('book-id');
        $('#dii-book-id').val(bookId);
        $('#myModal').modal('show');
    });

    $('#dii-message-form').on('submit', function(e) {
        e.preventDefault();
        $.post(dii_ajax_obj.ajaxurl, $(this).serialize(), function(response) {
            alert(response.data.message);
            if (response.success) {
                $('#dii-message-form')[0].reset();
                $('#myModal').modal('hide');
            }
        });
    });
});
