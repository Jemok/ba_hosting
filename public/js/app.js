//renders item's new state to the page
function addItem( id) {
    $.get( "/chats/" + id, function( data ) {

            $( "#messages" ).append( data );

    });
}

//removes item's old state from the page
function removeItem( id ) {
    $( 'li[data-id="' + id + '"' ).remove();
}





(function($, addItem, removeItem) {

    $.get( "/chats", function( data ) {
        $( "#itemsList" ).html( data );
    });


    $( ".addFrm" ).submit(function() {
        $.post( "/chats/", $( this ).serialize(), function( data ) {

            //addItem( data.id, false );

            $( "#title" ).val( '' );
        });
        
        return false;
    });

    $( document ).on( "change", ".messages", function() {
        var id = $( this ).closest( 'li' ).data( 'id' );
        var messages = $( this ).prop( "checked" ) ? 1 : 0;

        $.ajax( '/chats/' + id, {
            data: { "messages": messages },
            method: 'PATCH',
            success: function() {

                //removeItem( id );
                //addItem( id, isCompleted );

            }
        });
    });

    $( document ).on( "click", ".deleteItem", function() {
        var id = $( this ).closest( 'li' ).data( 'id' );

        $.ajax( '/chats/' + id, {
            method: 'DELETE',
            success: function() {

                //removeItem( id );

            }
        });
    });

} )( jQuery, addItem, removeItem);
