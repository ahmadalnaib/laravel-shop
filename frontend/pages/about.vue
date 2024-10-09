<template>
  <div :style="{ backgroundColor: content?.background_color, color: content?.text_color }" class="flex flex-col items-center justify-center min-h-screen text-center relative">
    <h1 class="z-10 text-3xl mb-5">About Us</h1>
    <div v-html="content?.content" class="z-10 text-2xl mx-auto w-2/4  leading-normal"></div>
    <div v-if="content?.image" class="absolute inset-0 z-0">
      <img class="w-full h-full object-cover opacity-50 rounded-sm" :src="content.image" alt="About Us Image">
    </div>
  </div>
</template>
<script setup lang="ts">
import { onMounted } from 'vue';

const { content, fetchContent } = useContent();

onMounted(() => {
  fetchContent('about');
});
</script>