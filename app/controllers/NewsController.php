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
    public function all()
    {
        $news = $this->news->all();

        return $this->page()->printMe(compact('news'));
    }

    /**
     * @return mixed
     */
    public function show()
    {
        $oneNews = $this->link()->getModelOrFail();

        return $this->page()->printMe(compact('oneNews'));
    }

}