$(document).ready(function() {
	$('input.book-selection:radio').hide();
    $('input.book-selection:radio').focus(updateSelectedStyle);
    $('input.book-selection:radio').blur(updateSelectedStyle);
    $('input.book-selection:radio').change(updateSelectedStyle);
})

function updateSelectedStyle() {
    $('input.book-selection:radio').next().removeClass('selected');
    $('input.book-selection:radio:checked').next().addClass('selected');
}