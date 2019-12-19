<?php

namespace app\helpers;

use yii\db\ActiveRecord;
use yii\helpers\Url;

class Admin
{
    public static function isAdmin()
    {
        return !\Yii::$app->user->isGuest;
    }

    public static function isLiveEdit()
    {
        return static::isAdmin() && isset($_SESSION['live_edit']);
    }

    public static function editUrl(ActiveRecord $entity)
    {
        if (static::isLiveEdit()) {
            $r = new \ReflectionClass($entity::className());
            $view = sprintf('admin/%s/update', strtolower($r->getShortName()));
            return ' data-edit-url="' . Url::toRoute([$view, $entity::primaryKey()[0] => $entity->{$entity->primaryKey()[0]}]) . '"';
        }
        return '';
    }

    public static function js()
    {
        if (static::isLiveEdit()) {
            return <<<HTML
<style>
    .changeContent{
        position: absolute;
        top: 0;
        left: 0;
        font-size: 30px;
        cursor: pointer;
        z-index: 20;
    }
    
</style>
<script>(function(w,d){
'use strict';
w.addEventListener('load', function(){
    var $ = window.jQuery,
        body = $('body');
    $('.changeContent[data-edit-url]').parent().css({position:'relative'}).end().on('click', function(){
        var layout = $('<div>').css({position:'fixed',top:0,left:0,width:'100%',height:'100%',background:'rgba(0, 0, 0, .7)','z-index':9999,display:'table-cell','vertical-align':'middle','text-align':'center'});
        var container = $('<div>').css({display:'inline-block','margin-top':'100px',background:'#fff',padding: '10px'});
        layout.append(container);
        layout.on('click', function(){layout.remove();});
        container.on('click', function(e){
            if (typeof e.preventDefault == 'function'){e.preventDefault();}
            if (typeof e.preventBubble == 'function'){e.preventBubble();}
            if (typeof e.cancelBubble == 'function'){e.cancelBubble();}
            if (typeof e.stopPropagation == 'function'){e.stopPropagation();}
            return false;
        });
        $.get($(this).data('edit-url'), function(html) {
            container.html(html);
            container.find('label').css({display:'block','font-weight':'bold'});
            container.find('input, select').css({width:'100%'});
            container.find('h1').hide();
            var form = container.find('form');
            form.on('submit', function(e){
                if (typeof tinyMCE == 'object' && typeof tinyMCE.triggerSave == 'function') {
                    tinyMCE.triggerSave();
                }
                $.ajax({
                    method: form.attr('method'),
                    url: form.attr('action'),
                    data: container.find('form').serialize(),
                    dataType: 'json',
                    success: function(data) {
                        if (data.success == true) {
                            window.location.reload();
                        }
                    }
                });
                e.preventDefault();
            });
            container.find('[type="submit"]').on('click', function(){form.trigger('submit')});
        });
        container.html('<img src="/img/admin/loader.gif">');
        body.append(layout);
    });
})
})(window, document);</script>
HTML;

        }
        return '';
    }
}
