<?php
namespace App\Helpers;
use Config;
use Str;

class Url {
    public static function linkCategory($category_name, $id) {
        return route('category/index', ['category_name' => Str::slug($category_name), 'id' => $id]);
    }

    public static function linkArticle($article_name, $id) {
        return route('article/index', ['article_name' => Str::slug($article_name), 'id' => $id]);
    }
}