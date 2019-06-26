{include file="../layout/header.tpl"}
<div class="container">

    <div class="card my-2">
        <div class="card-header">
            {($model.id==0) ? 'Добавление ' : 'Редактирование' }  <strong>{$model.title}</strong>
        </div>
        <div class="card-body">


            <form method="post">

                <input type="hidden" id="id" name="id" value="{$model.id}">
                <div class="form-group">
                    <label for="title">Название</label>
                    <input type="text" class="form-control" id="title" name="title" placeholder="Название"
                        value="{$model.title}">
                </div>

                <div class="form-group">
                    <label for="price">Цена</label>
                    <input type="text" class="form-control" id="price" name="price" placeholder="Цена"
                        value="{$model.price}">
                </div>

                <div class="form-group">
                    <label for="status">Статус</label>
                    <select id="status" name="status" class="form-control">
                        <option value="0" {($model.status==0) ? 'selected ' : '' }>скрыт</option>
                        <option value="1" {($model.status==1) ? 'selected ' : '' }>активен</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Обновить</button>
                <a href="/admin/index/" class="btn btn-info">Отменить</a>
            </form>


        </div>
    </div>

</div>
{include file="../layout/footer.tpl"}