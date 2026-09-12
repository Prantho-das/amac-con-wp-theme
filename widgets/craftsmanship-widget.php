<?php
if (!defined('ABSPATH')) exit;

class AMAC_Craftsmanship_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'amac_craftsmanship';
    }

    public function get_title() {
        return esc_html__('AMAC Craftsmanship / Builder', 'amac-builders');
    }

    public function get_icon() {
        return 'eicon-image-box';
    }

    public function get_categories() {
        return ['amac-elements'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Content', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'eyebrow',
            [
                'label' => esc_html__('Eyebrow Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'The Builder',
            ]
        );

        $this->add_control(
            'title_main',
            [
                'label' => esc_html__('Main Title', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Craftsmanship',
            ]
        );

        $this->add_control(
            'title_highlight',
            [
                'label' => esc_html__('Highlight Title (Gold)', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Built to Last',
            ]
        );

        $this->add_control(
            'para1',
            [
                'label' => esc_html__('Paragraph 1', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => "Danny O'Connor has spent over three decades perfecting his craft across the Greater Boston area. From structural foundations to the finest finishing details, every project reflects an uncompromising commitment to quality that has earned the trust of hundreds of clients.",
            ]
        );

        $this->add_control(
            'para2',
            [
                'label' => esc_html__('Paragraph 2', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => "AMAC Builders, LLC stands for precision, reliability, and the kind of work that speaks for itself—generation after generation.",
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__('Button Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Learn More About Danny',
            ]
        );

        $this->add_control(
            'btn_link',
            [
                'label' => esc_html__('Button Link', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => ['url' => '#about'],
            ]
        );

        $this->add_control(
            'feature_image',
            [
                'label' => esc_html__('Feature Image', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Colors & Spacing', 'amac-builders'),
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
                    '{{WRAPPER}} .craft-title' => 'color: {{VALUE}};',
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
                    '{{WRAPPER}} .craft-gold' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .craft-gold-border' => 'border-color: {{VALUE}};',
                    '{{WRAPPER}} .craft-gold-bg' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $img_url = !empty($settings['feature_image']['url']) ? $settings['feature_image']['url'] : '';

        $this->add_inline_editing_attributes('eyebrow', 'none');
        $this->add_inline_editing_attributes('title_main', 'none');
        $this->add_inline_editing_attributes('title_highlight', 'none');
        $this->add_inline_editing_attributes('para1', 'basic');
        $this->add_inline_editing_attributes('para2', 'basic');
        $this->add_inline_editing_attributes('btn_text', 'none');
        ?>
        <section class="craftsmanship-section py-20 md:py-32 bg-[#FDFCF8] w-full">
            <div class="max-w-7xl mx-auto px-6 md:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                    <div class="relative group">
                        <!-- Corner Gold Borders -->
                        <div class="craft-gold-border absolute -top-2 -left-2 w-8 h-8 border-t-2 border-l-2 border-[#93846f] z-10 opacity-70 group-hover:opacity-100 transition-opacity"></div>
                        <div class="craft-gold-border absolute -top-2 -right-2 w-8 h-8 border-t-2 border-r-2 border-[#93846f] z-10 opacity-70 group-hover:opacity-100 transition-opacity"></div>
                        <div class="craft-gold-border absolute -bottom-2 -left-2 w-8 h-8 border-b-2 border-l-2 border-[#93846f] z-10 opacity-70 group-hover:opacity-100 transition-opacity"></div>
                        <div class="craft-gold-border absolute -bottom-2 -right-2 w-8 h-8 border-b-2 border-r-2 border-[#93846f] z-10 opacity-70 group-hover:opacity-100 transition-opacity"></div>
                        
                        <div class="overflow-hidden aspect-square">
                            <?php if ($img_url): ?>
                            <img src="<?php echo esc_url($img_url); ?>" alt="<?php echo esc_attr($settings['title_main']); ?>" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <?php endif; ?>
                        </div>
                    </div>

                    <div>
                        <?php if (!empty($settings['eyebrow'])): ?>
                        <p class="craft-gold text-[#93846f] text-xs tracking-[0.35em] uppercase mb-4" <?php echo $this->get_render_attribute_string('eyebrow'); ?>>
                            <?php echo esc_html($settings['eyebrow']); ?>
                        </p>
                        <?php endif; ?>

                        <h2 class="craft-title font-display text-3xl md:text-4xl lg:text-5xl font-semibold text-[#1f2c2c] leading-tight mb-6">
                            <span <?php echo $this->get_render_attribute_string('title_main'); ?>><?php echo esc_html($settings['title_main']); ?></span><br>
                            <span class="craft-gold text-[#93846f]" <?php echo $this->get_render_attribute_string('title_highlight'); ?>><?php echo esc_html($settings['title_highlight']); ?></span>
                        </h2>

                        <div class="craft-gold-bg h-[2px] w-16 bg-[#93846f] mb-8"></div>

                        <?php if (!empty($settings['para1'])): ?>
                        <p class="text-[#1A1A1A]/70 text-base md:text-lg leading-relaxed mb-6" <?php echo $this->get_render_attribute_string('para1'); ?>>
                            <?php echo esc_html($settings['para1']); ?>
                        </p>
                        <?php endif; ?>

                        <?php if (!empty($settings['para2'])): ?>
                        <p class="text-[#1A1A1A]/70 text-base md:text-lg leading-relaxed mb-8" <?php echo $this->get_render_attribute_string('para2'); ?>>
                            <?php echo esc_html($settings['para2']); ?>
                        </p>
                        <?php endif; ?>

                        <?php if (!empty($settings['btn_text'])): ?>
                        <a class="craft-title inline-flex items-center gap-3 text-[#1f2c2c] text-sm tracking-[0.15em] uppercase hover:text-[#93846f] transition-colors group" href="<?php echo esc_url($settings['btn_link']['url']); ?>" <?php echo $settings['btn_link']['is_external'] ? 'target="_blank"' : ''; ?>>
                            <span <?php echo $this->get_render_attribute_string('btn_text'); ?>><?php echo esc_html($settings['btn_text']); ?></span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
