<?php

namespace Ghost\Captcha;

use Dcat\Admin\Extend\ServiceProvider;
use Dcat\Admin\Admin;

class CaptchaServiceProvider extends ServiceProvider
{
	protected $js = [
        'js/index.js',
    ];
	protected $css = [
		'css/index.css',
	];


    public function register()
    {
        $this->app->singleton('ghost.captcha', function () {
            return $this->app->make(Captcha::class);
        });
    }

	public function init()
	{
		parent::init();

        $config = $this::setting();


        if (!empty($config) && $config['type']==='captcha'){
            //unset($config['type']);

            config(['captcha' => $config]);
        }else{
            $config = [
                'default'=>[
                    'length' => 9,
                    'width' => 120,
                    'height' => 36,
                    'quality' => 90,
                    'math' => 0,
                    'expire' => 60,
                    'encrypt' => 0,
                ]
            ];
            config(['captcha' => $config]);
        }
	}

	public function settingForm()
	{
		return new Setting($this);
	}
}
