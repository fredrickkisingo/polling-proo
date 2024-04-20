<script setup>
import { Link } from "@inertiajs/vue3";
import { useRouter } from "vue-router";

const router = useRouter();

function redirectToQuestions() {

    router.push({ name: "Questions" });
}
function redirectToHome() {

    router.push({ name: "Home" });
}
</script>
<template>
    <header class="d-flex justify-content-center py-3">
        <ul class="nav nav-pills">
            <li class="nav-link">
                <a @click="redirectToHome" class="nav-link">Home</a>    </li>
            <li class="nav-link"><Link href="" class="nav-link">Quiz</Link></li>
            <li class="nav-link">
                <a @click="redirectToQuestions" class="nav-link">Questions</a>
            </li>
        </ul>
    </header>
</template>

<style scoped>
/* Add styles for nav links */
.nav-link a {
    /* Add any other styles as needed */
    color: inherit; /* Inherit color from parent */
    text-decoration: none; /* Remove default underline */
}

/* Add hover styles */
.nav-link a:hover {
    cursor: pointer;
    /* Add any other hover styles as needed */
}
</style>

