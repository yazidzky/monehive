/**
 * Kami memuat pustaka axios library yang memungkinkan kami untuk dengan mudah mengeluarkan permintaan
 * ke back-end Laravel kami. Pustaka ini secara otomatis menangani pengiriman token CSRF
 * sebagai header berdasarkan nilai cookie "XSRF" token.
 */

import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';
