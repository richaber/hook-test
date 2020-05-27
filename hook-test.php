<?php
/**
 * Plugin Name:     Hook Test
 * Description:     Testing.
 * Version:         1.0.0
 * Author:          Richard Aber <richaber@gmail.com>
 * License:         GPL-2.0-or-later
 * License URI:     https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:     hook-test
 *
 * @since   1.0.0
 * @package RichAber/HookTest
 */

/**
 * Registers all block assets so that they can be enqueued through the block editor
 * in the corresponding context.
 *
 * @see     https://developer.wordpress.org/block-editor/tutorials/block-tutorial/applying-styles-with-stylesheets/
 *
 * @author  Richard Aber <richaber@gmail.com>
 * @since   1.0.0
 *
 * @throws Error If script asset does not exist.
 */
function hook_test_block_init() {

	$dir = dirname( __FILE__ );

	$script_asset_path = "$dir/build/index.asset.php";
	if ( ! file_exists( $script_asset_path ) ) {
		throw new Error(
			'You need to run `npm start` or `npm run build` for the "create-block/hook-test" block first.'
		);
	}

	$index_js     = 'build/index.js';
	$script_asset = require $script_asset_path;

	wp_register_script(
		'create-block-hook-test-block-editor',
		plugins_url( $index_js, __FILE__ ),
		$script_asset['dependencies'],
		$script_asset['version'],
		false
	);

	$editor_css = 'editor.css';

	wp_register_style(
		'create-block-hook-test-block-editor',
		plugins_url( $editor_css, __FILE__ ),
		array(),
		filemtime( "$dir/$editor_css" )
	);

	$style_css = 'style.css';

	wp_register_style(
		'create-block-hook-test-block',
		plugins_url( $style_css, __FILE__ ),
		array(),
		filemtime( "$dir/$style_css" )
	);

	register_block_type(
		'create-block/hook-test',
		[
			'editor_script' => 'create-block-hook-test-block-editor',
			'editor_style'  => 'create-block-hook-test-block-editor',
			'style'         => 'create-block-hook-test-block',
		]
	);
}

add_action( 'init', 'hook_test_block_init' );
