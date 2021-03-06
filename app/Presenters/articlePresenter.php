<?php
namespace App\Presenters;

use App\Model\Article;

class ArticlePresenter
{
    /**
     * @param  $data
     * @return string
     */
    function list($data)
    {
        $html = '';
        if (empty($data)) {
            $html = '';
        } else {
            foreach ($data as $i) {
                $html .= '<article class="post">
            <h2 class="title">
                <a href="/detail/' . $i['_id'] . '">
                    ' . $i['title'] . '</a>
            </h2>
            <div class="entry-content">';
                $html .= '<p>' . mb_substr($i['content'], 0, 100) . '</p><a href="/detail/' . $i['_id'] . '" class="more-link">Read on &rarr;</a>
            </div>
            <!--左侧日期评论数目统计区域-->
            <div class="meta">
                <div class="date"><span>' . $i['updated_at'] . '</span></div>
                <div class="tags">';
                if (!empty($i['tags'])) {
                    foreach ($i['tags'] as $j) {
                        $html .= '<a href="javascript:;">#' . $j . '</a>&nbsp;';
                    }
                }
                $html .= '</div>
                <div class="comments"><a href="javascript:;">Comments</a>
                </div>
            </div>
        </article>';
            }
        }
        return $html;
    }

    /**
     * @deprecated
     * @param Article $i
     * @return string
     */
    function detail(Article $i)
    {
        $html = '';
        if (empty($i)) {
            $html = '';
        } else {
            $html .= '<article class="post">
            <h2 class="title">
                <a href="/detail/' . $i->_id . '">
                    ' . $i->title . '</a>
            </h2>
            <div class="entry-content">';
            $html .= '<p id="article_content" data-content="">'.$i->content.'</p>
            </div>
            <!--左侧日期评论数目统计区域-->
            <div class="meta">
                <div class="date">
                    <span>' . $i->updated_at . '</span>
                </div>
                <div class="tags">
                </div>
                <div class="comments"><a href="#">Comments</a>
                </div>
            </div>
        </article>';
        }
        return $html;
    }
}
