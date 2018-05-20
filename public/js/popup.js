var modal = document.querySelector(".my_modal");
var trigger = document.querySelector(".my_trigger");
var closeButton = document.querySelector(".my_close-button");

function toggleModal() {
    modal.classList.toggle("my_show-modal");
}

function windowOnClick(event) {
    if (event.target === modal) {
        toggleModal();
    }
}
if (trigger)
    trigger.addEventListener("click", toggleModal);
if (closeButton)
    closeButton.addEventListener("click", toggleModal);

window.addEventListener("click", windowOnClick);


function updateField()
{
    if (chkAccount.checked == true)
    {
        pwd1.readOnly = false;
        pwd2.readOnly = false;
        pwd1.required = true;
        pwd2.required = true;
    }
    else
    {
        pwd1.readOnly = true;
        pwd2.readOnly = true;
        pwd1.required = false;
        pwd2.required = false;
        pwd1.value = "";
        pwd2.value = "";
    }
}

var chkAccount = document.getElementById("chkAccount");
var pwd1 = document.getElementById("inputPassword");
var pwd2 = document.getElementById("inputConfirmPassword");

if (chkAccount)
    chkAccount.addEventListener("click", updateField);