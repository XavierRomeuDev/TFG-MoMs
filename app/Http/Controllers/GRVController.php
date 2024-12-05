<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rules\V3ReCaptcha;

class GRVController extends Controller
{
    public function index()
    {
        return view('contact');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function validateByReCaptchaV3(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|digits:10|numeric',
            'subject' => 'required',
            'message' => 'required',
            'g-recaptcha-response' => ['required', new V3ReCaptcha]
        ]);

        return redirect()->back()->with(['success' => 'Form Successfully Validated by Recaptcha v3']);
    }
}
