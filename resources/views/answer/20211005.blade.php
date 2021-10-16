<?php
$span = [
  "start" => "2021-10-05",
  "end" => "2021-10-09",
];
?>
@include("components.header")

<h1 class="alert alert-info text-center">個別回答</h1>

<x-page-title title="2021年10月5日～2021年10月9日" />

<div class="container">
  <div class="row row-cols-1 row-cols-md-2 row-cols-md-3 row-cols-lg-4 mb-4">
    <div class="col">
      <x-count-answer :span="$span" />
    </div>
    <div class="col">
      <x-count-deliver num="35" />
    </div>
  </div>
  <h3 class="alert alert-info">設問一覧</h3>
  <?php global $questionField; ?>
  <div class="row row-cols-2 row-cols-md3 row-cols-lg-4 g-2">
    @foreach( $questionField as $v )
    <div class="col">
      <div class="card">
        <div class="card-body">
          {{ $v }}
        </div>
      </div>
    </div>
    @endforeach
  </div>
  <h3 class="alert alert-success mt-5">回答一覧</h3>
  <?php $answers = getAnswers($span); ?>
  @foreach( $answers as $k => $v )
    <div class="card mb-4">
      <div class="card-body">
        <h3 class="alert alert-warning">A.{{ ++$k }}</h3>
        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-2">
          @foreach($questionField as $k2 => $v2)
            <div class="col">
              <div class="card">
                <div class="card-body">
                  <div>{{ $v2 }}</div>
                  <div class="answer">{{ $v[$k2] }}</div>
                </div>
              </div>
            </div>
          @endforeach
        </div>
      </div>
    </div>
  @endforeach


</div>

@include("components.footer")