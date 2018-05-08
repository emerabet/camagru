var started = false;
var live = null;
var onoff = document.getElementById("btn-onoff");
var txt = document.getElementById("video-text");
var embed_video = document.getElementById("embed-video");
var wp = document.getElementById("my-wrapper");
var btnTake = document.getElementById("btn-take");
var canvas = document.getElementById('canvas');
var side = document.getElementById('side-img');

var selectedimg = null;

var el = document.getElementById("img-hado");
el.addEventListener('click', function () { 
    selectedimg = el;
});

if (onoff)
    onoff.addEventListener("click", toggleVideo);

if (btnTake)
    btnTake.addEventListener('click', function(ev){
      takepicture();
      ev.preventDefault();
    }, false);

function takepicture() {
    var context = canvas.getContext('2d');
    width = 1280;
    height = 720;
    if (width && height) {
      canvas.width = wp.clientWidth;
      canvas.height = wp.clientHeight;

      context.drawImage(live, 0, 0, wp.clientWidth, wp.clientHeight);
      context.drawImage(selectedimg, 0, 0, 320, 320);
    
      var data = canvas.toDataURL('image/png');
      addPictureToSidebar(data);
      //photo.setAttribute('src', data);
    } else {
      //clearphoto();
    }
}

function toggleVideo() {
    txt.style.display = txt.style.display === 'none' ? '' : 'none';
    embed_video.style.display = embed_video.style.display === 'none' ? '' : 'none';
    if (started === false)
        startStream();
    else
        stopStream();
}

function addPictureToSidebar(photo)
{
    var li = document.createElement('LI');
    li.classList.add("list-group-item");
    li.setAttribute('id', Date.now());

    var img = document.createElement("IMG");
    img.classList.add("img-fluid");
    img.setAttribute('id', Date.now());
    img.setAttribute('src', photo);

    li.appendChild(img);
    if (side)
        side.prepend(li);
}

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
        live = null;
        return true;
    }
    return false;
}