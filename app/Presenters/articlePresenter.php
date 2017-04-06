<?php
namespace App\Presenters;

class ArticlePresenter
{
    /**
     * @param array $data
     * @param int $type 1为文章列表，2为文章详情
     * @return string
     */
    function article(array $data, int $type = 1)
    {
        $html = '';
        if (empty($data)) {
            $html = '';
        } else {
            foreach ($data as $i) {
                $html .= '<article class="post">
            <h2 class="title">
                <a href="/detail/' . $i->id . '">
                    ' . $i->title . '</a>
            </h2>
            <div class="entry-content">';
                if ($type === 1) {
                    $html .= '<p>' . mb_substr($i->content, 0, 30) . '</p>';
                } else {
                    $html .= '<p>' . $i->content . '</p>';
                }
                $html .= '<a href="/detail/' . $i->id . '" class="more-link">Read on &rarr;</a>
            </div>
            <!--左侧日期评论数目统计区域-->
            <div class="meta">
                <div class="date">
                    <time datetime="' . $i->date . '" pubdate data-updated="true">' . $i->day . '&nbsp;&nbsp;<span>' . $i->weekday . '</span>, ' . $i->year . '
                    </time>
                </div>
                <div class="tags">
                </div>
                <div class="comments"><a href="#">Comments</a>
                </div>
            </div>
        </article>';
            }
        }
        return $html;
    }
}
