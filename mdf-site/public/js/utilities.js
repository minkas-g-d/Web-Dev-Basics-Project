'use strict';
var utilities = (function() {

    var tagsToReplace = {
        '&': '&amp;',
        '<': '&lt;',
        '>': '&gt;'
    };

    /********Notifications************/
    function notify(type, msg, timeout) {
        var time;

        if (timeout) {
            time = timeout;
        } else {
            time = (type == 'success') ? 1000 : 2000;
        }

        noty({
            text: msg,
            type: type,
            layout: 'topCenter',
            timeout: time
        });
    }

    function redirectToHome(delay, redirectURL) {
        var timeOfDelay = delay || 1000;
        var destination = location.protocol + '//' + location.host + '/';
        if (redirectURL) {
            destination += redirectURL;
        }
        console.log(timeOfDelay);
        setTimeout(function() {
            window.location = destination;
        }, timeOfDelay);
    }

    function replaceTag(tag) {
        return tagsToReplace[tag] || tag;
    }

    function safeTagsReplace(str) {
        return str.replace(/[&<>]/g, replaceTag);
    }

    return {
        notify: notify,
        redirectToHome: redirectToHome,
        replaceTags: safeTagsReplace
    };
})();