var btnComment = document.getElementById("send-cmt");
var listcmt = document.getElementById("list-cmt");

if (btnComment)
    btnComment.addEventListener('click', sendcomment);

function sendcomment()
{
    let comment = document.getElementById("post-com").value;
    let iduser = document.getElementById("iduser").value;
    let token = document.getElementById("token").value;
    let idphoto = document.getElementById("idphoto").value;
    if (comment !== null && comment.length > 0 && iduser > 0 && idphoto > 0) {
        let toSave = { iduser, token, idphoto, comment}
        var obj = JSON.stringify(toSave);
        var xmlhttp = sendPostAjax("index.php?p=send.comment");
        xmlhttp.onload = function () {
            if (xmlhttp.status === 200) {
                document.getElementById("nbc").innerText = parseInt(document.getElementById("nbc").innerText) + 1;
                document.getElementById("post-com").value = "";
                createNodeComment(comment);
                displayToast(xmlhttp.responseText, 'green');
            } else {
                displayToast(xmlhttp.responseText, 'red');
            }
        };
        xmlhttp.send("data=" + obj);
    }
}

function createNodeComment(comment)
{
    let a = document.createElement("A");
    a.setAttribute("src", "javascript:undefined");
    a.classList.add("list-group-item", "list-group-item-action", "flex-column", "align-items-start", "active");

    let div = document.createElement("DIV");
    div.classList.add("d-flex", "w-100", "justify-content-between");

    let small1 = document.createElement("SMALL");
    let em1 = document.createElement("EM");
    em1.innerText = document.getElementById("myname").value;
    small1.appendChild(em1);

    let small2 = document.createElement("SMALL");
    let em2 = document.createElement("EM");
    em2.innerText = "A l'instant";
    small2.appendChild(em2);

    let p = document.createElement("P");
    p.classList.add("mb-1");
    p.innerText = comment;

    div.appendChild(small1);
    div.appendChild(small2);

    a.appendChild(div);
    a.appendChild(p);
    listcmt.prepend(a);
}