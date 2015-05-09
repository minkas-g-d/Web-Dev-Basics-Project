'use strict';

(function ($) {

    $(function() {
        //console.log($('#submit-post'));

        $('#add-post').on('click', function() {

            var title = $('#post-title').val();
            var content = $('#post-content').val();

            if (!title || !content) {
                utilities.notify('warning', 'Title and content fields MUST NOT be empty!');
                return;
            }

            var params = {
                'title': title,
                'content': content
            };

            $.post('/user/index/new', params, function(data) {

                var data = $.parseJSON(data);
                //console.log(data);
                if(data.success) {
                    $('#addPostForm').prepend('<div class="4u" style="color:green;"><a href="http://localhost:8080/posts/view/' + data.postId +  '">View Post</a></div>');
                    utilities.notify('success', data.success, 1500);
                } else if(data.error) {
                    utilities.notify('error', data.error);
                }
            });
        });

        $('#logout').on('click', function(e) {
            e.preventDefault();
            $.post('/user/index/logout', function(data) {
                //console.log(data);
                var data = $.parseJSON(data);
                if(data.success) {
                    utilities.notify('success', data.success);
                    utilities.redirectToHome(1500);
                } else if(data.error) {
                    utilities.notify('error', data.error);
                }
            });
        });
    });
})(jQuery);