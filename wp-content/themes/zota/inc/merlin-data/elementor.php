<?php

class Zota_Merlin_Elementor {
	public function import_files_default(){
		$name = '';
		if( class_exists('WeDevs_Dokan') ) {
			$name = ' Dokan';
		}
		
		$rev_sliders = array(
			"https://demosamples.thembay.com/zota/electronics/revslider/slider-1.zip",
			"https://demosamples.thembay.com/zota/electronics/revslider/slider-2.zip",
			"https://demosamples.thembay.com/zota/electronics/revslider/slider-11.zip",
		);
	
		$data_url = "https://demosamples.thembay.com/zota/electronics/data.xml";
		$widget_url = "https://demosamples.thembay.com/zota/electronics/widgets.wie";
		

		return array(
			array(
				'import_file_name'           => 'Home Electronics'. $name,
				'home'                       => 'home',
				'import_file_url'          	 => $data_url,
				'import_widget_file_url'     => $widget_url,
				'import_redux'         => array(
					array(
						'file_url'   => "https://demosamples.thembay.com/zota/electronics/home/redux_options.json",
						'option_name' => 'zota_tbay_theme_options',
					),
				),
				'rev_sliders'                => $rev_sliders,
				'import_preview_image_url'   => "https://demosamples.thembay.com/zota/electronics/home/screenshot.jpg",
				'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'zota' ),
				'preview_url'                => 'https://el1.thembaydev.com/zota/',
			),
		);
	}
	public function import_files_wcfm(){
		$rev_sliders = array(
			"https://demosamples.thembay.com/zota/electronics/revslider/slider-1.zip",
			"https://demosamples.thembay.com/zota/electronics/revslider/slider-2.zip",
			"https://demosamples.thembay.com/zota/electronics/revslider/slider-11.zip",
		);
	
		$data_url = "https://demosamples.thembay.com/zota/wcfm/data.xml";
		$widget_url = "https://demosamples.thembay.com/zota/wcfm/widgets.wie";
		

		return array(
			array(
				'import_file_name'           => 'Home Electronics WCFM',
				'home'                       => 'home',
				'import_file_url'          	 => $data_url,
				'import_widget_file_url'     => $widget_url,
				'import_redux'         => array(
					array(
						'file_url'   => "https://demosamples.thembay.com/zota/wcfm/home/redux_options.json",
						'option_name' => 'zota_tbay_theme_options',
					),
				),
				'rev_sliders'                => $rev_sliders,
				'import_preview_image_url'   => "https://demosamples.thembay.com/zota/wcfm/home/screenshot.jpg",
				'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'zota' ),
				'preview_url'                => 'https://el1.thembaydev.com/zota_wcfm/',
			),
		);
	}
	public function import_files_wcmp(){
		$rev_sliders = array(
			"https://demosamples.thembay.com/zota/electronics/revslider/slider-1.zip",
			"https://demosamples.thembay.com/zota/electronics/revslider/slider-2.zip",
			"https://demosamples.thembay.com/zota/electronics/revslider/slider-11.zip",
		);
	
		$data_url = "https://demosamples.thembay.com/zota/wcmp/data.xml";
		$widget_url = "https://demosamples.thembay.com/zota/wcmp/widgets.wie";
		

		return array(
			array(
				'import_file_name'           => 'Home Electronics WCMP',
				'home'                       => 'home',
				'import_file_url'          	 => $data_url,
				'import_widget_file_url'     => $widget_url,
				'import_redux'         => array(
					array(
						'file_url'   => "https://demosamples.thembay.com/zota/wcmp/home/redux_options.json",
						'option_name' => 'zota_tbay_theme_options',
					),
				),
				'rev_sliders'                => $rev_sliders,
				'import_preview_image_url'   => "https://demosamples.thembay.com/zota/wcmp/home/screenshot.jpg",
				'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'zota' ),
				'preview_url'                => 'https://el1.thembaydev.com/zota_wcmp/',
			),
		);
	}
	public function import_files_wcvendors(){
		$rev_sliders = array(
			"https://demosamples.thembay.com/zota/electronics/revslider/slider-1.zip",
			"https://demosamples.thembay.com/zota/electronics/revslider/slider-2.zip",
			"https://demosamples.thembay.com/zota/electronics/revslider/slider-11.zip",
		);
	
		$data_url = "https://demosamples.thembay.com/zota/wcvendors/data.xml";
		$widget_url = "https://demosamples.thembay.com/zota/wcvendors/widgets.wie";
		

		return array(
			array(
				'import_file_name'           => 'Home Electronics Wcvendors',
				'home'                       => 'home',
				'import_file_url'          	 => $data_url,
				'import_widget_file_url'     => $widget_url,
				'import_redux'         => array(
					array(
						'file_url'   => "https://demosamples.thembay.com/zota/wcvendors/home/redux_options.json",
						'option_name' => 'zota_tbay_theme_options',
					),
				),
				'rev_sliders'                => $rev_sliders,
				'import_preview_image_url'   => "https://demosamples.thembay.com/zota/wcvendors/home/screenshot.jpg",
				'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'zota' ),
				'preview_url'                => 'https://el1.thembaydev.com/zota_wcvendors/',
			),
		);
	}
	public function import_files_rtl(){
		$rev_sliders = array(
			"https://demosamples.thembay.com/zota/electronics/revslider/slider-1.zip",
			"https://demosamples.thembay.com/zota/electronics/revslider/slider-2.zip",
			"https://demosamples.thembay.com/zota/electronics/revslider/slider-11.zip",
		);
	
		$data_url = "https://demosamples.thembay.com/zota/rtl/data.xml";
		$widget_url = "https://demosamples.thembay.com/zota/rtl/widgets.wie";
		

		return array(
			array(
				'import_file_name'           => 'Home Electronics RTL',
				'home'                       => 'home',
				'import_file_url'          	 => $data_url,
				'import_widget_file_url'     => $widget_url,
				'import_redux'         => array(
					array(
						'file_url'   => "https://demosamples.thembay.com/zota/rtl/home/redux_options.json",
						'option_name' => 'zota_tbay_theme_options',
					),
				),
				'rev_sliders'                => $rev_sliders,
				'import_preview_image_url'   => "https://demosamples.thembay.com/zota/rtl/home/screenshot.jpg",
				'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'zota' ),
				'preview_url'                => 'https://el1.thembaydev.com/zota_rtl/',
			),
		);
	}
	public function import_files_beauty(){
		$rev_sliders = array(
			"https://demosamples.thembay.com/zota/beauty/revslider/slider-1.zip",
		);
	
		$data_url = "https://demosamples.thembay.com/zota/beauty/data.xml";
		$widget_url = "https://demosamples.thembay.com/zota/beauty/widgets.wie";
		

		return array(
			array(
				'import_file_name'           => 'Home Beauty',
				'home'                       => 'home',
				'import_file_url'          	 => $data_url,
				'import_widget_file_url'     => $widget_url,
				'import_redux'         => array(
					array(
						'file_url'   => "https://demosamples.thembay.com/zota/beauty/home/redux_options.json",
						'option_name' => 'zota_tbay_theme_options',
					),
				),
				'rev_sliders'                => $rev_sliders,
				'import_preview_image_url'   => "https://demosamples.thembay.com/zota/beauty/home/screenshot.jpg",
				'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'zota' ),
				'preview_url'                => 'https://el1.thembaydev.com/zota_beauty/',
			),
		);
	}
	public function import_files_fashion(){
		$rev_sliders = array(
			"",
		);
	
		$data_url = "https://demosamples.thembay.com/zota/fashion/data.xml";
		$widget_url = "https://demosamples.thembay.com/zota/fashion/widgets.wie";
		

		return array(
			array(
				'import_file_name'           => 'Home Fashion',
				'home'                       => 'home',
				'import_file_url'          	 => $data_url,
				'import_widget_file_url'     => $widget_url,
				'import_redux'         => array(
					array(
						'file_url'   => "https://demosamples.thembay.com/zota/fashion/home/redux_options.json",
						'option_name' => 'zota_tbay_theme_options',
					),
				),
				'rev_sliders'                => $rev_sliders,
				'import_preview_image_url'   => "https://demosamples.thembay.com/zota/fashion/home/screenshot.jpg",
				'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'zota' ),
				'preview_url'                => 'https://el1.thembaydev.com/zota_fashion/',
			),
		);
	}
	public function import_files_organic(){
		$rev_sliders = array(
			"https://demosamples.thembay.com/zota/organic/revslider/slider-1.zip",
		);
	
		$data_url = "https://demosamples.thembay.com/zota/organic/data.xml";
		$widget_url = "https://demosamples.thembay.com/zota/organic/widgets.wie";
		

		return array(
			array(
				'import_file_name'           => 'Home Organic',
				'home'                       => 'home',
				'import_file_url'          	 => $data_url,
				'import_widget_file_url'     => $widget_url,
				'import_redux'         => array(
					array(
						'file_url'   => "https://demosamples.thembay.com/zota/organic/home/redux_options.json",
						'option_name' => 'zota_tbay_theme_options',
					),
				),
				'rev_sliders'                => $rev_sliders,
				'import_preview_image_url'   => "https://demosamples.thembay.com/zota/organic/home/screenshot.jpg",
				'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'zota' ),
				'preview_url'                => 'https://el1.thembaydev.com/zota_organic/',
			),
		);
	}
	public function import_files_furniture(){
		$rev_sliders = array(
			"https://demosamples.thembay.com/zota/furniture/revslider/slider-1.zip",
		);
	
		$data_url = "https://demosamples.thembay.com/zota/furniture/data.xml";
		$widget_url = "https://demosamples.thembay.com/zota/furniture/widgets.wie";
		

		return array(
			array(
				'import_file_name'           => 'Home Furniture',
				'home'                       => 'home',
				'import_file_url'          	 => $data_url,
				'import_widget_file_url'     => $widget_url,
				'import_redux'         => array(
					array(
						'file_url'   => "https://demosamples.thembay.com/zota/furniture/home/redux_options.json",
						'option_name' => 'zota_tbay_theme_options',
					),
				),
				'rev_sliders'                => $rev_sliders,
				'import_preview_image_url'   => "https://demosamples.thembay.com/zota/furniture/home/screenshot.jpg",
				'import_notice'              => esc_html__( 'After you import this demo, you will have to setup the slider separately.', 'zota' ),
				'preview_url'                => 'https://el1.thembaydev.com/zota_furniture/',
			),
		);
	}
}