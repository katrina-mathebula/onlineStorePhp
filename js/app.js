
(function () {
const cartInfo = document.getElementById("cart-info");
const cart = document.getElementById("cart");
    
    cartInfo.addEventListener("click", function() {
        cart.classList.toggle("show-cart");
    });
})();

//add items to the cart
(function(){
    const cartBtn = document.querySelectorAll('.store-item-icon');
    cartBtn.forEach(function(btn) { 
        btn.addEventListener('click',function(event){
        //console.log(event.target);
        
        if(event.target.parentElement.classList.contains('store-item-icon')) {
           let fullPath = event.target.parentElement.previousElementSibling.src;
            let pos = fullPath.indexOf('img') + 3;
            let partPath = fullPath.slice(pos);
            
            const item = {};
            item.img = `img-cart${partPath}`;
            let name = event.target.parentElement.parentElement.nextElementSibling.children[0].children[0].textContent;
            item.name = name;
            let price = event.target.parentElement.parentElement.nextElementSibling.children[0].children[1].textContent;
            
            let finalPrice = price.slice(1).trim();
            item.price = finalPrice;
            
            //console.log(finalPrice);
            
            //console.log(item);
            
            const cartItem = document.createElement('div');
            cartItem.classList.add("cart-item", "d-flex", "justify-content-between", "text-capitalize", "my-3");
            cartItem.innerHTML = `
                <img src="${item.img}" class="img-fluid rounded-circle" id="item-img" alt="">
                <div class="item-text">
                <p id="cart-item-title" class="font-weight-bold mb-0">${item.name}</p>
                    <span>R</span>
                    <span id="cart-item-price" class="cart-item-price mb-0">${item.price}</span>
                    </div>
                <a href="#" id="cart-item-remove" class="cart-item-remove">
                <i class="fas fa-trash"></i>
                </a>
                </div>`;
            
            // select cart
            const cart = document.getElementById("cart");
            const total = document.querySelector(".cart-total-container");
            
            cart.insertBefore(cartItem, total);
            alert("item added to the cart");
            showTotals();
            
            
        }
    });
    });
    
    //show totals
    function showTotals() {
        const total = [];
        const items = document.querySelectorAll(".cart-item-price");
        
        items.forEach(function(item) {
            total.push(parseFloat(item.textContent));
        });
        //console.log(total);
        
        const totalMoney = total.reduce(function(total, item) {
           total += item;
            return total;
        }, 0);
        
        const finalMoney = totalMoney.toFixed(2);
        
        document.getElementById("cart-total").textContent = finalMoney;
        document.querySelector(".item-total").textContent = finalMoney;
        document.getElementById("item-count").textContent = total.length;
    }
    
    //clear cart button
    //cartLogic(){
       // clearCartBtn.addEventListener('click', ()=>{
           // this.clearCart(); 
       // });
   // }
   
    
    
    
})();




//scroll to top button
const backToTopButton = document.querySelector("#back-to-top-btn");

window.addEventListener("scroll", scrollFunction);

function scrollFunction() {
  if (window.pageYOffset > 300) { // Show backToTopButton
    if(!backToTopButton.classList.contains("btnEntrance")) {
      backToTopButton.classList.remove("btnExit");
      backToTopButton.classList.add("btnEntrance");
      backToTopButton.style.display = "block";
    }
  }
  else { // Hide backToTopButton
    if(backToTopButton.classList.contains("btnEntrance")) {
      backToTopButton.classList.remove("btnEntrance");
      backToTopButton.classList.add("btnExit");
      setTimeout(function() {
        backToTopButton.style.display = "none";
      }, 250);
    }
  }
}

backToTopButton.addEventListener("click", smoothScrollBackToTop);

// function backToTop() {
//   window.scrollTo(0, 0);
// }

function smoothScrollBackToTop() {
  const targetPosition = 0;
  const startPosition = window.pageYOffset;
  const distance = targetPosition - startPosition;
  const duration = 750;
  let start = null;
  
  window.requestAnimationFrame(step);

  function step(timestamp) {
    if (!start) start = timestamp;
    const progress = timestamp - start;
    window.scrollTo(0, easeInOutCubic(progress, startPosition, distance, duration));
    if (progress < duration) window.requestAnimationFrame(step);
  }
}

function easeInOutCubic(t, b, c, d) {
	t /= d/2;
	if (t < 1) return c/2*t*t*t + b;
	t -= 2;
	return c/2*(t*t*t + 2) + b;
};