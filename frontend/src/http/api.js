import axios from 'axios'
export const apiJson = axios.create({
  baseURL: 'http://localhost:8000/api/'
})
export const apiForm = axios.create({
  baseURL: 'http://localhost:8000/api/',
  headers: { 'Content-Type': 'multipart/form-data' }
})
