export const APIENDPOINT = 'http://iportfolio.test/api'

export const getHeader = function () {
  const tokenData = JSON.parse(window.localStorage.getItem('lbUser'))
  const headers = {
    'Accept': 'application/x-www-form-urlencoded',
    'Authorization': 'Bearer' + tokenData.token
  }
  return headers
}
