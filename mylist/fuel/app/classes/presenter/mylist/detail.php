<?php
/**
 * 登録済みの店舗情報の取得を行うプレゼンタクラス
 * 
 * コントローラから呼び出されて、店舗IDをもとに、
 * 店舗情報を取得を行う。
 * 
 * @author tkaneda
 * @package Presenter
 */
class Presenter_Mylist_Detail extends Presenter
{
    protected static $model = '\Model_Shop_data';
    
    /**
     * 登録済みの全店舗情報を取得する関数
     *
     * 店舗IDをもとに店舗情報の取得を行う。
     * 
     * @access public
     */
    public function view()
    {
        $shop_data  = array();
        $gnavi_data = array();
        $img_paths  = array();
        
        $data = \DB::select('gnavi_shop_id', 'name', 'address', 'comments', 'shop_photo_id')
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

        if ( ! empty($shop_data['gnavi_shop_id']))
        {
            // ぐるなび情報を取得
            $gnavi_data = Model_Shop_Data::getGnaviInfo($shop_data, $shop_data['gnavi_shop_id']);
            $gnavi_data['opentime'] = str_replace('<BR>', '  ', $gnavi_data['opentime']);
        }
        
        foreach ($photos as $val)
        {
            $img_paths[] = $val['saved_to'];
        }

        $this->set('shop_data', $shop_data);
        $this->set('gnavi_data', $gnavi_data);
        $this->set('img_paths', $img_paths);
        $this->set('shop_id', $this->shop_id);
        
    }
}