<h3>
    <?php _e( 'School' ); ?>
</h3>
<table class="form-table">
    <tr>
        <th>
            <label for="school">
                <?php _e( 'Select school' ); ?>
            </label>
        </th>
        <td>
            <?php
            /* If there are any school terms, loop through them and display checkboxes. */
            if ( !empty( $terms ) ) {
            foreach ( $terms as $term ) { ?>
            <input type="radio" name="school" id="school-<?php echo esc_attr( $term->slug ); ?>" value="<?php echo esc_attr( $term->slug ); ?>"
            <?php checked( true, is_object_in_term( $user->
            ID, 'school', $term ) ); ?>
            />
            <label for="school-<?php echo esc_attr( $term->slug ); ?>">
                <?php echo $term->
                name; ?>
            </label>
            <br />
            <?php }
            }
            /* If there are no school terms, display a message. */
            else {
            _e( 'There are no schools available.' );
            }
            ?>
        </td>
    </tr>
    <tr>
      <th><label for="year"><?php _e("Year"); ?></label></th>
      <td>
        <input type="text" name="year" id="year" class="regular-text" 
            value="<?php echo esc_attr( get_the_author_meta( 'year', $user->ID ) ); ?>" /><br />
        <!-- <span class="description"><?php _e("Please enter your year."); ?></span> -->
    </td>
    </tr>
</table>
