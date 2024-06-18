

$('#loginForm').on('submit', function (e) {
  e.preventDefault()
  console.log(e);

  let username = $('#username').val()
  let password = $('#password').val()

  if (username === 'jay' && password === '12349') {
    window.location.href = '/public/proveedor.html'
  } else {
    Swal.fire({
      icon: 'error',
      title: 'Opps... Credenciales incorrectas',
      showConfirmButton: false,
      timer: 2000,
    }).then((res) => {
      window.location.href = '/public/log.html'
    })
  }
})
