(function($) {
   var $wp_inline_edit = inlineEditPost.edit;
   inlineEditPost.edit = function( id ) {
      $wp_inline_edit.apply( this, arguments );

      var $post_id = 0;
      if ( typeof( id ) == 'object' ) {
         $post_id = parseInt( this.getId( id ) );
      }

      if ( $post_id > 0 ) {
         var $edit_row = $( '#edit-' + $post_id );
	      var gtp_countries = $( '#gtp_countries-' + $post_id ).text();

         if ( gtp_countries.length ) {
            if ( gtp_countries.indexOf(',') > 0 ) {
               var parts = gtp_countries.split(',');
               for ( var i = 0; i < parts.length; i++ ) {
                  var part = parts[i];
                  part = part.trim().toLowerCase();
                  $edit_row.find( 'input[name="gtp_countries[]"][value="'+part+'"]' ).attr( 'checked', 'checked' );
               }
            } else {
               var part = gtp_countries.toLowerCase();
               $edit_row.find( 'input[name="gtp_countries[]"][value="'+part+'"]' ).attr( 'checked', 'checked' );
            }
         }
      }
   };

   $( '#bulk_edit' ).live( 'click', function() {

   // define the bulk edit row
   var $bulk_row = $( '#bulk-edit' );

   // get the selected post ids that are being edited
   var $post_ids = new Array();
   $bulk_row.find( '#bulk-titles' ).children().each( function() {
      $post_ids.push( $( this ).attr( 'id' ).replace( /^(ttle)/i, '' ) );
   });
   console.log($post_ids);
   // get the release date
   //var $gtp_countries = $bulk_row.find( 'input[name="gtp_countries[]"]:checked' ).val();
   var gtp_countries = $bulk_row.find( 'input[name="gtp_countries[]"]:checked' ).map(function() {
       return this.value;
   }).get();

   console.log(gtp_countries);
   // save the data
   $.ajax({
      url: ajaxurl, // this is a variable that WordPress has already defined for us
      type: 'POST',
      async: false,
      cache: false,
      data: {
         action: 'gtp_save_bulk_edit', // this is the name of our WP AJAX function that we'll set up next
         post_ids: $post_ids, // and these are the 2 parameters we're passing to our function
         gtp_countries: gtp_countries
      }
   }).done(function(data){
      console.log(data);
   });

});
})(jQuery);