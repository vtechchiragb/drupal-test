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


(function ($) {
  $(document).ready(function() {
  
    if ($('#superfish-main-accordion').length) {
        var blockContent = $('#block-cas-sitebranding-2').html();
        var customBlock = '<div class="custom-block">' + blockContent + '</div>';
       $('#superfish-main-accordion li:last').after(customBlock);
    }
  });
})(jQuery);


