import { ref } from 'vue';
import axios from 'axios';


const API_URL = 'http://backend.test/api';

export const useContent = () => {
  const content = ref<Content | null>(null);

  async function fetchContent(page: string): Promise<void> {
    try {
      const response = await axios.get(`${API_URL}/content/${page}`);
      content.value = response.data;

      // Prepend the base URL to the image path
      if (content.value && content.value.image) {
        content.value.image = `http://backend.test/storage/${content.value.image}`;
      }
    } catch (error) {
      console.error('Error loading content:', error);
    }
  }

  return {
    content,
    fetchContent,
  };
};