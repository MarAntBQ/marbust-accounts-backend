const typed = new Typed('.js-home-banner-description', {
  /*strings: ['Full Stack Web Developer',
            'Web Back-end Developer',
            'Web Front-end Developer',
            'Web Media Developer'
           ],*/
  stringsElement: '#home-seo-strings', // ID del elemento que contiene cadenas de texto a mostrar.
  typeSpeed: 70, // Velocidad en mlisegundos para poner una letra,
  startDelay: 150, // Tiempo de retraso en iniciar la animacion. Aplica tambien cuando termina y vuelve a iniciar,
  backSpeed: 70, // Velocidad en milisegundos para borrrar una letra,
  smartBackspace: false, // Eliminar solamente las palabras que sean nuevas en una cadena de texto.
  shuffle: true, // Alterar el orden en el que escribe las palabras.
  backDelay: 1000, // Tiempo de espera despues de que termina de escribir una palabra.
  loop: true, // Repetir el array de strings
  loopCount: false, // Cantidad de veces a repetir el array.  false = infinite
  showCursor: true, // Mostrar cursor palpitanto
  cursorChar: '<i class="fa-solid fa-i"></i>', // Caracter para el cursor
  contentType: 'html', // 'html' o 'null' para texto sin formato
});