let cart = [];
let orders = [];

// Funções de modal
function toggleModal(modalId, show = true) {
    document.getElementById(modalId).style.display = show ? "flex" : "none";
}

function openAccount() {
    updateAccountInfo();
    toggleModal("account-modal", true);
}

function closeAccount() {
    toggleModal("account-modal", false);
}

function openCart() {
    updateCartDisplay();
    toggleModal("cart-modal", true);
}

function closeCart() {
    toggleModal("cart-modal", false);
}

// Exibir detalhes do produto
function showProductDetail(name, imgSrc, description, price) {
    const detailSection = document.getElementById("product-detail-content");
    detailSection.innerHTML = `
        <img src="${imgSrc}" alt="${name}" class="product-detail-img">
        <div class="product-detail-info">
            <h3>${name}</h3>
            <p>${description}</p>
            <span class="price">R$ ${price.toFixed(2)}</span>
            <button class="add-to-cart" onclick="addToCart('${name}', ${price})">Adicionar ao Carrinho</button>
        </div>
    `;
}

// Carrinho de compras
function addToCart(productName, price) {
    cart.push({ name: productName, price });
    console.log(productName + " adicionado ao carrinho");

    // Chama o toast com a mensagem personalizada
    showToast(`${productName} foi adicionado ao carrinho!`);
}

function updateCartDisplay() {
    const cartItemsContainer = document.getElementById("cart-items");
    cartItemsContainer.innerHTML = cart.length
        ? cart.map(item => `<div class="cart-item"><span>${item.name}</span><span>R$ ${item.price.toFixed(2)}</span></div>`).join(" ")
        : "<p>Seu carrinho está vazio.</p>";

    const total = cart.reduce((sum, item) => sum + item.price, 0);
    document.getElementById("cart-total-price").textContent = `R$ ${total.toFixed(2)}`;
}


function finalizeOrder() {
    if (!cart.length) {
        alert("Seu carrinho está vazio! Adicione produtos antes de finalizar o pedido.");
        return;
    }

    // Cria o pedido no backend
    const orderData = cart.map(item => ({ name: item.name, price: item.price }));

    fetch('http://seu-servidor.com/api/orders', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ items: orderData })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            orders.push(orderData); // Adiciona o pedido à lista local
            cart = []; // Limpa o carrinho
            showOrderConfirmationPopup();
            updateAccountInfo();
            closeCart();

            setTimeout(() => {
                closeOrderConfirmationPopup();
                window.location.href = '#minhaConta';
            }, 3000);
        } else {
            alert("Erro ao finalizar o pedido.");
        }
    })
    .catch(error => {
        console.error('Erro ao criar o pedido:', error);
        alert("Houve um erro ao finalizar o pedido.");
    });
}

// Função para finalizar o pedido
function finalizeOrder() {
    if (!cart.length) {
        alert("Seu carrinho está vazio! Adicione produtos antes de finalizar o pedido.");
        return;
    }

    orders.push([...cart]);
    cart = [];

    showOrderConfirmationPopup();
    updateAccountInfo();
    closeCart();

    setTimeout(() => {
        closeOrderConfirmationPopup();
        window.location.href = '#minhaConta';
    }, 3000);
}~

function updateAccountInfo() {
    const accountInfoContainer = document.getElementById("account-info");

    fetch('http://seu-servidor.com/api/orders', {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success && data.orders.length > 0) {
            accountInfoContainer.innerHTML = data.orders.map((order, index) => {
                const items = order.items.map(item => `<div class="order-item">${item.name} - R$ ${item.price.toFixed(2)}</div>`).join("");
                const total = order.items.reduce((sum, item) => sum + item.price, 0);
                return `<div class="order"><h4>Pedido ${index + 1}:</h4>${items}<div class="order-total"><strong>Total: R$ ${total.toFixed(2)}</strong></div></div>`;
            }).join(" ");
        } else {
            accountInfoContainer.innerHTML = "<p>Nenhuma compra registrada.</p>";
        }
    })
    .catch(error => {
        console.error('Erro ao atualizar informações da conta:', error);
        accountInfoContainer.innerHTML = "<p>Erro ao carregar os dados.</p>";
    });
}


// Informações da conta
function updateAccountInfo() {
    const accountInfoContainer = document.getElementById("account-info");
    
    // Verifica se há pedidos
    if (orders.length > 0) {
        // Exibe os pedidos e o botão para enviar a conta
        accountInfoContainer.innerHTML = orders.map((order, index) => {
            const items = order.map(item => `<div class="order-item">${item.name} - R$ ${item.price.toFixed(2)}</div>`).join("");
            const total = order.reduce((sum, item) => sum + item.price, 0);
            return `<div class="order"><h4>Pedido ${index + 1}:</h4>${items}<div class="order-total"><strong>Total: R$ ${total.toFixed(2)}</strong></div></div>`;
        }).join(" ");

        function sendBillToWaiter() {
            const orderDetails = orders.map(order => ({
                items: order.map(item => ({ name: item.name, price: item.price }))
            }));
        
            fetch('http://seu-servidor.com/api/send-bill', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify({ orders: orderDetails })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    alert("A conta foi enviada para o garçom!");
                } else {
                    alert("Erro ao enviar a conta para o garçom.");
                }
            })
            .catch(error => {
                console.error('Erro ao enviar a conta:', error);
                alert("Houve um erro ao enviar a conta.");
            });
        }
        
        
        // Adiciona o botão "Enviar a conta para o garçom" abaixo dos pedidos
        accountInfoContainer.innerHTML += `
            <button class="send-bill-button" onclick="sendBillToWaiter()">Enviar a conta para o garçom</button>
        `;
    } else {
        // Exibe uma mensagem informando que não há compras registradas
        accountInfoContainer.innerHTML = "<p>Nenhuma compra registrada.</p>";
    }
}

// Função para enviar a conta para o garçom
function sendBillToWaiter() {
    alert("A conta foi enviada para o garçom!");
    // Aqui você pode adicionar lógica adicional, como enviar uma notificação ao garçom
}

function callWaiter() {
    fetch('http://seu-servidor.com/api/call-waiter', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ table: 29 })  // Exemplo: enviar o número da mesa
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            toggleModal("popup", true);
            setTimeout(closePopup, 3000);
        } else {
            alert("Erro ao chamar o garçom.");
        }
    })
    .catch(error => {
        console.error('Erro ao chamar o garçom:', error);
        alert("Houve um erro ao chamar o garçom.");
    });
}

// Chamar garçom com popup
function callWaiter() {
    toggleModal("popup", true);
    setTimeout(closePopup, 3000);
}

function closePopup() {
    toggleModal("popup", false);
}

// Função para exibir o toast de produto adicionado
function showToast() {
    const toast = document.querySelector('.toast');
    toast.classList.add('show');
    setTimeout(() => toast.classList.remove('show'), 3000);


    toastMessage.textContent = message; // Mensagem dinâmica do toast
    toast.classList.add("show"); // Adiciona a classe "show" para exibir

    // Após 3 segundos, remove a classe "show" e oculta o toast
    setTimeout(() => {
        toast.classList.remove("show");
    }, 3000); // 3000 milissegundos = 3 segundos
}

// Função para abrir o popup de confirmação de pedido
function showOrderConfirmationPopup() {
    const popup = document.getElementById('orderConfirmationPopup');
    popup.style.display = 'flex';
}

// Função para fechar o popup de confirmação de pedido
function closeOrderConfirmationPopup() {
    const popup = document.getElementById('orderConfirmationPopup');
    popup.style.display = 'none';
}
// Função para exibir o popup de confirmação
function sendBillToWaiter() {
    document.getElementById("sendBillPopup").style.display = "flex";
}

// Função para fechar o popup de confirmação
function closeSendBillPopup() {
    document.getElementById("sendBillPopup").style.display = "none";
}
function searchProducts() {
    const query = document.getElementById('searchBar').value.toLowerCase(); // Obtém o texto digitado
    const products = document.querySelectorAll('.product-card'); // Seleciona todos os cards de produtos

    products.forEach(product => {
        const productName = product.querySelector('.product-info h3').textContent.toLowerCase(); // Nome do produto
        if (productName.includes(query)) {
            product.style.display = 'block'; // Exibe o produto
        } else {
            product.style.display = 'none'; // Oculta o produto que não corresponde à pesquisa
        }
    });
}
