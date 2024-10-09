<template>
    <nav class="bg-gray-800 p-4">
      <div class="container mx-auto flex justify-between items-center">
        <div class="text-white text-lg font-semibold">Product Store</div>
        <div class="flex space-x-4">
          <button
            v-for="category in categories"
            :key="category"
            @click="filterByCategory(category)"
            class="text-white hover:bg-gray-700 px-3 py-2 rounded"
          >
            {{ category }}
          </button>
        </div>
      </div>
    </nav>
  </template>
  
  <script lang="ts" setup>

  
  const props = defineProps<{
    categories: string[];
  }>();
  
  const emit = defineEmits<{
    (e: 'filter', category: string): void;
  }>();
  
  const filterByCategory = (category: string) => {
    emit('filter', category);
  };
  </script>
  
