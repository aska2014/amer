// when the DOM is ready, convert the feed anchors into feed content
$(document).ready(function() {
    $('#newsslider').accessNews();

    $('#newsslider2').accessNews({
        title : "BREAKING NEWS:",
        subtitle:"stories from the internet",
        speed : "slow",
        slideBy : 4,
        slideShowInterval: 100000,
        slideShowDelay: 100000
    });

});