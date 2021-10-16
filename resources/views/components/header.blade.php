<!doctype html>
<html lang="ja">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config("app.name") }}</title>
  <link rel="shortcut icon" href="{{ asset('storage/favicon.ico') }}" type="image/x-icon">
  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
</head>

<body class="bg-light">

  @if(Auth::check())
    <nav class="navbar navbar-dark bg-secondary justify-content-center py-3">
      <div class="row justify-content-between w-100">
        <div class="col-auto col-md-10 offset-0 offset-md-1">
          <h1 class="text-white text-center m-0">
            {{ config("app.name") }}
          </h1>
        </div>
        <div class="col-auto col-md-1 text-end">
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
      </div>
    </nav>
    <div class="collapse navbar-collapse bg-secondary" id="navbarToggleExternalContent">
      <ul class="list-unstyled d-flex justify-content-end flex-wrap mb-0">
        <li class="p-2">
          <a href="/">
            <span class="btn btn-success">フォーム</span>
          </a>
        </li>
        <li class="p-2">
          <a href="/chart">
            <span class="btn btn-success">チャート</span>
          </a>
        </li>
        <li class="p-2">
          <a href="/answer">
            <span class="btn btn-success">個別回答</span>
          </a>
        </li>
        <li class="p-2">
          <a href="/dashboard">
            <span class="btn btn-success">ダッシュボード</span>
          </a>
        </li>
        @can('admin')
          <li class="p-2">
            <a href="/list">
              <span class="btn btn-success">リスト</span>
            </a>
          </li>
        @endcan
        <li class="p-2">
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button class="btn btn-success" type="submit">ログアウト（{{ Auth::user()->name }}）</button>
          </form>
        </li>
      </ul>
    </div>
  @endif

  @if(!Auth::check())
    <h1 class="bg-secondary text-white text-center py-3 mb-4">
      {{ config("app.name") }}
    </h1>
  @endif