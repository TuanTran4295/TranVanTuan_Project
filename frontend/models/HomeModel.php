<?php 
	trait HomeModel{
		//tin tức nội bật
		public function modelHotProducts(){
			$conn = Connection::getInstance();
			$query = $conn->query("select * from products where hot = 1 order by id desc limit 0,6");
			$result = $query->fetchAll(PDO::FETCH_OBJ);
			return $result;

		}
		//danh mục sản phẩm
		public function modelCategories(){
			$conn = Connection::getInstance();
			//lấy các danh mục có sản phẩm bên trong
			$query = $conn->query("select * from categories where parent_id = 0 and id in (select category_id from products where categories.id = products.category_id) order by categories.id desc");
			$result = $query->fetchAll(PDO::FETCH_OBJ);
			return $result;
		}
		//các sản phẩm thuộc danh mục (kể cả sản phẩm của danh mục con thuộc danh mục đó)
		public function modelProducts($categoryId){
			$conn = Connection::getInstance();
			$query = $conn->query("select * from products where category_id in (select id from categories where id =$categoryId or parent_id = $categoryId)order by id desc limit 0,6");
			$result = $query->fetchAll(PDO::FETCH_OBJ);
			return $result;

		}
		//tin tức nổi bật
		public function modelHotNews(){
			$conn = Connection::getInstance();
			$query = $conn->query("select * from news where hot = 1 order by id desc limit 0,6");
			$result = $query->fetchAll(PDO::FETCH_OBJ);
			return $result;

		}

	}
 ?>