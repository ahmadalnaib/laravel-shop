<script setup>
import { h, Fragment, render, onMounted } from 'vue';
import { autocomplete } from '@algolia/autocomplete-js';
import { useRouter } from 'vue-router';
import {
  meilisearchAutocompleteClient,
  getMeilisearchResults,
} from '@meilisearch/autocomplete-client';

// Initialize MeiliSearch client
const client = meilisearchAutocompleteClient({
  url: 'http://localhost:7700',
  apiKey: 'masterkey',
});

// Get the Vue Router instance for programmatic navigation
const router = useRouter();

onMounted(() => {
  autocomplete({
    container: '#search',
    placeholder: 'What are you looking for?',
    autoFocus: true,
    getSources() {
      return [
        {
          sourceId: 'products',
          getItems({ query }) {
            return getMeilisearchResults({
              client,
              searchClient: client,
              queries: [
                {
                  indexName: 'products',
                  query: query,
                },
              ],
            });
          },
          templates: {
            header({ html }) {
              return html`<span class="aa-SourceHeaderTitle">Products</span>
              <div class="aa-SourceHeaderLine"></div>`;
            },
            item({ item, components }) {
              return h(
                'div',
                {
                  class: 'flex items-center space-x-2 cursor-pointer',
                  onClick: (event) => {
                    event.preventDefault(); 
                    if (item.url) {
                      router.push(item.url); 
                    }
                  },
                },
                [
                  h('img', {
                    src: item.image,
                    class: 'w-20 h-20 rounded-full',
                  }),
                  h('span', null, [
                    h(components.Snippet, { hit: item, attribute: 'title' }),
                  ]),
                ]
              );
            },
          },
        },
    
      ];
    },
    renderer: { createElement: h, Fragment, render },
  });
});
</script>

<template>
  <div id="search"></div>
</template>
