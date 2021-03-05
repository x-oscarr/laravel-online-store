// Cart
// Add to cart
document.querySelector('[name=add-to-cart]').addEventListener('click', function (e) {
    console.log(this.value, document.querySelector('[name=quantity]').value);
    e.preventDefault();

    axios
        .post("/cart/add", {
            itemId: this.value,
            qty: document.querySelector('[name=quantity]').value
        })
        .then(response => {
            if(response.data.status) {
                this.innerHTML = `<span class="material-icons vertical-bottom">remove_shopping_cart</span> In cart`;
            } else {
                this.innerHTML = `<span class="material-icons vertical-bottom">add_shopping_cart</span> Add to cart`;
            }
        })
        .catch(error => console.log(error));
});
