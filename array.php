<?php
// $s=array();
// $va=-1;
// for($i=1;$i<=1000;$i++){
//     if($i %10==1){$va++;$s[$va]="";}
//     if($i %10!=1){$s[$va].=",";}
//     $s[$va].=$i;
// }
// for($j=0;$j<count($s);$j++){
//     echo $s[$j]."<br>";
// }
// $sql="INSERT INTO monthlycharge(ResidentID,ChargeType,Amount,IssueDate,MonthlyPeriod,Yearly) VALUES ";
// if( mysqli_query($condb,$sql2) ){
    //         echo 1;
    //     }else{
    //         echo $sql;
    //     }
?>
    <form onsubmit="if(vailfrom())savedata() ;else return false;" id="FT" name="FT" method="POST">
<input type="text" name="test" id="test" value="" placeholder="sdfsdsdf"  width="200" height="35" maxlength="4">
<input type="text" name="test2" id="test2" value="" placeholder="sdfsdsdf"  width="200" height="35" maxlength="4">
<input type="radio" name="t1" value="1">T!
<input type="radio" name="t1" value="2">T@
<input type="radio" name="t1" value="3">T#
<select name="sele" id="sele">
    <option value="0">aasdasf</option>
    <option value="2">b</option>
    <option value="2">b</option>
</select>
<!-- <button onclick="test1('sele')">TEST</button> -->
<input type="submit" value="save"/>
<button onclick="if(confirm('sdfsdf')) deletes()">delect</button>
<button onclick="document.FT.submit()">save</button>
</form>
<script type="text/javascript">
function vailfrom(){
    var frm=document.FT;
    if(test1('test')==""){
        alert("1111");
        frm.test.focus();
        return false;
    }else if(test1('test2')==""){
        alert("222");
       frm.test2.focus();

        return false;
    }else if(test1('t1')==0){
        alert("3");
        // document.getElementsByName('test2')[0].focus();

        return false;
    }else if(test1('sele')==0){
        alert("4");
       frm.sele.focus();

        return false;
    }else{
        return true;
    }
    
}
function savedata(){
    alert("save");
}
function deletes(){
    alert("delete");
}
function test1(str){
    // x=0;
    var obj = document.getElementsByName(str);
    elm = obj[0];
    // alert(obj);
    if(elm.type=="select-one"){
        // return elm.value;
       return elm.options[elm.selectedIndex].value;

    }else if(elm.type=="radio"){
        for (let i = 0; i < obj.length; i++) {
            if(obj[i].checked){
                return obj[i].value;
                //  break;
            }
        }
        // console.log(0);
        // alert(0);
        return 0;
    } else if(elm.type=="text"){
        return elm.value;
    }
    
}

</script>




