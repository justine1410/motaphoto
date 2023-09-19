jQuery(document).ready(function($) {
    $("#category-select , #category-select-format, #category-select-date ").change(function() {
        let category = $('#category-select').val();
        let format = $('#category-select-format').val();
        let order = $('#category-select-date').val();


        $.ajax({
            url: my_ajax_object.ajax_url,
            type: 'POST',
            data: {
                action: 'filter_posts',
                category: category,
                format: format,
                order: order,
            },
            success: function (response) {
                // Mettez à jour la zone d'affichage des publications filtrées.
                $('#portfolio').html(response);
            }
        });
    });

    $(".cat-titre").click(function(){
        $('.choix-cat').css("display","flex");
    })


});









