
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
var dd =null;

var items = [];

function updateItems(itm)
{
    items = items.filter(function(el) {
        return el.id !== itm.id;
    });
    items.push(itm);

    console.log(items);
}

function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    var itm = document.getElementById(data);
    test = ev;

    if (itm) {
        if (ev.target.parentElement.id == "my-wrapper") {

            if (ev.target.id == "embed-video") {
            var posX = ev.offsetX - dragleft;
            var posY = ev.offsetY - dragtop;

            itm.classList.add("my-deco");
            itm.style.top = posY + "px";
            itm.style.left = posX + "px";
            ev.target.parentElement.appendChild(itm);
            dd = itm;

            var obj = { id: itm.id, top: posY, left: posX, width: itm.width, height: itm.height };
            
            updateItems(obj);


            }
        } else {
            itm.classList.remove("my-deco");
            itm.style.top = null;
            itm.style.left = null;
            ev.target.appendChild(itm);
        }
    }
}

setimg = document.getElementById("set-img");
wpimg = document.getElementById("my-wrapper");
imgdraggable = document.getElementById("img-hado");

if (setimg) {
    setimg.addEventListener("drop", drop);
    setimg.addEventListener("dragover", allowDrop);
}
if (wpimg) {
    wpimg.addEventListener("drop", drop);
    wpimg.addEventListener("dragover", allowDrop);
}

if (imgdraggable)
    imgdraggable.addEventListener("dragstart", drag);