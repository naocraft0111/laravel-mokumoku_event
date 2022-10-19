<?php

namespace App\Models;

use App\Models\Event;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    // 登録・編集ができるカラム
    protected $fillable = [
        'category_name'
    ];

    /**
     * イベントリレーション
     */
    public function events()
    {
        return $this->hasMany(Event::class, 'category_id', 'category_id');
    }

    /**
     * categoriesテーブルのレコード全件取得
     *
     * @param void
     * @return Category categoriesテーブル
     */
    public function allCategoriesData()
    {
        return $this->get();
    }
}
