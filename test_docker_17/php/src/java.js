
var tabButtons=document.querySelectorAll(".tabContainer .buttonContainer button");
var tabPanels=document.querySelectorAll(".tabContainer .tabPanelContainer .tabPanel");

function showPanel(panel) {
    tabButtons.forEach(function(node){
        node.style.backgroundColor="";
        node.style.color="";
    });
    tabButtons[panel].style.color="white";
    tabButtons[panel].style.backgroundColor= "#DD2F6E";
    tabPanels.forEach(function(node){
        node.style.display="none";
    });
    tabPanels[panel].style.display="block";


}
showPanel(0);




  