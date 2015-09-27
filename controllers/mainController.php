<?
include 'models/views.php';
include 'models/dbinfo.php';

$views = new views();
$dbinfo = new dbinfo();
session_start();

if(!empty($_GET["action"])){


	if($_GET["action"]=="login"){
		
		$data = $dbinfo->checkLogin($_POST["email"],$_POST["password"]);
	
		if($data){
			
			$_SESSION["isloggedin"] = 1;
			$_SESSION["userid"] = $data[0]["userid"];
			$_SESSION["postuser"] = $data[0]["username"];
			$data = $dbinfo->getUser($_SESSION["userid"]);
	 		$edata = $dbinfo->getUserPosts($_SESSION["postuser"]);
		
	 		$views->getView("views/header.php");
	 		$views->getView("views/profile.php",$data,$edata);
	 		$views->getView("views/footer.php");
		
		}else{

			session_unset(); 
			session_destroy();
			$views->getView("views/header.php");
			$views->getView("views/login_form.php");
			$views->getView("views/signup_form.php");
			$views->getView("views/footer.php");
		
		}
		
	
	}else if($_GET["action"]=="logout"){

		session_unset(); 
		session_destroy();
		$views->getView("views/header.php");
		$views->getView("views/login_form.php");
		$views->getView("views/signup_form.php");
		$views->getView("views/footer.php");

	}else if($_GET["action"]=="signUp"){

		$noRepeat = $dbinfo->getUsers();
		
		if(!empty($noRepeat)){
			foreach($noRepeat as $names){
				if($_POST["user"]==$names["username"] || $_POST["email"]==$names["email"] ){
					
					$same = "1";

				}elseif($_POST["user"]!=$names["username"] && $_POST["email"]!=$names["email"]){

					

				}
			}
		}

		if(isset($same)){
	 		$views->getView("views/header.php");
			$views->getView("views/login_form.php");
			$views->getView("views/signup_form.php");
			$views->getView("views/footer.php");
	 	}elseif(!isset($same)){
			$tmp_file = $_FILES['avatarfile']['tmp_name'];
    		$target_file = basename($_FILES['avatarfile']['name']);
    		$upload_dir = "uploads";
    		move_uploaded_file($tmp_file, $upload_dir."/".$target_file);
			$add = $dbinfo->addUser($_POST["email"],$_POST["user"],$_POST["password"],$target_file);
			$check = $dbinfo->checkLogin($_POST["email"],$_POST["password"]);
			
			if($check){
				
				$_SESSION["isloggedin"] = 1;
				$_SESSION["userid"] = $check[0]["userid"];
				$_SESSION["postuser"] = $check[0]["username"];
				$data = $dbinfo->getUser($_SESSION["userid"]);
	 			$edata = $dbinfo->getUserPosts($_SESSION["postuser"]);
				$views->getView("views/header.php");
	 			$views->getView("views/profile.php",$data,$edata);
	 			$views->getView("views/footer.php");
	
	 		} else{
	
	 			session_unset(); 
				session_destroy();
				$views->getView("views/header.php");
				$views->getView("views/login_form.php");
				$views->getView("views/signup_form.php");
				$views->getView("views/footer.php");
	
	 		}
	 	}

	}else if($_GET["action"]=="forum"){

		if(!isset($_SESSION["isloggedin"])){
	 		$views->getView("views/header.php");
			$views->getView("views/login_form.php");
			$views->getView("views/signup_form.php");
			$views->getView("views/footer.php"); 
	 	}else if($_SESSION["isloggedin"] == 1){
	
		$data = $dbinfo->getPosts();
		$views->getView("views/header.php");
		$views->getView("views/forum.php",$data);
		$views->getView("views/footer.php");
		}
		
	}else if($_GET["action"]=="addPost"){
		
		if(!isset($_SESSION["isloggedin"])){
	 		$views->getView("views/header.php");
			$views->getView("views/login_form.php");
			$views->getView("views/signup_form.php");
			$views->getView("views/footer.php"); 
	 	}else if($_SESSION["isloggedin"] == 1){

	 	$data = $dbinfo->getUser($_SESSION["userid"]);

		$views->getView("views/header.php");
		$views->getView("views/add_post.php",$data);
		$views->getView("views/header.php");
		}

	}else if($_GET["action"]=="addPostAction"){
		
		if(!isset($_SESSION["isloggedin"])){
	 		$views->getView("views/header.php");
			$views->getView("views/login_form.php");
			$views->getView("views/signup_form.php");
			$views->getView("views/footer.php"); 
	 	}else if($_SESSION["isloggedin"] == 1){

	 	$ndata = $dbinfo->addPost($_POST["username"],$_POST["post"]);
		$data = $dbinfo->getPosts();
		$views->getView("views/header.php");
		$views->getView("views/forum.php",$data);
		$views->getView("views/footer.php");
		}

	}else if($_GET["action"]=="profile"){
	 
	 	if(!isset($_SESSION["isloggedin"])){
	 		$views->getView("views/header.php");
			$views->getView("views/login_form.php");
			$views->getView("views/signup_form.php");
			$views->getView("views/footer.php"); 
	 	}else if($_SESSION["isloggedin"] == 1){

	 	$data = $dbinfo->getUser($_SESSION["userid"]);
	 	$edata = $dbinfo->getUserPosts($_SESSION["postuser"]);
	
	 	$views->getView("views/header.php");
	 	$views->getView("views/profile.php",$data,$edata);
	 	$views->getView("views/footer.php");
	 	}

	}else if($_GET["action"]=="updateUserButton"){
	
		if(!isset($_SESSION["isloggedin"])){
	 		$views->getView("views/header.php");
			$views->getView("views/login_form.php");
			$views->getView("views/signup_form.php");
			$views->getView("views/footer.php"); 
	 	}else if($_SESSION["isloggedin"] == 1){

	 	$data = $dbinfo->getUser($_SESSION["userid"]);
	 	$edata = $dbinfo->getUserPosts($_SESSION["postuser"]);
	
	 	$views->getView("views/user_update.php",$data,$edata);
	 	}

	}else if($_GET["action"]=="updateUserAction"){
	
		if(!isset($_SESSION["isloggedin"])){
	 		$views->getView("views/header.php");
			$views->getView("views/login_form.php");
			$views->getView("views/signup_form.php");
			$views->getView("views/footer.php"); 
	 	}else if($_SESSION["isloggedin"] == 1){

	 		$noRepeat = $dbinfo->getUsers();
			
			if(!empty($noRepeat)){
				foreach($noRepeat as $names){
					if($_POST["username"]==$names["username"]){
						
						$same = "1";
	
					}elseif($_POST["username"]!=$names["username"]){
	
						
	
					}
				}
			}
			
			if(isset($same)){
	 			$data = $dbinfo->getUser($_SESSION["userid"]);
	 			$edata = $dbinfo->getUserPosts($_SESSION["postuser"]);
	 			$views->getView("views/user_update.php",$data,$edata); 
				
	 		}elseif(!isset($same)){
	 			$ndata = $dbinfo->updateUser($_SESSION["userid"],$_POST["username"]);
	 			$data = $dbinfo->getUser($_SESSION["userid"]);
	 			$edata = $dbinfo->getUserPosts($_SESSION["postuser"]);
			
	 			$views->getView("views/header.php");
	 			$views->getView("views/profile.php",$data,$edata);
	 			$views->getView("views/footer.php");
	 		}
	 	}

	}else if($_GET["action"]=="updateAvatarAction"){
	
		if(!isset($_SESSION["isloggedin"])){
	 		$views->getView("views/header.php");
			$views->getView("views/login_form.php");
			$views->getView("views/signup_form.php");
			$views->getView("views/footer.php"); 
	 	}else if($_SESSION["isloggedin"] == 1){

	 	$tmp_file = $_FILES['avatarfile']['tmp_name'];
    	$target_file = basename($_FILES['avatarfile']['name']);
    	$upload_dir = "uploads";
    	move_uploaded_file($tmp_file, $upload_dir."/".$target_file);
	 	$ndata = $dbinfo->updateAvatar($_SESSION["userid"],$target_file);
	 	$data = $dbinfo->getUser($_SESSION["userid"]);
	 	$edata = $dbinfo->getUserPosts($_SESSION["postuser"]);
	
	 	$views->getView("views/header.php");
	 	$views->getView("views/profile.php",$data,$edata);
	 	$views->getView("views/footer.php");
	 	}

	}else if($_GET["action"]=="deleteUserButton"){
	
		if(!isset($_SESSION["isloggedin"])){
	 		$views->getView("views/header.php");
			$views->getView("views/login_form.php");
			$views->getView("views/signup_form.php");
			$views->getView("views/footer.php"); 
	 	}else if($_SESSION["isloggedin"] == 1){

	 	$data = $dbinfo->getUser($_SESSION["userid"]);
	 	$edata = $dbinfo->getUserPosts($_SESSION["postuser"]);
	
	 	$views->getView("views/user_delete.php",$data,$edata);
	 	}

	}else if($_GET["action"]=="deleteUserAction"){
	
		if(!isset($_SESSION["isloggedin"])){
	 		$views->getView("views/header.php");
			$views->getView("views/login_form.php");
			$views->getView("views/signup_form.php");
			$views->getView("views/footer.php"); 
	 	}else if($_SESSION["isloggedin"] == 1){

	 	
	 	$edata = $dbinfo->deleteUser($_SESSION["userid"]);
	 	session_unset(); 
		session_destroy();
	
	 	$views->getView("views/header.php");
		$views->getView("views/login_form.php");
		$views->getView("views/signup_form.php");
		$views->getView("views/footer.php");
		}
	
	}else if($_GET["action"]=="updatePostButton"){
	
		if(!isset($_SESSION["isloggedin"])){
	 		$views->getView("views/header.php");
			$views->getView("views/login_form.php");
			$views->getView("views/signup_form.php");
			$views->getView("views/footer.php"); 
	 	}else if($_SESSION["isloggedin"] == 1){

	 	$data = $dbinfo->getUser($_SESSION["userid"]);
	 	$edata = $dbinfo->getUserPosts($_SESSION["postuser"]);
	 	$udata = $dbinfo->getUserPost($_GET["id"],$_SESSION["postuser"]);
	
	 	$views->getView("views/post_update.php",$data,$edata,$udata);
	 	}

	}else if($_GET["action"]=="updatePostAction"){
	
		if(!isset($_SESSION["isloggedin"])){
	 		$views->getView("views/header.php");
			$views->getView("views/login_form.php");
			$views->getView("views/signup_form.php");
			$views->getView("views/footer.php"); 
	 	}else if($_SESSION["isloggedin"] == 1){

	 	echo$_POST["pid"];
	 	echo$_POST["post"];

	 	$ndata = $dbinfo->updatePost($_POST["pid"],$_POST["post"]);
	 	$data = $dbinfo->getUser($_SESSION["userid"]);
	 	$edata = $dbinfo->getUserPosts($_SESSION["postuser"]);
	
	 	$views->getView("views/header.php");
	 	$views->getView("views/profile.php",$data,$edata);
	 	$views->getView("views/footer.php");
	 	}

	}else if($_GET["action"]=="deletePostButton"){
	
		if(!isset($_SESSION["isloggedin"])){
	 		$views->getView("views/header.php");
			$views->getView("views/login_form.php");
			$views->getView("views/signup_form.php");
			$views->getView("views/footer.php"); 
	 	}else if($_SESSION["isloggedin"] == 1){

	 	$ndata = $dbinfo->deletePost($_GET["id"]);
	 	$data = $dbinfo->getUser($_SESSION["userid"]);
	 	$edata = $dbinfo->getUserPosts($_SESSION["postuser"]);
	
	 	$views->getView("views/header.php");
	 	$views->getView("views/profile.php",$data,$edata);
	 	$views->getView("views/footer.php");
		}
	}else if($_GET["action"]=="backButton"){
	
		if(!isset($_SESSION["isloggedin"])){
	 		$views->getView("views/header.php");
			$views->getView("views/login_form.php");
			$views->getView("views/signup_form.php");
			$views->getView("views/footer.php"); 
	 	}else if($_SESSION["isloggedin"] == 1){

	 	$data = $dbinfo->getUser($_SESSION["userid"]);
	 	$edata = $dbinfo->getUserPosts($_SESSION["postuser"]);
	
	 	$views->getView("views/header.php");
	 	$views->getView("views/profile.php",$data,$edata);
	 	$views->getView("views/footer.php");
		}
	}
	
}else{

    $views->getView("views/header.php");
	$views->getView("views/login_form.php");
	$views->getView("views/signup_form.php");
	$views->getView("views/footer.php");

}

?>