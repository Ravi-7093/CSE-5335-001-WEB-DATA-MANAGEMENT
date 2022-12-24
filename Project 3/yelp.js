let bds,lat_n,long_n,lat_s,long_s,r,map,crc;
let my_window = null;
let markers = [];
function initialize () {

   
}
function newrefresh() {
   let bv=document.getElementById("area");
   bv.innerHTML=""
   console.log("Hi")

}

function del_m() {
   for (var i = 0; i < markers.length; i++) {
       markers[i].setMap(null);
   }
   markers = [];
}

function initMap() {
   const cent = { lat: 32.75, lng:  -97.13 };
     map = new google.maps.Map(document.getElementById("map"), {
     zoom: 16,
     center: cent,
   });
   var identity = new google.maps.Marker({
     position: cent,
     map: map,
   });
   
   google.maps.event.addListener(map,"idle",function(){
      bds=map.getBounds();
      console.log(bds)
      console.log(bds)
      
      lat_n= parseFloat(bds.ab.lo);
      long_n= parseFloat(bds.Fa.lo);
      lat_s= parseFloat(bds.ab.hi);
      long_s= parseFloat(bds.Fa.lo);
     
      let ck = new google.maps.LatLng(lat_n, long_n);
      let kk = new google.maps.LatLng(lat_s, long_s);

      crc = parseInt(google.maps.geometry.spherical.computeDistanceBetween(ck, kk))
      console.log(crc)
     
   })
 }
 
 window.initMap = initMap;

function findRestaurants () {
 
   var xhr = new XMLHttpRequest();
   let key_2="";
   let keyid=document.getElementById("keywords");
   let arr_two=keyid.value.split(" ");
   
   console.log(arr_two)
   if((arr_two.length)>2){
      key_1=arr_two[0];
      for(let i=1;i<(arr_two.length);i++){
         key_2+=arr_two[i]
         key_2+=' '
      }
      key_2=arr_two[2]
   }
   else{
     key_1=arr_two[0];
      key_2=arr_two[1];
     console.log(key_2)
   }
  
   xhr.open("GET", "proxy.php?term="+key_1+"+"+key_2+"&latitude="+lat_s+"&longitude="+long_s+"&radius="+crc+"&limit=10");
   xhr.setRequestHeader("Accept","application/json");
   
   xhr.onreadystatechange = function () {
       if (this.readyState == 4) {
          console.log("Hi")
          var json = JSON.parse(this.responseText);
          var str = JSON.stringify(json,undefined,2);
          let str_new = JSON.parse(str)
          let bd =str_new.businesses
         
          console.log(bd)
          console.log(str_new.businesses)
          newrefresh();
          del_m()

        
          for(let i=0;i<bd.length;i++)
          {
         //    console.log("Testing--->")
               let num =(i+1).toString()
               let new_rest= document.createElement('div');
               new_rest.id=str_new.businesses[i].id;
               let la_lg= {lat:str_new.businesses[i].coordinates.latitude,lng:str_new.businesses[i].coordinates.longitude}
      
             
               let cret_p=document.createElement('p');
               let img= document.createElement('img');
               img.src=str_new.businesses[i].image_url;
               img.alt="Image Error..Please refresh"
               img.setAttribute('height', 250);
               img.setAttribute('width', 250);
               cret_p.appendChild(img)
            
               let img_d=document.createElement("label");
               img_d.textContent="Restaurant Name: "
               img_d.setAttribute('font-weight',0)
               img_d.setAttribute('color','black')
               let name =document.createElement("a");
               name.href=str_new.businesses[i].url;
               name.textContent= str_new.businesses[i].name;
               let brk = document.createElement("br")
               let brk1 = document.createElement("br")
               img_d.appendChild(name)
               img_d.appendChild(brk)
               img_d.appendChild(brk1)

               let lr_tage=document.createElement("label");
               lr_tage.textContent="Rating :"+" "+str_new.businesses[i].rating


         
               new_rest.appendChild(cret_p)
               new_rest.appendChild(img_d)
               new_rest.appendChild(lr_tage)
               let  ct_str =new_rest
               const infowindow = new google.maps.InfoWindow({
                  content: ct_str,
                  maxWidth: 800,
                  maxHeight:300
                });
              
                const identity = new google.maps.Marker({
                  position:la_lg ,
                  label:num,
                  map,
                  title: str_new.businesses[i].name,
                });
              
                identity.addListener("click", () => {
                  if  (my_window != null) {
                     my_window.close();
                     }
                     
                  infowindow.open({
                    anchor: identity,
                    map,
                    shouldFocus: false,
                  });
                  my_window=infowindow
                });
                markers.push(identity)
              
              
            
           
           
            
            
         }
      
       

       }
   };
  
   xhr.send(null);
}
