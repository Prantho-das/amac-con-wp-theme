<?php
if (!defined('ABSPATH')) exit;

class AMAC_Admin_Settings {

    private static $_instance = null;

    public static function instance() {
        if (is_null(self::$_instance)) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function __construct() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_init', [$this, 'register_settings']);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
        add_action('wp_head', [$this, 'output_css_variables'], 1);
        add_action('wp_head', [$this, 'output_critical_overrides'], 999999);
        add_action('wp_footer', [$this, 'output_critical_overrides'], 999999);
        add_action('elementor/editor/after_enqueue_styles', [$this, 'output_css_variables'], 1);
        add_action('elementor/editor/after_enqueue_styles', [$this, 'output_critical_overrides'], 999999);

        add_action('update_option_amac_color_dark', [$this, 'purge_all_caches']);
        add_action('update_option_amac_color_gold', [$this, 'purge_all_caches']);
        add_action('update_option_amac_color_gold_hover', [$this, 'purge_all_caches']);
        add_action('update_option_amac_color_btn_text', [$this, 'purge_all_caches']);
        add_action('admin_post_amac_purge_cache', [$this, 'handle_manual_purge']);
    }

    public function purge_all_caches() {
        if (has_action('litespeed_purge_all')) {
            do_action('litespeed_purge_all');
        }
        if (function_exists('wp_cache_flush')) {
            wp_cache_flush();
        }
    }

    public function handle_manual_purge() {
        if (!current_user_can('manage_options')) {
            wp_die('Unauthorized');
        }
        check_admin_referer('amac_purge_cache_nonce');
        $this->purge_all_caches();
        wp_safe_redirect(add_query_arg(['page' => 'amac-brand-colors', 'cache_purged' => '1'], admin_url('admin.php')));
        exit;
    }

    public function add_admin_menu() {
        add_menu_page(
            esc_html__('AMAC Brand Colors', 'amac-builders'),
            esc_html__('AMAC Colors', 'amac-builders'),
            'manage_options',
            'amac-brand-colors',
            [$this, 'render_settings_page'],
            'dashicons-art',
            59
        );
    }

    public function register_settings() {
        register_setting('amac_colors_group', 'amac_color_dark', [
            'type' => 'string',
            'sanitize_callback' => 'sanitize_hex_color',
            'default' => '#0B1325',
        ]);
        register_setting('amac_colors_group', 'amac_color_gold', [
            'type' => 'string',
            'sanitize_callback' => 'sanitize_hex_color',
            'default' => '#C5A059',
        ]);
        register_setting('amac_colors_group', 'amac_color_gold_hover', [
            'type' => 'string',
            'sanitize_callback' => 'sanitize_hex_color',
            'default' => '#B38728',
        ]);
        register_setting('amac_colors_group', 'amac_color_btn_text', [
            'type' => 'string',
            'sanitize_callback' => 'sanitize_hex_color',
            'default' => '#0B1325',
        ]);
    }

    public function enqueue_admin_assets($hook) {
        if ($hook !== 'toplevel_page_amac-brand-colors') return;
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
        wp_add_inline_script('wp-color-picker', 'jQuery(document).ready(function($){ $(".amac-color-field").wpColorPicker(); });');
    }

    public function output_css_variables() {
        $dark = AMAC_Theme_Config::get_dark();
        $gold = AMAC_Theme_Config::get_gold();
        $gold_hover = AMAC_Theme_Config::get_hover();
        $btn_text = AMAC_Theme_Config::get_btn_text();
        ?>
        <style id="amac-global-css-variables">
            :root {
                --amac-dark: <?php echo esc_attr($dark); ?> !important;
                --amac-gold: <?php echo esc_attr($gold); ?> !important;
                --amac-gold-hover: <?php echo esc_attr($gold_hover); ?> !important;
                --amac-btn-text: <?php echo esc_attr($btn_text); ?> !important;
            }
        </style>
        <?php
    }

    public function output_critical_overrides() {
        ?>
        <style id="amac-critical-color-overrides">
            html body .hero-btn-primary,
            html body a.hero-btn-primary,
            html body .amac-btn-primary,
            html body a.amac-btn-primary,
            html body .header-quote-btn,
            html body a.header-quote-btn,
            html body header .header-quote-btn,
            html body #amac-site-header .header-quote-btn,
            html body .modal-action-btn,
            html body a.modal-action-btn,
            html body [id^="amac-modal-btn"],
            html body button.submit-btn,
            html body .wpcf7-submit,
            html body .wpforms-submit,
            html body a.bg-\[\#5D0D15\],
            html body button.bg-\[\#5D0D15\] {
                background-color: var(--amac-gold, #C5A059) !important;
                background: var(--amac-gold, #C5A059) !important;
                color: var(--amac-btn-text, #0B1325) !important;
                border: 1px solid var(--amac-gold, #C5A059) !important;
                text-decoration: none !important;
            }
            html body .hero-btn-primary span,
            html body a.hero-btn-primary span,
            html body .amac-btn-primary span,
            html body a.amac-btn-primary span,
            html body .header-quote-btn span,
            html body a.header-quote-btn span,
            html body .modal-action-btn span,
            html body a.modal-action-btn span,
            html body button.submit-btn span {
                color: var(--amac-btn-text, #0B1325) !important;
            }
            html body .hero-btn-primary svg,
            html body a.hero-btn-primary svg,
            html body .amac-btn-primary svg,
            html body a.amac-btn-primary svg,
            html body .header-quote-btn svg,
            html body a.header-quote-btn svg,
            html body .modal-action-btn svg,
            html body a.modal-action-btn svg,
            html body button.submit-btn svg {
                color: var(--amac-btn-text, #0B1325) !important;
                stroke: var(--amac-btn-text, #0B1325) !important;
            }
            html body .hero-btn-primary:hover,
            html body a.hero-btn-primary:hover,
            html body .amac-btn-primary:hover,
            html body a.amac-btn-primary:hover,
            html body .header-quote-btn:hover,
            html body a.header-quote-btn:hover,
            html body header .header-quote-btn:hover,
            html body #amac-site-header .header-quote-btn:hover,
            html body .modal-action-btn:hover,
            html body a.modal-action-btn:hover,
            html body [id^="amac-modal-btn"]:hover,
            html body button.submit-btn:hover,
            html body .wpcf7-submit:hover,
            html body .wpforms-submit:hover {
                background-color: var(--amac-gold-hover, #B38728) !important;
                background: var(--amac-gold-hover, #B38728) !important;
                color: #FFFFFF !important;
                border-color: var(--amac-gold-hover, #B38728) !important;
            }
            html body .hero-btn-primary:hover span,
            html body a.hero-btn-primary:hover span,
            html body .amac-btn-primary:hover span,
            html body a.amac-btn-primary:hover span,
            html body .header-quote-btn:hover span,
            html body a.header-quote-btn:hover span,
            html body .modal-action-btn:hover span,
            html body a.modal-action-btn:hover span,
            html body button.submit-btn:hover span {
                color: #FFFFFF !important;
            }
            html body .hero-btn-primary:hover svg,
            html body a.hero-btn-primary:hover svg,
            html body .amac-btn-primary:hover svg,
            html body a.amac-btn-primary:hover svg,
            html body .header-quote-btn:hover svg,
            html body a.header-quote-btn:hover svg,
            html body .modal-action-btn:hover svg,
            html body a.modal-action-btn:hover svg,
            html body button.submit-btn:hover svg {
                color: #FFFFFF !important;
                stroke: #FFFFFF !important;
            }
            html body .modal-nav-btn,
            html body [id^="amac-modal-"] .modal-nav-btn {
                background: var(--amac-dark, #0B1325) !important;
                background-color: var(--amac-dark, #0B1325) !important;
                color: var(--amac-gold, #C5A059) !important;
                border: 1px solid var(--amac-gold, #C5A059) !important;
            }
            html body .modal-nav-btn:hover,
            html body [id^="amac-modal-"] .modal-nav-btn:hover {
                background: var(--amac-gold, #C5A059) !important;
                background-color: var(--amac-gold, #C5A059) !important;
                color: var(--amac-btn-text, #0B1325) !important;
            }
            html body .filter-btn,
            html body [data-filter] {
                background: transparent !important;
                border: 1px solid rgba(197, 160, 89, 0.3) !important;
                color: rgba(26, 26, 26, 0.6) !important;
            }
            html body .filter-btn:hover,
            html body [data-filter]:hover {
                border-color: var(--amac-gold, #C5A059) !important;
                color: var(--amac-gold, #C5A059) !important;
                background: transparent !important;
            }
            html body .filter-btn.is-active,
            html body [data-filter].is-active,
            html body .portfolio-filters .filter-btn.is-active {
                background-color: var(--amac-dark, #0B1325) !important;
                background: var(--amac-dark, #0B1325) !important;
                color: var(--amac-gold, #C5A059) !important;
                border-color: var(--amac-gold, #C5A059) !important;
            }
            html body .amac-values-icon-box,
            html body .amac-values-wrapper .w-14.h-14 {
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                background-color: var(--amac-dark, #0B1325) !important;
                border: 1px solid rgba(197, 160, 89, 0.45) !important;
                border-radius: 4px !important;
            }
            html body .amac-values-icon-box svg,
            html body .amac-values-wrapper svg {
                display: block !important;
                width: 26px !important;
                height: 26px !important;
                stroke: var(--amac-gold, #C5A059) !important;
                color: var(--amac-gold, #C5A059) !important;
                fill: none !important;
                stroke-width: 2.2px !important;
            }
            html body .services-section .w-12.h-12 {
                background-color: var(--amac-dark, #0B1325) !important;
                border: 1px solid rgba(197, 160, 89, 0.45) !important;
            }
            html body .services-section .w-12.h-12 svg {
                stroke: var(--amac-gold, #C5A059) !important;
                color: var(--amac-gold, #C5A059) !important;
            }
        </style>
        <?php
    }

    public function render_settings_page() {
        if (!current_user_can('manage_options')) return;
        $dark = get_option('amac_color_dark', '#0B1325');
        $gold = get_option('amac_color_gold', '#C5A059');
        $gold_hover = get_option('amac_color_gold_hover', '#B38728');
        $btn_text = get_option('amac_color_btn_text', '#0B1325');
        ?>
        <div class="wrap" style="max-width: 820px; margin-top: 25px;">
            <?php if (!empty($_GET['cache_purged'])): ?>
                <div class="notice notice-success is-dismissible" style="border-left-color: #C5A059;">
                    <p><strong>✓ LiteSpeed & Server Cache successfully purged across all pages!</strong></p>
                </div>
            <?php endif; ?>
            <div style="background: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 4px 15px rgba(0,0,0,0.06); border-left: 5px solid #C5A059;">
                <h1 style="margin-top:0; font-size: 24px; color: #0B1325; display: flex; align-items: center; gap: 10px;">
                    <span class="dashicons dashicons-art" style="font-size: 28px; width: 28px; height: 28px; color: #C5A059;"></span>
                    AMAC Global Color Controller
                </h1>
                <p style="color: #666; font-size: 14px; margin-bottom: 25px;">
                    Change brand colors here to update all 16 Elementor widgets, headers, footers, forms, and buttons site-wide instantly.
                </p>

                <form method="post" action="options.php">
                    <?php settings_fields('amac_colors_group'); ?>
                    <?php do_settings_sections('amac_colors_group'); ?>

                    <table class="form-table" style="margin-top: 10px;">
                        <tr valign="top">
                            <th scope="row" style="font-weight: 600; width: 240px;">Primary Dark Color</th>
                            <td>
                                <input type="text" name="amac_color_dark" value="<?php echo esc_attr($dark); ?>" class="amac-color-field" data-default-color="#0B1325" />
                                <p class="description">Used for dark sections (stats, page banner, testimonials, drawer, headings).</p>
                            </td>
                        </tr>

                        <tr valign="top">
                            <th scope="row" style="font-weight: 600;">Gold Accent / Button Color</th>
                            <td>
                                <input type="text" name="amac_color_gold" value="<?php echo esc_attr($gold); ?>" class="amac-color-field" data-default-color="#C5A059" />
                                <p class="description">Used for primary action buttons, borders, badges, and icons.</p>
                            </td>
                        </tr>

                        <tr valign="top">
                            <th scope="row" style="font-weight: 600;">Button Hover Color</th>
                            <td>
                                <input type="text" name="amac_color_gold_hover" value="<?php echo esc_attr($gold_hover); ?>" class="amac-color-field" data-default-color="#B38728" />
                                <p class="description">Used when hovering buttons and interactive gold highlights.</p>
                            </td>
                        </tr>

                        <tr valign="top">
                            <th scope="row" style="font-weight: 600;">Button Text Color</th>
                            <td>
                                <input type="text" name="amac_color_btn_text" value="<?php echo esc_attr($btn_text); ?>" class="amac-color-field" data-default-color="#0B1325" />
                                <p class="description">Text color inside primary gold buttons.</p>
                            </td>
                        </tr>
                    </table>

                    <div style="margin-top: 30px; padding-top: 20px; border-top: 1px solid #eee; display: flex; align-items: center; justify-content: space-between;">
                        <?php submit_button('Save Global Colors', 'primary', 'submit', false, ['style' => 'background: #0B1325; border-color: #0B1325; padding: 8px 24px; font-weight: 600;']); ?>
                    </div>
                </form>

                <div style="margin-top: 25px; padding-top: 20px; border-top: 1px dashed #ddd; display: flex; align-items: center; justify-content: space-between;">
                    <div>
                        <strong style="color: #0B1325; font-size: 14px;">Server & LiteSpeed Cache:</strong>
                        <p style="margin: 3px 0 0; color: #777; font-size: 13px;">Purge LiteSpeed edge cache to make changes visible to external visitors immediately.</p>
                    </div>
                    <form method="post" action="<?php echo esc_url(admin_url('admin-post.php')); ?>">
                        <?php wp_nonce_field('amac_purge_cache_nonce'); ?>
                        <input type="hidden" name="action" value="amac_purge_cache">
                        <button type="submit" class="button button-secondary" style="color: #0B1325; border-color: #C5A059; font-weight: 600; padding: 6px 18px;">
                            ⚡ Purge All Cache
                        </button>
                    </form>
                </div>
            </div>
        </div>
        <?php
    }
}

AMAC_Admin_Settings::instance();
