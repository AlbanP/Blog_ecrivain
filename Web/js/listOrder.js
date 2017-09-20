$( "table tbody" ).sortable( {
	update: function( event, ui ) {
    	$(this).children().each(function(index) {
			var prefix = 'Order';
			$(this).find('td').first().html(index + 1);
			$(this).find('input').attr('name', prefix + (index + 1));
    	});
  	}
});