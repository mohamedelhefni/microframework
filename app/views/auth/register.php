<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
    <div class="form-group">
        <label for="username">username : </label>
        <input id="username" type="text" name="username" value="<?php echo htmlentities(input::get('username')) ?>">
    </div>
    <div class="form-group">
        <label for="email">email : </label>
        <input id="email" type="text" name="email" value="<?php echo htmlentities(input::get('email')) ?>">
    </div>
    <div class="form-group">
        <label for="password">password : </label>
        <input id="password" type="password" name="password">
    </div>
    <div class="form-group">
        <label for="password_again">password again : </label>
        <input id="password_again" type="password" name="password_again">
    </div>

    <input type="submit">
</form>

<a href='http://localhost/microframework/public/login'> login </a>