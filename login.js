// document.addEventListener('DOMContentLoaded', function(event) {

//         document.getElementById('signup').style.visibility = 'visible';
//         document.getElementById('flip-card-btn-turn-to-back').style.visibility = 'visible';
//         document.getElementById('flip-card-btn-turn-to-front').style.visibility = 'visible';


//         document.getElementById('signup').onclick = function() {
//           document.getElementById('flip-card').classList.toggle('do-flip');
//           };

//         document.getElementById('flip-card-btn-turn-to-back').onclick = function() {
//         document.getElementById('flip-card').classList.toggle('do-flip');
//         };

//         document.getElementById('flip-card-btn-turn-to-front').onclick = function() {
//         document.getElementById('flip-card').classList.toggle('do-flip');
//         };


        

// });

function who(id){
  let info = document.getElementById(id)
  let val = info.value;
  let length = info.options.length;
  for(let i=0; i<length;i++){
    var elem = info.options.item(i).value;
    var hid = document.getElementById(elem);
    if(elem !== "null"){
      // console.log(elem);
      if(hid.className === "show"){
        hid.classList.remove("show");
        hid.classList.add("hide");
      }
    }
   }
  let sel = document.getElementById(val);
  if(val !== "null"){
    if(sel.className === "hide"){
      sel.classList.remove("hide");
      sel.classList.add("show");
    }
    else{
      sel.classList.add("show");
    }
  }
}

$(window).scroll(function(){
  $('nav').toggleClass('scrolled', $(this).scrollTop()>650);
});
