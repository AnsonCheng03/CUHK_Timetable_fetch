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

function isNumberKey(evt) {
    const charCode = (evt.which) ? evt.which : event.keyCode;
    if ((charCode < 48 || charCode > 57))
        return false;

    return true;
}
