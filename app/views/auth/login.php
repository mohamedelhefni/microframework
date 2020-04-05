<form action="<?php echo $_SERVER['REQUEST_URI'] ?>" method="POST">
    <div class="form-group">
        <label for="username">username : </label>
        <input id="username" type="text" value="<?php echo htmlentities(input::get('username')) ?>" name="username">
    </div>
    <div class="form-group">
        <label for="password">password : </label>
        <input id="password" type="password" value="<?php echo htmlentities(input::get('password')) ?>" name="password">
    </div>
    <input type="submit">
</form>

<a href='http://localhost/microframework/public/register'> register </a>