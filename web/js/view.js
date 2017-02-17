$().ready(function(){

    $('.sorted').click(function(){

        var sort = $(this).attr('sort');
        var route = $(this).attr('route');

        if(route == '' || route == 'desc') route = 'asc';
        else if(route == 'asc') route = 'desc';

        window.location.href = '/?sort='+sort+'&sort_route='+route;

    });

});