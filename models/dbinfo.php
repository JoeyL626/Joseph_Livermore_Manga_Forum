<?
class dbinfo{

	public function checkLogin($email='',$passw=''){
	
		$user="root";
		$pass="root";
		$salt="Joeysendallbeallnogettingpasts.a.l.t.thatissecureascanbe";
		$dbh = new PDO('mysql:host=localhost;dbname=team_project;port=8889', $user, $pass);
		
		$st = $dbh->prepare("select userid, username from users where
						email = :em and password= :ps");
		
		$st->execute(array(":em"=>$email,":ps"=>md5($passw.$salt)));
		
		$result = $st->fetchAll();
		
		return $result;
	}
	
	public function addUser($email,$uname,$passw,$avatar){
		$user="root";
		$pass="root";
		$salt="Joeysendallbeallnogettingpasts.a.l.t.thatissecureascanbe";
		$dbh = new PDO('mysql:host=localhost;dbname=team_project;port=8889', $user, $pass);
		
		$st = $dbh->prepare("insert into users(email,username,password,avatar) values(:em,:un,:ps,:av)");
		$st->execute(array(":em"=>$email,":un"=>$uname,":ps"=>md5($passw.$salt),":av"=>$avatar));
		
	}
	
	public function updateUser($uid,$nname){
		$user="root";
		$pass="root";
		$dbh = new PDO('mysql:host=localhost;dbname=team_project;port=8889', $user, $pass);
		
		$st = $dbh->prepare("update users set username = :nu where userid = :uid");
		$st->execute(array(":nu"=>$nname,":uid"=>$uid));
	}

	public function updateAvatar($uid,$avatar){
		$user="root";
		$pass="root";
		$dbh = new PDO('mysql:host=localhost;dbname=team_project;port=8889', $user, $pass);
		
		$st = $dbh->prepare("update users set avatar = :av where userid = :uid");
		$st->execute(array(":av"=>$avatar,":uid"=>$uid));
	}
	
	public function deleteUser($uid){
		$user="root";
		$pass="root";
		$dbh = new PDO('mysql:host=localhost;dbname=team_project;port=8889', $user, $pass);
		
		$st = $dbh->prepare("delete from users where userid=:id");
		$st->execute(array(":id"=>$uid));
	
	}
	
	public function getUser($uid){
		$user="root";
		$pass="root";
		$dbh = new PDO('mysql:host=localhost;dbname=team_project;port=8889', $user, $pass);
	
		$st = $dbh->prepare("select * from users where userid=:id");
		$st->execute(array(":id"=>$uid));
		$result = $st->fetchAll();
		return $result;
	
	}

	public function getUsers(){

		$user="root";
		$pass="root";
		$dbh = new PDO('mysql:host=localhost;dbname=team_project;port=8889', $user, $pass);
	
		$st = $dbh->prepare("select username, email from users");
		$st->execute();
		$result = $st->fetchAll();
		return $result;
		
	}
	
	public function addPost($uname,$post){
		$user="root";
		$pass="root";
		$dbh = new PDO('mysql:host=localhost;dbname=team_project;port=8889', $user, $pass);
		
		$st = $dbh->prepare("insert into posts(username,post) values(:un,:pt)");
		$st->execute(array(":pt"=>$post,":un"=>$uname));
		
	}
	
	public function updatePost($pid,$post){
		$user="root";
		$pass="root";
		$dbh = new PDO('mysql:host=localhost;dbname=team_project;port=8889', $user, $pass);
		
		$st = $dbh->prepare("update posts set post = :pt where id=:id");
		$st->execute(array(":pt"=>$post,":id"=>$pid));
	
	}
	
	public function deletePost($pid){
		$user="root";
		$pass="root";
		$dbh = new PDO('mysql:host=localhost;dbname=team_project;port=8889', $user, $pass);
		
		$st = $dbh->prepare("delete from posts where id=:id");
		$st->execute(array(":id"=>$pid));
	
	}

	public function deletePosts($uname){
		$user="root";
		$pass="root";
		$dbh = new PDO('mysql:host=localhost;dbname=team_project;port=8889', $user, $pass);
		
		$st = $dbh->prepare("delete from posts where username=:un");
		$st->execute(array(":un"=>$uname));
	
	}
	
	public function getUserPosts($uname){
		$user="root";
		$pass="root";
		$dbh = new PDO('mysql:host=localhost;dbname=team_project;port=8889', $user, $pass);
	
		$st = $dbh->prepare("select * from posts where username=:un");
		$st->execute(array(":un"=>$uname));
		$result = $st->fetchAll();
		return $result;
	
	}
	
	public function getPosts(){

		$user="root";
		$pass="root";
		$dbh = new PDO('mysql:host=localhost;dbname=team_project;port=8889', $user, $pass);
	
		$st = $dbh->prepare("select * from posts order by time desc");
		$st->execute();
		$result = $st->fetchAll();
		return $result;
		
	}

	public function getUserPost($pid,$uname){
		$user="root";
		$pass="root";
		$dbh = new PDO('mysql:host=localhost;dbname=team_project;port=8889', $user, $pass);
	
		$st = $dbh->prepare("select * from posts where id=:id AND username=:un");
		$st->execute(array(":id"=>$pid,":un"=>$uname));
		$result = $st->fetchAll();
		return $result;
	
	}
}
?>