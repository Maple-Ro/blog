<?php
namespace App\Presenters;

class ArticlePresenter
{
    function article(array $data)
    {
        $html = '';
        if (empty($data)) {
            $html = '';
        } else {
            foreach ($data as $i) {
                $html .= '<article class="post">
            <h2 class="title">
                <a href="#">
                    ' . $i->title . '</a>
            </h2>
            <div class="entry-content">
                <p>' . $i->summary . '</p>
                <a href="#" class="more-link">Read on &rarr;</a>
            </div>
            <div class="meta">
                <div class="date">
                    <time datetime="' . $i->date . '" pubdate data-updated="true">' . $i->day . '<span>' . $i->weekday . '</span>, ' . $i->year . '
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
