function clickme() {
    document.getElementById("show").innerHTML +=
        `<style>
        #show {
        display: none;
        }
        <style>
    } `;
    document.getElementById("hidden").innerHTML +=
        `<style>
            #hidden {
        display: block;
            }
        <style>
    } `;
};
logout.onclick = async(e) =>{
    console.log('worked');
     e.preventDefault();
     let data = {logout:'logout'};
     var oReq = new XMLHttpRequest(); 
  
      oReq.open("POST", "../backend/login.php", true);
          oReq.setRequestHeader("Content-Type", "application/json");
        oReq.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
        var response = this.responseText;

        if(response == true){
            window.location.href="./login.html";
        
        }

        
        }
        };
        oReq.send(JSON.stringify(data));
}
function check() { //Rider turns white and Driver turns yellow. Next button is yellow
    var rider = document.getElementById("Rider");
    var driver = document.getElementById("Driver");
    var button = document.getElementById("next-btn").style;
    var l = document.getElementById("signup-hide").style;
    var i = document.getElementById("signup-show").style;

    rider.style.backgroundColor = "white";
    rider.style.color = "black";
    rider.style.position = "unset";
    driver.style.position = "relative";
    driver.style.backgroundColor = "yellow";
    driver.style.color = "black";
    button.backgroundColor = "yellow";
    button.color = "black";
    driver.style.width = "7em";
    rider.style.width = "8em";
    l.display = "unset";
    i.display = "none";
}

function uncheck() {
    var rider = document.getElementById("Rider");
    var driver = document.getElementById("Driver");
    var button = document.getElementById("next-btn").style;
    var l = document.getElementById("signup-hide").style;
    var i = document.getElementById("signup-show").style;

    rider.style.backgroundColor = "rgb(35, 10, 124)";
    rider.style.color = "white";
    rider.style.position = "relative";
    driver.style.position = "unset";
    driver.style.backgroundColor = "white";
    driver.style.color = "black";
    driver.style.width = "8em";
    rider.style.width = "7em";
    button.backgroundColor = "rgb(35, 10, 124)";
    button.color = "white";
    i.display = "unset";
    l.display = "none";

}