import { ref } from 'vue'
import { defineStore } from 'pinia'
import {
  allComments,
  createComment,
  getComment,
  removeComment,
  updateComment
} from '../http/api-comments'
export const useCommentStore = defineStore('commentStore', () => {
  const fetchAllComments = async (postId) => {
    const { data } = await allComments(postId)
    return data.data
  }
  const fetchComment = async (postId, commentId) => {
    const { data } = await getComment(postId, commentId)

    return data.data
  }
  const updateCommentForm = async (postId, commentId, comment) => {
    const { data } = await updateComment(postId, commentId, comment)
  }
  const createCommentForm = async (postId, comment) => {
    const { data } = await createComment(postId, comment)

    return data.data
  }
  const deleteComment = async (postId, commentId) => {
    const { data } = await removeComment(postId, commentId)

    return data.data
  }
  return {
    fetchAllComments,
    fetchComment,
    updateCommentForm,
    createComment,
    createCommentForm,
    deleteComment
  }
})
