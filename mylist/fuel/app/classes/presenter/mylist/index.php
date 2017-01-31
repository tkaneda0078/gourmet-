<?php
/**
 * 店舗情報に関する処理を行うプレゼンタクラス
 * 
 * コントローラから呼び出されて、店舗情報をもとに、
 * 店舗情報を取得、登録を行う。
 * 
 * @author tkaneda
 * @package Presenter
 */
class Presenter_Mylist_index extends Presenter
{
	protected static $model = '\Model_Shop_data';
	
	/**
	 * 登録済みの全店舗情報を取得する関数
	 *
	 * 全店舗情報を取得後にviweに情報を渡す。
	 * 
	 * @access public
	 */
	public function view()
	{
		$gourmet_list = \DB::select('a.id', 'a.name', 'a.address', 'b.saved_to', 'g.image')
			->from(array(\Model_Shop_data::table(), 'a'))
			->join(array(\Model_Shop_Photo::table(), 'b'), 'LEFT')
			->on('a.shop_photo_id', '=', 'b.shop_id')
			->join(array(\Model_Gnavi_data::table(), 'g'), 'LEFT')
			->on('a.gnavi_id', '=', 'g.gnavi_shop_id')
			->order_by('a.id', 'desc')
			->execute()->as_array();

		$this->set('gourmet_list', $gourmet_list);
		
	}
	
	/**
	 * ユーザーによって入力された店舗情報を登録する関数
	 *
	 * コントローラーから渡された値をDBに登録する。
	 * 
	 * @access public
	 * @return Controller_Mylist::action_index
	 * @throws HttpServerErrorException
	 * @todo 未対応（登録日時を日本時間にする）
	 */
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