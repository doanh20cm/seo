<?php
namespace CoccoCore\CPT\Shortcodes\SocialShare;

use CoccoCore\Lib;

class SocialShare implements Lib\ShortcodeInterface {
	private $base;
	private $socialNetworks;
	
	function __construct() {
		$this->base           = 'mkdf_social_share';
		$this->socialNetworks = array(
			'facebook',
			'twitter',
			'linkedin',
			'tumblr',
			'pinterest',
			'vk'
		);
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function getSocialNetworks() {
		return $this->socialNetworks;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Mikado Social Share', 'cocco-core' ),
					'base'                      => $this->getBase(),
					'icon'                      => 'icon-wpb-social-share extended-custom-icon',
					'category'                  => esc_html__( 'by COCCO', 'cocco-core' ),
					'allowed_container_element' => 'vc_row',
					'params'                    => array(
						array(
							'type'       => 'dropdown',
							'param_name' => 'type',
							'heading'    => esc_html__( 'Type', 'cocco-core' ),
							'value'      => array(
								esc_html__( 'List', 'cocco-core' )     => 'list',
								esc_html__( 'Dropdown', 'cocco-core' ) => 'dropdown'
							)
						),
						array(
							'type'       => 'dropdown',
							'param_name' => 'icon_type',
							'heading'    => esc_html__( 'Icons Type', 'cocco-core' ),
							'value'      => array(
								esc_html__( 'Font Awesome', 'cocco-core' ) => 'font-awesome',
								esc_html__( 'Font Elegant', 'cocco-core' ) => 'font-elegant'
							)
						),
						array(
							'type'       => 'textfield',
							'param_name' => 'title',
							'heading'    => esc_html__( 'Social Share Title', 'cocco-core' ),
							'dependency' => array( 'element' => 'type', 'value' => array( 'list' ) )
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args   = array(
			'type'      => 'list',
			'icon_type' => 'font-elegant',
			'title'     => ''
		);
		$params = shortcode_atts( $args, $atts );
		
		//Is social share enabled
		$params['enable_social_share'] = ( cocco_mikado_options()->getOptionValue( 'enable_social_share' ) == 'yes' ) ? true : false;
		
		//Is social share enabled for post type
		$post_type         = get_post_type();
		$params['enabled'] = ( cocco_mikado_options()->getOptionValue( 'enable_social_share_on_' . $post_type ) == 'yes' ) ? true : false;
		
		//Social Networks Data
		$params['networks'] = $this->getSocialNetworksParams( $params );
		
		$html = '';
		
		if ( $params['enable_social_share'] ) {
			if ( $params['enabled'] ) {
				$html .= cocco_core_get_shortcode_module_template_part( 'templates/' . $params['type'], 'social-share', '', $params );
			}
		}
		
		return $html;
	}

    /**
     * Get Social Networks data to display
     * @return array
     */
	private function getSocialNetworksParams( $params ) {
		$networks   = array();
		$icons_type = $params['icon_type'];
		
		foreach ( $this->socialNetworks as $net ) {
			$html = '';
			
			if ( cocco_mikado_options()->getOptionValue( 'enable_' . $net . '_share' ) == 'yes' ) {
				$image                 = wp_get_attachment_image_src( get_post_thumbnail_id(), 'full' );
				$params                = array(
					'name' => $net
				);
				$params['link']        = $this->getSocialNetworkShareLink( $net, $image );
				$params['icon']        = $this->getSocialNetworkIcon( $net, $icons_type );
				$params['custom_icon'] = ( cocco_mikado_options()->getOptionValue( $net . '_icon' ) ) ? cocco_mikado_options()->getOptionValue( $net . '_icon' ) : '';
				
				$html = cocco_core_get_shortcode_module_template_part( 'templates/parts/network', 'social-share', '', $params );
			}
			
			$networks[ $net ] = $html;
		}
		
		return $networks;
	}

    /**
     * Get share link for networks
     *
     * @param $net
     * @param $image
     * @return string
     */
    private function getSocialNetworkShareLink($net, $image) {
        switch ($net) {
            case 'facebook':
                if (wp_is_mobile()) {
                    $link = 'window.open(\'http://m.facebook.com/sharer.php?u=' . get_permalink() . '\');';
                } else {
                    $link = 'window.open(\'http://www.facebook.com/sharer/sharer.php?u=' . get_permalink() . '\');';
                }
                break;
            case 'twitter':
                $count_char = (isset($_SERVER['https'])) ? 23 : 22;
                $twitter_via = (cocco_mikado_options()->getOptionValue('twitter_via') !== '') ? ' via ' . cocco_mikado_options()->getOptionValue('twitter_via') . ' ' : '';
                $link =  'window.open(\'https://twitter.com/intent/tweet?text=' . urlencode( cocco_mikado_the_excerpt_max_charlength( $count_char ) . $twitter_via ) . ' ' . get_permalink() . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');';
                break;
            case 'linkedin':
                $link = 'popUp=window.open(\'http://linkedin.com/shareArticle?mini=true&amp;url=' . urlencode(get_permalink()) . '&amp;title=' . urlencode(get_the_title()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'tumblr':
                $link = 'popUp=window.open(\'http://www.tumblr.com/share/link?url=' . urlencode(get_permalink()) . '&amp;name=' . urlencode(get_the_title()) . '&amp;description=' . urlencode(get_the_excerpt()) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'pinterest':
                $link = 'popUp=window.open(\'http://pinterest.com/pin/create/button/?url=' . urlencode(get_permalink()) . '&amp;description=' . sanitize_title(get_the_title()) . '&amp;media=' . urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            case 'vk':
                $link = 'popUp=window.open(\'http://vkontakte.ru/share.php?url=' . urlencode(get_permalink()) . '&amp;title=' . urlencode(get_the_title()) . '&amp;description=' . urlencode(get_the_excerpt()) . '&amp;image=' . urlencode($image[0]) . '\', \'popupwindow\', \'scrollbars=yes,width=800,height=400\');popUp.focus();return false;';
                break;
            default:
                $link = '';
        }

        return $link;
    }
	
	private function getSocialNetworkIcon( $net, $type ) {
		switch ( $net ) {
			case 'facebook':
				$icon = ( $type == 'font-elegant' ) ? 'social_facebook' : 'fab fa-facebook';
				break;
			case 'twitter':
				$icon = ( $type == 'font-elegant' ) ? 'social_twitter' : 'fab fa-twitter';
				break;
			case 'linkedin':
				$icon = ( $type == 'font-elegant' ) ? 'social_linkedin' : 'fab fa-linkedin';
				break;
			case 'tumblr':
				$icon = ( $type == 'font-elegant' ) ? 'social_tumblr' : 'fab fa-tumblr';
				break;
			case 'pinterest':
				$icon = ( $type == 'font-elegant' ) ? 'social_pinterest' : 'fab fa-pinterest';
				break;
			case 'vk':
				$icon = 'fab fa-vk';
				break;
			default:
				$icon = '';
		}
		
		return $icon;
	}
}