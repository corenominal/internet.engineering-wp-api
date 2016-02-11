<?php
/**
 * Twitter App Settings Page
 */

/**
 * Add submenu item to the default WordPress "Settings" menu.
 */
function iewp_api_twitter_app_settings()
{
    add_submenu_page( 
        'options-general.php', // parent slug to attach to
        'IE API Twitter App', // page title
        'IE API Twitter App', // menu title
        'manage_options', // capability
        'iewp-api-twitter-app-settings', // slug
        'iewp_api_twitter_app_settings_callback' // callback function
        );

    // Activate custom settings
    add_action( 'admin_init', 'iewp_api_twitter_app_settings_register' );
}
add_action( 'admin_menu', 'iewp_api_twitter_app_settings' );

/**
 * Register custom settings
 */ 
function iewp_api_twitter_app_settings_register()
{
    /**
     * Register the settings fields
     */
    register_setting(
        'iewp_api_twitterapp_group', // option group
        'iewp_api_twitterapp_consumer_key' // option name
        );

    register_setting(
        'iewp_api_twitterapp_group', // option group
        'iewp_api_twitterapp_consumer_secret' // option name
        );
    
    /**
     * Create the settings section for this group of settings
     */
    add_settings_section(
        'iewp-api-twitterapp', // id
        'Application Settings', // title
        'iewp_api_twitterapp_section', // callback
        'iewp_api_twitterapp' // page
        );
    
    /**
     * Add the settings fields
     */
    add_settings_field(
        'iewp-api-twitterapp-consumer-key', // id
        'Consumer Key', // title/label
        'iewp_api_twitterapp_consumer_key', // callback
        'iewp_api_twitterapp', // page
        'iewp-api-twitterapp' // settings section 
        );

    add_settings_field(
        'iewp-api-twitterapp-consumer-secret', // id
        'Consumer Secret', // title/label
        'iewp_api_twitterapp_consumer_secret', // callback
        'iewp_api_twitterapp', // page
        'iewp-api-twitterapp' // settings section 
        );
}

/**
 * Form input for consumer key
 */
function iewp_api_twitterapp_consumer_key()
{
    $setting = esc_attr( get_option( 'iewp_api_twitterapp_consumer_key' ) );
    echo '<input type="text" class="regular-text" name="iewp_api_twitterapp_consumer_key" value="'.$setting.'" placeholder="consumer key here ...">';
}

/**
 * Form input for consumer secret
 */
function iewp_api_twitterapp_consumer_secret()
{
    $setting = esc_attr( get_option( 'iewp_api_twitterapp_consumer_secret' ) );
    echo '<input type="text" class="regular-text" name="iewp_api_twitterapp_consumer_secret" value="'.$setting.'" placeholder="consumer secret here ...">';
}

/**
 * Call back function for settings section. Do nothing.
 */
function iewp_api_twitterapp_section()
{
    return;
}

/**
 * Twitter settings callback function.
 */
function iewp_api_twitter_app_settings_callback()
{
    ?>
    
        <div class="wrap">
            <h1>internet·engineering Twitter App Settings</h1>

            <p>Register your Twitter app credentials below. If you have not already done so 
            <a href="https://apps.twitter.com/" target="_blank">create your app on Twitter</a> to obtain your credentials.</p>
            
            <form method="POST" action="options.php">
        
                <?php settings_fields( 'iewp_api_twitterapp_group' ); ?>
                <?php do_settings_sections( 'iewp_api_twitterapp' ); ?>
                <?php submit_button(); ?>

            </form>

        </div>

    <?php
}