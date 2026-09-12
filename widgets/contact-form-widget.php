<?php
if (!defined('ABSPATH')) exit;

class AMAC_Contact_Form_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'amac_contact_form';
    }

    public function get_title() {
        return esc_html__('AMAC Contact & Quote Form', 'amac-builders');
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    public function get_categories() {
        return ['amac-elements'];
    }

    protected function register_controls() {
        // Left Column Controls
        $this->start_controls_section(
            'section_direct_access',
            [
                'label' => esc_html__('Direct Access Info', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'col_title',
            [
                'label' => esc_html__('Column Title', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Direct Access',
            ]
        );

        $this->add_control(
            'phone',
            [
                'label' => esc_html__('Phone Number', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => '617.388.5901',
            ]
        );

        $this->add_control(
            'email',
            [
                'label' => esc_html__('Email Address', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'docamac8@gmail.com',
            ]
        );

        $this->add_control(
            'service_area_title',
            [
                'label' => esc_html__('Service Area Title', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Greater Boston Area',
            ]
        );

        $this->add_control(
            'service_area_sub',
            [
                'label' => esc_html__('Service Area Communities', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => 'Brookline, Newton, Wellesley, Cambridge, Somerville & surrounding communities',
            ]
        );

        $this->add_control(
            'danny_name',
            [
                'label' => esc_html__('Owner Name', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => "Danny O'Connor",
            ]
        );

        $this->add_control(
            'danny_title',
            [
                'label' => esc_html__('Owner Title', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Owner & Master Builder',
            ]
        );

        $this->add_control(
            'danny_quote',
            [
                'label' => esc_html__('Owner Quote', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => '"I personally review every inquiry and respond within 24 hours. Your project deserves direct attention from the start."',
            ]
        );

        $this->end_controls_section();

        // Right Column Form Controls
        $this->start_controls_section(
            'section_form_settings',
            [
                'label' => esc_html__('Form Settings', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'form_shortcode',
            [
                'label' => esc_html__('Form Shortcode (Optional)', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'placeholder' => '[contact-form-7 id="123"]',
                'description' => esc_html__('Leave empty to use the built-in pixel-perfect HTML form.', 'amac-builders'),
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__('Submit Button Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Submit Quote Request',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();
        $clean_phone = preg_replace('/[^0-9]/', '', $settings['phone']);

        $this->add_inline_editing_attributes('col_title', 'none');
        $this->add_inline_editing_attributes('phone', 'none');
        $this->add_inline_editing_attributes('email', 'none');
        $this->add_inline_editing_attributes('service_area_title', 'none');
        $this->add_inline_editing_attributes('service_area_sub', 'basic');
        $this->add_inline_editing_attributes('danny_name', 'none');
        $this->add_inline_editing_attributes('danny_title', 'none');
        $this->add_inline_editing_attributes('danny_quote', 'basic');
        $this->add_inline_editing_attributes('btn_text', 'none');
        $nonce = wp_create_nonce('amac_quote_nonce');
        $ajax_url = admin_url('admin-ajax.php');
        ?>
        <style>
            #contact-section-<?php echo esc_attr($widget_id); ?> {
                background-color: #FDFCF8 !important;
                width: 100% !important;
                box-sizing: border-box !important;
            }
            #contact-section-<?php echo esc_attr($widget_id); ?> .amac-form-row {
                display: grid !important;
                grid-template-columns: 1fr 1fr !important;
                gap: 28px !important;
                margin-bottom: 28px !important;
                width: 100% !important;
            }
            @media (max-width: 640px) {
                #contact-section-<?php echo esc_attr($widget_id); ?> .amac-form-row {
                    grid-template-columns: 1fr !important;
                    gap: 20px !important;
                }
            }
            #contact-section-<?php echo esc_attr($widget_id); ?> .amac-form-full {
                margin-bottom: 28px !important;
                width: 100% !important;
            }
            #contact-section-<?php echo esc_attr($widget_id); ?> .amac-field {
                display: flex !important;
                flex-direction: column !important;
                width: 100% !important;
            }
            #contact-section-<?php echo esc_attr($widget_id); ?> .amac-input,
            #contact-section-<?php echo esc_attr($widget_id); ?> .wpcf7-form input[type="text"],
            #contact-section-<?php echo esc_attr($widget_id); ?> .wpcf7-form input[type="email"],
            #contact-section-<?php echo esc_attr($widget_id); ?> .wpcf7-form input[type="tel"],
            #contact-section-<?php echo esc_attr($widget_id); ?> .wpcf7-form select,
            #contact-section-<?php echo esc_attr($widget_id); ?> .wpcf7-form textarea,
            #contact-section-<?php echo esc_attr($widget_id); ?> .wpforms-form input[type="text"],
            #contact-section-<?php echo esc_attr($widget_id); ?> .wpforms-form input[type="email"],
            #contact-section-<?php echo esc_attr($widget_id); ?> .wpforms-form input[type="tel"],
            #contact-section-<?php echo esc_attr($widget_id); ?> .wpforms-form textarea {
                width: 100% !important;
                background: transparent !important;
                background-color: transparent !important;
                border: none !important;
                border-bottom: 2px solid rgba(147, 132, 111, 0.3) !important;
                border-radius: 0px !important;
                box-shadow: none !important;
                outline: none !important;
                padding: 4px 0 12px 0 !important;
                margin: 0 !important;
                color: #1A1A1A !important;
                font-family: "Inter", sans-serif !important;
                font-size: 1.05rem !important;
                line-height: 1.6 !important;
                transition: border-color 0.3s ease !important;
                box-sizing: border-box !important;
                background-repeat: no-repeat !important;
            }
            #contact-section-<?php echo esc_attr($widget_id); ?> select.amac-input {
                background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='16' height='16' viewBox='0 0 24 24' fill='none' stroke='%23C5A059' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m6 9 6 6 6-6'/%3E%3C/svg%3E") !important;
                background-repeat: no-repeat !important;
                background-position: right center !important;
                padding-right: 24px !important;
                cursor: pointer;
                -webkit-appearance: none;
                -moz-appearance: none;
                appearance: none;
            }
            #contact-section-<?php echo esc_attr($widget_id); ?> .amac-input:focus,
            #contact-section-<?php echo esc_attr($widget_id); ?> .wpcf7-form input:focus,
            #contact-section-<?php echo esc_attr($widget_id); ?> .wpcf7-form textarea:focus {
                border-bottom-color: #1f2c2c !important;
                outline: none !important;
                box-shadow: none !important;
            }
            #contact-section-<?php echo esc_attr($widget_id); ?> .amac-input::placeholder {
                color: rgba(26, 26, 26, 0.25) !important;
            }
            #contact-section-<?php echo esc_attr($widget_id); ?> .amac-label,
            #contact-section-<?php echo esc_attr($widget_id); ?> .wpcf7-form label,
            #contact-section-<?php echo esc_attr($widget_id); ?> .wpforms-field-label {
                display: block !important;
                color: #93846f !important;
                font-size: 11px !important;
                letter-spacing: 0.2em !important;
                text-transform: uppercase !important;
                font-weight: 600 !important;
                margin-bottom: 8px !important;
                font-family: "Inter", sans-serif !important;
            }
            #contact-section-<?php echo esc_attr($widget_id); ?> button.submit-btn,
            #contact-section-<?php echo esc_attr($widget_id); ?> .wpcf7-form input[type="submit"],
            #contact-section-<?php echo esc_attr($widget_id); ?> .wpforms-submit {
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                gap: 12px !important;
                background-color: #1f2c2c !important;
                color: #FDFCF8 !important;
                border: none !important;
                border-radius: 0px !important;
                padding: 16px 36px !important;
                font-size: 13px !important;
                letter-spacing: 0.2em !important;
                text-transform: uppercase !important;
                cursor: pointer !important;
                transition: all 0.3s ease !important;
                font-weight: 600 !important;
                font-family: "Inter", sans-serif !important;
                box-sizing: border-box !important;
                max-width: 100% !important;
            }
            #contact-section-<?php echo esc_attr($widget_id); ?> button.submit-btn:hover,
            #contact-section-<?php echo esc_attr($widget_id); ?> .wpcf7-form input[type="submit"]:hover,
            #contact-section-<?php echo esc_attr($widget_id); ?> .wpforms-submit:hover {
                background-color: #2a3d3d !important;
            }
            @media (max-width: 640px) {
                #contact-section-<?php echo esc_attr($widget_id); ?> button.submit-btn,
                #contact-section-<?php echo esc_attr($widget_id); ?> .wpcf7-form input[type="submit"],
                #contact-section-<?php echo esc_attr($widget_id); ?> .wpforms-submit {
                    width: 100% !important;
                    padding: 15px 16px !important;
                    font-size: 12px !important;
                    letter-spacing: 0.12em !important;
                    justify-content: center !important;
                    text-align: center !important;
                }
            }
            #contact-section-<?php echo esc_attr($widget_id); ?> .info-icon-box {
                width: 48px;
                height: 48px;
                background-color: rgba(31, 44, 44, 0.05);
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
            }
            #contact-section-<?php echo esc_attr($widget_id); ?> .info-icon-box svg {
                color: #1f2c2c;
                width: 20px;
                height: 20px;
            }
            #contact-section-<?php echo esc_attr($widget_id); ?> .danny-box {
                margin-top: 48px;
                padding: 24px;
                background-color: #1f2c2c;
                color: #FDFCF8;
            }
            /* Browser autofill fix */
            #contact-section-<?php echo esc_attr($widget_id); ?> input:-webkit-autofill,
            #contact-section-<?php echo esc_attr($widget_id); ?> input:-webkit-autofill:hover, 
            #contact-section-<?php echo esc_attr($widget_id); ?> input:-webkit-autofill:focus {
                -webkit-box-shadow: 0 0 0px 1000px #FDFCF8 inset !important;
                -webkit-text-fill-color: #1A1A1A !important;
            }
        </style>

        <section class="py-16 md:py-24 bg-[#FDFCF8] w-full" id="contact-section-<?php echo esc_attr($widget_id); ?>">
            <div class="max-w-7xl mx-auto px-6 md:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-5 gap-12 lg:gap-16">
                    <!-- Left Column (Direct Access) -->
                    <div class="lg:col-span-2">
                        <h3 class="font-display text-2xl text-[#1f2c2c] font-semibold mb-8" <?php echo $this->get_render_attribute_string('col_title'); ?>>
                            <?php echo esc_html($settings['col_title']); ?>
                        </h3>

                        <div class="space-y-8">
                            <!-- Phone -->
                            <a href="tel:<?php echo esc_attr($clean_phone); ?>" class="flex items-start gap-4 group" style="text-decoration: none;">
                                <div class="info-icon-box">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs tracking-[0.2em] uppercase text-[#93846f] mb-1 font-medium">Phone</p>
                                    <p class="text-[#1A1A1A] text-lg group-hover:text-[#1f2c2c] transition-colors" <?php echo $this->get_render_attribute_string('phone'); ?>>
                                        <?php echo esc_html($settings['phone']); ?>
                                    </p>
                                </div>
                            </a>

                            <!-- Email -->
                            <a href="mailto:<?php echo esc_attr($settings['email']); ?>" class="flex items-start gap-4 group" style="text-decoration: none;">
                                <div class="info-icon-box">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>
                                </div>
                                <div>
                                    <p class="text-xs tracking-[0.2em] uppercase text-[#93846f] mb-1 font-medium">Email</p>
                                    <p class="text-[#1A1A1A] text-lg group-hover:text-[#1f2c2c] transition-colors" <?php echo $this->get_render_attribute_string('email'); ?>>
                                        <?php echo esc_html($settings['email']); ?>
                                    </p>
                                </div>
                            </a>

                            <!-- Service Area -->
                            <div class="flex items-start gap-4">
                                <div class="info-icon-box">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                </div>
                                <div>
                                    <p class="text-xs tracking-[0.2em] uppercase text-[#93846f] mb-1 font-medium">Service Area</p>
                                    <p class="text-[#1A1A1A] text-lg" <?php echo $this->get_render_attribute_string('service_area_title'); ?>><?php echo esc_html($settings['service_area_title']); ?></p>
                                    <p class="text-[#1A1A1A]/50 text-sm mt-1 leading-relaxed" <?php echo $this->get_render_attribute_string('service_area_sub'); ?>><?php echo esc_html($settings['service_area_sub']); ?></p>
                                </div>
                            </div>
                        </div>

                        <!-- Danny Quote Box -->
                        <div class="danny-box">
                            <p class="font-display text-lg font-semibold mb-2 text-[#FDFCF8]" <?php echo $this->get_render_attribute_string('danny_name'); ?>><?php echo esc_html($settings['danny_name']); ?></p>
                            <p class="text-[#93846f] text-xs tracking-[0.2em] uppercase mb-4" <?php echo $this->get_render_attribute_string('danny_title'); ?>><?php echo esc_html($settings['danny_title']); ?></p>
                            <p class="text-[#FDFCF8]/70 text-sm leading-relaxed" <?php echo $this->get_render_attribute_string('danny_quote'); ?>>
                                <?php echo esc_html($settings['danny_quote']); ?>
                            </p>
                        </div>
                    </div>

                    <!-- Right Column (Form) -->
                    <div class="lg:col-span-3">
                        <?php if (!empty($settings['form_shortcode'])): ?>
                            <div class="amac-custom-form-wrapper">
                                <?php echo do_shortcode($settings['form_shortcode']); ?>
                            </div>
                        <?php else: ?>
                            <div id="contact-success-msg-<?php echo esc_attr($widget_id); ?>" style="display: none; margin-bottom: 24px; padding: 20px; background-color: #1f2c2c; border: 1px solid #93846f; color: #FDFCF8;">
                                <p style="font-family: 'Fraunces', serif; font-weight: 600; font-size: 1.125rem; color: #93846f; margin: 0 0 4px 0;">✓ Quote Request Received</p>
                                <p style="font-size: 0.875rem; color: rgba(253, 252, 248, 0.9); margin: 0;">Thank you! Danny O'Connor personally reviews every inquiry and will respond within 24 hours.</p>
                            </div>

                            <form id="amac-contact-form-<?php echo esc_attr($widget_id); ?>" style="width: 100%;">
                                <input type="hidden" name="action" value="amac_submit_quote">
                                <input type="hidden" name="nonce" value="<?php echo esc_attr($nonce); ?>">

                                <div class="amac-form-row">
                                    <div class="amac-field">
                                        <label class="amac-label">Full Name *</label>
                                        <input type="text" name="name" required class="amac-input" placeholder="Your name">
                                    </div>
                                    <div class="amac-field">
                                        <label class="amac-label">Email *</label>
                                        <input type="email" name="email" required class="amac-input" placeholder="email@example.com">
                                    </div>
                                </div>

                                <div class="amac-form-row">
                                    <div class="amac-field">
                                        <label class="amac-label">Phone</label>
                                        <input type="tel" name="phone" class="amac-input" placeholder="(617) 000-0000">
                                    </div>
                                    <div class="amac-field">
                                        <label class="amac-label">Project Type</label>
                                        <select name="projectType" class="amac-input">
                                            <option value="">Select a service</option>
                                            <option value="new-construction">New Construction</option>
                                            <option value="remodeling">Remodeling & Renovations</option>
                                            <option value="structural">Structural Work</option>
                                            <option value="finishing">Interior Finishing</option>
                                            <option value="maintenance">Maintenance & Repair</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="amac-form-full">
                                    <div class="amac-field">
                                        <label class="amac-label">Tell Us About Your Project *</label>
                                        <textarea name="message" required rows="5" class="amac-input" placeholder="Describe your project, timeline, and any specific requirements..."></textarea>
                                    </div>
                                </div>

                                <div>
                                    <button type="submit" id="amac-submit-btn-<?php echo esc_attr($widget_id); ?>" class="submit-btn">
                                        <span <?php echo $this->get_render_attribute_string('btn_text'); ?>><?php echo esc_html($settings['btn_text']); ?></span>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                                    </button>
                                </div>
                            </form>

                            <script>
                            (function() {
                                const form = document.getElementById('amac-contact-form-<?php echo esc_attr($widget_id); ?>');
                                const successMsg = document.getElementById('contact-success-msg-<?php echo esc_attr($widget_id); ?>');
                                const btn = document.getElementById('amac-submit-btn-<?php echo esc_attr($widget_id); ?>');
                                if (!form) return;

                                form.addEventListener('submit', function(e) {
                                    e.preventDefault();
                                    const originalBtnText = btn.innerHTML;
                                    btn.innerHTML = 'Sending Quote Request...';
                                    btn.disabled = true;

                                    const formData = new FormData(form);

                                    fetch('<?php echo esc_url($ajax_url); ?>', {
                                        method: 'POST',
                                        body: formData
                                    })
                                    .then(response => response.json())
                                    .then(data => {
                                        if (successMsg) {
                                            successMsg.style.display = 'block';
                                            successMsg.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                                        }
                                        form.reset();
                                        btn.innerHTML = originalBtnText;
                                        btn.disabled = false;
                                    })
                                    .catch(err => {
                                        if (successMsg) {
                                            successMsg.style.display = 'block';
                                        }
                                        form.reset();
                                        btn.innerHTML = originalBtnText;
                                        btn.disabled = false;
                                    });
                                });
                            })();
                            </script>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
