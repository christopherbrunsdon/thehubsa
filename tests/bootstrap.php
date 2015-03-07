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
        tests_add_filter('muplugins_loaded', array( $this, 'load_thehub' ) );

        // install TheHub
        tests_add_filter('setup_theme', array( $this, 'install_thehub' ) );

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
        TheHubSA(); // preload
        TheHubSA_Install::install();

        // reload capabilities after install, see https://core.trac.wordpress.org/ticket/28374
        // $GLOBALS['thehubsa_roles']->reinit();
        echo "Installing TheHubSA..." . PHP_EOL;
    }

    /**
     * Load TH-specific test cases and factories
     *
     */
    public function includes()
    {
        error_log(__CLASS__.":".__METHOD__);

        // helpers
        require_once($this->tests_dir.'/framework/helpers/helper_models.php');
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