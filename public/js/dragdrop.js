
function allowDrop(ev) {
    ev.preventDefault();
}

function drag(ev) {
    ev.dataTransfer.setData("text", ev.target.id);
}

var test = null;
var dd =null;
function drop(ev) {
    ev.preventDefault();
    var data = ev.dataTransfer.getData("text");
    var itm = document.getElementById(data);
    test = ev;
    
    if (itm) {
        if (ev.target.parentElement.id == "my-wrapper") {
            itm.classList.add("my-deco");
            itm.style.top = ev.clientX + "px";
            itm.style.left = ev.clientY + "px";
            console.log("X:" + ev.clientX + "px;");
            console.log("y:" + ev.clientY + "px;");
            ev.target.parentElement.appendChild(itm);
            dd = itm;
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