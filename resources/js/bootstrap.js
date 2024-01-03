window._ = require("lodash");

/**
 * We'll load the axios HTTP library which allows us to easily issue requests
 * to our Laravel back-end. This library automatically handles sending the
 * CSRF token as a header based on the value of the "XSRF" token cookie.
 */

window.axios = require("axios");

window.axios.defaults.headers.common["X-Requested-With"] = "XMLHttpRequest";

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allows your team to easily build robust real-time web applications.
 */

import Echo from "laravel-echo";

window.Pusher = require("pusher-js");


// Pusher Badge and Queue 1
// awan dati dagituy
let wsHost = `ws-${process.env.MIX_PUSHER_APP_CLUSTER}.pusher.com`;
let wsPort = 80;
let wssPort = 443;
let forceTLS = process.env.MIX_PUSHER_SCHEME === "https";
let encrypted = process.env.MIX_PUSHER_SCHEME === "https";

window.Echo = new Echo({
    broadcaster: "pusher",
    key: process.env.MIX_PUSHER_APP_KEY,
    cluster: process.env.MIX_PUSHER_APP_CLUSTER,

    // true dati detuy
    forceTLS: forceTLS,

    encrypted: encrypted,
    wsHost: wsHost,
    wsPort: wsPort,
    wssPort: wssPort,
    enabledTransports: ["ws", "wss"],
    disableStats: true,
});

// Pusher Badge and Queue 2
// let wsHost_2 = `ws-${process.env.MIX_PUSHER_APP_CLUSTER_2}.pusher.com`;
// let wsPort_2 = 80;
// let wssPort_2 = 443;
// let forceTLS_2 = process.env.MIX_PUSHER_SCHEME_2 === "https";
// let encrypted_2 = process.env.MIX_PUSHER_SCHEME_2 === "https";

// window.Echo_2 = new Echo({
//     broadcaster: "pusher",
//     key: process.env.MIX_PUSHER_APP_KEY_2,
//     cluster: process.env.MIX_PUSHER_APP_CLUSTER_2,

//     forceTLS: forceTLS_2,

//     encrypted: encrypted_2,
//     wsHost: wsHost_2,
//     wsPort: wsPort_2,
//     wssPort: wssPort_2,
//     enabledTransports: ["ws", "wss"],
//     disableStats: true,
// });

window.Echo.channel("users").listen(".App\\Events\\UserChanged", (e) => {
    console.log("UserChanged event received");
    window.location.reload();
});

