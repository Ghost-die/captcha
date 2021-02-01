<?php

namespace Ghost\Captcha;

use Dcat\Admin\Extend\Setting as Form;
use Dcat\Admin\Widgets\Alert;

class Setting extends Form
{
    public function form()
    {
        $this->select('type','验证码类型')
            ->options(['captcha' => '普通图片验证码','geetest'=>'极致验证码'])
            ->when('captcha', function (\Dcat\Admin\Widgets\Form $form) {
                $form->text('characters','字符集')->value('2346789abcdefghjmnpqrtuxyzABCDEFGHJMNPQRTUXYZ');
                $form->array('default',function (\Dcat\Admin\Widgets\Form $form){
                    $form->number('length','字符长度');
                    $form->number('width','图片宽度');
                    $form->number('height','图片高度');
                    $form->radio('math','开启计算')->options(['关闭','开启']);
                    $form->number('expire','有效时间');
                    $form->radio('encrypt','开启加密')->options(['关闭','开启']);
                })->default([
                    'default'=>[
                        'length' => 9,
                        'width' => 120,
                        'height' => 36,
                        'quality' => 90,
                        'math' => 0,
                        'expire' => 60,
                        'encrypt' => 0,
                    ]
                ])->disableCreate()->disableDelete();
            })
            ->when('geetest', function (Form $form) {

                $info =  '暂时未集成 等更新  <a class="text-danger" href="https://github.com/Ghost-die/geetest" target="_blank">Geetest单独版本</a>';
                $form->html(Alert::make($info)->warning());
            })
            ->default('captcha');

    }
}
