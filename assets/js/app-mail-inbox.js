/*!
 * Beagle v1.8.0
 * https://foxythemes.net
 *
 * Copyright (c) 2020 Foxy Themes
 */

var App = (function () {
  'use strict';
  
  App.mailInbox = function( ){
    
    $(".be-select-all input").on('change',function(){
      var checkboxes = $(".email-list").find('input[type="checkbox"]');
      if( $(this).is(':checked') ) {
          checkboxes.prop('checked', true);
      } else {
          checkboxes.prop('checked', false);
      }
    });
    
  };

  return App;
})(App || {});
