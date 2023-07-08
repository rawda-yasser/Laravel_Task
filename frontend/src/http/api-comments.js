import { apiJson, apiForm } from './api'
const parent_resource = 'posts'
const child_resource = 'comments'
export const allComments = (postId) =>
  apiJson.get(`/${parent_resource}/${postId}/${child_resource}`)
export const getComment = (postId, commentId) =>
  apiJson.get(`/${parent_resource}/${postId}/${child_resource}/${commentId}`)
export const createComment = (postId, comment) =>
  apiForm.post(`/${parent_resource}/${postId}/${child_resource}`, comment)
export const updateComment = (postId, commentId, comment) =>
  apiForm.post(`/${parent_resource}/${postId}/${child_resource}/${commentId}?_method=PUT`, comment)
export const removeComment = (postId, commentId) =>
  apiJson.delete(`/${parent_resource}/${postId}/${child_resource}/${commentId}`)
