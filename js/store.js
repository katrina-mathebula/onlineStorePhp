var store_ajax = new XMLHttpRequest();
function request(name, price, image)
{
    
    var url = "./addtocart.php"//addtocart.php this file adds the product to shopping cart
    store_ajax.onreadystatechange = response;
    store_ajax.open("POST", url, true);
    store_ajax.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    store_ajax.send("product_name=" + name + "&price=" + price + "&image=" + image);
}

function response()
{
    
    if(store_ajax.readyState == 4 )
        {
            if(store_ajax.status == 200)
                {
                    var result = JSON.parse(store_ajax.responseText);
                    if(result[0])
                    {
                        alert(result[1]);
                    }else{
                        alert(result[1]);
                    }
                    
                }
        }
}
function getProductName(name, price, image){
   request(name, price, image);
}