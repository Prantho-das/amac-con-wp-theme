<?php
if (!defined('ABSPATH')) exit;

class AMAC_Services_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'amac_services';
    }

    public function get_title() {
        return esc_html__('AMAC Services Grid', 'amac-builders');
    }

    public function get_icon() {
        return 'eicon-gallery-grid';
    }

    public function get_categories() {
        return ['amac-elements'];
    }

    protected function register_controls() {
        // Content Tab - Header
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
                'default' => 'What We Do',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Section Title', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Services',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => 'Three decades of expertise across every discipline of residential construction.',
            ]
        );

        $this->end_controls_section();

        // Content Tab - Cards
        $this->start_controls_section(
            'section_services',
            [
                'label' => esc_html__('Services List', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'icon_type',
            [
                'label' => esc_html__('Icon Type', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'house',
                'options' => [
                    'house' => 'House / New Construction',
                    'wrench' => 'Wrench / Remodeling',
                    'hammer' => 'Hammer / Structural',
                ],
            ]
        );

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Service Title', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'New Construction',
            ]
        );

        $repeater->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => 'Custom homes built from the ground up with precision engineering and premium materials.',
            ]
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__('Link', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => ['url' => '#services'],
            ]
        );

        $this->add_control(
            'services_list',
            [
                'label' => esc_html__('Services Cards', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'icon_type' => 'house',
                        'title' => 'New Construction',
                        'desc' => 'Custom homes built from the ground up with precision engineering and premium materials.',
                    ],
                    [
                        'icon_type' => 'wrench',
                        'title' => 'Remodeling',
                        'desc' => "Kitchen, bath, and whole-home renovations that honor a home's history while modernizing for today.",
                    ],
                    [
                        'icon_type' => 'hammer',
                        'title' => 'Structural Work',
                        'desc' => 'Foundation repair, framing, and structural engineering to ensure lasting integrity.',
                    ],
                ],
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        // Style Tab
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Colors & Design', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__('Title Color', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1f2c2c',
                'selectors' => [
                    '{{WRAPPER}} .services-heading' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .service-card-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'accent_color',
            [
                'label' => esc_html__('Gold Accent Color', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#93846f',
                'selectors' => [
                    '{{WRAPPER}} .service-gold' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .service-gold-bg' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes('eyebrow', 'none');
        $this->add_inline_editing_attributes('title', 'none');
        $this->add_inline_editing_attributes('description', 'basic');
        ?>
        <section class="services-section py-20 md:py-32 bg-[#F5F1EB] w-full">
            <div class="max-w-7xl mx-auto px-6 md:px-8">
                <div class="mb-12 md:mb-16">
                    <?php if (!empty($settings['eyebrow'])): ?>
                    <p class="service-gold text-xs tracking-[0.35em] uppercase mb-4 text-[#93846f]" <?php echo $this->get_render_attribute_string('eyebrow'); ?>><?php echo esc_html($settings['eyebrow']); ?></p>
                    <?php endif; ?>

                    <h2 class="services-heading font-display text-3xl md:text-4xl lg:text-5xl font-semibold leading-tight text-[#1f2c2c]" <?php echo $this->get_render_attribute_string('title'); ?>><?php echo esc_html($settings['title']); ?></h2>

                    <?php if (!empty($settings['description'])): ?>
                    <p class="mt-5 text-base md:text-lg leading-relaxed max-w-2xl text-[#1A1A1A]/60" <?php echo $this->get_render_attribute_string('description'); ?>><?php echo esc_html($settings['description']); ?></p>
                    <?php endif; ?>

                    <div class="service-gold-bg mt-6 h-[2px] w-16 bg-[#93846f]"></div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-8 md:gap-10">
                    <?php 
                    if (!empty($settings['services_list'])):
                        foreach ($settings['services_list'] as $index => $item): 
                            $title_key = $this->get_repeater_setting_key('title', 'services_list', $index);
                            $desc_key = $this->get_repeater_setting_key('desc', 'services_list', $index);
                            $this->add_inline_editing_attributes($title_key, 'none');
                            $this->add_inline_editing_attributes($desc_key, 'basic');
                    ?>
                    <div class="group">
                        <div class="bg-[#FDFCF8] p-8 md:p-10 border border-[#93846f]/20 hover:border-[#93846f]/50 transition-all duration-500 h-full flex flex-col">
                            <div class="w-12 h-12 flex items-center justify-center bg-[#1f2c2c]/5 mb-6">
                                <?php if ($item['icon_type'] === 'wrench'): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-[#1f2c2c]"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
                                <?php elseif ($item['icon_type'] === 'hammer'): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-[#1f2c2c]"><path d="m15 12-8.373 8.373a1 1 0 1 1-3-3L12 9"></path><path d="m18 15 4-4"></path><path d="m21.5 11.5-1.914-1.914A2 2 0 0 1 19 8.172V7l-2.26-2.26a6 6 0 0 0-4.202-1.756L9 2.96l.92.82A6.18 6.18 0 0 1 12 8.4V10l2 2h1.172a2 2 0 0 1 1.414.586L18.5 14.5"></path></svg>
                                <?php else: ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-[#1f2c2c]"><path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"></path><path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
                                <?php endif; ?>
                            </div>

                            <h3 class="service-card-title font-display text-xl text-[#1f2c2c] font-semibold mb-4" <?php echo $this->get_render_attribute_string($title_key); ?>><?php echo esc_html($item['title']); ?></h3>
                            <p class="text-[#1A1A1A]/60 text-base leading-relaxed flex-1" <?php echo $this->get_render_attribute_string($desc_key); ?>><?php echo esc_html($item['desc']); ?></p>

                            <div class="mt-6 pt-6 border-t border-[#93846f]/15">
                                <a class="inline-flex items-center gap-2 text-[#1f2c2c] text-xs tracking-[0.15em] uppercase hover:text-[#93846f] transition-colors group/link" href="<?php echo esc_url($item['link']['url']); ?>" <?php echo $item['link']['is_external'] ? 'target="_blank"' : ''; ?>>
                                    Learn More
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-3.5 h-3.5 group-hover/link:translate-x-1 transition-transform"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                                </a>
                            </div>
                        </div>
                    </div>
                    <?php 
                        endforeach; 
                    endif;
                    ?>
                </div>
            </div>
        </section>
        <?php
    }
}
