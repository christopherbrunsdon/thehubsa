<?php
/**
 * Plugin Name: TheHubSA.org.za
 * Plugin URI: https://github.com/christopherbrunsdon/thehubsa
 * Description: Custom Wordpress Plugin for TheHubSA.org.za. Open source code, please contribute at https://github.com/christopherbrunsdon/thehubsa
 * Version: 1.03-20150307
 * Author: Christopher Brunsdon
 * Author URI: http://www.brunsdon.co.za
 * Requires at least: 4.0
 * Tested up to: 4.1
 *
 * Text Domain: thehubsa
 */

defined('ABSPATH') or die("No script kiddies please!");

if (!class_exists('TheHubSAClass')):

/**
 * Main the hub class
 *
 */
final class TheHubSA_Class
{
    /**
     * @var string
     */
    public $version = '1.04-20150307';

    /**
     * @var null
     */
    protected static $_instance = null;

    /**
     * @return null|TheHubSA_Class
     */
    public static function instance()
    {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    /**
     *
     */
    public function __construct()
    {
        $this->define_constants();
        $this->includes();
        $this->init_hooks();
    }

    /**
     *
     */
    public function includes()
    {
        // +++ models
        require_once('models/membership_types.php');
        require_once('models/memberships.php');
        require_once('models/npo_service_types.php');
        require_once('models/npo_services.php');
        require_once('models/npos.php');

        // +++ forms
        require_once('forms/form-join.php');
        require_once('forms/form-npo.php');
        require_once('forms/form-business.php');

        // +++ controllers (views)
        require_once('controllers/npo.php');

        // +++ database
        require_once('install/add_data.php');
        require_once('install/create_tables.php');

        // +++ admin page
        require_once('admin/admin.php');
        require_once('includes/class-thehubsa-install.php');
    }

    /**
     * Define the constants here
     */
    private function define_constants()
    {
    }

    /**
     * @param $name
     * @param $value
     */
    private function define($name, $value)
    {
        if (!defined($name)) {
            define($name, $value);
        }
    }

    /**
     *
     */
    private function init_hooks()
    {
        register_activation_hook(__FILE__, array('TheHubSA_Install', 'install'));
        add_action('init', array($this, 'init'), 0);
//        add_action( 'init', array( 'TheHubSA_Shortcodes', 'init' ) );
    }

    /**
     *
     */
    public function init()
    {
        // init code comes here ....
    }

} // class
endif;

/**
 * @return null|TheHubSA_Class
 */
function TheHubSA()
{
    return TheHubSA_Class::instance();
}

// [eof]
