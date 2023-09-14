jQuery(function($) {
    var page = 1; // Numéro de page initial

    $('#load-more-button').on('click', function() {
        if (page ) {
            $.ajax({
                type: 'POST',
                url: my_ajax_object.ajax_url, // Utilisez l'ajax_url définie dans wp_localize_script
                data: {
                    action: 'load_more_posts',
                    page: page,
                },
                success: function(response) {
                    $('.photos_post').css("display",'none');
                    $('#posts-container').append(response);
                    $('.bouton').css("display","none");

                   
                    page++;
                },
            });
        }
        return false;
    });
});
