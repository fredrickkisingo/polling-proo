<template>
    <router-view v-slot="{ Component, route }">
        <div :key="route.name">
            <Component :is="Component" />
        </div>
    </router-view>
</template>
<style>
/* route transitions */
.route-enter-from {
    opacity: 0;
    transform: translateX(100px);
}
.route-enter-active {
    transition: all 0.3s ease-out;
}
.route-leave-to {
    opacity: 0;
    transform: translateX(-100px);
}
.route-enter-active {
    transition: all 0.3s ease-in;
}

/* fade-slide out-in */
.fade-slide-enter-active,
.fade-slide-leave-active {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    transition: all 0.5s ease-out;
}

.fade-slide-enter-from {
    opacity: 0;
    transform: translateX(100%);
}

.fade-slide-leave-to {
    opacity: 0;
    transform: translateX(-100%);
}

.fade-slide-enter-to,
.fade-slide-leave-from {
    opacity: 1;
    transform: translateX(0);
}

/* fade scale - adminlayout */
.fade-scale-enter-active,
.fade-scale-leave-active {
    transition: opacity 0.5s ease-in-out, transform 0.5s ease-in-out;
}

.fade-scale-enter-from,
.fade-scale-leave-to {
    opacity: 0;
    transform: scale(0.95);
}

.fade-scale-enter-to,
.fade-scale-leave-from {
    opacity: 1;
    transform: scale(1);
}

/* custom */
.custom-transition-enter-active,
.custom-transition-leave-active {
    animation-duration: 0.5s;
    animation-fill-mode: both;
}

.custom-transition-enter-from,
.custom-transition-leave-to {
    animation-name: slide-in-right;
}

.custom-transition-enter-to,
.custom-transition-leave-from {
    animation-name: slide-out-left;
}

/* fade out in */
.fade-enter-active,
.fade-leave-active {
    transition: opacity 0.5s ease-out;
}

.fade-enter-from,
.fade-leave-to {
    opacity: 0;
}

.fade-enter-to,
.fade-leave-from {
    opacity: 1;
}

@keyframes slide-in-right {
    from {
        transform: translateX(100%);
    }
    to {
        transform: translateX(0);
    }
}

@keyframes slide-out-left {
    from {
        transform: translateX(0);
    }
    to {
        transform: translateX(-100%);
    }
}
</style>
<script>
import { defineComponent, onMounted, computed, ref, watch } from "vue";
import { useStore } from "vuex";
import { useRoute } from "vue-router";

export default defineComponent({
    name: "App",

    components: {

    },

    setup() {
        const store = useStore();
        const route = useRoute();
    }
})
</script>
