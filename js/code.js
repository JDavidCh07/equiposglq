$(document).ready(function () {
    $('#mytable').DataTable( {
    "language": {
        "decimal": "",
        "emptyTable": "No hay información",
        "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
        "infoEmpty": "Mostrando 0 a 0 de 0 Entradas",
        "infoFiltered": "(Filtrado de _MAX_ total entradas)",
        "infoPostFix": "",
        "thousands": ",",
        "lengthMenu": "Mostrar _MENU_ Entradas",
        "loadingRecords": "Cargando...",
        "processing": "Procesando...",
        "search": "Buscar:",
        "zeroRecords": "Sin resultados encontrados",
        "paginate": {
            "first": "Primero",
            "last": "Ultimo",
            "next": "Siguiente",
            "previous": "Anterior"
        }
    }
});
});

function verpass() {
  const passwordInput = document.getElementById('password');
  const eyeIcon = document.getElementById('vpass');

  if (passwordInput.type === 'password') {
      passwordInput.type = 'text';
      eyeIcon.classList.remove('fa-eye');
      eyeIcon.classList.add('fa-eye-slash');  
  } else if (passwordInput.type === 'text'){
      passwordInput.type = 'password';
      eyeIcon.classList.remove('fa-eye-slash');
      eyeIcon.classList.add('fa-eye');
  }
}

function solonum(e) {
	key=e.keyCode || e.which;
	teclado=String.fromCharCode(key);
	numeros="0123456789";
	var especiales=["8","45"];
	teclado_especial=false;
	for(var i in especiales) {
		if(key==especiales[i]) {
			teclado_especial=true;
		}
	}
	if(numeros.indexOf(teclado)==-1 && !teclado_especial) {
		return false;
	}
}

function sololet(f){
  key=f.keyCode || f.which;
  teclado=String.fromCharCode(key);
  letras=" abcdefghijklmnñopqrstuvwxyzáéíóú"+" ABCDEFGHIJKLMNÑOPQRSTUVWXYZÁÉÍÓÚ";
  especiales="8-37-38-46";
  teclado_especial=false;
  for(var u in especiales){
      if(key==especiales[u]){
          teclado_especial=true;
      }
  }
  if(letras.indexOf(teclado)==-1 && !teclado_especial ){
      return false;
  }
}


function recCiudad(value){
    //alert("Si le llega "+value);
    var parametros = {
        "valor" : value
    };
    $.ajax({
        data: parametros,
        url: 'views/selmun.php',
        type: 'post',
        success: function(response){
            $("#reloadMun").html(response);
        }
    });
}


function eliminar(nom){
    let v = confirm("¿Está seguro de eliminar este registro?\n\n- "+nom);
    return v;
}

function pdf(pdfPath) {
  var w = window.innerWidth * 0.8;
  var h = window.innerHeight * 0.8;
  var l = (window.innerWidth - w) / 2;
  var t = (window.innerHeight - h) / 2;

  window.open(pdfPath, 'Vista Previa', 'width=' + w + ',height=' + h + ',left=' + l + ',top=' + t);
}

$('ul li').on('click', function() {
	$('li').removeClass('active');
	$(this).addClass('active');
});

//-----------Menu----------

document.addEventListener("DOMContentLoaded", function(event) {
   
    const showNavbar = (toggleId, navId, bodyId, headerId) =>{
    const toggle = document.getElementById(toggleId),
    nav = document.getElementById(navId),
    bodypd = document.getElementById(bodyId),
    headerpd = document.getElementById(headerId)
    
    // Validate that all variables exist
    if(toggle && nav && bodypd && headerpd){
    toggle.addEventListener('click', ()=>{
    // show navbar
    nav.classList.toggle('showcabe')
    // change icon
    toggle.classList.toggle('bx-x')
    // add padding to body
    bodypd.classList.toggle('body-pd')
    // add padding to header
    headerpd.classList.toggle('body-pd')
    })
    }
    }
    
    showNavbar('header-toggle','nav-bar','body-pd','header')
    
    /*===== LINK ACTIVE =====*/
    const linkColor = document.querySelectorAll('.nav_link')
    
    function colorLink(){
    if(linkColor){
    linkColor.forEach(l=> l.classList.remove('active'))
    this.classList.add('active')
    }
    }
    linkColor.forEach(l=> l.addEventListener('click', colorLink))
    
    });


    //menu desplegable

    // function initDropdown() {
    //     const dropdownTrigger = document.querySelector(".dropdown-trigger");
    //     const nav = document.querySelector(".nav");
      
    //     dropdownTrigger.addEventListener("click", function (e) {
    //       e.preventDefault();
    //       nav.classList.toggle("active");
    //     });
    //   }
      
    //   document.addEventListener("DOMContentLoaded", initDropdown);
      
//----------Menu------------


function ocul(mos=0,est=0){
    if(mos==1){
        if(est==1){
            document.getElementById("frmins").style.display = "inherit";
            document.getElementById("mas").style.display = "none";
            document.getElementById("menos").style.display = "inherit";
        }else{
            document.getElementById("frmins").style.display = "none";
            document.getElementById("mas").style.display = "inherit";
            document.getElementById("menos").style.display = "none";
        }
    }
}

function err(mess=""){
    if(mess){
        mess = "<strong>Error:</strong> ¡"+mess+"!";
        document.getElementById("err").innerHTML = mess;
        document.getElementById("err").style.display = "inline-block";
    }else{
        document.getElementById("err").innerHTML = "";
        document.getElementById("err").style.display = "none";
    }

}

function satf(mess=""){
  if(mess){
      mess = "¡"+mess+"!";
      document.getElementById("satf").innerHTML = mess;
      document.getElementById("satf").style.display = "inline-block";
  }else{
      document.getElementById("satf").innerHTML = "";
      document.getElementById("satf").style.display = "none";
  }

}

// combobox1 JQeuryUI
$(function() {
  $.widget("custom.combobox1", {
      _create: function() {
          this.wrapper = $("<span>")
              .addClass("custom-combobox1")
              .insertAfter(this.element);

          this.element.hide();
          this._createAutocomplete();
          this._createShowAllButton();
      },

      _createAutocomplete: function() {
          var selected = this.element.children(":selected"),
              value = selected.val() ? selected.text().trim() : "";

          this.input = $("<input>")
              .appendTo(this.wrapper)
              .val(value)
              .attr("title", "")
              .attr("required", this.element.attr('required') ? 'required' : null) // Sync 'required'
              .prop("disabled", this.element.prop('disabled')) // Sync 'disabled'
              .addClass("custom-combobox1-input ui-widget ui-widget-content ui-state-default ui-corner-left")
              .autocomplete({
                  delay: 0,
                  minLength: 0,
                  source: this._source.bind(this)
              })
              .tooltip({
                  classes: {
                      "ui-tooltip": "ui-state-highlight"
                  }
              });

          this._on(this.input, {
              autocompleteselect: function(event, ui) {
                  ui.item.option.selected = true;
                  this._trigger("select", event, {
                      item: ui.item.option
                  });
              },
              autocompletechange: "_removeIfInvalid"
          });
      },

      _createShowAllButton: function() {
          var input = this.input,
              wasOpen = false;

          $("<a>")
              .attr("tabIndex", -1)
              .attr("title", "Show All Items")
              .tooltip()
              .appendTo(this.wrapper)
              .button({
                  icons: {
                      primary: "ui-icon-triangle-1-s"
                  },
                  text: false
              })
              .removeClass("ui-corner-all")
              .addClass("custom-combobox1-toggle ui-corner-right")
              .on("mousedown", function() {
                  wasOpen = input.autocomplete("widget").is(":visible");
              })
              .on("click", function() {
                  input.trigger("focus");

                  // Close if already visible
                  if (wasOpen) {
                      return;
                  }

                  // Pass empty string as value to search for, displaying all results
                  input.autocomplete("search", "");
              });
      },

      _source: function(request, response) {
          var matcher = new RegExp($.ui.autocomplete.escapeRegex(request.term), "i");
          response(this.element.children("option").map(function() {
              var text = $(this).text().trim();
              if (this.value && (!request.term || matcher.test(text)))
                  return {
                      label: text,
                      value: text,
                      option: this
                  };
          }));
      },

      _removeIfInvalid: function(event, ui) {
          // Selected an item, nothing to do
          if (ui.item) {
              return;
          }

          // Search for a match (case-insensitive)
          var value = this.input.val().trim(),
              valueLowerCase = value.toLowerCase(),
              valid = false;
          this.element.children("option").each(function() {
              if ($(this).text().trim().toLowerCase() === valueLowerCase) {
                  this.selected = valid = true;
                  return false;
              }
          });

          // Found a match, nothing to do
          if (valid) {
              return;
          }

          // Remove invalid value
          this.input
              .val("")
              .attr("title", value + " didn't match any item")
              .tooltip("open");
          this.element.val("");
          this._delay(function() {
              this.input.tooltip("close").attr("title", "");
          }, 2500);
          this.input.autocomplete("instance").term = "";
      },

      _destroy: function() {
          this.wrapper.remove();
          this.element.show();
      }
  });

  $("#combobox1").combobox1();
  $("#toggle").on("click", function() {
      $("#combobox1").toggle();
  });
});

  // combobox2 JQeuryUI
$( function() {
  $.widget( "custom.combobox2", {
    _create: function() {
      this.wrapper = $( "<span>" )
        .addClass( "custom-combobox2" )
        .insertAfter( this.element );

      this.element.hide();
      this._createAutocomplete();
      this._createShowAllButton();
    },

    _createAutocomplete: function() {
      var selected = this.element.children( ":selected" ),
        value = selected.val() ? selected.text().trim() : "";

      this.input = $( "<input>" )
        .appendTo( this.wrapper )
        .val( value )
        .attr( "title", "" )
        .attr("required", this.element.attr('required') ? 'required' : null)
        .prop("disabled", this.element.prop('disabled'))
        .addClass( "custom-combobox2-input ui-widget ui-widget-content ui-state-default ui-corner-left" )
        .autocomplete({
          delay: 0,
          minLength: 0,
          source: this._source.bind( this )
        })
        .tooltip({
          classes: {
            "ui-tooltip": "ui-state-highlight"
          }
        });

      this._on( this.input, {
        autocompleteselect: function( event, ui ) {
          ui.item.option.selected = true;
          this._trigger( "select", event, {
            item: ui.item.option
          });
        },

        autocompletechange: "_removeIfInvalid"
      });
    },

    _createShowAllButton: function() {
      var input = this.input,
        wasOpen = false;

      $( "<a>" )
        .attr( "tabIndex", -1 )
        .attr( "title", "Show All Items" )
        .tooltip()
        .appendTo( this.wrapper )
        .button({
          icons: {
            primary: "ui-icon-triangle-1-s"
          },
          text: false
        })
        .removeClass( "ui-corner-all" )
        .addClass( "custom-combobox2-toggle ui-corner-right" )
        .on( "mousedown", function() {
          wasOpen = input.autocomplete( "widget" ).is( ":visible" );
        })
        .on( "click", function() {
          input.trigger( "focus" );

          // Close if already visible
          if ( wasOpen ) {
            return;
          }

          // Pass empty string as value to search for, displaying all results
          input.autocomplete( "search", "" );
        });
    },

    _source: function( request, response ) {
      var matcher = new RegExp( $.ui.autocomplete.escapeRegex(request.term), "i" );
      response( this.element.children( "option" ).map(function() {
        var text = $( this ).text().trim();
        if ( this.value && ( !request.term || matcher.test(text) ) )
          return {
            label: text,
            value: text,
            option: this
          };
      }) );
    },

    _removeIfInvalid: function( event, ui ) {

      // Selected an item, nothing to do
      if ( ui.item ) {
        return;
      }

      // Search for a match (case-insensitive)
      var value = this.input.val().trim(),
        valueLowerCase = value.toLowerCase(),
        valid = false;
      this.element.children( "option" ).each(function() {
        if ( $( this ).text().trim().toLowerCase() === valueLowerCase ) {
          this.selected = valid = true;
          return false;
        }
      });

      // Found a match, nothing to do
      if ( valid ) {
        return;
      }

      // Remove invalid value
      this.input
        .val( "" )
        .attr( "title", value + " didn't match any item" )
        .tooltip( "open" );
      this.element.val( "" );
      this._delay(function() {
        this.input.tooltip( "close" ).attr( "title", "" );
      }, 2500 );
      this.input.autocomplete( "instance" ).term = "";
    },

    _destroy: function() {
      this.wrapper.remove();
      this.element.show();
    }
  });

  $( "#combobox2" ).combobox2();
  $( "#toggle" ).on( "click", function() {
    $( "#combobox2" ).toggle();
  });
} );

document.addEventListener('DOMContentLoaded', function() {
  const textarea = document.getElementById('observ');
  
  if (textarea) {
      const initialContent = textarea.value;

      textarea.addEventListener('keydown', function(e) {
          const cursorPosition = textarea.selectionStart;
          const textLength = textarea.value.length;

          // Prevent deletion
          if (e.key === 'Backspace' && cursorPosition <= initialContent.length) {
              e.preventDefault();
          }
          if (e.key === 'Delete' && cursorPosition < initialContent.length) {
              e.preventDefault();
          }
          // Prevent selection and replacement
          if (textarea.selectionStart < initialContent.length || textarea.selectionEnd < initialContent.length) {
              e.preventDefault();
          }
      });

      textarea.addEventListener('input', function(e) {
          // Ensure the initial content remains unchanged
          if (textarea.value.substring(0, initialContent.length) !== initialContent) {
              textarea.value = initialContent + textarea.value.substring(initialContent.length);
          }
      });
  }
});