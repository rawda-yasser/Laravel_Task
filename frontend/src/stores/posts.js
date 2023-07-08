import { ref, computed } from 'vue'
import { defineStore } from 'pinia'
import { allPosts, updatePost, getPost, createPost, removePost } from '../http/api-posts'
export const usePostStore = defineStore('postsStore', () => {
  const posts = ref([])
  const fetchAllPosts = async () => {
    const { data } = await allPosts()
    posts.value = data.data
    return posts.value
  }
  const fetchPost = async (postId) => {
    const { data } = await getPost(postId)

    return data.data
  }
  const updatePostForm = async (postId, post) => {
    const { data } = await updatePost(postId, post)
    posts.value = data.data
  }
  const createPostForm = async (post) => {
    const { data } = await createPost(post)
    posts.value = data.data
    return posts.value
  }
  const deletePost = async (postId) => {
    const { data } = await removePost(postId)
    posts.value = posts.value.filter((post) => post.id !== data.data.id)
    return data
  }
  return { posts, fetchAllPosts, fetchPost, updatePostForm, createPostForm, deletePost }
})
