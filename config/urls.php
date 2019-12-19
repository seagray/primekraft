<?php

return [
    '/' => 'site/index',
    '/sitemap' => 'site/sitemap',
    '/news/' => 'news/index',
    '/news/<id>/' => 'news/item',
    '/articles' => 'article/index',
    '/articles/<url>' => 'article/item',
    '/production/' => 'catalogue/index',
    '/production/category<id:[\d]+>' => 'catalogue/category',
    '/production/item<id:[\d]+>' => 'catalogue/item',

    '/production/<category>' => 'catalogue/category',
    '/production/<category>/<item>' => 'catalogue/item',

 //   'robots.txt' => 'site/robots',

    //Корзина
    'card/info' => 'card/info',
    'card/<id>/<count>'=>'card/add',
    'card/change/<id>/<count>'=>'card/change',
    'card/<id>'=>'card/remove',
    'card-clear'=>'card/clear',
    'card-sum'=>'card/get-sum',
    'card'=>'card/index',
    'card-ajax'=>'card/get',
    'card-data'=>'card/data',

    //Страница заказа
    'order'=>'card/order',
    'order-success'=>'card/order-success',
    'order/field'=>'card/add-field',

    //ЛК
    'personal'=>'personal/index',
    'personal/orders'=>'personal/orders',
    'personal/transactions'=>'personal/transactions',
    'personal/payouts'=>'personal/payouts',

    'POST registration'=>'feedback/registration',
    'GET registration'=>'feedback/index',

    'admin' => 'admin',

    '<view>' => 'site/page',
];