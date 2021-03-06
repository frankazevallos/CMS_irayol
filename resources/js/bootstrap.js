window._ = require('lodash');

/**
 * We'll load jQuery and the Bootstrap jQuery plugin which provides support
 * for JavaScript based Bootstrap features such as modals and tabs. This
 * code may be modified to fit the specific needs of your application.
 */

try {
    window.Popper = require('popper.js').default;
    window.$ = window.jQuery = require('jquery');

    require('bootstrap');

    const Swal = window.Swal = require('sweetalert2');
    require ('../assets/AdminLTE-3.1.0/build/js/AdminLTE');
    require('../assets/AdminLTE-3.1.0/plugins/select2/js/select2.full');
    require('../assets/AdminLTE-3.1.0/plugins/summernote/summernote-bs4');

    require('../assets/AdminLTE-3.1.0/plugins/datatables/jquery.dataTables');
    require('../assets/AdminLTE-3.1.0/plugins/datatables-bs4/js/dataTables.bootstrap4');
    require('../assets/AdminLTE-3.1.0/plugins/datatables-buttons/js/buttons.bootstrap4');
    require('../assets/AdminLTE-3.1.0/plugins/datatables-responsive/js/responsive.bootstrap4');


    window.moment = require('moment');
    window.moment.locale('es');

    window.datetimepicker = require('../assets/AdminLTE-3.1.0/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4');
    require('../assets/AdminLTE-3.1.0/plugins/daterangepicker/daterangepicker')
    window.nestable = require('jquery-nestable');

} catch (e) {}



/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require('axios');

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

// import Echo from 'laravel-echo';

// window.Pusher = require('pusher-js');

// window.Echo = new Echo({
//     broadcaster: 'pusher',
//     key: process.env.MIX_PUSHER_APP_KEY,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER,
//     forceTLS: true
// });
