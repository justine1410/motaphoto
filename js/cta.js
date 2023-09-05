jQuery(document).ready(function($) {

  $('#afficher-plus').on('click', function(e) {
    e.preventDefault();

  });
});





 var data = {
        action: 'charger_plus_de_publications',
     };

     $.ajax({
        url: ajaxurl, // L'URL vers le script WordPress AJAX
        data: data,
        type: 'POST',
        success: function(response) {
           // Ajoutez les publications supplémentaires à la liste
           alert('coucou');
           page++; // Incrémentez le numéro de la page
        },
     });