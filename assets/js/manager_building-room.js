function tableBuilding(){var e=document.getElementById("lableBuilding"),t=new XMLHttpRequest;t.onreadystatechange=function(){if(4==this.readyState&&200==this.status){var t=this.responseText;e.innerHTML=t}},t.open("post","./buliding_room/tableBuilding.php",!0),t.send()}tableBuilding();var btnaddBuli=document.getElementsByClassName("addBuliding");for(i=0;i<btnaddBuli.length;i++)btnaddBuli[i].onclick=function(){popupmodals("เพิ่มข้อมูลอาคาร",500,379,100);var e=document.getElementById("modals-body"),t=new XMLHttpRequest;t.onreadystatechange=function(){4==this.readyState&&200==this.status&&(e.innerHTML=this.responseText)},t.open("GET","./buliding_room/addBuliding.php",!0),t.send()};function SaveBuilding(){for(var e,t=new XMLHttpRequest,n=new FormData,o=document.getElementById("FormAddBuli").elements,a=0;e=o[a++];)n.append(e.name,e.value);return t.onreadystatechange=function(){4==this.readyState&&200==this.status&&(res=this.responseText,1==res?(document.getElementById("myModals").style="display:none;",popupalert(1,"สำเร็จ","เพิ่มข้อมูลอาคาร"),tableBuilding()):2==res?popupalert(2,"ผิดพลาด","ระบบเกิดข้อผิดพลาด"):popupalert(3,"ข้อมูลซ้ำ","มีข้อมูลนี้อยู่ในระบบแล้ว"))},t.open("POST","./buliding_room/saveAddbuliding.php",!0),t.send(n),!1}function Editbuliding(e){popupmodals("แก้ไขข้อมูลอาคาร",500,379,100);var t=document.getElementById("modals-body"),o=new XMLHttpRequest;o.onreadystatechange=function(){if(4==this.readyState&&200==this.status){t.innerHTML=this.responseText;var e=document.getElementById("bulidingForm");for(n=0;n<e.elements.length;n++){var o=e.elements[n];"text"!=o.type&&"select-one"!=o.type||o.addEventListener("change",function(){saveBulidingDetail(this);var e=document.getElementById("BuID").value;"BuildingName"==this.name?document.getElementById("bname"+e).innerHTML=this.value:"FloorCount"==this.name&&(document.getElementById("fc"+e).innerHTML=this.value)})}}},o.open("GET","./buliding_room/editBuliding.php?BuliID="+e,!0),o.send()}function saveBulidingDetail(e){var t=new FormData,n=document.getElementById("BuID").value;if(t.append("BulidingID",n),t.append("FName",e.name),t.append("FValue",e.value),n>0){var o=new XMLHttpRequest;o.onreadystatechange=function(){4==this.readyState&&200==this.status&&(res=this.responseText,1==res?(document.getElementById("myModals").style="display:none;",popupalert(1,"สำเร็จ","ปรับปรุงข้อมูลอาคาร")):2==res?popupalert(2,"ผิดพลาด","ระบบเกิดข้อผิดพลาด"):popupalert(3,"ข้อมูลซ้ำ","มีข้อมูลนี้อยู่ในระบบแล้ว"))},o.open("POST","./buliding_room/savebuliding.php",!0),o.send(t)}}function EditRoomData(e){popupmodals("แก้ไขข้อมูลห้อง",500,513,100);var t=new XMLHttpRequest;t.onreadystatechange=function(){4==this.readyState&&200==this.status&&(data=this.responseText,document.getElementById("modals-body").innerHTML=data)},t.open("POST","./buliding_room/editRoom.php",!0),t.setRequestHeader("Content-type","application/x-www-form-urlencoded"),t.send("RoomID="+e)}function AddEquipment(e){popupmodals("เพิ่มครุภัณฑ์ประจำห้อง",500,310,100);var t=new XMLHttpRequest;t.onreadystatechange=function(){if(4==this.readyState&&200==this.status){data=this.responseText,document.getElementById("modals-body").innerHTML=data;var e=document.getElementById("FormEquipment");for(n=0;n<e.elements.length;n++)e[n].addEventListener("click",function(){var e=new FormData,t=document.getElementById("RoomIDEQ").value;e.append("RoomID",t),e.append("FValue",this.value);var n=this.checked?1:0;e.append("status",n);var o=new XMLHttpRequest;o.onreadystatechange=function(){4==this.readyState&&200==this.status&&(res=this.responseText,1==res?popupalert(1,"สำเร็จ","ปรับปรุงข้อมูลครุภัณฑ์ประจำห้อง"):2==res?popupalert(2,"ผิดพลาด","ระบบเกิดข้อผิดพลาด"):popupalert(3,"ข้อมูลซ้ำ","มีข้อมูลนี้อยู่ในระบบแล้ว"))},o.open("POST","./buliding_room/saveEquipment.php",!0),o.send(e)})}},t.open("POST","./buliding_room/addEquipment.php",!0),t.setRequestHeader("Content-type","application/x-www-form-urlencoded"),t.send("RoomID="+e)}function saveEquipment(e){var t=new FormData,n=document.getElementById("RoomIDEQ").value;t.append("RoomID",n),t.append("FValue",e.value);var o=new XMLHttpRequest;o.onreadystatechange=function(){4==this.readyState&&200==this.status&&(res=this.responseText,1==res?(popupalert(1,"สำเร็จ","เพิ่มข้อมูลครุภัณฑ์ประจำห้อง"),console.log(res)):2==res?(popupalert(2,"ผิดพลาด","ระบบเกิดข้อผิดพลาด"),console.log(res)):(popupalert(3,"ข้อมูลซ้ำ","มีข้อมูลนี้อยู่ในระบบแล้ว"),console.log(res)))},o.open("POST","./buliding_room/saveEquipment.php",!0),o.send(t)}function DelEquipment(e){var t=new FormData,n=document.getElementById("RoomIDEQ").value;t.append("RoomID",n),t.append("FValue",e.value);var o=new XMLHttpRequest;o.onreadystatechange=function(){4==this.readyState&&200==this.status&&(res=this.responseText,1==res?(popupalert(1,"สำเร็จ","ลบข้อมูลครุภัณฑ์ประจำห้อง"),console.log(res)):2==res?(popupalert(2,"ผิดพลาด","ระบบเกิดข้อผิดพลาด"),console.log(res)):(popupalert(3,"ข้อมูลซ้ำ","มีข้อมูลนี้อยู่ในระบบแล้ว"),console.log(res)))},o.open("POST","./buliding_room/DelEquipment.php",!0),o.send(t)}function OrderByBuilding(e){var t=1==document.getElementById("RoomStatus1").checked?1:0,n=1==document.getElementById("RoomStatus2").checked?1:0,o=1==document.getElementById("RoomStatus3").checked?1:0,a=document.getElementById("lableRoom"),d=new XMLHttpRequest,s=new FormData;s.append("BuildingID",e),s.append("RoomStatus1",t),s.append("RoomStatus2",n),s.append("RoomStatus3",o),d.onreadystatechange=function(){if(4==this.readyState&&200==this.status){var e=this.responseText;a.innerHTML=e}},d.open("POST","./buliding_room/OrderByBuilding.php",!0),d.send(s)}function ViewEditRoom(e){var t=new XMLHttpRequest;popupmodals("แก้ไขข้อมูลห้อง/ครุภัณฑ์ประจำห้อง",500,510,100),t.onreadystatechange=function(){4==this.readyState&&200==this.status&&(data=this.responseText,document.getElementById("modals-body").innerHTML=data)},t.open("POST","./buliding_room/editRoom.php",!0),t.setRequestHeader("Content-type","application/x-www-form-urlencoded"),t.send("RoomID="+e)}function SaveRoom(){var e=new XMLHttpRequest,t=getdataform("FormeditRoom"),n=document.getElementById("BuildingID").value;return e.onreadystatechange=function(){4==this.readyState&&200==this.status&&(res=this.responseText,1==res?(document.getElementById("myModals").style="display:none;",popupalert(1,"สำเร็จ","อัพเดตข้อมูลห้องพัก"),OrderByBuilding(n)):(popupalert(2,"ผิดพลาด","ระบบเกิดข้อผิดพลาด"),console.log(res)))},e.open("POST","./buliding_room/saveroom.php",!0),e.send(t),!1}function ShowRoom(){document.getElementById("ShowRoom").style.fontWeight="bold",document.getElementById("ShowEquipment").style.fontWeight="200",document.getElementById("FormeditRoom").style.display="block",document.getElementById("FormEquipment").style.display="none"}function ShowEquipment(){document.getElementById("ShowEquipment").style.fontWeight="bold",document.getElementById("ShowRoom").style.fontWeight="200",document.getElementById("FormeditRoom").style.display="none",document.getElementById("FormEquipment").style.display="block"}function ShowDataBuilding(){document.getElementById("ShowDataRoom").style.display="none",document.getElementById("ShowDataBuilding").style.display="block",document.getElementById("tabBuilding").classList.add("active"),document.getElementById("tabRoom").classList.remove("active")}function ShowDataRoom(){document.getElementById("ShowDataRoom").style.display="block",document.getElementById("ShowDataBuilding").style.display="none",document.getElementById("tabBuilding").classList.remove("active"),document.getElementById("tabRoom").classList.add("active"),OrderByBuilding(0)}