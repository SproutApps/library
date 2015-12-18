<table id="si_client_dashboard_invoices" class="table table-hover">
	<thead>
		<tr>
			<th><?php _e( 'Issued', 'sprout-invoices' ) ?></th>
			<th><?php _e( 'Status', 'sprout-invoices' ) ?></th>
			<th><?php _e( 'ID', 'sprout-invoices' ) ?></th>
			<th><?php _e( 'Invoice', 'sprout-invoices' ) ?></th>
			<th><?php _e( 'Totals', 'sprout-invoices' ) ?></th>
		</tr>
	</thead>
	<tbody>
		<?php if ( ! empty( $invoices ) ) :
			$total_balance_due = 0;
			foreach ( $invoices as $invoice_id ) :
				$invoice = SI_Invoice::get_instance( $invoice_id );

				if ( ! is_a( $invoice, 'SI_Invoice' ) ){
					continue;
				}

				if ( 'write-off' === si_get_invoice_status( $invoice_id ) ) {
					continue;
				}

				$total_balance_due += si_get_invoice_balance( $invoice_id );

				// Get a label class for the status.
				switch ( si_get_invoice_status( $invoice_id ) ) {
					case 'publish':
						$label = 'primary';
						break;
					case 'partial':
						$label = 'primary';
						break;
					case 'complete':
						$label = 'success';
						break;
					case 'write-off':
						$label = 'warning';
						break;
					case 'temp':
					default:
						$label = 'default';
						break;
				} ?>
				<tr class="status_<?php echo esc_attr( $label ); ?> <?php if ( isset($_GET['id']) && $invoice_id === $_GET['id'] ) { echo 'highlight'; } ?>">
					<td>
						<small><time datetime="<?php si_invoice_issue_date( $invoice_id ) ?>"><?php echo date_i18n( apply_filters( 'si_client_dash_date_format', 'M. jS' ), si_get_invoice_issue_date( $invoice_id ) ) ?></time></small>
					</td>
					<td>
						<span class="label label-<?php echo esc_attr( $label ); ?>"><?php si_invoice_status( $invoice_id ) ?></span>
					</td>
					<td>
						<?php si_invoice_id( $invoice_id ) ?>
					</td>
					<td>
						<?php if ( 'temp' !== si_get_invoice_status( $invoice_id ) ) : ?>
							<a href="<?php echo esc_url( add_query_arg( array( 'dashboard' => 1 ), get_permalink( $invoice_id ) ) )?>"><?php echo get_the_title( $invoice_id ) ?></a>
						<?php else : ?>
							<?php echo get_the_title( $invoice_id ) ?>
						<?php endif ?>
					</td>

					<td>
						<?php do_action( 'si_client_dashboard_payment_column', $invoice ); ?>
						<?php if ( 'temp' === si_get_invoice_status( $invoice_id ) ) : ?>
							<span class="badge"><?php si_invoice_balance( $invoice_id ) ?></span>
							<br/>
							<small><?php _e( '<b>Pending</b> Review', 'sprout-invoices' ) ?></small>
						<?php elseif ( si_get_invoice_balance( $invoice_id ) ) : ?>  	<!-- Invoice has a balance -->
							<span class="badge balance_badge"><?php si_invoice_balance( $invoice_id ) ?></span>
							<a href="<?php echo esc_url( add_query_arg( array( 'dashboard' => 'pay' ), get_permalink( $invoice_id ) ) ) ?>" class="pay_link cloak"><span class="badge pay_badge"><?php _e( 'Pay', 'sprout-invoices' ) ?></span></a>
							<br/>
							<?php if ( si_get_invoice_due_date( $invoice_id ) ) : ?>
								<small><time datetime="<?php si_invoice_due_date( $invoice_id ) ?>"><?php printf( __( '<b>Due:</b> %s', 'sprout-invoices' ), date_i18n( apply_filters( 'si_client_dash_date_format', 'M. jS' ), si_get_invoice_due_date( $invoice_id ) ) ) ?></time></small>
							<?php endif ?>
						<?php else : ?> <!-- Invoice is paid -->
							<span class="badge"><?php si_invoice_payments_total( $invoice_id ) ?></span>
							<br/>
							<small><?php _e( '<b>Paid</b> in full', 'sprout-invoices' ) ?></small>
						<?php endif ?>
						<?php do_action( 'si_client_dashboard_payment_column_after', $invoice ); ?>
					</td>
				</tr>

				<tr class="info_row">

					<td colspan="3">
						<?php do_action( 'si_client_dashboard_invoice_info_row', $invoice ); ?>
						<div class="estimate_info_row_wrap">
							<?php if ( $invoice->get_estimate_id() ) : ?>
								<?php $estimate_id = $invoice->get_estimate_id(); ?>
								<?php if ( get_post_type( $estimate_id ) === SI_Estimate::POST_TYPE ) : ?>
									<small><?php printf( '<b>Estimate:</b> <a href="%s">%s</a>', get_permalink( $estimate_id ), get_the_title( $estimate_id ) ) ?></small>
								<?php endif ?>
							<?php endif ?>
						</div>
					</td>

					<td colspan="2">
						<?php do_action( 'si_client_dashboard_payment_info_row', $invoice ); ?>
						<?php if ( $inv_payments = $invoice->get_payments() ) : ?>
							<?php foreach ( $inv_payments as $payment_id ) : ?>
								<?php
									$payment = SI_Payment::get_instance( $payment_id );
									$method = ( strpos( strtolower( $payment->get_payment_method() ), 'credit' ) !== false ) ? __( 'Credit Card', 'sprout-invoices' ) : $payment->get_payment_method();
										?>
								<small><?php printf( __( '<b>%s:</b> %s', 'sprout-invoices' ), $method, sa_get_formatted_money( $payment->get_amount(), $invoice_id ) ) ?></small>
							<?php endforeach ?>
						<?php endif ?>
					</td>

				</tr>

			<?php endforeach ?>

		<?php else : ?>
			<tr><td colspan="5" rowspan="3"><?php _e( 'No invoices available.', 'sprout-invoices' ) ?></td></tr>
		<?php endif ?>
	</tbody>
	<?php if ( count( $invoices ) > 1 && $total_balance_due ) : ?>
		<tfoot>
			<tr>
				<td colspan="3">&nbsp;</td>
				<td colspan="1"><?php printf( __( 'Balance Due: <b>%s</b>', 'sprout-invoices' ), sa_get_formatted_money( $total_balance_due ) ) ?></td>
			</tr>
		</tfoot>
	<?php endif ?>
</table>