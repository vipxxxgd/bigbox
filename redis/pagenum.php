<?php 
$num_rec_per_page=10;   // 每页显示数量
mysql_connect('localhost','root','');  // 数据库连接
mysql_select_db('apex1');  // 数据库名
if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 
$start_from = ($page-1) * $num_rec_per_page; 
$sql = "SELECT * FROM student LIMIT $start_from, $num_rec_per_page"; 
$rs_result = mysql_query ($sql); // 查询数据
?> 
<table>
<tr><td>Name</td><td>Phone</td></tr>
<?php 
while ($row = mysql_fetch_assoc($rs_result)) { 
?> 
            <tr>
            <td><?php echo $row['Name']; ?></td>
            <td><?php echo $row['Phone']; ?></td>            
            </tr>
<?php 
}; 
?> 
</table>
<?php 
$sql = "SELECT * FROM student"; 
$rs_result = mysql_query($sql); //查询数据
$total_records = mysql_num_rows($rs_result);  // 统计总共的记录条数
$total_pages = ceil($total_records / $num_rec_per_page);  // 计算总页数

echo "<a href='pagination.php?page=1'>".'|<'."</a> "; // 第一页

for ($i=1; $i<=$total_pages; $i++) { 
            echo "<a href='pagination.php?page=".$i."'>".$i."</a> "; 
}; 
echo "<a href='pagination.php?page=$total_pages'>".'>|'."</a> "; // 最后一页
?>