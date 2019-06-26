{include file="../layout/header.tpl"}
<div class="container">

    <div class="col-12 my-20">
        <p><div id="orderResult"></div></p>
        {if $models}
            <div id="orderPreview">
            <h2>Ваш заказ:</h2>
            <p class="border border-warning p-2">Всего товаров: {$totalCount} шт.</p>
            <ul>
                    {foreach $models as $model}
                    <li>
                        <b>{$model.title}</b> - {$model.price} р.
                    </li>
                    {/foreach}

            </ul>
            <p class="border border-danger p-2">Итого: {$totalPrice} р.</p>
            <p class="border border-primary p-2">Статус - новый</p>
            <a href="#" id="orderPay" onClick="orderPay(); return false;" class="btn btn-success" role="button">Оплатить</a>
            </div>

        {else}
            <h2>Заказ не найден</h2>
            <a href="/" title="На главную" class="btn btn-xs btn-info">На главную</a>
        {/if}
    </div>
</div>
{include file="../layout/footer.tpl"}