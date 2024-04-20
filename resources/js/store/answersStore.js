import axios from "axios";

export default {

    namespaced: true,
    state: {
        answers: [],
        answer: {},

    },
    getters: {

        answers(state) {
            return state.answers;
        },
        answer(state) {
            return state.answer;
        }

    },

    mutations: {

        SET_QUESTIONS(state, answers) {
            return state.answers = answers
        },

        SET_QUESTION(state,answer) {
            return state.answer = answer
        }

    },

    actions: {

        async fetchAnswers({ commit }, params) {

            await axios.get('/api/v1/answers', { params: params })
                .then(res => {
                    // console.log(res.data.data);
                    commit('SET_QUESTIONS', res.data);
                }).catch(err => {
                    return Promise.reject(err);
                })

        },


        async fetchAnswer({ commit }, params) {

            const answer_id = params.answer_id;

            await axios.get(`/api/v1/answers/${answer_id}`)
                .then(res => {
                    // console.log("fetchBranch store == ", res);
                    if (res.statusText === 'OK') {
                        commit('SET_QUESTION', res.data);
                    }
                }).catch(err => {
                    return Promise.reject(err);
                })

        },


    }

}
