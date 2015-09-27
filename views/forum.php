


<table>
<th align=center>Forum</th>
<?
foreach($data as $post){
?>
<tr>
<td><? echo $post["username"]?></td>
<td><? echo $post["post"]?></td>
</tr>
<?
}
?>
</table>
