
$(window).on("scroll", function() {
    if ($(window).scrollTop() > 100) {
        $(".navbar").addClass("active");
    } else {
        $(".navbar").removeClass("active");
    }
});

/*
// When the user scrolls down 80px from the top of the document, resize the navbar's padding and the logo's font size
window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 80 || document.documentElement.scrollTop > 80) {
        document.getElementById("logo").style.fontSize = "25px";
		document.getElementById("logo").style.color = "#4789ec";
		document.getElementById("navigation_bar").style.height = "60px";
		document.getElementById("navigation_bar").style.backgroundColor = "white";
		document.getElementById("button_invest").style.color = "#4789ec";
		document.getElementById("button_loan").style.color = "#4789ec";
		document.getElementById("button_intro").style.color = "#4789ec";
		document.getElementById("button_inform").style.color = "#4789ec";
		document.getElementById("button_login").style.color = "#4789ec";
		document.getElementById("button_join").style.color = "white";
		document.getElementById("button_invest").style.fontSize = "14px";
		document.getElementById("button_loan").style.fontSize = "14px";
		document.getElementById("button_intro").style.fontSize = "14px";
		document.getElementById("button_inform").style.fontSize = "14px";
		document.getElementById("button_login").style.fontSize = "14px";
		document.getElementById("button_join").style.fontSize = "14px";
		document.getElementById("navigation_bar").style.borderBottom = "1px solid #e7e7e7";
		document.getElementById("button_login").style.border = "1px solid #4789ec";
    } else {
        document.getElementById("logo").style.fontSize = "35px";
		document.getElementById("logo").style.color = "white";
		document.getElementById("navigation_bar").style.height = "70px";
		document.getElementById("navigation_bar").style.backgroundColor = "transparent";
		document.getElementById("button_invest").style.color = "white";
		document.getElementById("button_loan").style.color = "white";
		document.getElementById("button_intro").style.color = "white";
		document.getElementById("button_inform").style.color = "white";
		document.getElementById("button_login").style.color = "white";
		document.getElementById("button_join").style.color = "white";
		document.getElementById("button_invest").style.fontSize = "18px";
		document.getElementById("button_loan").style.fontSize = "18px";
		document.getElementById("button_intro").style.fontSize = "18px";
		document.getElementById("button_inform").style.fontSize = "18px";
		document.getElementById("button_login").style.fontSize = "18px";
		document.getElementById("button_join").style.fontSize = "18px";
		document.getElementById("navigation_bar").style.borderColor = "transparent";
		document.getElementById("button_login").style.border = "1px solid white";
    }

}

/*
window.onscroll = function() {scrollFunction()};
function scrollFunction() {
	if (document.body.scrollTop > 80){
		$(".navbar").addClass("active");
    } else {
        $(".navbar").removeClass("active");

    }
	if (document.documentElement.scrollTop > 80) {
        $(".navbar").addClass("active");
    } else {
        $(".navbar").removeClass("active");

    }
}
*/

