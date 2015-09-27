<?
// DO NOT CHANGE THE STYLES ON THIS PAGE!!!
// DO NOT CHANGE THE STYLES ON THIS PAGE!!!
// DO NOT CHANGE THE STYLES ON THIS PAGE!!!
// DO NOT CHANGE THE STYLES ON THIS PAGE!!!
?>
<div style="position: absolute;width: 100%;height: 100%;opacity:0.5;background-color: rgba(0,0,0,0.5);">
	<h1>Post Update</h1>
	<h2>User Info</h2>
<table width=40% align=left>
<tr>
<th>User ID</th>
<td><? echo $data[0]["userid"]?></td>
</tr>
<tr>
<th>User Name</th>
<td><? echo $data[0]["username"]?></td>
</tr>
<tr>
<th>Email</th>
<td><? echo $data[0]["email"]?></td>
</tr>
<tr>
<?echo "<a href=\"?action=profile\"><img src=\"uploads/" . $data[0]['avatar'] ."\" class=\"left userPhoto\" width=\"200\"/></a><br>";?>
</tr>
</table>

<br>

<a href="?action=updateUserButton">Edit User Name?</a>
<a href="?action=deleteUserButton">Delete Your Account For Good?</a>

<br>
<br>
<br>

<table>
<th align=center>Forum</th>
<?
foreach($edata as $post){
?>
<tr>
<td><? echo $post["username"]?></td>
<td><? echo $post["post"]?></td>
<td><a href="?action=updatePostButton&id=<? echo $post['id']?>">Edit Post?</a></td>
<td><a href="?action=deletePostButton">Delete This Post?</a></td>
</tr>
<?
}
?>
</table>
</div>
<div align=center style="padding:100px;width: 30%;position: relative;margin: 0 auto;top: 50%;transform: translateY(-50%);background-color: rgba(0,0,245,0.9);">
	<form action="?action=updatePostAction" align=center method="POST">
		
		<input type="hidden" name="pid" value="<? echo $udata[0]["id"];?>"/>
		<? echo $udata[0]["username"]?>
		<input style="overflow:auto;width:200px;padding-bottom:200px;" type="text" name="post" placeholder="<? echo $udata[0]["post"];?>"/>
		<input type="submit" name="submit" value="Update Post"/>
	
	</form>
	<form action="?action=backButton" align=center method="POST">
		<input type="submit" name="submit" value="Back"/>
	</form>
</div>
