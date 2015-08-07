$(document).ready(function() {
    $('#search-box').bind('keypress change', function(event) {
        var that = this;
        var v = $(this).val();
        var search_term = $.trim(v);
        $('*').unhighlight();
        $('*').highlight(search_term);
        // $("#search-box").highlight(search_term);
    });
});