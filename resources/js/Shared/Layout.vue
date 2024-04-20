<script setup>
import Footer from '@/Shared/Footer.vue';
import Header from '@/Shared/Header.vue';
</script>
<template>
    <div class="container">
        <Header />
        <slot />
        <Footer />
    </div>
</template>
