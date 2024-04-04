// Searchbox add placeholder

$(document).ready(function() {
    $('#edit-keys').attr('placeholder', 'Search');
});
// local video Play code 
document.addEventListener('DOMContentLoaded', function () {
    var video = document.getElementById('video-player');
    var overlayImage = document.querySelector('.overlay-image');
    var playButton = document.querySelector('.play-button');
  
    playButton.addEventListener('click', function () {
      if (video.paused) {
        video.play();
        overlayImage.style.display = 'none'; 
        playButton.style.display = 'none'; 
      }
    });
     video.addEventListener('play', function () {
      overlayImage.style.display = 'none';
      playButton.style.display = 'none';
    });
  });
  

