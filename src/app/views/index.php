<?php
/*
 * David Bray
 * BrayWorth Pty Ltd
 * e. david@brayworth.com.au
 *
 * MIT License
 *
*/
	?>
<br />
<br />
<br />
<ul class="list-unstyled mt-4">
	<li><h4>Index</h4></li>
	<li><a href="#" id="<?= $uid = strings::rand() ?>">Tic Tac Toe</a></li>

</ul>
<br />
<br />
<br />
<br />
<script>
(function($) {
	$(document).ready( function() {
		$('#<?= $uid ?>').on( 'click', function( e) {
			e.stopPropagation(); e.preventDefault();

			_brayworth_.loadModal( {
				url : _brayworth_.url( 'hello/tictactoe')

			});

		});

	});

})( jQuery);
</script>