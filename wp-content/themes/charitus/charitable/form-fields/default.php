<?php
/**
 * The template used to display text form fields.
 *
 * @author  Studio 164a
 * @since   1.0.0
 * @version 1.0.0
 */

if ( ! isset( $view_args[ 'form' ] ) || ! isset( $view_args[ 'field' ] ) ) {
    return;
}

$form           = $view_args[ 'form' ];
$field          = $view_args[ 'field' ];
$classes        = esc_attr( $view_args[ 'classes' ] );
$field_type     = isset( $field[ 'type' ] ) ? $field[ 'type' ] : 'text';
$is_required    = isset( $field[ 'required' ] ) ? $field[ 'required' ] : false;
$value          = isset( $field[ 'value' ] ) ? $field[ 'value' ] : '';

?>
<div id="charitable_field_<?php echo esc_attr( $field['key'] ) ?>_wrapper" class="<?php echo esc_attr( $classes ) ?>">
    <?php if ( isset( $field['label'] ) ) : ?>
        <label for="charitable_field_<?php echo esc_attr( $field['key'] ) ?>">
            <?php echo esc_html( $field['label'] ) ?>
            <?php if ( $is_required ) : ?>
                <abbr class="required" title="required">*</abbr>
            <?php endif ?>
        </label>
    <?php endif ?>
    <?php if ( isset( $field[ 'help' ] ) ) : ?>
        <p class="charitable-field-help"><?php echo esc_html( $field[ 'help' ] ) ?></p>
    <?php endif ?>
    <input id="charitable_field_<?php echo esc_attr( $field['key'] ) ?>" type="<?php echo esc_attr( $field_type ) ?>" name="<?php echo esc_attr( $field[ 'key' ] ) ?>" value="<?php echo esc_attr( stripslashes( $value ) ) ?>" <?php echo charitable_get_arbitrary_attributes( $field ) ?>/>
</div>