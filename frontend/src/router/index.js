import { createRouter, createWebHistory } from 'vue-router'
import PostsView from '../views/PostsView.vue'
import UpdatePost from '../components/posts/UpdatePost.vue'
import Post from '../components/posts/Post.vue'
import CreatePost from '../components/posts/CreatePost.vue'
import AllComments from '../components/comments/AllComments.vue'
import CreateComment from '../components/comments/CreateComment.vue'
import UpdateComment from '../components/comments/UpdateComment.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: PostsView
    },
    {
      path: '/:postId/edit',
      name: 'updatePost',
      component: UpdatePost
    },
    {
      path: '/:postId',
      name: 'viewPost',
      component: Post
    },
    {
      path: '/create-post',
      name: 'createPost',
      component: CreatePost
    },
    {
      path: '/:postId/comments',
      name: 'viewComments',
      component: AllComments
    },
    {
      path: '/:postId/comments/:commentId/edit',
      name: 'updateComment',
      component: UpdateComment
    },
    {
      path: '/:postId/comments/create',
      name: 'createComments',
      component: CreateComment
    }
  ]
})

export default router
