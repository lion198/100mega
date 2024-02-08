<?php

namespace App\Model;


class Article
{
    private int $id;
    private string $title;
    private string $content;
    private int $time;
    private int $userId;


    /**
     * @param int $id
     * @param string $title
     * @param string $content
     */
    public function __construct(int $id, string $title, string $content, int $time,int $userId)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->time = $time;
        $this->userId = $userId;
    }
    /** Static function  */
    /** dbObject to object article */
    public static function dbToObject($data) : Article{
       return new Article($data->id, $data->title, $data->content, $data->time, $data->user_id);
    }
    /** Function convert List of dbObject to array of article */
    public static function dbListToListObject($data) : array {
        $result = [];
        foreach ($data as $article){
            $result[] = Article::dbToObject($article);
        }
        return $result;
    }
    /** Getters and setters */

    public function getId(): int {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function setContent(string $content): void {
        $this->content = $content;
    }
    public function getTime(): int
    {
        return $this->time;
    }

    public function setTime(int $time): void
    {
        $this->time = $time;
    }

    public function getUserId(): int
    {
        return $this->userId;
    }

    public function setUserId(int $userId): void
    {
        $this->userId = $userId;
    }


}