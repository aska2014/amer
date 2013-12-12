<?php 

class NewsController extends BaseController {

    /**
     * @var News
     */
    protected $news;

    /**
     * @param News $news
     */
    public function __construct(News $news)
    {
        $this->news = $news;
    }

    /**
     * @return mixed
     */
    public function dynamicAll()
    {
        $news = $this->news->all();

        return $this->page()->printMe(compact('news'));
    }

    /**
     * @param News $oneNews
     * @return mixed
     */
    public function dynamicShow(News $oneNews)
    {
        return $this->page()->printMe(compact('oneNews'));
    }

}