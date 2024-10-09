<script setup lang="ts">


const searchQuery = ref('');
const emit = defineEmits(['update:searchQuery']);

const updateSearchQuery = () => {
  emit('update:searchQuery', searchQuery.value);
};
</script>

<template>
  <form @submit.prevent="updateSearchQuery">
    <div class="flex items-center justify-center">
      <input
        type="text"
        v-model="searchQuery"
        @input="updateSearchQuery"
        class="w-full p-2 border border-gray-300 rounded-l-md"
        placeholder="Search products..."
      />
    </div>
  </form>
</template>