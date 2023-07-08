<script setup>
import { onMounted } from 'vue'
import { usePostStore } from '../../stores/posts'
import { storeToRefs } from 'pinia'
import { RouterLink } from 'vue-router'

const store = usePostStore()
const { fetchAllPosts, deletePost } = store
const { posts } = storeToRefs(store)
onMounted(async () => {
  await fetchAllPosts()
})
const handleDeletePost = async (postId) => {
  if (confirm('Are you sure you want to delete this post')) {
    await deletePost(postId)
  }
}
const imagePath = (name) => `http://localhost:8000/storage/images/${name}`
</script>
<template>
  <div
    v-if="posts.length > 0"
    v-for="post in posts"
    class="w-1/3 px-4 py-2 m-auto mt-5 mb-4 overflow-hidden shadow-lg rounded-2xl"
  >
    <img :src="imagePath(post.image.name)" class="rounded-t-lg" v-if="post.image" />
    <div class="relative w-full p-4 bg-white">
      <p class="mb-2 text-2xl font-medium text-gray-800">{{ post.title }}</p>
      <p class="text-gray-600 text-s">
        {{ post.description }}
      </p>
    </div>
    <div class="flex flex-row">
      <RouterLink
        :to="`/${post.id}`"
        type="button"
        class="px-4 py-2 m-1 text-base font-semibold text-center text-white transition duration-200 ease-in bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2"
      >
        Show
      </RouterLink>
      <RouterLink
        :to="`/${post.id}/edit`"
        type="button"
        class="px-4 py-2 m-1 text-base font-semibold text-center text-white transition duration-200 ease-in bg-gray-600 rounded-lg shadow-md hover:bg-gray-700 focus:ring-gray-500 focus:ring-offset-gray-200 focus:outline-none focus:ring-2 focus:ring-offset-2"
      >
        Edit
      </RouterLink>
      <button
        type="button"
        class="px-4 py-2 m-1 text-base font-semibold text-center text-white transition duration-200 ease-in bg-red-600 rounded-lg shadow-md hover:bg-red-700 focus:ring-red-500 focus:ring-offset-red-200 focus:outline-none focus:ring-2 focus:ring-offset-2"
        v-on:click="handleDeletePost(post.id)"
      >
        Delete
      </button>
    </div>
  </div>
  <h2 class="m-4" v-else>There're no posts. Please create a new post</h2>
</template>
