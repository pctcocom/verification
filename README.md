# verification

您可以使用Captcha创建一个验证码：
```
use Pctco\Verification\Captcha\Captcha;

$builder = new Captcha;
$builder->build();
```


然后可以将其保存到文件中 :
```
$builder->save('out.jpg');
```

或直接输出 :
```
header('Content-type: image/jpeg');
$builder->output();
```

或直接在HTML页面中内联 :
```
<img src="<?php echo $builder->inline(); ?>" />
```


您将能够获取代码并将其与用户输入进行比较 :
```
// Example: storing the phrase in the session to test for the user
// input later
$_SESSION['phrase'] = $builder->getPhrase();
```

您可以将短语与用户输入进行比较 :
```
if($builder->testPhrase($userInput)) {
    // instructions if user phrase is good
}
else {
    // user phrase is wrong
}
```

API
===

You can use theses functions :

* **__construct($phrase = null)**, 使用给定的短语构造构建器，如果该短语为null，则将生成一个随机的短语
* **getPhrase()**, 允许您获取短语内容
* **setDistortion($distortion)**, 启用或禁用失真，请在调用之前 `build()`
* **isOCRReadable()**, 如果可以使用`true`软件读取OCR，则返回`ocrad`，则需要启用shell_exec，安装imagemagick和ocrad
* **buildAgainstOCR($width = 150, $height = 40, $font = null)**, 生成一个代码，直到它不被可读为止 `ocrad`
* **build($width = 150, $height = 40, $font = null)**, 使用给定的 $width，$height和$font构建代码。 默认情况下，库中将使用随机字体
* **save($filename, $quality = 80)**, 将jpeg验证码以给定的质量保存到$filename中
* **get($quality = 80)**, 返回jpeg数据
* **output($quality = 80)**, 直接将jpeg代码输出到浏览器
* **setBackgroundColor($r, $g, $b)**, 设置强制使用的背景颜色（这将禁用许多效果，不建议使用）
* **setBackgroundImages(array($imagepath1, $imagePath2))**, 设置用作验证码背景的自定义背景图像。 当传递自定义图像作为背景时，建议禁用图像效果（ignore_all_effects）。 从传递的列表中选择一个随机图像，必须传递图像文件的完整路径。
* **setInterpolation($interpolate)**, 启用或禁用插值（默认情况下启用），禁用插值会更快，但是图像看起来更难看
* **setIgnoreAllEffects($ignoreAllEffects)**, 禁用对验证码图像的所有效果。 建议在为验证码传递自定义背景图像时使用。
* **testPhrase($phrase)**, 如果给定的短语是好的，则返回true
* **setMaxBehindLines($lines)**, 设置代码后面的最大行数
* **setMaxFrontLines($lines)**, 设置代码前面的最大行数

如果要更改字符数，可以直接使用以下命令调用词组生成器
额外参数：

```php
use Pctco\Verification\Captcha\Captcha;
use Pctco\Verification\Captcha\Phrase;

// 将建立3个字元的词组
$phraseBuilder = new Phrase(4)

// 将建立由5个字符组成的词组，仅包含数字
$phraseBuilder = new Phrase(5, '0123456789');

// 将其作为Captcha的第一个参数传递，将其传递给短语
// 建造者
$captcha = new Captcha(null, $phraseBuilder);
```

You can also pass directly the wanted phrase to the builder:

```php
// 使用“ hello”短语构建验证码
$captcha = new Captcha('hello');
```



## v1.0.0
