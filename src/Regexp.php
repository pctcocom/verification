<?php
namespace Pctco\Verification;
class Regexp{
   function __construct($str = ''){
      $this->data = $str;
   }
   /**
   * @name preg
   * @describe 正则表达式匹配规则
   * @param mixed $key
   * @return String
   **/
   public function preg($key){
      $preg = [
         // img src
         'html.img.src.link'   =>   '/<[img|IMG].*?src=[\'|\"](.*?(?:[\.gif|\.jpg|\.png|\.jpeg]))[\'|\"].*?[\/]?>/',
         'html.img.src.base64'   =>   '/<[img|IMG].*?src=[\'|\"](data:image.*?;base64.*?(?:[\="]))[\'|\"].*?[\/]?>/',
         'markdown.img.link'   =>   '/!\[.*?\]\((.*?(?:[\.gif|\.jpg|\.png|\.jpeg]))\)/',

         //
         'html.video.src.link'   =>   '/<[video|VIDEO].*?src=[\'|\"](.*?(?:[\.mp4]))[\'|\"|\?].*?[\/]?/',
         // script src
         'html.script.src.link'   =>   '/<[script|SCRIPT].*?src=[\'|\"](.*?(?:[\.js]))[\'|\"|\?].*?[\/]?>/',
         'html.script.content'   =>   '/<script.*?>(.*?)<\/script>/is',

         // css href
         'html.css.href.link'   =>   '/<[link|LINK].*?href=[\'|\"](.*?(?:[\.css]))[\'|\"|\?].*?[\/]?>/',
         // a href
         'html.a.href.link'   =>   '/<[a|A].*?href="(.*?)".*?>/is',

         //link href
         'html.img.href.link'   =>   '/<[link|LINK].*?href=[\'|\"](.*?(?:[\.ico|\.gif|\.jpg|\.png|\.jpeg]))[\'|\"|\?].*?[\/]?>/',


         'html.script.string.img.link'   =>   '/[\'|\"](.*?(?:[\.gif|\.jpg|\.png|\.jpeg]))[\'|\"]/',
         // bug: 无法匹配到url(https://test.jpg) 无引号到链接
         'html.css.string.img.link'   =>   '/url\([\"|\'](.*?[\.gif|\.jpg|\.png|\.jpeg].*?)[\"|\']\)/',


         // 是否是图片格式
         'format.img'   =>   '/.*?(\.png|\.jpg|\.jpeg|\.gif).*?/',
         // 是否是链接图片格式 new \Pctco\Storage\App\UploadImage\SaveLinkImage 关联了此规则
         'format.link.img'   =>   '/^(http)(s)?(\:\/\/).*?(\.png|\.jpg|\.jpeg|\.gif|\.ico).*?/',
         // 是否是音频格式
         'format.link.video'   =>   '/^(http)(s)?(\:\/\/).*?(\.mp4|\.wmv|\.webm|\.avi).*?/'
      ];
      return empty($preg[$key])?$key:$preg[$key];
   }
   /**
   * @name check
   * @describe 验证
   * @param mixed $preg
   * @return Boolean  1 or 0
   **/
   public function check($preg){
      return preg_match($this->preg($preg),$this->data);
   }
   /**
   * @name find
   * @describe 查找
   * @param mixed $preg
   * @return Array Or Boolean(false)
   **/
   public function find($preg){
      preg_match_all($this->preg($preg),$this->data,$arr);
      $arr = empty($arr[1]) ? [] : array_unique($arr[1]);
      return empty($arr)?false:$arr;
   }
   /**
   * @name Remove Url Param
   * @describe 移除url参数 ?182&age=18
   * @return String URL
   **/
   public function RemoveUrlParam($start = '?'){
      $pos = strpos($this->data,$start);
      if ($pos !== false) {
          $param = substr($this->data,$pos);
          $url = str_replace($param,'',$this->data,$count);
          return $url;
      }
      return $this->data;
   }
   /**
   * @name Is Url Type
   * @describe  判断URL协议
   * @return String URL
   **/
   public function IsUrlType(){
      $url = parse_url($this->data);
      $type = false;
      if (empty($url['host'])) {
         // 相对路径 /js/min.js
         $type = 'RelativelyPathUrl';
      }
      if (!empty($url['scheme'])) {
         // 完整链接 https://test.com/js/min.js
         $type = 'CompleteUrl';
      }
      if (empty($url['scheme']) && !empty($url['host'])) {
         // 自动判断链接协议 //test.com/js/min.js
         $type = 'AutoProtocolUrl';
      }
      return $type;
   }
   /**
   * @name phone
   * @describe 电话格式验证
   *
   * China
   *
   $_10086 = [134,135,136,137,138,139,147,150,151,152,157,158,159,172,178,182,183,184,187,188,195,198];
   $_10010 = [186,185,155,156,130,131,132,176,175,166];
   $_10000 = [133,153,189,181,180,177,173,199,191];
   *
   **/
   public function phone(){
      $regexp = [
         86   =>   '/^(134|135|136|137|138|139|147|150|151|152|157|158|159|172|178|182|183|184|187|188|195|198|186|185|155|156|130|131|132|176|175|166|133|153|189|181|180|177|173|199|191)\d{8}$/'
      ];
      $itac = empty($this->data['itac'])?$this->data['countries']['itac']:$this->data['itac'];
      if (empty($regexp[$itac])) return true;
      preg_match_all($regexp[$itac],$this->data['phone'],$arr);
      return !empty($arr[1][0]);
   }
}
