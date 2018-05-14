var gallery = null;

gallery = document.getElementById('my-gallery');

loadPicturesGallery();
function loadPicturesGallery() {
    console.log("debut");
    var x2 = sendGetAjax("index.php?p=home.gallery");
    x2.onload = function () {
        if (x2.status === 200) {
            var json = JSON.parse(x2.responseText);

            side.innerHTML = '';
            json.forEach(element => {
                createNodeGallery(element);
            });
        }
    }
    x2.send();
}

function createNodeGallery(obj)
{
    console.log(obj);
    if (gallery) {
        let pic = document.createElement('PICTURE');
        pic.classList.add("picture");
        pic.classList.add("img-thumbnail");
        pic.setAttribute('id', obj.id);

        let title = document.createElement('SPAN');
        title.classList.add("name-photo");
        title.innerText = obj.title;

        let img = document.createElement("IMG");
        img.classList.add("img-fluid");
        img.setAttribute('src', "../upload/" + obj.name);

        let cont = document.createElement('DIV');
        cont.classList.add("d-flex");
        cont.classList.add("justify-content-between");
        cont.classList.add("info-gallery");
        let com = document.createElement('SPAN');
        com.classList.add("com-photo");
        com.innerText = 10;
        let like = document.createElement('SPAN');
        like.classList.add("like-photo");
        like.innerText = 2;

        cont.appendChild(com);
        cont.appendChild(like);

        pic.appendChild(title);
        pic.appendChild(img);
        pic.appendChild(cont);

        gallery.appendChild(pic);
    }
}