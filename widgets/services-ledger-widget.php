<?php
if (!defined('ABSPATH')) exit;

class AMAC_Services_Ledger_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'amac_services_ledger';
    }

    public function get_title() {
        return esc_html__('AMAC Services Accordion (Ledger)', 'amac-builders');
    }

    public function get_icon() {
        return 'eicon-accordion';
    }

    public function get_categories() {
        return ['amac-elements'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_ledger',
            [
                'label' => esc_html__('Services Accordion Items', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'icon_type',
            [
                'label' => esc_html__('Icon', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'house',
                'options' => [
                    'house' => 'House / New Construction',
                    'wrench' => 'Wrench / Remodeling',
                    'hammer' => 'Hammer / Structural',
                    'paint' => 'Paint / Finishing',
                    'ruler' => 'Ruler / Project Management',
                    'shield' => 'Shield / Maintenance',
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
            'subtitle',
            [
                'label' => esc_html__('Service Subtitle (Gold)', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Custom Homes & Additions',
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Detailed Description', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => "From initial blueprints to final walkthrough, Danny O'Connor brings thirty years of structural knowledge to every new build. We specialize in custom homes that reflect New England's architectural heritage while incorporating modern engineering standards.",
            ]
        );

        $repeater->add_control(
            'features_list',
            [
                'label' => esc_html__('Bullet Points (One per line)', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'default' => "Custom single and multi-family homes\nRoom additions and extensions\nGarage and outbuilding construction\nFoundation work and site preparation\nFull permit management",
            ]
        );

        $this->add_control(
            'ledger_items',
            [
                'label' => esc_html__('Services List', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'icon_type' => 'house',
                        'title' => 'New Construction',
                        'subtitle' => 'Custom Homes & Additions',
                        'description' => "From initial blueprints to final walkthrough, Danny O'Connor brings thirty years of structural knowledge to every new build. We specialize in custom homes that reflect New England's architectural heritage while incorporating modern engineering standards.",
                        'features_list' => "Custom single and multi-family homes\nRoom additions and extensions\nGarage and outbuilding construction\nFoundation work and site preparation\nFull permit management",
                    ],
                    [
                        'icon_type' => 'wrench',
                        'title' => 'Remodeling & Renovations',
                        'subtitle' => 'Kitchens, Baths & Living Spaces',
                        'description' => "Our renovation work respects the bones of existing structures while breathing new life into every room. From historic brownstone restorations to contemporary kitchen overhauls, we transform spaces with precision.",
                        'features_list' => "Gourmet kitchen redesign & installation\nLuxury master bath transformations\nWhole-home gut renovations\nHistoric home restorations\nBasement finishing & conversions",
                    ],
                    [
                        'icon_type' => 'hammer',
                        'title' => 'Structural Engineering',
                        'subtitle' => 'Foundations & Framing',
                        'description' => "The integrity of any building begins below ground. Danny O'Connor's deep structural background ensures that foundation work, load-bearing modifications, and structural framing exceed building codes.",
                        'features_list' => "Foundation repair & underpinning\nLoad-bearing wall removal & beam installation\nStructural framing & timber work\nSill plate & joist replacement\nSeismic & wind load reinforcement",
                    ],
                    [
                        'icon_type' => 'paint',
                        'title' => 'Interior Finishing',
                        'subtitle' => 'Trim, Millwork & Detail',
                        'description' => "True master craftsmanship is revealed in the final eighth of an inch. Our interior finishing services bring museum-quality carpentry, custom cabinetry, and exquisite trim work to every room.",
                        'features_list' => "Custom crown molding & baseboards\nBuilt-in cabinetry & bookcases\nHardwood flooring installation & refinishing\nCustom interior doors & hardware\nPlaster restoration & fine drywall",
                    ],
                    [
                        'icon_type' => 'ruler',
                        'title' => 'Project Management',
                        'subtitle' => 'Planning & Coordination',
                        'description' => "A great build requires flawless execution from day one. Danny personally manages every phase of your project, coordinating vetted subcontractors, managing municipal inspections, and keeping you informed.",
                        'features_list' => "Full permit acquisition & town filings\nSubcontractor vetting & direct oversight\nDetailed timeline & milestone tracking\nTransparent material sourcing & budgets\nDaily job site supervision by Danny",
                    ],
                    [
                        'icon_type' => 'shield',
                        'title' => 'Maintenance & Repair',
                        'subtitle' => 'Ongoing Property Care',
                        'description' => "Preserving the value and safety of your property requires experienced eyes. We offer comprehensive assessment, repair, and ongoing care services for fine residential properties throughout Greater Boston.",
                        'features_list' => "Seasonal exterior & roof assessments\nMasonry repointing & chimney repair\nWindow & door weatherization\nRot repair & moisture remediation\nEmergency structural repairs",
                    ],
                ],
                'title_field' => '{{{ title }}} ({{{ subtitle }}})',
            ]
        );

        $this->end_controls_section();

        // Bottom CTA
        $this->start_controls_section(
            'section_bottom_cta',
            [
                'label' => esc_html__('Bottom CTA', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'cta_text',
            [
                'label' => esc_html__('Prompt Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Every project begins with a conversation.',
            ]
        );

        $this->add_control(
            'btn_text',
            [
                'label' => esc_html__('Button Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Discuss Your Project',
            ]
        );

        $this->add_control(
            'btn_link',
            [
                'label' => esc_html__('Button Link', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'default' => ['url' => home_url('/contact')],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();
        ?>
        <style>
            #services-ledger-<?php echo esc_attr($widget_id); ?> {
                background-color: #FDFCF8 !important;
            }
            #services-ledger-<?php echo esc_attr($widget_id); ?> .ledger-btn {
                width: 100% !important;
                display: flex !important;
                align-items: center !important;
                gap: 1.5rem !important;
                padding-top: 2rem !important;
                padding-bottom: 2rem !important;
                text-align: left !important;
                background: transparent !important;
                border: none !important;
                cursor: pointer !important;
                outline: none !important;
            }
            #services-ledger-<?php echo esc_attr($widget_id); ?> .ledger-icon-box {
                width: 3rem !important;
                height: 3rem !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                flex-shrink: 0 !important;
                transition: background-color 0.3s ease !important;
            }
            #services-ledger-<?php echo esc_attr($widget_id); ?> .ledger-item.is-open .ledger-icon-box {
                background-color: #1f2c2c !important;
            }
            #services-ledger-<?php echo esc_attr($widget_id); ?> .ledger-item.is-open .ledger-icon-box svg {
                color: #93846f !important;
            }
            #services-ledger-<?php echo esc_attr($widget_id); ?> .ledger-item:not(.is-open) .ledger-icon-box {
                background-color: rgba(31, 44, 44, 0.05) !important;
            }
            #services-ledger-<?php echo esc_attr($widget_id); ?> .ledger-item:not(.is-open):hover .ledger-icon-box {
                background-color: rgba(31, 44, 44, 0.1) !important;
            }
            #services-ledger-<?php echo esc_attr($widget_id); ?> .ledger-item:not(.is-open) .ledger-icon-box svg {
                color: #1f2c2c !important;
            }
            #services-ledger-<?php echo esc_attr($widget_id); ?> .ledger-item.is-open .ledger-chevron {
                transform: rotate(180deg) !important;
                color: #93846f !important;
            }
            #services-ledger-<?php echo esc_attr($widget_id); ?> .ledger-item:not(.is-open) .ledger-chevron {
                transform: rotate(0deg) !important;
                color: #93846f !important;
            }
            #services-ledger-<?php echo esc_attr($widget_id); ?> .ledger-item.is-open .ledger-body {
                display: block !important;
            }
            #services-ledger-<?php echo esc_attr($widget_id); ?> .ledger-item:not(.is-open) .ledger-body {
                display: none !important;
            }
            #services-ledger-<?php echo esc_attr($widget_id); ?> .service-title {
                font-family: "Fraunces", Georgia, serif !important;
                font-size: 1.5rem !important;
                line-height: 2rem !important;
                font-weight: 600 !important;
                color: #1f2c2c !important;
                margin: 0 !important;
            }
            #services-ledger-<?php echo esc_attr($widget_id); ?> .service-sub {
                color: #93846f !important;
                font-size: 0.875rem !important;
                line-height: 1.25rem !important;
                letter-spacing: 0.05em !important;
                margin-top: 0.25rem !important;
                margin-bottom: 0 !important;
            }
        </style>

        <section class="py-16 md:py-24 bg-[#FDFCF8] w-full" id="services-ledger-<?php echo esc_attr($widget_id); ?>">
            <div class="max-w-4xl mx-auto px-6 md:px-8">
                <div class="border-t border-[#93846f]/20">
                    <?php 
                    $default_ledger_items = [
                        [
                            'icon_type' => 'house',
                            'title' => 'New Construction',
                            'subtitle' => 'Custom Homes & Additions',
                            'description' => "From initial blueprints to final walkthrough, Danny O'Connor brings thirty years of structural knowledge to every new build. We specialize in custom homes that reflect New England's architectural heritage while incorporating modern engineering standards.",
                            'features_list' => "Custom single and multi-family homes\nRoom additions and extensions\nGarage and outbuilding construction\nFoundation work and site preparation\nFull permit management",
                        ],
                        [
                            'icon_type' => 'wrench',
                            'title' => 'Remodeling & Renovations',
                            'subtitle' => 'Kitchens, Baths & Living Spaces',
                            'description' => "Our renovation work respects the bones of existing structures while breathing new life into every room. From historic brownstone restorations to contemporary kitchen overhauls, we transform spaces with precision.",
                            'features_list' => "Gourmet kitchen redesign & installation\nLuxury master bath transformations\nWhole-home gut renovations\nHistoric home restorations\nBasement finishing & conversions",
                        ],
                        [
                            'icon_type' => 'hammer',
                            'title' => 'Structural Engineering',
                            'subtitle' => 'Foundations & Framing',
                            'description' => "The integrity of any building begins below ground. Danny O'Connor's deep structural background ensures that foundation work, load-bearing modifications, and structural framing exceed building codes.",
                            'features_list' => "Foundation repair & underpinning\nLoad-bearing wall removal & beam installation\nStructural framing & timber work\nSill plate & joist replacement\nSeismic & wind load reinforcement",
                        ],
                        [
                            'icon_type' => 'paint',
                            'title' => 'Interior Finishing',
                            'subtitle' => 'Trim, Millwork & Detail',
                            'description' => "True master craftsmanship is revealed in the final eighth of an inch. Our interior finishing services bring museum-quality carpentry, custom cabinetry, and exquisite trim work to every room.",
                            'features_list' => "Custom crown molding & baseboards\nBuilt-in cabinetry & bookcases\nHardwood flooring installation & refinishing\nCustom interior doors & hardware\nPlaster restoration & fine drywall",
                        ],
                        [
                            'icon_type' => 'ruler',
                            'title' => 'Project Management',
                            'subtitle' => 'Planning & Coordination',
                            'description' => "A great build requires flawless execution from day one. Danny personally manages every phase of your project, coordinating vetted subcontractors, managing municipal inspections, and keeping you informed.",
                            'features_list' => "Full permit acquisition & town filings\nSubcontractor vetting & direct oversight\nDetailed timeline & milestone tracking\nTransparent material sourcing & budgets\nDaily job site supervision by Danny",
                        ],
                        [
                            'icon_type' => 'shield',
                            'title' => 'Maintenance & Repair',
                            'subtitle' => 'Ongoing Property Care',
                            'description' => "Preserving the value and safety of your property requires experienced eyes. We offer comprehensive assessment, repair, and ongoing care services for fine residential properties throughout Greater Boston.",
                            'features_list' => "Seasonal exterior & roof assessments\nMasonry repointing & chimney repair\nWindow & door weatherization\nRot repair & moisture remediation\nEmergency structural repairs",
                        ],
                    ];

                    $ledger_items = !empty($settings['ledger_items']) ? $settings['ledger_items'] : $default_ledger_items;

                    foreach ($ledger_items as $index => $item): 
                        $is_first = ($index === 0);
                        $features_str = isset($item['features_list']) ? $item['features_list'] : '';
                        $lines = array_filter(array_map('trim', explode("\n", $features_str)));
                    ?>
                    <div class="ledger-item border-b border-[#93846f]/20 <?php echo $is_first ? 'is-open' : ''; ?>">
                        <button class="ledger-btn group">
                            <div class="ledger-icon-box">
                                <?php if ($item['icon_type'] === 'wrench'): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"></path></svg>
                                <?php elseif ($item['icon_type'] === 'hammer'): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 12-8.373 8.373a1 1 0 1 1-3-3L12 9"></path><path d="m18 15 4-4"></path><path d="m21.5 11.5-1.914-1.914A2 2 0 0 1 19 8.172V7l-2.26-2.26a6 6 0 0 0-4.202-1.756L9 2.96l.92.82A6.18 6.18 0 0 1 12 8.4V10l2 2h1.172a2 2 0 0 1 1.414.586L18.5 14.5"></path></svg>
                                <?php elseif ($item['icon_type'] === 'paint'): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m19 11-8-8-8.6 8.6a2 2 0 0 0 0 2.8l5.2 5.2c.8.8 2 .8 2.8 0L19 11Z"></path><path d="m5 2 5 5"></path><path d="M2 13h15"></path><path d="M22 20a2 2 0 1 1-4 0c0-1.6 1.7-2.4 2-4 .3 1.6 2 2.4 2 4Z"></path></svg>
                                <?php elseif ($item['icon_type'] === 'ruler'): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21.3 15.3a2.4 2.4 0 0 1 0 3.4l-2.6 2.6a2.4 2.4 0 0 1-3.4 0L2.7 8.7a2.41 2.41 0 0 1 0-3.4l2.6-2.6a2.41 2.41 0 0 1 3.4 0Z"></path><path d="m14.5 12.5 2-2"></path><path d="m11.5 9.5 2-2"></path><path d="m8.5 6.5 2-2"></path><path d="m17.5 15.5 2-2"></path></svg>
                                <?php elseif ($item['icon_type'] === 'shield'): ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M20 13c0 5-3.5 7.5-7.66 8.95a1 1 0 0 1-.67-.01C7.5 20.5 4 18 4 13V6a1 1 0 0 1 1-1c2 0 4.5-1.2 6.24-2.72a1.17 1.17 0 0 1 1.52 0C14.51 3.81 17 5 19 5a1 1 0 0 1 1 1z"></path><path d="m9 12 2 2 4-4"></path></svg>
                                <?php else: ?>
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M15 21v-8a1 1 0 0 0-1-1h-4a1 1 0 0 0-1 1v8"></path><path d="M3 10a2 2 0 0 1 .709-1.528l7-5.999a2 2 0 0 1 2.582 0l7 5.999A2 2 0 0 1 21 10v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path></svg>
                                <?php endif; ?>
                            </div>

                            <div style="flex: 1;">
                                <h3 class="service-title"><?php echo esc_html($item['title']); ?></h3>
                                <p class="service-sub"><?php echo esc_html($item['subtitle']); ?></p>
                            </div>

                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="ledger-chevron transition-transform duration-300 shrink-0"><path d="m6 9 6 6 6-6"></path></svg>
                        </button>

                        <div class="ledger-body overflow-hidden pb-8 pl-0 md:pl-[4.5rem]">
                            <p class="text-[#1A1A1A]/70 text-base leading-relaxed mb-6 max-w-2xl">
                                <?php echo esc_html($item['description']); ?>
                            </p>

                            <?php if (!empty($lines)): ?>
                            <ul class="grid grid-cols-1 sm:grid-cols-2 gap-3" style="list-style: none; padding: 0; margin: 0;">
                                <?php foreach ($lines as $line): ?>
                                <li class="flex items-start gap-3 text-sm text-[#1A1A1A]/60">
                                    <span class="block w-1.5 h-1.5 bg-[#93846f] rounded-full mt-1.5 shrink-0" style="width: 6px; height: 6px; border-radius: 50%; background-color: #93846f; margin-top: 6px; flex-shrink: 0;"></span>
                                    <?php echo esc_html($line); ?>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php 
                        endforeach; 
                    ?>
                </div>

                <!-- Bottom CTA -->
                <?php if (!empty($settings['btn_text'])): ?>
                <div class="mt-16 text-center">
                    <p class="text-[#1A1A1A]/60 text-base mb-6"><?php echo esc_html($settings['cta_text']); ?></p>
                    <a class="hero-btn-primary amac-btn-primary inline-flex items-center justify-center gap-3 px-8 py-4 bg-[#1f2c2c] text-[#FDFCF8] text-sm tracking-[0.2em] uppercase transition-all duration-300 group" href="<?php echo esc_url($settings['btn_link']['url']); ?>" <?php echo $settings['btn_link']['is_external'] ? 'target="_blank"' : ''; ?> style="text-decoration: none;">
                        <?php echo esc_html($settings['btn_text']); ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 group-hover:translate-x-1 transition-transform"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                    </a>
                </div>
                <?php endif; ?>
            </div>
        </section>

        <script>
        (function() {
            const section = document.getElementById('services-ledger-<?php echo esc_attr($widget_id); ?>');
            if (!section) return;

            const items = section.querySelectorAll('.ledger-item');

            items.forEach(item => {
                const btn = item.querySelector('.ledger-btn');
                if (!btn) return;

                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const wasOpen = item.classList.contains('is-open');

                    // Close all
                    items.forEach(i => i.classList.remove('is-open'));

                    // Toggle clicked
                    if (!wasOpen) {
                        item.classList.add('is-open');
                    }
                });
            });
        })();
        </script>
        <?php
    }
}
