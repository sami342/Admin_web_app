
let btn=document.getElementById('btn');
let btn2=document.getElementById('updatebtn');
let btn3=document.getElementById('deletebtn');

btn.addEventListener('click',function(){

    document.querySelector('.popup').style.display = 'flex';
});

document.getElementById('close').addEventListener("click",
function(){
        document.querySelector('.popup').style.display = 'none';
});



btn2.addEventListener('click',function(){

    document.querySelector('.popupupdate').style.display = 'flex';
});

document.getElementById('closeupdate').addEventListener("click",
function(){
        document.querySelector('.popupupdate').style.display = 'none';
});




btn3.addEventListener('click',function(){

    document.querySelector('.popupdelete').style.display = 'flex';
});

document.getElementById('closedelete').addEventListener("click",
function(){
        document.querySelector('.popupdelete').style.display = 'none';
});

