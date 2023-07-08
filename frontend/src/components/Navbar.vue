<script setup>
import { RouterLink } from 'vue-router'
</script>

<template>
  <nav class="bg-black">
    <div class="mx-auto px-4 sm:px-6 lg:px-8">
      <div class="flex items-center justify-between h-16">
        <div class="flex">
          <RouterLink to="/" class="px-3 py-2 text-white font-medium"> Laravel Task </RouterLink>
          <RouterLink to="/" class="px-3 py-2 text-gray-300 hover:text-white font-medium">
            All posts
          </RouterLink>
          <RouterLink
            to="/create-post"
            class="bg-white text-black hover:text-gray-700 px-3 py-2 font-medium rounded-md"
          >
            New Post
          </RouterLink>
        </div>
      </div>
    </div>
  </nav>
</template>
