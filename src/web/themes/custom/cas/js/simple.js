// Searchbox add placeholder

$(document).ready(function() {
    $('#edit-keys').attr('placeholder', 'Search');
});

// document.addEventListener('DOMContentLoaded', function () {
//     var video = document.getElementById('video-player');
//     var overlayImage = document.querySelector('.overlay-image');
//     var playButton = document.querySelector('.play-button');
  
//     playButton.addEventListener('click', function () {
//       if (video.paused) {
//         video.play();
//         overlayImage.style.display = 'none'; // Hide the overlay image when video starts playing
//         playButton.style.display = 'none'; // Hide the play button once video starts playing
//       }
//     });
  
//     // Hide overlay image and play button when video is played from the video controls
//     video.addEventListener('play', function () {
//       overlayImage.style.display = 'none';
//       playButton.style.display = 'none';
//     });
//   });
  

document.addEventListener("DOMContentLoaded", function() {
  var openVideoLinks = document.querySelectorAll('.open-video-link');
  openVideoLinks.forEach(function(link) {
    link.addEventListener('click', function(event) {
      event.preventDefault();
      var videoId = this.getAttribute('data-video-id');
      openVideoModal(videoId);
    });
  });

  function openVideoModal(videoId) {
    var modalContent = '<div class="modal-overlay"></div>' +
                       '<div class="video-modal">' +
                       '<iframe width="560" height="315" src="https://www.youtube.com/embed/' + videoId + '" frameborder="0" allowfullscreen></iframe>' +
                       '<button class="close-modal">Close</button>' +
                       '</div>';
    document.body.insertAdjacentHTML('beforeend', modalContent);

    var modalOverlay = document.querySelector('.modal-overlay');
    var videoModal = document.querySelector('.video-modal');
    var closeModalButton = document.querySelector('.close-modal');

    modalOverlay.addEventListener('click', closeModal);
    closeModalButton.addEventListener('click', closeModal);

    function closeModal() {
      modalOverlay.remove();
      videoModal.remove();
    }
  }
});
