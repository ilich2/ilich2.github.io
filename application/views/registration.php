<div id="registration">
    <h1>Регистрация</h1>
    <form action="/users/add_user" id="registrationForm" method="post" name="registrationForm">
        <p><label for="email">E-mail<br>
                <input class="input" id="email" name="email" size="32" type="text" required></label></p>
        <p><label for="password">Пароль<br>
                <input class="input" id="password" name="password" size="32" type="password" required></label></p>
        <p class="submit"><input class="button" id="registration" name= "registration" type="submit" value="Зарегистрироваться"></p>
        <p class="regtext">Уже зарегистрированы? <a href= "/users/login/">Введите имя пользователя</a>!</p>
    </form>
</div>