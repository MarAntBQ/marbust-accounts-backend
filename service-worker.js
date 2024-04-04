;
//asignar un nombre y versión al cache
const CACHE_NAME = 'V.7.5.0_Marbust_Accounts',
  urlsToCache = [
	'./',
    'https://use.fontawesome.com/releases/v5.8.1/css/all.css',
    'https://framework.marbust.com/marbust-framework.css',
    'css/style.css',
    'css/fonts/Nexa-Light.otf',
    'css/fonts/Nexa-Bold.otf',
    'css/fonts/Fresh-Eaters.otf',
    'css/marbust-framework.css',
    'app/app-settings.js',
    'js/ajax.js',
    'js/functions.js',
    'img/layout/main/about.jpg',
    'img/layout/main/my-account.jpg',
    'img/layout/main/home-presentation.jpg',
    'img/layout/main/login.jpg',
    'img/layout/main/my-account.jpg',
    'img/layout/main/register.jpg',
    'img/layout/main/register-computer.jpg',
    'img/layout/main/register-tech.jpg',
    'img/layout/main/register-type.jpg',
    'img/layout/main/change-data.jpg',
    'img/pages/system/myaccount/computers.png',
    'img/pages/system/myaccount/mbhostcloud.png',
    'favicon.png'
  ]

//durante la fase de instalación, generalmente se almacena en caché los activos estáticos
self.addEventListener('install', e => {
  e.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => {
        return cache.addAll(urlsToCache)
          .then(() => self.skipWaiting())
      })
      .catch(err => console.log('Falló registro de cache', err))
  )
})

//una vez que se instala el SW, se activa y busca los recursos para hacer que funcione sin conexión
self.addEventListener('activate', e => {
  const cacheWhitelist = [CACHE_NAME]

  e.waitUntil(
    caches.keys()
      .then(cacheNames => {
        return Promise.all(
          cacheNames.map(cacheName => {
            //Eliminamos lo que ya no se necesita en cache
            if (cacheWhitelist.indexOf(cacheName) === -1) {
              return caches.delete(cacheName)
            }
          })
        )
      })
      // Le indica al SW activar el cache actual
      .then(() => self.clients.claim())
  )
})

//cuando el navegador recupera una url
self.addEventListener('fetch', e => {
  //Responder ya sea con el objeto en caché o continuar y buscar la url real
  e.respondWith(
    caches.match(e.request)
      .then(res => {
        if (res) {
          //recuperar del cache
          return res
        }
        //recuperar de la petición a la url
        return fetch(e.request)
      })
  )
})
