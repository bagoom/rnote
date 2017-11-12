(function() {
	var triggerBttn = document.getElementById( 'trigger-overlay' ),
		overlay = document.querySelector( 'div.overlay' ),
		closeBttn = overlay.querySelector( 'button.overlay-close' );
		transEndEventNames = {
			'WebkitTransition': 'webkitTransitionEnd',
			'MozTransition': 'transitionend',
			'OTransition': 'oTransitionEnd',
			'msTransition': 'MSTransitionEnd',
			'transition': 'transitionend'
		},
		transEndEventName = transEndEventNames[ Modernizr.prefixed( 'transition' ) ],
		support = { transitions : Modernizr.csstransitions };

	function toggleOverlay() {
		var modal = {
		  open : function(){
		    $('.overlay').show();
		  },
		  close : function(){
		    $('.overlay').hide();

		  }
		};
		if( classie.has( overlay, 'open' ) ) {


			classie.remove( overlay, 'open' );
			var onEndTransitionFn = function( ev ) {
				// if( support.transitions ) {
				// 	if( ev.propertyName !== 'visibility' ) return;
				// 	this.removeEventListener( transEndEventName, onEndTransitionFn );
				// }
				// classie.remove( overlay, 'close' );

			};
			// if( support.transitions ) {
			// 	overlay.addEventListener( transEndEventName, onEndTransitionFn );
			// }
			// else {
			// 	onEndTransitionFn();
			// }
		}
		else if( !classie.has( overlay, 'close' ) ) {
			classie.add( overlay, 'open' );

			window.history.pushState({}, 'modal', '/yyyy');
			window.onpopstate = history.onpushstate = function(e) {
			    if(window.location.href.split('/').pop().indexOf('yyyy')===-1){ // 마지막 segment가 cards라면 모달이 아닌 리스트인 상태이어야한다.
			        modal.close(); // 현재의 모달을 닫는다.

							classie.remove( overlay, 'open' );
							$('.overlay').css('display','');
			    }
					else{
						modal.close(); // 현재의 모달을 닫는다.

					 classie.remove( overlay, 'open' );
					 $('.overlay').css('display','');

					}
			}
		}
	}

	triggerBttn.addEventListener( 'click', toggleOverlay );
	closeBttn.addEventListener( 'click', toggleOverlay );
})();
