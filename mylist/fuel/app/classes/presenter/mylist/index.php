<?php
/**
 * グルメ取得、登録プレゼンタ
 *
 * @package app
 */
 
 /**
 * グルメ情報を取得、登録
 */
class Presenter_Mylist_index extends Presenter
{
    protected static $model = '\Model_Shop_data';
    
    public function view()
    {
        // 登録済みのお店情報を全件取得
        $gourmet_list = \DB::select('a.id', 'a.shop_photo_id', 'a.name', 'a.address', 'a.comments', 'b.saved_to')
            ->from(array(\Model_Shop_data::table(), 'a'))
            ->join(array(\Model_Shop_Photo::table(), 'b'))
            ->on('a.shop_photo_id', '=', 'b.shop_id')
            ->group_by('shop_photo_id')
            ->execute()->as_array();

        $this->set('gourmet_list', $gourmet_list);
        
    }
    
    public function shop_register()
    {
        \DB::start_transaction();

        try
        {
            // shop_id最大値を取得
            $max_shop_photo_id = DB::select(DB::expr('MAX(shop_photo_id) as max_id'))
                ->from('shop_data')
                ->execute()->as_array();

            $max_shop_photo_id = $max_shop_photo_id[0]['max_id'] + 1;
            
            $shop_data = Model_Shop_Data::forge(array(
                'shop_photo_id' => $max_shop_photo_id,
                'gnavi_shop_id' => $this->gnavi_shop_id,
                'name'          => $this->shop_data['name'],
                'address'       => $this->shop_data['address'],
                'comments'      => $this->shop_data['comments'],
                'release_flag'  => 1,
            ));

            $data = Session::get('photo_data');
            
            $photo_data = Model_Shop_Photo::forge(array(
                'shop_id'      => $max_shop_photo_id,
                'name'         => $data['name'],
                'type'         => $data['type'],
                'size'         => $data['size'],
                'saved_to'     => $this->img_path,
                'release_flag' => 1,
                // 'created_at'   => Date::time()->format('mysql'),
            ));
            
            
            if ( ! $shop_data->save())
            {
                \DB::rollback_transaction();
                return false;
            }
            
            if ( ! $photo_data->save())
            {
                \DB::rollback_transaction();
                return false;
            }

            Session::destroy();

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