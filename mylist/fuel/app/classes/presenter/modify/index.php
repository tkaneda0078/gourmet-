<?php
/**
 * 店舗情報の更新を行うプレゼンタクラス
 * 
 * @author tkaneda
 * @package Presenter
 */
class Presenter_Modify_index extends Presenter
{
    /**
     * 店舗IDを元に店舗情報を取得
     *
     * 
     * @access public
     */
    public function view()
    {
        $shop_data = array();
        $img_paths  = array();
        
        $data = \DB::select('name', 'address', 'comments', 'shop_photo_id')
            ->from(\Model_shop_data::table())
            ->where('id', $this->shop_id)
            ->execute()->as_array();

        $photos = \DB::select('saved_to')
            ->from(\Model_shop_Photo::table())
            ->where('shop_id', $data[0]['shop_photo_id'])
            ->execute()->as_array();
        
        // 配列の階層を変更
        foreach ($data[0] as $key => $val)
        {
            $shop_data[$key] = $val;
        }
        
        foreach ($photos as $val)
        {
            $img_paths[] = $val['saved_to'];
        }

        $this->set('shop_data', $shop_data);
        $this->set('img_paths', $img_paths);
    }
    
    /**
	 * 店舗情報を更新する
	 *
	 * 
	 * @access public
	 * @throws HttpServerErrorException
	 */
	public function shop_update()
	{
	    \DB::start_transaction();
	    
        try
        {
            $shop_id = Session::get_flash('shop_id');
            
            $query = Model_Shop_data::find($shop_id);
            $query->set(array(
                'name'     => $this->shop_data['name'],
                'address'  => $this->shop_data['address'],
                'comments' => $this->shop_data['comments'],
            ));
        
            if ( ! $query->save())
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