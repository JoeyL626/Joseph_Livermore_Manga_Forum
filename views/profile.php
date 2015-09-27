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

<a href="?action=updateUserButton">Edit Profile?</a>
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
<td><a href="?action=deletePostButton&id=<? echo $post['id']?>">Delete This Post?</a></td>
</tr>
<?
}
?>
</table>
