<?php
/**
 * Plugin Name: timeline-simple-Elementor
 * Description: A simple timeline widget for Elementor With several designs and styles
 * Version:     1.4
 * Author:      M.S motekef kazemi
 * Text Domain: timeline-simple-Elementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main Elementor Test Extension Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.2
 */
final class timeline_simple_Elementor {

	/**
	 * Plugin Version
	 *
	 * @since 1.0.0
	 *
	 * @var string The plugin version.
	 */
	const VERSION = '1.2';

	/**
	 * Minimum Elementor Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum Elementor version required to run the plugin.
	 */
	const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '7.0';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 *
	 * @var Elementor_Test_Extension The single instance of the class.
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 * @return Elementor_Test_Extension An instance of the class.
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}
		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {

		add_action( 'plugins_loaded', [ $this, 'on_plugins_loaded' ] );
		add_action( 'init', [ $this, 'i18n' ] );
	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {

		load_plugin_textdomain( 'timeline-simple-Elementor', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
	}


	/**
	 * On Plugins Loaded
	 *
	 * Checks if Elementor has loaded, and performs some compatibility checks.
	 * If All checks pass, inits the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function on_plugins_loaded() {

		if ( $this->is_compatible() ) {
			add_action( 'elementor/init', [ $this, 'init' ] );
		}

	}

	/**
	 * Compatibility Checks
	 *
	 * Checks if the installed version of Elementor meets the plugin's minimum requirement.
	 * Checks if the installed PHP version meets the plugin's minimum requirement.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function is_compatible() {

		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
			return false;
		}

		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_elementor_version' ] );
			return false;
		}

		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', [ $this, 'admin_notice_minimum_php_version' ] );
			return false;
		}

		return true;

	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after Elementor (and other plugins) are loaded.
	 * Load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {
	
		add_action('plugins_loaded', 'timeline_simple_Elementor_init');

		// Register Widget Styles
		add_action( 'elementor/frontend/after_enqueue_styles', [ $this, 'widget_styles' ] );


		// Add Plugin actions
		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );
		add_action( 'elementor/controls/controls_registered', [ $this, 'init_controls' ] );

	}
	
	

	/**
	 * Init Widgets
	 *
	 * Include widgets files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_widgets() {

		// Include Widget files
    require_once( __DIR__ . '/widgets/timelinemotekef.php' );
	require_once( __DIR__ . '/widgets/timelinemotekef2.php' );
	require_once( __DIR__ . '/widgets/timelinemotekef3.php' );
	require_once( __DIR__ . '/widgets/timelinemotekef4.php' );
	require_once( __DIR__ . '/widgets/timelinemotekef5.php' );
	require_once( __DIR__ . '/widgets/timelinemotekef6.php' );
	require_once( __DIR__ . '/widgets/timelinemotekef7.php' );
	require_once( __DIR__ . '/widgets/timelinemotekef8.php' );
		// Register widget		
     \Elementor\Plugin::instance()->widgets_manager->register( new \timelinemotekef() );
	 \Elementor\Plugin::instance()->widgets_manager->register( new \timelinemotekef2() );
	 \Elementor\Plugin::instance()->widgets_manager->register( new \timelinemotekef3() );
	 \Elementor\Plugin::instance()->widgets_manager->register( new \timelinemotekef4() );
	 \Elementor\Plugin::instance()->widgets_manager->register( new \timelinemotekef5() );
	 \Elementor\Plugin::instance()->widgets_manager->register( new \timelinemotekef6() );
	 \Elementor\Plugin::instance()->widgets_manager->register( new \timelinemotekef7() );
	 \Elementor\Plugin::instance()->widgets_manager->register( new \timelinemotekef8() );
	}

	/**
	 * Init Controls
	 *
	 * Include controls files and register them
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init_controls() {
	}
	
	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have Elementor installed or activated.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_missing_main_plugin() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor */
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'timeline-simple-Elementor' ),
			'<strong>' . esc_html__( 'Motekef-Elementor', 'timeline-simple-Elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'timeline-simple-Elementor' ) . '</strong>'
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required Elementor version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_elementor_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'timeline-simple-Elementor' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'timeline-simple-Elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'timeline-simple-Elementor' ) . '</strong>',
			 self::MINIMUM_ELEMENTOR_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

		$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'timeline-simple-Elementor' ),
			'<strong>' . esc_html__( 'Elementor Test Extension', 'timeline-simple-Elementor' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'Motekef-Elementor' ) . '</strong>',
			 self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}
	// Custom CSS
	public function widget_styles() {		
		wp_register_style( 'style-css', plugins_url( '/assets/css/style.css', __FILE__ ) );
		wp_enqueue_style('style-css');		
	}
}

timeline_simple_Elementor::instance();
?>
<?php
function add_elementor_widget_categories_timeline( $elements_manager ) {

	$elements_manager->add_category(
		'timeline_simple_Elementor',
		[
			'title' => esc_html__( 'time line', 'timeline-simple-Elementor' ),
		]
	);

}
add_action( 'elementor/elements/categories_registered', 'add_elementor_widget_categories_timeline' );
?>