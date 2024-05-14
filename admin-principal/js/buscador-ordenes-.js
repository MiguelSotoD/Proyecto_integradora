
 // Función para filtrar las cards con el buscador
 function filtrarTarjetas() {
    var input, filter, cards, card, textValue, i;
    input = document.getElementById("buscador-ordenes");
    filter = input.value.toLowerCase();
    cards = document.getElementsByClassName("card");

    for (i = 0; i < cards.length; i++) {
      card = cards[i];
      textValue = card.textContent || card.innerText;

      // Comparar lo 
      if (textValue.toLowerCase().indexOf(filter) > -1) {
        card.style.display = ""; 
      } else {
        card.style.display = "none";
      }
    }
  }

  document.getElementById("buscador-ordenes").addEventListener("input", filtrarTarjetas);

