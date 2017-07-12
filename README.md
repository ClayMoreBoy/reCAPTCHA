[typecho][1]验证码插件，使用Google的[reCAPTCHA v2][2]接口
======

#### 使用方法：
1. 到「[页面][3]」申请一个API key；
2. 下载并安装所需部件：
```
    git clone https://github.com/D-Bood/reCAPTCHA.git
    cd reCAPTCHA/lib
    composer install
```
3. 激活该插件，并配置site key和secret key；
4. 在主题（comments.php）的适当地方（通常是在`<form>`标签内）添加如下代码：
```
    <div class="g-recaptcha" data-sitekey="your site key"></div>
    <script type="text/javascript" 
        src="https://www.google.com/recaptcha/api.js?hl=zh-CN">
    </script>
```
5. 找到提交评论的按钮，添加`value="Submit"`属性

[1]: http://typecho.org/about

[2]: https://github.com/google/recaptcha

[3]: https://www.google.com/recaptcha/admin/create
