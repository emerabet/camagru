var zoomout = document.getElementById("zoom-out");
var zoomin = document.getElementById("zoom-in");


function allowDrop(ev) {
    ev.preventDefault();
}

var dragleft = null;
var dragtop  = null;

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
    dragleft = ev.offsetX;
    dragtop = ev.offsetY;
}

var test = null;
var items = [];

function removeItem(itm) {
    items = items.filter(function(el) {
        return el.id !== itm.id;
    });
}

function updateItems(itm)
{
    removeItem(itm);
    items.push(itm);

    updateState();
}

function updateState() {
    if (items.length === 0) {
        btnSave.style.display = 'none';
        zoomin.style.display = 'none';
        zoomout.style.display = 'none';

        btnSave.classList.add('disabled');
        zoomin.classList.add('disabled');
        zoomout.classList.add('disabled');
        btnCancel.classList.add('disabled');

        btnTake.classList.add('disabled');
        btnTake.style.display = 'none';
    }
    else {
        btnSave.style.display = '';
        zoomin.style.display = '';
        zoomout.style.display = '';

        if (started === true) {
            btnTake.classList.remove('disabled');
            btnTake.style.display = '';
        }

        btnSave.classList.remove('disabled');
        zoomin.classList.remove('disabled');
        zoomout.classList.remove('disabled');
        btnCancel.classList.remove('disabled');
    }
}

function add_itm(target, itm, x, y) {
    var posX = x;
    var posY = y;

    itm.classList.add("my-deco");

    itm.style.top = posY + "px";
    itm.style.left = posX + "px";
    target.appendChild(itm);

    var obj = { id: itm.id, top: posY, left: posX, width: itm.clientWidth, height: itm.clientHeight, emw: wp.clientWidth, emh: wp.clientHeight };
    updateItems(obj);
}

function cumulOffset(element) {
    var top = 0, left = 0;
    do {
        top += element.offsetTop  || 0;
        left += element.offsetLeft || 0;
        element = element.offsetParent;
    } while(element);

    return {
        top: top,
        left: left
    };
};

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    var itm = document.getElementById(data);
    test = ev;

    if (itm) {
        var oo = cumulOffset(wp);
        var posX = ev.pageX - oo.left - dragleft;
        var posY = ev.pageY - oo.top - dragtop

        if (ev.target.id == "set-img") {
            itm.classList.remove("my-deco");
            itm.style.top = null;
            itm.style.left = null;
            ev.target.appendChild(itm);
            removeItem(itm);
            updateState();
        }
        else if (ev.target.parentElement.id == "my-wrapper") {
            if (ev.target.id == "embed-video") {
                add_itm(ev.target.parentElement, itm, posX, posY);
            }
            else {
                add_itm(wp, itm, posX, posY);
            }
        }
    }
}

setimg = document.getElementById("set-img");
wpimg = document.getElementById("my-wrapper");

function setEvent() {
    document.getElementById("img-hado").addEventListener("dragstart", drag);
    document.getElementById("img-champ").addEventListener("dragstart", drag);
    document.getElementById("img-coca").addEventListener("dragstart", drag);
    document.getElementById("img-kebab").addEventListener("dragstart", drag);
    document.getElementById("img-worldcup").addEventListener("dragstart", drag);
    document.getElementById("img-lunette").addEventListener("dragstart", drag);

    if (setimg) {
        setimg.addEventListener("drop", drop);
        setimg.addEventListener("dragover", allowDrop);
    }
    if (wpimg) {
        wpimg.addEventListener("drop", drop);
        wpimg.addEventListener("dragover", allowDrop);
    }
    zoomin.addEventListener("click", zoom);
    zoomout.addEventListener("click", zoom);
}

function removeEvent() {
    document.getElementById("img-hado").removeEventListener("dragstart", drag);
    document.getElementById("img-champ").removeEventListener("dragstart", drag);
    document.getElementById("img-coca").removeEventListener("dragstart", drag);
    document.getElementById("img-kebab").removeEventListener("dragstart", drag);
    document.getElementById("img-worldcup").removeEventListener("dragstart", drag);
    document.getElementById("img-lunette").removeEventListener("dragstart", drag);

    if (setimg) {
        setimg.removeEventListener("drop", drop);
        setimg.removeEventListener("dragover", allowDrop);
    }
    if (wpimg) {
        wpimg.removeEventListener("drop", drop);
        wpimg.removeEventListener("dragover", allowDrop);
    }
    zoomin.removeEventListener("click", zoom);
    zoomout.removeEventListener("click", zoom);
}

function zoom(e)
{
    if (items.length > 0) {
        var last = document.getElementById(items[items.length -1].id)
        if (this.id == "zoom-in") {
            last.width = last.clientWidth + 25;
            items[items.length -1].width = last.clientWidth;
            items[items.length -1].height = last.clientHeight;
        }
        else if (this.id == "zoom-out") {
            last.width = last.clientWidth - 25;
            items[items.length -1].width = last.clientWidth;
            items[items.length -1].height = last.clientHeight;;
        }
    }
}