<?php
/**
 * The template used to display file form fields.
 *
 * @author 	Studio 164a
 * @since 	1.0.0
 * @version 1.0.0
 */

if ( ! isset( $view_args[ 'form' ] ) || ! isset( $view_args[ 'field' ] ) ) {
	return;
}

$form 			= $view_args[ 'form' ];
$field 			= $view_args[ 'field' ];
$classes 		= $view_args[ 'classes' ];
$value			= isset( $field[ 'value' ] ) ? $field[ 'value' ] : '';
?>
<div id="charitable_field_<?php echo esc_attr( $field[ 'key' ] ) ?>_wrapper" class="<?php echo esc_attr( $classes ) ?>">	
	<?php if ( isset( $field[ 'label' ] ) ) : ?>
		<label for="charitable_field_<?php echo esc_attr( $field[ 'key' ] ) ?>">
			<?php echo esc_html( $field[ 'label' ] ) ?>			
		</label>
	<?php endif ?>
	<input id="charitable_field_<?php echo esc_attr( $field['key'] ) ?>" type="file" name="<?php echo esc_attr( $field[ 'key' ] ) ?>" value="<?php echo esc_attr( $value ) ?>" <?php echo charitable_get_arbitrary_attributes( $field ) ?>/>
</div>