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
    /**
     * 登録済みの全店舗情報を取得する関数
     *
     * 店舗IDをもとに店舗情報の取得を行う。
     * 
     * @access public
     */
    public function view()
    {
        $data = \DB::select(
            'a.id', 
            'a.name', 
            'a.address',
            'a.comments',
            \DB::expr('CASE WHEN a.gnavi_id IS NOT NULL THEN g.url ELSE NULL END as "url"'),
            \DB::expr('CASE WHEN g.image IS NOT NULL THEN g.image ELSE b.saved_to END as "image"')
            )
			->from(array(\Model_Shop_data::table(), 'a'))
		    ->join(array(\Model_Shop_Photo::table(), 'b'), 'LEFT')
			->on('a.shop_photo_id', '=', 'b.shop_id')
			->join(array(\Model_Gnavi_data::table(), 'g'), 'LEFT')
			->on('a.gnavi_id', '=', 'g.gnavi_shop_id')
			->where('a.id', $this->shop_id)
			->execute()->as_array();
        
        $shop_data  = array();
        // 配列の階層を変更
        foreach ($data[0] as $key => $val)
        {
            $shop_data[$key] = $val;
        }

        $this->set('shop_data', $shop_data);
        $this->set('shop_id', $this->shop_id);
        
    }
}