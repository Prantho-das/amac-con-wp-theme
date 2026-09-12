<?php
if (!defined('ABSPATH')) exit;

class AMAC_Header_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'amac_header';
    }

    public function get_title() {
        return esc_html__('AMAC Header Navigation', 'amac-builders');
    }

    public function get_icon() {
        return 'eicon-header';
    }

    public function get_categories() {
        return ['amac-elements'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_logo',
            [
                'label' => esc_html__('Logo & Brand', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'logo_type',
            [
                'label' => esc_html__('Logo Type', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'text',
                'options' => [
                    'text' => esc_html__('Text & Typography', 'amac-builders'),
                    'image' => esc_html__('Upload Image Logo', 'amac-builders'),
                ],
            ]
        );

        $this->add_control(
            'logo_image',
            [
                'label' => esc_html__('Upload Logo Image', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'condition' => [
                    'logo_type' => 'image',
                ],
            ]
        );

        $this->add_responsive_control(
            'logo_image_width',
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
                    '{{WRAPPER}} .amac-header-logo-img' => 'width: {{SIZE}}{{UNIT}}; object-fit: contain;',
                ],
                'condition' => [
                    'logo_type' => 'image',
                ],
            ]
        );

        $this->add_responsive_control(
            'logo_image_height',
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
                    '{{WRAPPER}} .amac-header-logo-img' => 'max-height: {{SIZE}}{{UNIT}}; height: auto; object-fit: contain;',
                ],
                'condition' => [
                    'logo_type' => 'image',
                ],
            ]
        );

        $this->add_control(
            'logo_text',
            [
                'label' => esc_html__('Logo Main Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'AMAC',
                'condition' => [
                    'logo_type' => 'text',
                ],
            ]
        );

        $this->add_control(
            'logo_subtext',
            [
                'label' => esc_html__('Logo Sub-Text (Gold)', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Builders',
                'condition' => [
                    'logo_type' => 'text',
                ],
            ]
        );

        $this->add_control(
            'logo_link',
            [
                'label' => esc_html__('Logo Link', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => ['url' => home_url('/')],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_menu',
            [
                'label' => esc_html__('Navigation Menu', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'label',
            [
                'label' => esc_html__('Menu Item Label', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Home',
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Menu Item Link', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => ['url' => '#'],
            ]
        );

        $this->add_control(
            'menu_items',
            [
                'label' => esc_html__('Menu Items', 'amac-builders'),
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

        $this->start_controls_section(
            'section_action',
            [
                'label' => esc_html__('Action Button & Phone', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__('Button Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Get Quote',
            ]
        );

        $this->add_control(
            'btn_link',
            [
                'label' => esc_html__('Button Link', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => ['url' => home_url('/contact')],
            ]
        );

        $this->add_control(
            'phone_number',
            [
                'label' => esc_html__('Mobile Drawer Phone', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => '617.388.5901',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_inline_editing_attributes('logo_text', 'none');
        $this->add_inline_editing_attributes('logo_subtext', 'none');
        $this->add_inline_editing_attributes('btn_text', 'none');
        ?>
        <style>
            #amac-site-header {
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                right: 0 !important;
                width: 100% !important;
                z-index: 999999 !important;
                background-color: transparent;
                transition: all 0.5s ease;
                box-sizing: border-box !important;
            }
            #amac-site-header.is-scrolled {
                background-color: rgba(253, 252, 248, 0.95) !important;
                backdrop-filter: blur(12px) !important;
                -webkit-backdrop-filter: blur(12px) !important;
                box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05) !important;
            }
            #amac-site-header a.desktop-nav-link {
                color: rgba(255, 255, 255, 0.9) !important;
                text-decoration: none !important;
                font-family: "Inter", sans-serif !important;
                font-size: 0.875rem !important;
                line-height: 1.25rem !important;
                letter-spacing: 0.15em !important;
                text-transform: uppercase !important;
                transition: color 0.3s ease !important;
            }
            #amac-site-header.is-scrolled a.desktop-nav-link {
                color: #1A1A1A !important;
            }
            #amac-site-header a.desktop-nav-link:hover {
                color: #93846f !important;
            }
            #amac-site-header #header-logo-text {
                font-family: "Fraunces", Georgia, serif !important;
                font-size: 1.25rem !important;
                font-weight: 600 !important;
                letter-spacing: 0.05em !important;
                color: #FFFFFF !important;
                transition: color 0.5s ease !important;
            }
            #amac-site-header.is-scrolled #header-logo-text {
                color: #1f2c2c !important;
            }
            .header-quote-btn {
                margin-left: 1rem !important;
                padding: 0.625rem 1.5rem !important;
                background: linear-gradient(135deg, #93846f 0%, #b3a490 100%) !important;
                color: #1f2c2c !important;
                font-weight: 700 !important;
                border: 1px solid #93846f !important;
                font-size: 0.875rem !important;
                letter-spacing: 0.15em !important;
                text-transform: uppercase !important;
                text-decoration: none !important;
                transition: all 0.3s ease !important;
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                box-shadow: 0 4px 15px rgba(147, 132, 111, 0.3) !important;
            }
            .header-quote-btn:hover {
                background: linear-gradient(135deg, #a69782 0%, #c4b5a2 100%) !important;
                color: #111a1a !important;
                transform: translateY(-2px) !important;
                box-shadow: 0 6px 20px rgba(147, 132, 111, 0.45) !important;
            }
            #amac-site-header.is-scrolled .header-quote-btn {
                background: #1f2c2c !important;
                color: #FDFCF8 !important;
                border-color: #1f2c2c !important;
            }
            #amac-site-header.is-scrolled .header-quote-btn:hover {
                background: #93846f !important;
                color: #1f2c2c !important;
                border-color: #93846f !important;
            }
            #amac-menu-toggle {
                display: none !important;
            }
            .amac-hamburger-label {
                display: none !important;
                background: transparent !important;
                border: none !important;
                cursor: pointer !important;
                padding: 10px !important;
                z-index: 1000 !important;
                -webkit-tap-highlight-color: transparent !important;
            }
            .amac-hamburger-label span {
                display: block !important;
                background-color: #93846f !important;
                height: 2px !important;
                margin: 5px 0 !important;
                transition: all 0.3s ease !important;
            }
            @media (max-width: 1023px) {
                .amac-hamburger-label {
                    display: flex !important;
                    flex-direction: column !important;
                    align-items: flex-end !important;
                    justify-content: center !important;
                }
                #amac-site-header .desktop-nav {
                    display: none !important;
                }
            }
            #mobile-menu-drawer {
                display: none;
                position: fixed !important;
                top: 0 !important;
                left: 0 !important;
                right: 0 !important;
                bottom: 0 !important;
                width: 100vw !important;
                height: 100vh !important;
                height: 100dvh !important;
                background-color: #1f2c2c !important;
                z-index: 2147483647 !important;
                flex-direction: column !important;
                justify-content: space-between !important;
                padding: 0 !important;
                margin: 0 !important;
                box-sizing: border-box !important;
                overflow-y: auto !important;
            }
            #amac-menu-toggle:checked ~ #mobile-menu-drawer,
            #mobile-menu-drawer.is-open {
                display: flex !important;
            }
        </style>
        <?php
        $logo_img_url = !empty($settings['logo_image']['url']) ? $settings['logo_image']['url'] : '';
        ?>
        <input type="checkbox" id="amac-menu-toggle">

        <header id="amac-site-header" class="fixed top-0 left-0 right-0 z-50 transition-all duration-500 bg-transparent">
            <div class="max-w-7xl mx-auto px-6 md:px-8 flex items-center justify-between h-20">
                <a class="flex items-center gap-3" href="<?php echo esc_url($settings['logo_link']['url']); ?>" style="text-decoration: none;">
                    <?php if ($settings['logo_type'] === 'image' && !empty($logo_img_url)): ?>
                        <img src="<?php echo esc_url($logo_img_url); ?>" alt="<?php echo esc_attr($settings['logo_text'] ?? 'AMAC Builders'); ?>" class="amac-header-logo-img">
                    <?php else: ?>
                        <span id="header-logo-text" class="font-display text-xl tracking-wider font-semibold transition-colors duration-500 text-white" <?php echo $this->get_render_attribute_string('logo_text'); ?>>
                            <?php echo esc_html($settings['logo_text']); ?>
                        </span>
                        <span class="hidden sm:block text-xs tracking-[0.3em] uppercase transition-colors duration-500 text-[#93846f]" <?php echo $this->get_render_attribute_string('logo_subtext'); ?>>
                            <?php echo esc_html($settings['logo_subtext']); ?>
                        </span>
                    <?php endif; ?>
                </a>

                <nav class="desktop-nav hidden lg:flex items-center gap-10">
                    <?php 
                    $current_url = home_url(add_query_arg([], $GLOBALS['wp']->request ?? ''));
                    if (!empty($settings['menu_items'])):
                        foreach ($settings['menu_items'] as $item): 
                            $is_current = (trim($item['link']['url'], '/') === trim($current_url, '/'));
                    ?>
                        <a class="desktop-nav-link text-sm tracking-[0.15em] uppercase transition-colors duration-300 hover:text-[#93846f] text-white/90" href="<?php echo esc_url($item['link']['url']); ?>" <?php echo $item['link']['is_external'] ? 'target="_blank"' : ''; ?>>
                            <?php echo esc_html($item['label']); ?>
                        </a>
                    <?php 
                        endforeach; 
                    endif;
                    ?>
                    <?php if (!empty($settings['btn_text'])): ?>
                    <a class="header-quote-btn ml-4 px-6 py-2.5 bg-[#1f2c2c] text-[#FDFCF8] text-sm tracking-[0.15em] uppercase hover:bg-[#2a3d3d] transition-colors duration-300" href="<?php echo esc_url($settings['btn_link']['url']); ?>" <?php echo $settings['btn_link']['is_external'] ? 'target="_blank"' : ''; ?> style="text-decoration: none;">
                        <span <?php echo $this->get_render_attribute_string('btn_text'); ?>><?php echo esc_html($settings['btn_text']); ?></span>
                    </a>
                    <?php endif; ?>
                </nav>

                <label for="amac-menu-toggle" class="amac-hamburger-label" aria-label="Open menu" onclick="var d=document.getElementById('mobile-menu-drawer'); if(d){ d.classList.add('is-open'); }">
                    <span style="width: 28px;"></span>
                    <span style="width: 20px;"></span>
                    <span style="width: 24px;"></span>
                </label>
            </div>
        </header>

        <!-- Mobile Drawer -->
        <div id="mobile-menu-drawer">
            <div style="display: flex !important; justify-content: space-between !important; align-items: center !important; height: 80px !important; padding: 0 24px !important; width: 100% !important; box-sizing: border-box !important; flex-shrink: 0 !important;">
                <?php if ($settings['logo_type'] === 'image' && !empty($logo_img_url)): ?>
                    <img src="<?php echo esc_url($logo_img_url); ?>" alt="Logo" style="max-height: 40px !important; width: auto !important;">
                <?php else: ?>
                    <span style="font-family: 'Fraunces', Georgia, serif !important; font-size: 1.25rem !important; color: #FDFCF8 !important; font-weight: 600 !important; letter-spacing: 0.05em !important;"><?php echo esc_html($settings['logo_text']); ?></span>
                <?php endif; ?>
                <label for="amac-menu-toggle" id="close-mobile-menu" aria-label="Close menu" onclick="var d=document.getElementById('mobile-menu-drawer'); if(d){ d.classList.remove('is-open'); }" style="background: transparent !important; border: none !important; cursor: pointer !important; padding: 8px !important; color: #93846f !important; outline: none !important; display: inline-flex !important; align-items: center !important; justify-content: center !important;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="#93846f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg>
                </label>
            </div>
            <nav style="display: flex !important; flex-direction: column !important; align-items: center !important; justify-content: center !important; gap: 28px !important; padding: 32px 0 !important; flex: 1 !important;">
                <?php 
                if (!empty($settings['menu_items'])):
                    foreach ($settings['menu_items'] as $item): 
                ?>
                    <a href="<?php echo esc_url($item['link']['url']); ?>" onclick="document.getElementById('amac-menu-toggle').checked=false; var d=document.getElementById('mobile-menu-drawer'); if(d){ d.classList.remove('is-open'); }" style="text-decoration: none !important; color: #FDFCF8 !important; font-family: 'Fraunces', Georgia, serif !important; font-size: 1.75rem !important; letter-spacing: 0.05em !important;">
                        <?php echo esc_html($item['label']); ?>
                    </a>
                <?php 
                    endforeach; 
                endif;
                ?>
                <?php if (!empty($settings['btn_text'])): ?>
                    <a href="<?php echo esc_url($settings['btn_link']['url']); ?>" onclick="document.getElementById('amac-menu-toggle').checked=false; var d=document.getElementById('mobile-menu-drawer'); if(d){ d.classList.remove('is-open'); }" class="header-quote-btn" style="text-decoration: none !important; background-color: #1f2c2c !important; color: #FFFFFF !important; padding: 14px 36px !important; font-size: 12px !important; letter-spacing: 0.2em !important; font-weight: 600 !important; text-transform: uppercase !important; margin-top: 12px !important; display: inline-block !important; border: 1px solid #93846f !important;">
                        <?php echo esc_html($settings['btn_text']); ?>
                    </a>
                <?php endif; ?>
            </nav>
            <?php if (!empty($settings['phone_number'])): ?>
            <div style="padding: 0 24px 40px !important; text-align: center !important; width: 100% !important; box-sizing: border-box !important; flex-shrink: 0 !important;">
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', $settings['phone_number'])); ?>" style="text-decoration: none !important; color: #93846f !important; font-size: 14px !important; letter-spacing: 0.2em !important;">
                    <?php echo esc_html($settings['phone_number']); ?>
                </a>
            </div>
            <?php endif; ?>
        </div>

        <script>
        (function() {
            const header = document.getElementById('amac-site-header');
            function updateHeaderScroll() {
                if (!header) return;
                if (window.scrollY > 40) {
                    header.classList.add('is-scrolled');
                } else {
                    header.classList.remove('is-scrolled');
                }
            }

            window.addEventListener('scroll', updateHeaderScroll, { passive: true });
            updateHeaderScroll();
        })();
        </script>
        <?php
    }
}
