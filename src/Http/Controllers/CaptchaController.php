<?php

namespace Ghost\Captcha\Http\Controllers;

use Dcat\Admin\Http\Controllers\AuthController;
use Dcat\Admin\Layout\Content;
use Dcat\Admin\Admin;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Validator;

class CaptchaController extends AuthController
{

    protected $view = 'ghost.captcha::login';


    public function postLogin(Request $request)
    {

        $credentials = $request->only([$this->username(), 'password','captcha']);
        $remember = (bool) $request->input('remember', false);


        /** @var \Illuminate\Validation\Validator $validator */
        $validator = Validator::make($credentials, [
            $this->username()   => 'required',
            'password'          => 'required',
            'captcha'           => ['required', 'captcha'],
        ],[
            'captcha.required' => '验证码不能为空',
            'captcha.captcha' => '请输入正确的验证码',
        ]);

        if ($validator->fails()) {
            return $this->validationErrorsResponse($validator);
        }

        unset($credentials['captcha']);
        if ($this->guard()->attempt($credentials, $remember)) {
            return $this->sendLoginResponse($request);
        }

        return $this->validationErrorsResponse([
            $this->username() => $this->getFailedLoginMessage(),
        ]);
    }
}