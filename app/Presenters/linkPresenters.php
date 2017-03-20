<?php
namespace App\Presenters;
/**
 * Description:
 * User: Endless
 * Date: 2017/3/19
 * Time: 23:37
 */
class linkPresenters
{
    function link(array $links)
    {
        $html = '';
        $html .= '<div class="shadow-corner-curl hidden-xs"><div class="categories-list-header">友情链接</div><ul class="list-unstyled">';
        if (!empty($links)) {
            foreach ($links as $i) {
                $html .= '<li><a href="' . $i->url . '">' . $i->name . '</a></li>';
            }
        } else {
            $html .= '<li>还未添加友链</li>';
        }
        $html .= '</ul></div>';
        return $html;
    }
}