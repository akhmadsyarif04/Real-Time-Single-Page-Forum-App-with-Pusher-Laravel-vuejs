import Token from './Token'
import AppStorage from './AppStorage'


class User {
  login (data)
  {
    axios.post('/api/auth/login', data)
      .then(res => this.responseAfterLogin(res))
      .catch(error => console.log(error.response.data))
  }

  responseAfterLogin(res)
  {
    const access_token = res.data.access_token
    const username = res.data.user
    // console.log(res.data)
    if (Token.isValid(access_token))
    {
        AppStorage.store(username, access_token)
        window.location = '/forum'
    }
  }

  hasToken()
  {
    const storedToken = AppStorage.getToken();
    if (storedToken) {
      return Token.isValid(storedToken) ? true : false
    }

    return false // jika tidak ada token
  }

  loggedIn ()
  {
    return this.hasToken()
  }

  logout()
  {
    AppStorage.clear()
    window.location = '/forum'
  }

  name()
  {
    if (this.loggedIn()) {
      return AppStorage.getUser()
    }
  }

  id()
  {
    // kenapa id diambil dari payload token? karena ketika mendapatkan payload token, disitu disertakan juga id jadi tidak perlu lagi memanggil id
    // silahkan console.log() pada Helper Token function payload atau ada function decode
    if (this.loggedIn()) {
      const payload = Token.payload(AppStorage.getToken())
      return payload.sub
    }
  }

  own(id)
  {
    return this.id( )== id
  }

  admin()
  {
    return this.id() == 17
  }

}



export default User = new User();
