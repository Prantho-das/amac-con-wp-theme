<?php
if (!defined('ABSPATH')) exit;

class AMAC_Stats_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'amac_stats';
    }

    public function get_title() {
        return esc_html__('AMAC Stats & Counters', 'amac-builders');
    }

    public function get_icon() {
        return 'eicon-counter';
    }

    public function get_categories() {
        return ['amac-elements'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_stats',
            [
                'label' => esc_html__('Counters', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'stat_number',
            [
                'label' => esc_html__('Number / Stat', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => '30+',
            ]
        );

        $repeater->add_control(
            'stat_label',
            [
                'label' => esc_html__('Label Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Years Experience',
            ]
        );

        $repeater->add_control(
            'stat_link',
            [
                'label' => esc_html__('Optional Target Link', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'placeholder' => '#testimonials',
            ]
        );

        $this->add_control(
            'stats_list',
            [
                'label' => esc_html__('Stats Items', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    ['stat_number' => '30+', 'stat_label' => 'Years Experience'],
                    ['stat_number' => '100+', 'stat_label' => 'Projects Completed'],
                    ['stat_number' => '100%', 'stat_label' => 'Client Satisfaction', 'stat_link' => ['url' => '#testimonials']],
                    ['stat_number' => '1', 'stat_label' => 'Standard of Excellence'],
                ],
                'title_field' => '{{{ stat_number }}} - {{{ stat_label }}}',
            ]
        );

        $this->end_controls_section();

        // Style Tab
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Background & Text Color', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label' => esc_html__('Background Color', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1f2c2c',
                'selectors' => [
                    '{{WRAPPER}} .stats-wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'stat_color',
            [
                'label' => esc_html__('Number Color', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#93846f',
                'selectors' => [
                    '{{WRAPPER}} .stat-number' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        if (empty($settings['stats_list'])) return;
        ?>
        <section class="stats-wrapper bg-[#1f2c2c] py-12 md:py-16">
            <div class="max-w-7xl mx-auto px-6 md:px-8">
                <div class="grid grid-cols-2 md:grid-cols-4 gap-8 md:gap-4">
                    <?php 
                    foreach ($settings['stats_list'] as $index => $item): 
                        $num_key = $this->get_repeater_setting_key('stat_number', 'stats_list', $index);
                        $label_key = $this->get_repeater_setting_key('stat_label', 'stats_list', $index);
                        $this->add_inline_editing_attributes($num_key, 'none');
                        $this->add_inline_editing_attributes($label_key, 'none');
                        $has_link = !empty($item['stat_link']['url']);
                    ?>
                    <div class="text-center">
                        <?php if ($has_link): ?>
                        <a href="<?php echo esc_url($item['stat_link']['url']); ?>" <?php echo !empty($item['stat_link']['is_external']) ? 'target="_blank"' : ''; ?> class="inline-block transition-transform hover:scale-105" style="text-decoration: none;">
                        <?php endif; ?>
                            <p class="stat-number font-display text-3xl md:text-4xl text-[#93846f] font-semibold" <?php echo $this->get_render_attribute_string($num_key); ?>>
                                <?php echo esc_html($item['stat_number']); ?>
                            </p>
                            <p class="mt-2 text-[#FDFCF8]/60 text-xs tracking-[0.2em] uppercase" <?php echo $this->get_render_attribute_string($label_key); ?>>
                                <?php echo esc_html($item['stat_label']); ?>
                            </p>
                        <?php if ($has_link): ?>
                        </a>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>
        <?php
    }
}
