/**
 * Created by hieuapp on 31/07/2016.
 */

$(".question").on( "click", ".expand-more", function() {
    var parentElement = $(this).parents("li");
    var innerHtml = $(this).html();
    if(innerHtml === "expand_more"){
        $(this).html("expand_less");
        parentElement.children("div.answer").css("display", "block");
    }else {
        $(this).html("expand_more");
        parentElement.children("div.answer").css("display", "none");
    }
});