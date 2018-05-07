<div class="row">
    <div class="col-sm-12">
        <button id="btn-onoff" class="btn btn-secondary">Start/Stop</button>
        <button id="btn-take" class="btn btn-info">Prendre une photo</button>
    </div>
</div>
<div class="row">
    <p id="video-text" class="video-text">Veuillez demarrer la cam pour prendre des photos</p>
    <div id="embed-video" class="col-sm-12 embed-responsive embed-responsive-4by3 my-video" style="display: none;">
        <video class="embed-responsive-item"></video>
    </div>
</div>

<script>
var started = false;
var onoff = document.getElementById("btn-onoff");

var txt = document.getElementById("video-text");
var embed_video = document.getElementById("embed-video");

if (onoff)
    onoff.addEventListener("click", toggleVideo);

function toggleVideo() {
    txt.style.display = txt.style.display === 'none' ? '' : 'none';
    embed_video.style.display = embed_video.style.display === 'none' ? '' : 'none';
    if (started === false)
        startStream();
    else
        stopStream();
}

var live = null;
function startStream() {
    var constraints = { 
        audio: false, 
        video: 
        { 
            width: { min: 1024, ideal: 1280, max: 1920 },
            height: { min: 576, ideal: 720, max: 1080 }, 
        }};

    navigator.mediaDevices.getUserMedia(constraints).then(function(mediaStream) {
    var video = document.querySelector('video');
    live = video;
    video.srcObject = mediaStream;

    video.onloadedmetadata = function(e) 
    {
        started = true;
        video.play();
    };
    }).catch(function(err) { 
            console.log(err.name + ": " + err.message); 
            return false;
    });
}

function stopStream() {

    if (live) {
        let stream = live.srcObject;
        let tracks = stream.getTracks();

        tracks.forEach(function(track) {
            track.stop();
        });
        started = false;
        live.srcObject = null;
        return true;
    }
    return false;
}
</script>