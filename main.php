<?php
/**
 * Plugin Name: CTA Shortcode Plugin
 * Description: Starting point for cta shortcode
 * Version: 0.1
 * Author: Chris Cline
 * Author URI:
 */

// Exit if this wasn't accessed via WordPress (aka via direct access)
if (!defined('ABSPATH')) exit;

class CtaShortcode {
    public function __construct() {

        //add styles and scripts
        add_action('wp_enqueue_scripts', array($this,'enqueue'));
        //add the shortcode
        add_shortcode('cta_button', array($this,'shortcode'));
    }

    // shortcode function
    public function shortcode($atts) {

    //load script/styles only if shorcode is present
    wp_enqueue_style('short-code-styles');
    wp_enqueue_script('short-code-scripts');

        $a = shortcode_atts(
    		array(
                'copy' => 'Your Copy Here',
    			'url' => '#',
    			'text' => 'default text',
    		), $atts );


    	$output = '<div class="cta-wrapper">';

    	return $output .= '<h2 class="cta-copy">'. $a['copy'].'</h2>
        <a href="'. $a['url'] .'" class="cta-button" >'. $a['text'].'</a>

        </div>';

    }

    //register scripts/styles
    public function enqueue() {
        wp_register_style('short-code-styles', plugins_url('css/shortcode.css', __FILE__), null, '1.0');

        wp_register_script('short-code-scripts', plugins_url('js/shortcode.js', __FILE__), array( 'jquery' ), '1.0', true);
    }

}
// Let's do this thing!
$ctaShrtCode = new CtaShortcode();
