<!DOCTYPE html>
<html>
  <head>
    <title>Login Page</title>
  </head>
  <style>
    * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

body {
  background-color: #656d72;
  font-family: sans-serif;
}

.login-box {
  width: 280px;
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  color: #fff;
  padding: 30px;
  background-color: rgba(0, 0, 0, 0.5);
  border-radius: 10px;
}

.login-box h2 {
  text-align: center;
  margin-bottom: 30px;
}

.user-box {
  position: relative;
  margin-bottom: 20px;
}

.user-box input {
  width: 100%;
  padding: 10px 0;
  font-size: 16px;
  color: #fff;
  margin-bottom: 30px;
  border: none;
  border-bottom: 1px solid #fff;
  outline: none;
  background: transparent;
}

.user-box label {
  position: absolute;
  top: 0;
  left: 0;
  padding: 10px 0;
  font-size: 16px;
  color: #fff;
  pointer-events: none;
  transition: 0.5s;
}

.user-box input:focus ~ label,
.user-box input:valid ~ label {
  top: -20px;
  left: 0;
  color: #03a9f4;
  font-size: 12px;
}

button[type="submit"] {
  display: block;
  margin: 0 auto;
  background-color: #03a9f4;
  color: #fff;
  border: none;
  padding: 10px 20px;
  border-radius: 5px;
  cursor: pointer;
  transition: 0.5s;
}

button[type="submit"]:hover {
  background-color: #0288d1;
}

  </style>
  <body>
    <div class="login-box">
      <h2>Login</h2>
      <form method="POST" action="/login">
        @csrf
        <div class="user-box">
          <input type="text" name="email" value="">
          <label>Email</label>
          @error('email')
            <p style="font-size: small; color:red">{{$message}}</p>
        @enderror
        </div>
        <div class="user-box">
          <input type="password" name="password" >
          <label>Password</label>
          @error('password')
            <p style="font-size: small; color:red">{{$message}}</p>
        @enderror
        </div>
        <button type="submit">Login</button>
        <br><br>
        <a href="/register" style="display: flex; justify-content:center; text-decoration: none; color:#03a9f4;">Click here to register</a>
      </form>
    </div>
  </body>
</html>
