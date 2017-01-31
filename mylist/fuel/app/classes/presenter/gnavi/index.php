<?php
/**
 * gnavi店舗情報に関する処理を行うプレゼンタクラス
 * 
 * コントローラから呼び出されて、店舗情報をもとに、
 * 店舗情報の登録を行う。
 * 
 * @author tkaneda
 * @package Presenter
 */
class Presenter_Gnavi_index extends Presenter
{
    public function view()
    {
           
    }
    
    /**
     * ユーザーによって選択された店舗情報を登録する関数
     *
     * コントローラーから渡された値をDBに登録する。
     * 
     * @access public
     * @return Controller_Mylist::action_index
     * @throws HttpServerErrorException
     * @todo 未対応（登録日時を日本時間にする）
     */
    public function register()
    {
        \DB::start_transaction();

        try
        {
            $shop_data = Model_Shop_Data::forge(array(
                'gnavi_id'      => $this->gnavi_data['id'],
                'name'          => $this->gnavi_data['name'],
                'address'       => $this->gnavi_data['address'],
                'comments'      => null,
                'release_flag'  => 1,
            ));
            
            $gnavi_data = Model_Gnavi_Data::forge(array(
                'gnavi_shop_id' => $this->gnavi_data['id'],
                'name'          => $this->gnavi_data['name'],
                'address'       => $this->gnavi_data['address'],
                'url'           => $this->gnavi_data['url'],
                'image'         => $this->gnavi_data['image'],
                'release_flag'  => 1,
            ));
            
            if ( ! $shop_data->save())
            {
                \DB::rollback_transaction();
                return false;
            }

            if ( ! $gnavi_data->save())
            {
                \DB::rollback_transaction();
                return false;
            }

            \DB::commit_transaction();
        }
        catch (\Exception $e)
        {
            \DB::rollback_transaction();
            echo "The exception was created on line: " . $e->getLine();
            echo $e->getFile();
            echo '<br>';
            echo $e->getMessage();
            throw new HttpServerErrorException;
        }
        
        return Response::redirect('mylist');
    }
}