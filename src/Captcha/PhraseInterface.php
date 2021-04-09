<?php
namespace Pctco\Verification\Captcha;

/**
* @name Phrase Interface
* @describe 词组生成器界面
**/
interface PhraseInterface{
   /**
   * Generates  random phrase of given length with given charset
   */
   public function build();

   /**
   * "Niceize" a code
   */
   public function niceize($str);
}
