// js file for renewal funds
(function( $ ) {
    // navigation functions
    $('.nav-btn').on('click',function(event){
        event.preventDefault();
        $('.site-header').addClass('header-resize');
        $('.menu-toggle').hide();
    });

    $('.nav-cancel').on('click', function(event){
        event.preventDefault();
        $('.site-header').removeClass('header-resize');
    });

    // login functions

        // $( "label[for=user_login]" ).html( "<p> The fuck </p>" );

    //$("#loginform > p ").append("Fuck this shit");
    // login functions

    //$('.a-unique-class').text( 'this is really bollocks' );
    //$( '.single-story .site-main > p' ).text( 'this is really bollocks' );

    //$('#backtoblog').text( 'this is really bollocks' );

    
    //$( '.acf-label label' ).prop( "disabled", true );
    $( '.acf-input-wrap input' ).prop( "disabled", true ); 
    //$( '.acf-form' ).css( 'background-color: white'); 
    

})(jQuery);