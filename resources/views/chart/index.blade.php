@include("components.header")

<h1 class="alert alert-info text-center">集計チャート</h1>

<div class="container d-flex justify-content-center">
  <ul class="list-group h4">
    <li class="list-group-item p-4">
      <a class="text-decoration-none" href="/chart/all">全日</a>
    </li>
    <li class="list-group-item p-4">
      <a class="text-decoration-none" href="/chart/20211001">2021年10月1日</a>
    </li>
    <li class="list-group-item p-4">
      <a class="text-decoration-none" href="/chart/20211005">2021年10月5日</a>
    </li>
    <li class="list-group-item p-4">
      <a class="text-decoration-none" href="/chart/20211010">2021年10月10日</a>
    </li>
  </ul>
</div>

@include("components.footer")