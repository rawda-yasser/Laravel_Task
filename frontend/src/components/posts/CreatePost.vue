<script setup>
import { onMounted, ref } from 'vue'
import { usePostStore } from '../../stores/posts'

import { RouterLink, useRoute } from 'vue-router'
import router from '../../router'

const route = useRoute()
const store = usePostStore()
const { createPostForm } = store

const title = ref('')
const description = ref('')

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

  await createPostForm(formData)
  router.push({ path: '/' })
}
</script>
<template>
  <div class="bg-white rounded-lg shadow sm:max-w-md sm:w-full sm:mx-auto sm:overflow-hidden">
    <div class="px-4 py-8 sm:px-10">
      <div class="relative mt-6">
        <div class="absolute inset-0 flex items-center">
          <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex justify-center text-sm leading-5">
          <span class="px-2 text-gray-500 bg-white"> New Post </span>
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
                class="flex-1 w-full px-4 py-2 text-base text-gray-700 placeholder-gray-400 bg-white border border-transparent border-gray-300 rounded-lg shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
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
                class="flex-1 w-full px-4 py-2 text-base text-gray-700 placeholder-gray-400 bg-white border border-transparent border-gray-300 rounded-lg shadow-sm appearance-none focus:outline-none focus:ring-2 focus:ring-purple-600 focus:border-transparent"
                placeholder="description"
              ></textarea>
            </div>
          </div>
          <label class="block mb-2 font-bold text-gray-700" for="file-input">
            Choose a file:
          </label>
          <input
            id="file-input"
            type="file"
            class="w-full p-2 border border-gray-400"
            ref="image"
            v-on:change="handleFileChange"
          />
          <div>
            <span class="block w-full rounded-md shadow-sm">
              <button
                type="button"
                class="w-full px-4 py-2 text-base font-semibold text-center text-white transition duration-200 ease-in bg-indigo-600 rounded-lg shadow-md hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 focus:outline-none focus:ring-2 focus:ring-offset-2"
                v-on:click="handleSubmit()"
              >
                Create
              </button>
            </span>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
