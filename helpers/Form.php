<?php

namespace app\helpers;

class Form
{
    public static function MapCoord($addr, $lat, $long)
    {
        ob_start();
        ?>
        <script type="text/javascript">
            window.addEventListener('load', function () {
                $('<?=$lat?>, <?=$long?>').prop('readonly', true);
                $('head').append($('<script>').attr('src', "<?=\Yii::getAlias("@web/js/jquery-autocomplete.js")?>").attr('type', 'text/javascript'))
                    .append($('<link>').attr('href', "<?=\Yii::getAlias("@web/css/autocomplete.css")?>").attr('rel', 'stylesheet'));

                $('<?=$addr?>').autocomplete({
                    lookup: function (q, done) {
                        $.ajax({
                            url: 'https://maps.googleapis.com/maps/api/geocode/json?address=' + encodeURIComponent(q),
                            dataType: 'json',
                            success: function (data) {
                                var result = {suggestions: []};
                                if (data.status == 'OK') {
                                    $(data.results).each(function (i, el) {
                                        result.suggestions.push({value: el.formatted_address, data: el});
                                    });
                                } else {
                                    result.suggestions.push({value: "Ничего не найдено", data: {}});
                                }
                                done(result);
                            }
                        });
                    },
                    onSelect: function (item) {
                        $('<?=$lat?>').val(item.data.geometry.location.lat);
                        $('<?=$long?>').val(item.data.geometry.location.lng);
                        $('<?=$lat?>, <?=$long?>').parent().removeClass('has-error').addClass('has-success');
                    },
                    deferRequestBy: 500
                });
            });
        </script>
        <?php
        return ob_get_clean();
    }
}