//Price Range //

$( function() {
	$( "#slider-range" ).slider({
		range: true,
		min: 0,
		max: 10000,
		values: [ 1000, 6000 ],
		slide: function( event, ui ) {
			$( "#amount" ).val( "BDT " + ui.values[ 0 ] + " - BDT " + ui.values[ 1 ] );
		}
	});
	
	$( "#amount" ).val( "BDT " + $( "#slider-range" ).slider( "values", 0 ) +
	  " - BDT " + $( "#slider-range" ).slider( "values", 1 ) );
});
	    
//Price Range//