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
        scrollTop: $(".section-method").offset().top - $("nav").height()
    }, 700);
});

$(document).on("click", "#edu-program", function () {
    $('html, body').animate({
        scrollTop: $(".section-program").offset().top - $("nav").height()
    }, 700);
});

$(document).on("click", "#edu-library", function () {
    $('html, body').animate({
        scrollTop: $(".section-library").offset().top - $("nav").height()
    }, 700);
});

$(document).on("click", "#answer-question", function () {
    $('html, body').animate({
        scrollTop: $(".section-question").offset().top - $("nav").height()
    }, 700);
});

$(document).on("click", "#intro-beedu", function () {
    $('html, body').animate({
        scrollTop: $(".page-footer").offset().top
    }, 700);
});

$("#feedback-form").submit(function (event) {
    event.preventDefault();
    var questionVal = $("#textarea1").val();
    var emailVal = $("#email").val();
    var url = $(this).attr("action");
    if(questionVal != "" && emailVal != ""){
        $.post( url, { question: questionVal, email: emailVal })
            .done(function( data ) {
                if(data == "error"){
                    $("div#snackbar").html("Có lỗi xảy ra, vui lòng thử lại");
                    var x = document.getElementById("snackbar");
                    x.className = "show";
                    setTimeout(function(){ x.className = x.className.replace("show", ""); }, 3000);
                }else {
                    var x = document.getElementById("snackbar");
                    $("div#snackbar").html("Câu hỏi đã được gửi đi");
                    x.className = "show";
                    setTimeout(function(){
                        x.className = x.className.replace("show", ""); }, 3000);
                    $("#textarea1").val("");
                    $("#email").val("");
                }
            });
    }
});

$(document).ready(function(){
    var count = 5;
    setInterval(function () {
        var step = count % 4;
        for(var i = 1; i <= 4; i++){
            var e = document.getElementById("step-"+i);
            e.classList.remove("step-active");
            var childs = e.childNodes;
            childs[1].classList.remove("white-text");
            var title = document.getElementById("method-"+i);
            title.classList.remove("blue-text");

        }
        switch (step){
            case 1:
                var element = document.getElementById("step-1");
                element.className += " step-active";
                var title = document.getElementById("method-1");
                title.className += " blue-text";
                break;
            case 2:
                var element = document.getElementById("step-2");
                element.className += " step-active";
                var title = document.getElementById("method-2");
                title.className += " blue-text";
                break;
            case 3:
                var element = document.getElementById("step-3");
                element.className += " step-active";
                var title = document.getElementById("method-3");
                title.className += " blue-text";
                break;
            case 0:
                var element = document.getElementById("step-4");
                element.className += " step-active";
                var title = document.getElementById("method-4");
                title.className += " blue-text";
                break;
        }
        var childs = element.childNodes;
        childs[1].className += " white-text";
        count++;
    }, 2500);
});