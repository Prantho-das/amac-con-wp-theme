<?php
if (!defined('ABSPATH')) exit;

class AMAC_CTA_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'amac_cta';
    }

    public function get_title() {
        return esc_html__('AMAC CTA Banner', 'amac-builders');
    }

    public function get_icon() {
        return 'eicon-call-to-action';
    }

    public function get_categories() {
        return ['amac-elements'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_cta',
            [
                'label' => esc_html__('CTA Content', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'eyebrow',
            [
                'label' => esc_html__('Eyebrow', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Start Your Project',
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => esc_html__('Title', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Ready to Build Something Exceptional?',
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => esc_html__('Description', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => "Contact Danny O'Connor today for a consultation and free quote on your next project.",
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__('Button Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Request a Quote',
            ]
        );

        $this->add_control(
            'btn_link',
            [
                'label' => esc_html__('Button Link', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => ['url' => '#contact'],
            ]
        );

        $this->add_control(
            'phone_number',
            [
                'label' => esc_html__('Phone Number', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => '617.388.5901',
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
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $bg_url = !empty($settings['bg_image']['url']) ? $settings['bg_image']['url'] : '';
        $clean_phone = preg_replace('/[^0-9]/', '', $settings['phone_number']);

        $this->add_inline_editing_attributes('eyebrow', 'none');
        $this->add_inline_editing_attributes('title', 'none');
        $this->add_inline_editing_attributes('description', 'basic');
        $this->add_inline_editing_attributes('btn_text', 'none');
        $this->add_inline_editing_attributes('phone_number', 'none');
        ?>
        <section class="relative py-24 md:py-32 overflow-hidden">
            <div class="absolute inset-0">
                <?php if ($bg_url): ?>
                <img src="<?php echo esc_url($bg_url); ?>" alt="<?php echo esc_attr($settings['title']); ?>" class="w-full h-full object-cover">
                <?php endif; ?>
                <div class="absolute inset-0 bg-[#1A1A1A]/70"></div>
            </div>

            <div class="relative z-10 max-w-7xl mx-auto px-6 md:px-8 text-center">
                <div class="amac-about-cta-wrapper">
                    <?php if (!empty($settings['eyebrow'])): ?>
                    <p class="text-[#93846f] text-xs tracking-[0.35em] uppercase mb-6" <?php echo $this->get_render_attribute_string('eyebrow'); ?>><?php echo esc_html($settings['eyebrow']); ?></p>
                    <?php endif; ?>

                    <h2 class="font-display text-3xl md:text-4xl lg:text-5xl text-[#FDFCF8] font-semibold leading-tight max-w-2xl mx-auto mb-8" <?php echo $this->get_render_attribute_string('title'); ?>>
                        <?php echo esc_html($settings['title']); ?>
                    </h2>

                    <?php if (!empty($settings['description'])): ?>
                    <p class="text-[#FDFCF8]/60 text-lg max-w-xl mx-auto mb-10" <?php echo $this->get_render_attribute_string('description'); ?>>
                        <?php echo esc_html($settings['description']); ?>
                    </p>
                    <?php endif; ?>

                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <?php if (!empty($settings['btn_text'])): ?>
                        <a class="amac-btn-primary inline-flex items-center justify-center gap-3 px-8 py-4 bg-[#1f2c2c] text-[#FDFCF8] text-sm tracking-[0.2em] uppercase transition-all duration-300 group" href="<?php echo esc_url($settings['btn_link']['url']); ?>" <?php echo $settings['btn_link']['is_external'] ? 'target="_blank"' : ''; ?>>
                            <span <?php echo $this->get_render_attribute_string('btn_text'); ?>><?php echo esc_html($settings['btn_text']); ?></span>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                        </a>
                        <?php endif; ?>

                        <?php if (!empty($settings['phone_number'])): ?>
                        <a href="tel:<?php echo esc_attr($clean_phone); ?>" class="amac-btn-secondary inline-flex items-center justify-center gap-3 px-8 py-4 border border-[#93846f]/40 text-[#FDFCF8] text-sm tracking-[0.2em] uppercase transition-all duration-300">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path></svg>
                            <span <?php echo $this->get_render_attribute_string('phone_number'); ?>><?php echo esc_html($settings['phone_number']); ?></span>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
