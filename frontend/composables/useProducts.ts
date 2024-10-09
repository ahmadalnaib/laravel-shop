

export const useProducts = () => {
  const sanctumFetch = useSanctumClient();


  async function fetchProducts(): Promise<any> {

      return await sanctumFetch('api/products', {
        method: 'GET',
        headers: {
          'Content-Type': 'application/json',
        },
      });

  }

  
  async function fetchProduct(productId: number): Promise<void> {

    return await sanctumFetch(`api/products/${productId}`, {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json',
      },
    });
  
  }

  return {
    fetchProducts,
    fetchProduct,
  };
};