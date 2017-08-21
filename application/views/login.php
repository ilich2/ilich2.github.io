<div id="login">
  <h1>Вход</h1>
  <form action="/users/do_login" id="login-form" method="post" name="login-form">
    <p><label for="email">Email<br>
        <input class="input" id="email" name="email" size="20"
               type="text" required></label></p>
    <p><label for="password">Пароль<br>
        <input class="input" id="password" name="password" size="20"
               type="password" value="" required></label></p>
    <p class="submit"><input class="button" name="login" id="login" type="submit" value="Войти"></p>
    <p class="regtext">Еще не зарегистрированы?<a href= "/users/registration/">Регистрация</a>!</p>
  </form>
  <div class="error-message"></div>
</div>
