


<form action="?action=addPostAction" method="POST">
	User <?echo $data[0]["username"]?>: <input type="hidden" name="username" value="<? echo $data[0]['username']?>"/>
	Write a Post: <input size="115" style="padding-bottom:200px;" type="text" name="post" placeholder="Whats on your mind..."/>
	<input type="submit" name="submit" value="Post"/>
</form>
