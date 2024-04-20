<script setup>
import Layout from "../Shared/Layout.vue";
import NewQuestionModal from "../Shared/NewQuestionModal.vue";
import {ref} from "vue";
import {usePage} from "@inertiajs/vue3";
import { useStore } from "vuex";
import {router} from "@inertiajs/vue3";
import {computed} from "vue";
const page = usePage();

const showNewQuestionModal = ref(false);
const createdQuestion = ref(null);
const newAnswers = ref([]);
const selectedAnswer = ref(null);
const questions_module = "questions";

const store = useStore();

// load all companies on create component
let payload = {  };
store.dispatch(`${questions_module}/fetchQuestions`, payload);

let answerId=1;
function createQuestion() {
    showNewQuestionModal.value = true;
}
function closeModal() {
    showNewQuestionModal.value = false;
}
function addNewAnswer() {
    const newAnswer = {
        id:answerId++,
        answer:'',
        correct_answer:false
    }

    newAnswers.value.push(newAnswer)
}

function answerCount(){
    console.log(newAnswers.value.length)
    if (newAnswers.value.length < 4) {
        alert('Four answers required to submit');
        return false;
    } else {
        let filledAnswers = newAnswers.value.filter(answer => answer.answer.trim() !== '');
        if (filledAnswers.length < 4) {
            alert('Fill all answers to submit');
            return false;
        }
    }
    return false;
}


function validateAnswers(){
    for(const  answer of newAnswers.value){
        if(answer.answer.trim() === ''){
            return false;
        }
    }
    return true;
}

function submitQuestion(){
    if(!createdQuestion.value){
        alert('Please enter question');
        return false;
    }
    if(!validateAnswers() && !answerCount()){
        alert('Please fill all inputs before submitting');
        return false;
    }


    const questions_payload= {
        question:createdQuestion.value,
        answers:newAnswers.value
    }
    store.dispatch(`${questions_module}/postQuestions`, questions_payload)
        .then((res) => {
            let payload = { };
            store.dispatch(`${questions_module}/fetchQuestions`, payload);
        });


    router.on('success', (event) => {
        createdQuestion.value = null;
        newAnswers.value = [];
        showNewQuestionModal.value = false;
    })

}
function handleSubmitCorrectAnswer(id){
    selectedAnswer.value = id;
    newAnswers.value.forEach((answer)=>{
        if(answer.id === id){
            answer.correct_answer = true;
        }else{
            answer.correct_answer = false;
        }
    })
}
const props = defineProps({
    questions: Object,
    errors: Object
});


// Fetch teams data from Vuex store
const questions = computed(() => store.getters[`${questions_module}/questions`]);

// Define other variables and functions as needed
defineExpose({
    questions // Expose questions variable to the frontend component
});
</script>
<template>
    <Layout>
        <button class="btn btn-primary" @click="createQuestion">Add</button>
        <table class="table table-striped">
            <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Question</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="(question,index) in questions">
                <th scope="row">{{index+1}}</th>
                <td>{{question.question}}</td>
                <td><button class="btn btn-primary" @click="">Edit</button>
                <button class="btn btn-danger" @click="">Delete</button>
                </td>
            </tr>
            </tbody>
        </table>
        <Teleport to="body" >
            <NewQuestionModal :show="showNewQuestionModal" @close="closeModal"
            >
                <template #header>
                    <h5>Add new Question</h5>
                </template>

                <template #body>
                    <form>
                        <div class="mb-3">
                            <label for="new-question" class="form-label">Question</label>
                            <input type="text" class="form-control" v-model="createdQuestion" id="created_question" >
                        </div>
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Answers</th>
                                <th scope="col">Correct</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr v-for="(answer, index) in newAnswers">
                                <th scope="row">{{ answer.id }}</th>
                                <td> <input type="text" class="form-control" v-model="answer.answer" id="answer" aria-describedby="answer"></td>
                                <td><input type="radio" name="correct" :checked="answer.correct ==1" :value="answer.id" @change="handleSubmitCorrectAnswer(answer.id)" class="form-check-input"></td>
                            </tr>
                            </tbody>
                        </table>
                    </form>
                </template>
                <template #footer>
                    <!-- HTML -->
                    <span v-if="newAnswers.length < 4" @click="addNewAnswer" class="fa-icon plus-icon">
                            <i class="fa fa-plus"></i>
                        </span>&nbsp;&nbsp;
                    <button class="btn btn-danger" @click="closeModal">Close</button>
                    &nbsp;
                   <button class="btn btn-primary" v-if="newAnswers.length > 3" @click="submitQuestion">Save</button>
                </template>

            </NewQuestionModal>
        </Teleport>
    </Layout>
</template>
<style scoped>
/* CSS */
.plus-icon {
    cursor: pointer;
}
</style>
