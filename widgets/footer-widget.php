<?php
if (!defined('ABSPATH')) exit;

class AMAC_Footer_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'amac_footer';
    }

    public function get_title() {
        return esc_html__('AMAC Footer & Sticky Quick Bar', 'amac-builders');
    }

    public function get_icon() {
        return 'eicon-footer';
    }

    public function get_categories() {
        return ['amac-elements'];
    }

    protected function register_controls() {
        // Col 1: Brand
        $this->start_controls_section(
            'section_brand',
            [
                'label' => esc_html__('Brand Information', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'brand_logo_type',
            [
                'label' => esc_html__('Logo Type', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'text',
                'options' => [
                    'text' => esc_html__('Text & Tagline', 'amac-builders'),
                    'image' => esc_html__('Upload Image Logo', 'amac-builders'),
                ],
            ]
        );

        $this->add_control(
            'brand_logo_image',
            [
                'label' => esc_html__('Upload Logo Image', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'condition' => [
                    'brand_logo_type' => 'image',
                ],
            ]
        );

        $this->add_responsive_control(
            'brand_logo_width',
            [
                'label' => esc_html__('Logo Width', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'vw'],
                'range' => [
                    'px' => [
                        'min' => 40,
                        'max' => 400,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .amac-footer-logo-img' => 'width: {{SIZE}}{{UNIT}}; object-fit: contain;',
                ],
                'condition' => [
                    'brand_logo_type' => 'image',
                ],
            ]
        );

        $this->add_responsive_control(
            'brand_logo_height',
            [
                'label' => esc_html__('Logo Height', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 150,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 45,
                ],
                'selectors' => [
                    '{{WRAPPER}} .amac-footer-logo-img' => 'max-height: {{SIZE}}{{UNIT}}; height: auto; object-fit: contain; margin-bottom: 20px;',
                ],
                'condition' => [
                    'brand_logo_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'brand_name',
            [
                'label' => esc_html__('Brand Title', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'AMAC',
                'condition' => [
                    'brand_logo_type' => 'text',
                ],
            ]
        );

        $this->add_control(
            'brand_tagline',
            [
                'label' => esc_html__('Brand Tagline (Gold)', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Builders, LLC',
                'condition' => [
                    'brand_logo_type' => 'text',
                ],
            ]
        );

        $this->add_control(
            'brand_desc',
            [
                'label' => esc_html__('Description', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => 'Thirty years of master craftsmanship across the Greater Boston area. Building with integrity, delivering excellence.',
            ]
        );

        $this->end_controls_section();

        // Col 2: Navigation Links
        $this->start_controls_section(
            'section_nav',
            [
                'label' => esc_html__('Navigation Links', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'label',
            [
                'label' => esc_html__('Link Label', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Home',
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('URL', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => ['url' => '#'],
            ]
        );

        $this->add_control(
            'footer_menu',
            [
                'label' => esc_html__('Footer Links', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['label' => 'Home', 'link' => ['url' => home_url('/')]],
                    ['label' => 'Portfolio', 'link' => ['url' => home_url('/portfolio')]],
                    ['label' => 'Services', 'link' => ['url' => home_url('/services')]],
                    ['label' => 'About', 'link' => ['url' => home_url('/about')]],
                    ['label' => 'Contact', 'link' => ['url' => home_url('/contact')]],
                ],
                'title_field' => '{{{ label }}}',
            ]
        );

        $this->end_controls_section();

        // Col 3: Contact & Copyright
        $this->start_controls_section(
            'section_contact',
            [
                'label' => esc_html__('Contact & Copyright', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
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
                'label' => esc_html__('Email', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'docamac8@gmail.com',
            ]
        );

        $this->add_control(
            'location',
            [
                'label' => esc_html__('Location', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Greater Boston Area',
            ]
        );

        $this->add_control(
            'copyright_left',
            [
                'label' => esc_html__('Copyright Left', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => '© 2026 AMAC Builders, LLC. All rights reserved.',
            ]
        );

        $this->add_control(
            'copyright_right',
            [
                'label' => esc_html__('Copyright Right', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Serving the Greater Boston Area Since 1994',
            ]
        );

        $this->end_controls_section();

        // Section: Sticky Quick Contact Bar
        $this->start_controls_section(
            'section_quick_bar',
            [
                'label' => esc_html__('Sticky Floating Quick Bar', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'enable_quick_bar',
            [
                'label' => esc_html__('Enable Sticky Quick Bar', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'amac-builders'),
                'label_off' => esc_html__('No', 'amac-builders'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'quick_phone',
            [
                'label' => esc_html__('Quick Bar Phone', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => '617.388.5901',
                'condition' => ['enable_quick_bar' => 'yes'],
            ]
        );

        $this->add_control(
            'quick_email',
            [
                'label' => esc_html__('Quick Bar Email', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'docamac8@gmail.com',
                'condition' => ['enable_quick_bar' => 'yes'],
            ]
        );

        $this->end_controls_section();

        // Style Tab
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Footer Styling', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label' => esc_html__('Background Color', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1A1A1A',
                'selectors' => [
                    '{{WRAPPER}} .amac-footer-wrapper' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->add_control(
            'gold_color',
            [
                'label' => esc_html__('Gold Headings Color', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#93846f',
                'selectors' => [
                    '{{WRAPPER}} .amac-footer-gold' => 'color: {{VALUE}} !important;',
                    '{{WRAPPER}} .amac-footer-icon' => 'color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $clean_phone = preg_replace('/[^0-9]/', '', $settings['phone']);
        $clean_quick_phone = preg_replace('/[^0-9]/', '', $settings['quick_phone']);

        $this->add_inline_editing_attributes('brand_name', 'none');
        $this->add_inline_editing_attributes('brand_tagline', 'none');
        $this->add_inline_editing_attributes('brand_desc', 'basic');
        $this->add_inline_editing_attributes('copyright_left', 'none');
        $this->add_inline_editing_attributes('copyright_right', 'none');
        ?>
        <style>
            .amac-footer-wrapper {
                width: 100% !important;
                box-sizing: border-box !important;
            }
            .amac-footer-wrapper a {
                color: rgba(253, 252, 248, 0.8) !important;
                text-decoration: none !important;
                transition: color 0.3s ease;
            }
            .amac-footer-wrapper a:hover {
                color: #93846f !important;
            }
            .amac-footer-wrapper svg {
                color: #93846f !important;
                flex-shrink: 0;
            }
            #amac-floating-quick-bar {
                position: fixed;
                bottom: 24px;
                right: 24px;
                z-index: 999;
                display: flex;
                align-items: center;
                gap: 12px;
                background-color: #1f2c2c;
                color: #FDFCF8;
                padding: 12px 20px;
                border-radius: 2px;
                box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
                transition: transform 0.4s cubic-bezier(0.16, 1, 0.3, 1), opacity 0.4s ease;
                transform: translateY(120px);
                opacity: 0;
                pointer-events: none;
            }
            #amac-floating-quick-bar.is-visible {
                transform: translateY(0);
                opacity: 1;
                pointer-events: auto;
            }
            #amac-floating-quick-bar a {
                display: flex;
                align-items: center;
                gap: 8px;
                color: #FDFCF8 !important;
                text-decoration: none !important;
                font-size: 14px;
                letter-spacing: 0.025em;
                transition: color 0.3s ease;
            }
            #amac-floating-quick-bar a:hover {
                color: #93846f !important;
            }
            #amac-floating-quick-bar svg {
                color: #93846f !important;
            }
            #amac-floating-quick-bar .divider {
                color: rgba(147, 132, 111, 0.4);
            }
            #amac-dismiss-quick-bar {
                background: transparent;
                border: none;
                cursor: pointer;
                padding: 0;
                margin-left: 8px;
                color: rgba(253, 252, 248, 0.4);
                transition: color 0.3s ease;
                display: flex;
                align-items: center;
            }
            #amac-dismiss-quick-bar:hover {
                color: #FDFCF8;
            }
        </style>

        <footer class="amac-footer-wrapper bg-[#1A1A1A] text-[#FDFCF8]/80 w-full">
            <div class="max-w-7xl mx-auto px-6 md:px-8 py-16 md:py-20">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12 md:gap-16">
                    <!-- Brand Column -->
                    <div>
                        <?php 
                        $footer_logo_img = !empty($settings['brand_logo_image']['url']) ? $settings['brand_logo_image']['url'] : '';
                        if ($settings['brand_logo_type'] === 'image' && !empty($footer_logo_img)): 
                        ?>
                            <img src="<?php echo esc_url($footer_logo_img); ?>" alt="<?php echo esc_attr($settings['brand_name'] ?? 'AMAC Builders'); ?>" class="amac-footer-logo-img">
                        <?php else: ?>
                            <h3 class="font-display text-2xl text-[#FDFCF8] tracking-wider mb-2" <?php echo $this->get_render_attribute_string('brand_name'); ?>>
                                <?php echo esc_html($settings['brand_name']); ?>
                            </h3>
                            <p class="amac-footer-gold text-[#93846f] text-xs tracking-[0.3em] uppercase mb-6" <?php echo $this->get_render_attribute_string('brand_tagline'); ?>>
                                <?php echo esc_html($settings['brand_tagline']); ?>
                            </p>
                        <?php endif; ?>
                        <p class="text-sm leading-relaxed text-[#FDFCF8]/60 max-w-xs" <?php echo $this->get_render_attribute_string('brand_desc'); ?>>
                            <?php echo esc_html($settings['brand_desc']); ?>
                        </p>
                    </div>

                    <!-- Navigation Column -->
                    <div>
                        <h4 class="amac-footer-gold text-[#93846f] text-xs tracking-[0.3em] uppercase mb-6">Navigation</h4>
                        <div class="flex flex-col gap-3">
                            <?php 
                            if (!empty($settings['footer_menu'])):
                                foreach ($settings['footer_menu'] as $index => $item): 
                                    $link_key = $this->get_repeater_setting_key('label', 'footer_menu', $index);
                                    $this->add_inline_editing_attributes($link_key, 'none');
                            ?>
                                <a class="amac-footer-link text-sm transition-colors" href="<?php echo esc_url($item['link']['url']); ?>" <?php echo $item['link']['is_external'] ? 'target="_blank"' : ''; ?>>
                                    <span <?php echo $this->get_render_attribute_string($link_key); ?>><?php echo esc_html($item['label']); ?></span>
                                </a>
                            <?php 
                                endforeach; 
                            endif;
                            ?>
                        </div>
                    </div>

                    <!-- Contact Details Column -->
                    <div>
                        <h4 class="amac-footer-gold text-[#93846f] text-xs tracking-[0.3em] uppercase mb-6">Contact</h4>
                        <div class="flex flex-col gap-4">
                            <?php if (!empty($settings['phone'])): ?>
                            <a href="tel:<?php echo esc_attr($clean_phone); ?>" class="amac-footer-link flex items-center gap-3 text-sm transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-[#93846f]"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                                <span><?php echo esc_html($settings['phone']); ?></span>
                            </a>
                            <?php endif; ?>

                            <?php if (!empty($settings['email'])): ?>
                            <a href="mailto:<?php echo esc_attr($settings['email']); ?>" class="amac-footer-link flex items-center gap-3 text-sm transition-colors">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-[#93846f]"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>
                                <span><?php echo esc_html($settings['email']); ?></span>
                            </a>
                            <?php endif; ?>

                            <?php if (!empty($settings['location'])): ?>
                            <div class="flex items-center gap-3 text-sm text-[#FDFCF8]/80">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-[#93846f]"><path d="M20 10c0 4.993-5.539 10.193-7.399 11.799a1 1 0 0 1-1.202 0C9.539 20.193 4 14.993 4 10a8 8 0 0 1 16 0"></path><circle cx="12" cy="10" r="3"></circle></svg>
                                <span><?php echo esc_html($settings['location']); ?></span>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>

                <!-- Copyright Bar -->
                <div class="border-t border-[#FDFCF8]/10 mt-16 pt-8 flex flex-col sm:flex-row justify-between items-center gap-4">
                    <p class="text-xs text-[#FDFCF8]/40" <?php echo $this->get_render_attribute_string('copyright_left'); ?>><?php echo esc_html($settings['copyright_left']); ?></p>
                    <p class="text-xs text-[#FDFCF8]/40" <?php echo $this->get_render_attribute_string('copyright_right'); ?>><?php echo esc_html($settings['copyright_right']); ?></p>
                </div>
            </div>
        </footer>

        <?php if ($settings['enable_quick_bar'] === 'yes'): ?>
        <!-- Floating Quick Action Bar -->
        <div id="amac-floating-quick-bar">
            <?php if (!empty($settings['quick_phone'])): ?>
            <a href="tel:<?php echo esc_attr($clean_quick_phone); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                <span class="hidden sm:inline"><?php echo esc_html($settings['quick_phone']); ?></span>
            </a>
            <?php endif; ?>

            <span class="divider">|</span>

            <?php if (!empty($settings['quick_email'])): ?>
            <a href="mailto:<?php echo esc_attr($settings['quick_email']); ?>">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect width="20" height="16" x="2" y="4" rx="2"></rect><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"></path></svg>
                <span class="hidden sm:inline">Email</span>
            </a>
            <?php endif; ?>

            <button id="amac-dismiss-quick-bar" aria-label="Dismiss">
                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
            </button>
        </div>

        <script>
        (function() {
            const quickBar = document.getElementById('amac-floating-quick-bar');
            const dismissBtn = document.getElementById('amac-dismiss-quick-bar');
            let isDismissed = false;

            function updateQuickBar() {
                if (!quickBar || isDismissed) return;
                if (window.scrollY > 250) {
                    quickBar.classList.add('is-visible');
                } else {
                    quickBar.classList.remove('is-visible');
                }
            }

            window.addEventListener('scroll', updateQuickBar, { passive: true });
            updateQuickBar();

            if (dismissBtn) {
                dismissBtn.addEventListener('click', function() {
                    isDismissed = true;
                    if (quickBar) quickBar.classList.remove('is-visible');
                });
            }
        })();
        </script>
        <?php endif; ?>
        <?php
    }
}
