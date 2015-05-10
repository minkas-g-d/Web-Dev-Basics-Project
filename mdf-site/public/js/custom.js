'use strict';

(function ($) {

    $(function() {

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

            $.post('/user/new-post', params, function(data) {

                var data = $.parseJSON(data);
                //console.log(data);
                if(data.success) {
                    $('#addPostForm').prepend('<div class="4u" style="color:green;"><a href="http://localhost:8080/posts/view/' + data.postId +  '">View Post</a></div>');
                    clearFields();
                    utilities.notify('success', data.success, 1500);
                } else if(data.error) {
                    utilities.notify('error', data.error);
                }
            });
        });

        $('.delete-post').on('click', function(e) {
            e.preventDefault();
            var $btn = $(this);
            var href = $btn.attr('href');

            $.get(href, function(data) {
                var data = $.parseJSON(data);
                if(data.success) {
                    utilities.notify('success', data.success, 1500);
                    $btn.closest('.row').remove();
                } else if(data.error) {
                    utilities.notify('error', data.error);
                }
            });
        });

        $('#register').on('click', function(){
            var uname = $('#uname').val().trim();
            var upass = $('#upass').val().trim();
            var email = $('#email').val().trim();
            var upconfirm = $('#upass-confirm').val().trim();
            var fname = $('#fname').val().trim();
            var lname = $('#lname').val().trim();

            if(!uname) {
                utilities.notify('warning', 'Username MUST NOT be empty!'); return;
            }
            if(!upass) {
                utilities.notify('warning', 'Password MUST NOT be empty!'); return;
            }
            if(!upconfirm) {
                utilities.notify('warning', 'Reenter password!'); return;
            }
            if(!email) {
                utilities.notify('warning', 'Email MUST NOT be empty!'); return;
            }
            if(upass !== upconfirm) {
                utilities.notify('warning', 'Passwords does not match!'); return;
            }

            var params = {
                uname: uname,
                upass: upass,
                upconfirm: upconfirm,
                email: email,
                fname: fname,
                lname: lname
            };

            console.log(params);

            $.post('/user/new', params, function(data) {
                var data = $.parseJSON(data);
                if(data.success) {
                    utilities.notify('success', data.success);
                    clearFields();
                    utilities.redirectToHome(1500, '/user/login');
                } else if(data.error) {
                    utilities.notify('error', data.error);
                }
            });
        });

        $('#login').on('click', function(){
            var uname = $('#uname').val().trim();
            var upass = $('#upass').val().trim();

            if(!uname) {
                utilities.notify('warning', 'Username MUST NOT be empty!'); return;
            }
            if(!upass) {
                utilities.notify('warning', 'Password MUST NOT be empty!'); return;
            }

            var params = {
                uname: uname,
                upass: upass
            }

            $.post('/user/signin', params, function(data) {
                //console.log(data);
                var data = $.parseJSON(data);
                if(data.success) {
                    utilities.notify('success', data.success);
                    utilities.redirectToHome(1000, '/user/add-post');
                } else if(data.error) {
                    utilities.notify('error', data.error, 2000);
                }
            });
        });

        $('#logout').on('click', function(e) {
            e.preventDefault();
            $.post('/user/logout', function(data) {
                var data = $.parseJSON(data);
                if(data.success) {
                    utilities.notify('success', data.success);
                    utilities.redirectToHome(1500);
                } else if(data.error) {
                    utilities.notify('error', data.error, 5000);
                }
            });
        });
    });

    function clearFields() {
        if($('input')) {
            $('input[type=text]').val('');
            $('input[type=password]').val('');
            $('input[type=email]').val('');
        }

        if($('textarea')) {
            $('textarea').val('');
        }
    }
})(jQuery);