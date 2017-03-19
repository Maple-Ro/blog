<?php
namespace App\Presenter;
/**
 * Description:
 * User: Endless
 * Date: 2017/3/19
 * Time: 23:50
 */
class categoryPresenter
{
    function cates(array $data)
    {
        $html = '';
        $html .= '<div class="shadow-corner-curl hidden-xs"><div class="categories-list-header">Categories</div>
      <a href="/" class="categories-list-item" data-cate="All">All<span class="my-badge">所有分类</span></a>';
        if (!empty($data)) {
            foreach ($data as $i) {
                $html .= '<a href="javascript:;" class="categories-list-item" data-cate="">
<span class="my-badge"></span> <!-- TODO  -->
        </a>';
            }
        } else {
            $html .= '<a>还未添加分类</a>';
        }
        $html .= '</div>';
        return $html;
    }

}