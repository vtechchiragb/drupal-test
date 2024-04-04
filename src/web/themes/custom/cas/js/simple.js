// Searchbox add placeholder

$(document).ready(function() {
    $('#edit-keys').attr('placeholder', 'Search');
});
// local video Play code 
// document.addEventListener('DOMContentLoaded', function () {
//     var video = document.getElementById('video-player');
//     var overlayImage = document.querySelector('.overlay-image');
//     var playButton = document.querySelector('.play-button');
  
//     playButton.addEventListener('click', function () {
//       if (video.paused) {
//         video.play();
//         overlayImage.style.display = 'none'; 
//         playButton.style.display = 'none'; 
//       }
//     });
//      video.addEventListener('play', function () {
//       overlayImage.style.display = 'none';
//       playButton.style.display = 'none';
//     });
//   });
  

(function ($) {
  Drupal.behaviors.videoBehavior = {
    attach: function (context, settings) {
      // Code for searchbox placeholder
      $('#edit-keys', context).attr('placeholder', 'Search');

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
