$('#loginForm').on('submit', () => {
  document.location = '/public/proveedor.html'
})

$('.nav-link').on('click', function () {
  $('.nav-link').removeClass('activ')
  $(this).addClass('activ')
})


$(document).ready(function () {
  for (let i = 0; i < 100; i++) {
    $('#table').find('tbody').append(`
    <tr>
      <td>${i+1}</td>
      <td>Tratamientos</td>
      <td>Tratamientos</td>
      <td>
        <button
          class="bg-white border-2 border-aqua"
          type="button"
          title="Editar"
        >
          <i class="fa fa-edit"></i>
        </button>
        <button class="buttons" title="Eliminar" type="button">
          <i class="fa fa-trash"></i>
        </button>
      </td>
    </tr>
  `)
  }
  $('#table').DataTable()
})

$('#btn-menu').on('click', function(){
  $("aside").toggleClass('h-2/12')
  $(this).find('.fa-bars').toggleClass('hidden')
  $(this).find('.fa-close').toggleClass('hidden')
  $('#menu').toggle("fast")
})
