/*!
 * Beagle v1.8.0
 * https://foxythemes.net
 *
 * Copyright (c) 2020 Foxy Themes
 */

var App = (function () {
  'use strict';

  App.ajaxLoader = function( ){

    var mprogress = new Mprogress();
    mprogress.start();
    setTimeout(function(){mprogress.end()}, 3000);

    $('.toggle-loader').click(function(){
    	mprogress.start();
    	setTimeout(function(){mprogress.inc()}, 1000);
    	setTimeout(function(){mprogress.end()}, 3000);
    });
    
  };

  return App;
})(App || {});