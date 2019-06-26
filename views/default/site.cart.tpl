{include file="../layout/header.tpl"}
<div class="container">

    <div class="col-12 my-20">
        {if $models}
            <h2>Ваша корзина:</h2>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Наименование</th>
                        <th>Цена</th>
                        <th>Количество</th>
                        <th>&nbsp;</th>
                    </tr>
                </thead>
                <tbody>
                    {foreach $models as $model}
                    <tr>
                        <td>{$model.title}</td>
                        <td>{$model.price}</td>
                        <td>1</td>
                        <td>
                            <a href="/cart/deleteitem/{$model.id}/" title="Удалить" class="btn btn-xs btn-danger">&times;
                                удалить</a>
                        </td>
                    </tr>
                    {/foreach}
                </tbody>
            </table>
            <a href="/cart/order/" class="btn btn-success" role="button">Заказать</a>
        {else}
            <h2>Ваша корзина пуста</h2>
            <a href="/" title="На главную" class="btn btn-xs btn-info">На главную</a>
        {/if}
    </div>
</div>
{include file="../layout/footer.tpl"}