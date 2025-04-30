import Echo from "laravel-echo";

import Pusher from "pusher-js";
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: "pusher",
    key: "61a0a7f40696815835e8",
    cluster: "mt1",
    forceTLS: true,
});

console.log("App loaded");
