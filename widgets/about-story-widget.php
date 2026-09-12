<?php
if (!defined('ABSPATH')) exit;

class AMAC_About_Story_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'amac_about_story';
    }

    public function get_title() {
        return esc_html__('AMAC About 1: Founder Story', 'amac-builders');
    }

    public function get_icon() {
        return 'eicon-person';
    }

    public function get_categories() {
        return ['amac-elements'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_story',
            [
                'label' => esc_html__('Founder Story Content', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'story_eyebrow',
            [
                'label' => esc_html__('Eyebrow Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => "Danny O'Connor",
            ]
        );

        $this->add_control(
            'story_title_line1',
            [
                'label' => esc_html__('Title Line 1', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'A Lifetime Dedicated',
            ]
        );

        $this->add_control(
            'story_title_highlight',
            [
                'label' => esc_html__('Title Highlight (Gold)', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'to the Craft',
            ]
        );

        $this->add_control(
            'story_p1',
            [
                'label' => esc_html__('Paragraph 1', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => "For over thirty years, Danny O'Connor has been building across the Greater Boston area with a singular philosophy: do it right, or don't do it at all. What started as a young carpenter's passion has grown into AMAC Builders, LLC — a name synonymous with quality in communities from Brookline to Wellesley.",
            ]
        );

        $this->add_control(
            'story_p2',
            [
                'label' => esc_html__('Paragraph 2', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => "Danny's approach is hands-on and personal. He's on-site every day, ensuring that every beam is plumb, every joint is tight, and every client feels heard. This isn't corporate construction — it's building with a handshake and a reputation earned one project at a time.",
            ]
        );

        $this->add_control(
            'story_p3',
            [
                'label' => esc_html__('Paragraph 3', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => "With over a hundred satisfied clients, Danny doesn't just build homes. He builds relationships that last as long as the structures themselves.",
            ]
        );

        $this->add_control(
            'story_image',
            [
                'label' => esc_html__('Feature Portrait Image', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => plugins_url('../assets/images/img_1222443232.png', __FILE__),
                ],
            ]
        );

        $this->end_controls_section();

        // Style Tab
        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Section Styling', 'amac-builders'),
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
                    '{{WRAPPER}} .amac-story-wrapper' => 'background-color: {{VALUE}} !important;',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $this->add_inline_editing_attributes('story_eyebrow', 'none');
        $this->add_inline_editing_attributes('story_title_line1', 'none');
        $this->add_inline_editing_attributes('story_title_highlight', 'none');
        $this->add_inline_editing_attributes('story_p1', 'basic');
        $this->add_inline_editing_attributes('story_p2', 'basic');
        $this->add_inline_editing_attributes('story_p3', 'basic');

        $img_url = !empty($settings['story_image']['url']) ? $settings['story_image']['url'] : plugins_url('../assets/images/img_1222443232.png', __FILE__);
        ?>
        <section class="amac-story-wrapper py-20 md:py-32 bg-[#FDFCF8] w-full">
            <div class="max-w-7xl mx-auto px-6 md:px-8">
                <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">
                    <!-- Text Column -->
                    <div>
                        <p class="text-[#93846f] text-xs tracking-[0.35em] uppercase mb-4" <?php echo $this->get_render_attribute_string('story_eyebrow'); ?>>
                            <?php echo esc_html($settings['story_eyebrow']); ?>
                        </p>
                        <h2 class="font-display text-3xl md:text-4xl font-semibold text-[#1f2c2c] leading-tight mb-6">
                            <span <?php echo $this->get_render_attribute_string('story_title_line1'); ?>><?php echo esc_html($settings['story_title_line1']); ?></span><br>
                            <span class="text-[#93846f]" <?php echo $this->get_render_attribute_string('story_title_highlight'); ?>><?php echo esc_html($settings['story_title_highlight']); ?></span>
                        </h2>
                        <div class="h-[2px] w-16 bg-[#93846f] mb-8"></div>
                        <div class="space-y-5 text-[#1A1A1A]/70 text-base md:text-lg leading-relaxed">
                            <p <?php echo $this->get_render_attribute_string('story_p1'); ?>><?php echo esc_html($settings['story_p1']); ?></p>
                            <p <?php echo $this->get_render_attribute_string('story_p2'); ?>><?php echo esc_html($settings['story_p2']); ?></p>
                            <p <?php echo $this->get_render_attribute_string('story_p3'); ?>><?php echo esc_html($settings['story_p3']); ?></p>
                        </div>
                    </div>

                    <!-- Image Column with Gold Brackets -->
                    <div class="relative group">
                        <div class="absolute -top-2 -left-2 w-8 h-8 border-t-2 border-l-2 border-[#93846f] z-10 opacity-70 group-hover:opacity-100 transition-opacity"></div>
                        <div class="absolute -top-2 -right-2 w-8 h-8 border-t-2 border-r-2 border-[#93846f] z-10 opacity-70 group-hover:opacity-100 transition-opacity"></div>
                        <div class="absolute -bottom-2 -left-2 w-8 h-8 border-b-2 border-l-2 border-[#93846f] z-10 opacity-70 group-hover:opacity-100 transition-opacity"></div>
                        <div class="absolute -bottom-2 -right-2 w-8 h-8 border-b-2 border-r-2 border-[#93846f] z-10 opacity-70 group-hover:opacity-100 transition-opacity"></div>
                        <div class="overflow-hidden aspect-[4/5]">
                            <img src="<?php echo esc_url($img_url); ?>" alt="Danny O'Connor - Master Builder" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
}
