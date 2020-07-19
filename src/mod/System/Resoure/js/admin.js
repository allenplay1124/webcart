$(document).ready(function(e) {
    $('aside .drop-link').click(function(e) {
        e.preventDefault()
        $('aside .drop-link').not(this).next('.drop-block').slideUp()
        $(this).next('.drop-block').slideToggle(100)
    })

    $('.toggle-bar').click(function(e) {
        e.preventDefault()
        $('.aside').animate({width:'toggle'}, 100);
    })
})