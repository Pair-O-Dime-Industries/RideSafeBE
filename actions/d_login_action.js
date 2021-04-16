function sha256(plainText)
	{
          
	        var md = forge.md.sha256.create();  
            md.start();  
            md.update(plainText, "utf8");  
            var hashText = md.digest().toHex();  
            return hashText;
        }        

function isEmpty(input){
    if(input == ''){
        return false
    }
    else{
        return true;
    }  
}
d_loginForm.onsubmit = async (e) => {
    e.preventDefault();
    let data = new FormData(document.forms.d_loginForm);
    let pass = data.get("password");
    pass = sha256(pass);
    data.set("password",pass);
        var oReq = new XMLHttpRequest(); 
        oReq.open("POST", "../backend/driverlogin.php", true);
        oReq.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            var response = this.responseText;
            
            if(response == 1){
                alert("Login Successful");
                window.location.href="../screens/testqr.html";
            }
            else if(response == 2){
                alert("An error was encountered. Re-enter data and try again.")
            }
            else if(response == 0){
                alert("Invalid Credentials!");
            }
        }
    };  
     oReq.send(data);
}