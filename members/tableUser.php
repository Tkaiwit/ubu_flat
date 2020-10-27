<?php include '../function/connectDB.php';  include '../function/date.php';
$membersOther="SELECT * FROM v_members WHERE UserType IN(2,3,4,5,6,10,11,8) Order By UserType DESC,UserID ";
$getmembersOhtrer=mysqli_query($condb,$membersOther);
?>
<table class="table1 table-sm">
    <thead>
        <tr>
            <th width="9%" align="center"># ที่</th>
            <th align="left">ชื่อ-นามสกุล</th>
            <th align="left">สถานะ</th>
            <th align="left">ตำแหน่ง</th>
            <th align="left">สังกัด/คณะ</th>
            <th width="12%">จัดการ</th>
        </tr>
    </thead>
    <tbody id="myTable">
        <?php $x=0; while($row=mysqli_fetch_assoc($getmembersOhtrer)){$x++;
                    echo "<tr>";
                        echo "<td align=\"center\">$x</td>";
                        echo "<td>$row[UserPNameT]$row[UserNameT] $row[UserSNameT]</td>";
                        echo "<td >$row[UserTypeNameT]</td>";
                        echo "<td>$row[PositionName]</td>";
                        echo "<td>$row[FacNameT]</td>";
                        echo "<td align=\"center\"><a onclick=\"addUserOther($row[UserID])\"><i class=\"icons edit\"></i></a></td>";
                    echo "</tr>";
                } if($x<=0){ ?>
        <tr>
            <td colspan="13" align="center" style="height: 200px;background: #dfefff;">ไม่พบข้อมูล</td>
        </tr>
        <?php }?>
    </tbody>
</table>