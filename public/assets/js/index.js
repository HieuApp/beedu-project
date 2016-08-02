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

$(document).on("click", "#edu-method", function () {
    $('html, body').animate({
        scrollTop: $(".section-method").offset().top
    }, 700);
});

$(document).on("click", "#edu-program", function () {
    $('html, body').animate({
        scrollTop: $(".section-program").offset().top
    }, 700);
});

$(document).on("click", "#edu-library", function () {
    $('html, body').animate({
        scrollTop: $(".section-library").offset().top
    }, 700);
});

$(document).on("click", "#answer-question", function () {
    $('html, body').animate({
        scrollTop: $(".section-question").offset().top
    }, 700);
});

$(document).on("click", "#intro-beedu", function () {
    $('html, body').animate({
        scrollTop: $(".page-footer").offset().top
    }, 700);
});