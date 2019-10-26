<?php

// Load the WordPress library.
require_once dirname( dirname( __FILE__ ) ) . '/wp-load.php';

// Set up the WordPress query.
wp();

if ( ! $argv[1] ) {
	die( 'Missing argument' );
}

// @Todo Temporary solution, needs to be cleaned
$local_url      = 'http://' . $argv[1];
$remote_url_ssl = get_site_url( null, '', 'https' );
$remote_url     = get_site_url( null, '', 'http' );

replace_options( $local_url, $remote_url_ssl );
replace_options( $local_url, $remote_url );
replace_postmeta( $local_url, $remote_url_ssl );
replace_postmeta( $local_url, $remote_url );

update_option( 'siteurl', $local_url );
update_option( 'home', $local_url );

/**
 * Search and replace URL for options table
 *
 * @param $local_url String Local site URL
 * @param $remote_url String Remote site URL
 */
function replace_options( $local_url, $remote_url ) {
	global $wpdb;
	$query   = $wpdb->prepare( "SELECT * FROM `{$wpdb->prefix}options` WHERE `option_value` LIKE '%{$remote_url}%'", [] );
	$options = $wpdb->get_results( $query );

	foreach ( $options as $option_value ) {
		// Edit option value.
		$meta_value = @unserialize( $option_value->option_value );

		if ( ! $meta_value ) {
			continue;
		}

		recursive_array_replace( $remote_url, $local_url, $meta_value );

		$meta_value = @serialize( $meta_value );

		$wpdb->update(
			$wpdb->prefix . 'options',
			[ 'option_value' => $meta_value ],
			[ 'option_id' => $option_value->option_id ]
		);
	}
}

/**
 * Search and replace URL for postmeta table
 *
 * @param string $local_url  Local site URL.
 * @param string $remote_url Remote site URL.
 */
function replace_postmeta( $local_url, $remote_url ) {
	global $wpdb;
	$query     = $wpdb->prepare( "SELECT * FROM `{$wpdb->prefix}postmeta` WHERE `meta_value` LIKE '%{$remote_url}%'", [] );
	$post_metas = $wpdb->get_results( $query );
	foreach ( $post_metas as $post_meta ) {
		// Edit meta value
		$meta_value = @unserialize( $post_meta->meta_value );
		if ( ! $meta_value ) {
			continue;
		}
		recursive_array_replace( $remote_url, $local_url, $meta_value );

		$meta_value = @serialize( $meta_value );

		$wpdb->update(
			$wpdb->prefix . 'postmeta',
			[ 'meta_value' => $meta_value ],
			[ 'meta_id' => $post_meta->meta_id ]
		);
	}
}


/**
 * Replace data in array
 *
 * @param string       $search Search term.
 * @param string       $replace Replace term.
 * @param string|array $array
 *
 * @return boolean
 */
function recursive_array_replace( $search, $replace, &$array ) {
	$result = false;
	if ( ! is_array( $array ) ) {
		if ( is_string( $array ) && preg_match( "@$search@i", $array ) ) {
			$array = preg_replace( "@$search@i", $replace, $array );
			return true;
		}
		return false;
	}

	foreach ( $array as $key => $value ) {
		$recursive_result = recursive_array_replace( $search, $replace, $value );
		if ( $recursive_result ) {
			$array[ $key ] = $value;
			$result        = true;
		}
	}

	return $result;
}
