function sendPostAjax(url)
{
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", url);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    return xmlhttp;
}