<?php 
	//load file model
	include "models/HomeModel.php";
	class HomeController extends Controller{
		//kế thừa model
		use HomeModel;
		public function index(){
			$this->loadView("HomeView.php");
		}
	}
 ?>