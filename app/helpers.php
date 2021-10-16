<?php
/**
 * 厳格処理指定
 */
declare(strict_types=1);


/**
 * データベース処理用クラス読込
 */
use Illuminate\Support\Facades\DB;


/**
 * 都道府県の配列
 * セレクトボックス用
 * @return array
 */
function getPrefArr()
{
  $pref = ["北海道", "青森県", "岩手県", "宮城県", "秋田県", "山形県", "福島県", "茨城県", "栃木県", "群馬県", "埼玉県", "千葉県", "東京都", "神奈川県", "新潟県", "富山県", "石川県", "福井県", "山梨県", "長野県", "岐阜県", "静岡県", "愛知県", "三重県", "滋賀県", "京都府", "大阪府", "兵庫県", "奈良県", "和歌山県", "鳥取県", "島根県", "岡山県", "広島県", "山口県", "徳島県", "香川県", "愛媛県", "高知県", "福岡県", "佐賀県", "長崎県", "熊本県", "大分県", "宮崎県", "鹿児島県", "沖縄県"];
  return $pref;
}


/**
 * 現在時刻取得
 * 各種データベース登録時のcreated_atとupdated_at用
 * @return string
 */
function getNow()
{
  date_default_timezone_set('Asia/Tokyo');
  $date = date("Y-m-d H:i:s");
  return $date;
}


/**
 * json文字列を配列化
 * @param $json string
 * @return array
 */
function jsonToArray($json)
{
  $arr = json_decode($json);
  return $arr;
}


/**
 * 指定したテーブルのカラム名一覧取得
 * HTML表と連想配列内のカラム名がキーとなっている場合に使用
 * @param $table string テーブル名
 * @return array カラム名の一覧
 */
function getTableColumns($table)
{
  return DB::getSchemaBuilder()->getColumnListing($table);
}


/**
 * GoogleChartsテーブル用JSON作成
 * @param $table string テーブル名
 * @return string 全レコードのJSON文字列
 */
function convertGc($table)
{
  $columns = getTableColumns($table);
  $items[] = $columns;
  $data = DB::table($table)->get();
  foreach ($data as $k => $v) :
    $sub = [];
    foreach ($columns as $ck => $cv) {
      $sub[] = $v->$cv;
    }
    $items[] = $sub;
  endforeach;
  $json = json_encode($items);
  return $json;
}


/**
 * GoogleCharts JSON作成 Pie ColumnChart
 * @param string $table テーブル名
 * @param string $col カラム名
 * @return string 見出し行ありの全レコードJSON文字列
 */
function convertGcPie($table, $col)
{
  $columns = [$col, "数"];
  $items[] = $columns;
  $data = DB::table($table)
    ->select($col)
    ->get();
  $arr = [];
  foreach ($data as $k => $v) :
    $arr[] = $v->$col;
  endforeach;
  $value = array_count_values($arr);
  foreach ($value as $k => $v) {
    $items[] = [$k, $v];
  }
  $json = json_encode($items);
  return $json;
}


/**
 * GoogleCharts JSON作成 Pie ColumnChart
 * 指定テーブルの指定カラムがJSON型の場合
 * @param string $table
 * @param string $col
 * @return string JSON文字列
 */
function convertGcPieArr($table, $col)
{
  $columns = [$col, "数"];
  $items[] = $columns;
  $data = DB::table($table)
    ->select($col)
    ->get();
  $arr = [];
  foreach ($data as $k => $v) :
    $arr = array_merge($arr, json_decode($v->$col));
  endforeach;
  $value = array_count_values($arr);
  foreach ($value as $k => $v) {
    $items[] = [$k, $v];
  }
  // dd($items);
  $json = json_encode($items);
  return $json;
}


/**
 * chart.js Bar Pie データ変換
 * @param string $col カラム名
 * @param array $span スタートとエンドが入った連想配列
 * @return array chart.js用の連想配列
 */
function conChartBarPie($col, $span)
{
  $data = getSpanData($span, $col);
  $arr = [];
  foreach ($data as $k => $v) :
    $arr[] = $v->$col;
  endforeach;
  $items = array_count_values($arr);
  arsort($items);
  $labels = [];
  $values = [];
  foreach ($items as $k => $v) {
    $labels[] = empty($k) ? "無回答" : $k;
    $values[] = $v;
  }
  $res = [
    "labels" => $labels,
    "values" => $values,
  ];
  return $res;
}


/**
 * vue-good-table データ変換
 * @param $span スタートとエンドが入った連想配列
 * @return object vue-good-table用のオブジェクト
 */
function conVueGoodTable($span)
{
  $data = getSpanData($span);
  return $data;
}


/**
 * vue-good-table CSV用データ変換
 * @param $span スタートとエンドが入った連想配列
 * @return array
 */
function conVueGoodTableCsv($span)
{
  $data = getSpanData($span);
  $res = [];
  foreach ($data as $k => $v) {
    $facilitys = json_decode($v->facilitys);
    $facility = "";
    foreach ($facilitys as $k2 => $v2) {
      $facility .= $v2;
      if ( array_key_last($facilitys) !== $k2 ) {
        $facility .= "/";
      }
    }
    $res[] = [
			$v->id,
			$v->gender,
			$v->age,
			$v->pref,
			$facility,
			$v->author,
			$v->userIp,
			$v->userAgent,
			$v->created_at,
			$v->updated_at,
    ];
  }
  return $res;
}


/**
 * chart.js Bar jsonカラム データ変換
 * @param string $col カラム名
 * @param $span スタートとエンドが入った連想配列
 * @return array
 */
function conChartBarPieJson($col, $span)
{
  $data = getSpanData($span, $col);
  $arr = [];
  foreach ($data as $k => $v) :
    $arr = array_merge($arr, json_decode($v->$col));
  endforeach;
  $items = array_count_values($arr);
  arsort($items);
  $labels = [];
  $values = [];
  foreach ($items as $k => $v) {
    $labels[] = $k;
    $values[] = $v;
  }
  $res = [
    "labels" => $labels,
    "values" => $values,
  ];
  return $res;
}


/**
 * spanに合わせてデータ取得
 * @param array $span スタートとエンドが入った連想配列
 * @param string $col カラム名１
 * @param string $col2 カラム名２
 * @return mixed
 */
function getSpanData($span, $col="", $col2=""){
  if ( empty($col) ) {
    if ( empty($span["start"]) && empty($span["end"]) ) {
      $data = DB::table('forms')
        ->get();
    }else if( empty($span["start"]) ){
      $data = DB::table('forms')
        ->where('created_at', '<=', date("Y-m-d 23:59:59", strtotime($span["end"])))
        ->get();
    }else if( empty($span["end"]) ){
      $data = DB::table('forms')
        ->where('created_at', '>=', date("Y-m-d 00:00:00", strtotime($span["start"])))
        ->get();
    }else{
      $data = DB::table('forms')
        ->where('created_at', '>=', date("Y-m-d 00:00:00", strtotime($span["start"])))
        ->where('created_at', '<=', date("Y-m-d 23:59:59", strtotime($span["end"])))
        ->get();
    }
  }else if( !empty($col) && !empty($col2) ){
    if ( empty($span["start"]) && empty($span["end"]) ) {
      $data = DB::table('forms')
        ->select($col, $col2)
        ->get()->toArray();
    }else if( empty($span["start"]) && !empty($span["end"]) ){
      $data = DB::table('forms')
        ->where('created_at', '<=', date("Y-m-d 23:59:59", strtotime($span["end"])))
        ->select($col, $col2)
        ->get()->toArray();
    }else if( !empty($span["start"]) && empty($span["end"]) ){
      $data = DB::table('forms')
        ->where('created_at', '>=', date("Y-m-d 00:00:00", strtotime($span["start"])))
        ->select($col, $col2)
        ->get()->toArray();
    }else{
      $data = DB::table("forms")
        ->where('created_at', '>=', date("Y-m-d 00:00:00", strtotime($span["start"])))
        ->where('created_at', '<=', date("Y-m-d 23:59:59", strtotime($span["end"])))
        ->select($col, $col2)
        ->get()->toArray();
    }
  }else if( $col === "count" ){
    if ( empty($span["start"]) && empty($span["end"]) ) {
      $data = DB::table('forms')->count();
    }else if( empty($span["start"]) && !empty($span["end"]) ){
      $data = DB::table('forms')
        ->where('created_at', '<=', date("Y-m-d 23:59:59", strtotime($span["end"])))
        ->count();
    }else if( !empty($span["start"]) && empty($span["end"]) ){
      $data = DB::table('forms')
        ->where('created_at', '>=', date("Y-m-d 00:00:00", strtotime($span["start"])))
        ->count();
    }else{
      $data = DB::table('forms')
        ->where('created_at', '>=', date("Y-m-d 00:00:00", strtotime($span["start"])))
        ->where('created_at', '<=', date("Y-m-d 23:59:59", strtotime($span["end"])))
        ->count();
    }
  }else{
    if ( empty($span["start"]) && empty($span["end"]) ) {
      $data = DB::table('forms')
        ->select($col)
        ->get();
    }else if( empty($span["start"]) ){
      $data = DB::table('forms')
        ->where('created_at', '<=', date("Y-m-d 23:59:59", strtotime($span["end"])))
        ->select($col)
        ->get();
    }else if( empty($span["end"]) ){
      $data = DB::table('forms')
        ->where('created_at', '>=', date("Y-m-d 00:00:00", strtotime($span["start"])))
        ->select($col)
        ->get();
    }else{
      $data = DB::table('forms')
        ->where('created_at', '>=', date("Y-m-d 00:00:00", strtotime($span["start"])))
        ->where('created_at', '<=', date("Y-m-d 23:59:59", strtotime($span["end"])))
        ->select($col)
        ->get();
    }
  }
  return $data;
}


/**
 * Google Charts JSON作成 created at
 * @return string JSON文字列
 */
function convertGcCreated()
{
  $columns = ["登録日", "数"];
  $items[] = $columns;
  $data = DB::table("forms")
    ->select("created_at")
    ->get();
  $arr = [];
  foreach ($data as $k => $v) :
    $arr[] = date("Y-m-d", strtotime($v->created_at));
  endforeach;
  $value = array_count_values($arr);
  foreach ($value as $k => $v) {
    $items[] = [$k, $v];
  }
  // dd($items);
  $json = json_encode($items);
  return $json;
}


/**
 * クロスチャート用データ生成
 * @param string $t1 カラム名１
 * @param string $t2 カラム名２
 * @param array $span スタートとエンドが入った連想配列
 * @return array
 */
function conCrossData($t1, $t2, $span)
{
  $data = getSpanData($span, $t1, $t2);
  $label1 = [];
  foreach ($data as $k => $v) {
    $va = fromEmptyToNoanswer($v->$t1);
    $label1[] = $va;
  }
  $label1 = array_values(array_unique($label1));
  $label2 = [];
  foreach ($data as $k => $v) {
    $va = fromEmptyToNoanswer($v->$t2);
    $label2[] = $va;
  }
  $label2 = array_values(array_unique($label2));
  sort($label2);
  $res["labels"] = $label2;
  foreach ($data as $k => $v) {
    foreach ($label1 as $kl1 => $vl1) {
      foreach ($label2 as $kl2 => $vl2) {
        $vt1 = fromEmptyToNoanswer($v->$t1);
        $vt2 = fromEmptyToNoanswer($v->$t2);
        if ($vt1 === $vl1 && $vt2 === $vl2) {
          $values[$vl1][] = $vl2;
        }
      }
    }
  }
  foreach ($label1 as $k => $v) {
    $arr = [];
    foreach ($label2 as $k2 => $v2) {
      $arr[] = 0;
    }
    $items = array_count_values($values[$v]);
    foreach ($label2 as $k2 => $v2) {
      foreach ($items as $k3 => $v3) {
        if ( $v2 === $k3 ) {
          $arr[$k2] = $v3;
        }
      }
    }
    $res["values"][] = [
      "label"   => $v,
      "values" => $arr,
    ];
  }
  return $res;
}


/**
 * チャートグラフで使うカラー設定
 * グローバル変数と関数としても使えるように
 * ボーダーカラーとバックグラウンドカラー
 */
global $borderColor;
global $backgroundColor;
$borderColor = array(
  "#e59d29",
  "#605e5c",
  "#9ad1af",
  "#cc755f",
  "#379942",
  "#291533",
  "#504854",
  "#6351d6",
  "#c9b67e",
  "#9e752a",
  "#14302f",
  "#4e5b5a",
  "#4dcc80",
  "#c9627f",
  "#a02e86",
);
$backgroundColor = array(
  "#FF9124",
  "#8D8985",
  "#B8FFD4",
  "#FF9478",
  "#4BCC5B",
  "#472557",
  "#7C6F82",
  "#7862FF",
  "#FFE9A1",
  "#CC9B39",
  "#255755",
  "#6F8281",
  "#61FFA1",
  "#FF7BA1",
  "#CC39AC",
);
function getBorderColor($i){
  global $borderColor;
  if ( $i > 14 ) {
    return "#cecece";
  }
  return $borderColor[$i];
}
function getBorderColorArr($c){
  global $borderColor;
  $arr = [];
  for ($i=0; $i < $c; $i++) { 
    if ( $i > 14 ) {
      $arr[] = "#cecece";
      continue;
    }
    $arr[] = $borderColor[$i];
  }
  return $arr;
}
function getBackgroundColor($i){
  global $backgroundColor;
  if ( $i > 14 ) {
    return "#cecece";
  }
  return $backgroundColor[$i];
}
function getBackgroundColorArr($c){
  global $backgroundColor;
  $arr = [];
  for ($i=0; $i < $c; $i++) {
    if ( $i > 14 ) {
      $arr[] = "#cecece";
      continue;
    }
    $arr[] = $backgroundColor[$i];
  }
  return $arr;
}


/**
 * 空白を無回答にする
 * @return string
 */
function fromEmptyToNoanswer($v)
{
  return empty($v) ? "無回答" : $v;
}


/**
 * n分おきのタイムスタンプ生成
 * @return array
 */
function conChartTimestamp($span, $min){
  $data = getSpanData($span, "created_at");
  if ( count($data) === 0 ) return $data;
  $first = $data[0]->created_at;
  $finish = strtotime($data[count($data)-1]->created_at . '+' . $min . ' min');
  $timeArr = [];
  for ($m=0, $s=strtotime($first); $s <= $finish; $m+=$min) {
    $s = strtotime($first . '+' . $m . ' min');
    if ( $s > $finish ) break;
    $timeArr[] = date('Y-m-d H:i:s', $s);
  }
  $res = [];
  foreach ($data as $k => $v) {
    foreach ($timeArr as $kt => $vt) {
      $left  = strtotime($vt);
      if ( $kt+1 === count($timeArr) ) break;
      $left2 = strtotime($timeArr[++$kt]);
      $right = strtotime($v->created_at);
      if ( $left <= $right && $left2 > $right ) {
        $res[$vt][] = $right;
      }
    }
  }
  $res2 = [];
  foreach ($timeArr as $k => $v) {
    foreach ($res as $k2 => $v2) {
      $res2[$v] = 0;
      if ( $v === $k2 ) {
        $res2[$v] = count($v2);
        break;
      }
    }
  }
  foreach ($res2 as $k => $v) {
    $res3["labels"][] = $k;
    $res3["values"][] = $v;
  }
  return $res3;
}


/**
 * JSONタイプか判定してからデータを返す
 * @param string
 * @param array $span スタートとエンドが入った連想配列
 * @param string $type
 * @return array
 */
function judgeJsonRes($target, $span, $type){
  if ( $type === "json" ) {
    $data = conChartBarPieJson($target, $span);
  }else{
    $data = conChartBarPie($target, $span);
  }
  return $data;
}


/**
 * JSONタイプか判定してからCSV用データを返す
 * @param string $col カラム名
 * @param string $start 開始日時
 * @param string $end 終了日時
 * @param string $dType
 * @return array
 */
function judgeJsonCsv($col, $start, $end, $dType=""){
  $span["start"] = $start;
  $span["end"] = $end;
  $data = getSpanData($span, $col);
  $arr = [];
  $res = [];
  if ( $dType === "json" ) {
    foreach ($data as $k => $v) :
      $arr = array_merge($arr, json_decode($v->$col));
    endforeach;
    $items = array_count_values($arr);
    arsort($items);
    foreach ($items as $k => $v) {
      $res[] = [$k, $v];
    }
  }else{
    foreach ($data as $k => $v) :
      $arr[] = $v->$col;
    endforeach;
    $items = array_count_values($arr);
    arsort($items);
    foreach ($items as $k => $v) {
      $k = empty($k) ? "無回答" : $k;
      $res[] = [$k, $v];
    }
  }
  return $res;
}


/**
 * 指定期間内の回答数 出力
 * @param array $span スタートとエンドが入った連想配列
 * @return array
 */
function getCountAnswer($span){
  $data = getSpanData($span, "count");
  return $data;
}


/**
 * 設問とデータベースフィールド
 * キーからカラム名を返す
 * @param string $field
 * @return string
 */
function fieldToQuestion($field){
  global $questionField;
  return $questionField[$field];
}
global $questionField;
$questionField =[
  "id"        => "ID",
  "gender"    => "性別",
  "age"       => "年代",
  "pref"      => "都道府県",
  "facilitys" => "施設",
];


/**
 * 個別回答取得
 * @param array $span スタートとエンドが入った連想配列
 * @return array
 */
function getAnswers($span){
  $data = getSpanData($span);
  $res = [];
  foreach ($data as $k => $v) {
    $res[] = getAnswersSub($v);
  }
  return $res;
}


/**
 * 個別回答モジュールメソッド
 * @param array $values
 * @return array
 */
function getAnswersSub($values){
  $res = [];
  foreach ($values as $k => $v) {
    if ( $k === "facilitys") {
      $arr = json_decode($v);
      $v = "";
      foreach ($arr as $k2 => $v2) {
        $v .= $v2;
        if ( $k2 !== array_key_last($arr) ) {
          $v .= "／";
        }
      }
    }
    $res[$k] = $v;
  }
  return $res;
}