(function ($) {
  Drupal.behaviors.videoBehavior = {
    attach: function (context, settings) {
      // Code for searchbox placeholder
      $('#edit-keys', context).attr('placeholder', 'Search');
      $('#edit-mail-0-value', context).attr('placeholder', 'Enter your email address');

      // Code for local video play
      var video = $('#video-player', context)[0];
      var overlayImage = $('.overlay-image', context)[0];
      var playButton = $('.play-button', context)[0];

      if (video && overlayImage && playButton) 
        $(playButton).on('click', function () {
          if (video.paused) {
            video.play();
            overlayImage.style.display = 'none';
            playButton.style.display = 'none';
          }
        });

        $(video).on('play', function () {
          overlayImage.style.display = 'none';
          playButton.style.display = 'none';
        });
       
      
    }
  };
})(jQuery);


// (function ($) {
//   $(document).ready(function() {
  
//     if ($('#superfish-main-accordion').length) {
//         var blockContent = $('#block-cas-sitebranding-2').html();
//         var customBlock = '<div class="custom-block">' + blockContent + '</div>';
//        $('#superfish-main-accordion li:last').after(customBlock);
//     }
//   });
// })(jQuery);

(function ($) {
  $(document).ready(function() {
  
    if ($('#superfish-main-accordion').length) {
        var blockContent = $('#block-cas-sitebranding-2').html();
        var customBlock = '<div class="custom-block">' + blockContent + '</div>';
  
        $('#superfish-main-accordion > li:contains("Our Partners")').append(customBlock);
    }
  });
})(jQuery);


// Loginform element ordring changes

$(document).ready(function() {
   function reorderElements() {
    var viewportWidth = $(window).width();
    
    if (viewportWidth <= 1024) { 
      
      $('#block-cas-userloginlogo').insertBefore('.user-login-form');
    } else {
      
      $('#block-cas-content').append($('#block-cas-userloginlogo'));
    }
  } 
  reorderElements();
  $(window).resize(reorderElements);
});


//  Permanent link page Js
(function ($) {
  Drupal.behaviors.customShareFunctionality = {
    attach: function (context, settings) {
      $(document).ready(function () {
        $('#shareBubble').hide();
        $('#shareButton').click(function () {
          $('#shareBubble').show();
          var currentUrl = window.location.href;
          $('#shareGuidUrl').val(currentUrl);
        });
        $('#closeShare').click(function () {
          $('#shareBubble').hide();
        });
        var clipboardButton = document.querySelector('.clipboardButton');
        if (clipboardButton) {
          clipboardButton.addEventListener('click', function(event) {
            var inputElement = document.getElementById('shareGuidUrl');
            inputElement.select();
            document.execCommand('copy');
          });
        }
      });
    }
  };
})(jQuery);


// auto logout in tab close
// (function ($, Drupal) {
//   Drupal.behaviors.autoLogoutOnClose = {
//     attach: function (context, settings) {
//       window.addEventListener('beforeunload', function (event) {
//         navigator.sendBeacon(Drupal.url('user/logout'));
//       });
//     }
//   };
// })(jQuery, Drupal);

