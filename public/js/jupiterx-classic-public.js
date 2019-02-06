(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

$( window ).load(function() {
	// external js: isotope.pkgd.js

	// init Isotope
	var $grid = $('.filter-grid').isotope({
		itemSelector: '.filter-card',
		layoutMode: 'fitRows',
		getSortData: {
			name: '.name',
			symbol: '.symbol',
			number: '.number parseInt',
			category: '[data-category]',
			weight: function (itemElem) {
				var weight = $(itemElem).find('.weight').text();
				return parseFloat(weight.replace(/[\(\)]/g, ''));
			}
		}
	});
	// filter functions
	// var filterFns = {
	// 	// show if number is greater than 50
	// 	numberGreaterThan50: function() {
	// 		var number = $(this).find('.number').text();
	// 		return parseInt( number, 10 ) > 50;
	// 	},
	// 	// show if name ends with -ium
	// 	ium: function() {
	// 		var name = $(this).find('.name').text();
	// 		return name.match( /ium$/ );
	// 	}
	// };
	// bind filter button click
	$('.filters-button-group').on( 'click', 'button', function() {
		var filterValue = $( this ).attr('data-filter');
		// use filterFn if matches value
		// filterValue = filterFns[ filterValue ] || filterValue;
		$grid.isotope({ filter: filterValue });
	});
	// change is-checked class on buttons
	$('.button-group').each( function( i, buttonGroup ) {
		var $buttonGroup = $( buttonGroup );
		$buttonGroup.on( 'click', 'button', function() {
			$buttonGroup.find('.is-checked').removeClass('is-checked');
			$( this ).addClass('is-checked');
		});
	});

	$('.sort-by-button-group').on( 'click', 'button', function() {
		var sortValue = $(this).attr('data-sort-value');
		$grid.isotope({ sortBy: sortValue });
	});

});




})( jQuery );
