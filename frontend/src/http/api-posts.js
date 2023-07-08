import { apiJson, apiForm } from './api'
const resource = 'posts'
export const allPosts = () => apiJson.get(resource)
export const getPost = (postId) => apiJson.get(`/${resource}/${postId}`)
export const createPost = (post) => apiForm.post(resource, post)
export const updatePost = (postId, post) => apiForm.post(`/${resource}/${postId}?_method=PUT`, post)
export const removePost = (postId) => apiJson.delete(`/${resource}/${postId}`)
