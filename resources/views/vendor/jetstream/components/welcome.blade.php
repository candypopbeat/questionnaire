<div class="p-6 bg-white border-b border-gray-200">
	<div class="mt-2 text-2xl">
		{{ config("app.name") }}
	</div>

	<div class="mt-6 text-gray-500">
		<p>アンケート調査システム</p>
	</div>
</div>

<div class="bg-gray-200 bg-opacity-25 grid grid-cols-1 md:grid-cols-2">
<div class="p-6">
		<div class="flex items-center">
			<div class="text-lg text-gray-600 font-semibold mb-2">
				スタッフ登録
			</div>
		</div>
		<div class="flex items-center">
			<div style="width: 150px;">
				<x-qr.register></x-qr.register>
			</div>
			<div class="mt-2 ml-6 text-sm">
				<ul style="list-style-type: circle;">
					<li>フルネーム漢字</li>
					<li>メールアドレスは省略可</li>
					<li>パスワードは「------」にしてください</li>
				</ul>
			</div>
		</div>
		<div class="ml-12">
		</div>
	</div>

	<div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
		<div class="flex items-center">
			<div class="text-lg text-gray-600 font-semibold mb-2">
				ダッシュボード
			</div>
		</div>
		<div class="flex items-center">
			<div style="width: 150px;">
				<x-qr.dashboard></x-qr.dashboard>
			</div>
			<div class="mt-2 ml-6 text-sm">
				<ul style="list-style-type: circle;">
					<li>名前やパスワード変更に</li>
					<li>現場リーダー用</li>
				</ul>
			</div>
		</div>
		<div class="ml-12">
		</div>
	</div>

	<div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
		<div class="flex items-center">
			<div class="text-lg text-gray-600 font-semibold mb-2">
				アンケートフォーム
			</div>
		</div>
		<div class="flex items-center">
			<div style="width: 150px;">
				<x-qr.form></x-qr.form>
			</div>
			<div class="mt-2 ml-6 text-sm">
				<ul style="list-style-type: circle;">
					<li>チラシが無いときに活用</li>
				</ul>
			</div>
		</div>
		<div class="ml-12">
		</div>
	</div>

	<div class="p-6 border-t border-gray-200 md:border-t-0 md:border-l">
		<div class="flex items-center">
			<div class="text-lg text-gray-600 font-semibold mb-2">
				その他
			</div>
		</div>
		<div class="flex items-center">
			<div style="width: 150px;">
				<x-qr.form></x-qr.form>
			</div>
			<div class="mt-2 ml-6 text-sm">
				<ul style="list-style-type: circle;">
					<li>-------------------</li>
				</ul>
			</div>
		</div>
		<div class="ml-12">
		</div>
	</div>