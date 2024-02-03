<?php
/**
 * Admin Menu Register
 *
 * @package SnapCode
 */

namespace SnapCode\Hooks;

use SnapCode\Core\BasePlugin;

/**
 * Class AdminMenu
 */
class AdminMenu extends BasePlugin {

	/**
	 * Register hooks
	 */
	public function __construct() {
		parent::__construct();
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
	}

	/**
	 * Admin menu for wp tinker.
	 *
	 * @return void
	 */
	public function add_admin_menu() {
		$admin_menu_text = 'SnapCode';
		$parent_slug     = 'wp-tinker';
		add_menu_page(
			$admin_menu_text,
			$admin_menu_text,
			'manage_options',
			$parent_slug,
			array( $this, 'show_wp_tinker_page' ),
			'dashicons-editor-code',
		);
	}

	/**
	 * Show tinker page.
	 *
	 * @return void
	 */
	public function show_wp_tinker_page() {
		if ( isset( $_GET['view'] ) ) {
			$view      = sanitize_text_field( wp_unslash( $_GET['view'] ) );
			$view_path = $this->view_dir . "/$view.php";
			if ( file_exists( $view_path ) ) {
				include_once $view_path;
			}

			return;
		}

		include_once $this->view_dir . '/index.php';
	}
}
