import  { createStore } from 'vuex';
import VuexPersistence from "vuex-persist";
import { EncryptStorage } from "encrypt-storage";
import * as getters from "./getters";
import * as actions from "./actions";
import * as mutations from "./mutations";
import questions from "./questionsStore.js";
import answers from "./answersStore.js";
const key = "kKPKUvc1Olb2Z9R1tLydqPfx0Z5W+nzbZx9UYmxl6q85PAQsX4bC8wHyw7SLnwGX";
const encryptStorage = new EncryptStorage(key, {
    storageType: "sessionStorage",
});

const vuexLocal = new VuexPersistence({
    /* storage: window.sessionStorage, */
    storage: encryptStorage,
});

const store = createStore({
    // shared state data - used globally
    state: {
        loadingStatus: false,
        currentPageTitle: "",
        successMessage: null,
        error: null,
    },

    plugins: [vuexLocal.plugin],

    // shared getters, actions and mutations - used globally
    getters,
    actions,
    mutations,

    // module state, getters, actions and mutations
    modules: {
        questions,
        answers
    }
});

export default store;
