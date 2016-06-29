<?php

/**
 * Plugin Name: Extend
 * Version: 1.0
 * Description: Extending WP-Cli
 * Author: Andrea Fuggetta <afuggetta@ndevr.io>
 * Author URI: https://ndevr.io
 * Plugin URI: https://ndevr.io
 * Text Domain: extend
 * Domain Path: /languages
 * @package Extend
 */
class Extend {
	public function __construct() {
		$this->init();
	}

	public function init() {
		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			WP_CLI::add_command( 'post-title', [ $this, 'get_post_title' ] );
		}
	}

	/**
	 * Get the latest post title
	 * Usage: wp latest-post latest | wp latest-post 1 | wp latest-post --id=1
	 *
	 * @synopsis [<ID>] [--id=<ID>]
	 */
	public function get_post_title($args, $assoc_args) {
		$id = 'latest';

		if ( isset( $args[0] ) || isset( $assoc_args['id'] ) ) {
			$id = isset( $args[0] ) ? $args[0] : $assoc_args['id'];
		}

		if ( $title = get_the_title($id) ) {
			WP_CLI::success( 'The post title is: ' . sanitize_text_field( $title ));
		} else {
			WP_CLI::error( 'Error while retrieving the post title' );
		}
	}
}

new Extend();