<?php
/*
Plugin Name: CF7getParams
Plugin URI: http://optimizaclick.com
Description: Get values to form
Author: Departamento de Desarrollo Optimizaclick
Author URI: http://#
Version: 1.0
Copyright: 2016 - 2017
*/

if ( ! defined( 'ABSPATH' ) ) exit;
if ( ! class_exists( 'CF7getClass' ) ) {
  class CF7getClass {
      public function __construct() {
        add_action( 'wpcf7_init', array($this, 'cf7_shortcodes_get'));
      }

      public function cf7_shortcodes_get() {
          if ( function_exists( 'wpcf7_add_form_tag' ) ) {
              wpcf7_add_form_tag( 'getparam', array($this,'getparam_cf7'), true );
              wpcf7_add_form_tag( 'showparam', array($this, 'showparam_cf7'), true );
          }
      }

      public function getparam_cf7($tag) {
          $name = $tag['name'];

          $html = '<input type="hidden" name="' . $name . '" value="'. esc_attr( $_GET[$name] ) . '" />';
          return $html;
      }

      public function showparam_cf7($tag) {

          if (!is_array($tag)) return '';

          $name = $tag['name'];

          if (empty($name)) return '';

          $html = esc_html( $_GET[$name] );

          return $html;
      }
  }
  $GLOBALS['CF7getClass'] = new CF7getClass();
}
