<?php
if (!defined('ABSPATH')) exit;

class AMAC_About_Timeline_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'amac_about_timeline';
    }

    public function get_title() {
        return esc_html__('AMAC About 3: Journey Timeline', 'amac-builders');
    }

    public function get_icon() {
        return 'eicon-time-line';
    }

    public function get_categories() {
        return ['amac-elements'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_timeline_content',
            [
                'label' => esc_html__('Timeline Header', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'timeline_eyebrow',
            [
                'label' => esc_html__('Eyebrow Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Our Journey',
            ]
        );

        $this->add_control(
            'timeline_title',
            [
                'label' => esc_html__('Section Title', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Three Decades of Building',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_milestones',
            [
                'label' => esc_html__('Milestone Items', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'year',
            [
                'label' => esc_html__('Year / Badge', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => '1994',
            ]
        );

        $repeater->add_control(
            'desc',
            [
                'label' => esc_html__('Description', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => "Danny O'Connor founds AMAC Builders in Greater Boston",
            ]
        );

        $this->add_control(
            'milestones',
            [
                'label' => esc_html__('Timeline List', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'year' => '1994',
                        'desc' => "Danny O'Connor founds AMAC Builders in Greater Boston",
                    ],
                    [
                        'year' => '2000',
                        'desc' => 'Completes 50th residential project across Brookline and Newton',
                    ],
                    [
                        'year' => '2008',
                        'desc' => 'Expands services to include full structural engineering',
                    ],
                    [
                        'year' => '2015',
                        'desc' => 'Surpasses 100+ completed projects with zero safety incidents',
                    ],
                    [
                        'year' => 'Today',
                        'desc' => "30+ years strong, continuing to build Greater Boston's future",
                    ],
                ],
                'title_field' => '{{{ year }}} - {{{ desc }}}',
            ]
        );

        $this->end_controls_section();

        // Style Tab
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Timeline Styling', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bg_color',
            [
                'label' => esc_html__('Background Color', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FDFCF8',
                'selectors' => [
                    '{{WRAPPER}} .amac-timeline-wrapper' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_inline_editing_attributes('timeline_eyebrow', 'none');
        $this->add_inline_editing_attributes('timeline_title', 'none');
        ?>
        <section class="amac-timeline-wrapper py-20 md:py-28 bg-[#FDFCF8] w-full">
            <div class="max-w-3xl mx-auto px-6 md:px-8">
                <div class="mb-12 md:mb-16">
                    <p class="text-xs tracking-[0.35em] uppercase mb-4 text-[#93846f]" <?php echo $this->get_render_attribute_string('timeline_eyebrow'); ?>>
                        <?php echo esc_html($settings['timeline_eyebrow']); ?>
                    </p>
                    <h2 class="font-display text-3xl md:text-4xl lg:text-5xl font-semibold leading-tight text-[#1f2c2c]" <?php echo $this->get_render_attribute_string('timeline_title'); ?>>
                        <?php echo esc_html($settings['timeline_title']); ?>
                    </h2>
                    <div class="mt-6 h-[2px] w-16 bg-[#93846f]"></div>
                </div>

                <div class="relative">
                    <div class="absolute left-4 md:left-6 top-0 bottom-0 w-[1px] bg-[#93846f]/30"></div>
                    <div class="space-y-10">
                        <?php 
                        if (!empty($settings['milestones'])):
                            foreach ($settings['milestones'] as $index => $item): 
                                $desc_key = $this->get_repeater_setting_key('desc', 'milestones', $index);
                                $this->add_inline_editing_attributes($desc_key, 'basic');
                        ?>
                            <div class="flex gap-6 md:gap-8 items-start">
                                <div class="relative z-10 w-8 md:w-12 h-8 md:h-12 shrink-0 bg-[#1f2c2c] flex items-center justify-center">
                                    <span class="text-[#93846f] text-[10px] md:text-xs font-semibold"><?php echo esc_html($item['year']); ?></span>
                                </div>
                                <p class="text-[#1A1A1A]/70 text-base leading-relaxed pt-1 md:pt-2.5" <?php echo $this->get_render_attribute_string($desc_key); ?>>
                                    <?php echo esc_html($item['desc']); ?>
                                </p>
                            </div>
                        <?php 
                            endforeach; 
                        endif;
                        ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
