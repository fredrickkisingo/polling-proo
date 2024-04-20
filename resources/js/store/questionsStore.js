import axios from "axios";

export default {

    namespaced: true,
    state: {
        questions: [],
        question: {},

    },
    getters: {

        questions(state) {
            return state.questions;
        },
        question(state) {
            return state.question;
        }

    },

    mutations: {

        SET_QUESTIONS(state, questions) {
            return state.questions = questions
        },

        SET_QUESTION(state,question) {
            return state.question = question
        }

    },

    actions: {

        async fetchQuestions({ commit }, params) {

            await axios.get('/api/v1/questions', { params: params })
                .then(res => {
                    // console.log(res.data.data);
                    commit('SET_QUESTIONS', res.data);
                }).catch(err => {
                    return Promise.reject(err);
                })

        },


        async fetchQuestion({ commit }, params) {

            const question_id = params.question_id;

            await axios.get(`/api/v1/questions/${question_id}`)
                .then(res => {
                    // console.log("fetchBranch store == ", res);
                    if (res.statusText === 'OK') {
                        commit('SET_QUESTION', res.data);
                    }
                }).catch(err => {
                    return Promise.reject(err);
                })

        },

        async postQuestions({ commit }, params) {

            await axios.post('/api/v1/questions', params)
                .then(res => {
                    // console.log(res.data.data);
                    commit('SET_QUESTIONS', res.data);
                }).catch(err => {
                    return Promise.reject(err);
                })
        }


    }

}
