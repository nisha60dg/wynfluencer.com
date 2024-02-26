<?php 
/**
 * Plugin Name: DODO Artworks
 * Plugin URI: https://60degreedigital.com
 * Description: Fetch Artwokrs, Artists and Openings from Friends of DODO Platform
 * Author: Uday Singh
 * Version: 1.0
 * Text Domain: dodo-artworks
 * 
 * 
 * @package dodoArtworks
 * @category Core
 * @author Amit Kumar
 * @version 1.0
 */


// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit; 

if ( ! class_exists( 'DODO_ARTWORKS' ) ) :

    /**
     * Main DODO_ARTWORKS Class
     *
     * @since 1.0
     */
    final class DODO_ARTWORKS {

        /**
         * dodoArtworks instance.
         *
         * @access private
         * @since  1.0
         * @var    DODO_ARTWORKS The one true DODO_ARTWORKS
         */
        private static $instance;

        /**
         * The DODO_ARTWORKS APIs handler instance variable
         *
         * @access public
         * @since  1.0
         * @var    DODO_ARTWORKS_RESTAPI
         */
        public $RESTAPI;
        
        /**
         * The version number of dodoArtworks.
         *
         * @access private
         * @since  1.0
         * @var    string
         */
        private $version = '1.0';


        public static function instance() {
            if ( ! isset( self::$instance ) && ! ( self::$instance instanceof DODO_ARTWORKS ) ) {
                self::$instance = new DODO_ARTWORKS;
    
                // ini_set('display_errors', 1);
                // ini_set('display_startup_errors', 1);
                // error_reporting(E_ALL);
    
                if( version_compare( PHP_VERSION, '5.3', '<' ) ) {
    
                    add_action( 'admin_notices', array( 'DODO_ARTWORKS', 'below_php_version_notice' ) );
    
                    return self::$instance;
    
                }
    
                
                self::$instance->setup_constants();
                self::$instance->includes();
    
                add_action( 'plugins_loaded', array( self::$instance, 'setup_objects' ), -1 );    
            }
            return self::$instance;
        }

        /**
         * Throw error on object clone
         *
         * The whole idea of the singleton design pattern is that there is a single
         * object therefore, we don't want the object to be cloned.
         *
         * @since 1.0
         * @access protected
         * @return void
         */
        public function __clone() {
            // Cloning instances of the class is forbidden
            _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'dodo-artworks' ), '1.0' );
        }

        /**
         * Disable unserializing of the class
         *
         * @since 1.0
         * @access protected
         * @return void
         */
        public function __wakeup() {
            // Unserializing instances of the class is forbidden
            _doing_it_wrong( __FUNCTION__, __( 'Cheatin&#8217; huh?', 'dodo-artworks' ), '1.0' );
        }

        /**
         * Show a warning to sites running PHP < 5.3
         *
         * @static
         * @access private
         * @since 1.0
         * @return void
         */
        public static function below_php_version_notice() {
            echo '<div class="error"><p>' . __( 'Your version of PHP is below the minimum version of PHP required by this plugin. Please contact your host and request that your version be upgraded to 5.3 or later.', 'dodo-artworks' ) . '</p></div>';
        }

        /**
         * Setup plugin constants
         *
         * @access private
         * @since 1.0
         * @return void
         */
        private function setup_constants() {
            // Plugin version
            if ( ! defined( 'DODO_ARTWORKS_VERSION' ) ) {
                define( 'DODO_ARTWORKS_VERSION', $this->version );
            }

            if ( ! defined( 'DODO_ARTWORKS_DIR' ) ) {
                define( 'DODO_ARTWORKS_DIR', plugin_dir_path( __FILE__ ) );
            }

            // Plugin Folder URL
            if ( ! defined( 'DODO_ARTWORKS_URL' ) ) {
                define( 'DODO_ARTWORKS_URL', plugin_dir_url( __FILE__ ) );
            }
            
            if ( ! defined( 'DODO_STYLESHEET_DIR' ) ) {
                define( 'DODO_STYLESHEET_DIR', get_stylesheet_directory() );
            }

            if ( ! defined( 'DODO_STYLESHEET_URL' ) ) {
                define( 'DODO_STYLESHEET_URL', get_stylesheet_directory_uri() );
            }

            // Plugin Root File
		if ( ! defined( 'DODO_PLUGIN_FILE' ) ) {
			define( 'DODO_PLUGIN_FILE', __FILE__ );
		}
        }

        /**
         * Include required files
         *
         * @access private
         * @since 1.0
         * @return void
         */
        private function includes() {

            require_once DODO_ARTWORKS_DIR . 'includes/abstracts/class-templates.php';
            require_once DODO_ARTWORKS_DIR . 'includes/misc-functions.php';
            require_once DODO_ARTWORKS_DIR . 'includes/install.php';
            require_once DODO_ARTWORKS_DIR . 'includes/class-shortcodes.php';
            require_once DODO_ARTWORKS_DIR . 'includes/dodo-url-rules.php';

            require_once DODO_ARTWORKS_DIR . 'includes/abstracts/class-curl.php';
            require_once DODO_ARTWORKS_DIR . 'includes/api/class-api.php';
            require_once DODO_ARTWORKS_DIR . 'includes/api/class-shows-api.php';
            require_once DODO_ARTWORKS_DIR . 'includes/api/class-openings-api.php';
            require_once DODO_ARTWORKS_DIR . 'includes/api/class-artists-api.php';
            require_once DODO_ARTWORKS_DIR . 'includes/api/class-artworks-api.php';
            if ( is_admin() || ( defined( 'WP_CLI' ) && WP_CLI ) ) {                

            }
        }

        /**
         * Setup all objects
         *
         * @access public
         * @since 1.0
         * @return void
         */
        public function setup_objects() {

            self::$instance->RESTAPI    		= new DODO_ARTWORKS_RESTAPI;
            self::$instance->Templates    		= new DODO_Artwork_Templates;
        }
        
    }

endif;



/**
 * The main function responsible for returning the one true DODO_ARTWORKS
 * Instance to functions everywhere.
 *
 * Use this function like you would a global variable, except without needing
 * to declare the global.
 *
 * Example: <?php $dodoartworks = dodoartworks(); ?>
 *
 * @since 1.0
 * @return DODO_ARTWORKS The one true DODO_ARTWORKS Instance
 */
function dodoartworks() {
	return DODO_ARTWORKS::instance();
}
dodoartworks();