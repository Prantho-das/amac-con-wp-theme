<?php
if (!defined('ABSPATH')) exit;

class AMAC_Testimonials_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'amac_testimonials';
    }

    public function get_title() {
        return esc_html__('AMAC Testimonials Slider', 'amac-builders');
    }

    public function get_icon() {
        return 'eicon-testimonial-carousel';
    }

    public function get_categories() {
        return ['amac-elements'];
    }

    public function get_script_depends() {
        return ['swiper', 'amac-testimonials-slider'];
    }

    public function get_style_depends() {
        return ['swiper', 'e-swiper'];
    }

    protected function register_controls() {
        // Section Header
        $this->start_controls_section(
            'section_header',
            [
                'label' => esc_html__('Section Header', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'eyebrow',
            [
                'label' => esc_html__('Eyebrow Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'TESTIMONIALS',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Words from Our Clients',
            ]
        );

        $this->add_control(
            'show_header_divider',
            [
                'label' => esc_html__('Show Divider Line', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'amac-builders'),
                'label_off' => esc_html__('Hide', 'amac-builders'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        // Testimonial Cards Repeater
        $this->start_controls_section(
            'section_items',
            [
                'label' => esc_html__('Testimonial Cards', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'quote',
            [
                'label' => esc_html__('Quote Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => '"Danny and his team transformed our century-old Brookline home into something extraordinary."',
            ]
        );

        $repeater->add_control(
            'client_name',
            [
                'label' => esc_html__('Client Name', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Michael & Sarah T.',
            ]
        );

        $repeater->add_control(
            'location',
            [
                'label' => esc_html__('Location / Details', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Brookline, MA',
            ]
        );

        $this->add_control(
            'testimonials_list',
            [
                'label' => esc_html__('Testimonials', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'quote' => '"Danny and his team transformed our century-old Brookline home into something extraordinary. The attention to detail and respect for the original architecture was remarkable."',
                        'client_name' => 'Michael & Sarah T.',
                        'location' => 'Brookline, MA',
                    ],
                    [
                        'quote' => '"After interviewing a dozen builders, we chose AMAC. Best decision we ever made. Danny\'s experience showed in every phase—from foundation to final finish."',
                        'client_name' => 'Bob and Carolyn Howard',
                        'location' => 'Westwood, MA',
                    ],
                    [
                        'quote' => '"Three generations of our family have trusted Danny O\'Connor with our homes. That kind of loyalty is earned through decades of honest, exceptional work."',
                        'client_name' => 'Roula Bakis',
                        'location' => 'Wellesley, MA',
                    ],
                    [
                        'quote' => '"AMAC Builders delivered on every single promise. On schedule, on budget, and the craftsmanship surpassed our highest expectations."',
                        'client_name' => 'David & Elena K.',
                        'location' => 'Newton, MA',
                    ],
                    [
                        'quote' => '"The historic preservation work done on our estate was nothing short of masterful. We cannot recommend AMAC Builders highly enough."',
                        'client_name' => 'Jonathan Vance',
                        'location' => 'Cambridge, MA',
                    ],
                ],
                'title_field' => '{{{ client_name }}} ({{{ location }}})',
            ]
        );

        $this->end_controls_section();

        // Slider Settings
        $this->start_controls_section(
            'section_slider_settings',
            [
                'label' => esc_html__('Slider Settings', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'slides_per_view',
            [
                'label' => esc_html__('Per Page View (Desktop)', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 6,
                'step' => 1,
                'default' => 3,
            ]
        );

        $this->add_control(
            'slides_per_view_tablet',
            [
                'label' => esc_html__('Per Page View (Tablet)', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 4,
                'step' => 1,
                'default' => 2,
            ]
        );

        $this->add_control(
            'slides_per_view_mobile',
            [
                'label' => esc_html__('Per Page View (Mobile)', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'max' => 2,
                'step' => 1,
                'default' => 1,
            ]
        );

        $this->add_control(
            'space_between',
            [
                'label' => esc_html__('Space Between (px)', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'max' => 80,
                'step' => 2,
                'default' => 32,
            ]
        );

        $this->add_control(
            'speed',
            [
                'label' => esc_html__('Slide Transition Speed (ms)', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 100,
                'max' => 3000,
                'step' => 50,
                'default' => 600,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => esc_html__('Autoplay', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('On', 'amac-builders'),
                'label_off' => esc_html__('Off', 'amac-builders'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => esc_html__('Autoplay Interval (ms)', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1000,
                'max' => 10000,
                'step' => 500,
                'default' => 4000,
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'pause_on_hover',
            [
                'label' => esc_html__('Pause on Hover', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'amac-builders'),
                'label_off' => esc_html__('No', 'amac-builders'),
                'return_value' => 'yes',
                'default' => 'yes',
                'condition' => [
                    'autoplay' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => esc_html__('Infinite Loop', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Yes', 'amac-builders'),
                'label_off' => esc_html__('No', 'amac-builders'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->end_controls_section();

        // Action Bar & Controls
        $this->start_controls_section(
            'section_action_bar',
            [
                'label' => esc_html__('Action Bar & Controls', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'show_arrows',
            [
                'label' => esc_html__('Show Navigation Arrows', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'amac-builders'),
                'label_off' => esc_html__('Hide', 'amac-builders'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'arrows_position',
            [
                'label' => esc_html__('Action Bar Position', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'header_right',
                'options' => [
                    'header_right' => esc_html__('Header Right', 'amac-builders'),
                    'bottom_center' => esc_html__('Bottom Center', 'amac-builders'),
                    'sides' => esc_html__('Sides of Slider', 'amac-builders'),
                ],
                'condition' => [
                    'show_arrows' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'show_dots',
            [
                'label' => esc_html__('Show Pagination Dots', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__('Show', 'amac-builders'),
                'label_off' => esc_html__('Hide', 'amac-builders'),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'dots_type',
            [
                'label' => esc_html__('Dots Type', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'dynamic',
                'options' => [
                    'dynamic' => esc_html__('Dynamic Scaling', 'amac-builders'),
                    'standard' => esc_html__('Standard Bullets', 'amac-builders'),
                ],
                'condition' => [
                    'show_dots' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab - Section
        $this->start_controls_section(
            'section_style_general',
            [
                'label' => esc_html__('Section Styling', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label' => esc_html__('Section Background', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1f2c2c',
                'selectors' => [
                    '{{WRAPPER}} .testimonials-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'section_padding',
            [
                'label' => esc_html__('Section Padding', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%', 'rem'],
                'selectors' => [
                    '{{WRAPPER}} .testimonials-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab - Testimonial Card
        $this->start_controls_section(
            'section_style_card',
            [
                'label' => esc_html__('Card Styling', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_bg_color',
            [
                'label' => esc_html__('Card Background', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(0, 0, 0, 0)',
                'selectors' => [
                    '{{WRAPPER}} .amac-testimonial-card' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'card_border_color',
            [
                'label' => esc_html__('Card Border Color', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(147, 132, 111, 0.2)',
                'selectors' => [
                    '{{WRAPPER}} .amac-testimonial-card' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_padding',
            [
                'label' => esc_html__('Card Padding', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'rem', '%'],
                'default' => [
                    'top' => '32',
                    'right' => '32',
                    'bottom' => '32',
                    'left' => '32',
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .amac-testimonial-card' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'quote_typography',
                'label' => esc_html__('Quote Typography', 'amac-builders'),
                'selector' => '{{WRAPPER}} .amac-testimonial-quote',
            ]
        );

        $this->add_control(
            'quote_color',
            [
                'label' => esc_html__('Quote Color', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(253, 252, 248, 0.8)',
                'selectors' => [
                    '{{WRAPPER}} .amac-testimonial-quote' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'name_color',
            [
                'label' => esc_html__('Client Name Color', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FDFCF8',
                'selectors' => [
                    '{{WRAPPER}} .amac-testimonial-name' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'location_color',
            [
                'label' => esc_html__('Location Color', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#93846f',
                'selectors' => [
                    '{{WRAPPER}} .amac-testimonial-location' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_color',
            [
                'label' => esc_html__('Quote Icon Color', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(147, 132, 111, 0.4)',
                'selectors' => [
                    '{{WRAPPER}} .amac-quote-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab - Action Bar / Arrows
        $this->start_controls_section(
            'section_style_action_bar',
            [
                'label' => esc_html__('Action Bar & Navigation', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => esc_html__('Arrow Color', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#93846f',
                'selectors' => [
                    '{{WRAPPER}} .amac-swiper-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg',
            [
                'label' => esc_html__('Arrow Background', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(147, 132, 111, 0.1)',
                'selectors' => [
                    '{{WRAPPER}} .amac-swiper-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_border_color',
            [
                'label' => esc_html__('Arrow Border Color', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'rgba(147, 132, 111, 0.3)',
                'selectors' => [
                    '{{WRAPPER}} .amac-swiper-btn' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_color',
            [
                'label' => esc_html__('Arrow Hover Color', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FDFCF8',
                'selectors' => [
                    '{{WRAPPER}} .amac-swiper-btn:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_bg',
            [
                'label' => esc_html__('Arrow Hover Background', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#93846f',
                'selectors' => [
                    '{{WRAPPER}} .amac-swiper-btn:hover' => 'background-color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dots_color',
            [
                'label' => esc_html__('Dots Active Color', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#93846f',
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination-bullet-active' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes('eyebrow', 'none');
        $this->add_inline_editing_attributes('title', 'none');

        $slider_config = [
            'desktop_slides' => !empty($settings['slides_per_view']) ? (int)$settings['slides_per_view'] : 3,
            'tablet_slides'  => !empty($settings['slides_per_view_tablet']) ? (int)$settings['slides_per_view_tablet'] : 2,
            'mobile_slides'  => !empty($settings['slides_per_view_mobile']) ? (int)$settings['slides_per_view_mobile'] : 1,
            'space_between'  => isset($settings['space_between']) ? (int)$settings['space_between'] : 32,
            'speed'          => !empty($settings['speed']) ? (int)$settings['speed'] : 600,
            'autoplay'       => ($settings['autoplay'] === 'yes'),
            'autoplay_speed' => !empty($settings['autoplay_speed']) ? (int)$settings['autoplay_speed'] : 4000,
            'pause_on_hover' => ($settings['pause_on_hover'] === 'yes'),
            'loop'           => ($settings['loop'] === 'yes'),
            'show_arrows'    => ($settings['show_arrows'] === 'yes'),
            'show_dots'      => ($settings['show_dots'] === 'yes'),
            'dots_type'      => $settings['dots_type'] ?? 'dynamic',
        ];

        $arrows_pos = $settings['arrows_position'] ?? 'header_right';
        $show_arrows = ($settings['show_arrows'] === 'yes');
        $show_dots = ($settings['show_dots'] === 'yes');
        ?>
        <section id="testimonials" class="testimonials-wrapper py-20 md:py-32 bg-[#1f2c2c] overflow-hidden" style="scroll-margin-top: 80px;">
            <div class="max-w-7xl mx-auto px-6 md:px-8 amac-testimonials-slider-wrapper relative">
                
                <!-- Section Header with Action Bar -->
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-12 md:mb-16 gap-6">
                    <div>
                        <?php if (!empty($settings['eyebrow'])): ?>
                        <p class="text-xs tracking-[0.35em] uppercase mb-4 text-[#93846f]" <?php echo $this->get_render_attribute_string('eyebrow'); ?>><?php echo esc_html($settings['eyebrow']); ?></p>
                        <?php endif; ?>

                        <h2 class="font-display text-3xl md:text-4xl lg:text-5xl font-semibold leading-tight text-[#FDFCF8]" <?php echo $this->get_render_attribute_string('title'); ?>><?php echo esc_html($settings['title']); ?></h2>
                        
                        <?php if ($settings['show_header_divider'] === 'yes'): ?>
                        <div class="mt-6 h-[2px] w-16 bg-[#93846f]/50"></div>
                        <?php endif; ?>
                    </div>

                    <?php if ($show_arrows && $arrows_pos === 'header_right'): ?>
                    <!-- Header Action Bar (Navigation Controls) -->
                    <div class="flex items-center gap-3 self-start md:self-end">
                        <button type="button" aria-label="Previous Slide" class="amac-swiper-prev amac-swiper-btn w-12 h-12 rounded-full border border-[#93846f]/30 bg-[#93846f]/10 text-[#93846f] flex items-center justify-center transition-all duration-300 hover:bg-[#93846f] hover:text-[#1f2c2c] hover:border-[#93846f] cursor-pointer focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                        </button>
                        <button type="button" aria-label="Next Slide" class="amac-swiper-next amac-swiper-btn w-12 h-12 rounded-full border border-[#93846f]/30 bg-[#93846f]/10 text-[#93846f] flex items-center justify-center transition-all duration-300 hover:bg-[#93846f] hover:text-[#1f2c2c] hover:border-[#93846f] cursor-pointer focus:outline-none">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                        </button>
                    </div>
                    <?php endif; ?>
                </div>

                <!-- Swiper Carousel Container -->
                <div class="relative">
                    <?php if ($show_arrows && $arrows_pos === 'sides'): ?>
                    <button type="button" aria-label="Previous Slide" class="amac-swiper-prev amac-swiper-btn absolute -left-5 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full border border-[#93846f]/30 bg-[#1f2c2c]/90 text-[#93846f] flex items-center justify-center transition-all duration-300 hover:bg-[#93846f] hover:text-[#1f2c2c] hover:border-[#93846f] cursor-pointer shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                    </button>
                    <button type="button" aria-label="Next Slide" class="amac-swiper-next amac-swiper-btn absolute -right-5 top-1/2 -translate-y-1/2 z-20 w-12 h-12 rounded-full border border-[#93846f]/30 bg-[#1f2c2c]/90 text-[#93846f] flex items-center justify-center transition-all duration-300 hover:bg-[#93846f] hover:text-[#1f2c2c] hover:border-[#93846f] cursor-pointer shadow-lg">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                    </button>
                    <?php endif; ?>

                    <div class="swiper amac-testimonials-slider overflow-hidden !py-4" data-swiper-config="<?php echo esc_attr(json_encode($slider_config)); ?>">
                        <div class="swiper-wrapper items-stretch">
                            <?php 
                            if (!empty($settings['testimonials_list'])):
                                foreach ($settings['testimonials_list'] as $index => $item): 
                                    $quote_key = $this->get_repeater_setting_key('quote', 'testimonials_list', $index);
                                    $name_key = $this->get_repeater_setting_key('client_name', 'testimonials_list', $index);
                                    $loc_key = $this->get_repeater_setting_key('location', 'testimonials_list', $index);
                                    $this->add_inline_editing_attributes($quote_key, 'basic');
                                    $this->add_inline_editing_attributes($name_key, 'none');
                                    $this->add_inline_editing_attributes($loc_key, 'none');
                            ?>
                            <div class="swiper-slide h-auto">
                                <div class="amac-testimonial-card p-8 border border-[#93846f]/20 h-full flex flex-col justify-between transition-all duration-300 hover:border-[#93846f]/50 hover:bg-[#93846f]/5">
                                    <div>
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="amac-quote-icon w-8 h-8 text-[#93846f]/40 mb-6"><path d="M16 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z"></path><path d="M5 3a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2 1 1 0 0 1 1 1v1a2 2 0 0 1-2 2 1 1 0 0 0-1 1v2a1 1 0 0 0 1 1 6 6 0 0 0 6-6V5a2 2 0 0 0-2-2z"></path></svg>
                                        <p class="amac-testimonial-quote text-[#FDFCF8]/80 text-base leading-relaxed italic" <?php echo $this->get_render_attribute_string($quote_key); ?>>
                                            <?php echo esc_html($item['quote']); ?>
                                        </p>
                                    </div>
                                    <div class="mt-8 pt-6 border-t border-[#93846f]/20">
                                        <p class="amac-testimonial-name text-[#FDFCF8] text-sm font-medium" <?php echo $this->get_render_attribute_string($name_key); ?>><?php echo esc_html($item['client_name']); ?></p>
                                        <p class="amac-testimonial-location text-[#93846f] text-xs mt-1 tracking-wider" <?php echo $this->get_render_attribute_string($loc_key); ?>><?php echo esc_html($item['location']); ?></p>
                                    </div>
                                </div>
                            </div>
                            <?php 
                                endforeach; 
                            endif;
                            ?>
                        </div>
                    </div>
                </div>

                <!-- Bottom Action Bar / Pagination Dots & Arrows if bottom_center -->
                <div class="mt-10 flex flex-col items-center justify-center gap-6">
                    <?php if ($show_arrows && $arrows_pos === 'bottom_center'): ?>
                    <div class="flex items-center gap-4">
                        <button type="button" aria-label="Previous Slide" class="amac-swiper-prev amac-swiper-btn w-11 h-11 rounded-full border border-[#93846f]/30 bg-[#93846f]/10 text-[#93846f] flex items-center justify-center transition-all duration-300 hover:bg-[#93846f] hover:text-[#1f2c2c] hover:border-[#93846f] cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                        </button>
                        <button type="button" aria-label="Next Slide" class="amac-swiper-next amac-swiper-btn w-11 h-11 rounded-full border border-[#93846f]/30 bg-[#93846f]/10 text-[#93846f] flex items-center justify-center transition-all duration-300 hover:bg-[#93846f] hover:text-[#1f2c2c] hover:border-[#93846f] cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                        </button>
                    </div>
                    <?php endif; ?>

                    <?php if ($show_dots): ?>
                    <div class="amac-swiper-pagination flex justify-center items-center gap-2"></div>
                    <?php endif; ?>
                </div>

            </div>
        </section>
        <?php
    }
}
