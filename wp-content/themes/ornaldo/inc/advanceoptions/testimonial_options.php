<?php 
$options = array();

$options[] = array(
				'id'		=> 'gravatar_email'
				,'label'	=> esc_html__('Gravatar Email Address', 'ornaldo')
				,'desc'		=> esc_html__('Enter in an e-mail address, to use a Gravatar, instead of using the "Featured Image". You have to remove the "Featured Image".', 'ornaldo')
				,'type'		=> 'text'
			);
			
$options[] = array(
				'id'		=> 'byline'
				,'label'	=> esc_html__('Byline', 'ornaldo')
				,'desc'		=> esc_html__('Enter a byline for the customer giving this testimonial (for example: "CEO of ThemeFTC").', 'ornaldo')
				,'type'		=> 'text'
			);
			
$options[] = array(
				'id'		=> 'url'
				,'label'	=> esc_html__('URL', 'ornaldo')
				,'desc'		=> esc_html__('Enter a URL that applies to this customer (for example: http://themeftc.com/).', 'ornaldo')
				,'type'		=> 'text'
			);
			
$options[] = array(
				'id'		=> 'rating'
				,'label'	=> esc_html__('Rating', 'ornaldo')
				,'desc'		=> ''
				,'type'		=> 'select'
				,'options'	=> array(
						'-1'	=> esc_html__('no rating', 'ornaldo')
						,'0'	=> esc_html__('0 star', 'ornaldo')
						,'0.5'	=> esc_html__('0.5 star', 'ornaldo')
						,'1'	=> esc_html__('1 star', 'ornaldo')
						,'1.5'	=> esc_html__('1.5 star', 'ornaldo')
						,'2'	=> esc_html__('2 stars', 'ornaldo')
						,'2.5'	=> esc_html__('2.5 stars', 'ornaldo')
						,'3'	=> esc_html__('3 stars', 'ornaldo')
						,'3.5'	=> esc_html__('3.5 stars', 'ornaldo')
						,'4'	=> esc_html__('4 stars', 'ornaldo')
						,'4.5'	=> esc_html__('4.5 stars', 'ornaldo')
						,'5'	=> esc_html__('5 stars', 'ornaldo')
				)
			);
?>