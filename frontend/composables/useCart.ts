import { ref } from 'vue';

interface CartItem {
  product: Product;
  quantity: number;
}

const cart = ref<CartItem[]>([]);

export function useCart() {
  const addToCart = (product: Product) => {
    const existingItem = cart.value.find(item => item.product.id === product.id);
    if (existingItem) {
      existingItem.quantity += 1;
    } else {
      cart.value.push({ product, quantity: 1 });
    }
  };

  const removeFromCart = (productId: number) => {
    cart.value = cart.value.filter(item => item.product.id !== productId);
  };

  const clearCart = () => {
    cart.value = [];
  };

  return {
    cart,
    addToCart,
    removeFromCart,
    clearCart,
  };
}