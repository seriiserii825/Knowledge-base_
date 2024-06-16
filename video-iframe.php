<div class="home-intro__video">
  <div data-video="video_id" id="player"></div>
</div>

<script>
  export default function introVideo() {}
  const playerEl = document.querySelector("#player");
  if (playerEl) {
    let player;
    const videoCode = playerEl.getAttribute("data-video");

    let videoReady = false;

    window.YT.ready(function onYouTubeIframeAPIReady() {
      player = new YT.Player("player", {
        videoId: videoCode,
        playerVars: {
          playsinline: 1,
          autoplay: 1,
          mute: 1,
          controls: 0,
          showinfo: 0,
          rel: 0,
          loop: 1,
          playlist: videoCode,
        },
        events: {
          onReady: onPlayerReady,
          onStateChange: onPlayerStateChange,
        },
      });
      videoReady = true;
    });

    function onPlayerReady(event) {
      setTimeout(function() {
        event.target.playVideo();
      }, 100);
    }

    let isPlaying = false;

    function onPlayerStateChange(event) {
      if (event.data == YT.PlayerState.ENDED) {
        //  console.log("Video Ended");
        isPlaying = false;
        document.documentElement.classList.remove("video-playing");
      }

      if (event.data == YT.PlayerState.PLAYING) {
        //  console.log("Video Playing");
        isPlaying = true;
        document.documentElement.classList.add("video-playing");
      }

      if (event.data == YT.PlayerState.PAUSED) {
        //  console.log("Video Paused");
        isPlaying = false;
      }

      if (event.data == YT.PlayerState.BUFFERING) {
        //  console.log("Video Buffering");
      }

      if (event.data == YT.PlayerState.CUED) {
        //  console.log("Video Cued");
        document.documentElement.classList.remove("video-playing");
        isPlaying = false;
      }
    }

    // if (window.innerWidth > 750) {
    //   onYouTubeIframeAPIReady();
    // }

    window.addEventListener("resize", () => {
      if (window.innerWidth > 750 && !videoReady) {
        onYouTubeIframeAPIReady();
      }
      if (isPlaying) {
        player.stopVideo();
      }
    });
  }
  }
</script>
