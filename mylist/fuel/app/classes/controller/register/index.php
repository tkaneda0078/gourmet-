<?php
/**
 * グルメ登録コントローラ
 *
 * @package app
 */

class Controller_Register_index extends Controller_Base
{
    // 入力フォームで扱うフィールドを配列として設定
    private $fields = array('name', 'address', 'comments');

    private $error_count = 0;
    
    public function action_index()
	{
	    $this->template->content = View::forge('register/index');
	}

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
            $this->error_count++;
            foreach ($val->error() as $key => $error)
            {
                $data['error_msg'][$key] = $error->get_message();
            }
        }
        
        // アップロード処理を実行
        $result = $this->upload_process();

        if ( ! is_null($result))
        {
            $data['error_msg']['photo'] = $result;
        }

        if ($this->error_count != 0)
        {
            $this->template->content = View::forge('register/index', $data);
            return;
        }
        
	    Response::redirect('register/confirm');
	}
	
	/**
     * 確認画面
     *
     * 
     */
	public function action_confirm()
	{
	    $data = array();

	    foreach ($this->fields as $field)
	    {
	        $data[$field] = Session::get_flash($field);

	        // セッション変数を次のリクエストを維持
	        Session::keep_flash($field);
	    }
	    
	    //ぐるなび情報取得
	    $gnavi_info = Model_Shop_Data::getGnaviInfo($data);
	    
	    $gnavi_info['opentime'] = str_replace('<BR>', '  ', $gnavi_info['opentime']);

	    $data = array_merge($data, $gnavi_info);
	    
	    // ぐるなび店舗ID
	    Session::set_flash('gnavi_shop_id', $gnavi_info['id']);

	    // 画像のパス
	    // upload_photos/4.png　例
	    $data['img_path'] = Session::get_flash('img_path');
	    Session::keep_flash('img_path');
	    
	    $this->template->content = View::forge('register/confirm', $data);

	   // return Response::forge(View::forge('register/confirm', $data));
	}
	
	/**
     * 登録完了
     *
     * 
     */
    public function action_complete()
    {
        $this->template->content = Presenter::forge('mylist/index', 'shop_register')
            ->set('shop_data', Input::post())
            ->set('gnavi_shop_id', Session::get_flash('gnavi_shop_id'))
            ->set('img_path', Session::get_flash('img_path'));
    }
	
    /**
     * 写真アップロード処理
     *
     * 
     */
    protected function upload_process()
    {
        $config = array(
            'path' => DOCROOT.'assets/img/avana/upload_photos',
            'randomize' => false,
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
                $photo_data['name']         = $file['basename'];
                $photo_data['type']         = $file['type'];
                $photo_data['size']         = $file['size'];
                
                // $photo_data = Model_Shop_Photo::forge(array(
                //     'name'         => $file['basename'],
                //     'type'         => $file['type'],
                //     'size'         => $file['size'],
                //     'saved_to'     => $file['saved_to'],
                //     'release_flag' => 1,
                //     // 'created_at'   => Date::time()->format('mysql'),
                // ));
                // debug::dump($file);
                // debug::dump($photo_data);
                // exit;

                if (isset($file['saved_as']))
                {
                    Session::set_flash('img_path', 'upload_photos/'.$file['saved_as']);
                }
                
                // 設定を元にDBに保存
                // DBに保存するときは、写真のパス(upload_photos/4.png)で保存する
                // if ( ! $photo->save())
                // {
                //     $this->error_count++;
                //     $data['error_msg']['upload'] = '再度アップロードをして下さい。';
                // }
            }
            
            // 登録時に使用
            Session::set('photo_data', $photo_data);
        }
        
        foreach (Upload::get_errors() as $file)
        {
            $this->error_count++;
            return $file['errors'][0]['message'];
        }
        
        return;
    }
    
    


}