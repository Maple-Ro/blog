<?php
/**
 * Description:
 * User: Endless
 * Date: 2017/3/20
 * Time: 00:09
 */

namespace App\Presenters;


class labelPresenters
{
    function label(array $data)
    {
        $html = '<div>';
        if (!empty($data)) {
            foreach ($data as $i) {
                $html .= '<a href="' . $i->url . '">' . $i->name . '</a>';
            }
        } else {
            $html .= '<a>暂无标签</a>';
        }
        $html .= '</div>';
        return $html;
    }

}