function initialize () {
   
}
function newrefresh() {
   let bv=document.getElementById("output");
   bv.innerHTML=""
   console.log("Hi")

}


function findRestaurants () {
   
   var xhr = new XMLHttpRequest();
   let key_2="";
   let ctyid=document.getElementById("city");
   let keyid=document.getElementById("keywords");
   let arr=ctyid.value.split(",");
   let arr_two=keyid.value.split(" ");
   let optid=document.getElementById("level");
   let lstval=(optid.options[optid.selectedIndex].text);
   console.log(arr_two)
   if((arr_two.length)>2){
      key_1=arr_two[0];
      for(let i=1;i<(arr_two.length);i++){
         key_2+=arr_two[i]
         key_2+=' '
      }
      //key_2=arr_two[2]
   }
   else{
      key_1=arr_two[0];
      key_2=arr_two[1];
      console.log(key_2)
   }
   //console.log(key_2)
   cty=arr[0];
   st=arr[1];
   
   xhr.open("GET", "proxy.php?term="+key_1+"+"+key_2+"&location="+cty+"+"+st+"&limit="+lstval+"");
   xhr.setRequestHeader("Accept","application/json");
   
   xhr.onreadystatechange = function () {
       if (this.readyState == 4) {
          
          var json = JSON.parse(this.responseText);
          var str = JSON.stringify(json,undefined,2);
          let str_new = JSON.parse(str)
          let bd =str_new.businesses
          console.log(bd.length)
          console.log(str_new)
          newrefresh();
          for(let i=0;i<bd.length;i++)
          {
            console.log("Testing--->")
            let new_rest= document.createElement('div');
            new_rest.id=str_new.businesses[i].id;
            new_rest.style.border="solid 5px black"
            new_rest.style.padding="60px 60px"
            new_rest.style.margin="10px"
            let mydoc= document.getElementById('myform')
            let cret_p=document.createElement('p');
            let img= document.createElement('img');
            img.src=str_new.businesses[i].image_url;
            img.alt="Image Error..Please refresh"
            img.setAttribute('height', 200);
            img.setAttribute('width', 200);
            cret_p.appendChild(img)
            
            let cren_p=document.createElement('p');
            let name =document.createElement("a");
            name.href=str_new.businesses[i].url;
            name.textContent=str_new.businesses[i].name;
            cren_p.appendChild(name)

            let lb_tage=document.createElement("label");
            lb_tage.textContent="Categories:"
            let a_tag=document.createElement("p");
            a_tag.textContent=str_new.businesses[i].categories[0].title
            console.log(str_new.businesses[i].categories[0].title,"Title")
            lb_tage.appendChild(a_tag)

            let lp_tage=document.createElement("label");
            lp_tage.textContent="Price:"
            let b_tag=document.createElement("p");
            b_tag.textContent=str_new.businesses[i].price
            lp_tage.appendChild(b_tag)

            let lr_tage=document.createElement("label");
            lr_tage.textContent="Rating:"
            let r_tag=document.createElement("p");
            r_tag.textContent=str_new.businesses[i].rating
            lr_tage.appendChild(r_tag)
            
            let ad=document.createElement("label");
            ad.textContent="Address:"
            let ar_tage=document.createElement("p");
            ar_tage.textContent=str_new.businesses[i].location.display_address
            ad.appendChild(ar_tage)

            let pr_tage=document.createElement("label");
            pr_tage.textContent="Phone:"
            let p_tag=document.createElement("p");
            p_tag.textContent=str_new.businesses[i].phone
            pr_tage.appendChild(p_tag)

         
            new_rest.appendChild(cret_p)
            new_rest.appendChild(cren_p)
            new_rest.appendChild(lb_tage)
            new_rest.appendChild(lp_tage)
            new_rest.appendChild(lr_tage)
            new_rest.appendChild(ad)
            new_rest.appendChild(pr_tage)
           
            document.getElementById("output").append(new_rest)
            
           
           
            
            
         }
        
       

       }
   };
  
   xhr.send(null);
}
