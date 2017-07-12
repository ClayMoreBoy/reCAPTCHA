[typecho][1]验证码插件，使用Google的[reCAPTCHA v2][2]接口
======

#### 使用方法：
1. 到「[页面][3]」申请一个API key；
2. 激活该插件，并配置site key和secret key；
3. 在主题的适当地方（通常是在评论栏的表单处）添加如下代码：
```
    <div class="g-recaptcha" data-sitekey="<?php echo $siteKey; ?>"></div>
    <script type="text/javascript" 
        src="https://www.google.com/recaptcha/api.js?hl=zh-CN">
    </script>
```
4. 找到提交评论的按钮，添加`value="Submit"`属性

[1]: http://typecho.org/about

[2]: https://www.google.com/recaptcha/

[3]: https://www.google.com/recaptcha/admin/create
