<?php

namespace Ghost\Captcha;


use Dcat\Admin\Exception\AdminException;

class Captcha
{

    protected $captcha = 'captcha';


    protected $data = [];


    public function __construct()
    {
        $this->captcha = CaptchaServiceProvider::setting('type') ?? 'captcha';

    }
    public function render()
    {

        if ($this->captcha === 'captcha' && ! class_exists(\Mews\Captcha\Captcha::class)){
            throw new AdminException('To use captcha field, please install [mews/captcha] first.');

        }

        return view("ghost.captcha::{$this->captcha}",$this->data);
    }
}