jQuery(document).ready(function ($) {

	var _SlideshowTransitions = [
	//Fade
	{ $Duration: 1200, $Opacity: 2 }
	];
	
	var options = {
	    $AutoPlay: true,                                    //[Optional] Whether to auto play, to enable slideshow, this option must be set to true, default value is false
	    $AutoPlaySteps: 1,                                  //[Optional] Steps to go for each navigation request (this options applys only when slideshow disabled), the default value is 1
	    $AutoPlayInterval: 6000,                            //[Optional] Interval (in milliseconds) to go for next slide since the previous stopped if the slider is auto playing, default value is 3000
	    $PauseOnHover: 1,                               //[Optional] Whether to pause when mouse over if a slider is auto playing, 0 no pause, 1 pause for desktop, 2 pause for touch device, 3 pause for desktop and touch device, default value is 1
	
	    $SlideshowOptions: {                                //[Optional] Options to specify and enable slideshow or not
	        $Class: $JssorSlideshowRunner$,                 //[Required] Class to create instance of slideshow
	        $Transitions: _SlideshowTransitions,            //[Required] An array of slideshow transitions to play slideshow
	        $TransitionsOrder: 0                           //[Optional] The way to choose transition to play slide, 1 Sequence, 0 Random
	        
	    }
	};
	var jssor_slider1 = new $JssorSlider$("slider", options);
});