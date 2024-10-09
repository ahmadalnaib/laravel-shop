<script setup lang="ts">
const products = ref<Product[]>([]);
const searchQuery = ref('');
const loading = ref(true);
const canBuy = ref(true); // Add canBuy flag


const { fetchProducts } = useProducts();
const selectedCategory = ref<string | null>(null);
const isDescriptionExpanded = ref<{ [key: number]: boolean }>({});

onMounted(async () => {
  try {
    const response = await fetchProducts();
    products.value = response.products;
    canBuy.value = response.can_buy; // Set canBuy flag
    console.log('Products:', products.value); // Log the products to verify
  } catch (error) {
    console.error('Error fetching products:', error);
  } finally {
    loading.value = false;
  }
});

// Computed property to filter products based on the search query
const filteredProducts = computed(() => {
  return products.value.filter((product) => {
    const matchesCategory = selectedCategory.value
      ? product.category === selectedCategory.value
      : true;
    const matchesSearchQuery = product.title
      .toLowerCase()
      .includes(searchQuery.value.toLowerCase());
    return matchesCategory && matchesSearchQuery;
  });
});

const filterProducts = (category: string) => {
  selectedCategory.value = category;
};

// Define the currency filter
const currency = (value: number) => {
  return new Intl.NumberFormat('en-US', {
    style: 'currency',
    currency: 'USD',
  }).format(value);
};

const categories = computed(() => {
  const allCategories = products.value.map((product) => product.category);
  return Array.from(new Set(allCategories));
});

const truncatedDescription = (description: string) => {
  return description.length > 100
    ? description.substring(0, 100) + '...'
    : description;
};

// Function to toggle the description expansion
const toggleDescription = (id: number) => {
  isDescriptionExpanded.value[id] = !isDescriptionExpanded.value[id];
};
</script>

<template>
  <div>
    <FilterCategory :categories="categories" @filter="filterProducts" />
    <div class="container mx-auto p-4">
      <div class="mb-5">
        <input
          v-model="searchQuery"
          placeholder="Search products..."
          class="w-full p-2 border border-gray-300 rounded"
        />
      </div>

      <div v-if="loading" class="flex flex-wrap justify-center gap-4">
        <LoadingCard v-for="i in 16" :key="i" />
      </div>
      <div v-else class="flex flex-wrap justify-center gap-4">
        <div
          v-for="product in filteredProducts"
          :key="product.id"
          class="p-4 w-full sm:w-1/2 md:w-1/3 lg:w-1/4 xl:w-1/5"
        >
          <nuxt-link
            :to="{ name: 'products-id', params: { id: product.id } }"
            class="block"
          >
            <div
              class="bg-white rounded-lg shadow-lg overflow-hidden transform transition-transform hover:scale-105 flex flex-col h-full"
            >
              <div class="w-full h-48 overflow-hidden rounded-t-lg bg-gray-200">
                <img
                  :src="product.image"
                  :alt="product.title"
                  class="h-full w-full object-cover object-center"
                />
              </div>
              <div class="p-4 flex-grow flex flex-col">
                <h3 class="text-lg font-semibold text-gray-900">
                  {{ product.title }}
                </h3>
                <p class="text-gray-600 mt-2 flex-grow">
                  {{
                    isDescriptionExpanded[product.id!]
                      ? product.description
                      : truncatedDescription(product.description)
                  }}
                  <span
                    v-if="product.description.length > 100"
                    @click="toggleDescription(product.id!)"
                    class="text-blue-500 cursor-pointer"
                  >
                    {{
                      isDescriptionExpanded[product.id!]
                        ? 'Read less'
                        : 'Read more'
                    }}
                  </span>
                </p>

                <p class="text-gray-800 font-bold mt-4">
                  {{ currency(product.price) }}
                </p>
                <!-- <div v-if="!canBuy">
                  <p class="text-gray-600 mt-2">
                    Category: {{ product.category }}
                  </p>
                  <p class="text-gray-600 mt-2">
                    Rating: {{ product.rating.rate }} ({{
                      product.rating.count
                    }}
                    reviews)
                  </p>
                </div> -->
                <div v-if="!canBuy" class="text-red-500 mt-2 text-center">
                  Buying is currently disabled
                </div>
                <!-- Display message if buying is disabled -->
              </div>
            </div>
          </nuxt-link>
        </div>
      </div>
    </div>
  </div>
</template>
