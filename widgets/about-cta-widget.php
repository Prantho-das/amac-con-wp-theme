<?php
if (!defined('ABSPATH')) exit;

class AMAC_About_CTA_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'amac_about_cta';
    }

    public function get_title() {
        return esc_html__('AMAC About 4: Call to Action', 'amac-builders');
    }

    public function get_icon() {
        return 'eicon-call-to-action';
    }

    public function get_categories() {
        return ['amac-elements'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_cta_content',
            [
                'label' => esc_html__('CTA Content', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'cta_eyebrow',
            [
                'label' => esc_html__('Eyebrow Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => "Let's Build Together",
            ]
        );

        $this->add_control(
            'cta_title',
            [
                'label' => esc_html__('Main Title', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Ready to Start Your Project?',
            ]
        );

        $this->add_control(
            'cta_btn_text',
            [
                'label' => esc_html__('Button Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Get in Touch',
            ]
        );

        $this->add_control(
            'cta_btn_link',
            [
                'label' => esc_html__('Button Link', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::URL,
                'default' => [
                    'url' => home_url('/contact'),
                ],
            ]
        );

        $this->add_control(
            'cta_bg_image',
            [
                'label' => esc_html__('Background Image', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => plugins_url('../assets/images/img_71500185.png', __FILE__),
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_inline_editing_attributes('cta_eyebrow', 'none');
        $this->add_inline_editing_attributes('cta_title', 'none');
        $this->add_inline_editing_attributes('cta_btn_text', 'none');

        $bg_url = !empty($settings['cta_bg_image']['url']) ? $settings['cta_bg_image']['url'] : plugins_url('../assets/images/img_71500185.png', __FILE__);
        ?>
        <section class="relative py-20 md:py-28 overflow-hidden w-full">
            <div class="absolute inset-0">
                <img src="<?php echo esc_url($bg_url); ?>" alt="Background" class="w-full h-full object-cover">
                <div class="absolute inset-0 bg-[#1f2c2c]/80"></div>
            </div>
            <div class="relative z-10 max-w-3xl mx-auto px-6 md:px-8 text-center">
                <p class="text-[#93846f] text-xs tracking-[0.35em] uppercase mb-6" <?php echo $this->get_render_attribute_string('cta_eyebrow'); ?>>
                    <?php echo esc_html($settings['cta_eyebrow']); ?>
                </p>
                <h2 class="font-display text-3xl md:text-4xl text-[#FDFCF8] font-semibold mb-8" <?php echo $this->get_render_attribute_string('cta_title'); ?>>
                    <?php echo esc_html($settings['cta_title']); ?>
                </h2>
                <a class="hero-gold-border amac-btn-secondary inline-flex items-center justify-center gap-3 px-8 py-4 border border-[#93846f] text-[#FDFCF8] text-sm tracking-[0.2em] uppercase transition-all duration-300 group font-semibold hover:scale-105" href="<?php echo esc_url($settings['cta_btn_link']['url']); ?>" <?php echo !empty($settings['cta_btn_link']['is_external']) ? 'target="_blank"' : ''; ?> style="text-decoration: none;">
                    <span <?php echo $this->get_render_attribute_string('cta_btn_text'); ?>><?php echo esc_html($settings['cta_btn_text']); ?></span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                </a>
            </div>
        </section>
        <?php
    }
}
