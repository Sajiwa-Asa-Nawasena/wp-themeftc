<form method="post">
	<div class="sale-report">
		<p class="a">
		<label style="display:inline;" for="from"><?php _e( 'From:', 'ornaldo' ); ?></label>
		<input class="date-pick" type="date" name="start_date" id="from"
			   value="<?php echo esc_attr( date( 'Y-m-d', $start_date ) ); ?>"/>
		</p>
		<p class="a">
		<label style="display:inline;" for="to"><?php _e( 'To:', 'ornaldo' ); ?></label>
		<input type="date" class="date-pick" name="end_date" id="to"
			   value="<?php echo esc_attr( date( 'Y-m-d', $end_date ) ); ?>"/>
		</p>
		<p class="a">
		<input type="submit" class="btn btn-inverse btn-small" style="float:none;"
			   value="<?php _e( 'Show', 'ornaldo' ); ?>"/>
			</p>
	</div>
</form>