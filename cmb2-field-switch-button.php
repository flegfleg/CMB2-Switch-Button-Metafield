<?php
/**
 * Switch field type for cmb2
 *
 * based on: https: //github.com/improy/CMB2-Switch-Button-Metafield
 *
 * Usage:
 *             array(
 *            'name' => __( 'Field Name', 'cmb2' ),
 *            'desc'    => __( 'Field Description', 'cmb2' ),
 *            'id'      => 'your_switch_button',
 *            'type'    => 'switch',
 *            'default'    => 0,
 *            'disabled_warning' => true, // switch between gray and red button style for disabled.
 *            'label'    => array('on'=> 'Yes', 'off'=> 'No')
 *        ),
 */

add_action('cmb2_render_switch', 'cmb2_switch_button', 10, 5);
add_action('admin_init', 'cmb2_switch_enqueue_scripts_styles', 10, 2);

function cmb2_switch_enqueue_scripts_styles()
{
    wp_enqueue_style('cmb2-field-switch-styles', plugins_url('assets/css/style.css', __FILE__), null);
    wp_enqueue_script('cmb2-field-switch-js', plugins_url('assets/js/switch_metafield.js', __FILE__), array('jquery') );

}

function cmb2_switch_button($field, $escaped_value, $object_id, $object_type, $field_type_object)
{

    $switch = '<div class="cmb2-switch">';

    $conditional_value = (isset($field->args['attributes']['data-conditional-value']) ? 'data-conditional-value="' . esc_attr($field->args['attributes']['data-conditional-value']) . '"' : '');

    $conditional_id = (isset($field->args['attributes']['data-conditional-id']) ? ' data-conditional-id="' . esc_attr($field->args['attributes']['data-conditional-id']) . '"' : '');

    $label_on = (isset($field->args['label']) ? esc_attr($field->args['label']['on']) : 'On');
    $label_off = (isset($field->args['label']) ? esc_attr($field->args['label']['off']) : 'Off');

    $switch .= '<input ' . $conditional_value . $conditional_id . ' type="radio" id="' . $field->args['_id'] . '1" value="1"  ' . ($escaped_value == 1 ? 'checked="checked"' : '') . ' name="' . esc_attr($field->args['_name']) . '" />

	<input ' . $conditional_value . $conditional_id . ' type="radio" id="' . $field->args['_id'] . '2" value="0" ' . (($escaped_value == '' || $escaped_value == 0) ? 'checked="checked"' : '') . ' name="' . esc_attr($field->args['_name']) . '" />
		<label for="' . $field->args['_id'] . '2" class="cmb2-disable ' . (($escaped_value == '' || $escaped_value == 0) ? 'selected' : '') . ' ' . ((isset($field->args['disabled_warning']) && $field->args['disabled_warning'] == 1) ? 'warning' : '') . '"><span>' . $label_off . '</span></label>
		<label for="' . $field->args['_id'] . '1" class="cmb2-enable ' . ($escaped_value == 1 ? 'selected' : '') . '"><span>' . $label_on . '</span></label>';

    $switch .= '</div>';
    $switch .= $field_type_object->_desc(true);

    echo $switch;
}
