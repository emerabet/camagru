var gallery = null;

gallery = document.getElementById('my-gallery');

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
        img.classList.add("my-img"); 
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