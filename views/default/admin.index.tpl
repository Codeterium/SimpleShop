{include file="../layout/header.tpl"}
<div class="container">

    <div class="col-12 my-20">
        <h2>Товары:</h2>
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>Наименование</th>
                <th>Цена</th>
                <th>Статус</th>
                <th>&nbsp;</th>
                </tr>
            </thead>
            <tbody>
                {foreach $models as $model}
                <tr>
                <td>{$model.title}</td>
                <td>{$model.price}</td>
                <td>{($model.status) ? 'активен' : 'скрыт'}</td>
                <td>
                    <a href="/admin/edit/{$model.id}/" title="Редактировать" class="btn btn-xs btn-info">&check;</a>
                    <a href="/admin/delete/{$model.id}/" title="Удалить" class="btn btn-xs btn-danger">&times;</a>
                </td>
                </tr>
                {/foreach}
            </tbody>
        </table>
        <a href="/admin/new/" class="btn btn-success" role="button">добавить</a>
    </div>
</div>
{include file="../layout/footer.tpl"}