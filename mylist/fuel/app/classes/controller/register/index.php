<?php
/**
 * 店舗登録コントローラークラス
 * 
 * 店舗登録の処理全般を実行する。
 * 
 * @author tkaneda
 * @package Controller
 */
class Controller_Register_index extends Controller_Base
{
    // 入力フォームで扱うフィールドを配列として設定
    private $fields = array('name', 'address', 'comments');
    
    /**
     * 店舗登録画面を表示させる関数
     *
     * viewを呼び出す
     * 
     * @access public
     */
    public function action_index()
	{
	    $this->template->content = View::forge('register/index');
	}

    /**
     * [POST]店舗情報を処理する関数
     *
     * 入力された店舗情報のバリデーションチェックを行う。
     * 入力に問題がない場合は、下部のaction_confirm関数を実行する。
     * 
     * @access public
     * @return array $data エラーメッセージ （バリデーションチェックに引っ掛かった場合）
     * @see Controller_Register_index::action_confirm
     */
	public function post_index()
	{
	    // 各データのpost値をフラッシュセッションに保存
	    foreach ($this->fields as $field)
	    {
	        Session::set_flash($field, Security::xss_clean(Input::post($field)));
	    }

        // エラーメッセージ用
        $data = array();
        
        $val = Model_Shop_Data::validate();

        if ( ! $val->run())
        {
            foreach ($val->error() as $key => $error)
            {
                $data['error_msg'][$key] = $error->get_message();
            }
        }
        
        // 画像アップロード処理を実行
        $result = $this->upload_process();

        if ( ! is_null($result))
        {
            $data['error_msg']['photo'] = $result;
        }

        if ( ! empty($data['error_msg']))
        {
            $this->template->content = View::forge('register/index', $data);
            return;
        }
        
	    Response::redirect('register/confirm');
	}
	
	/**
     * 店舗登録確認画面へ値を渡す処理を行う関数
     *
     * 入力された店舗情報をもとにぐるなびAPIを実行して、
     * より詳細な店舗情報を取得する。
     * 
     * @access public
     */
	public function action_confirm()
	{
	    $data = array();

	    foreach ($this->fields as $field)
	    {
	        $data[$field] = Session::get_flash($field);

	        Session::keep_flash($field);
	    }

	    $data['img_path'] = Session::get_flash('img_path');
	    Session::keep_flash('img_path');
	    
	    $this->template->content = View::forge('register/confirm', $data);
	}
	
    /**
     * [POST]店舗情報をDBに登録処理を行う関数
     *
     * POST値、SESSION値をプレゼンタに渡し、
     * プレゼンタで店舗情報登録処理を行う。
     * 
     * @access public
     * @see Presenter_Mylist_index::shop_register
     */
    public function action_complete()
    {
        $this->template->content = Presenter::forge('mylist/index', 'shop_register')
            ->set('shop_data', Input::post())
            ->set('img_path', Session::get_flash('img_path'));
    }
	
    /**
     * 店舗画像アップロード処理を行う関数
     * 
     * @access protected
     * @todo 未対応（画像登録日時を日本時間に設定）
     */
    private function upload_process()
    {
        // 画像の保存先を取得
        $data = $this->getDirectoryName();
        
        $config = array(
            'path'          => $data['save_dir'],
            'randomize'     => false,
            'ext_whitelist' => array('img', 'jpg', 'jpeg', 'png'),
        );
        
        // アップロードを実行
        Upload::process($config);

        if (Upload::is_valid())
        {
            $photo_data = array();
            
            // 設定を元に保存
            Upload::save();

            foreach (Upload::get_files() as $file)
            {
                $photo_data['name'] = $file['basename'];
                $photo_data['type'] = $file['type'];
                $photo_data['size'] = $file['size'];
                
                if (isset($file['saved_as']))
                {
                    Session::set_flash('img_path', 'save/upload_photos' . $data['num'] . '/' . $file['saved_as']);
                }
            }
            
            // 店舗画像を登録時に使用
            Session::set('photo_data', $photo_data);
        }
        
        foreach (Upload::get_errors() as $file)
        {
            return $file['errors'][0]['message'];
        }
        
        return;
    }
    
     /**
     * 画像の保存先を取得
     * 
     * 画像の保存先を取得する。
     * また、保存先の画像枚数を数えて、
     * 指定した保存量を超えた場合に保存先を変更する。
     * 
     * @access private
     * @return array
     */
    private function getDirectoryName()
    {
        $data = array();
        
        $parent_dir = DOCROOT.'assets/img/gourmet/save';
        $child_dir  = $parent_dir . '/upload_photos'; // 画像保存先（デフォルト）
        
        // 親ディレクトリ配下のディレクトリ数をカウント
        $parent_num = count(scandir($parent_dir)) - 2;
        
        //初回と２回目
        if ($parent_num == 1)
        {
            // 子ディレクトリ配下の画像枚数をカウント
            $child_num = count(scandir($child_dir)) - 2;
            $data['num'] = '';
            $flag = true;
        }
        else
        {
            $parent_num -= 1;
            // 子ディレクトリ配下の画像枚数をカウント
            $child_num = count(scandir($child_dir . $parent_num)) - 2;
            $data['num'] = $parent_num += 1;
        }
        
        // 指定保存量を超えたときに保存先を変更
        if ($child_num >= 20)
        {
            if (isset($flag))
            {
                $data['num'] = 1;
            }
            
            $child_dir = $child_dir . $parent_num;
        }
        $data['save_dir'] = $child_dir;
        
        return $data;
    }


}