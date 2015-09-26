/* =============================================================

	Sticky Footer v1.0
	A responsive, sticky footer, by Chris Ferdinandi.
	http://gomakethings.com

	Free to use under the MIT License.
	http://gomakethings.com/mit/

 * ============================================================= */

window.stickyFooter = (function (window, document, undefined) {

	'use strict';

	// Default settings
	// Private {object} variable
	var _defaults = {
		offset: 0,
		callbackBefore: function () {},
		callbackAfter: function () {}
	};

	// Merge default settings with user options
	// Private method
	// Returns an {object}
	var _mergeObjects = function ( original, updates ) {
		for (var key in updates) {
			original[key] = updates[key];
		}
		return original;
	};

	// Get's viewport height
	// Private method
	// Returns integer
	var _getViewportHeight = function () {
		return Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
	};

	// Set sticky footer height
	// Private method
	// Runs functions
	var _setFooterHeight = function ( stickyWrap, stickyFooter, options ) {

		var footerHeight = stickyFooter.offsetHeight;
		var viewportHeight = _getViewportHeight();

		options.callbackBefore();
		stickyWrap.style.minHeight = (viewportHeight - footerHeight) + 'px';
		options.callbackAfter();

	};

	// On window scroll and resize, only run `checkViewport` at a rate of 15fps for better performance
	// Private method
	// Runs functions
	var _eventThrottler = function ( eventTimeout, stickyWrap, stickyFooter, options ) {
		if ( !eventTimeout ) {
			eventTimeout = setTimeout( function() {
				eventTimeout = null;
				_setFooterHeight( stickyWrap, stickyFooter, options );
			}, 66);
		}
	};

	// Initalize Jellyfish
	// Public method
	// Runs functions
	var init = function ( options ) {

		// Feature test before initializing
		if ( 'querySelector' in document && 'addEventListener' in window && Array.prototype.forEach ) {

			// Selectors and variables
			options = _mergeObjects( _defaults, options || {} ); // Merge user options with defaults
			var stickyWrap = document.querySelector('[data-sticky-wrap]');
			var stickyFooter = document.querySelector('[data-sticky-footer]');
			var eventTimeout; // Timer for event throttler

			if ( stickyWrap && stickyFooter) {
				document.documentElement.style.height = '100%';
				document.body.style.height = '100%';
				_setFooterHeight( stickyWrap, stickyFooter, options );
				window.addEventListener( 'resize', _eventThrottler.bind( null, eventTimeout, stickyWrap, stickyFooter, options ), false); // Run Sticky Footer on window resize
			}

		}

	};

	// Return public methods
	return {
		init: init
	};

})(window, document);