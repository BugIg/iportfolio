import qs from 'qs'
import axios from 'axios'

axios.defaults.headers.common['Authorization'] = 'Bearer ' + localStorage.getItem('token')

const Store = {
  namespaced: true,
  state: {
    name: null,
    id: null,
    avatar: null,
    authorized: null
  },
  actions: {
    // получить профайл с сервера
    getProfile ({state, dispatch}) {
      return new Promise((resolve, reject) => {
        axios.get('/me')
          .then(({data}) => {
            if (data.authorized === false) {
              state.authorized = false
              return resolve()
            }
            setTimeout(() => {
              state.name = data.name
              state.id = data.id
              state.avatar = data.avatar
              state.authorized = true
              resolve()
            }, 100)
          })
          .catch((e) => {
            // state.id = false
            state.authorized = false
            reject(e)
          })
      })
    },
    // войти по логину и паролю
    login ({state, dispatch}, {username, password, staySignedIn}) {
      state.authorized = false
      return new Promise((resolve, reject) => {
        axios.post('/login', qs.stringify({
          username,
          password
        })).then((res) => {
          if (res.data.success === false) {
            return resolve(res.data)
          }
          localStorage.setItem('token', res.data.token)
          axios.defaults.headers.common['Authorization'] = 'Bearer ' + res.data.token
          dispatch('getProfile')
          resolve({})
        }).catch((e) => {
          reject(e)
        })
      })
    },
    logout ({state, dispatch}) {
      state.authorized = false
      return new Promise((resolve, reject) => {
        axios.post('/logout')
          .then((res) => {
            state.name = null
            state.id = false
            state.avatar = null
            resolve()
          }).catch((e) => {
            reject(e)
          })
      })
    }
  }
}

export default Store
