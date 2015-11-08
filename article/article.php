<?php
/*
 * 1. Создать класс Article
a. DB таблица ​
article​
.
b. Поля DB таблицы
id ­ int, 5, primary key, autoincrement,
title ­ varchar, 70
description
created_at
c. Сущности
title
description
createdAt
d. Методы
getArticle ­ получить статью
getArticles­ получить список статей
postArticle ­ сохранить статью
putArticle ­ обновить статью
deleteArticle ­ удалить статью
 */
include_once "../_autoload.php";

class Article
{
    public $id;

    public function  __construct()
    {
        $this->base = new DataBase();
    }

    public function postArticle($title_use, $description_use) // сохранить статью
    {
        $sql = "INSERT INTO article (`title`,`description`,`created_at`)
          VALUES (:title, :description, :createdAt)";

        $this->base
            ->prepare($sql)
            ->bindValue(':title', $this->base->escape($title_use))
            ->bindValue(':description', $this->base->escape($description_use))
            ->bindValue(':createdAt', (new DateTime())->format('Y-m-d H:i:s'))
            ->execute();

        return true;

    }

    public function getArticle($get) // получить статью
    {
        $this->id = $get;
        $query = "SELECT * FROM `article` WHERE `id` = :id";
        $this->base
            ->prepare($query)
            ->bindValue(':id', $this->base->escape($this->id), DataBase::PARAM_INT)
            ->execute();

        return $this->base->fetchAll();
    }

    public function getArticles() // получение списков статей
    {
        $query = "SELECT * FROM article";
        $this->base
            ->prepare($query)
            ->execute();

        return $this->base->fetchAll();
    }

    public function putArticle($id, $title, $description) // обновить статью
    {
        $query = "UPDATE article SET `title`= :title, `description` = :description WHERE `article`.`id` = :id";
        $this->base
            ->prepare($query)
            ->bindValue(':title', $this->base->escape($title))
            ->bindValue(':description', $this->base->escape($description))
            ->bindValue(':id', $this->base->escape($id), DataBase::PARAM_INT)
            ->execute();

        return true;
    }


    public function deleteArticle($id) // удалить статью
    {
        $query = "DELETE FROM article WHERE id = :id";
        $this->base
            ->prepare($query)
            ->bindValue(':id', $this->base->escape($id), DataBase::PARAM_INT)
            ->execute();

        return true;
    }
}

//$article = new Article('Bogdan','Gutenev');
//echo $article->title;
//echo $article->description;
//echo $article->createdAt;
//$article->postArticle();
//var_dump($article->getArticles());