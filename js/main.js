
//Declaration des attribues necessaire
var listCibles = [];
var MyListBat = [];
var listCliqued = [];
var xhttp = new XMLHttpRequest();
var OldShut="null",NewShut="null";
var MyLastShut="null";


function Close(){
    document.location.href="./index.php";
}

function Restart() {
    document.getElementById("XB2").style.display="none";
    document.getElementById("XB3").style.display="none";
    document.getElementById("XB4").style.display="none";
    document.getElementById("XB5").style.display="none";
    document.getElementById("IB2").removeAttribute("value");
    document.getElementById("IB3").removeAttribute("value");
    document.getElementById("IB4").removeAttribute("value");
    document.getElementById("IB5").removeAttribute("value");
    document.getElementById("B2").style.filter="drop-shadow(-1px 2px 2px white)";
    document.getElementById("B3").style.filter="drop-shadow(-1px 2px 2px white)";
    document.getElementById("B4").style.filter="drop-shadow(-1px 2px 2px white)";
    document.getElementById("B5").style.filter="drop-shadow(-1px 2px 2px white)";
}

function Start(){
    var isRight=1;
    for(var i=2;i<6;i++){
        if(document.getElementById("IB"+i).value.length==0){
            document.getElementById("B"+i).style.filter="drop-shadow(-1px 2px 10px yellow)";
            isRight=0;
        }
    }
    if(isRight) document.getElementsByClassName("formPlacement")[0].submit();
}

function Adapte(Joueur,Bat){
    window.addEventListener("resize",()=>{
        for(var j=2;j<6;j++){
            document.getElementById("MYB"+j).style.left=(document.getElementById("TablePlace"+Joueur).getBoundingClientRect().left+32*(Bat[j-2]%8)+window.scrollX)+"px";
            document.getElementById("MYB"+j).style.top=(document.getElementById("TablePlace"+Joueur).getBoundingClientRect().top+32*parseInt(Bat[j-2]/8)+window.scrollY)+"px";
        }
    });
}
function Allowing(Mode){
    if(Mode==1){
        document.getElementById("WaitingForm").style.display="none";
    }else{
        document.getElementById("WaitingForm").style.display="flex";
    }
}
function win() {
    Allowing(0);
    document.getElementById("WaitingFormImg").src="./Assets/winner.png";
    document.getElementById("WaitingFormImg").onclick=()=>{
        document.location.href="./index.php";
    }
}

function lose() {
    Allowing(0);
    document.getElementById("WaitingFormImg").onclick=()=>{
        document.location.href="./index.php";
    }
    document.getElementById("WaitingFormImg").src="./Assets/losing.png";
}

function update(Type,MatcheID) {
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200){
            NewShut=this.responseText;
            console.log(NewShut);
            if(parseInt(document.getElementById("scroreUser"+Type).innerHTML)==140){
                win();
                return 0;
            }
            if(OldShut==NewShut.split('---')[0]){
                setTimeout(() => {
                    update(Type,MatcheID);
                }, 1000);
            }else{
                OldShut=parseInt(NewShut.split('---')[0]);
                if(MyListBat.includes(OldShut-(Type-1)*80)){
                    document.getElementsByTagName("td")[OldShut].className+=" True";
                }
                if(Type==1) document.getElementById("scroreUser2").innerHTML=NewShut.split('---')[1];
                else document.getElementById("scroreUser1").innerHTML=NewShut.split('---')[1];
                if(parseInt(NewShut.split('---')[1])==140){
                    lose();
                    return 0;
                }
                Allowing(1);
            }
        }
    };
    xhttp.open("GET", "./Scripts/newPartie.php?Qui="+Type+"&LastShut="+MyLastShut+"&Score="+document.getElementById("scroreUser"+Type).innerHTML+"&Matcheid="+MatcheID, false);
    xhttp.send();
}

function Cibles(Type,N,MyBat,Bat,MatcheID) {
    for(var g=2;g<6;g++){
        for(var p=0;p<g;p++){
            listCibles.push(Bat[g-2]+p);
            MyListBat.push(MyBat[g-2]+p);
        }
    }
    for(var k=N;k<N+80;k++){
        document.getElementsByTagName("td")[k].onclick = (evt)=>{
            for(var i=N;i<N+80;i++){
                if(evt.target==document.getElementsByTagName("td")[i]){
                    if(!listCliqued.includes(i)){
                        if(listCibles.includes(i-N)){
                            evt.target.className+=" True";
                            document.getElementById("scroreUser"+Type).innerHTML = parseInt(document.getElementById("scroreUser"+Type).innerHTML)+10;
                        }else{
                            evt.target.className+=" False";
                        }
                        listCliqued.push(i);
                        Allowing(0);
                        MyLastShut=i;
                        update(Type,MatcheID);
                    }else{
                        return 0;
                    }
                }
            }
        }
    }    
    update(Type,MatcheID);
}

function positionerLesBateux(Joueur,Bat) {
    for(var j=2;j<6;j++){
        if(Joueur=="2"){
            document.getElementById("MYB"+j).style.transform="scaleX(-1)"
        }
        document.getElementById("MYB"+j).style.left=(document.getElementById("TablePlace"+Joueur).getBoundingClientRect().left+32*(Bat[j-2]%8)+window.scrollX)+"px";
        document.getElementById("MYB"+j).style.top=(document.getElementById("TablePlace"+Joueur).getBoundingClientRect().top+32*parseInt(Bat[j-2]/8)+window.scrollY)+"px";
        document.getElementById("MYB"+j).style.display="block";
    }
    Adapte(Joueur,Bat);
    if(Joueur==2){
        Allowing(0);
    }else{
        Allowing(1);
    }
}


if(document.getElementById("BtnClose")!=null){
    document.getElementById("BtnClose").addEventListener("click",Close);
}
if(document.getElementById("BtnRestart")!=null){
    document.getElementById("BtnRestart").addEventListener("click",Restart);
}
if(document.getElementById("BtnStart")!=null){
    document.getElementById("BtnStart").addEventListener("click",Start);
}

document.addEventListener("click",(e)=>{
    if(e.target.id=="B2" || e.target.id=="B3" || e.target.id=="B4" || e.target.id=="B5"){
        document.onmousemove = (evt)=>{
            document.getElementById("X"+e.target.id).style.left=(evt.clientX)+"px";
            document.getElementById("X"+e.target.id).style.top=(evt.clientY)+"px";
            document.getElementById("X"+e.target.id).style.display="block";
            document.getElementById(e.target.id).style.filter="drop-shadow(-1px 2px 2px red)";
        }
    }else if(e.target.id=="XB2" || e.target.id=="XB3" || e.target.id=="XB4" || e.target.id=="XB5"){
        document.onmousemove = null;
        //x = parseInt((e.clientX-document.getElementById("TablePlace").getBoundingClientRect().left)/30)%8
        //y = parseInt((e.clientY-document.getElementById("TablePlace").getBoundingClientRect().top)/30)%10
        if((8-parseInt((e.clientX-document.getElementById("TablePlace").getBoundingClientRect().left)/30)%8)>=parseInt(e.target.id.replace("XB","")) && (parseInt((e.clientX-document.getElementById("TablePlace").getBoundingClientRect().left)/30)%8)>=0 && (parseInt((e.clientY-document.getElementById("TablePlace").getBoundingClientRect().top)/30)%10)>=0){
            document.getElementById((e.target.id).replace("X","I")).setAttribute("value",parseInt((e.clientX-document.getElementById("TablePlace").getBoundingClientRect().left)/30)%8+8*(parseInt((e.clientY-document.getElementById("TablePlace").getBoundingClientRect().top)/30)%10));
            document.getElementById(e.target.id).style.left=(document.getElementById("TablePlace").getBoundingClientRect().left+32*(parseInt((e.clientX-document.getElementById("TablePlace").getBoundingClientRect().left)/30)%8))+"px";
            document.getElementById(e.target.id).style.top=(document.getElementById("TablePlace").getBoundingClientRect().top+32*(parseInt((e.clientY-document.getElementById("TablePlace").getBoundingClientRect().top)/30)%10))+"px";
        }else{
            document.getElementById(e.target.id).style.display="none";
            document.getElementById(e.target.id.replace("X","")).style.filter="drop-shadow(-1px 2px 2px white)";
        }
    }
})