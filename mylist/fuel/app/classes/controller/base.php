<?php
/**
 * 全viewに共通する処理を行うコントローラークラス
 * 
 * クライアントサイドを統一にさせる。
 * 
 * @author tkaneda
 * @package Controller
 */

class Controller_Base extends Controller_Template
{
    /**
     * 全viewを統一にする。
     *
     * どのコントローラーが呼びだされた時に。
     * このコンストラクタが呼び出される。
     * 
     * @access public
     */
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

}