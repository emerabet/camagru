var gallery = null;
var userconnected = null;

gallery = document.getElementById('my-grid');

loadPicturesGallery(1);
function loadPicturesGallery(page) 
{
    let x2 = sendGetAjax("index.php?p=home.gallery&from=" + page);
    x2.onload = function () {
        if (x2.status === 200) {
            if (gallery)
                gallery.innerHTML = '';

            let json = JSON.parse(x2.responseText);
            createPagitation(json.total, json.page);
            json.rows.forEach(element => {
                createNodeGallery(element);
            });
        }
    }
    x2.send();
}

function createPagitation(total, current)
{
    let pg = document.getElementById("pagin");
    pg.innerHTML = '';
    for (let index = 1; index <= total; index++) {

        let li = document.createElement('LI');
        let a = document.createElement('A');
        li.classList.add("page-item");
        if (index == current)
            li.classList.add("active");
        li.setAttribute('id', "li-" + index);
        a.innerText = index;
        a.classList.add("page-link");
        a.addEventListener('click', function () {
            loadPicturesGallery(this.innerText);
        });
        li.appendChild(a);
        pg.appendChild(li);
    }
}

function createNodeGallery(obj)
{
    if (gallery) {
        let pic = document.createElement('PICTURE');
        pic.classList.add("picture");
        pic.classList.add("img-thumbnail");
        pic.setAttribute('id', obj.id);

        let title = document.createElement('SPAN');
        title.classList.add("name-photo");
        title.innerText = obj.title;

        let a = document.createElement("A");
        a.setAttribute('href', "index.php?p=photo.show&id=" + obj.id);

        let img = document.createElement("IMG");
        img.classList.add("img-fluid");
        img.classList.add("my-img"); 
        img.setAttribute('src', "upload/" + obj.name);

        a.appendChild(title);
        a.appendChild(img);

        let cont = document.createElement('DIV');
        cont.classList.add("d-flex");
        cont.classList.add("justify-content-between");
        cont.classList.add("info-gallery");
        let com = document.createElement('SPAN');
        com.classList.add("com-photo");
        com.innerText = obj.nb_comment + " Commentaire(s)";

        let sup = document.createElement('SPAN');
        sup.classList.add("sup-photo");
        sup.innerText = "Supprimer";
        sup.addEventListener('click', function () {
            let data = JSON.stringify({ id: obj.id });
            var xmlhttp = sendPostAjax("index.php?p=photo.del");
            xmlhttp.onload = function () {
                if (xmlhttp.status === 200) {
                    pic.parentNode.removeChild(pic);
                    displayToast(xmlhttp.responseText, 'green');
                } else { 
                    displayToast(xmlhttp.responseText, 'red');
                }
            };
            xmlhttp.send("data=" + data);
        });

        let like = document.createElement('SPAN');
        like.setAttribute('id', obj.id);
        like.classList.add("like-photo");
        like.innerText = obj.nb_upvote;
        like.addEventListener('click', function () {
            let el = this;
            let id = this.id;
            let data = JSON.stringify({ id: id });
            var xmlhttp = sendPostAjax("index.php?p=upvote");
            xmlhttp.onload = function () {
                if (xmlhttp.status === 200) {
                    el.innerText = parseInt(el.innerText) + 1;
                    displayToast(xmlhttp.responseText, 'green');
                }
                else if (xmlhttp.status === 202) {
                    el.innerText = parseInt(el.innerText) - 1;
                    displayToast(xmlhttp.responseText, 'green');
                } else {
                    displayToast(xmlhttp.responseText, 'red');
                }                
            };
            xmlhttp.send("data=" + data);
        });

        cont.appendChild(com);

        cont.appendChild(sup);
        cont.appendChild(like);

        pic.appendChild(a);
        pic.appendChild(cont);
        
        document.getElementById('my-grid').appendChild(pic);
    }
}