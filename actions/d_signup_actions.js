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
// upload.onchange = async (event) =>{

// 	var image = document.getElementById('output');
// 	image.src = URL.createObjectURL(event.target.files[0]);
// }
d_signUpForm.onsubmit = async (e) => {
    e.preventDefault();
    let data = new FormData(document.forms.d_signUpForm);
    let pass = data.get("password");
    pass = sha256(pass);
    data.set("password",pass);
    for(let value of data.values()){
        console.log(value);
    }
        var oReq = new XMLHttpRequest(); 
        oReq.open("POST", "../backend/driversignup.php", true);
        oReq.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            var response = this.responseText;
            
            if(response == 1){
                alert("Account created Successfully. Wait for approval");
            }
            else if(response == 2){
                alert("An error was encountered when adding new user. Renter data and try again.")
            }
            else if(response == 4){
                alert("Username/mobile/email is already in use.");
            }
        }
    };
    
   
    
    
   
    
    
    oReq.send(data);
}