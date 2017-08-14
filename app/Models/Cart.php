<?php
	
namespace App\Models;

class Cart
{
	public $items = null;
	public $totalQty = 0;
	public $totalPrice = 0;

	public function __construct($oldCart){
		if($oldCart){
			$this->items = $oldCart->items;
			$this->totalQty =$oldCart->totalQty;
			$this->totalPrice = $oldCart->totalPrice;
		}
	}

	public function add($item, $id, $quantily){
		$price_current = 0;
		if($item->promotion_price == 0){
			$price_current = $item->unit_price;
		}else{
			$price_current = $item->promotion_price;
		}
		$giohang = ['qty'=>$quantily, 'price'=>$price_current, 'item'=>$item];
		if($this->items){
			if(array_key_exists($id, $this->items)){
				$giohang = $this->items[$id];
				$giohang['qty'] += $quantily;
			}else{
				$giohang['qty'] = $quantily;
			}
		}
		$giohang['price'] = $price_current * $giohang['qty'];
		$this->items[$id] = $giohang;
		$this->totalQty += $quantily;
		$this->totalPrice += ($price_current * $quantily);
	}

	public function reduceByOne($id){
		$this->items[$id]['qty']--;
		$this->items[$id]['price'] -= $this->item[$id]['item']['price'];
		$this->totalQty--;
		$this->totalPrice -=$this->items[$id]['item']['price'];
		if($this->items[$id]['qty']<=0){
			unset($this->items[$id]);
		}
	}

	public function removeItem($id){
		$this->totalQty -= $this->items[$id]['qty'];
		$this->totalPrice -= $this->items[$id]['price'];
		unset($this->items[$id]);
	}
}
?>