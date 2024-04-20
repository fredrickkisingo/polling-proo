import { createApp } from "vue";
import router from "./router";
import store from "./store/index"; // Import your Vuex store

import App from "./App.vue";

const app = createApp(App); // Create the Vue app instance

// Use the router and Vuex store in the Vue app
app.use(router);
app.use(store);

// Expose the Vuex store globally (optional)
window.store = store;

// Mount the Vue app to the #app element in the DOM
app.mount("#app");

