
function acceso(){
  Swal.fire({
      position: 'center',
      icon: 'success',
      title: 'Bienvenido Usuario',
      text: 'Al sistema de administrador',
      showConfirmButton: false,
      timer: 2000
    }).then(function(){
      location.href="principal-admin.php";
    })
};

function accesoest(){
  Swal.fire({
      position: 'center',
      icon: 'success',
      title: 'Bienvenido Usuario',
      text: 'Al sistema de Empleado',
      showConfirmButton: false,
      timer: 2000
    }).then(function(){
      location.href="principal-admin.php";
    })
};
function noacceso(){
Swal.fire({
    position: 'center',
    icon: 'error',
    title: 'POR FAVOR VERIFIQUE',
    text: 'Usuario y/o contraseña incorrectas',
    showConfirmButton: false,
    timer: 2000
  }).then(function(){
    location.href="login.php";
  })
};

function exitosa(){
Swal.fire({
    position: 'center',
    icon: 'success',
    title: 'Cuenta creada exitosamente',
    showConfirmButton: false,
    timer: 2000
  }).then(function(){
    location.href="login.php";
  })
};

function actu(){
Swal.fire({
    position: 'center',
    icon: 'success',
    title: 'Cuenta actualizada exitosamente',
    showConfirmButton: false,
    timer: 2000
  }).then(function(){
    location.href="login.php";
  })
};

function noactu(){
Swal.fire({
    position: 'center',
    icon: 'error',
    title: 'La cuenta no pudo ser actualizada',
    showConfirmButton: false,
    timer: 2000
  }).then(function(){
    location.href="datos-cuenta.php";
  })
};

function addcorrecto(){
  Swal.fire({
      position: 'center',
      icon: 'success',
      title: 'Cliente Agregado Exitosamente',
      showConfirmButton: false,
      timer: 2000
    }).then(function(){
      location.href="clientes.php";
    })
  };


function addincorrecto(){
  Swal.fire({
      position: 'center',
      icon: 'error',
      title: 'POR FAVOR VERIFIQUE',
      text: 'No se pudo Agregar el cliente',
      showConfirmButton: false,
      timer: 2000
    }).then(function(){
      location.href="agregar-clientes.php";
    })
  };


  function eliminarcliente(){
    Swal.fire({
      position: 'center',
      icon: 'success',
      title: 'Se elimino el Usuario Correctamente',
      showConfirmButton: false,
      timer: 1500
    }).then(function(){
      location.href="clientes.php";
    })
   }

   function eliminarticket(){
    Swal.fire({
      position: 'center',
      icon: 'success',
      title: 'Se elimino el Ticket Correctamente',
      showConfirmButton: false,
      timer: 1500
    }).then(function(){
      location.href="tickets.php";
    })
   }

   function eliminarmal(){
    Swal.fire({
      position: 'center',
      icon: 'error',
      title: 'NO SE PUDO ELIMINAR EL USUARIO',
      showConfirmButton: false,
      timer: 1500
    }).then(function(){
      location.href="clientes.php"
    })
   }

   
   function ordencorrecto(){
    Swal.fire({
      title: 'El pedido se Agrego Correctamente',
      text:'¿Deseas Agregar Otro?',
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      cancelButtonText:'No',
      confirmButtonText: 'Si'
    }).then((result) => {
      if (result.isConfirmed) {
        location.href="nuevaOrden.php"
      }else{
        location.href="Ordenes.php"
      }
    })
   }

   function ordenincorrecto(){
    Swal.fire({
      position: 'center',
      icon: 'error',
      title: 'NO SE PUDO AGREGAR LA ORDEN',
      showConfirmButton: false,
      timer: 1500
    }).then(function(){
      location.href="nuevaOrden.php"
    })
   }

  function eliminarOrden(){
    Swal.fire({
      position: 'center',
      icon: 'success',
      title: 'Se Elimino la Orden Correctamente',
      showConfirmButton: false,
      timer: 1500
    }).then(function(){
      location.href="Ordenes.php"
    })
   }


   function actualizar(){
    Swal.fire({
        position: 'center',
        icon: 'success',
        title: 'Se actualizo Correctamente',
        showConfirmButton: false,
        timer: 2000
      }).then(function(){
        location.href="Ordenes.php";
      })
    };
  

    function eliminado(){
      Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Usuario eliminado exitosamente',
          showConfirmButton: false,
          timer: 2000
        }).then(function(){
          location.href="eliminar.php";
        })
    };

    function actualizarc(){
      Swal.fire({
          position: 'center',
          icon: 'success',
          title: 'Se actualizo Correctamente',
          showConfirmButton: false,
          timer: 2000
        }).then(function(){
          location.href="clientes.php";
        })
      };
    

      function nocantidaddisponible(){
        Swal.fire({
          position: 'center',
          icon: 'error',
          title: 'NO HAY CANTIDAD SUFICIENTE',
          showConfirmButton: false,
          timer: 1500
        }).then(function(){
          location.href="nuevaOrden.php"
        })
       }

      