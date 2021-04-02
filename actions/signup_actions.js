function sha256(input){
   return crypto.createHash('sha256').update(JSON.stringify(input)).digest('hex')
}
function isEmpty(input){
    if(input == ''){
        return false
    }
    else{
        return true;
    }  
}
async function createRider() {
    console.log("runs");
    var fname = document.getElementsByName('fname')[0];
    var lname = document.getElementsByName('lname')[0];
    var email = document.getElementsByName('email')[0];
    var username = document.getElementsByName('username')[0];
    var password = document.getElementsByName('password')[0];
    var phone = document.getElementsByName('phone')[0];
    var proImg = document.getElementsByName('profileImg')[0];
    var card = document.getElementsByName('IDcard')[0];
    var type = 1;
    password = sha256(password);
    
    if(isEmpty(fname) && isEmpty(lname) && isEmpty(email) && isEmpty(username) && isEmpty(password) && isEmpty(phone) && isEmpty(proImg) &&isEmpty(card) &&isEmpty(type)){
        var oReq = new XMLHttpRequest();
        var form = new FormData();
        form.append("proImg",proImg);
        form.append("card",card);
        var data = {name:fname,lname:lname,email:email,username:username,password:password,phone:phone,proImg:form.proImg,card:form.card,type:type};
        
        oReq.open("POST", "../backend/signup.php", true);
        oReq.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            var response = this.responseText;
            if(response == 1){
                alert("Account created Successfully. Wait for approval");
            }
            else{
                alert("Account creation failed")
            }
        }
    };
    }
   
    
    oReq.setRequestHeader("Content-Type", "application/json");
   
    
    
    oReq.send(JSON.stringify(data));
}
document.forms['signupForm'].addEventListener('submit', createRider);
