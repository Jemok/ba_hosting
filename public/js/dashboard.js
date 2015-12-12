$(document).ready(function(){
	setTimeout(function(){
		$('.msg__box').fadeOut();
	}, 2000);

	// init Isotope
	var $grid = $('.innoList').isotope({
		itemSelector: '.inno',
		layoutMode: 'fitRows'
	});

	// filter functions
	var filterFns = {
		// show if number is greater than 50
		numberGreaterThan50: function() {
			var number = $(this).find('.number').text();
			return parseInt( number, 10 ) > 50;
		},
		// show if name ends with -ium
		ium: function() {
			var name = $(this).find('.name').text();
			return name.match( /ium$/ );
		}
	};

	// bind filter button click
	$('.innoFilters').on( 'click', 'button', function() {
		var filterValue = $( this ).attr('data-filter');
		// use filterFn if matches value
		filterValue = filterFns[ filterValue ] || filterValue;
		$grid.isotope({ filter: filterValue });
	});

	// change is-checked class on buttons
	$('.innoFilters').each( function( i, buttonGroup ) {
		var $buttonGroup = $( buttonGroup );
		$buttonGroup.on( 'click', 'button', function() {
			$buttonGroup.find('.current').removeClass('current');
			$( this ).addClass('current');
		});
	});

	$('.innoNew').find('.cta__create').click(function(){
		$(this).fadeOut();
		$('.step__2').slideDown();
	});
	$('.innoNew').find('.cta__next').click(function(){
		$('.step__2').slideUp();
		$('.step__3').slideDown();
	});
	$('.innoNew').find('.cta__publish').click(function(){
		$('.step__3').slideUp();
		$('.step__feedback').slideDown();
	});
});
