<?php

namespace App\Models;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;

    // 登録・編集ができるカラム
    protected $fillable = [
        'category_id',
        'title',
        'date',
        'start_time',
        'end_time',
        'contents',
        'entry_fee',
    ];

    /**
     * カテゴリーリレーション
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'category_id');
    }

    /**
     * eventsテーブルのレコード全件取得
     *
     * @param void
     * @return Event eventsテーブル
     */
    public function allEventsData()
    {
        return $this->get();
    }

    /**
     * 登録処理 eventsテーブルにデータをinsert
     *
     */
    public function insertEventData($request)
    {
        return $this->create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'contents' => $request->contents,
            'entry_fee' => $request->entry_fee,
        ]);
    }
}
