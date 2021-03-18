jQuery(document).ready(function($) {


    /**
     * Remove Original logo
    */

    $('body.login h1 a').remove();

    
    /**
     * Set Background image
    */
    
    if (CoraLogin.background_type == 'image') {

        $(":root").get(0).style.setProperty( "--background_image", `url(${CoraLogin.background_image })` );

    }


    /**
     * Add New Logo
    */
    
    if ( JSON.parse(CoraLogin.show_logo) ) {
        
        $('body.login h1').show();
        
        if ( CoraLogin.logo_type == 'logo' ) {
        
            $('body.login h1').append('<img src="' + CoraLogin.logo + '" width="' + CoraLogin.logo_width + '"/>');
        
        } else {

            $('body.login h1').append(CoraLogin.site_name);
        
        }
    
    }

    
    /**
     * Title & Description
    */

    if ( CoraLogin.layout == 'modern' ) {

        $('body.login').append(`
            <div class="cora-login-description">
                <div>
                    <h2>${CoraLogin.title}</h2>
                    <p>${CoraLogin.description}</p>
                </div>
            </div>
        `);
        
    }
   
    /**
     * User & Password placeholder
    */
   
    $("#user_login").attr('placeholder', $("[for=user_login]").text());
    $("#user_pass").attr('placeholder', $("[for=user_pass]").text());

    $("[for=user_login], [for=user_pass]").remove();

});