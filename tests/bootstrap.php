<?php
/**
 * TheHubSA unit tests
 *
 */

class TheHub_Unit_Tests_Bootstrap
{
    /**
     * @var null
     */
    protected static $instance = null;

    /**
     * @var string
     */
    public $wp_tests_dir;

    /**
     * @var string
     */
    public $tests_dir;

    /**
     * @var string
     */
    public $plugin_dir;

    /**
     * Setup the unit testing environment
     *
     */
    public function __construct()
    {
        ini_set( 'display_errors','on' );
        error_reporting( E_ALL );
        $this->tests_dir=dirname( __FILE__ );
        $this->plugin_dir=dirname( $this->tests_dir );
        $this->wp_tests_dir=getenv( 'WP_TESTS_DIR' ) ? getenv( 'WP_TESTS_DIR' ) : $this->plugin_dir . '/tmp/wordpress-tests-lib';

        // load test function so tests_add_filter() is available
        require_once( $this->wp_tests_dir . '/includes/functions.php' );

        // load TheHub
        tests_add_filter( 'muplugins_loaded', array( $this, 'load_thehub' ) );

        // install TheHub
        tests_add_filter( 'setup_theme', array( $this, 'install_thehub' ) );

        // load the WP testing environment
        require_once( $this->wp_tests_dir . '/includes/bootstrap.php' );

        // load WC testing framework
        $this->includes();
    }

    /**
     * Load TheHubSa
     *
     */
    public function load_thehub()
    {
        require_once($this->plugin_dir.'/thehubsa-plugin.php');
    }

    /**
     * Install TheHubSa after the test environment and WC have been loaded
     *
     */
    public function install_thehub()
    {
        // clean existing install first
        define( 'WP_UNINSTALL_PLUGIN', true );
        include( $this->plugin_dir . '/uninstall.php' );
        TheHubSA_Install::install();

        // reload capabilities after install, see https://core.trac.wordpress.org/ticket/28374
        $GLOBALS['wp_roles']->reinit();
        echo "Installing TheHubSA..." . PHP_EOL;
    }

    /**
     * Load TH-specific test cases and factories
     *
     */
    public function includes()
    {
//        // factories
//        require_once( $this->tests_dir . '/framework/factories/class-wc-unit-test-factory-for-webhook.php' );
//        require_once( $this->tests_dir . '/framework/factories/class-wc-unit-test-factory-for-webhook-delivery.php' );
//        // framework
//        require_once( $this->tests_dir . '/framework/class-wc-unit-test-factory.php' );
//        require_once( $this->tests_dir . '/framework/class-wc-mock-session-handler.php' );
//        // test cases
//        require_once( $this->tests_dir . '/framework/class-wc-unit-test-case.php' );
//        require_once( $this->tests_dir . '/framework/class-wc-api-unit-test-case.php' );
//        // Helpers
//        require_once( $this->tests_dir . '/framework/helpers/class-wc-helper-product.php' );
//        require_once( $this->tests_dir . '/framework/helpers/class-wc-helper-coupon.php' );
//        require_once( $this->tests_dir . '/framework/helpers/class-wc-helper-fee.php' );
//        require_once( $this->tests_dir . '/framework/helpers/class-wc-helper-shipping.php' );
//        require_once( $this->tests_dir . '/framework/helpers/class-wc-helper-customer.php' );
    }

    /**
     * @return null|TheHub_Unit_Tests_Bootstrap
     */
    public static function instance()
    {
        if (is_null(self::$instance)) {
            self::$instance=new self();
        }
        return self::$instance;
    }
}

TheHub_Unit_Tests_Bootstrap::instance();