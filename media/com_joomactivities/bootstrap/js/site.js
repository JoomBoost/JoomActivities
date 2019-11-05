// A $( document ).ready() block.
jQuery( document ).ready(function($) {
    $('.navbar-nav .nav-item').click(function(){
        $('.navbar-nav .nav-item').removeClass('active');
        $(this).addClass('active');
    })
});

