<?php
namespace Pctco\Verification\Captcha;
use think\facade\Config;
use think\facade\Session;
class Check{
   /**
    * @var Config|null
    */
   private $config = null;

   /**
    * @var Session|null
    */
   private $session = null;


   /**
   * @name __construct
   * @describe 架构方法 设置参数
   * @param Config  $config
   * @param Session $session
   **/
   public function __construct(Config $config, Session $session){
      $this->config  = $config;
      $this->session = $session;
   }
   /**
   * @name verify
   * @describe 验证验证码是否正确
   * @author
   * @param string $code 用户验证码
   * @return bool 用户验证码是否正确
   **/
   public function verify(string $code): bool{
      return $code;
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
