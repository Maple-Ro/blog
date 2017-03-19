<?php
namespace App\Presenter;
/**
 * Description:
 * User: Endless
 * Date: 2017/3/19
 * Time: 23:44
 */
class hotPresenter
{
    function hot(array $hot)
    {
        $html = '';
        $html .= '<div class="shadow-corner-curl hidden-xs"><div class="categories-list-header">热门文章</div><ul class="list-unstyled">';
        if (!empty($hot)) {
            foreach ($hot as $i) {
                $html .= '<li><a class="categories-list-item" href="' . $i->url . '">' . $i->name . '</a></li>';
            }
        } else {
            $html .= '<li>暂无热门文章</li>';
        }
        $html .= '</ul></div>';
        return $html;
    }
}