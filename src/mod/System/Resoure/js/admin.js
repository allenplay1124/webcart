$(document).ready(function(e) {
    var menuId = localStorage.getItem('menu_active_id')

    if (menuId != null) {
        $('#' + menuId).next('.drop-block').show()
    }

    $('#admin-content').toggleClass('fit-content')
    
    $('aside .drop-link').click(function(e) {
        e.preventDefault()
        $('aside .drop-link').not(this).next('.drop-block').slideUp()
        var state = $(this).next('.drop-block').is(':visible');
        if (state === false) {
            localStorage.setItem('menu_active_id', this.id)
        } else {
            localStorage.removeItem('menu_active_id')
        }

        $(this).next('.drop-block').slideToggle(100)
    })

    $('.toggle-bar').click(function(e) {
        e.preventDefault()
        $('#admin-content').toggleClass('fit-content')
        $('.aside').animate({width:'toggle'}, 100);
    })
})