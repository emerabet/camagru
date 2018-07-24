var started = false;
var live = null;
var txt = document.getElementById("video-text");
var embed_video = document.getElementById("embed-video");
var wp = document.getElementById("my-wrapper");
var btnTake = document.getElementById("btn-take");
var canvas = document.getElementById('canvas');
var side = document.getElementById('side-img');
var btnSave = document.getElementById('btn-save');
var btnCancel = document.getElementById('btn-cancel');
var btnWebcam = document.getElementById('btn-webcam');

if (btnTake)
    btnTake.addEventListener('click', function(ev){
        if (items.length > 0) {
            if (embed_video.style.display != "none") {
                storeToCanva(live, embed_video);
                removeEvent();
            }
        }
        else
            alert("Ajoutez une image avant");
      ev.preventDefault();
    }, false);

if (btnSave)
    btnSave.addEventListener('click', savePicture);

if (btnCancel)
    btnCancel.addEventListener('click', cancelPicture);

var newimage = new Image();

newimage.classList.add("img-fluid");
newimage.id = "upload-img"
newimage.onload = function() {
    wp.appendChild(newimage);
    stopStream();
    setEvent();
    embed_video.style.display = 'none';
    newimage.style.display = '';

    btnTake.classList.add('disabled');
    btnTake.style.display = 'none';
};

function checkFormat(type) {
    if (type == 'image/jpeg' || type == 'image/png' || type == 'image/gif')
        return true;
    return false;
}

function readURL(input) {
    if (input.files && input.files[0]) {
        if (checkFormat(input.files[0].type) === false)
         return ;

        var reader = new FileReader();

        reader.onload = function (e) {
            newimage.src = e.target.result;
        };

        reader.readAsDataURL(input.files[0]);
        storeToCanva(newimage, newimage);
    }
}

if (btnWebcam)
    btnWebcam.addEventListener('click', function() {
    if (started === false) { 
        startStream();
    };

    if (canvas.style.display != "none") {
        embed_video.style.display = '';
        canvas.style.display = "none";
    }
});

function startStream() {
    var constraints = { 
        audio: false, 
        video: { 
                width: { min: 1024, ideal: 1280, max: 1920 },
                height: { min: 576, ideal: 720, max: 1080 }, 
        }
    };
    
    navigator.mediaDevices.getUserMedia(constraints).then(function(mediaStream) {
        var video = document.querySelector('video');
        live = video;
        video.srcObject = mediaStream;
        
        video.onloadedmetadata = function(e) {
            started = true;
            embed_video.style.display = '';
            newimage.style.display = 'none';
            updateState();
            setEvent();
            video.play();
        };
    }).catch(function(err) { 
        started = false;
        return false;
    });
}

var toSave = null;

function storeToCanva(src, wrap) {
    var context = canvas.getContext('2d');
    context.clearRect(0, 0, canvas.width, canvas.height);
    width = 1280;
    height = 720;
    if (width && height) {
      canvas.width = wrap.clientWidth;
      canvas.height = wrap.clientHeight;
      context.drawImage(src, 0, 0, wrap.clientWidth, wrap.clientHeight);

      var data = canvas.toDataURL('image/png');
      var title = document.getElementById("title-img").value;

      toSave = { title: title, img : data, itms : items }

      wrap.style.display = 'none';
      canvas.style.display = '';
    }
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
    if (canvas.style.display == '') {
        if (started === false) {
            newimage.style.display = '';
            canvas.style.display = 'none';
            storeToCanva(newimage, newimage);
        }
        if (toSave)
            toSave.title = document.getElementById("title-img").value;
        if (toSave !== null && toSave.itms.length > 0 && toSave.title != '' && toSave.img != 'data:,' && toSave.img != '') {
            var obj = JSON.stringify(toSave);
            var xmlhttp = sendPostAjax("index.php?p=photo.save");
            xmlhttp.onload = function () {          
                canvas.style.display = 'none';
                toSave.img = '';
                if (started === true) {                
                    embed_video.style.display = '';          
                }
                else {
                    newimage.style.display = '';
                }
                setEvent();
                loadPicturesUser();
                alert(xmlhttp.responseText);
            };
            xmlhttp.send("data=" + obj);
        }
    }
}

loadPicturesUser();
function loadPicturesUser() {
    var x2 = sendGetAjax("index.php?p=photo.user");
    x2.onload = function () {
        if (x2.status === 200) {
            var json = JSON.parse(x2.responseText);

            side.innerHTML = '';
            json.forEach(element => {
                addPictureToSidebar("upload/" + element.name);
            });
        }
    }
    x2.send();
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
        side.append(li);
}

function cancelPicture() 
{
    location.reload();
}