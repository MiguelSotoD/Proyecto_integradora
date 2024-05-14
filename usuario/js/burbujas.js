

  
      $(function() {
          $('#WAButton').floatingWhatsApp({
              phone: '5216181225476', //Número de telefono (Con prefijo 521 para México)
              headerTitle: '¡Envíanos un mensaje!', //Título de la ventana
              popupMessage: '¡Hola!, Gracias por confiar en nosotros. ¿En qué te podemos ayudar?', //Mensaje de la ventana
              showPopup: true, //Permite que esté visible el botón flotante
              buttonImage: '<img src="https://rawcdn.githack.com/rafaelbotazini/floating-whatsapp/3d18b26d5c7d430a1ab0b664f8ca6b69014aed68/whatsapp.svg" class="imgpop" />', //Button Image
              position: "right"
          });
      });
 