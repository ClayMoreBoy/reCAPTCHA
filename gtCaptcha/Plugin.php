<?php
/**
 * gtCaptcha验证码插件
 * 
 * @package gtCaptcha
 * @author 啸傲居士
 * @version 0.0.1
 * @link http://geaya.com
 */

require_once('SDK/geetestlib.php');

class gtCaptcha_Plugin implements Typecho_Plugin_Interface
{

    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     * 
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate() {
		Typecho_Plugin::factory('Widget_Feedback')->comment = array(__CLASS__, 'filter');
    }
    
    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     * 
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate() {}
    
    /**
     * 个人用户的配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form) {}
    
	/**
     * 获取插件配置面板
     * 
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
	public static function config(Typecho_Widget_Helper_Form $form) {
		$publickeyDescription = _t("To use GeeTest you must get an API key from <a href='http://www.geetest.com/'>http://www.geetest.com/</a>");
		$publickey = new Typecho_Widget_Helper_Form_Element_Text('publickey', NULL, '', _t('Public ID:'), $publickeyDescription);
		$privatekey = new Typecho_Widget_Helper_Form_Element_Text('privatekey', NULL, '', _t('Private Key:'), _t(''));
		
		$form->addInput($publickey);
		$form->addInput($privatekey);
	}
	
	/**
	 * 展示验证码
	 */
	public static function output() {
		$publickey = Typecho_Widget::widget('Widget_Options')->plugin('gtCaptcha')->publickey;
		
		echo geetest_get_html($publickey);
		
echo <<<EOF
		<label for="captcha">验证码<span class="required">*</span></label>
EOF;
	}
  
	public static function filter($comment, $obj) {
		$privatekey = Typecho_Widget::widget('Widget_Options')->plugin('gtCaptcha')->privatekey;
		$challenge = $_POST['geetest_challenge'];
		$validate = $_POST['geetest_validate'];
		$seccode = $_POST['geetest_seccode'];
		
		$geetest_response = geetest_check_answer($privatekey, $challenge, $validate, $seccode);
		$userObj = $obj->widget('Widget_User');
		
		if($userObj->hasLogin() && $userObj->pass('administrator', true)) {
			return $comment;
		}
		
		if (!$geetest_response) {
			throw new Typecho_Widget_Exception(_t('验证码不正确哦！'));
		}
		
		return $comment;
	}
}
