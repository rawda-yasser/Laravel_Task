<script setup>
import { onMounted, ref } from 'vue'
import { usePostStore } from '../../stores/posts'

import { RouterLink, useRoute } from 'vue-router'
import router from '../../router'

const route = useRoute()
const store = usePostStore()
const { updatePostForm, fetchPost } = store

const title = ref('')
const description = ref('')
onMounted(async () => {
  const data = await fetchPost(route.params.postId)
  console.log(data)
  title.value = data.title
  description.value = data.description
})
const image = ref()
let file
const handleFileChange = () => {
  file = image.value.files[0]
}
const handleSubmit = async () => {
  const formData = new FormData()
  formData.append('title', title.value)
  formData.append('description', description.value)
  if (file) formData.append('image', file)

  console.log(formData)

  await updatePostForm(route.params.postId, formData)
  router.push({ path: '/' })
}
</script>
<template>
  <div class="m-10">
    <RouterLink
      type="button"
      class="m-3 py-2 px-4 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg"
      :to="`/${route.params.postId}`"
    >
      Back
    </RouterLink>
  </div>

  <div class="bg-white rounded-lg shadow sm:max-w-md sm:w-full sm:mx-auto sm:overflow-hidden">
    <div class="px-4 py-8 sm:px-10">
      <div class="relative mt-6">
        <div class="absolute inset-0 flex items-center">
          <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex justify-center text-sm leading-5">
          <span class="px-2 text-gray-500 bg-white"> Edit Post </span>
        </div>
      </div>
      <div class="mt-6">
        <div class="w-full space-y-6">
          <div class="w-full">
            <div class="relative">
              <input
                type="text"
                id="title"
                v-model="title"
                class="rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                placeholder="title"
              />
            </div>
          </div>

          <div class="w-full">
            <div class="relative">
              <textarea
                type="text"
                rows="4"
                v-model="description"
                id="search-form-name"
                class="rounded-lg border-transparent flex-1 appearance-none border border-gray-300 w-full py-2 px-4 bg-white text-gray-700 placeholder-gray-400 shadow-sm text-base focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                placeholder="description"
              ></textarea>
            </div>
          </div>
          <label class="block text-gray-700 font-bold mb-2" for="file-input">
            Choose a file:
          </label>
          <input
            id="file-input"
            type="file"
            class="border border-gray-400 p-2 w-full"
            ref="image"
            v-on:change="handleFileChange"
          />
          <div>
            <span class="block w-full rounded-md shadow-sm">
              <button
                type="button"
                class="py-2 px-4 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg"
                v-on:click="handleSubmit()"
              >
                Update
              </button>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
