function getCart() {
    return JSON.parse(localStorage.getItem('cart')) || [];
}

function saveCart(cart) {
    localStorage.setItem('cart', JSON.stringify(cart));
}

function addToCart(id, name, price) {
    let cart = getCart();

    let item = cart.find(p => p.id === id);

    if (item) {
        item.qty++;
    } else {
        cart.push({ id, name, price, qty: 1 });
    }

    saveCart(cart);
    updateCartCount();
}

function updateCartCount() {
    let cart = getCart();
    let count = cart.reduce((t, i) => t + i.qty, 0);

    let el = document.getElementById("cart-count");
    if (el) el.innerText = count;
}

function removeItem(id) {
    let cart = getCart().filter(i => i.id !== id);
    saveCart(cart);
    renderCart();
    updateCartCount();
}

function clearCart() {
    localStorage.removeItem('cart');
    renderCart();
    updateCartCount();
}

function updateQty(id, qty) {
    let cart = getCart();
    let item = cart.find(i => i.id === id);

    if (item) {
        item.qty = parseInt(qty);
    }

    saveCart(cart);
    renderCart();
    updateCartCount();
}

function renderCart() {
    let cart = getCart();
    let container = document.getElementById("cart-items");
    let totalEl = document.getElementById("cart-total");

    if (!container) return;

    if (cart.length === 0) {
        container.innerHTML = `
            <div class="text-center py-5">
                <h4>Your cart is empty</h4>
                <a href="products.php" class="btn btn-primary mt-3">Shop Now</a>
            </div>
        `;
        if (totalEl) totalEl.innerText = "₹0";
        return;
    }

    let total = 0;
    container.innerHTML = "";

    cart.forEach(item => {
        let subtotal = item.price * item.qty;
        total += subtotal;

        container.innerHTML += `
        <div class="d-flex justify-content-between align-items-center mb-4 border-bottom pb-3">

            <div>
                <h6 class="fw-bold">${item.name}</h6>

                <div class="d-flex align-items-center gap-2 mt-2">
                    <input 
                        type="number" 
                        value="${item.qty}" 
                        min="1"
                        onchange="updateQty(${item.id}, this.value)"
                        class="form-control form-control-sm"
                        style="width:70px;"
                    >

                    <button onclick="removeItem(${item.id})" class="btn btn-sm text-danger">
                        Remove
                    </button>
                </div>
            </div>

            <div>
                <strong>₹${subtotal}</strong>
            </div>

        </div>
        `;
    });

    if (totalEl) totalEl.innerText = "₹" + total;
}

document.addEventListener("DOMContentLoaded", () => {
    updateCartCount();
    renderCart();
});