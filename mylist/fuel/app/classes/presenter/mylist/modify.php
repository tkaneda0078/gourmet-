<?php
/**
 * グルメ編集プレゼンタ
 *
 * @package app
 */
 
class Presenter_Mylist_modify extends Presenter
{
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
        
        // ゼロを消したかった
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
}