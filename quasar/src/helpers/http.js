import axios from 'axios'
import qs from 'qs'
import auth from '../auth'
import { get } from 'lodash'

const API_URL = 'http://iportfolio.tets/api/'

export default {
  post (path, data) {
    return new Promise((resolve, reject) => {
      axios.post(API_URL + path, qs.stringify(data))

        .then((response) => {
          resolve(response.data)
        })
        .catch((error) => {
          if (get(error, 'response.status') === 401) {
            auth.user.authenticated = false
          }
          reject(error)
        })
    })
  },
  get (path, data) {
    return new Promise((resolve, reject) => {
      axios.get(path, {params: data})
        .then((response) => {
          resolve(response.data)
        })
        .catch((error) => {
          if (get(error, 'response.status') === 401) {
            auth.user.authenticated = false
          }
          reject(error)
        })
    })
  },
  put (path, data) {
    return new Promise((resolve, reject) => {
      axios.put(path, qs.stringify(data))
        .then((response) => {
          resolve(response.data)
        })
        .catch((error) => {
          if (get(error, 'response.status') === 401) {
            auth.user.authenticated = false
          }
          reject(error)
        })
    })
  },
  delete (path) {
    return new Promise((resolve, reject) => {
      axios.delete(path)
        .then((response) => {
          resolve(response.data)
        })
        .catch((error) => {
          if (get(error, 'response.status') === 401) {
            auth.user.authenticated = false
          }
          reject(error.response)
        })
    })
  },
  patch (path, data) {
    return new Promise((resolve, reject) => {
      axios.patch(path, qs.stringify(data))
        .then((response) => {
          resolve(response.data)
        })
        .catch((error) => {
          if (get(error, 'response.status') === 401) {
            auth.user.authenticated = false
          }
          reject(error)
        })
    })
  }
}
