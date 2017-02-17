$().ready(function(){

    $('#edit').click(function(){

        var done = ($('#done').prop('checked') == false) ? 0 : 1 ;
        var message = $('#message').val();

        $.ajax({
            method: "POST",
            url: "/ajax/edittask",
            data: { done:done, message:message, id:edit_id }
        })
        .done(function( msg ) {
            window.location.href = '/';
        });

    });

});