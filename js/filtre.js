jQuery(document).ready(function($) {
    $("#category-select").change(function() {
        $("#category-filter-form").submit(); // Soumettre automatiquement le formulaire lors du changement
    });

    $("#category-select-format").change(function() {
        $("#category-filter-format-form").submit(); // Soumettre automatiquement le formulaire lors du changement
    });


});