<?php
if (!defined('ABSPATH')) exit;

class AMAC_Hero_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'amac_hero';
    }

    public function get_title() {
        return esc_html__('AMAC Hero Section', 'amac-builders');
    }

    public function get_icon() {
        return 'eicon-banner';
    }

    public function get_categories() {
        return ['amac-elements'];
    }

    public function get_keywords() {
        return ['hero', 'banner', 'amac', 'header'];
    }

    protected function register_controls() {
        // ==================== CONTENT TAB ====================
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Hero Content', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'eyebrow',
            [
                'label' => esc_html__('Eyebrow Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Est. 2001 — Greater Boston',
            ]
        );

        $this->add_control(
            'title_line1',
            [
                'label' => esc_html__('Title Line 1', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Thirty Years',
            ]
        );

        $this->add_control(
            'title_highlight',
            [
                'label' => esc_html__('Title Highlight (Gold)', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Over Greater',
            ]
        );

        $this->add_control(
            'title_line3',
            [
                'label' => esc_html__('Title Line 3', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Boston',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => "Danny O'Connor and AMAC Builders have delivered hundreds of projects with master craftsmanship and unwavering integrity.",
            ]
        );

        $this->add_control(
            'bg_image',
            [
                'label' => esc_html__('Background Image', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

        // ==================== BUTTONS TAB ====================
        $this->start_controls_section(
            'section_buttons',
            [
                'label' => esc_html__('Action Buttons', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'btn1_text',
            [
                'label' => esc_html__('Primary Button Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Initiate Quote',
            ]
        );

        $this->add_control(
            'btn1_link',
            [
                'label' => esc_html__('Primary Button Link', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => ['url' => '#contact'],
            ]
        );

        $this->add_control(
            'btn2_text',
            [
                'label' => esc_html__('Secondary Button Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'View Our Work',
            ]
        );

        $this->add_control(
            'btn2_link',
            [
                'label' => esc_html__('Secondary Button Link', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => ['url' => '#portfolio'],
            ]
        );

        $this->add_control(
            'show_reviews',
            [
                'label' => esc_html__('Show Google Reviews Link', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'amac-builders'),
                'label_off' => esc_html__('Hide', 'amac-builders'),
                'return_value' => 'yes',
                'default' => 'yes',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'reviews_text',
            [
                'label' => esc_html__('Reviews Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => '5.0 Star Rating • Google Reviews',
                'condition' => ['show_reviews' => 'yes'],
            ]
        );

        $this->add_control(
            'reviews_link',
            [
                'label' => esc_html__('Reviews Target Link', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => ['url' => '#testimonials'],
                'condition' => ['show_reviews' => 'yes'],
            ]
        );

        $this->end_controls_section();

        // ==================== BADGE TAB ====================
        $this->start_controls_section(
            'section_badge',
            [
                'label' => esc_html__('Circular Badge', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_badge',
            [
                'label' => esc_html__('Show Rotating Badge', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'amac-builders'),
                'label_off' => esc_html__('Hide', 'amac-builders'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'badge_circle_text',
            [
                'label' => esc_html__('Circular Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '• 30+ Years • Master Builder •',
                'condition' => ['show_badge' => 'yes'],
            ]
        );

        $this->add_control(
            'badge_center_text',
            [
                'label' => esc_html__('Center Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => "EST.\n2001",
                'condition' => ['show_badge' => 'yes'],
            ]
        );

        $this->end_controls_section();

        // ==================== STYLE TAB ====================
        $this->start_controls_section(
            'section_style_typography',
            [
                'label' => esc_html__('Typography & Colors', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'highlight_color',
            [
                'label' => esc_html__('Gold Highlight Color', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#93846f',
                'selectors' => [
                    '{{WRAPPER}} .hero-gold-text' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .hero-gold-border' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .hero-gold-line' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .hero-gold-fill' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'primary_btn_bg',
            [
                'label' => esc_html__('Primary Button BG', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1f2c2c',
                'selectors' => [
                    '{{WRAPPER}} .hero-btn-primary' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'section_padding',
            [
                'label' => esc_html__('Bottom Padding', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'rem', '%'],
                'selectors' => [
                    '{{WRAPPER}} .hero-container' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $bg_url = !empty($settings['bg_image']['url']) ? $settings['bg_image']['url'] : '';

        // Live Inline Editing attributes for Elementor visual canvas
        $this->add_inline_editing_attributes('eyebrow', 'none');
        $this->add_inline_editing_attributes('title_line1', 'none');
        $this->add_inline_editing_attributes('title_highlight', 'none');
        $this->add_inline_editing_attributes('title_line3', 'none');
        $this->add_inline_editing_attributes('description', 'basic');
        $this->add_inline_editing_attributes('btn1_text', 'none');
        $this->add_inline_editing_attributes('btn2_text', 'none');
        $this->add_inline_editing_attributes('reviews_text', 'none');
        ?>
        <style>
            .hero-section {
                width: 100% !important;
                margin-top: 0 !important;
                border-top: none !important;
                box-sizing: border-box !important;
                min-height: 100vh !important;
                display: flex !important;
                align-items: flex-end !important;
            }
            .hero-bg-img {
                width: 100% !important;
                height: 100% !important;
                object-fit: cover !important;
                object-position: center 20% !important;
            }
            .hero-overlay-gradient {
                position: absolute !important;
                inset: 0 !important;
                background: linear-gradient(to top, rgba(26, 26, 26, 0.95) 0%, rgba(26, 26, 26, 0.65) 45%, rgba(26, 26, 26, 0.25) 100%) !important;
            }
            .hero-overlay-tint {
                position: absolute !important;
                inset: 0 !important;
                background-color: rgba(31, 44, 44, 0.2) !important;
            }
            .hero-btn-primary {
                background: linear-gradient(135deg, #93846f 0%, #b3a490 100%) !important;
                color: #1f2c2c !important;
                font-weight: 700 !important;
                border: 1px solid #93846f !important;
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), background 0.3s ease, box-shadow 0.3s ease !important;
                transform-origin: center;
                text-decoration: none !important;
                box-shadow: 0 10px 25px -5px rgba(147, 132, 111, 0.4) !important;
            }
            .hero-btn-primary:hover {
                background: linear-gradient(135deg, #a69782 0%, #c4b5a2 100%) !important;
                color: #111a1a !important;
                transform: scale(1.05) translateY(-2px) !important;
                box-shadow: 0 15px 30px -5px rgba(147, 132, 111, 0.55) !important;
            }
            .hero-btn-primary svg {
                stroke: #1f2c2c !important;
                color: #1f2c2c !important;
            }
            .hero-gold-border {
                border: 1px solid rgba(147, 132, 111, 0.6) !important;
                color: #FDFCF8 !important;
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), background-color 0.3s ease, border-color 0.3s ease, color 0.3s ease, box-shadow 0.3s ease !important;
                transform-origin: center;
                text-decoration: none !important;
            }
            .hero-gold-border:hover {
                background-color: #93846f !important;
                border-color: #93846f !important;
                color: #1f2c2c !important;
                transform: scale(1.05) translateY(-2px) !important;
                box-shadow: 0 10px 25px -5px rgba(147, 132, 111, 0.35) !important;
            }
            .hero-reviews-link {
                text-decoration: none !important;
                transition: all 0.3s ease !important;
            }
            .hero-reviews-link:hover {
                transform: translateY(-2px);
            }
            @media (max-width: 768px) {
                .hero-section {
                    min-height: 100svh !important;
                    align-items: flex-end !important;
                }
                .hero-container {
                    padding-top: 110px !important;
                    padding-bottom: 40px !important;
                    padding-left: 20px !important;
                    padding-right: 20px !important;
                }
                .hero-section h1 {
                    font-size: 2.25rem !important;
                    line-height: 1.15 !important;
                    margin-bottom: 1.25rem !important;
                }
                .hero-section p {
                    font-size: 1rem !important;
                    line-height: 1.6 !important;
                    margin-bottom: 1.5rem !important;
                }
                .hero-btn-group {
                    display: flex !important;
                    flex-direction: column !important;
                    gap: 12px !important;
                    width: 100% !important;
                }
                .hero-btn-group a {
                    width: 100% !important;
                    justify-content: center !important;
                    padding: 14px 20px !important;
                }
            }
        </style>
        <section class="hero-section relative min-h-screen flex items-end overflow-hidden">
            <div class="absolute inset-0">
                <?php if ($bg_url): ?>
                    <img src="<?php echo esc_url($bg_url); ?>" alt="<?php echo esc_attr($settings['title_line1']); ?>" class="hero-bg-img">
                <?php endif; ?>
                <div class="hero-overlay-gradient"></div>
                <div class="hero-overlay-tint"></div>
            </div>
            <div class="hero-container relative z-10 max-w-7xl mx-auto px-6 md:px-8 pb-20 md:pb-28 pt-40 w-full">
                <div class="max-w-3xl">
                    <?php if (!empty($settings['eyebrow'])): ?>
                    <div class="flex items-center gap-4 mb-6 md:mb-8">
                        <div class="hero-gold-line h-[1px] w-10 md:w-12 bg-[#93846f]"></div>
                        <span class="hero-gold-text text-[#93846f] text-[11px] md:text-xs tracking-[0.35em] md:tracking-[0.4em] uppercase" <?php echo $this->get_render_attribute_string('eyebrow'); ?>>
                            <?php echo esc_html($settings['eyebrow']); ?>
                        </span>
                        <div class="hero-gold-line h-[1px] w-10 md:w-12 bg-[#93846f]"></div>
                    </div>
                    <?php endif; ?>

                    <h1 class="font-display text-3xl sm:text-5xl md:text-6xl lg:text-7xl text-[#FDFCF8] font-semibold leading-[1.1] mb-6 md:mb-8">
                        <span <?php echo $this->get_render_attribute_string('title_line1'); ?>><?php echo esc_html($settings['title_line1']); ?></span><br>
                        <span class="hero-gold-text text-[#93846f]" <?php echo $this->get_render_attribute_string('title_highlight'); ?>><?php echo esc_html($settings['title_highlight']); ?></span><br>
                        <span <?php echo $this->get_render_attribute_string('title_line3'); ?>><?php echo esc_html($settings['title_line3']); ?></span>
                    </h1>

                    <?php if (!empty($settings['description'])): ?>
                    <p class="text-[#FDFCF8]/70 text-base md:text-xl leading-relaxed max-w-lg mb-8 md:mb-10" <?php echo $this->get_render_attribute_string('description'); ?>>
                        <?php echo esc_html($settings['description']); ?>
                    </p>
                    <?php endif; ?>

                    <div class="hero-btn-group flex flex-col sm:flex-row gap-4">
                        <?php if (!empty($settings['btn1_text'])): ?>
                        <a class="hero-btn-primary inline-flex items-center justify-center gap-3 px-8 py-4 bg-[#1f2c2c] text-[#FDFCF8] text-sm tracking-[0.2em] uppercase transition-all duration-300 group" href="<?php echo esc_url($settings['btn1_link']['url']); ?>" <?php echo $settings['btn1_link']['is_external'] ? 'target="_blank"' : ''; ?>>
                            <span <?php echo $this->get_render_attribute_string('btn1_text'); ?>><?php echo esc_html($settings['btn1_text']); ?></span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                        </a>
                        <?php endif; ?>

                        <?php if (!empty($settings['btn2_text'])): ?>
                        <a class="hero-gold-border inline-flex items-center justify-center gap-3 px-8 py-4 border border-[#93846f]/40 text-[#FDFCF8] text-sm tracking-[0.2em] uppercase transition-all duration-300" href="<?php echo esc_url($settings['btn2_link']['url']); ?>" <?php echo $settings['btn2_link']['is_external'] ? 'target="_blank"' : ''; ?>>
                            <span <?php echo $this->get_render_attribute_string('btn2_text'); ?>><?php echo esc_html($settings['btn2_text']); ?></span>
                        </a>
                        <?php endif; ?>
                    </div>

                    <?php if (!empty($settings['show_reviews']) && $settings['show_reviews'] === 'yes' && !empty($settings['reviews_text'])): ?>
                    <div class="mt-8 flex items-center">
                        <a href="<?php echo esc_url(!empty($settings['reviews_link']['url']) ? $settings['reviews_link']['url'] : '#testimonials'); ?>" class="hero-reviews-link inline-flex items-center gap-3 group" style="text-decoration: none !important;">
                            <div class="flex items-center gap-0.5 text-[#93846f] text-sm leading-none">
                                <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                            </div>
                            <span class="text-[#FDFCF8] group-hover:text-[#93846f] text-xs tracking-[0.2em] uppercase font-semibold transition-colors duration-300" <?php echo $this->get_render_attribute_string('reviews_text'); ?>>
                                <?php echo esc_html($settings['reviews_text']); ?>
                            </span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#93846f" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="group-hover:translate-x-1.5 transition-transform duration-300"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                        </a>
                    </div>
                    <?php endif; ?>
                </div>

                <?php if ($settings['show_badge'] === 'yes' && !empty($settings['badge_circle_text'])): ?>
                <div class="hidden md:flex absolute bottom-28 right-8 lg:right-16 w-28 h-28 rounded-full hero-gold-border border-2 border-[#93846f]/60 items-center justify-center">
                    <div class="absolute inset-0 rounded-full animate-spin" style="animation-duration: 20s;">
                        <svg viewBox="0 0 100 100" class="w-full h-full">
                            <defs><path id="hero-badge-circle-<?php echo esc_attr($this->get_id()); ?>" d="M 50,50 m -37,0 a 37,37 0 1,1 74,0 a 37,37 0 1,1 -74,0"></path></defs>
                            <text class="hero-gold-fill fill-[#93846f] text-[10px] tracking-[0.3em] uppercase"><textPath href="#hero-badge-circle-<?php echo esc_attr($this->get_id()); ?>"><?php echo esc_html($settings['badge_circle_text']); ?></textPath></text>
                        </svg>
                    </div>
                    <span class="hero-gold-text font-display text-[#93846f] text-xs tracking-wider text-center leading-tight">
                        <?php echo nl2br(esc_html($settings['badge_center_text'])); ?>
                    </span>
                </div>
                <?php endif; ?>
            </div>
        </section>
        <?php
    }
}
