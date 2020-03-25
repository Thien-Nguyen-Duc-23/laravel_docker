function ajaxActiveStatus(id_user, presentStatus, url){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    if(confirm('Are you sure to change this record ?'))
    {
        $.ajax({
            url: url,
            type: 'POST',
            cache: false,
            data: 
            {
                id : id_user, status : presentStatus, _token: $('meta[name="csrf-token"]').attr('content'),
            },
            
            success: function(data)
            {
                $('td').remove(".testRomeve"+id_user);
                $('#'+id_user).append(data);
            },
            error: function ()
            {
                alert('Whoop! Some thing wrong...');
            }
        });
    }

    return false;
}
