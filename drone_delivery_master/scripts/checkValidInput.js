function numkeyCheck(e){
  var keyValue = event.keyCode;
  if( ((keyValue >= 48) && (keyValue <= 57)) ) return true;
  else return false;
}

function check(){
  idCheck();
  pwCheck();
  nameCheck();
  bDayCheck();
  if(document.getElementById("_idValue").value == "0"){
    return false;
  }
  if(document.getElementById("_pwValue").value == "0"){
    return false;
  }
  if(document.getElementById("_nameValue").value == "0"){
    return false;
  }
  if(document.getElementById("_bDayValue").value == "0"){
    return false;
  }
  return true;
}

function idCheck(){
  var userid = document.getElementById("_id").value;
  var regExp = /^[a-zA-Z0-9_-]{4,12}$/;
  if(userid){
    if(!regExp.test(userid)){
      document.getElementById("_idValue").value = "0";
      document.getElementById("_idComment").innerText = "4~12자의 알파벳 대소문자, 숫자와 특수기호(_),(-)만 사용가능합니다.";
    }
    else{
      ifrm.location.href = "./user/checkIDdup.php?userid="+userid;
    }
  }
  else{
    document.getElementById("_idValue").value = "0";
    document.getElementById("_idComment").innerText = "아이디를 입력하세요.";
  }
}

function pwCheck(){
  var userpw = document.getElementById("_pw").value;
  var regExp = /^[a-zA-Z0-9]{8,20}$/;
  if(!userpw){
    document.getElementById("_pwValue").value = "0";
    document.getElementById("_pwComment").innerText = "";
  }
  else if(!regExp.test(userpw)){
    document.getElementById("_pwValue").value = "0";
    document.getElementById("_pwComment").innerText = "비밀번호는 8~20 자리의 영문, 숫자여야 합니다.";
  }
  else{
    if(document.getElementById("_pw").value == document.getElementById("_confirmpw").value){
      document.getElementById("_pwValue").value = "1";
      document.getElementById("_pwComment").innerText = "비밀번호가 일치합니다.";
    }
    else{
      document.getElementById("_pwValue").value = "0";
      document.getElementById("_pwComment").innerText = "비밀번호가 일치하지 않습니다.";
    }
  }
}

function nameCheck(){
  if(!document.getElementById("_name").value){
    document.getElementById("_nameValue").value = "0";
    document.getElementById("_nameComment").innerText = "이름을 입력하세요.";
  }
  else{
    document.getElementById("_nameValue").value = "1";
    document.getElementById("_nameComment").innerText = "";
  }
}

function bDayCheck(){
  var useryear = document.getElementById("_year").value;
  var usermonth = document.getElementById("_month").value;
  var userday = document.getElementById("_day").value;

  if(useryear.length != 4){
    document.getElementById("_bDayValue").value = "0";
    document.getElementById("_bDayComment").innerText = "태어난 년도 4자리를 정확하게 입력하세요.";
  }
  else if(!userday){
    document.getElementById("_bDayValue").value = "0";
    document.getElementById("_bDayComment").innerText = "태어난 날짜를 정확하게 입력하세요.";
  }
  else if(usermonth == "1" || usermonth == "3" || usermonth == "5" || usermonth == "7" || usermonth == "8" || usermonth == "10" || usermonth == "12"){
    if(Number(userday) > 31){
      document.getElementById("_bDayValue").value = "0";
      document.getElementById("_bDayComment").innerText = "생년월일을 다시 확인하세요.";
    }
    else{
      document.getElementById("_bDayValue").value = "1";
      document.getElementById("_bDayComment").innerText = "";
    }
  }
  else if(usermonth == "4" || usermonth == "6" || usermonth == "9" || usermonth == "11"){
    if(Number(userday) > 30){
      document.getElementById("_bDayValue").value = "0";
      document.getElementById("_bDayComment").innerText = "생년월일을 다시 확인하세요.";
    }
    else{
      document.getElementById("_bDayValue").value = "1";
      document.getElementById("_bDayComment").innerText = "";
    }
  }
  else if(usermonth == "2"){
    if(Number(userday) > 29){
      document.getElementById("_bDayValue").value = "0";
      document.getElementById("_bDayComment").innerText = "생년월일을 다시 확인하세요.";
    }
    else{
      document.getElementById("_bDayValue").value = "1";
      document.getElementById("_bDayComment").innerText = "";
    }
  }

  if(document.getElementById("_bDayValue").value == "1"){
    var date = new Date();
    var bDay = new Date(useryear, Number(usermonth) - 1, userday);

    if(bDay.getFullYear() < (date.getFullYear() - 100)){
      document.getElementById("_bDayValue").value = "0";
      document.getElementById("_bDayComment").innerText = "장수하셨네요.";
    }

    else if(bDay.getTime() > date.getTime()){
      document.getElementById("_bDayValue").value = "0";
      document.getElementById("_bDayComment").innerText = "미래에서 오셨군요.";
    }
  }
}
