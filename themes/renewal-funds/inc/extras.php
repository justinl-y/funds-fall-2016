<?php
/**
 * Custom functions that act independently of the theme templates.
 *
 * @package RED_Starter_Theme
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function red_starter_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	return $classes;
}
add_filter( 'body_class', 'red_starter_body_classes' );


/*
 *
 * Adds relational connection between posts and pages
 *
 */
function red_starter_connection_types() {
    // portfolio-company to story
    /*p2p_register_connection_type( array(
        'name' => 'portfolio_company_to_story',
        'from' => 'portfolio-company',
        'to' => 'story',
		'admin_dropdown' => 'any'
    ) );

    // portfolio-company to questionnaire
    p2p_register_connection_type( array(
        'name' => 'portfolio_company_to_questionnaire',
        'from' => 'portfolio-company',
        'to' => 'questionnaire',
		'admin_dropdown' => 'any'
    ) );*/

    // portfolio-company to pc_user
    p2p_register_connection_type( array(
        'name' => 'portfolio_to_user', //
        'from' => 'portfolio-company',
        'to' => 'user',
        'to_query_vars' => array( 'role' => 'pc_user' ),
        'admin_dropdown' => 'any'
    ) );

    // story to pc_user
    p2p_register_connection_type( array(
        'name' => 'story_to_user',
        'from' => 'story',
        'to' => 'user',
        'to_query_vars' => array( 'role' => 'pc_user' ),
        'admin_dropdown' => 'any'
    ) );

    // questionnaire to pc_user
    p2p_register_connection_type( array(
        'name' => 'questionnaire_to_user',
        'from' => 'questionnaire',
        'to' => 'user',
        'to_query_vars' => array( 'role' => 'pc_user' ),
        'admin_dropdown' => 'any'
    ) );
}
add_action( 'p2p_init', 'red_starter_connection_types' );


/*function blockusers_init() {
if ( is_admin() && !current_user_can( 'administrator' ) &&! ( defined( 'DOING_AJAX' ) && DOING_AJAX ) ) {
    wp_redirect( home_url() );
    exit;
    }
}
add_action( 'init', 'blockusers_init' );*/


/*
 *
 * Removes front end admin bar
 *
 */
function red_starter_remove_admin_bar() {
    if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
    }
}
add_action('after_setup_theme', 'red_starter_remove_admin_bar');

/*
*
* Adds logout functionality to header
*
*/
function add_login_logout_link($items, $args) {         
    ob_start();         
    wp_loginout('index.php');         
    $loginoutlink = ob_get_contents();     
    ob_end_clean();         
    $items .= '<li><img src="<?php echo get_template_directory_uri() ?>/assets/icons/svg/logout_icon.svg" />'. $loginoutlink .'</li>';     
    return $items; 
}
add_filter('wp_nav_menu_items', 'add_login_logout_link', 10, 2);

/*
*
* Add post-to-post user to a posted story
*
*/
function add_user_id_to_story_post( $entry  ) {
    $post = get_post( $entry['post_id'] );
    $user = wp_get_current_user(); 

    p2p_type( 'story_to_user' )->connect( $post->ID, $user->ID, array('date' => current_time('mysql')) );
}
add_action( 'gform_after_submission_3', 'add_user_id_to_story_post', 10, 2 );


// Styling the Login page

function custom_login() { ?>
    <section class="login-page-wrapper">
        <div class="login-image-wrapper">

            <div class="login-image">
                <img src="<?php echo get_template_directory_uri()?>/assets/images/login.png" alt="Login Logo">
                <div class="login-title">
                    <p>Investing For Change</p>
                </div>
            </div>

        </div>
    </section>
<?php }
add_action('login_enqueue_scripts','custom_login');

function my_login_logo() { ?>
   <style type="text/css">

        #login {
            position: relative !important;
        }

        #loginform {
            position: absolute !important;
            top: 125px;
        }

        body.login {
            background: white !important;
            position: relative !important;
            height: 200px;
        }

        #nav {
            position: absolute !important;
            top: 280px;
            right: 20px;
        }

        #backtoblog {
            display: none;
        }

        .login-page-wrapper {
            float:left;
        }

        .login-image-wrapper {
            display: none;
            height: 0;
            width: 0;
        }

        .login-image {
            position: relative;
        }

       .login-title p {
            display: flex;
            justify-content: center;
            align-items: center;
            position: absolute;
            bottom: 100px;
            right: -345px;
            color: white;
            font-size: 2.5rem;
            padding: 3rem 1rem;
            background-color: #4b711c;
        }

        #login_error {
            position: absolute;
            top: 116px;
        }

        #login h1:before {
            content: "Hello there,";
            font-size: 3rem;
            text-decoration: none;
            color: #4b711c;
            background-color: white;
            padding: 7px 27px;
            position: absolute;
            top: 75px;
            right: 1px;
        }

        #rememberme, .forgetmenot label, #login .message, #login h1 a {
            display: none;
        }

        #login input {
            width: 90%;
            margin: 0 auto;
            padding: 2%;
            border-radius: 18px;
            background-color: #B4AFAF;
        }

        #login #wp-submit {
            border-radius: 12px;
            border: none;
            background-color: #90b531;
            color: #fff;
            text-shadow: none;
            box-shadow: none;
            font-size: 1.6rem;
            width: 70%;
            margin-right: 56px;
            margin-top: 50px;
            height: auto !important;
            line-height: normal !important;
        }

        #login form {
            box-shadow: none;
            position: relative;
            height: 200px;
            }

        @media screen and (min-width: 1240px) {
            .login-image-wrapper {
                display: block;
                width: 62%;
                height: 100vh;
            }

            #login {
                display: flex;
                flex-flow: column wrap;
            }

        }

   </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );


function login_function() {
    add_filter( 'gettext', 'username_change', 20, 3 );
    function username_change( $translated_text, $text, $domain ) 
    {
        if ($text === 'Username or Email') 
        {
            $translated_text = 'Email Address';
        }
        return $translated_text;
    }
}
add_action( 'login_head', 'login_function' );
