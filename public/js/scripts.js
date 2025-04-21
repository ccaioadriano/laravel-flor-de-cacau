

// Inicialização do carrinho
let cart = [];
const clearCartButton = document.getElementById("clearCartButton");

function clearCart() {
    cart = [];
    updateCart();
}

// Função para adicionar produto ao carrinho
function addToCart(title, price, image) {
    // Verificar se o produto já está no carrinho
    const existingItem = cart.find((item) => item.title === title);

    if (existingItem) {
        // Se já existe, aumenta a quantidade
        existingItem.quantity += 1;
    } else {
        // Se não existe, adiciona ao carrinho
        cart.push({
            title: title,
            price: price,
            image: image,
            quantity: 1,
        });
    }

    // Atualiza o carrinho
    updateCart();

    // Feedback visual
    alert("Produto adicionado ao carrinho!");
}

// Função para remover produto do carrinho
function removeFromCart(index) {
    cart.splice(index, 1);
    updateCart();
}

// Função para atualizar a exibição do carrinho
function updateCart() {
    verifyEmptyButton();
    const cartCount = document.getElementById("cart-count");
    const cartItems = document.getElementById("cart-items");
    const cartTotal = document.getElementById("cart-total");

    // Atualiza o contador
    const totalItems = cart.reduce((total, item) => total + item.quantity, 0);
    cartCount.textContent = totalItems;

    // Atualiza os itens do carrinho
    if (cart.length === 0) {
        cartItems.innerHTML =
            '<div class="text-gray-500 text-center py-4">Seu carrinho está vazio</div>';
    } else {
        cartItems.innerHTML = "";

        cart.forEach((item, index) => {
            const itemElement = document.createElement("div");
            itemElement.className =
                "flex items-center justify-between py-3 border-b";
            itemElement.innerHTML = `
                    <div class="flex items-center">
                        <img src="${item.image}" alt="${
                item.title
            }" class="w-12 h-12 object-cover rounded-md">
                        <div class="ml-3">
                            <div class="text-sm font-medium text-gray-900">${
                                item.title
                            }</div>
                            <div class="text-sm text-gray-500">R$ ${item.price.toFixed(
                                2
                            )} x ${item.quantity}</div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <button onclick="removeFromCart(${index})" class="text-gray-500 hover:text-red-500">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                `;
            cartItems.appendChild(itemElement);
        });
    }

    // Atualiza o total
    const total = cart.reduce(
        (sum, item) => sum + item.price * item.quantity,
        0
    );
    cartTotal.textContent = Utils.formatCurrency(total)

    // Salva o carrinho no localStorage
    localStorage.setItem("cart", JSON.stringify(cart));
}

// Função para finalizar o pedido
function checkout() {
    if (cart.length === 0) {
        alert("Seu carrinho está vazio!");
        return;
    }

    // Prepara a mensagem para o WhatsApp
    let message = "Olá! Gostaria de fazer o seguinte pedido:\n\n";

    cart.forEach((item) => {
        message += `${item.quantity}x ${item.title}: ${Utils.formatCurrency(item.price * item.quantity)}\n`;
    });

    const total = cart.reduce(
        (sum, item) => sum + item.price * item.quantity,
        0
    );
    message += `\nTotal: ${Utils.formatCurrency(total)}`;

    // Codifica a mensagem para URL
    const encodedMessage = encodeURIComponent(message);

    // Abre o WhatsApp com a mensagem
    window.open(`https://wa.me/31994409981?text=${encodedMessage}`, "_blank");

    // Limpa o carrinho após finalizar o pedido
    clearCart();
    closeCartModal()
}

// Funções para abrir e fechar o modal do carrinho
function openCartModal() {
    document.getElementById("cart-modal").classList.remove("hidden");
    document.body.style.overflow = "hidden"; // Impede rolagem da página
    verifyEmptyButton();
}

function verifyEmptyButton() {
    if (cart.length !== 0) {
        clearCartButton.innerHTML = `
            <button id="empty-cart-button" onclick="clearCart()"
                    class="w-full bg-red-500 text-white py-3 rounded-md hover:bg-red-600 transition-all duration-300 flex items-center justify-center">
                    <i class="fas fa-trash-alt mr-2"></i> Esvaziar Carrinho
                </button>
            `;
    } else {
        clearCartButton.innerHTML = "";
    }
}

function closeCartModal() {
    document.getElementById("cart-modal").classList.add("hidden");
    document.body.style.overflow = "auto"; // Permite rolagem da página
}

// Carrega o carrinho do localStorage ao iniciar a página
document.addEventListener("DOMContentLoaded", function () {
    const savedCart = localStorage.getItem("cart");
    if (savedCart) {
        cart = JSON.parse(savedCart);
        updateCart();
    }

    // Adiciona os event listeners
    document
        .getElementById("cart-button")
        .addEventListener("click", openCartModal);
    document
        .getElementById("close-cart")
        .addEventListener("click", closeCartModal);

    // Fecha o modal ao clicar fora dele
    document
        .getElementById("cart-modal")
        .addEventListener("click", function (event) {
            if (event.target === this) {
                closeCartModal();
            }
        });
});
