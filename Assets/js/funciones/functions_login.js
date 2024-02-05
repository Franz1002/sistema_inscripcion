function enterLogin(e) {
    e.preventDefault();
    const strUser = document.getElementById("user");
    const strPassword = document.getElementById("password");
    if (strUser.value == "" || strPassword.value == "") {
        Swal.fire({
            icon: 'error',
            showCloseButton: true,
            title: 'Error!',
            text: 'El usuario y la contraseña son obligatorios',
            color: '#716add',
            timer: '5000',
            timerProgressBar: 'true',
            background: '#fffff',
            backdrop: `
                      rgba(2,0,106,0.3)                     
                      left top
                      no-repeat
                  `
        });

    } else {
        const xhttp = new XMLHttpRequest();
        const ajaxUrl = baseUrl + '/login/log';
        const form = document.getElementById("formLogin");

        xhttp.open("POST", ajaxUrl, true);
        xhttp.send(new FormData(form));
        console.log(xhttp);
        xhttp.onreadystatechange = function () {
            console.log(xhttp);
            if (xhttp.readyState != 4) return;
            if (xhttp.status == 200) {
                const result = JSON.parse(xhttp.responseText);
                if (result == 1) {
                    window.location = baseUrl + '/inicio';
                } else {
                    Swal.fire({
                        icon: 'error',
                        showCloseButton: true,
                        title: 'Error!',
                        text: 'El usuario o la contraseña son incorrectos',
                        color: '#716add',
                        timer: '5000',
                        timerProgressBar: 'true',
                        background: '#fffff',
                        backdrop: `
                                              rgba(2,0,106,0.3)                     
                                              left top
                                              no-repeat
                                          `
                    });
                
                    document.querySelector('#password').value = "";
                }
            } else {
                Swal.fire({
                    icon: 'error',
                    showCloseButton: true,
                    title: 'Error!',
                    text: 'El usuario o la contraseña son incorrectos',
                    color: '#716add',
                    timer: '5000',
                    timerProgressBar: 'true',
                    background: '#fffff',
                    backdrop: `
                                          rgba(2,0,106,0.3)                     
                                          left top
                                          no-repeat
                                      `
                });
                document.querySelector('#password').value = "";
            }
        }
    }
}
