<?php
/**
 * Add the field "fandom_id" to REST API responses for posts read and write
 */
add_action( 'rest_api_init', 'slug_register_fandom_id' );

function slug_register_fandom_id() {
	register_rest_field( 'post',
		'fandom_id',
		array(
			'get_callback'    => 'slug_get_fandom_id',
			'update_callback' => 'slug_update_fandom_id',
			'schema'          => null,
		)
	);
}

/**
 * Handler for getting custom field data.
 *
 * @param array $object The object from the response
 * @param string $field_name Name of field
 * @param WP_REST_Request $request Current request
 *
 * @return mixed
 */
function slug_get_fandom_id( $object, $field_name, $request ) {
	return get_post_meta( $object[ 'id' ], $field_name, true );
}

/**
 * Handler for updating custom field data.
 *
 * @param mixed $value The value of the field
 * @param object $object The object from the response
 * @param string $field_name Name of field
 *
 * @return bool|int
 */
function slug_update_fandom_id( $value, $object, $field_name ) {
	$new_value = (!empty( $value ) && is_numeric( $value )) ? intval( $value ) : '';

	return update_post_meta( $object->ID, $field_name, $new_value );
}