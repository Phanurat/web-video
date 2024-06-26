<head>
  <link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />
</head>

<body>
  <video
    id="my-video"
    class="video-js"
    controls
    preload="auto"
    width="640"
    height="264"
    poster="MY_VIDEO_POSTER.jpg"
    data-setup="{}"
  >
    <source src="uploads/videos/test.mp4" type="video/mp4" />
    <source src="uploads/videos/test.webm" type="video/webm" />
    <p class="vjs-no-js">
      To view this video please enable JavaScript, and consider upgrading to a
      web browser that
      <a href="https://videojs.com/html5-video-support/" target="_blank"
        >supports HTML5 video</a
      >
    </p>
  </video>

  <script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>
</body>
