<?php
/*
	David Bray
	BrayWorth Pty Ltd
	e. david@brayworth.com.au

	This work is licensed under a Creative Commons Attribution 4.0 International Public License.
		http://creativecommons.org/licenses/by/4.0/

	*/	?>
<style>
.pointer { cursor: pointer; }
.forbidden { cursor: not-allowed; }
</style>

<div class="card" id="tictactoe">
	<div class="card-body" style="font-size: 3rem; padding: 0 15px;" game></div>
	<div class="card-footer" result>&nbsp;</div>

</div>

<script>
(function( $) {
	let props = {
		move : 'X',
		moves : 0,
		winner : '',
		history : []

	}

	let turn = function( e) {
		if ( props.winner == '') {
			if ( /(X|O)/.test( $( this).html())) return;

			props.moves ++;
			$( this).html( props.move).removeClass('pointer').addClass('forbidden').trigger( 'change');
			props.move = props.move == 'X' ? 'O' : 'X';

		}

	}

	let square = ( host) => {
		return $('<div class="col border text-center pointer">&nbsp;</div>')
			.on( 'click', turn)
			.on( 'change', () => { host.trigger( 'winner')})
			.appendTo( host);

	};

	(function( host) {
		let squares = [];

		host
		.on('render', function( e) {
			$(this).html('');

			(function( r) { squares.push( square( r), square( r), square( r))})( $('<div class="row" />').appendTo( host));
			(function( r) { squares.push( square( r), square( r), square( r))})( $('<div class="row" />').appendTo( host));
			(function( r) { squares.push( square( r), square( r), square( r))})( $('<div class="row" />').appendTo( host));

		})
		.on('winner', function( e) {
			let win = [
				[0,1,2],
				[0,4,8],
				[0,3,6],
				[1,4,7],
				[2,4,6],
				[2,5,8],
				[3,4,5],
				[6,7,8]
			];

			$.each( win, function( i, arr) {
				let a = squares[ arr[0]].html();
				let b = squares[ arr[1]].html();
				let c = squares[ arr[2]].html();

				if ( a == b && a == c && /(O|X)/.test( a)) {
					props.winner = a;
					return false;	// break

				}

			});

			let h = []
			$.each( squares, function( i, sq) {
				h.push( sq.html());

			});

			props.history.push( h);

			if ( /(O|X)/.test( props.winner)) {
				$('#tictactoe > [result]').html('Winner : ' + props.winner);

			}
			else if ( props.moves == 9 ) {
				$('#tictactoe > [result]').html('draw');

			}
			else {
				let bg = $('<div class="btn-group btn-group-sm" />');
				$.each( props.history, function( index, state) {
					$('<a href="#" class="btn btn-outline-primary" />').appendTo( bg).html( index).on( 'click', function( e) {
						e.stopPropagation(); e.preventDefault();

						props.moves = 0;
						let moves = { x : 0, o : 0 };
						$.each( state, function( i, el) {
							squares[i].html( el);
							if ( /(O|X)/.test( el)) {
								'O' == el ? moves.o++ : moves.x++;
								squares[i].removeClass('pointer').addClass('forbidden');
								props.moves ++;

							}
							else {
								squares[i].removeClass('forbidden').addClass('pointer');
								props.move = props.move == 'X' ? 'O' : 'X';

							}

						});

						props.move = moves.x > moves.o ? 'O' : 'X';
						if ( props.history.length > index) {
							props.history.splice( index, props.history.length - index +1);

						}

						host.trigger( 'winner');

					});

				});

				$('#tictactoe > [result]').html('').append( bg);

			}

		})

		host.trigger( 'render');

	})( $('#tictactoe > [game]'));

})( jQuery);
</script>