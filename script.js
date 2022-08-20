function submitform(form, replacecontent, target = "/") {
    const xhr = new XMLHttpRequest();
    const formData = new FormData(form);
    xhr.open("POST", target);
    xhr.onreadystatechange = function () {
        if (document.querySelector(replacecontent) && this.response !== "" && this.readyState == 4) {
            var elm = document.querySelector(replacecontent);
            elm.innerHTML = this.response;

            document.querySelector('.download').style.display = "unset";

        }
    }
    xhr.send(formData);
    return false;
}

function resizecard() {
    let size = window.innerWidth * 0.8 / 560;
    if (size * 356 > document.querySelector('.card').clientHeight) size = document.querySelector('.card').clientHeight / 400
    document.querySelector('.card').style.transform = "scale(" + size + ")"
}

window.addEventListener('load', resizecard);
if (!/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))
    window.addEventListener('resize', resizecard);
document.querySelector('.download').addEventListener('click', () => {
    window.location.href = "savecard/?Type=" + document.querySelector('.card').getAttribute('Type') + "&Name=" + document.querySelector('.studatas .Name .value span').innerText + "&SID=" + document.querySelector('.studatas .SID .value span').innerText + "&Major=" + document.querySelector('.studatas .Major .value span').innerText + "&Valid=" + document.querySelector('.studatas .Valid .value span').innerText;
});