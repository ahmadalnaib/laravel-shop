<template>
    <div class="container mx-auto p-4">
      <h1 class="text-2xl font-bold mb-4">Shopping Cart</h1>
      <div v-if="cart.length > 0">
        <div v-for="item in cart" :key="item.product.id" class="flex items-center justify-between mb-4">
          <div class="flex items-center">
            <img :src="item.product.image" :alt="item.product.title" class="h-16 w-16 object-cover mr-4" />
            <div>
              <h2 class="text-lg font-semibold">{{ item.product.title }}</h2>
              <p class="text-gray-600">{{ currency(item.product.price) }} x {{ item.quantity }}</p>
            </div>
          </div>
          <button @click="removeFromCart(item.product.id)" class="text-red-500 hover:text-red-700">Remove</button>
        </div>
        <div class="mt-4">
          <p class="text-lg font-semibold">Total: {{ currency(total) }}</p>
          <button @click="clearCart" class="mt-2 bg-red-500 text-white px-4 py-2 rounded">Clear Cart</button>
        </div>
      </div>
      <div v-else>
        <p>Your cart is empty.</p>
      </div>
    </div>
  </template>
  
  <script lang="ts" setup>
  import { computed } from 'vue';
  import { useCart } from '@/composables/useCart'; // Adjust the path as necessary
  
  const { cart, removeFromCart, clearCart } = useCart();
  
  const total = computed(() => {
    return cart.value.reduce((sum, item) => sum + item.product.price * item.quantity, 0);
  });
  
  // Define the currency filter
  const currency = (value: number) => {
    return new Intl.NumberFormat('en-US', {
      style: 'currency',
      currency: 'USD'
    }).format(value);
  };
  </script>
  
  <style scoped>
  .container {
    max-width: 800px;
  }
  </style>