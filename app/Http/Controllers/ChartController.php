<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ChartController extends Controller
{
	public function index()
	{
		return view('chart.index');
	}

	public function show($page)
	{
		return view('chart.' . $page);
	}

	public function csv(Request $request)
	{
		$response = new StreamedResponse(function () use ($request) {
			$stream = fopen('php://output', 'w');
			stream_filter_prepend($stream, 'convert.iconv.utf-8/cp932//TRANSLIT');
			$data = [];
			$type = $request->input("type");

			if ( $type === "datatable" ) {
				$start = $request->input("start");
				$end   = $request->input("end");
				$span  = [
					"start" => $start,
					"end"   => $end,
				];
				$res = conVueGoodTableCsv($span);
			}

			if ( $type === "chart-pie" || $type === "chart-bar" ) {
				$target = $request->input("target");
				$start  = $request->input("start");
				$end    = $request->input("end");
				$dType  = $request->input("dType") ?? "";
				$res    = judgeJsonCsv($target, $start, $end, $dType);
			}

			if (empty($res[0])) {
				fputcsv($stream, [
					'データが存在しませんでした。',
				]);
			} else {
				foreach ($res as $row) {
					fputcsv($stream, $row);
				}
			}
			fclose($stream);
		});

		$response->headers->set('Content-Type', 'application/octet-stream');
		$response->headers->set('content-disposition', 'attachment; filename=data.csv');
		return $response;
	}
}
