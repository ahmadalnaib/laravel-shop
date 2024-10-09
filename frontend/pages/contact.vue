
<template>
  <div class="bg-white py-24 sm:py-32">
    <div class="mx-auto max-w-7xl px-6 lg:px-8">
      <div class="mx-auto max-w-2xl lg:mx-0">
        <h2 class="text-3xl font-bold tracking-tight text-gray-900"  v-html="content?.content"></h2>
      </div>
      <div class="mx-auto mt-16 grid max-w-2xl grid-cols-1 gap-8 text-base leading-7 sm:grid-cols-2 sm:gap-y-16 lg:mx-0 lg:max-w-none lg:grid-cols-4">
        <div>
          <h3 class="border-l border-indigo-600 pl-6 font-semibold text-gray-900">Germany</h3>
          <address class="border-l border-gray-200 pl-6 pt-2 not-italic text-gray-600">
            <p>{{ content?.address }}</p>
            <p>{{ content?.phone }}</p>
            <p>{{ content?.email }}</p>
         
          </address>
        </div>
    
     
  
      </div>
    </div>
  </div>
</template>


<script setup lang="ts">
import { onMounted } from 'vue';

const { content, fetchContent } = useContent();

onMounted(() => {
  fetchContent('contact');
});
</script>