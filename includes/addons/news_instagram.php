<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class HTMagazine_Elementor_Widget_Instagram extends Widget_Base {

    public function get_name() {
        return 'htmagazine-addonsinstagram';
    }
    
    public function get_title() {
        return __( 'Instagram Feed', 'ht-magazine' );
    }

    public function get_icon() {
        return 'htelementor-icon eicon-photo-library';
    }
    public function get_categories() {
        return [ 'htnews-addons' ];
    }

    protected function register_controls() {

        $this->start_controls_section(
            'instagram_content',
            [
                'label' => __( 'Instagram', 'ht-magazine' ),
            ]
        );
        
            $this->add_control(
                'access_token',
                [
                    'label'         => __( 'Instagram Access Token', 'ht-magazine' ),
                    'type'          => Controls_Manager::TEXT,
                    'label_block'   =>true,
                    'description'   => wp_kses_post( '(<a href="'.esc_url('https://developers.facebook.com/docs/instagram-basic-display-api/getting-started').'" target="_blank">Lookup your Access Token</a>)', 'ht-magazine' ),
                ]
            );

            $this->add_control(
                'limit',
                [
                    'label' => __( 'Item Limit (Max 200)', 'ht-magazine' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 200,
                    'step' => 1,
                    'default' => 8,
                    'separator'=>'before',
                ]
            );

            $this->add_control(
                'delete_cache',
                [
                    'label'         => __( 'Delete existing caching data', 'ht-magazine' ),
                    'type'          => Controls_Manager::SWITCHER,
                    'separator'     => 'before',
                ]
            );

            $this->add_control(
                'cash_time_duration',
                [
                    'label' => __('Cache Time Duration', 'ht-magazine'),
                    'type' => Controls_Manager::SELECT,
                    'options' => [
                        'minute'    => __('Minute', 'ht-magazine'),
                        'hour'      => __('Hour', 'ht-magazine'),
                        'day'       => __('Day', 'ht-magazine'),
                        'week'      => __('Week', 'ht-magazine'),
                        'month'     => __('Month', 'ht-magazine'),
                        'year'      => __('Year', 'ht-magazine'),
                    ],
                    'default' => 'day',
                    'condition'=>[
                        'delete_cache!'=>'yes',
                    ],
                    'label_block'=>true,
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
                    'default'       => 'yes',
                    'separator'     => 'before',
                ]
            );

        $this->end_controls_section();


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

        $settings       = $this->get_settings_for_display();
        $id             = $this->get_id();
        $access_token   = !empty( $settings['access_token'] ) ? $settings['access_token'] : '';
        $limit          = !empty( $settings['limit'] ) ? $settings['limit'] : 8;

        $cache_duration = $this->get_cacheing_duration( $settings['cash_time_duration'] );
        $transient_var = $id . '_' . $limit;

        if( $settings['delete_cache'] === 'yes' ){
            delete_transient( $transient_var );
            $cache_duration = MINUTE_IN_SECONDS;
        }

        if( empty( $access_token ) ){
            echo '<p>'.esc_html__('Please enter your access token.','ht-magazine').'</p>';
            return;
        }

        if ( false === ( $items = get_transient( $transient_var ) ) ) {

            $url = 'https://graph.instagram.com/me/media?fields=id,caption,media_type,media_url,permalink,thumbnail_url,timestamp,username&limit=200&access_token='.esc_html($access_token);

            $instagram_data = wp_remote_retrieve_body( wp_remote_get( $url ) );

            $instagram_data = json_decode( $instagram_data, true );
            
            if ( ! is_wp_error( $instagram_data ) ) {
                
                if ( isset( $instagram_data['error']['message'] ) ) {
                    echo '<p>'.esc_html__('Incorrect access token specified.','ht-magazine').'</p>';
                }

                $items = array();
                foreach ( $instagram_data['data'] as $data_item ) {
                    $item['link'] = $data_item['permalink'];
                    $item['src']  = $data_item['media_url'];
                    $item['user'] = $data_item['username'];
                    $items[]      = $item;
                }
                set_transient( $transient_var, $items, 1 * $cache_duration );

            }
        }

        $this->add_render_attribute( 'instagram_area', 'class', '' );
        $this->add_render_attribute( 'carousel_attr', 'class', 'fullwidth-instagram-carousel col pl-0 pr-0' );

        if( $settings['slider_on'] == 'yes' ){

            $this->add_render_attribute( 'carousel_attr', 'class', 'htmagazine-post-carousel' );

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

        $this->add_render_attribute( 'htmega_banner', 'class', 'htmega-banner' );

        ?>
            <div <?php echo $this->get_render_attribute_string( 'instagram_area' ); ?>>
                
                <div <?php echo $this->get_render_attribute_string( 'carousel_attr' ); ?>>
                    <?php
                        if ( isset( $items ) && !empty($items)) {
                            $countitem = 0;
                            foreach ( $items as $item ) {
                                $countitem++;
                                $user = $item['user'];
                                echo '<a class="instagram-item" href="' . esc_url( $item['link'] ) .'"><img src="' . esc_url( $item['src'] ) . '" alt="'.esc_attr( $item['user'] ).'" /></a>';
                                if( $countitem == $limit ){ break; }
                            }
                        }
                    ?>
                </div>

            </div>

        <?php

    }

    protected function get_cacheing_duration( $duration ){
        switch ( $duration ) {
            case 'minute':
                $cache_duration = MINUTE_IN_SECONDS;
                break;
            case 'hour':
                $cache_duration = HOUR_IN_SECONDS;
                break;
            case 'day':
                $cache_duration = DAY_IN_SECONDS;
                break;
            case 'week':
                $cache_duration = WEEK_IN_SECONDS;
                break;
            case 'month':
                $cache_duration = MONTH_IN_SECONDS;
                break;
            case 'year':
                $cache_duration = YEAR_IN_SECONDS;
                break;
            default:
                $cache_duration = DAY_IN_SECONDS;
        }
        return $cache_duration;
    }

}