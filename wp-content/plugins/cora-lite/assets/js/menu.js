jQuery(document).ready(function($) {
    
    /**
     * Logo
    */

    // Clone.
    let logoClone = $('#adminmenu li.cora-branding').clone();

    // Remove original.
    $('#adminmenu li.cora-branding').remove();

    // Prepend to menu.
    $('#adminmenu').prepend(logoClone);

});

jQuery(window).on('load', function () {
    // Show the logo.
    jQuery('#adminmenu li.cora-branding').css('opacity', 1);
});