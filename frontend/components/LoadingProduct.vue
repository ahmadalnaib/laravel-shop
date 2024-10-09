<template>
    <div class="container mx-auto p-4">
      <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:grid lg:max-w-7xl lg:grid-cols-2 lg:gap-x-8 lg:px-8">
        <!-- Product details skeleton -->
        <div class="lg:max-w-lg lg:self-end">
          <div class="mt-4">
            <div class="h-8 bg-gray-300 rounded w-3/4 mb-4"></div>
          </div>
          <section aria-labelledby="information-heading" class="mt-4">
            <div class="flex items-center">
              <div class="h-6 bg-gray-300 rounded w-1/4 mb-4"></div>
              <div class="ml-4 border-l border-gray-300 pl-4">
                <div class="flex items-center">
                  <div class="flex items-center">
                    <div class="h-5 w-5 bg-gray-300 rounded-full mr-1"></div>
                    <div class="h-5 w-5 bg-gray-300 rounded-full mr-1"></div>
                    <div class="h-5 w-5 bg-gray-300 rounded-full mr-1"></div>
                    <div class="h-5 w-5 bg-gray-300 rounded-full mr-1"></div>
                    <div class="h-5 w-5 bg-gray-300 rounded-full"></div>
                  </div>
                  <div class="ml-2 h-5 bg-gray-300 rounded w-1/4"></div>
                </div>
              </div>
            </div>
            <div class="mt-4 space-y-6">
              <div class="h-6 bg-gray-300 rounded w-full mb-2"></div>
              <div class="h-6 bg-gray-300 rounded w-full mb-2"></div>
              <div class="h-6 bg-gray-300 rounded w-full mb-2"></div>
            </div>
            <div class="mt-6 flex items-center">
              <div class="h-5 w-5 bg-gray-300 rounded-full"></div>
              <div class="ml-2 h-5 bg-gray-300 rounded w-1/4"></div>
            </div>
          </section>
        </div>
        <!-- Product image skeleton -->
        <div class="mt-10 lg:col-start-2 lg:row-span-2 lg:mt-0 lg:self-center">
          <div class="aspect-h-1 aspect-w-1 overflow-hidden rounded-lg bg-gray-200">
            <div class="h-full w-full bg-gray-300"></div>
          </div>
        </div>
        <!-- Product form skeleton -->
        <div class="mt-10 lg:col-start-1 lg:row-start-2 lg:max-w-lg lg:self-start">
          <section aria-labelledby="options-heading">
            <div class="sm:flex sm:justify-between">
              <fieldset>
                <legend class="block text-sm font-medium text-gray-700">Size</legend>
                <div class="mt-1 grid grid-cols-1 gap-4 sm:grid-cols-2">
                  <div class="ring-2 ring-indigo-500 relative block cursor-pointer rounded-lg border border-gray-300 p-8 focus:outline-none bg-gray-300"></div>
                  <div class="ring-2 ring-indigo-500 relative block cursor-pointer rounded-lg border border-gray-300 p-8 focus:outline-none bg-gray-300"></div>
                </div>
              </fieldset>
            </div>
            <div class="mt-4 flex justify-center">
              <div class="h-5 w-1/2 bg-gray-300 rounded"></div>
            </div>
            <div class="mt-10 flex justify-center">
              <div class="flex w-full items-center justify-center rounded-md border border-transparent bg-gray-300 px-8 py-6"></div>
            </div>
            <div class="mt-6 text-center">
              <div class="h-6 w-1/2 bg-gray-300 rounded mx-auto"></div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </template>
  
  <style scoped>
  .container {
    max-width: 1200px;
  }
  </style>