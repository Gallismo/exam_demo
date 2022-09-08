<h1 class="center white">Регистрация</h1>
<form method="post" action="/web/api/register" class="login">
    @csrf
    <p>
        <label for="name">Имя:</label>
        <input type="text" name="name" id="name" value="">
    </p>

    <p>
        <label for="email">Email:</label>
        <input type="text" name="email" id="email" value="">
    </p>
    <p>
        <label for="password">Пароль:</label>
        <input type="text" name="password" id="password" value="">
    </p>
    <p>
        <label for="password_repeat">Повторите пароль:</label>
        <input type="text" name="password_repeat" id="password_repeat" value="">
    </p>
    <input type="hidden" name="_token" value="{{ csrf_token() }}" />
    <p class="login-submit">
        <button type="submit" class="login-button">Зарагестрироватся</button>
    </p>
</form>
