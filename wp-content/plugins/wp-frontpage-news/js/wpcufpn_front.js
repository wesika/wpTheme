/** wpcuFPN front-end jQuery script v.0.1 **/

var currentSlide		= 0;
var slideLength			= 1;
var slideDirection		= 'left';
var logging 			= false;		//Debug
//var autoanimate			= false;
//var	transition_type		= 'slide';

(function($){
	$( document ).ready(function() {
		//console_log( 'Doc ready.' );
		
		/** Enable slideshow navigation arrows **/
		$('.slidebtn').click(function(e){
			e.preventDefault();
			console_log( 'slidebtn clicked' );
			autoanimate = false;
			window.autoanimate = false;
			scrollSlideshow( e );
			return false;
		});
		
		/** Enable slideshow page navigation **/
		$('.pagi_p').click(function(e){
			e.preventDefault();
			console_log( 'pagi_p clicked' );
			autoanimate = false;
			window.autoanimate = false;
			scrollSlideshow( e );
			return false;
		});
		
		/** Setup slideshow containers heights **/
		$('.wpcufpn_container').each( function(i){
			if( $(this).hasClass('horizontal') ) {
				height = 0;
				$('li',this).each( function(j){
					if( $(this).height() > height )
						height = $(this).height();
				});
				$(this).height(height);
			} else {
				$(this).height($('ul',this).height());
			}
		});
		
		/** Start autoanimate if necessary **/
		console.log( 'window.autoanimate: ' + window.autoanimate );
		if( window.autoanimate ) {
			var autoanimate = true;
			auto_animate();
		}
	});
	
	function auto_animate() {
		if( autoanimate ) {
			scrollSlideshow( $.Event( 'dblclick', { target: $('.wpcufpn_container:first') } ) );
			setTimeout(auto_animate,5000);
		}
	}
	
	/** Slideshow controls **/
	function scrollSlideshow( event ) {
		
		if( 'undefined' === typeof transition_type || !transition_type )
			transition_type = 'slide';
		
		var speed = 'fast';
		if( 'slide' == transition_type ) {
			var speed = 'fast';
		}
		if( 'fade' == transition_type ) {
			var speed = 0;
		}
		
		if(autoanimate) {
			slideLength = Math.floor( $('.wpcufpn_listposts:first',$(event.target).parent()).width() / $('.wpcufpn_container:first',$(event.target).parent()).width() );
			slider = $((event.target).parent());
		} else {
			slideLength = Math.floor( $('.wpcufpn_listposts:first',$(event.target.parentElement).parent()).width() / $('.wpcufpn_container:first',$(event.target.parentElement).parent()).width() );
			slider = $($(event.target.parentElement).parent());
			//slider = $((event.target).parent);
		}
		console_log('slider:');
		console_log(slider);
		console_log( 'slideLength: ' + slideLength );
		console_log( 'currentSlide: ' + currentSlide );
		
		if ( 
			event.type == "swipeleft" || 
			( event.type == "dblclick" && slideDirection == 'left' ) ||
			$(event.target).hasClass('slide_right')
		) {
			console_log('sliding left');
			if( currentSlide <= -(slideLength-1) ) {
				bounceSlide( 'left', event );
				slideDirection = 'right';
				return;
			} else {
				currentSlide --;
			}
		}
		if (
			event.type == "swiperight" || 
			( event.type == "dblclick" && slideDirection == 'right' ) ||
			$(event.target).hasClass('slide_left')
		) {
			console_log('sliding right');
			if( currentSlide >= 0 ) {
				bounceSlide( 'right', event );
				slideDirection = 'left';
				return;
			} else {
				currentSlide ++;
			}
		}
		if( $(event.target).hasClass('pagi_p') ) {
			var page_to = $(event.target).text();
			page_to --;
			page_to = - page_to;
			console_log( 'page_to: ' + page_to );
			if( page_to == currentSlide )
				return;
			if( page_to > currentSlide ) {
				step = 1
			} else {
				step = -1
			}
			while( currentSlide != page_to ) {
				currentSlide = currentSlide + step;
				console_log( 'sliding to: ' + currentSlide );
				if( 'fade' == transition_type )
					$('.wpcufpn_listposts:first',slider).fadeOut();
				$('.wpcufpn_listposts:first',slider).animate({
					'marginLeft' : $('.wpcufpn_container:first',slider).width() * currentSlide
				}, speed);
				if( 'fade' == transition_type )
					$('.wpcufpn_listposts:first',slider).fadeIn();
			}
			return;
		}
		console_log('currentSlide' + currentSlide);
		
		if( 'fade' == transition_type )
			$('.wpcufpn_listposts:first',slider).fadeOut();
		$('.wpcufpn_listposts:first',slider).animate({
			'marginLeft' : $('.wpcufpn_container:first',slider).width() * currentSlide
		}, speed);
		if( 'fade' == transition_type )
			$('.wpcufpn_listposts:first',slider).fadeIn();
		//$('#image_ph ul#pagination li.on').removeClass('on');
		//$('#image_ph ul#pagination li.sp_' + (-currentSlide) ).addClass('on');
	}
	
	/** Makes slideshow bounce a bit when reaching end of slides **/
	function bounceSlide( direction, event ) {
		if( direction == 'left' ) {
			amp = -15;
		} else {
			amp = 15;
		}
		$('.wpcufpn_listposts:first',slider).animate({
			'marginLeft' : ( $('.wpcufpn_container:first',slider).width() * currentSlide ) + amp
		}, 'fast', 'swing', function() {
			$('.wpcufpn_listposts:first',slider).animate({
				'marginLeft' : ( $('.wpcufpn_container:first',slider).width() * currentSlide )
			}, 'fast');
		});
	}
	
	function console_log( msg ) {
		if(logging && window.console) {
			window.console.log( msg );
		}
	}
	
})( jQuery );