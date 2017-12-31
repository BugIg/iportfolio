import {
  APIENDPOINT
} from '../../app.config'
import axios from 'axios'
import qs from 'qs'

export default {
  login (value, cb) {
    return new Promise(function (resolve, reject) {
      axios.post(APIENDPOINT + '/auth/login', qs.stringify(value), {
        headers: {
          'Content-Type': 'application/x-www-form-urlencoded'
        }
      })
        .then(function (res) {
          resolve(res.data)
        })
        .catch(function (err) {
          reject(err.response.data)
        })
    })
  }

}
