<?php 
	include "models/CartModel.php";
	class CartController extends Controller{
		use CartModel;
		//hàm tạo sử dụng để kiểm tra và khởi tạo giỏ hàng
		public function __construct(){
			if(isset($_SESSION["cart"]) == false) $_SESSION['cart'] = array();
		}
		//hiển thị dánh ách các sản phẩm trong giỏ hàng
		public function index(){
			$this->loadView("CartView.php");
		}
		//thểm sản phẩm vào giỏ hàng
		public function create(){
			$id = isset($_GET['productId']) ? $_GET['productId'] : 0;
			// gọi hàm trong CartModel.php để thêm phần tử vào giỏ hàng
			$this->cartAdd($id);
			//quay lại trang giỏ hàng
			header("location:index.php?controller=cart");
		}
		//xóa sản phẩm khỏi giỏ hàng
		public function delete(){
			$id = isset($_GET['productId']) ? $_GET['productId'] : 0;
			//gọi hàm trong model xóa phần tử khỏi giỏ hàng
			$this->cartDelete($id);
			//quay lại trang giỏ hàng
			header("location:index.php?controller=cart");
		}
		//xóa toàn bộ sản phẩm khỏi giỏ hàng
		public function destroy(){
			$this->cartDestroy();
			header("location:index.php?controller=cart");
		}
		//cập nhật số lượng tỏng giỏ hàng
		public function update(){
			foreach($_SESSION['cart'] as $product){
				$name = "product_".$product["id"];
				$number = $_POST[$name];
				$this->cartUpdate($product['id'],$number);
			}
			//quay lại trang giỏ hàng
			header("location:index.php?controller=cart");
		}
		//thanh toán giỏ hàng
		public function checkout(){
			//kiểm tra nếu user chưa đăng nhập thì yêu cầu đăng nhập
			if(isset($_SESSION['customer_email']) == false)	
				header("location:index.php?controller=account&action=login");
			else{
				//gọi hàm cartCheckOut trong CartModel
				$this->cartCheckOut();
				header("location:index.php?controller=cart&notify=order-success");
			}
		}
	}
 ?>