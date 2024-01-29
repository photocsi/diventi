/* <!--   tasti rapidi per la dimensione delle immagini --> */

  document.addEventListener('keydown', function(event) {
    if (event.code == 'Digit1' && (event.ctrlKey || event.shiftKey)) {
      var card = (document.getElementsByClassName("card"));
      for (i = 0; i < card.length; i++) {
        document.querySelectorAll('#card_foto')[i].style.width = '8rem';
      }
    }

    if(event.code == 'Digit2' && (event.ctrlKey || event.shiftKey)) {
      var card = (document.getElementsByClassName("card"));
      for (i = 0; i < card.length; i++) {
        document.querySelectorAll('#card_foto')[i].style.width = '18rem';
      }
    }

    if(event.code == 'Digit3' && (event.ctrlKey || event.shiftKey)) {
      var card = (document.getElementsByClassName("card"));
      for (i = 0; i < card.length; i++) {
        document.querySelectorAll('#card_foto')[i].style.width = '24rem';
      }
    }

    if(event.code == 'Digit4' && (event.ctrlKey || event.shiftKey)) {
      var card = (document.getElementsByClassName("card"));
      for (i = 0; i < card.length; i++) {
        document.querySelectorAll('#card_foto')[i].style.width = '32rem';
      }
    }

    if(event.code == 'Digit5' && (event.ctrlKey || event.shiftKey)) {
      var card = (document.getElementsByClassName("card"));
      for (i = 0; i < card.length; i++) {
        document.querySelectorAll('#card_foto')[i].style.width = '40rem';
      }
    }


  });


