<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{
    public function __construct()
    {
        $this->event = new Event();
        $this->category = new Category();
    }

    /**
     * イベント一覧画面
     */
    public function index()
    {
        // eventsテーブルにあるデータを全て取得
        $events = $this->event->allEventsData();
        // dd($events);
        return view('event.index', compact('events'));
    }

    /**
     * もくもく会登録画面
     */
    public function register()
    {
        $categories = $this->category->allCategoriesData();
        return view('event.register', compact('categories'));
    }

    /**
     * もくもく会登録処理
     */
    public function create(EventRequest $request)
    {
        try {
            // トランザクション開始
            DB::beginTransaction();
            // リクエストされたデータをもとにeventsテーブルにデータをinsert
            $insertEvent = $this->event->insertEventData($request);
            // 処理に成功したらコミット
            DB::commit();
        } catch (\Throwable $e) {
            // Throwableで全異常を検知
            // 処理に失敗したらロールバック
            DB::rollback();
            // エラーログ
            \Log::error($e);
            // 登録処理失敗時にリダイレクト
            return redirect()->route('event.index')
                ->with('error', 'もくもく会の登録に失敗しました。');
        }

        return redirect()->route('event.index')
            ->with('success', 'もくもく会の登録に成功しました。');
    }

    /**
     * 詳細画面
     */
    public function show($id)
    {
        // $id(event_id)をもとに、eventsテーブルの特定のレコードに絞り込む
        $event = $this->event->findEventByEventId($id);

        // 指定の日付を△△/××に変換する
        $date = date('m/d', strtotime($event->date));
        // 指定日の曜日を取得する
        $getWeek = date('w', strtotime($event->date));
        // 配列を使用し、要素順に(日:0〜土:6)を設定する
        $week = [
            '日', //0
            '月', //1
            '火', //2
            '水', //3
            '木', //4
            '金', //5
            '土', //6
        ];

        // 開始時間 ex.15:00:00→15:00に変換。秒部分を切り捨て
        $start_time = substr($event->start_time, 0, -3);
        // 終了時間 ex.19:00:00→19:00に変換。秒部分を切り捨て
        $end_time = substr($event->end_time, 0, -3);

        return view('event.show', compact(
            'event',
            'date',
            'getWeek',
            'week',
            'start_time',
            'end_time',
        ));
    }

    /**
     * 編集画面
     */
    public function edit(Request $request, $id)
    {
        // カテゴリー一覧を取得
        $categories = $this->category->allCategoriesData();

        // $id(event_id)をもとに、編集画面に表示するもくもく会のデータを1件取得
        $event = $this->event->findEventByEventId($id);

        return view('event.edit', compact('categories','event'));
    }

    public function update(EventRequest $request)
    {
        // イベントIDを取得
        $eventId = $request->event_id;
        // $id(event_id)をもとに、編集画面に表示するもくもく会のデータを1件取得
        $event = $this->event->findEventByEventId($eventId);

        try {
            // トランザクション開始
            DB::beginTransaction();
            // 更新対象のレコードの更新処理を実行
            $isUpdated = $this->event->updatedEventDate($request, $event);
            // 処理に成功したらコミット
            DB::commit();
        } catch (\Throwable $e) {
            // Throwableで全異常を検知
            // 処理に失敗したらロールバック
            DB::rollback();
            // エラーログ
            \Log::error($e);
            // 登録処理失敗時にリダイレクト
            return redirect()->route('event.index')
                ->with('error', 'もくもく会の更新に失敗しました。');
        }
        return redirect()->route('event.index')
            ->with('success', 'もくもく会の更新に成功しました。');
    }

    /**
     * 削除処理
     */
    public function delete($id)
    {
        try {
            // トランザクション開始
            DB::beginTransaction();
            // もくもく会のイベントを削除する
            $isDelete = $this->event->deleteEventData($id);

            // 処理に成功したらコミット
            DB::commit();
        } catch (\Throwable $e) {
            // Throwableで全異常を検知
            // 処理に失敗したらロールバック
            DB::rollback();
            // エラーログ
            \Log::error($e);
            // 登録処理失敗時にリダイレクト
            return redirect()->route('event.index')
                ->with('error', 'もくもく会の削除に失敗しました。');
        }
        return redirect()->route('event.index')
            ->with('success', 'もくもく会の削除に成功しました。');
    }
}
