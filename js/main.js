$(document).ready(function() {
    $('.slide').find('.slide-content').first().slideDown();
    $('.slide').click(function() {
        var slideContent = $(this).find('.slide-content');
        var paragraph = $(this).find('p');
        var isSlideVisible = slideContent.is(':visible');
        
        slideContent.slideToggle('fast');
        paragraph.css('color', isSlideVisible ? 'white' : 'white');
        
        $('.slide').not(this).find('p').css('color', 'white');
        $('.slide').not(this).find('.slide-content').slideUp('fast');
    });
});