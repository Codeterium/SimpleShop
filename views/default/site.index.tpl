{include file="../layout/header.tpl"}
<div class="container">


    <div class="col-12 my-20">
        <h2>Товары:</h2>
        <div class="card-columns">
            {foreach $models as $model}

            <div class="card" style="width: 18rem;">
                <div class="card-body">
                    <h3 class="card-title">{$model.title}</h3>
                    <p class="card-text">Цена: {$model.price} р.</p>
                    <a href="#" class="btn btn-xs btn-danger {($model.incart) ? 'd-none': ''}" id="addToCart{$model.id}" onclick="addToCart({$model.id});return false;" data-id="{$model.id}" >Добавить в корзину</a>
                    <a href="#" class="btn btn-xs btn-warning {(!$model.incart) ? 'd-none': ''}" id="removeFromCart{$model.id}" onclick="removeFromCart({$model.id});return false;" data-id="{$model.id}" >Удалить из корзины</a>
                </div>
            </div>

            {/foreach}
        </div>
    </div>

</div>
{include file="../layout/footer.tpl"}