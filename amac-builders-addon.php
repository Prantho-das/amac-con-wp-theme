<?php
/**
 * Plugin Name: AMAC Builders Elementor Core
 * Description: Custom pixel-perfect Elementor widgets for AMAC Builders. Every text, button, image, and style is 100% dynamic.
 * Version: 2.0.0
 * Author: Jarvis
 * Text Domain: amac-builders
 */

if (!defined('ABSPATH')) exit;

final class AMAC_Elementor_Extension {

    const VERSION = '2.0.0';
    const MINIMUM_ELEMENTOR_VERSION = '3.0.0';
    const MINIMUM_PHP_VERSION = '7.4';

    private static $_instance = null;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        add_action('plugins_loaded', [$this, 'init']);
    }

    public function init() {
        if (!did_action('elementor/loaded')) {
            add_action('admin_notices', [$this, 'admin_notice_missing_main_plugin']);
            return;
        }

        // Register Widget Category
        add_action('elementor/elements/categories_registered', [$this, 'add_elementor_widget_categories']);

        // Register Widgets
        add_action('elementor/widgets/register', [$this, 'register_widgets']);

        // Enqueue Styles & Scripts
        add_action('wp_enqueue_scripts', [$this, 'enqueue_styles_scripts']);
        add_action('elementor/frontend/after_enqueue_styles', [$this, 'enqueue_styles_scripts']);

        // AJAX Lead Capture
        add_action('wp_ajax_amac_submit_quote', [$this, 'handle_quote_submission']);
        add_action('wp_ajax_nopriv_amac_submit_quote', [$this, 'handle_quote_submission']);
    }

    public function handle_quote_submission() {
        check_ajax_referer('amac_quote_nonce', 'nonce');

        $name = sanitize_text_field($_POST['name'] ?? '');
        $email = sanitize_email($_POST['email'] ?? '');
        $phone = sanitize_text_field($_POST['phone'] ?? '');
        $project_type = sanitize_text_field($_POST['projectType'] ?? '');
        $message = sanitize_textarea_field($_POST['message'] ?? '');

        if (empty($name) || empty($email) || empty($message)) {
            wp_send_json_error(['message' => 'Please fill in all required fields.']);
        }

        $admin_email = get_option('admin_email');
        $to = !empty($admin_email) ? $admin_email : 'docamac8@gmail.com';
        $subject = "New Quote Request from " . $name . " - AMAC Builders";

        $body = "You have received a new project quote inquiry:\n\n";
        $body .= "Full Name: " . $name . "\n";
        $body .= "Email: " . $email . "\n";
        $body .= "Phone: " . $phone . "\n";
        $body .= "Project Type: " . ucfirst(str_replace('-', ' ', $project_type)) . "\n\n";
        $body .= "Project Details:\n" . $message . "\n\n";
        $body .= "---\nSent from AMAC Builders Digital Portfolio";

        $headers = ['From: AMAC Builders <' . $to . '>', 'Reply-To: ' . $name . ' <' . $email . '>'];

        $sent = wp_mail($to, $subject, $body, $headers);

        wp_send_json_success(['message' => 'Quote request sent successfully!']);
    }

    public function admin_notice_missing_main_plugin() {
        if (isset($_GET['activate'])) unset($_GET['activate']);
        $message = sprintf(
            esc_html__('"%1$s" requires "%2$s" to be installed and activated.', 'amac-builders'),
            '<strong>' . esc_html__('AMAC Builders Elementor Core', 'amac-builders') . '</strong>',
            '<strong>' . esc_html__('Elementor', 'amac-builders') . '</strong>'
        );
        printf('<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message);
    }

    public function add_elementor_widget_categories($elements_manager) {
        $elements_manager->add_category(
            'amac-elements',
            [
                'title' => esc_html__('AMAC Builders Widgets', 'amac-builders'),
                'icon' => 'fa fa-plug',
            ]
        );
    }

    public function register_widgets($widgets_manager) {
        require_once(__DIR__ . '/widgets/header-widget.php');
        require_once(__DIR__ . '/widgets/hero-widget.php');
        require_once(__DIR__ . '/widgets/stats-widget.php');
        require_once(__DIR__ . '/widgets/craftsmanship-widget.php');
        require_once(__DIR__ . '/widgets/services-widget.php');
        require_once(__DIR__ . '/widgets/services-ledger-widget.php');
        require_once(__DIR__ . '/widgets/testimonials-widget.php');
        require_once(__DIR__ . '/widgets/cta-widget.php');
        require_once(__DIR__ . '/widgets/page-banner-widget.php');
        require_once(__DIR__ . '/widgets/about-story-widget.php');
        require_once(__DIR__ . '/widgets/about-values-widget.php');
        require_once(__DIR__ . '/widgets/about-timeline-widget.php');
        require_once(__DIR__ . '/widgets/about-cta-widget.php');
        require_once(__DIR__ . '/widgets/portfolio-gallery-widget.php');
        require_once(__DIR__ . '/widgets/contact-form-widget.php');
        require_once(__DIR__ . '/widgets/footer-widget.php');

        $widgets_manager->register(new \AMAC_Header_Widget());
        $widgets_manager->register(new \AMAC_Hero_Widget());
        $widgets_manager->register(new \AMAC_Stats_Widget());
        $widgets_manager->register(new \AMAC_Craftsmanship_Widget());
        $widgets_manager->register(new \AMAC_Services_Widget());
        $widgets_manager->register(new \AMAC_Services_Ledger_Widget());
        $widgets_manager->register(new \AMAC_Testimonials_Widget());
        $widgets_manager->register(new \AMAC_CTA_Widget());
        $widgets_manager->register(new \AMAC_Page_Banner_Widget());
        $widgets_manager->register(new \AMAC_About_Story_Widget());
        $widgets_manager->register(new \AMAC_About_Values_Widget());
        $widgets_manager->register(new \AMAC_About_Timeline_Widget());
        $widgets_manager->register(new \AMAC_About_CTA_Widget());
        $widgets_manager->register(new \AMAC_Portfolio_Gallery_Widget());
        $widgets_manager->register(new \AMAC_Contact_Form_Widget());
        $widgets_manager->register(new \AMAC_Footer_Widget());
    }

    public function enqueue_styles_scripts() {
        wp_enqueue_style('amac-google-fonts', 'https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,100..900;1,9..144,100..900&family=Inter:wght@300;400;500;600;700&display=swap', [], null);
        wp_enqueue_style('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [], '11.0.0');
        wp_enqueue_style('amac-core-style', plugins_url('assets/css/style.css', __FILE__), [], self::VERSION);
        wp_enqueue_style('amac-custom-fixes', plugins_url('assets/css/custom-fixes.css', __FILE__), ['amac-core-style'], self::VERSION);

        wp_enqueue_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], '11.0.0', true);
        wp_enqueue_script('amac-testimonials-slider', plugins_url('assets/js/testimonials-slider.js', __FILE__), ['jquery', 'swiper'], self::VERSION, true);
    }
}

AMAC_Elementor_Extension::instance();
