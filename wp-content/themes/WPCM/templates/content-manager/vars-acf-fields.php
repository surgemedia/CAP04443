 <?php
    $field = get_field_object('sign_off_level');
    $field_file = get_field_object('upload_content');

    $value = get_field('sign_off_level');
    $label = $field['choices'][ $value ];
    $color = get_color($value,false);

    $field_design = get_field_object('sign_off_level_design');
    $field_design_file = get_field_object('upload_content_design');

    $value_design = get_field('sign_off_level_design');
    $label_design = $field['choices'][$value_design];
    $color_design = get_color($value_design,false);
 ?>