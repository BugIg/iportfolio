// import router from './../router'

// URL and endpoint constants
// const LOGIN_URL = 'auth/login'
// const SIGNUP_URL = 'auth/signup'

export default {
  // User object will let us check authentication status
  user: {
    authenticated: false
  },

  // // Send a request to the login URL and save the returned JWT
  // login (context, creds, redirect) {
  //   context.$http.post(LOGIN_URL, creds, (data) => {
  //     localStorage.setItem('token', data.token)

  //     this.user.authenticated = true

  //     // Redirect to a specified route
  //     if (redirect) {
  //       router.go(redirect)
  //     }
  //   }).error((err) => {
  //     context.error = err
  //   })
  // },

  // signup (context, creds, redirect) {
  //   context.$http.post(SIGNUP_URL, creds, (data) => {
  //     localStorage.setItem('token', data.id_token)

  //     this.user.authenticated = true

  //     if (redirect) {
  //       router.go(redirect)
  //     }
  //   }).error((err) => {
  //     context.error = err
  //   })
  // },

  // To log out, we just need to remove the token
  logout () {
    localStorage.removeItem('token')
    this.user.authenticated = false
  },

  checkAuth () {
    var jwt = localStorage.getItem('token')
    if (jwt) {
      this.user.authenticated = true
    }
    else {
      this.user.authenticated = false
    }
  },

  // The object to be passed as a header for authenticated requests
  getAuthHeader () {
    return {
      'Authorization': 'Bearer ' + localStorage.getItem('token')
    }
  }
}
