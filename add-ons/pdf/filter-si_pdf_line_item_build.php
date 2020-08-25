<?php // don't include this in your functions.php

function line_item_build( $html, $item_data = array(), $position = 0, $has_children = false ) {
	$type = ( isset( $item_data['type'] ) ) ? $item_data['type'] : 'task' ;
	$columns = si_get_line_item_columns( $type );
	$desc = ( isset( $item_data['desc'] ) ) ? $item_data['desc'] : '' ; ?>
		<div class="<?php if ( filter_var( $position, FILTER_VALIDATE_INT ) !== false ) { echo 'item_with_children'; } ?>" style="padding-right: 3em;padding-bottom: 1em;">
			
			<?php if ( apply_filters( 'si_the_content_filter_line_item_descriptions', true ) ) : ?>
				<?php echo apply_filters( 'the_content', $desc ) ?>
			<?php else : ?>
				<?php echo wpautop( $desc ) ?>
			<?php endif ?>

			<?php foreach ( $columns as $column_slug => $column ) : ?>
					
				<?php if ( 'hidden' !== $column['type'] ) : ?>
					<?php
						$value = ( isset( $item_data[ $column_slug ] ) ) ? $item_data[ $column_slug ] : '' ;
						$label = ( wp_strip_all_tags( $column['label'] ) ) ? wp_strip_all_tags( $column['label'] ) . ':' : '&nbsp;' ;
						if ( '&#37;:' === $label ) {
							$label = '/';
						} ?>
					<?php if ( ! in_array( $column_slug, array( 'desc', 'total' ) ) ): ?>
						<span class="line_item_ind_desc"><?php echo $label ?></span>&nbsp;<?php echo apply_filters( 'si_format_front_end_line_item_value', $value, $column_slug, $item_data ) ?>
					<?php endif ?>

					<?php if ( 'total' === $column_slug ): ?>
						<dottab outdent="2em" />
						<span class="line_item_ind_desc">&nbsp;<?php echo apply_filters( 'si_format_front_end_line_item_value', $value, $column_slug, $item_data ) ?></span>
					<?php endif ?>


				<?php endif ?>

			<?php endforeach ?>

		</div>
	<?php
}
add_filter( 'si_pdf_line_item_build', '_modified_si_pdf_line_item_build', 10, 4 );