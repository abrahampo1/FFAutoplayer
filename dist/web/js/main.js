//document.getElementById("button-name").addEventListener("click", ()=>{eel.get_random_name()}, false);
//document.getElementById("button-number").addEventListener("click", ()=>{eel.get_random_number()}, false);
document.getElementById("button-auto").addEventListener("click", ()=>{eel.get_date()}, false);
//document.getElementById("button-ip").addEventListener("click", ()=>{eel.get_ip()}, false);
document.getElementById("body").addEventListener("load", ()=>{eel.load()}, false);

eel.expose(prompt_alerts);
function prompt_alerts(description) {
  alert(description);
}