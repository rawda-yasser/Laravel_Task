<script setup>
import { onMounted, reactive, ref } from 'vue'
import { usePostStore } from '../../stores/posts'
import { storeToRefs } from 'pinia'
import { RouterLink, useRoute } from 'vue-router'
import router from '../../router'
const store = usePostStore()
const route = useRoute()
const { fetchPost, deletePost } = store
const post = reactive({ title: '', description: '', image: {} })

onMounted(async () => {
  const data = await fetchPost(route.params.postId)
  console.log(data)
  post.id = data.id
  post.title = data.title
  post.description = data.description

  if (post.image) post.image = data.image
})
const handleDeletePost = async () => {
  if (confirm('Are you sure you want to delete this post')) {
    await deletePost(route.params.postId)
  }

  router.push('/')
}
const imagePath = (name) => `http://localhost:8000/storage/images/${name}`
</script>
<template>
  <div class="px-4 py-2 mt-5 w-1/3 m-auto overflow-hidden shadow-lg rounded-2xl mb-4" v-show="post">
    <img :src="imagePath(post.image.name)" class="rounded-t-lg" v-if="post.image" />

    <div class="relative w-full p-4 bg-white">
      <p class="mb-2 text-2xl font-medium text-gray-800">{{ post.title }}</p>
      <p class="text-s text-gray-600">
        {{ post.description }}
      </p>
    </div>
    <div class="flex flex-row">
      <RouterLink
        type="button"
        :to="`/${post.id}/comments`"
        class="py-2 px-4 bg-indigo-600 hover:bg-indigo-700 m-1 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg"
      >
        Show Comments
      </RouterLink>
      <RouterLink
        :to="`/${post.id}/edit`"
        type="button"
        class="py-2 px-4 bg-gray-600 hover:bg-gray-700 m-1 focus:ring-gray-500 focus:ring-offset-gray-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg"
      >
        Edit
      </RouterLink>
      <button
        type="button"
        v-on:click="handleDeletePost"
        class="py-2 px-4 bg-red-600 hover:bg-red-700 m-1 focus:ring-red-500 focus:ring-offset-red-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg"
      >
        Delete
      </button>
    </div>
  </div>
</template>
