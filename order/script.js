// filter array 
let filterarray =[];

let galleryarray = [
    {
        id:1,
        name : "Hyper Front",
        src: "https://enternity.id/new-icon/icon/hyper-front.webp",
        desc : "",
        link : "https://enternity.id/order/game/hyper-front"
    },
        {
        id:2,
        name : "Joki Rank MLBB",
        src: "https://enternity.id/new-icon/icon/mlbb-joki-rank.webp",
        desc : "",
        link : "https://enternity.id/order/game/mobile-legends-joki-rank"
    },
    {
        id:3,
        name : "Tower Of Fantasy",
        src: "https://enternity.id/new-icon/icon/tower-of-fantasy-icon.webp",
        desc : "",
        link : "https://enternity.id/order/game/tower-of-fantasy"
    },
    {
        id:4,
        name : "Lita",
        src: "https://enternity.id/new-icon/icon/lita-icon.webp",
        desc : "",
        link : "https://enternity.id/order/game/lita"
    },
    {
        id:5,
        name : "Apex Legends Mobile",
        src: "https://enternity.id/new-icon/icon/icon-apex-legends.webp",
        desc : "",
        link : "https://enternity.id/order/game/apex-legends-mobile"
    },
    {
        id:6,
        name : "Honkai Impact 3",
        src: "https://enternity.id/new-icon/icon/honkai-impact-3.webp",
        desc : "",
        link : "https://enternity.id/order/game/honkai-impact-3"
    },
    {
        id:7,
        name : "Marvel Super War",
        src: "https://enternity.id/new-icon/icon/marvel-super-war-icon.webp",
        desc : "",
        link : "https://enternity.id/order/game/marvel-super-war"
    },
    {
        id:8,
        name : "Super Sus",
        src: "https://enternity.id/new-icon/icon/super-sus-icon.webp",
        desc : "",
        link : "https://enternity.id/order/game/super-sus"
    },
    {
        id:9,
        name : "Valorant",
        src: "https://enternity.id/new-icon/icon/valorant-new.webp",
        desc : "",
        link : "https://enternity.id/order/game/valorant"
    },
    {
        id:10,
        name : "Arena of Valor",
        src: "https://enternity.id/new-icon/icon/aov_tile.webp",
        desc : "",
        link : "https://enternity.id/order/game/arena-of-valor"
    },
    {
        id:11,
        name : "eFootball 2023 Vilog",
        src: "https://enternity.id/new-icon/icon/9undLj4YJQinRpd1u50Dv33H.webp",
        desc : "",
        link : "https://enternity.id/order/game/efootball-2023-vilog"
    },

   ];



showgallery(galleryarray);

function showgallery(curarra){
   document.getElementById("card").innerText = "";
   for(var i=0;i<curarra.length;i++){
       document.getElementById("card").innerHTML += `
       
<div class="category-container">
    <div class="category__product-row">
    <img src="${curarra[i].src}" class="category__product-image lozad" height="80px" style="padding: 15px"/>
    <center><small class="category__product-title">${curarra[i].name}</small></center>
    <small class="mt-2">${curarra[i].desc}</small>
    <center><a href="${curarra[i].link}"><button class="btn btn-primary btn-sm w-100">Order Now</button></a></center>

</div>
</div>


       `
   }

}

// For Live Searching Product
document.getElementById("myinput").addEventListener("keyup",function(){
    let text = document.getElementById("myinput").value;

    filterarray= galleryarray.filter(function(a){
        if(a.name.includes(text)){
            return a.name;
           }

   });
   if(this.value==""){
       showgallery(galleryarray);
   }
   else{
       if(filterarray == ""){
           document.getElementById("para").style.display = 'block'
           document.getElementById("card").innerHTML = ""; 
       }
       else{

           showgallery(filterarray);
           document.getElementById("para").style.display = 'none'
       }
   }

});


