<?php
if (!defined('ABSPATH')) exit;

class AMAC_About_Values_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'amac_about_values';
    }

    public function get_title() {
        return esc_html__('AMAC About 2: Core Values', 'amac-builders');
    }

    public function get_icon() {
        return 'eicon-star-o';
    }

    public function get_categories() {
        return ['amac-elements'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_values_content',
            [
                'label' => esc_html__('Core Values Header', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'values_eyebrow',
            [
                'label' => esc_html__('Eyebrow Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Our Values',
            ]
        );

        $this->add_control(
            'values_title',
            [
                'label' => esc_html__('Section Title', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'What We Stand On',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_values_items',
            [
                'label' => esc_html__('Values Items', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Value Title', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'Integrity',
            ]
        );

        $repeater->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => 'Honest estimates, transparent timelines, and no hidden costs. Our word is our bond.',
            ]
        );

        $repeater->add_control(
            'icon_svg',
            [
                'label' => esc_html__('Icon Type', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'shield',
                'options' => [
                    'shield' => esc_html__('Shield (Integrity)', 'amac-builders'),
                    'award' => esc_html__('Award (Craftsmanship)', 'amac-builders'),
                    'users' => esc_html__('Users (Relationships)', 'amac-builders'),
                    'clock' => esc_html__('Clock (Reliability)', 'amac-builders'),
                ],
            ]
        );

        $this->add_control(
            'values_list',
            [
                'label' => esc_html__('Values Cards', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => 'Integrity',
                        'desc' => 'Honest estimates, transparent timelines, and no hidden costs. Our word is our bond.',
                        'icon_svg' => 'shield',
                    ],
                    [
                        'title' => 'Craftsmanship',
                        'desc' => 'Every joint, every finish, every detail held to the highest standard of the trade.',
                        'icon_svg' => 'award',
                    ],
                    [
                        'title' => 'Relationships',
                        'desc' => 'Hundreds of clients return to us again and again. We build trust alongside structures.',
                        'icon_svg' => 'users',
                    ],
                    [
                        'title' => 'Reliability',
                        'desc' => 'On time, on budget, every time. Three decades of consistent, dependable delivery.',
                        'icon_svg' => 'clock',
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
                'label' => esc_html__('Values Section Styling', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label' => esc_html__('Background Color', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#F5F1EB',
                'selectors' => [
                    '{{WRAPPER}} .amac-values-wrapper' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_inline_editing_attributes('values_eyebrow', 'none');
        $this->add_inline_editing_attributes('values_title', 'none');
        ?>
        <section class="amac-values-wrapper py-20 md:py-28 bg-[#F5F1EB] w-full">
            <div class="max-w-7xl mx-auto px-6 md:px-8">
                <div class="mb-12 md:mb-16">
                    <p class="text-xs tracking-[0.35em] uppercase mb-4 text-[#93846f]" <?php echo $this->get_render_attribute_string('values_eyebrow'); ?>>
                        <?php echo esc_html($settings['values_eyebrow']); ?>
                    </p>
                    <h2 class="font-display text-3xl md:text-4xl lg:text-5xl font-semibold leading-tight text-[#1f2c2c]" <?php echo $this->get_render_attribute_string('values_title'); ?>>
                        <?php echo esc_html($settings['values_title']); ?>
                    </h2>
                    <div class="mt-6 h-[2px] w-16 bg-[#93846f]"></div>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                    <?php 
                    if (!empty($settings['values_list'])):
                        foreach ($settings['values_list'] as $index => $item): 
                            $title_key = $this->get_repeater_setting_key('title', 'values_list', $index);
                            $desc_key = $this->get_repeater_setting_key('desc', 'values_list', $index);
                            $this->add_inline_editing_attributes($title_key, 'none');
                            $this->add_inline_editing_attributes($desc_key, 'basic');
                    ?>
                        <div class="text-center">
                            <div class="w-14 h-14 mx-auto flex items-center justify-center bg-[#1f2c2c]/5 mb-5">
                                <?php if ($item['icon_svg'] === 'shield'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-[#1f2c2c]"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path></svg>
                                <?php elseif ($item['icon_svg'] === 'award'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-[#1f2c2c]"><path d="m15.477 12.89 1.515 8.526a.5.5 0 0 1-.81.47l-3.58-2.687a1 1 0 0 0-1.197 0l-3.586 2.686a.5.5 0 0 1-.81-.469l1.514-8.526"></path><circle cx="12" cy="8" r="6"></circle></svg>
                                <?php elseif ($item['icon_svg'] === 'users'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-[#1f2c2c]"><path d="M16 21v-2a4 4 0 0 0-4-4H6a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M22 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                                <?php else: ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-6 h-6 text-[#1f2c2c]"><circle cx="12" cy="12" r="10"></circle><polyline points="12 6 12 12 16 14"></polyline></svg>
                                <?php endif; ?>
                            </div>
                            <h3 class="font-display text-lg text-[#1f2c2c] font-semibold mb-3" <?php echo $this->get_render_attribute_string($title_key); ?>>
                                <?php echo esc_html($item['title']); ?>
                            </h3>
                            <p class="text-[#1A1A1A]/60 text-sm leading-relaxed" <?php echo $this->get_render_attribute_string($desc_key); ?>>
                                <?php echo esc_html($item['desc']); ?>
                            </p>
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
