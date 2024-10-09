<script setup lang="ts">
const { isAuthenticated, logout } = useSanctumAuth();
  import { ShoppingCartIcon } from '@heroicons/vue/20/solid'
import { useCart } from '@/composables/useCart'; // Adjust the path as necessary

const { cart } = useCart();

const cartItemCount = computed(() => {
  return cart.value.reduce((sum, item) => sum + item.quantity, 0);
});

const user = useSanctumUser<User>();

const logoutFun = async () => {
  await logout();
  await navigateTo('/');
};
</script>

<template>
  <div
    class="p-6 flex items-center justify-between shadow-md bg-gray-900 text-white mb-10"
  >
    <div class="flex items-center space-x-6">
      <!-- Logo -->
      <div class="ml-4 flex lg:ml-0">
        <nuxt-link to="/">
          <span class="sr-only">Your Company</span>
          <img
            class="h-8 w-auto"
            src="https://tailwindui.com/img/logos/mark.svg?color=indigo&shade=600"
            alt=""
          />
        </nuxt-link>
      </div>

    </div>
    <Search class="w-1/2"/>
    <div class="flex items-center space-x-6" v-if="!isAuthenticated">
     
      <nuxt-link to="/cart" class="relative">
        <ShoppingCartIcon class="mr-2 h-6 w-6 flex-shrink-0 text-white group-hover:text-gray-500" aria-hidden="true" />
        <span v-if="cartItemCount > 0" class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">{{ cartItemCount }}</span>
      </nuxt-link>
      <nuxt-link to="/auth/login">Login</nuxt-link>
      <nuxt-link to="/auth/register">Register</nuxt-link>
      <nuxt-link to="/about">About</nuxt-link>
      <nuxt-link to="/contact">Contact</nuxt-link>
    </div>
    <div class="flex items-center space-x-6" v-if="isAuthenticated">
      <nuxt-link to="/cart" class="relative">
        <ShoppingCartIcon class="mr-2 h-6 w-6 flex-shrink-0 text-white group-hover:text-gray-500" aria-hidden="true" />
        <span v-if="cartItemCount > 0" class="absolute top-0 right-0 inline-flex items-center justify-center px-2 py-1 text-xs font-bold leading-none text-red-100 bg-red-600 rounded-full">{{ cartItemCount }}</span>
      </nuxt-link>
      <div class="font-semibold">
        {{ user?.name }}
      </div>
      <nuxt-link to="/dashboard">Dashboard</nuxt-link>
      <nuxt-link to="/order">Order</nuxt-link>
      <nuxt-link to="/account">Account</nuxt-link>
      
      <button @click="logoutFun">Sign out</button>
    </div>
  </div>
</template>
