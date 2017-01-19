<?php
/**
 * 全viewの共通コントローラ
 *
 * @package app
 */

class Controller_Base extends Controller_Template
{
    public function before()
    {
        parent::before();
        //header.phpをテンプレートの$headerとbindさせる。
        $this->template->header = View::forge('parts/header');
        //footer.phpをテンプレートの$footerとbindさせる。
        $this->template->footer = View::forge('parts/footer');
        
        Asset::css(
            array(
                'main.css',
                'style.css', 
                'bootstrap.min.css',
                'responsive.css',
                'font-awesome.min.css',
                'effects/set2.css',
                'effects/normalize.css',
                'effects/component.css',
            ), array(), 'add_css', false);
        
        Asset::js(
            array(
                'jquery.min.js', 
                'nav.js',
                'custom.js',
                'jquery.contact.js',
                'bootstrap.min.js',
                'effects/masonry.pkgd.min.js',
                'effects/imagesloaded.js',
                'effects/classie.js',
                'effects/AnimOnScroll.js',
                'effects/modernizr.custom.js',
                'html5shiv.js',
            ), array(), 'add_js', false);
    }

    public function after($response)
    {
        $response = parent::after($response); // あなた自身のレスポンスオブジェクトを作成する場合は必要ありません。
        return $response; // after() は確実に Response オブジェクトを返すように
    }
}