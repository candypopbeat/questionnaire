<?php
$span = [
  "start" => "2021-10-01",
  "end" => "2021-10-04",
];
?>
@include("components.header")
<script src="https://cdn.jsdelivr.net/npm/vue@2/dist/vue.js"></script>
<script src="{{ asset('js/chart.min.js') }}"></script>
<script src="{{ asset('js/vue-chartjs.min.js') }}"></script>
<script src="{{ asset('js/chartjs-plugin-datalabels.min.js') }}"></script>
<link href="https://cdn.jsdelivr.net/npm/vue-good-table@2.16.3/dist/vue-good-table.css" rel='stylesheet'> 
<script src="https://cdn.jsdelivr.net/npm/vue-good-table@2.16.3/dist/vue-good-table.js"></script>

<h1 class="alert alert-info text-center">チャート</h1>

<x-page-title title="2021/10/01～2021/10/04" />

<div class="container">

  <div class="row row-cols-1 row-cols-md-2 row-cols-md-3 row-cols-lg-4 mb-4">
    <div class="col">
      <x-count-answer :span="$span" />
    </div>
    <div class="col">
      <x-count-deliver num="120" />
    </div>
    <div class="col">
      <x-count-staff num="6" />
    </div>
    <div class="col">
      <x-start-end :span="$span" />
    </div>
  </div>

  <div class="row mb-4">
    <div class="col">
      <x-datatable
        title="データテーブル"
        :span="$span"
      />
    </div>
  </div>
  <div class="row mb-4">
    <div class="col">
      <x-timetable
        title="タイムテーブル"
        id="timetable"
        minute="720"
        height="300"
        :span="$span"
      />
    </div>
  </div>
  <div class="row row-cols-1 row-cols-md-2 g-4">
    <div class="col">
      <x-chart-pie
        title="性別"
        id="gender"
        height="250"
        target="gender"
        type=""
        :span="$span"
      />
    </div>
    <div class="col">
      <x-chart-bar-v
        title="性別"
        id="gender2"
        height="250"
        target="gender"
        type=""
        :span="$span"
      />
    </div>
    <div class="col">
      <x-chart-bar-h
        title="都道府県"
        id="pref"
        height="250"
        target="pref"
        type=""
        :span="$span"
      />
    </div>
    <div class="col">
      <x-chart-bar-v
        title="施設"
        id="facility"
        height="250"
        target="facilitys"
        type="json"
        :span="$span"
      />
    </div>
  </div>
  <div class="row mt-4">
    <div class="col">
      <x-chart-bar-cross-h
        title="都道府県と性別"
        id="genderpref"
        height="100"
        target1="pref"
        target2="gender"
        :span="$span"
      />
    </div>
  </div>
</div>

@include("components.footer")