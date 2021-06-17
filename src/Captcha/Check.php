<?php
namespace Pctco\Verification\Captcha;
use Pctco\Verification\Captcha\Captcha;
use Pctco\Verification\Captcha\Phrase;
use think\facade\Config;
class Check{

   // 想要验证的code
   private $verify;
   //
   private $captcha;


   /**
   * @name __construct
   * @describe 架构方法 设置参数
   * @param string  $code
   **/
   public function __construct($code){
      $this->verify  = $code;
      $this->captcha = new \Pctco\Verification\Captcha\Captcha;
   }
   /**
   * @name verify
   * @describe 验证验证码是否正确
   * @author
   * @param string $code 用户验证码
   * @return bool 用户验证码是否正确
   **/
   public function captcha_img(){
      $this->captcha->build();
      return $this->captcha->inline();
   }
   public function verify(string $code): bool{
      return $this->captcha->getPhrase();
      // if (!$this->session->has('captcha')) {
      //    return false;
      // }
      //
      // $key = $this->session->get('captcha.key');
      // $code = mb_strtolower($code, 'UTF-8');
      // $res = password_verify($code, $key);
      //
      // if ($res) {
      //    $this->session->delete('captcha');
      // }
      //
      // return $res;
   }
}
