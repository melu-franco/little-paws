var postId = 0;

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

$('.like').on('click', function(event){
    event.preventDefault();
    postId = event.target.parentNode.parentNode.dataset['postid'];
    var isLike = event.target.previousElementSibling == null;

    $.ajax({
        method : 'POST',
        url : urlLike,
        data : {isLike: isLike, postId: postId, _token: token}
    })
    .done(function(){
        event.target.innerText = isLike ? event.target.innerText == 'Like' : 'Dislike';
        if (isLike) {
            event.target.InnerText = 'Dislike';
        } else {
            event.target.InnerText = 'Like';
        }
    });
});


