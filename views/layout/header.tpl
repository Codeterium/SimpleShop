<!DOCTYPE html>
<html lang="ru">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Meta -->
    <meta name="description" content="{$seoDescription|default:'Простой магазин'}">
    <meta name="author" content="codeterium">

    <title>{$seoTitle|default:'Простой магазин'}</title>

    <!-- vendor css -->
	<link href="/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">

  </head>

  <body>
    <div class="container">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
      <a class="navbar-brand" href="/">SimpleShop</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-item nav-link active" href="/">Главная <span class="sr-only">(current)</span></a>
          {($adminLogged == true) ? '<a class="nav-item nav-link" href="/admin/">Админка</a>' : '' }
          {($adminLogged == true) ? '<a class="nav-item nav-link" href="/admin/logout/">Выход</a>' : '<a class="nav-item nav-link" href="/admin/login/">Вход</a>' }
        </div>
      </div>
      <div class="form-inline p-1 m-1 border border-info" id="cartPanel">
        <a href="/cart/" id="cart" class="btn btn-outline-info btn-sm">Корзина</a>
        <span id="cartCount" class="p-1 m-1">
          {if $cartItemsCount > 0}{$cartItemsCount}{else}пусто{/if}
        </span>
        {if $ordersItemsCount > 0}
          <span class="p-1 m-1 btn btn-outline-info btn-sm">Заказов : {$ordersItemsCount}</span>
        {/if}
      </div>
    </nav>
    </div>