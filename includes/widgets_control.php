<?php

    if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly.

    if( !class_exists( 'HTmagazine_Elwidgets_Control' ) ){
       
        class HTmagazine_Elwidgets_Control {
            
            public function __construct(){
                $this->htmagazine_widgets_control();
            }

            public function htmagazine_widgets_control(){

                $widgets_manager = \Elementor\Plugin::instance()->widgets_manager;

                if ( file_exists( HTMAGAZINE_PL_PATH.'includes/addons/news_ticker.php' ) ) {
                    require_once HTMAGAZINE_PL_PATH.'includes/addons/news_ticker.php';
                    htmagazine_widget_register_manager( new \Elementor\HTMagazine_Elementor_Widget_NewsTicker() );
                }

                if ( file_exists( HTMAGAZINE_PL_PATH.'includes/addons/news_grid.php' ) ) {
                    require_once HTMAGAZINE_PL_PATH.'includes/addons/news_grid.php';
                    htmagazine_widget_register_manager( new \Elementor\HTMagazine_Elementor_Widget_Newsgrid() );
                }

                if ( file_exists( HTMAGAZINE_PL_PATH.'includes/addons/news_carousel.php' ) ) {
                    require_once HTMAGAZINE_PL_PATH.'includes/addons/news_carousel.php';
                    htmagazine_widget_register_manager( new \Elementor\HTMagazine_Elementor_Widget_News_Carousel() );
                }

                if ( file_exists( HTMAGAZINE_PL_PATH.'includes/addons/news_tab.php' ) ) {
                    require_once HTMAGAZINE_PL_PATH.'includes/addons/news_tab.php';
                    htmagazine_widget_register_manager( new \Elementor\HTMagazine_Elementor_Widget_News_Tabs() );
                }

                if ( file_exists( HTMAGAZINE_PL_PATH.'includes/addons/adds_banner.php' ) ) {
                    require_once HTMAGAZINE_PL_PATH.'includes/addons/adds_banner.php';
                    htmagazine_widget_register_manager( new \Elementor\HTMagazine_Elementor_Widget_Adds_Banner() );
                }

                if ( file_exists( HTMAGAZINE_PL_PATH.'includes/addons/news_sidebar_tab.php' ) ) {
                    require_once HTMAGAZINE_PL_PATH.'includes/addons/news_sidebar_tab.php';
                    htmagazine_widget_register_manager( new \Elementor\HTMagazine_Elementor_Widget_Adds_Sidebar_Tab() );
                }

                if ( file_exists( HTMAGAZINE_PL_PATH.'includes/addons/news_category_menu.php' ) ) {
                    require_once HTMAGAZINE_PL_PATH.'includes/addons/news_category_menu.php';
                    htmagazine_widget_register_manager( new \Elementor\HTMagazine_Elementor_Widget_Category_List() );
                }

                if ( file_exists( HTMAGAZINE_PL_PATH.'includes/addons/news_mail_chimp.php' ) ) {
                    require_once HTMAGAZINE_PL_PATH.'includes/addons/news_mail_chimp.php';
                    htmagazine_widget_register_manager( new \Elementor\HTMagazine_Elementor_Widget_Mail_Chimp() );
                }

                if ( file_exists( HTMAGAZINE_PL_PATH.'includes/addons/news_instagram.php' ) ) {
                    require_once HTMAGAZINE_PL_PATH.'includes/addons/news_instagram.php';
                    htmagazine_widget_register_manager( new \Elementor\HTMagazine_Elementor_Widget_Instagram() );
                }

                if ( file_exists( HTMAGAZINE_PL_PATH.'includes/addons/news_youtube_playlist.php' ) ) {
                    require_once HTMAGAZINE_PL_PATH.'includes/addons/news_youtube_playlist.php';
                    htmagazine_widget_register_manager( new \Elementor\HTMagazine_Elementor_Widget_Youtube_Player() );
                }

                if ( file_exists( HTMAGAZINE_PL_PATH.'includes/addons/news_block.php' ) ) {
                    require_once HTMAGAZINE_PL_PATH.'includes/addons/news_block.php';
                    htmagazine_widget_register_manager( new \Elementor\HTMagazine_Elementor_Widget_News_Block() );
                }

                if ( file_exists( HTMAGAZINE_PL_PATH.'includes/addons/news_overlay_grid.php' ) ) {
                    require_once HTMAGAZINE_PL_PATH.'includes/addons/news_overlay_grid.php';
                    htmagazine_widget_register_manager( new \Elementor\HTMagazine_Elementor_Widget_News_OverlayGrid() );
                }

                if ( file_exists( HTMAGAZINE_PL_PATH.'includes/addons/contact_info.php' ) ) {
                    require_once HTMAGAZINE_PL_PATH.'includes/addons/contact_info.php';
                    htmagazine_widget_register_manager( new \Elementor\HTMagazine_Elementor_Widget_ContactInfo() );
                }

                if ( file_exists( HTMAGAZINE_PL_PATH.'includes/addons/contact_form.php' ) ) {
                    require_once HTMAGAZINE_PL_PATH.'includes/addons/contact_form.php';
                    htmagazine_widget_register_manager( new \Elementor\HTMagazine_Elementor_Widget_ContactForm() );
                }

                if ( file_exists( HTMAGAZINE_PL_PATH.'includes/addons/google_map.php' ) ) {
                    require_once HTMAGAZINE_PL_PATH.'includes/addons/google_map.php';
                    htmagazine_widget_register_manager( new \Elementor\HTMagazine_Elementor_Widget_GoogleMap() );
                }

            }
        }

        new HTmagazine_Elwidgets_Control();

    }

?>