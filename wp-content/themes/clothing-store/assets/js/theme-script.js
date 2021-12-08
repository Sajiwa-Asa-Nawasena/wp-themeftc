function clothing_store_days_countdown() {
	const newYears = document.getElementById('new-year-date').value;
    const newYearsDate = new Date(newYears);
    const currentDate = new Date();

    var daysEl = document.getElementById('days');
	var hoursEl = document.getElementById('hours');
	var minsEL = document.getElementById('mins');
	var secondsEL = document.getElementById('seconds');

    const totalSeconds = (newYearsDate - currentDate) /1000;
    const minutes = Math.floor(totalSeconds/ 60) % 60;
    const hours = Math.floor(totalSeconds /3600) % 24;
    const days = Math.floor(totalSeconds /3600/ 24);
    const seconds = Math.floor(totalSeconds) % 60;
    
	daysEl.innerText = days;
	hoursEl.innerText = hours;
	minsEL.innerText = minutes;
	secondsEL.innerText = seconds;    
}

setInterval(clothing_store_days_countdown, 1000);

jQuery(function($){
 	"use strict";
   	jQuery('.gb_navigation > ul').superfish({
		delay:       500,
		animation:   {opacity:'show',height:'show'},
		speed:       'fast'
  	});
});

function clothing_store_gb_Menu_open() {
	jQuery(".side_gb_nav").addClass('show');
}
function clothing_store_gb_Menu_close() {
	jQuery(".side_gb_nav").removeClass('show');
}

jQuery(function($){
	$('.gb_toggle').click(function () {
        clothing_store_Keyboard_loop($('.side_gb_nav'));
    });
});