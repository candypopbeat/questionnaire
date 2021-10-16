<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\FormAddRequest;
use App\Models\Form;
use Illuminate\Support\Facades\Auth;

class FormController extends Controller
{
	public function list()
	{
		$data = Form::get();
		return view('list', ['data' => $data]);
	}

	public function sum()
	{
		$forms      = convertGc("forms");
		$gender     = convertGcPie("forms", "gender");
		$pref       = convertGcPie("forms", "pref");
		$facility   = convertGcPieArr("forms", "facilitys");
		$created    = convertGcCreated();
		return view('sum', [
			'forms'      => $forms,
			'gender'     => $gender,
			'pref'       => $pref,
			'facility'   => $facility,
			'created'   => $created,
		]);
	}

	public function add(FormAddRequest $request)
	{
		$formObj   = !empty($request->input("forms")) ? $request->input("forms") : "";
		$author    = Auth::check() ? Auth::user()->name : "guest";
		$userAgent = !empty($request->header('User-Agent')) ? $request->header('User-Agent') : "";
		$userIp    = !empty($request->ip()) ? $request->ip() : "";
		$now       = getNow();
		$facilitys = $formObj["facilitys"];
		if ($formObj["facilitysBool"]) {
			foreach ($facilitys as $k => $v) {
				if ($v === "その他") {
					$facilitys[$k] = "その他（" . $formObj["facilitysOther"] . "）";
				}
			}
		}
		$res = Form::insert([
			'gender'     => $formObj["gender"],
			'age'        => $formObj["age"],
			'pref'       => $formObj["pref"],
			'facilitys'  => json_encode($facilitys, JSON_UNESCAPED_UNICODE),
			'author'     => $author,
			'userIp'     => $userIp,
			'userAgent'  => $userAgent,
			'created_at' => $now,
			'updated_at' => $now,
		]);
		return response()->json($res);
	}
}
