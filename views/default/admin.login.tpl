{include file="../layout/header.tpl"}
<div class="container">

    <div class="card my-2">
        <div class="card-header">
            Вход в админку
        </div>
        <div class="card-body">


            <form method="post">
                <div class="form-group">
                    <label for="userName">Имя</label>
                    <input type="text" class="form-control" id="userName" name="userName" placeholder="Ваше имя">
                </div>
                <div class="form-group">
                    <label for="userPass">Пароль</label>
                    <input type="password" class="form-control" id="userPass" name="userPass" placeholder="Пароль">
                </div>

                <button type="submit" class="btn btn-primary">Войти</button>
            </form>
            <p><small>Для демо входа используйте admin/admin</small></p>

        </div>
    </div>

</div>
{include file="../layout/footer.tpl"}