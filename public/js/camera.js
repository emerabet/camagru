var started = false;
var live = null;
var onoff = document.getElementById("btn-onoff");
var txt = document.getElementById("video-text");
var embed_video = document.getElementById("embed-video");
var wp = document.getElementById("my-wrapper");
var btnTake = document.getElementById("btn-take");
var canvas = document.getElementById('canvas');
var side = document.getElementById('side-img');
var btnSave = document.getElementById('btn-save');
var btnCancel = document.getElementById('btn-cancel');


if (onoff)
    onoff.addEventListener("click", toggleVideo);

if (btnTake)
    btnTake.addEventListener('click', function(ev){
        if (items.length > 0)
            takepicture();
        else
            alert("Ajoutez une image avant");
      ev.preventDefault();
    }, false);

if (btnSave)
    btnSave.addEventListener('click', savePicture);

if (btnCancel)
    btnCancel.addEventListener('click', cancelPicture);

startStream();

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

var toSave = null;

function takepicture() {
    var context = canvas.getContext('2d');
    width = 1280;
    height = 720;
    if (width && height) {
      canvas.width = embed_video.clientWidth;
      canvas.height = embed_video.clientHeight;

    //  context.drawImage(live, 0, 0, width, height);
    //  context.clearRect(0, 0, canvas.width, canvas.height);
      context.drawImage(live, 0, 0, embed_video.clientWidth, embed_video.clientHeight);
    
      var data = canvas.toDataURL('image/png');

      toSave = { img : data, itms : items }
      toggleVideo();
      //addPictureToSidebar(data);
      //photo.setAttribute('src', data);
    } else {
      //clearphoto();
    }
}

function toggleVideo() {
    txt.style.display = txt.style.display === 'none' ? '' : 'none';
    embed_video.style.display = embed_video.style.display === 'none' ? '' : 'none';
    canvas.style.display = canvas.style.display === 'none' ? '' : 'none';
    /*if (started === false)
        startStream();
    else
        stopStream();*/
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


function savePicture()
{
    var obj = JSON.stringify(toSave);
    var xmlhttp = sendPostAjax("index.php?p=photo.save");
    xmlhttp.onload = function () {
        alert(xmlhttp.responseText);
    };
    xmlhttp.send("data=" + obj);
}

function cancelPicture() 
{
    location.reload();
}