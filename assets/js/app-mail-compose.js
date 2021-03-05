/*!
 * Beagle v1.8.0
 * https://foxythemes.net
 *
 * Copyright (c) 2020 Foxy Themes
 */

var App = (function () {
  'use strict';

  App.mailCompose = function( ){

    //Select2 Tags
    $(".tags").select2({tags: 0,width: '100%'});

   //Summernote
    $('#email-editor').summernote({
      height: 200
    });
    
  };

  return App;
})(App || {});
