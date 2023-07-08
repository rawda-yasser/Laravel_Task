<script setup>
import { onMounted, ref } from 'vue'
import { useCommentStore } from '../../stores/comments'
import { RouterLink, useRoute } from 'vue-router'
import router from '../../router'

const route = useRoute()
const store = useCommentStore()
const { fetchAllComments, deleteComment } = store
const comments = ref([])
onMounted(async () => {
  comments.value = await fetchAllComments(route.params.postId)
  console.log(comments.value)
})
const handleDeleteComment = async (postId, commentId) => {
  if (confirm('Are you sure you want to delete this comment')) {
    await deleteComment(postId, commentId)
    comments.value = comments.value.filter((comment) => comment.id !== commentId)
  }
}
const imagePath = (name) => `http://localhost:8000/storage/images/${name}`
</script>
<template>
  <div
    v-if="comments.length > 0"
    v-for="comment in comments"
    class="px-4 py-2 mt-5 w-1/3 m-auto overflow-hidden shadow-lg rounded-2xl mb-4"
  >
    <img
      :src="imagePath(comment.image.name)"
      class="rounded-t-lg"
      v-if="comment.image"
      v-bind:alt="pic"
    />
    <div class="relative w-full p-4 bg-white">
      <p class="mb-2 text-2xl font-medium text-gray-800">{{ comment.title }}</p>
      <p class="text-s text-gray-600">
        {{ comment.description }}
      </p>
    </div>
    <div class="flex flex-row">
      <RouterLink
        :to="`/${route.params.postId}/comments/${comment.id}/edit`"
        type="button"
        class="py-2 px-4 bg-gray-600 hover:bg-gray-700 m-1 focus:ring-gray-500 focus:ring-offset-gray-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg"
      >
        Edit
      </RouterLink>
      <button
        type="button"
        class="py-2 px-4 bg-red-600 hover:bg-red-700 m-1 focus:ring-red-500 focus:ring-offset-red-200 text-white transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg"
        v-on:click="handleDeleteComment(route.params.postId, comment.id)"
      >
        Delete
      </button>
    </div>
  </div>

  <h2 class="m-4" v-else>There're no comments. Please create a new comment</h2>
  <div class="block rounded-md m-4 w-full text-center">
    <span>
      <RouterLink
        type="button"
        class="py-2 px-4 bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2 rounded-lg"
        :to="`/${route.params.postId}/comments/create`"
      >
        New Comment
      </RouterLink>
    </span>
  </div>
</template>
