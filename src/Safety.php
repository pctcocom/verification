<?php
namespace Pctco\Verification;
use think\facade\Cookie;
use think\facade\Config;
class Safety{
   public function captcha(){
      if (empty(Cookie::get('safety-captcha'))) {
         Cookie::set('safety-captcha',1,Config::get('initialize.safety.captcha.expires'));
      }else{
         Cookie::set('safety-captcha',Cookie::get('safety-captcha') + 1,Config::get('initialize.safety.captcha.expires'));
      }
      return [
         'validate'   =>   Config::get('initialize.safety.captcha.validate'),
         'pjax'   =>   Config::get('initialize.safety.captcha.pjax')
      ];
   }
}
