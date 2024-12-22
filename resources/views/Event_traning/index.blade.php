@include('traning_header.header') 
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->
    @include('traning_header.head') 
    <!-- End Navbar -->
     @dd($EventTraning)
    <div class="container-fluid py-2">
        <div class="card">
            <div class="container">
                <div class="video-card text-center">
                    <!-- Dynamic Heading -->
                    <h3 id="videoTitle" class="mb-4">Select a Video</h3>
                    
                    <!-- Video Section -->
                    <video id="videoPlayer" width="560" height="315" controls onended="playNextVideo()">
                        <source src="" type="video/mp4">
                    </video>
                    
                    <!-- Navigation Buttons -->
                    <div class="navigation-buttons mt-3">
                        <button id="prevButton" class="btn btn-outline-primary" onclick="navigateVideo('prev')">← Previous Video</button>
                        <button id="nextButton" class="btn btn-custom" onclick="navigateVideo('next')">Next Video →</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
let currentVideoIndex = 0;
let videos = @json($EventTraning);

function loadVideo(element) {
    const videoLink = element.getAttribute('data-video-link');
    const title = element.getAttribute('data-title');

    // Update the video player
    const videoPlayer = document.getElementById('videoPlayer');
    videoPlayer.querySelector('source').src = videoLink;
    videoPlayer.load();  // Load the new video

    // Update the title
    document.getElementById('videoTitle').innerText = title;

    // Update the current index based on clicked video
    currentVideoIndex = Array.from(document.querySelectorAll('.nav-item a')).indexOf(element);
}

function playNextVideo() {
    // Move to the next video in the array
    currentVideoIndex = (currentVideoIndex + 1) % videos.length;  // Loop back to the first video

    // Get the new video
    const video = videos[currentVideoIndex];
    const videoLink = "{{ asset('storage') }}/" + video.video_type;

    // Update the video player
    const videoPlayer = document.getElementById('videoPlayer');
    videoPlayer.querySelector('source').src = videoLink;
    videoPlayer.load();  // Load the new video

    // Update the title
    document.getElementById('videoTitle').innerText = video.title;
}

function navigateVideo(direction) {
    if (direction === 'next') {
        currentVideoIndex = (currentVideoIndex + 1) % videos.length;  // Loop to the next video
    } else if (direction === 'prev') {
        currentVideoIndex = (currentVideoIndex - 1 + videos.length) % videos.length;  // Loop to the previous video
    }

    // Get the new video
    const video = videos[currentVideoIndex];
    const videoLink = "{{ asset('storage') }}/" + video.video_type;

    // Update the video player
    const videoPlayer = document.getElementById('videoPlayer');
    videoPlayer.querySelector('source').src = videoLink;
    videoPlayer.load();  // Load the new video

    // Update the title
    document.getElementById('videoTitle').innerText = video.title;
}

// Initialize the first video (if any videos exist)
document.addEventListener("DOMContentLoaded", function() {
    if (videos.length > 0) {
        loadVideo(document.querySelector('.nav-item a'));
    }
});



</script>
    
    
    