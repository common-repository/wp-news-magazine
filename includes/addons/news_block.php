<?php
namespace Elementor;


if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class HTMagazine_Elementor_Widget_News_Block extends Widget_Base {

    public function get_name() {
        return 'htmagazine-newsblock';
    }
    
    public function get_title() {
        return __( 'News Block', 'ht-magazine' );
    }

    public function get_icon() {
        return 'htelementor-icon eicon-post-content';
    }
    public function get_categories() {
        return [ 'htnews-addons' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'news_block_content',
            [
                'label' => __( 'News Block', 'ht-magazine' ),
            ]
        );
            $this->add_control(
                'news_block_layout',
                [
                    'label' => __( 'Layout', 'ht-magazine' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => '1',
                    'options' => [
                        '1'   => __( 'Layout One', 'ht-magazine' ),
                        '2'   => __( 'Layout Two', 'ht-magazine' ),
                        '3'   => __( 'Layout Three', 'ht-magazine' ),
                        '4'   => __( 'Layout Four', 'ht-magazine' ),
                    ],
                ]
            );

            $this->add_control(
                'news_block_section_title',
                [
                    'label' => __( 'Section Title', 'ht-magazine' ),
                    'type' => Controls_Manager::TEXT,
                    'placeholder' => __( 'Enter Section Title', 'ht-magazine' ),
                    'condition'=>[
                        'news_block_layout' => array( '2','3','4' )
                    ]
                ]
            );

        $this->end_controls_section();

        // Content Option Start
        $this->start_controls_section(
            'post_content_option',
            [
                'label' => __( 'Post Option', 'ht-magazine' ),
            ]
        );

            $this->add_control(
                'grid_categories',
                [
                    'label' => esc_html__( 'Categories', 'ht-magazine' ),
                    'type' => Controls_Manager::SELECT2,
                    'label_block' => true,
                    'multiple' => true,
                    'options' => htmagazine_get_taxonomies(),
                ]
            );

            $this->add_control(
                'post_limit',
                [
                    'label' => __('Limit', 'ht-magazine'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 4,
                    'separator'=>'before',
                ]
            );

            $this->add_control(
                'custom_order',
                [
                    'label' => esc_html__( 'Custom order', 'ht-magazine' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'postorder',
                [
                    'label' => esc_html__( 'Order', 'ht-magazine' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'DESC',
                    'options' => [
                        'DESC'  => esc_html__('Descending','ht-magazine'),
                        'ASC'   => esc_html__('Ascending','ht-magazine'),
                    ],
                    'condition' => [
                        'custom_order!' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'orderby',
                [
                    'label' => esc_html__( 'Orderby', 'ht-magazine' ),
                    'type' => Controls_Manager::SELECT,
                    'default' => 'none',
                    'options' => [
                        'none'          => esc_html__('None','ht-magazine'),
                        'ID'            => esc_html__('ID','ht-magazine'),
                        'date'          => esc_html__('Date','ht-magazine'),
                        'name'          => esc_html__('Name','ht-magazine'),
                        'title'         => esc_html__('Title','ht-magazine'),
                        'comment_count' => esc_html__('Comment count','ht-magazine'),
                        'rand'          => esc_html__('Random','ht-magazine'),
                    ],
                    'condition' => [
                        'custom_order' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'show_title',
                [
                    'label' => esc_html__( 'Title', 'ht-magazine' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'show_content',
                [
                    'label' => esc_html__( 'Content', 'ht-magazine' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition'=>[
                        'news_block_layout' => array('2','3'),
                    ]
                ]
            );

            $this->add_control(
                'show_category',
                [
                    'label' => esc_html__( 'Category', 'ht-magazine' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition'=>[
                        'news_block_layout' => '1',
                    ]
                ]
            );

            $this->add_control(
                'show_date',
                [
                    'label' => esc_html__( 'Date', 'ht-magazine' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                ]
            );

            $this->add_control(
                'show_readmore',
                [
                    'label' => esc_html__( 'Read More Button', 'ht-magazine' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                ]
            );

            $this->add_control(
                'readmore_buttontxt',
                [
                    'label' => __('Read More Button Text', 'ht-magazine'),
                    'type' => Controls_Manager::TEXT,
                    'separator'=>'before',
                    'condition' => [
                        'show_readmore' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'title_length',
                [
                    'label' => __('Title Lenght', 'ht-magazine'),
                    'type' => Controls_Manager::NUMBER,
                    'default'=> 7,
                    'condition' => [
                        'show_title' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'content_length',
                [
                    'label' => __('Content Lenght', 'ht-magazine'),
                    'type' => Controls_Manager::NUMBER,
                    'default'=> 10,
                    'condition' => [
                        'show_content' => 'yes',
                        'news_block_layout' => array('2','3'),
                    ]
                ]
            );

            $this->add_control(
                'slider_on',
                [
                    'label'         => __( 'Carousel', 'ht-magazine' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'label_on'      => __( 'On', 'ht-magazine' ),
                    'label_off'     => __( 'Off', 'ht-magazine' ),
                    'return_value'  => 'yes',
                    'default'       => 'no',
                    'condition'=> [
                        'news_block_layout'=>'1'
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'news_block_image_size',
                    'default' => 'hashnews_size_270x205',
                    'separator' => 'none',
                    'condition' => [
                        'news_block_layout' => array('1','2'),
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Image_Size::get_type(),
                [
                    'name' => 'news_block_large_image_size',
                    'default' => 'large',
                    'separator' => 'none',
                    'condition' => [
                        'news_block_layout' => array('2','3','4'),
                    ]
                ]
            );

        $this->end_controls_section(); // Content Option End

        // Slider setting
        $this->start_controls_section(
            'carousel_slider_option',
            [
                'label' => esc_html__( 'Carousel Option', 'ht-magazine' ),
                'condition' => [
                    'slider_on' => 'yes',
                ]
            ]
        );

            $this->add_control(
                'slitems',
                [
                    'label' => esc_html__( 'Carousel Items', 'ht-magazine' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 20,
                    'step' => 1,
                    'default' => 8,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slrows',
                [
                    'label' => esc_html__( 'Carousel Row', 'ht-magazine' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 20,
                    'step' => 1,
                    'default' => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slarrows',
                [
                    'label' => esc_html__( 'Carousel Arrow', 'ht-magazine' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slprevicon',
                [
                    'label' => __( 'Previous icon', 'ht-magazine' ),
                    'type' => Controls_Manager::ICONS,
                    'default' => [
                    'value' => 'fas fa-chevron-left',
                    'library' => 'solid',
                    ],
                    'condition' => [
                        'slider_on' => 'yes',
                        'slarrows' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slnexticon',
                [
                    'label' => __( 'Next icon', 'ht-magazine' ),
                    'type' => Controls_Manager::ICONS,                   
                    'default' => [
                    'value' => 'fas fa-chevron-right',
                    'library' => 'solid',
                    ],
                    'condition' => [
                        'slider_on' => 'yes',
                        'slarrows' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sldots',
                [
                    'label' => esc_html__( 'Carousel dots', 'ht-magazine' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slpause_on_hover',
                [
                    'type' => Controls_Manager::SWITCHER,
                    'label_off' => __('No', 'ht-magazine'),
                    'label_on' => __('Yes', 'ht-magazine'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'label' => __('Pause on Hover?', 'ht-magazine'),
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slcentermode',
                [
                    'label' => esc_html__( 'Center Mode', 'ht-magazine' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slcenterpadding',
                [
                    'label' => esc_html__( 'Center padding', 'ht-magazine' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 500,
                    'step' => 1,
                    'default' => 50,
                    'condition' => [
                        'slider_on' => 'yes',
                        'slcentermode' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slautolay',
                [
                    'label' => esc_html__( 'Carousel auto play', 'ht-magazine' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator' => 'before',
                    'default' => 'no',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slautoplay_speed',
                [
                    'label' => __('Autoplay speed', 'ht-magazine'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 3000,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );


            $this->add_control(
                'slanimation_speed',
                [
                    'label' => __('Autoplay animation speed', 'ht-magazine'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 300,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slscroll_columns',
                [
                    'label' => __('Carousel item to scroll', 'ht-magazine'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 10,
                    'step' => 1,
                    'default' => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'heading_tablet',
                [
                    'label' => __( 'Tablet', 'ht-magazine' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sltablet_display_columns',
                [
                    'label' => __('Carousel Items', 'ht-magazine'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 8,
                    'step' => 1,
                    'default' => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sltablet_scroll_columns',
                [
                    'label' => __('Carousel item to scroll', 'ht-magazine'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 8,
                    'step' => 1,
                    'default' => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sltablet_width',
                [
                    'label' => __('Tablet Resolution', 'ht-magazine'),
                    'description' => __('The resolution to tablet.', 'ht-magazine'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 750,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'heading_mobile',
                [
                    'label' => __( 'Mobile Phone', 'ht-magazine' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slmobile_display_columns',
                [
                    'label' => __('Carousel Items', 'ht-magazine'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 4,
                    'step' => 1,
                    'default' => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slmobile_scroll_columns',
                [
                    'label' => __('Carousel item to scroll', 'ht-magazine'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 4,
                    'step' => 1,
                    'default' => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slmobile_width',
                [
                    'label' => __('Mobile Resolution', 'ht-magazine'),
                    'description' => __('The resolution to mobile.', 'ht-magazine'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 480,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

        $this->end_controls_section(); // Slider Option end

        // Tab Section Title Style
        $this->start_controls_section(
            'section_title_style_section',
            [
                'label' => __( 'Section Title', 'ht-magazine' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'news_block_section_title!'=>'',
                ]
            ]
        );
            
            $this->add_control(
                'section_title_color',
                [
                    'label' => __( 'Color', 'ht-magazine' ),
                    'type' => Controls_Manager::COLOR,
                    'default'=>'#00c8fa',
                    'selectors' => [
                        '{{WRAPPER}} .post-block-wrapper .head .title' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'section_title_typography',
                    'label' => __( 'Typography', 'ht-magazine' ),
                    'selector' => '{{WRAPPER}} .post-block-wrapper .head .title',
                ]
            );

            $this->add_responsive_control(
                'section_title_margin',
                [
                    'label' => __( 'Margin', 'ht-magazine' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .post-block-wrapper .head .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'section_title_padding',
                [
                    'label' => __( 'Padding', 'ht-magazine' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .post-block-wrapper .head .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_control(
                'section_title_before_after_color',
                [
                    'label' => __( 'Title Before/After Color', 'ht-magazine' ),
                    'type' => Controls_Manager::COLOR,
                    'default'=>'#00c8fa',
                    'selectors' => [
                        '{{WRAPPER}} .post-block-wrapper .head::before' => 'background-color: {{VALUE}}',
                        '{{WRAPPER}} .post-block-wrapper .head::after' => 'background-color: {{VALUE}}',
                    ],
                ]
            );

        $this->end_controls_section();

        // Style Title tab section
        $this->start_controls_section(
            'post_grid_title_style_section',
            [
                'label' => __( 'Title', 'ht-magazine' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_title'=>'yes',
                ]
            ]
        );
            
            $this->start_controls_tabs( 'title_style_tabs' );
                
                $this->start_controls_tab(
                    'title_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'ht-magazine' ),
                    ]
                );

                    $this->add_control(
                        'title_color',
                        [
                            'label' => __( 'Color', 'ht-magazine' ),
                            'type' => Controls_Manager::COLOR,
                            'default'=>'#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .post-wrap .content .title a' => 'color: {{VALUE}} !important',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'title_typography',
                            'label' => __( 'Typography', 'ht-magazine' ),
                            'selector' => '{{WRAPPER}} .post-wrap .content .title',
                        ]
                    );

                    $this->add_responsive_control(
                        'title_margin',
                        [
                            'label' => __( 'Margin', 'ht-magazine' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .post-wrap .content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'title_padding',
                        [
                            'label' => __( 'Padding', 'ht-magazine' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .post-wrap .content .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'title_align',
                        [
                            'label' => __( 'Alignment', 'ht-magazine' ),
                            'type' => Controls_Manager::CHOOSE,
                                'options' => [
                                    'left' => [
                                        'title' => __( 'Left', 'ht-magazine' ),
                                        'icon' => 'eicon-text-align-left',
                                    ],
                                    'center' => [
                                        'title' => __( 'Center', 'ht-magazine' ),
                                        'icon' => 'eicon-text-align-center',
                                    ],
                                    'right' => [
                                        'title' => __( 'Right', 'ht-magazine' ),
                                        'icon' => 'eicon-text-align-right',
                                    ],
                                    'justify' => [
                                        'title' => __( 'Justified', 'ht-magazine' ),
                                        'icon' => 'eicon-text-align-justify',
                                    ],
                                ],
                            'selectors' => [
                                '{{WRAPPER}} .post-wrap .content .title' => 'text-align: {{VALUE}};',
                            ],
                            'default' => 'left',
                        ]
                    );

                $this->end_controls_tab();
                
                $this->start_controls_tab(
                    'title_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'ht-magazine' ),
                    ]
                );

                    $this->add_control(
                        'title_hover_color',
                        [
                            'label' => __( 'Color', 'ht-magazine' ),
                            'type' => Controls_Manager::COLOR,
                            'default'=>'#67bf35',
                            'selectors' => [
                                '{{WRAPPER}} .post-wrap .content .title a:hover' => 'color: {{VALUE}} !important',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

            $this->add_control(
                'post_grid_title_style_separator',
                [
                    'label' => __( 'Title Over The Thumbnail', 'ht-magazine' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'news_block_layout' => '3',
                    ]
                ]
            );

            $this->start_controls_tabs( 'over_the_title_style_tabs' );

                $this->start_controls_tab(
                    'title_style_over_normal_tab',
                    [
                        'label' => __( 'Normal', 'ht-magazine' ),
                        'condition' => [
                            'news_block_layout' => '3',
                        ]
                    ]
                );

                    $this->add_control(
                        'over_the_title_color',
                        [
                            'label' => __( 'Color', 'ht-magazine' ),
                            'type' => Controls_Manager::COLOR,
                            'default'=>'#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .post.post-overlay .post-wrap .content .title a' => 'color: {{VALUE}} !important',
                            ],
                            'condition' => [
                                'news_block_layout' => '3',
                            ]
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'over_the_title_typography',
                            'label' => __( 'Typography', 'ht-magazine' ),
                            'selector' => '{{WRAPPER}} .post.post-overlay .post-wrap .content .title',
                            'condition' => [
                                'news_block_layout' => '3',
                            ]
                        ]
                    );

                    $this->add_responsive_control(
                        'over_the_title_margin',
                        [
                            'label' => __( 'Margin', 'ht-magazine' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .post.post-overlay .post-wrap .content .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [
                                'news_block_layout' => '3',
                            ]
                        ]
                    );

                    $this->add_responsive_control(
                        'over_the_title_padding',
                        [
                            'label' => __( 'Padding', 'ht-magazine' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .post.post-overlay .post-wrap .content .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'condition' => [
                                'news_block_layout' => '3',
                            ]
                        ]
                    );

                    $this->add_responsive_control(
                        'over_the_title_align',
                        [
                            'label' => __( 'Alignment', 'ht-magazine' ),
                            'type' => Controls_Manager::CHOOSE,
                                'options' => [
                                    'left' => [
                                        'title' => __( 'Left', 'ht-magazine' ),
                                        'icon' => 'eicon-text-align-left',
                                    ],
                                    'center' => [
                                        'title' => __( 'Center', 'ht-magazine' ),
                                        'icon' => 'eicon-text-align-center',
                                    ],
                                    'right' => [
                                        'title' => __( 'Right', 'ht-magazine' ),
                                        'icon' => 'eicon-text-align-right',
                                    ],
                                    'justify' => [
                                        'title' => __( 'Justified', 'ht-magazine' ),
                                        'icon' => 'eicon-text-align-justify',
                                    ],
                                ],
                            'selectors' => [
                                '{{WRAPPER}} .post.post-overlay .post-wrap .content .title' => 'text-align: {{VALUE}};',
                            ],
                            'default' => 'left',
                            'condition' => [
                                'news_block_layout' => '3',
                            ]
                        ]
                    );

                $this->end_controls_tab();
                
                $this->start_controls_tab(
                    'over_the_title_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'ht-magazine' ),
                        'condition' => [
                            'news_block_layout' => '3',
                        ]
                    ]
                );

                    $this->add_control(
                        'over_the_title_hover_color',
                        [
                            'label' => __( 'Color', 'ht-magazine' ),
                            'type' => Controls_Manager::COLOR,
                            'default'=>'#67bf35',
                            'selectors' => [
                                '{{WRAPPER}} .post.post-overlay .post-wrap .content .title a:hover' => 'color: {{VALUE}} !important',
                            ],
                            'condition' => [
                                'news_block_layout' => '3',
                            ]
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        // Style Content tab section
        $this->start_controls_section(
            'post_grid_content_style_section',
            [
                'label' => __( 'Content', 'ht-magazine' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_content' => 'yes',
                ]
            ]
        );
            $this->add_control(
                'content_color',
                [
                    'label' => __( 'Color', 'ht-magazine' ),
                    'type' => Controls_Manager::COLOR,
                    'default'=>'#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .post .post-wrap .content p' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'content_typography',
                    'label' => __( 'Typography', 'ht-magazine' ),
                    'selector' => '{{WRAPPER}} .post .post-wrap .content p',
                ]
            );

            $this->add_responsive_control(
                'content_margin',
                [
                    'label' => __( 'Margin', 'ht-magazine' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .post .post-wrap .content p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'content_padding',
                [
                    'label' => __( 'Padding', 'ht-magazine' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .post .post-wrap .content p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'content_align',
                [
                    'label' => __( 'Alignment', 'ht-magazine' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'ht-magazine' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'ht-magazine' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'ht-magazine' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'ht-magazine' ),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .post .post-wrap .content p' => 'text-align: {{VALUE}};',
                    ],
                    'default' => 'left',
                ]
            );

        $this->end_controls_section();

        // Style Date tab section
        $this->start_controls_section(
            'post_grid_date_style_section',
            [
                'label' => __( 'User Meta', 'ht-magazine' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_date'=>'yes',
                ]
            ]
        );
            $this->add_control(
                'date_color',
                [
                    'label' => __( 'Color', 'ht-magazine' ),
                    'type' => Controls_Manager::COLOR,
                    'default'=>'#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .post-wrap .content .meta .meta-item' => 'color: {{VALUE}} !important',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'date_typography',
                    'label' => __( 'Typography', 'ht-magazine' ),
                    'selector' => '{{WRAPPER}} .post-wrap .content .meta .meta-item',
                ]
            );

            $this->add_responsive_control(
                'date_margin',
                [
                    'label' => __( 'Margin', 'ht-magazine' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .post-wrap .content .meta' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'date_padding',
                [
                    'label' => __( 'Padding', 'ht-magazine' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .post-wrap .content .meta' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'date_align',
                [
                    'label' => __( 'Alignment', 'ht-magazine' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'ht-magazine' ),
                            'icon' => 'eicon-text-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'ht-magazine' ),
                            'icon' => 'eicon-text-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'ht-magazine' ),
                            'icon' => 'eicon-text-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'ht-magazine' ),
                            'icon' => 'eicon-text-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .post-wrap .content .meta' => 'text-align: {{VALUE}} !important;',
                    ],
                    'default' => 'left',
                ]
            );

            $this->add_control(
                'post_grid_meta_style_section_separator',
                [
                    'label' => __( 'Meta Over The Thumbnail', 'ht-magazine' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'before',
                    'condition' => [
                        'news_block_layout' => '3',
                    ]
                ]
            );

            $this->add_control(
                'over_the_date_color',
                [
                    'label' => __( 'Color', 'ht-magazine' ),
                    'type' => Controls_Manager::COLOR,
                    'default'=>'#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .post.post-overlay .post-wrap .content .meta .meta-item' => 'color: {{VALUE}} !important',
                    ],
                ]
            );


        $this->end_controls_section();

        // Style Category tab section
        $this->start_controls_section(
            'post_grid_category_style_section',
            [
                'label' => __( 'Category', 'ht-magazine' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_category'=>'yes',
                    'news_block_layout' => '1',
                ]
            ]
        );
            $this->add_control(
                'category_color',
                [
                    'label' => __( 'Color', 'ht-magazine' ),
                    'type' => Controls_Manager::COLOR,
                    'default'=>'#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .post-wrap a.category' => 'color: {{VALUE}}',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'category_typography',
                    'label' => __( 'Typography', 'ht-magazine' ),
                    'selector' => '{{WRAPPER}} .post-wrap a.category',
                ]
            );

            $this->add_responsive_control(
                'category_margin',
                [
                    'label' => __( 'Margin', 'ht-magazine' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .post-wrap a.category' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_responsive_control(
                'category_padding',
                [
                    'label' => __( 'Padding', 'ht-magazine' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .post-wrap a.category' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                ]
            );

            $this->add_group_control(
                Group_Control_Background::get_type(),
                [
                    'name' => 'category_background',
                    'label' => __( 'Background', 'ht-magazine' ),
                    'types' => [ 'classic', 'gradient' ],
                    'selector' => '{{WRAPPER}} .post-wrap a.category',
                ]
            );

        $this->end_controls_section();

        // Style Readmore text tab section
        $this->start_controls_section(
            'read_more_style_section',
            [
                'label' => __( 'Read More', 'ht-magazine' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_readmore'=>'yes',
                ]
            ]
        );
            $this->start_controls_tabs( 'readmore_button_style_tabs' );

                $this->start_controls_tab(
                    'readmore_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'ht-magazine' ),
                    ]
                );

                    $this->add_control(
                        'read_more_color',
                        [
                            'label' => __( 'Color', 'ht-magazine' ),
                            'type' => Controls_Manager::COLOR,
                            'default'=>'#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .post-wrap .content .read-more' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'read_more_typography',
                            'label' => __( 'Typography', 'ht-magazine' ),
                            'selector' => '{{WRAPPER}} .post-wrap .content .read-more',
                        ]
                    );

                    $this->add_responsive_control(
                        'read_more_margin',
                        [
                            'label' => __( 'Margin', 'ht-magazine' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .post-wrap .content .read-more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'read_more_padding',
                        [
                            'label' => __( 'Padding', 'ht-magazine' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .post-wrap .content .read-more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'read_more_align',
                        [
                            'label' => __( 'Alignment', 'ht-magazine' ),
                            'type' => Controls_Manager::CHOOSE,
                            'options' => [
                                'left' => [
                                    'title' => __( 'Left', 'ht-magazine' ),
                                    'icon' => 'fa fa-align-left',
                                ],
                                'center' => [
                                    'title' => __( 'Center', 'ht-magazine' ),
                                    'icon' => 'fa fa-align-center',
                                ],
                                'right' => [
                                    'title' => __( 'Right', 'ht-magazine' ),
                                    'icon' => 'fa fa-align-right',
                                ],
                                'justify' => [
                                    'title' => __( 'Justified', 'ht-magazine' ),
                                    'icon' => 'fa fa-align-justify',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .post-wrap .content .read-more' => 'text-align: {{VALUE}};',
                            ],
                            'default' => 'left',
                        ]
                    );

                $this->end_controls_tab();

                $this->start_controls_tab(
                    'readmore_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'ht-magazine' ),
                    ]
                );

                    $this->add_control(
                        'read_more_hover_color',
                        [
                            'label' => __( 'Color', 'ht-magazine' ),
                            'type' => Controls_Manager::COLOR,
                            'default'=>'#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .post-wrap .content .read-more:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                $this->end_controls_tab();

            $this->end_controls_tabs();

        $this->end_controls_section();

        
        // Style arrow style start
        $this->start_controls_section(
            'carousel_arrow_style',
            [
                'label'     => __( 'Arrow', 'ht-magazine' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' =>[
                    'slider_on' => 'yes',
                    'slarrows'  => 'yes',
                ],
            ]
        );
            
            $this->start_controls_tabs( 'carousel_arrow_style_tabs' );

                // Normal tab Start
                $this->start_controls_tab(
                    'carousel_arrow_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'ht-magazine' ),
                    ]
                );

                    $this->add_control(
                        'carousel_arrow_color',
                        [
                            'label' => __( 'Color', 'ht-magazine' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#333333',
                            'selectors' => [
                                '{{WRAPPER}} .htmagazine-post-carousel .slick-arrow' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'carousel_arrow_fontsize',
                        [
                            'label' => __( 'Font Size', 'ht-magazine' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 28,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmagazine-post-carousel .slick-arrow i' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'carousel_arrow_background',
                            'label' => __( 'Background', 'ht-magazine' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmagazine-post-carousel .slick-arrow',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'carousel_arrow_border',
                            'label' => __( 'Border', 'ht-magazine' ),
                            'selector' => '{{WRAPPER}} .htmagazine-post-carousel .slick-arrow',
                        ]
                    );

                    $this->add_responsive_control(
                        'carousel_arrow_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'ht-magazine' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmagazine-post-carousel .slick-arrow' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_control(
                        'carousel_arrow_height',
                        [
                            'label' => __( 'Height', 'ht-magazine' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ]
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 42,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmagazine-post-carousel .slick-arrow' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'carousel_arrow_width',
                        [
                            'label' => __( 'Width', 'ht-magazine' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ]
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 35,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmagazine-post-carousel .slick-arrow' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'carousel_arrow_padding',
                        [
                            'label' => __( 'Padding', 'ht-magazine' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .htmagazine-post-carousel .slick-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );

                $this->end_controls_tab(); // Normal tab end

                // Hover tab Start
                $this->start_controls_tab(
                    'carousel_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'ht-magazine' ),
                    ]
                );

                    $this->add_control(
                        'carousel_arrow_hover_color',
                        [
                            'label' => __( 'Color', 'ht-magazine' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#f05555',
                            'selectors' => [
                                '{{WRAPPER}} .htmagazine-post-carousel .slick-arrow:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'carousel_arrow_hover_background',
                            'label' => __( 'Background', 'ht-magazine' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmagazine-post-carousel .slick-arrow:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'carousel_arrow_hover_border',
                            'label' => __( 'Border', 'ht-magazine' ),
                            'selector' => '{{WRAPPER}} .htmagazine-post-carousel .slick-arrow:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'carousel_arrow_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'ht-magazine' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmagazine-post-carousel .slick-arrow:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section(); // Style instagram arrow style end

        // Style instagram Dots style start
        $this->start_controls_section(
            'carousel_dots_style',
            [
                'label'     => __( 'Pagination', 'ht-magazine' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' =>[
                    'slider_on' => 'yes',
                    'sldots'  => 'yes',
                ],
            ]
        );
            
            $this->start_controls_tabs( 'carousel_dots_style_tabs' );

                // Normal tab Start
                $this->start_controls_tab(
                    'carousel_dots_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'ht-magazine' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'carousel_dots_background',
                            'label' => __( 'Background', 'ht-magazine' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmagazine-post-carousel ul.slick-dots li button',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'carousel_dots_border',
                            'label' => __( 'Border', 'ht-magazine' ),
                            'selector' => '{{WRAPPER}} .htmagazine-post-carousel ul.slick-dots li button',
                        ]
                    );

                    $this->add_responsive_control(
                        'carousel_dots_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'ht-magazine' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmagazine-post-carousel ul.slick-dots li button' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                    $this->add_control(
                        'carousel_dots_height',
                        [
                            'label' => __( 'Height', 'ht-magazine' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 15,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmagazine-post-carousel ul.slick-dots li button' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_control(
                        'carousel_dots_width',
                        [
                            'label' => __( 'Width', 'ht-magazine' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 15,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .htmagazine-post-carousel ul.slick-dots li button' => 'width: {{SIZE}}{{UNIT}} !important;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Normal tab end

                // Hover tab Start
                $this->start_controls_tab(
                    'carousel_dots_style_hover_tab',
                    [
                        'label' => __( 'Active', 'ht-magazine' ),
                    ]
                );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'carousel_dots_hover_background',
                            'label' => __( 'Background', 'ht-magazine' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .htmagazine-post-carousel ul.slick-dots li.slick-active button, {{WRAPPER}} .htmagazine-post-carousel ul.slick-dots li:hover button',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'carousel_dots_hover_border',
                            'label' => __( 'Border', 'ht-magazine' ),
                            'selector' => '{{WRAPPER}} .htmagazine-post-carousel ul.slick-dots li.slick-active button, {{WRAPPER}} .htmagazine-post-carousel ul.slick-dots li:hover button',
                        ]
                    );

                    $this->add_responsive_control(
                        'carousel_dots_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'ht-magazine' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .htmagazine-post-carousel ul.slick-dots li.slick-active button' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                                '{{WRAPPER}} .htmagazine-post-carousel ul.slick-dots li:hover button' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Hover tab end

            $this->end_controls_tabs();

        $this->end_controls_section(); // Style instagram dots style end

    }

    protected function render( $instance = [] ) {

        $settings   = $this->get_settings_for_display();
        $custom_order_ck    = $this->get_settings_for_display('custom_order');
        $orderby            = $this->get_settings_for_display('orderby');
        $postorder          = $this->get_settings_for_display('postorder');

        $this->add_render_attribute( 'htmagazine_news_attr', 'class', 'htmagazine-newsblock' );
        $this->add_render_attribute( 'carousel_attr', 'class', '' );

        if( $settings['news_block_layout'] == '2' || $settings['news_block_layout'] == '3' || $settings['news_block_layout'] == '4' ){
            $this->add_render_attribute( 'htmagazine_news_attr', 'class', 'post-block-wrapper' );
            $this->add_render_attribute( 'carousel_attr', 'class', 'body' );
        }

        if( $settings['slider_on'] == 'yes' ){

            $this->add_render_attribute( 'carousel_attr', 'class', 'row htmagazine-post-carousel' );

            $slider_settings = [
                'arrows' => ('yes' === $settings['slarrows']),
                'arrow_prev_txt' => HTMagazine_Icon_manager::render_icon( $settings['slprevicon'] ),
                'arrow_next_txt' => HTMagazine_Icon_manager::render_icon( $settings['slnexticon'] ),
                'dots' => ('yes' === $settings['sldots']),
                'autoplay' => ('yes' === $settings['slautolay']),
                'autoplay_speed' => absint($settings['slautoplay_speed']),
                'animation_speed' => absint($settings['slanimation_speed']),
                'pause_on_hover' => ('yes' === $settings['slpause_on_hover']),
                'center_mode' => ( 'yes' === $settings['slcentermode']),
                'center_padding' => absint($settings['slcenterpadding']),
                'sliderrow' => absint($settings['slrows']),
            ];

            $slider_responsive_settings = [
                'display_columns' => $settings['slitems'],
                'scroll_columns' => $settings['slscroll_columns'],
                'tablet_width' => $settings['sltablet_width'],
                'tablet_display_columns' => $settings['sltablet_display_columns'],
                'tablet_scroll_columns' => $settings['sltablet_scroll_columns'],
                'mobile_width' => $settings['slmobile_width'],
                'mobile_display_columns' => $settings['slmobile_display_columns'],
                'mobile_scroll_columns' => $settings['slmobile_scroll_columns'],

            ];

            $slider_settings = array_merge( $slider_settings, $slider_responsive_settings );

            $this->add_render_attribute( 'carousel_attr', 'data-settings', wp_json_encode( $slider_settings ) );
        }


         // Query
        $args = array(
            'post_type'             => 'post',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => !empty( $settings['post_limit'] ) ? $settings['post_limit'] : 3,
            'order'                 => $postorder
        );

        // Custom Order
        if( $custom_order_ck == 'yes' ){
            $args['orderby']    = $orderby;
        }

        
        $get_categories = $settings['grid_categories'];

        $grid_cats = str_replace(' ', '', $get_categories);

        if (  !empty( $get_categories ) ) {
            if( is_array($grid_cats) && count($grid_cats) > 0 ){
                $field_name = is_numeric( $grid_cats[0] ) ? 'term_id' : 'slug';
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'category',
                        'terms' => $grid_cats,
                        'field' => $field_name,
                        'include_children' => false
                    )
                );
            }
        }

        $grid_post = new \WP_Query( $args );

        ?>
            <div <?php echo $this->get_render_attribute_string( 'htmagazine_news_attr' ); ?>>

                <?php if( isset( $settings['news_block_section_title'] ) && !empty( $settings['news_block_section_title'] ) ):?>
                    <div class="head sports-head">
                        <h4 class="title"><?php echo esc_html( $settings['news_block_section_title'] ); ?></h4>
                    </div>
                <?php endif; ?>

                <div <?php echo $this->get_render_attribute_string( 'carousel_attr' ); ?>>
                    
                    <?php
                        if( $grid_post->have_posts() ):
                            $i = 0;
                            while( $grid_post->have_posts() ) : $grid_post->the_post();
                                $i++;
                    ?>
                        <!-- Layout Two -->
                        <?php if( $settings['news_block_layout'] == '2' ): ?>
                            <?php if( $i== 1 ): ?>

                                <!-- Small Post Start -->
                                <div class="post sports-post post-separator-border">
                                    <div class="post-wrap">
                                        <a class="image" href="<?php the_permalink(); ?>">
                                            <?php if ( has_post_thumbnail() ){
                                                if( $settings['news_block_large_image_size_size'] == '' ){
                                                    the_post_thumbnail( array( $settings['news_block_large_image_size_custom_dimension']['width'], $settings['news_block_large_image_size_custom_dimension']['height'] ) ); 
                                                }else{
                                                    the_post_thumbnail( $settings['news_block_large_image_size_size'] );
                                                }
                                            } else { ?>
                                                <?php echo '<img src="'.HTMAGAZINE_PL_URL.'/assests/images/image-placeholder.png" alt="'.get_the_title().'" />'; ?>
                                            <?php } ?>
                                        </a>
                                        <div class="content">
                                            <?php
                                                if( $settings['show_title'] == 'yes' ){
                                                    echo '<h4 class="title"><a href="'.esc_url( get_the_permalink() ).'">'.wp_trim_words( get_the_title(), $settings['title_length'], '' ).'</a></h4>';
                                                }
                                            ?>

                                            <!-- Meta -->
                                            <?php if( $settings['show_date'] == 'yes' ): ?>
                                                <div class="meta fix">
                                                    <a class="meta-item author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><i class="fa fa-user"></i> <?php the_author();?></a>
                                                    <span class="meta-item date"><i class="fa fa-clock-o"></i>
                                                        <?php the_time( esc_html__( 'd F Y', 'ht-magazine' ) ); ?>
                                                    </span>
                                                </div>
                                            <?php endif;?>
                                            
                                            <?php
                                                if( $settings['show_content'] == 'yes' ){
                                                    echo '<p>'.wp_trim_words( get_the_content(), $settings['content_length'], '' ).'</p>';
                                                }
                                            ?>

                                            <!-- Read More -->
                                            <?php if( $settings['show_readmore'] == 'yes' ):?>
                                                <a href="<?php the_permalink(); ?>" class="read-more"><?php if( !empty( $settings['readmore_buttontxt'] ) ){ echo esc_html( $settings['readmore_buttontxt'] ); }else{ esc_html_e( 'continue reading', 'ht-magazine' ); } ?></a>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </div><!-- Small Post End -->

                            <?php else:?>
                                <!-- Small Post Start -->
                                <div class="post post-small post-list sports-post post-separator-border">
                                    <div class="post-wrap">
                                        <a class="image" href="<?php the_permalink(); ?>">
                                            <?php if ( has_post_thumbnail() ){
                                                if( $settings['news_block_image_size_size'] == '' ){
                                                    the_post_thumbnail( array( $settings['news_block_image_size_custom_dimension']['width'], $settings['news_block_image_size_custom_dimension']['height'] ) ); 
                                                }else{
                                                    the_post_thumbnail( $settings['news_block_image_size_size'] );
                                                }
                                            } else { ?>
                                                <?php echo '<img src="'.HTMAGAZINE_PL_URL.'/assests/images/image-placeholder.png" alt="'.get_the_title().'" />'; ?>
                                            <?php } ?>
                                        </a>
                                        <div class="content">
                                            <?php
                                                if( $settings['show_title'] == 'yes' ){
                                                    echo '<h4 class="title"><a href="'.esc_url( get_the_permalink() ).'">'.wp_trim_words( get_the_title(), $settings['title_length'], '' ).'</a></h4>';
                                                }
                                            ?>

                                            <?php if( $settings['show_date'] == 'yes' ): ?>
                                                <div class="meta fix">
                                                    <span class="meta-item date"><i class="fa fa-clock-o"></i>
                                                        <?php the_time( esc_html__( 'd F Y', 'ht-magazine' ) ); ?>
                                                    </span>
                                                </div>
                                            <?php endif;?>

                                        </div>
                                    </div>
                                </div><!-- Small Post End -->

                            <?php endif;?>

                        <!-- Layout Three -->
                        <?php elseif( $settings['news_block_layout'] == '3' ): ?>

                            <?php if( $i == 1 ): ?>
                                <!-- Post Start -->
                                <div class="post travel-post post-separator-border">
                                    <div class="post-wrap">
                                        <a class="image" href="<?php the_permalink(); ?>">
                                            <?php if ( has_post_thumbnail() ){
                                                the_post_thumbnail();
                                            } else { ?>
                                                <?php echo '<img src="'.HTMAGAZINE_PL_URL.'/assests/images/image-placeholder.png" alt="'.get_the_title().'" />'; ?>
                                            <?php } ?>
                                        </a>
                                        <div class="content">
                                            <?php
                                                if( $settings['show_title'] == 'yes' ){
                                                    echo '<h4 class="title"><a href="'.esc_url( get_the_permalink() ).'">'.wp_trim_words( get_the_title(), $settings['title_length'], '' ).'</a></h4>';
                                                }
                                            ?>

                                            <!-- Meta -->
                                            <?php if( $settings['show_date'] == 'yes' ): ?>
                                                <div class="meta fix">
                                                    <a class="meta-item author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><i class="fa fa-user"></i> <?php the_author();?></a>
                                                    <span class="meta-item date"><i class="fa fa-clock-o"></i>
                                                        <?php the_time( esc_html__( 'd F Y', 'ht-magazine' ) ); ?>
                                                    </span>
                                                </div>
                                            <?php endif;?>
                                            
                                            <?php
                                                if( $settings['show_content'] == 'yes' ){
                                                    echo '<p>'.wp_trim_words( get_the_content(), $settings['content_length'], '' ).'</p>';
                                                }
                                            ?>

                                            <!-- Ream More -->
                                            <?php if( $settings['show_readmore'] == 'yes' ):?>
                                                <a href="<?php the_permalink(); ?>" class="read-more"><?php if( !empty( $settings['readmore_buttontxt'] ) ){ echo esc_html( $settings['readmore_buttontxt'] ); }else{ esc_html_e( 'continue reading', 'ht-magazine' ); } ?></a>
                                            <?php endif; ?>

                                        </div>
                                    </div>
                                </div><!-- Post End -->
                            <?php else:?>
                                <!-- Post Start -->
                                <div class="post post-overlay travel-post post-separator-border">
                                    <div class="post-wrap">
                                        <div class="image">
                                            <?php if ( has_post_thumbnail() ){
                                                the_post_thumbnail();
                                            } else { ?>
                                                <?php echo '<img src="'.HTMAGAZINE_PL_URL.'/assests/images/image-placeholder.png" alt="'.get_the_title().'" />'; ?>
                                            <?php } ?>
                                        </div>
                                        <div class="content">

                                            <?php
                                                if( $settings['show_title'] == 'yes' ){
                                                    echo '<h4 class="title"><a href="'.esc_url( get_the_permalink() ).'">'.wp_trim_words( get_the_title(), $settings['title_length'], '' ).'</a></h4>';
                                                }
                                            ?>
                                            
                                            <!-- Meta -->
                                            <?php if( $settings['show_date'] == 'yes' ): ?>
                                                <div class="meta fix">
                                                    <span class="meta-item date"><i class="fa fa-clock-o"></i>
                                                        <?php the_time( esc_html__( 'd F Y', 'ht-magazine' ) ); ?>
                                                    </span>
                                                </div>
                                            <?php endif;?>

                                        </div>
                                    </div>
                                </div><!-- Post End -->

                            <?php endif;?>

                        <!-- Layout Four -->
                        <?php elseif( $settings['news_block_layout'] == '4' ): ?>
                            <?php if( $i == 1 ): ?>
                                <!-- Post Start -->
                                <div class="post video-post post-separator-border">
                                    <div class="post-wrap">
                                        <a class="image" href="<?php the_permalink(); ?>">
                                            <?php if ( has_post_thumbnail() ){
                                                if( $settings['news_block_large_image_size_size'] == '' ){
                                                    the_post_thumbnail( array( $settings['news_block_large_image_size_custom_dimension']['width'], $settings['news_block_large_image_size_custom_dimension']['height'] ) ); 
                                                }else{
                                                    the_post_thumbnail( $settings['news_block_large_image_size_size'] );
                                                }
                                            } else { ?>
                                                <?php echo '<img src="'.HTMAGAZINE_PL_URL.'/assests/images/image-placeholder.png" alt="'.get_the_title().'" />'; ?>
                                            <?php } ?>
                                        </a>
                                        <!-- Content -->
                                        <div class="content">
                                            <!-- Title -->
                                            <?php
                                                if( $settings['show_title'] == 'yes' ){
                                                    echo '<h4 class="title"><a href="'.esc_url( get_the_permalink() ).'">'.wp_trim_words( get_the_title(), $settings['title_length'], '' ).'</a></h4>';
                                                }
                                            ?>
                                            
                                            <!-- Meta -->
                                            <?php if( $settings['show_date'] == 'yes' ): ?>
                                                <div class="meta fix">
                                                    <a class="meta-item author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><i class="fa fa-user"></i> <?php the_author();?></a>
                                                    <span class="meta-item date"><i class="fa fa-clock-o"></i>
                                                        <?php the_time( esc_html__( 'd F Y', 'ht-magazine' ) ); ?>
                                                    </span>
                                                </div>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div><!-- Post End -->
                            <?php else:?>
                                <!-- Post Start -->
                                <div class="post video-post post-separator-border">
                                    <div class="post-wrap">
                                        <!-- Content -->
                                        <div class="content">
                                            <!-- Title -->
                                            <?php
                                                if( $settings['show_title'] == 'yes' ){
                                                    echo '<h4 class="title"><a href="'.esc_url( get_the_permalink() ).'">'.wp_trim_words( get_the_title(), $settings['title_length'], '' ).'</a></h4>';
                                                }
                                            ?>
                                            
                                            <!-- Meta -->
                                            <?php if( $settings['show_date'] == 'yes' ): ?>
                                                <div class="meta fix">
                                                    <a class="meta-item author" href="<?php echo get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ); ?>"><i class="fa fa-user"></i> <?php the_author();?></a>
                                                    <span class="meta-item date"><i class="fa fa-clock-o"></i>
                                                        <?php the_time( esc_html__( 'd F Y', 'ht-magazine' ) ); ?>
                                                    </span>
                                                </div>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div><!-- Post End -->

                            <?php endif;?>

                        <!-- Default Layout -->
                        <?php else:?>
                            <!-- Overlay Post Start -->
                            <div class="post post-overlay gadgets-post col">
                                <div class="post-wrap">
                                    <!-- Image -->
                                    <div class="image">
                                        <?php if ( has_post_thumbnail() ){
                                            if( $settings['news_block_image_size_size'] == '' ){
                                                the_post_thumbnail( array( $settings['news_block_image_size_custom_dimension']['width'], $settings['news_block_image_size_custom_dimension']['height'] ) ); 
                                            }else{
                                                the_post_thumbnail( $settings['news_block_image_size_size'] );
                                            }
                                        } else { ?>
                                            <?php echo '<img src="'.HTMAGAZINE_PL_URL.'/assests/images/image-placeholder.png" alt="'.get_the_title().'" />'; ?>
                                        <?php } ?>
                                    </div>
                                    <?php
                                        if( $settings['show_category'] == 'yes' ){
                                            $i=0;
                                            foreach ( get_the_category() as $category ) {
                                                $i++;
                                                $term_link = get_term_link( $category );
                                                ?>
                                                    <a href="<?php echo esc_url( $term_link ); ?>" class="category <?php echo esc_attr( $category->slug ); ?>"><?php echo esc_attr( $category->name );?></a>
                                                <?php
                                                if( $i==1 ){ break; }
                                            }
                                        }
                                    ?>
                                    <!-- Content -->
                                    <div class="content">
                                        <!-- Title -->
                                        <?php
                                            if( $settings['show_title'] == 'yes' ){
                                                echo '<h4 class="title"><a href="'.esc_url( get_the_permalink() ).'">'.wp_trim_words( get_the_title(), $settings['title_length'], '' ).'</a></h4>';
                                            }
                                            if( $settings['show_content'] == 'yes' ){
                                                echo '<p>'.wp_trim_words( get_the_content(), $settings['content_length'], '' ).'</p>';
                                            }
                                        ?>
                                        <!-- Meta -->
                                        <?php if( $settings['show_date'] == 'yes' ): ?>
                                            <div class="meta fix">
                                                <span class="meta-item date"><i class="fa fa-clock-o"></i>
                                                    <?php the_time( esc_html__( 'd F Y', 'ht-magazine' ) ); ?>
                                                </span>
                                            </div>
                                        <?php endif;?>
                                        <?php if( $settings['show_readmore'] == 'yes' ):?>
                                            <a href="<?php the_permalink(); ?>" class="read-more"><?php if( !empty( $settings['readmore_buttontxt'] ) ){ echo esc_html( $settings['readmore_buttontxt'] ); }else{ esc_html_e( 'continue reading', 'ht-magazine' ); } ?></a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </div><!-- Overlay Post End -->
                        <?php endif;?>

                    <?php endwhile; endif; ?>

                </div>

            </div>

        <?php

    }

}