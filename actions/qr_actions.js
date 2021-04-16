//  async function getCode(){
//     //  var req = new XMLHttpRequest();
//     // var jsonResponse ;
//     //     let url = "../backend/qrCode.php";
//     //     req.responseType = 'json';
//     //     req.open('POST', url, true);
//     //     req.setRequestHeader("Content-Type", "application/json");
//     //     req.onload = function () {
//     //          jsonResponse = req.response;
//     //         alert(jsonResponse.msg);
//     //     };
//     //     req.send(JSON.stringify(null));
//     //     return jsonResponse.json();
//     let response = await sendRequest('../backend/qrCode.php','POST');
//     alert(response.msg);
//     }
const domain = "http://api.qrserver.com/v1/create-qr-code/?data=";

        async function sendRequest(url, method, data) {
            const options = {
                method
            };

            if (data) {
                options.body = JSON.stringify(data);
                options.headers = {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                };
            }
            let response = await fetch(url, options);
            return response.json();
        }

async function createCode(){
    let response = await sendRequest('../backend/qrCode.php','POST');
    let qr = sendRequest(domain+response.msg+'&size=300x300');

}
async function displayCode(){
    let response = await sendRequest('../backend/qrCode.php','POST');
    let html = `
        <img src="https://api.qrserver.com/v1/create-qr-code/?data=${response.msg}&amp;size=300x300" alt="" title="" />
    `;
     document.getElementById('qr').innerHTML = html;

}
displayCode();
// createCode();