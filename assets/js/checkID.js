var isvalidID=!1;function isValidPin(r){if(""!=r){var a=(13*r.charAt(0)+12*r.charAt(1)+11*r.charAt(2)+10*r.charAt(3)+9*r.charAt(4)+8*r.charAt(5)+7*r.charAt(6)+6*r.charAt(7)+5*r.charAt(8)+4*r.charAt(9)+3*r.charAt(10)+2*r.charAt(11))%11;return(a=1==a?0:0==a?1:11-a)==r.charAt(12)}return!1}function chkPinID(r,a){if(a||isvalidID)return isvalidID=!0,!0;var t=r.value;return""==t||isValidPin(t)||(alert("บันทึกเลขประจำตัวประชาชนไม่ถูกต้อง...!\n\nกรุณาตรวจสอบอีกครั้ง...!"),r.select()),isvalidID=!0,!0}