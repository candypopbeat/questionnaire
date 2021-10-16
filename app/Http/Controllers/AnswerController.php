<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Form;

class AnswerController extends Controller
{
	public function index()
	{
		return view('answer.index');
	}

	public function show($page)
	{
		return view('answer.' . $page);
	}
}
