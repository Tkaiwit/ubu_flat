function checkscoreresult(e=0,t=0,n=0){e=document.getElementById("RoomType").options[document.getElementById("RoomType").selectedIndex].value,t=document.getElementById("eval_quarter").options[document.getElementById("eval_quarter").selectedIndex].value,n=document.getElementById("eval_year").options[document.getElementById("eval_year").selectedIndex].value;var o=new XMLHttpRequest,a=new FormData;a.append("RoomType",e),a.append("eval_quarter",t),a.append("eval_year",n),o.onreadystatechange=function(){4==this.readyState&&200==this.status&&(document.getElementById("lablecheckscoresult").innerHTML=this.responseText)},o.open("post","./checkscore/CheckResultProcess.php",!0),o.send(a)}function viewDateScore(e){var t=new XMLHttpRequest,n=new FormData;popupmodals("ข้อมูลเพิ่มเติม",500,367,100),n.append("RequestID",e),t.onreadystatechange=function(){4==this.readyState&&200==this.status&&(document.getElementById("modals-body").innerHTML=this.responseText)},t.open("POST","./checkscore/viewDateScore.php"),t.send(n)}checkscoreresult();