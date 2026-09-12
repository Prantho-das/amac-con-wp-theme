<?php
if (!defined('ABSPATH')) exit;

class AMAC_Portfolio_Gallery_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'amac_portfolio_gallery';
    }

    public function get_title() {
        return esc_html__('AMAC Portfolio Gallery', 'amac-builders');
    }

    public function get_icon() {
        return 'eicon-gallery-masonry';
    }

    public function get_categories() {
        return ['amac-elements'];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'section_projects',
            [
                'label' => esc_html__('Projects Gallery', 'amac-builders'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'title',
            [
                'label' => esc_html__('Project Title', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Victorian Estate Restoration',
            ]
        );

        $repeater->add_control(
            'category',
            [
                'label' => esc_html__('Category', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Remodeling',
            ]
        );

        $repeater->add_control(
            'location',
            [
                'label' => esc_html__('Location', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Brookline, MA',
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => esc_html__('Cover Photo', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'dynamic' => ['active' => true],
                'default' => [
                    'url' => \Elementor\Utils::get_placeholder_image_src(),
                ],
            ]
        );

        $repeater->add_control(
            'gallery_images',
            [
                'label' => esc_html__('Multiple Project Photos (Gallery)', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::GALLERY,
                'dynamic' => ['active' => true],
                'default' => [],
                'description' => esc_html__('Select multiple photos for this project. They will appear in the 75% expansion modal when clicked.', 'amac-builders'),
            ]
        );

        $repeater->add_control(
            'description',
            [
                'label' => esc_html__('Project Description', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXTAREA,
                'dynamic' => ['active' => true],
                'default' => 'Comprehensive master restoration including structural integrity framing, custom architectural millwork, and refined finishes throughout.',
            ]
        );

        $repeater->add_control(
            'button_text',
            [
                'label' => esc_html__('Modal Button Text', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'dynamic' => ['active' => true],
                'default' => 'Request Similar Project',
            ]
        );

        $repeater->add_control(
            'project_link',
            [
                'label' => esc_html__('Modal Button Link', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'placeholder' => esc_html__('https://yourlink.com, #contact, or /contact.html', 'amac-builders'),
                'default' => [
                    'url' => '#contact',
                    'is_external' => false,
                    'nofollow' => false,
                ],
            ]
        );

        $this->add_control(
            'projects_list',
            [
                'label' => esc_html__('Projects List', 'amac-builders'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'title' => 'Victorian Estate Restoration',
                        'category' => 'remodeling',
                        'location' => 'Brookline, MA',
                        'description' => 'Comprehensive restoration honoring original architectural heritage while upgrading structural systems and modernizing luxury living spaces.',
                    ],
                    [
                        'title' => 'Contemporary Custom Home',
                        'category' => 'new-construction',
                        'location' => 'Newton, MA',
                        'description' => 'Ground-up custom luxury residence engineered with sustainable materials, seamless open layouts, and master-crafted masonry.',
                    ],
                    [
                        'title' => 'Historic Foundation & Framing',
                        'category' => 'structural',
                        'location' => 'Cambridge, MA',
                        'description' => 'Specialized foundation stabilization, precision timber framing, and load-bearing reinforcement for a century-old historic landmark.',
                    ],
                    [
                        'title' => 'Custom Millwork & Library',
                        'category' => 'finishing',
                        'location' => 'Wellesley, MA',
                        'description' => 'Handcrafted solid oak cabinetry, coffered ceiling detailing, and custom architectural library shelving tailored to perfection.',
                    ],
                ],
                'title_field' => '{{{ title }}} ({{{ category }}})',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $widget_id = $this->get_id();
        ?>
        <style>
            #portfolio-section-<?php echo esc_attr($widget_id); ?> .portfolio-filters {
                display: flex !important;
                flex-wrap: wrap !important;
                gap: 12px !important;
                margin-bottom: 48px !important;
            }
            #portfolio-section-<?php echo esc_attr($widget_id); ?> .filter-btn {
                background: transparent;
                border: 1px solid rgba(147, 132, 111, 0.3) !important;
                color: rgba(26, 26, 26, 0.6) !important;
                cursor: pointer;
                outline: none;
                transition: all 0.3s ease;
                padding: 10px 22px !important;
                font-size: 12px !important;
                letter-spacing: 0.2em !important;
                text-transform: uppercase !important;
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                white-space: nowrap !important;
            }
            #portfolio-section-<?php echo esc_attr($widget_id); ?> .filter-btn:hover {
                border-color: #93846f !important;
                color: #1f2c2c !important;
                background: transparent !important;
            }
            #portfolio-section-<?php echo esc_attr($widget_id); ?> .filter-btn.is-active {
                background-color: #1f2c2c !important;
                color: #FDFCF8 !important;
                border-color: #1f2c2c !important;
            }
            #portfolio-section-<?php echo esc_attr($widget_id); ?> .portfolio-card {
                background-color: #F5F1EB;
                border: 1px solid rgba(147, 132, 111, 0.2);
                transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                cursor: pointer;
                position: relative;
            }
            #portfolio-section-<?php echo esc_attr($widget_id); ?> .portfolio-card:hover {
                border-color: #93846f;
                transform: translateY(-4px);
                box-shadow: 0 16px 32px -8px rgba(31, 44, 44, 0.12);
            }
            #portfolio-section-<?php echo esc_attr($widget_id); ?> .photo-count-badge {
                display: none !important;
                visibility: hidden !important;
                opacity: 0 !important;
                pointer-events: none !important;
            }
            #portfolio-section-<?php echo esc_attr($widget_id); ?> .card-slider-wrap {
                position: relative;
                overflow: hidden;
            }
            #portfolio-section-<?php echo esc_attr($widget_id); ?> .card-slide-img {
                position: absolute;
                inset: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                transition: opacity 0.6s cubic-bezier(0.4, 0, 0.2, 1), transform 0.7s cubic-bezier(0.4, 0, 0.2, 1);
            }
            /* 75% Expansion Modal Styles */
            #amac-modal-<?php echo esc_attr($widget_id); ?> {
                display: none;
                position: fixed;
                inset: 0;
                z-index: 99999;
                background: rgba(15, 15, 15, 0.88);
                backdrop-filter: blur(8px);
                -webkit-backdrop-filter: blur(8px);
                align-items: center;
                justify-content: center;
                padding: 24px;
                box-sizing: border-box;
                opacity: 0;
                transition: opacity 0.3s ease;
            }
            #amac-modal-<?php echo esc_attr($widget_id); ?>.is-active {
                display: flex;
                opacity: 1;
            }
            #amac-modal-<?php echo esc_attr($widget_id); ?> .modal-content-75 {
                width: 75vw;
                max-width: 1200px;
                max-height: 90vh;
                background: #1A1A1A;
                border: 1px solid rgba(147, 132, 111, 0.5);
                box-shadow: 0 25px 60px rgba(0, 0, 0, 0.6);
                display: flex;
                flex-direction: column;
                overflow: hidden;
                position: relative;
                transform: scale(0.95);
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            }
            #amac-modal-<?php echo esc_attr($widget_id); ?>.is-active .modal-content-75 {
                transform: scale(1);
            }
            #amac-modal-<?php echo esc_attr($widget_id); ?> .modal-header {
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 20px 28px;
                border-bottom: 1px solid rgba(147, 132, 111, 0.2);
                background: #151515;
            }
            #amac-modal-<?php echo esc_attr($widget_id); ?> .modal-body {
                display: grid;
                grid-template-columns: 1fr 340px;
                overflow: hidden !important;
                flex: 1;
                max-height: calc(90vh - 70px);
            }
            #amac-modal-<?php echo esc_attr($widget_id); ?> .gallery-main-view {
                position: relative;
                background: #0D0D0D;
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                padding: 16px;
                overflow: hidden !important;
                height: 100%;
                box-sizing: border-box;
            }
            #amac-modal-<?php echo esc_attr($widget_id); ?> .main-modal-img {
                max-height: 50vh !important;
                width: auto;
                max-width: 100%;
                object-fit: contain;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
                transition: opacity 0.25s ease;
            }
            #amac-modal-<?php echo esc_attr($widget_id); ?> .modal-nav-btn {
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                background: rgba(31, 44, 44, 0.8);
                color: #FDFCF8;
                border: 1px solid rgba(147, 132, 111, 0.4);
                width: 44px;
                height: 44px;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: all 0.2s ease;
                z-index: 10;
            }
            #amac-modal-<?php echo esc_attr($widget_id); ?> .modal-nav-btn:hover {
                background: #2a3d3d;
                border-color: #93846f;
                transform: translateY(-50%) scale(1.1);
            }
            #amac-modal-<?php echo esc_attr($widget_id); ?> .modal-nav-prev { left: 16px; }
            #amac-modal-<?php echo esc_attr($widget_id); ?> .modal-nav-next { right: 16px; }
            #amac-modal-<?php echo esc_attr($widget_id); ?> .thumbnails-strip {
                display: flex;
                gap: 8px;
                padding: 12px 16px 4px;
                overflow-x: auto !important;
                overflow-y: hidden !important;
                max-width: 100%;
                box-sizing: border-box;
                scrollbar-width: none !important;
                -ms-overflow-style: none !important;
            }
            #amac-modal-<?php echo esc_attr($widget_id); ?> .thumbnails-strip::-webkit-scrollbar {
                display: none !important;
                height: 0px !important;
                width: 0px !important;
            }
            #amac-modal-<?php echo esc_attr($widget_id); ?> .thumb-img {
                width: 64px;
                height: 48px;
                object-fit: cover;
                cursor: pointer;
                border: 1px solid rgba(255, 255, 255, 0.2);
                opacity: 0.5;
                transition: all 0.2s ease;
                flex-shrink: 0;
            }
            #amac-modal-<?php echo esc_attr($widget_id); ?> .thumb-img.is-active,
            #amac-modal-<?php echo esc_attr($widget_id); ?> .thumb-img:hover {
                border-color: #93846f;
                opacity: 1;
                transform: scale(1.05);
            }
            #amac-modal-<?php echo esc_attr($widget_id); ?> .modal-sidebar {
                padding: 28px;
                background: #1A1A1A;
                border-left: 1px solid rgba(147, 132, 111, 0.15);
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                overflow-y: auto !important;
                box-sizing: border-box;
            }
            #amac-modal-<?php echo esc_attr($widget_id); ?> .modal-action-btn {
                background-color: #1f2c2c !important;
                color: #FFFFFF !important;
                border: 1px solid #93846f !important;
                padding: 14px 20px !important;
                font-size: 12px !important;
                letter-spacing: 0.2em !important;
                text-transform: uppercase !important;
                font-weight: 600 !important;
                text-decoration: none !important;
                display: flex !important;
                align-items: center !important;
                justify-content: center !important;
                gap: 10px !important;
                width: 100% !important;
                box-sizing: border-box !important;
                transition: transform 0.3s cubic-bezier(0.4, 0, 0.2, 1), background-color 0.3s ease, box-shadow 0.3s ease, color 0.3s ease !important;
                box-shadow: 0 4px 14px rgba(0, 0, 0, 0.4) !important;
            }
            #amac-modal-<?php echo esc_attr($widget_id); ?> .modal-action-btn:hover {
                background-color: #2a3d3d !important;
                color: #FFFFFF !important;
                border-color: #a69580 !important;
                transform: scale(1.04) !important;
                box-shadow: 0 8px 24px rgba(31, 44, 44, 0.5) !important;
            }
            #amac-modal-<?php echo esc_attr($widget_id); ?> .modal-action-btn span,
            #amac-modal-<?php echo esc_attr($widget_id); ?> .modal-action-btn svg {
                color: #FFFFFF !important;
                stroke: #FFFFFF !important;
            }
            #amac-modal-<?php echo esc_attr($widget_id); ?> .modal-close-btn {
                background: transparent;
                border: none;
                color: #93846f;
                font-size: 24px;
                cursor: pointer;
                padding: 4px 8px;
                transition: transform 0.2s ease, color 0.2s ease;
            }
            #amac-modal-<?php echo esc_attr($widget_id); ?> .modal-close-btn:hover {
                color: #FDFCF8;
                transform: scale(1.2);
            }
            @media (max-width: 900px) {
                #amac-modal-<?php echo esc_attr($widget_id); ?> .modal-content-75 {
                    width: 95vw !important;
                    max-height: 94vh !important;
                }
                #amac-modal-<?php echo esc_attr($widget_id); ?> .modal-body {
                    grid-template-columns: 1fr !important;
                }
                #amac-modal-<?php echo esc_attr($widget_id); ?> .modal-sidebar {
                    border-left: none !important;
                    border-top: 1px solid rgba(147, 132, 111, 0.15) !important;
                    padding: 20px !important;
                }
            }
            @media (max-width: 768px) {
                #portfolio-section-<?php echo esc_attr($widget_id); ?> .portfolio-filters {
                    flex-wrap: nowrap !important;
                    overflow-x: auto !important;
                    -webkit-overflow-scrolling: touch !important;
                    scrollbar-width: none !important;
                    gap: 8px !important;
                    margin-bottom: 28px !important;
                    padding-bottom: 8px !important;
                    width: 100% !important;
                }
                #portfolio-section-<?php echo esc_attr($widget_id); ?> .portfolio-filters::-webkit-scrollbar {
                    display: none !important;
                }
                #portfolio-section-<?php echo esc_attr($widget_id); ?> .filter-btn {
                    flex-shrink: 0 !important;
                    padding: 8px 14px !important;
                    font-size: 11px !important;
                    letter-spacing: 0.15em !important;
                }
            }
        </style>

        <section class="py-16 md:py-24 bg-[#FDFCF8]" id="portfolio-section-<?php echo esc_attr($widget_id); ?>">
            <div class="max-w-7xl mx-auto px-6 md:px-8">
                <?php 
                $category_labels = [
                    'remodeling' => 'Remodeling',
                    'new-construction' => 'New Construction',
                    'structural' => 'Structural',
                    'finishing' => 'Finishing',
                    'maintenance' => 'Maintenance',
                ];

                $default_projects = [
                    [
                        'title' => 'Victorian Estate Restoration',
                        'category' => 'remodeling',
                        'location' => 'Brookline, MA',
                        'description' => 'Comprehensive restoration honoring original architectural heritage while upgrading structural systems and modernizing luxury living spaces.',
                    ],
                    [
                        'title' => 'Contemporary Custom Home',
                        'category' => 'new-construction',
                        'location' => 'Newton, MA',
                        'description' => 'Ground-up custom luxury residence engineered with sustainable materials, seamless open layouts, and master-crafted masonry.',
                    ],
                    [
                        'title' => 'Historic Foundation & Framing',
                        'category' => 'structural',
                        'location' => 'Cambridge, MA',
                        'description' => 'Specialized foundation stabilization, precision timber framing, and load-bearing reinforcement for a century-old historic landmark.',
                    ],
                    [
                        'title' => 'Custom Millwork & Library',
                        'category' => 'finishing',
                        'location' => 'Wellesley, MA',
                        'description' => 'Handcrafted solid oak cabinetry, coffered ceiling detailing, and custom architectural library shelving tailored to perfection.',
                    ],
                ];

                $projects_list = !empty($settings['projects_list']) ? $settings['projects_list'] : $default_projects;

                $dynamic_categories = [];
                foreach ($projects_list as $p_item) {
                    if (!empty($p_item['category'])) {
                        $raw_c = trim($p_item['category']);
                        $c_slug = sanitize_title($raw_c);
                        $c_label = isset($category_labels[$raw_c]) ? $category_labels[$raw_c] : (isset($category_labels[$c_slug]) ? $category_labels[$c_slug] : ucwords(str_replace(['-', '_'], ' ', $raw_c)));
                        $dynamic_categories[$c_slug] = $c_label;
                    }
                }

                // Process project dataset for JS modal
                $projects_data = [];
                ?>
                <!-- Filter Buttons -->
                <div class="portfolio-filters">
                    <button class="filter-btn is-active" data-filter="all">All Projects</button>
                    <?php foreach ($dynamic_categories as $c_slug => $c_label): ?>
                        <button class="filter-btn" data-filter="<?php echo esc_attr($c_slug); ?>"><?php echo esc_html($c_label); ?></button>
                    <?php endforeach; ?>
                </div>

                <!-- Projects Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 portfolio-grid">
                    <?php 
                    foreach ($projects_list as $index => $item): 
                        $img_url = !empty($item['image']['url']) ? $item['image']['url'] : '';
                        $raw_cat = !empty($item['category']) ? trim($item['category']) : '';
                        $cat_slug = sanitize_title($raw_cat);
                        $cat_label = isset($category_labels[$raw_cat]) ? $category_labels[$raw_cat] : (isset($category_labels[$cat_slug]) ? $category_labels[$cat_slug] : ucwords(str_replace(['-', '_'], ' ', $raw_cat)));
                        
                        // Collect all photos (cover + gallery)
                        $all_photos = [];
                        if (!empty($img_url)) {
                            $all_photos[] = $img_url;
                        }
                        if (!empty($item['gallery_images']) && is_array($item['gallery_images'])) {
                            foreach ($item['gallery_images'] as $g_img) {
                                if (!empty($g_img['url']) && !in_array($g_img['url'], $all_photos)) {
                                    $all_photos[] = $g_img['url'];
                                }
                            }
                        }

                        $desc = !empty($item['description']) ? $item['description'] : '';
                        $link_url = !empty($item['project_link']['url']) ? $item['project_link']['url'] : '#contact';
                        $is_ext = !empty($item['project_link']['is_external']) ? true : false;
                        $btn_txt = !empty($item['button_text']) ? $item['button_text'] : 'Request Similar Project';
                        
                        $projects_data[$index] = [
                            'title' => $item['title'],
                            'category' => $cat_label,
                            'location' => $item['location'],
                            'description' => $desc,
                            'photos' => $all_photos,
                            'link' => $link_url,
                            'is_external' => $is_ext,
                            'button_text' => $btn_txt,
                        ];

                        $photo_count = count($all_photos);
                        $title_key = $this->get_repeater_setting_key('title', 'projects_list', $index);
                        $this->add_inline_editing_attributes($title_key, 'none');
                    ?>
                    <div class="portfolio-card portfolio-item group overflow-hidden" data-category="<?php echo esc_attr($cat_slug); ?>" data-project-idx="<?php echo esc_attr($index); ?>">
                        <div class="aspect-[4/3] overflow-hidden relative card-slider-wrap">
                            <?php if (!empty($all_photos)): ?>
                                <?php foreach ($all_photos as $p_i => $p_url): ?>
                                    <img src="<?php echo esc_url($p_url); ?>" 
                                         alt="<?php echo esc_attr($item['title']); ?>" 
                                         class="card-slide-img absolute inset-0 w-full h-full object-cover transition-all duration-700 <?php echo $p_i === 0 ? 'opacity-100 scale-100 z-10' : 'opacity-0 scale-105 z-0'; ?>" 
                                         data-slide-index="<?php echo esc_attr($p_i); ?>">
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="w-full h-full bg-[#1f2c2c]/5 flex items-center justify-center text-[#93846f]/40">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"></rect><circle cx="9" cy="9" r="2"></circle><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path></svg>
                                </div>
                            <?php endif; ?>

                            <span class="absolute top-4 left-4 px-3 py-1 bg-[#1f2c2c] text-[#FDFCF8] text-[10px] tracking-[0.2em] uppercase font-semibold z-20">
                                <?php echo esc_html($cat_label); ?>
                            </span>

                            <?php if ($photo_count > 1): ?>
                            <div class="slide-dots absolute bottom-3 left-1/2 -translate-x-1/2 flex items-center gap-1.5 z-20 opacity-0 group-hover:opacity-100 transition-opacity duration-300 pointer-events-none">
                                <?php for ($d = 0; $d < $photo_count; $d++): ?>
                                    <span class="slide-dot h-1.5 rounded-full transition-all duration-300 <?php echo $d === 0 ? 'bg-[#93846f] w-3.5' : 'bg-white/60 w-1.5'; ?>"></span>
                                <?php endfor; ?>
                            </div>
                            <?php endif; ?>
                        </div>
                        <div class="p-6 flex items-center justify-between">
                            <div>
                                <h3 class="font-display text-xl text-[#1f2c2c] font-semibold mb-2" <?php echo $this->get_render_attribute_string($title_key); ?>><?php echo esc_html($item['title']); ?></h3>
                                <p class="text-[#93846f] text-xs tracking-wider uppercase"><?php echo esc_html($item['location']); ?></p>
                            </div>
                            <span class="text-[#1f2c2c] opacity-0 group-hover:opacity-100 transition-opacity transform group-hover:translate-x-1 duration-300">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="9 18 15 12 9 6"></polyline></svg>
                            </span>
                        </div>
                    </div>
                    <?php 
                        endforeach; 
                    ?>
                </div>

                <!-- Empty State Message -->
                <div class="portfolio-empty-state flex flex-col items-center justify-center py-28 gap-4 hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-10 h-10 text-[#93846f]/30"><rect width="18" height="18" x="3" y="3" rx="2" ry="2"></rect><circle cx="9" cy="9" r="2"></circle><path d="m21 15-3.086-3.086a2 2 0 0 0-2.828 0L6 21"></path></svg>
                    <p class="text-[#1A1A1A]/40 text-sm">No projects in this category yet.</p>
                </div>
            </div>
        </section>

        <!-- 75% Width Project Expansion Modal -->
        <div id="amac-modal-<?php echo esc_attr($widget_id); ?>" class="amac-portfolio-modal-overlay">
            <div class="modal-content-75">
                <div class="modal-header">
                    <div class="flex items-center gap-3">
                        <span id="amac-modal-cat-<?php echo esc_attr($widget_id); ?>" class="px-3 py-1 bg-[#1f2c2c] text-[#FDFCF8] text-[10px] tracking-[0.2em] uppercase font-semibold"></span>
                        <h3 id="amac-modal-title-<?php echo esc_attr($widget_id); ?>" class="font-display text-xl text-[#FDFCF8] font-semibold m-0"></h3>
                    </div>
                    <button class="modal-close-btn" aria-label="Close modal">&times;</button>
                </div>

                <div class="modal-body">
                    <!-- Left: Large Gallery View with Next/Prev and Thumbnails -->
                    <div class="gallery-main-view">
                        <button class="modal-nav-btn modal-nav-prev" aria-label="Previous photo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m15 18-6-6 6-6"/></svg>
                        </button>
                        <img id="amac-modal-main-img-<?php echo esc_attr($widget_id); ?>" src="" alt="Project detail" class="main-modal-img">
                        <button class="modal-nav-btn modal-nav-next" aria-label="Next photo">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="m9 18 6-6-6-6"/></svg>
                        </button>

                        <div id="amac-modal-thumbs-<?php echo esc_attr($widget_id); ?>" class="thumbnails-strip"></div>
                    </div>

                    <!-- Right: Project Sidebar Info -->
                    <div class="modal-sidebar">
                        <div>
                            <p class="text-[#93846f] text-xs tracking-[0.25em] uppercase font-medium mb-1">Location</p>
                            <p id="amac-modal-loc-<?php echo esc_attr($widget_id); ?>" class="text-[#FDFCF8] text-base mb-6"></p>

                            <p class="text-[#93846f] text-xs tracking-[0.25em] uppercase font-medium mb-2">Project Overview</p>
                            <p id="amac-modal-desc-<?php echo esc_attr($widget_id); ?>" class="text-[#FDFCF8]/70 text-sm leading-relaxed mb-6"></p>
                        </div>

                        <div class="pt-6 border-t border-[#93846f]/20">
                            <a id="amac-modal-btn-<?php echo esc_attr($widget_id); ?>" href="#contact" class="modal-action-btn">
                                <span id="amac-modal-btn-text-<?php echo esc_attr($widget_id); ?>">Request Similar Project</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"></path><path d="m12 5 7 7-7 7"></path></svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
        (function() {
            const section = document.getElementById('portfolio-section-<?php echo esc_attr($widget_id); ?>');
            const modal = document.getElementById('amac-modal-<?php echo esc_attr($widget_id); ?>');
            if (!section || !modal) return;

            const projectsData = <?php echo wp_json_encode($projects_data); ?>;
            const filterBtns = section.querySelectorAll('.filter-btn');
            const items = section.querySelectorAll('.portfolio-item');
            const emptyState = section.querySelector('.portfolio-empty-state');

            // Modal elements
            const modalTitle = document.getElementById('amac-modal-title-<?php echo esc_attr($widget_id); ?>');
            const modalCat = document.getElementById('amac-modal-cat-<?php echo esc_attr($widget_id); ?>');
            const modalLoc = document.getElementById('amac-modal-loc-<?php echo esc_attr($widget_id); ?>');
            const modalDesc = document.getElementById('amac-modal-desc-<?php echo esc_attr($widget_id); ?>');
            const modalMainImg = document.getElementById('amac-modal-main-img-<?php echo esc_attr($widget_id); ?>');
            const modalThumbs = document.getElementById('amac-modal-thumbs-<?php echo esc_attr($widget_id); ?>');
            const modalBtn = document.getElementById('amac-modal-btn-<?php echo esc_attr($widget_id); ?>');
            const modalBtnText = document.getElementById('amac-modal-btn-text-<?php echo esc_attr($widget_id); ?>');
            const closeBtn = modal.querySelector('.modal-close-btn');
            const prevBtn = modal.querySelector('.modal-nav-prev');
            const nextBtn = modal.querySelector('.modal-nav-next');

            let currentProjectIndex = 0;
            let currentPhotoIndex = 0;
            let currentPhotosList = [];

            function openProjectModal(idx) {
                const data = projectsData[idx];
                if (!data) return;

                currentProjectIndex = idx;
                currentPhotoIndex = 0;
                currentPhotosList = data.photos && data.photos.length > 0 ? data.photos : [''];

                modalTitle.textContent = data.title || '';
                modalCat.textContent = data.category || '';
                modalLoc.textContent = data.location || '';
                modalDesc.textContent = data.description || '';

                if (modalBtn) {
                    modalBtn.href = data.link || '#contact';
                    if (data.is_external) {
                        modalBtn.setAttribute('target', '_blank');
                        modalBtn.setAttribute('rel', 'noopener noreferrer');
                    } else {
                        modalBtn.removeAttribute('target');
                        modalBtn.removeAttribute('rel');
                    }
                }
                if (modalBtnText) {
                    modalBtnText.textContent = data.button_text || 'Request Similar Project';
                }

                updatePhotoView();
                modal.classList.add('is-active');
                document.body.style.overflow = 'hidden';
            }

            function updatePhotoView() {
                const photoSrc = currentPhotosList[currentPhotoIndex] || '';
                modalMainImg.src = photoSrc;

                if (currentPhotosList.length <= 1) {
                    prevBtn.style.display = 'none';
                    nextBtn.style.display = 'none';
                    modalThumbs.style.display = 'none';
                } else {
                    prevBtn.style.display = 'flex';
                    nextBtn.style.display = 'flex';
                    modalThumbs.style.display = 'flex';

                    // Rebuild thumbnails
                    modalThumbs.innerHTML = '';
                    currentPhotosList.forEach((src, pIdx) => {
                        const thumb = document.createElement('img');
                        thumb.src = src;
                        thumb.className = 'thumb-img' + (pIdx === currentPhotoIndex ? ' is-active' : '');
                        thumb.addEventListener('click', () => {
                            currentPhotoIndex = pIdx;
                            updatePhotoView();
                        });
                        modalThumbs.appendChild(thumb);
                    });
                }
            }

            function closeModal() {
                modal.classList.remove('is-active');
                document.body.style.overflow = '';
            }

            // Next / Prev listeners
            prevBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                if (currentPhotosList.length > 1) {
                    currentPhotoIndex = (currentPhotoIndex - 1 + currentPhotosList.length) % currentPhotosList.length;
                    updatePhotoView();
                }
            });

            nextBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                if (currentPhotosList.length > 1) {
                    currentPhotoIndex = (currentPhotoIndex + 1) % currentPhotosList.length;
                    updatePhotoView();
                }
            });

            closeBtn.addEventListener('click', closeModal);
            modal.addEventListener('click', (e) => {
                if (e.target === modal) closeModal();
            });

            document.addEventListener('keydown', (e) => {
                if (!modal.classList.contains('is-active')) return;
                if (e.key === 'Escape') closeModal();
                if (e.key === 'ArrowLeft' && currentPhotosList.length > 1) {
                    currentPhotoIndex = (currentPhotoIndex - 1 + currentPhotosList.length) % currentPhotosList.length;
                    updatePhotoView();
                }
                if (e.key === 'ArrowRight' && currentPhotosList.length > 1) {
                    currentPhotoIndex = (currentPhotoIndex + 1) % currentPhotosList.length;
                    updatePhotoView();
                }
            });

            // Card hover auto-slideshow logic
            items.forEach(card => {
                const slides = card.querySelectorAll('.card-slide-img');
                const dots = card.querySelectorAll('.slide-dot');
                if (slides.length <= 1) return;

                let slideTimer = null;
                let activeSlide = 0;

                function showSlide(idx) {
                    slides.forEach((img, i) => {
                        if (i === idx) {
                            img.classList.remove('opacity-0', 'scale-105', 'z-0');
                            img.classList.add('opacity-100', 'scale-100', 'z-10');
                        } else {
                            img.classList.remove('opacity-100', 'scale-100', 'z-10');
                            img.classList.add('opacity-0', 'scale-105', 'z-0');
                        }
                    });
                    if (dots.length > 0) {
                        dots.forEach((dot, i) => {
                            if (i === idx) {
                                dot.className = 'slide-dot h-1.5 rounded-full transition-all duration-300 bg-[#93846f] w-3.5';
                            } else {
                                dot.className = 'slide-dot h-1.5 rounded-full transition-all duration-300 bg-white/60 w-1.5';
                            }
                        });
                    }
                }

                card.addEventListener('mouseenter', () => {
                    slideTimer = setInterval(() => {
                        activeSlide = (activeSlide + 1) % slides.length;
                        showSlide(activeSlide);
                    }, 1400);
                });

                card.addEventListener('mouseleave', () => {
                    if (slideTimer) clearInterval(slideTimer);
                    activeSlide = 0;
                    showSlide(0);
                });
            });

            // Card click listener
            items.forEach(item => {
                item.addEventListener('click', function() {
                    const idx = parseInt(this.getAttribute('data-project-idx'), 10);
                    openProjectModal(idx);
                });
            });

            // Filter logic
            filterBtns.forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.preventDefault();
                    const filter = this.getAttribute('data-filter');

                    filterBtns.forEach(b => b.classList.remove('is-active'));
                    this.classList.add('is-active');

                    let visibleCount = 0;
                    items.forEach(item => {
                        const itemCat = item.getAttribute('data-category');
                        if (filter === 'all' || itemCat === filter) {
                            item.style.display = 'block';
                            visibleCount++;
                        } else {
                            item.style.display = 'none';
                        }
                    });

                    if (emptyState) {
                        if (visibleCount === 0) {
                            emptyState.classList.remove('hidden');
                        } else {
                            emptyState.classList.add('hidden');
                        }
                    }
                });
            });
        })();
        </script>
        <?php
    }
}
