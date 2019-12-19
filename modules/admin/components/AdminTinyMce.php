<?php

namespace app\modules\admin\components;

use dosamigos\tinymce\TinyMce;

class AdminTinyMce extends TinyMce
{
    public $options = ['rows' => 15];

    public $language = 'ru';

    public $clientOptions = [
        'plugins' => ['fullscreen', 'table', 'link', 'code'],

        'forced_root_block' => '',

        'toolbar' =>
            "fullscreen | undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | table link image | code",

        'extended_valid_elements' => "a[*],abbr[*],acronym[*],address[*],applet[*],area[*],article[*],aside[*],audio[*],b[*],base[*],basefont[*],bdi[*],bdo[*],
        bgsound[*],big[*],blink[*],blockquote[*],body[*],br[*],button[*],canvas[*],caption[*],center[*],cite[*],code[*],col[*],
        colgroup[*],command[*],comment[*],datalist[*],dd[*],del[*],details[*],dfn[*],dir[*],div[*],dl[*],dt[*],em[*],embed[*],
        fieldset[*],figcaption[*],figure[*],font[*],footer[*],form[*],frame[*],frameset[*],h1[*],h2[*],h3[*],h4[*],h5[*],h6[*],
        head[*],header[*],hgroup[*],hr[*],html[*],i[*],iframe[*],img[*],input[*],ins[*],isindex[*],kbd[*],keygen[*],label[*],
        legend[*],li[*],link[*],listing[*],map[*],mark[*],marquee[*],menu[*],meta[*],meter[*],multicol[*],nav[*],nobr[*],
        noembed[*],noframes[*],noscript[*],object[*],ol[*],optgroup[*],option[*],output[*],p[*],param[*],plaintext[*],pre[*],
        progress[*],q[*],rp[*],rt[*],ruby[*],s[*],samp[*],section[*],select[*],small[*],source[*],spacer[*],span[*],
        strike[*],strong[*],style[*],sub[*],summary[*],sup[*],table[*],tbody[*],td[*],textarea[*],tfoot[*],th[*],thead[*],time[*],
        title[*],tr[*],track[*],tt[*],u[*],ul[*],var[*],video[*],wbr[*],xmp[*]",
        'valid_children' => "+body[meta],+div[h2|span|meta|object],+object[param|embed]"
    ];
}