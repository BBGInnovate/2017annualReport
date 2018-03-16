// THIS WRAPPER FUNCTION MAKES $ AVAILABLE
(function($) {
$(document).ready(function() {

// POST CAT TEXT BOX HEIGHT CONSISTENT WITH THUMBNAIL
function sizePostCats() {
	var postCatTextBox = $('.aside-text');
	var postCatImgH = $('.aside-image').height();
	postCatTextBox.css('height', postCatImgH);
}
sizePostCats();

// FUNCTIONS TO RUN ON RESIZE
$(window).on('resize', function() {
	sizePostCats();
});

}); // END READY
})( jQuery );