function getComment(lang, avatar, name, urlRoute) {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        url: urlRoute,
        type: "POST",
        cache: false,
        data: {
            comment: $('#comment').val(),
            rating: $("input[name='rating']:checked").val(),
            user_id: $("input[name='user_id']").val(),
            book_id: $("input[name='book_id']").val(),
            _token: $('meta[name="csrf-token"]').attr('content'),
        },
        success: function(data){
            $('#alert-comment').hide();
            var comment = $('#comment').val();
            var htmlRespone = `<li class="review depth-1 " id="li-comment-7994">
                                        <div id="comment-7994" class="comment_container">
                                            <div class="comment-text">
                                                <p class="meta">
                                                    <img src="`+avatar+`" width="40" id="avatar-comment">
                                                    <span id="author-comment">
                                                        <strong class="woocommerce-review__author">`+name+`</strong>
                                                    </span>
                                                    <div class="clear"></div>
                                                    <em class="woocommerce-review__awaiting-approval" id="awaiting-comment">`+ lang+`</em>
                                                </p>
                                                <div class="description">
                                                    <p>`+comment+`</p>
                                                </div>
                                            </div>
                                        </div>
                                    </li>`;

            $(htmlRespone).prependTo( "#comments .commentlist" );
            elmnt = document.getElementById("reviews");
            elmnt.scrollIntoView();
            $('#commentform')[0].reset();
        },
        error: function (data){
            $('#alert-comment').empty();
            $.each(data.responseJSON.errors, function(key, value){
                $('#alert-comment').show();
                $('#alert-comment').append('<li>'+value+'</li>');
            });
        }
    });
}
