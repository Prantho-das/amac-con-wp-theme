<?php
if (!defined('ABSPATH')) exit;

class AMAC_Page_Banner_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'amac_page_banner';
    }

    public function get_title() {
        return esc_html__('AMAC Page Header Banner', 'amac-builders');
    }

    public function get_icon() {
        return 'eicon-t-letter';
    }

    public function get_categories() {
        return ['amac-elements'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_content',
            [
                'label' => esc_html__('Banner Content', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'eyebrow',
            [
                'label' => esc_html__('Eyebrow Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Our Services',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Page Title', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => "The Contractor's Ledger",
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => 'Three decades of diverse expertise distilled into focused service pillars.',
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
        <section class="bg-[#1f2c2c] pt-32 pb-16 md:pt-36 md:pb-20 w-full">
            <div class="max-w-7xl mx-auto px-6 md:px-8">
                <div class="mb-12 md:mb-16">
                    <?php if (!empty($settings['eyebrow'])): ?>
                    <p class="text-xs tracking-[0.35em] uppercase mb-4 text-[#93846f]" <?php echo $this->get_render_attribute_string('eyebrow'); ?>><?php echo esc_html($settings['eyebrow']); ?></p>
                    <?php endif; ?>

                    <h2 class="font-display text-3xl md:text-4xl lg:text-5xl font-semibold leading-tight text-[#FDFCF8]" <?php echo $this->get_render_attribute_string('title'); ?>><?php echo esc_html($settings['title']); ?></h2>

                    <?php if (!empty($settings['description'])): ?>
                    <p class="mt-5 text-base md:text-lg leading-relaxed max-w-2xl text-[#FDFCF8]/70" <?php echo $this->get_render_attribute_string('description'); ?>><?php echo esc_html($settings['description']); ?></p>
                    <?php endif; ?>

                    <div class="mt-6 h-[2px] w-16 bg-[#93846f]/50"></div>
                </div>
            </div>
        </section>
        <?php
    }
}
