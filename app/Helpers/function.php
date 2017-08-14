<?php
	function menuMulti($data, $parent_id = 0, $str="---|", $select){
		foreach($data as $val){
			$id = $val["id"];
			$name = $val["name"];
			if($val["parent_id"] == $parent_id){
				if($select !=0 && $id == $select){
					echo '<option value="'.$id.'" selected>'.$str." ".$name.'</option>';
				}else{
					echo '<option value="'.$id.'">'.$str." ".$name.'</option>';
				}
				menuMulti($data, $id, $str." ---|", $select);
			}
		}
	}

	function menuProMulti($data, $parent_id = 0, $str="---|", $select){
		foreach($data as $val){
			$id = $val["id"];
			$name = $val["name"];
			if($val["parent_id"] == $parent_id){
				if($select !=0 && $id == $select){
					echo '<option value="'.$select.'" selected>'.$str." ".$name.'</option>';
				}else{
					echo '<option value="'.$id.'">'.$str." ".$name.'</option>';
				}
				menuMulti($data, $id, $str." ---|", $select);
			}
		}
	}

	function listCate($data, $parent = 0, $str= ""){
		foreach ($data as $val) {
			$id = $val["id"];
			$name = $val["name"];
			if($val["parent_id"] == $parent){
				echo '<tr id="del-cate-'.$id.'">';
			        if($str == ""){
			        	echo '<td><b>'.$str." ".$val["name"].'</b></td>';
			        }else{
			        	echo '<td>'.$str." ".$val["name"].'</td>';
			        }
			        echo '<td>
				            <a href="admin/the-loai/edit/'.$id.'"><img src="../public/source/assets/admin/img/edit.png" /></a>&nbsp;&nbsp;&nbsp;
				            <a href="admin/the-loai/del/'.$id.'" class="del-cate" data-cateid = "'.$id.'" ><img src="../public/source/assets/admin/img/delete.png" /></a>
				        </td>
				    </tr>';
				listCate($data, $id, $str." ---|");
			}
		}
	}

	function subMenu($data, $id){
		echo "<ul class='sub-menu'>";
			foreach($data as $item){
				if($item['parent_id'] == $id){
					echo '<li><a href="loai-san-pham/'.$item["id"].'/'.$item["alias"].'">'.$item["name"].'</a>';
						subMenu($data, $item['id']);
					echo '</li>';
				}
			}
		echo "</ul>";
	}

	function subTotal($qty, $price){
		$sum = $qty * $price;
		return $sum;
	}
?>