<template>
  <div class="container mx-auto p-4">
    <div v-if="product" class="bg-white rounded-lg shadow-lg overflow-hidden transform transition-transform hover:scale-105 flex flex-col h-full">
      <div class="bg-white">
        <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:grid lg:max-w-7xl lg:grid-cols-2 lg:gap-x-8 lg:px-8">
          <!-- Product details -->
          <div class="lg:max-w-lg lg:self-end">
            <div class="mt-4">
              <h1 class="text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">{{ product.title }}</h1>
            </div>
            <section aria-labelledby="information-heading" class="mt-4">
              <h2 id="information-heading" class="sr-only">Product information</h2>
              <div class="flex items-center">
                <p class="text-lg text-gray-900 sm:text-xl">{{ currency(product.price) }}</p>
                <!-- <div class="ml-4 border-l border-gray-300 pl-4" v-if="!canBuy">
                  <h2 class="sr-only">Reviews</h2>
                  <div class="flex items-center">
                    <div>
                      <div class="flex items-center">
                        <StarIcon v-for="rating in [0, 1, 2, 3, 4]" :key="rating" :class="[product.rating.count > rating ? 'text-yellow-400' : 'text-gray-300', 'h-5 w-5 flex-shrink-0']" aria-hidden="true" />
                      </div>
                      <p class="sr-only">{{ product.rating.count }} out of 5 stars</p>
                    </div>
                    <p class="ml-2 text-sm text-gray-500">{{ product.rating.count }} reviews</p>
                  </div>
                </div> -->
              </div>
              <div class="mt-4 space-y-6">
                <p class="text-base text-gray-500">{{ product.description }}</p>
              </div>
              <div class="mt-6 flex items-center">
                <CheckIcon class="h-5 w-5 flex-shrink-0 text-green-500" aria-hidden="true" />
                <p class="ml-2 text-sm text-gray-500">In stock and ready to ship</p>
              </div>
            </section>
          </div>
          <!-- Product image -->
          <div class="mt-10 lg:col-start-2 lg:row-span-2 lg:mt-0 lg:self-center">
            <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-200">
              <img :src="product.image" :alt="product.title" class="h-full w-full object-cover object-center" />
            </div>
          </div>
          <!-- Product form -->
          <div class="mt-10 lg:col-start-1 lg:row-start-2 lg:max-w-lg lg:self-start">
            <section aria-labelledby="options-heading">
              <h2 id="options-heading" class="sr-only">Product options</h2>
              <form>
                <div class="sm:flex sm:justify-between">
                  <!-- Size selector -->
                  <fieldset>
                    <legend class="block text-sm font-medium text-gray-700">Size</legend>
                    <RadioGroup class="mt-1 grid grid-cols-1 gap-4 sm:grid-cols-2">
                      <RadioGroupOption as="template">
                        <div class="ring-2 ring-indigo-500 relative block cursor-pointer rounded-lg border border-gray-300 p-4 focus:outline-none bg-indigo-500">
                          <p class="text-base font-medium text-white">S</p>
                          <p class="mt-1 text-sm text-gray-500"></p>
                        </div>
                      </RadioGroupOption>
                      <RadioGroupOption as="template">
                        <div class="ring-2 ring-indigo-500 relative block cursor-pointer rounded-lg border border-gray-300 p-4 focus:outline-none">
                          <p class="text-base font-medium text-gray-900">M</p>
                          <p class="mt-1 text-sm text-gray-500"></p>
                        </div>
                      </RadioGroupOption>
                    </RadioGroup>
                  </fieldset>
                </div>
                <div class="mt-4">
                  <a href="#" class="group inline-flex text-sm text-gray-500 hover:text-gray-700">
                    <span>What size should I buy?</span>
                    <QuestionMarkCircleIcon class="ml-2 h-5 w-5 flex-shrink-0 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                  </a>
                </div>
                <div class="mt-10">
              
                  <button @click.prevent="addToCart(product)" :disabled="!canBuy" type="submit"
                  :class="['bg-indigo-600', { 'bg-gray-600': !canBuy }]" class="flex w-full items-center justify-center rounded-md border border-transparent bg-indigo-600 px-8 py-3 text-base font-medium text-white focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-50">
                    <ShoppingCartIcon class="mr-2 h-6 w-6 flex-shrink-0 text-white group-hover:text-gray-500" aria-hidden="true" />
                    Add to bag
                  </button>
                  <div v-if="!canBuy" class="text-red-500 mt-2">Buying is currently disabled</div> <!-- Display message if buying is disabled -->
                </div>
                <div class="mt-6 text-center">
                  <a href="#" class="group inline-flex text-base font-medium">
                    <ShieldCheckIcon class="mr-2 h-6 w-6 flex-shrink-0 text-gray-400 group-hover:text-gray-500" aria-hidden="true" />
                    <span class="text-gray-500 hover:text-gray-700">Lifetime Guarantee</span>
                  </a>
                </div>
              </form>
            </section>
          </div>
        </div>
      </div>
    </div>
    <div v-else>
      <LoadingProduct v-for="i in 1" :key="i" />
    </div>
  </div>
</template>

<script lang="ts" setup>
import { ref, onMounted } from 'vue';
import { useRoute } from 'vue-router';
import { useProducts } from '@/composables/useProducts'; // Adjust the path as necessary
import { useCart } from '@/composables/useCart'; // Import the useCart composable
import { CheckIcon, QuestionMarkCircleIcon, StarIcon, ShieldCheckIcon, ShoppingCartIcon } from '@heroicons/vue/20/solid'; // Import the ShoppingCart icon

const product = ref<Product | null>(null);
const canBuy = ref(true); // Add canBuy flag
const { fetchProduct } = useProducts();
const { addToCart } = useCart(); // Destructure addToCart from useCart
const route = useRoute();

onMounted(async () => {
  const productId = Number(route.params.id); // Fetch product based on dynamic route parameter
  const response = await fetchProduct(productId);
  product.value = response.product;
  canBuy.value = response.can_buy; // Set canBuy flag
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
  max-width: 1200px;
}
</style>