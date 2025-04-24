// Inicialização do carrinho
let cart = [];

// Document Ready (equivalente ao DOMContentLoaded)
$(document).ready(function () {
    // Carrega o carrinho do localStorage
    const savedCart = localStorage.getItem("cart");
    if (savedCart) {
        cart = JSON.parse(savedCart);
        updateCart();
    }

    // Event Listeners
    $("#cart-button").on("click", openCartModal);
    $("#close-cart").on("click", closeCartModal);

    // Fecha o modal ao clicar fora dele
    $("#cart-modal").on("click", function (event) {
        if (event.target === this) {
            closeCartModal();
        }
    });
});

// Limpar carrinho
function clearCart() {
    cart = [];
    updateCart();
}

// Adicionar ao carrinho
function addToCart(title, price, image, qtd) {
    qtd = parseInt(qtd);
    const existingItem = cart.find((item) => item.title === title);

    if (existingItem) {
        existingItem.quantity += qtd;
    } else {
        cart.push({
            title: title,
            price: price,
            image: image,
            quantity: qtd,
        });
    }

    updateCart();
    alert("Produto adicionado ao carrinho!");
}

// Remover do carrinho
function removeFromCart(index) {
    cart.splice(index, 1);
    updateCart();
}

// Atualizar carrinho
function updateCart() {
    verifyEmptyButton();

    // Atualiza contador
    const totalItems = cart.reduce(
        (total, item) => total + parseInt(item.quantity),
        0
    );
    $("#cart-count").html(totalItems);

    // Atualiza itens
    const $cartItems = $("#cart-items");

    if (cart.length === 0) {
        $cartItems.html(
            '<div class="text-gray-500 text-center py-4">Seu carrinho está vazio</div>'
        );
    } else {
        $cartItems.empty();

        cart.forEach((item, index) => {
            const itemHtml = `
                <div class="flex items-center justify-between py-3 border-b">
                    <div class="flex items-center">
                        <img src="${item.image}" alt="${
                item.title
            }" class="w-12 h-12 object-cover rounded-md">
                        <div class="ml-3">
                            <div class="text-sm font-medium text-gray-900">${
                                item.title
                            }</div>
                            <div class="text-sm text-gray-500">
                                ${Utils.formatCurrency(
                                    item.price
                                )} x ${parseInt(item.quantity)}
                            </div>
                        </div>
                    </div>
                    <div class="flex items-center">
                        <button class="text-gray-500 hover:text-red-500 remove-item" data-index="${index}">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </div>
                </div>
            `;
            $cartItems.append(itemHtml);
        });

        // Event listener para botões de remover
        $(".remove-item").on("click", function () {
            const index = $(this).data("index");
            removeFromCart(index);
        });
    }

    // Atualiza total
    const total = cart.reduce(
        (sum, item) => sum + item.price * parseInt(item.quantity),
        0
    );
    $("#cart-total").text(Utils.formatCurrency(total));

    // Salva no localStorage
    localStorage.setItem("cart", JSON.stringify(cart));
}

// Checkout
function checkout() {
    if (cart.length === 0) {
        alert("Seu carrinho está vazio!");
        return;
    }

    let message = "Olá! Gostaria de fazer o seguinte pedido:\n\n";

    cart.forEach((item) => {
        message += `${item.quantity}x ${item.title}: ${Utils.formatCurrency(
            item.price * item.quantity
        )}\n`;
    });

    const total = cart.reduce(
        (sum, item) => sum + item.price * item.quantity,
        0
    );
    message += `\nTotal: ${Utils.formatCurrency(total)}`;

    Utils.sendMessageWhatsapp(message, "55994409981");

    clearCart();
    closeCartModal();
}

// Funções do Modal do Carrinho
function openCartModal() {
    $("#cart-modal").removeClass("hidden");
    $("body").css("overflow", "hidden");
    verifyEmptyButton();
}

function closeCartModal() {
    $("#cart-modal").addClass("hidden");
    $("body").css("overflow", "auto");
}

function verifyEmptyButton() {
    const $clearCartButton = $("#clearCartButton");

    if (cart.length !== 0) {
        $clearCartButton.html(`
            <button id="empty-cart-button" class="w-full bg-red-500 text-white py-3 rounded-md hover:bg-red-600 transition-all duration-300 flex items-center justify-center">
                <i class="fas fa-trash-alt mr-2"></i> Esvaziar Carrinho
            </button>
        `);
        $("#empty-cart-button").on("click", clearCart);
    } else {
        $clearCartButton.empty();
    }
}

// Funções dos Modais de Edição
function openEditImageModal(productId) {
    $(`#imageModal-${productId}`).removeClass("hidden");
    $("body").css("overflow", "hidden");
}

function openPriceModal(productId) {
    $(`#priceModal-${productId}`).removeClass("hidden");
    $("body").css("overflow", "hidden");
    applyMask(`#price-${productId}`);
}

function closeModal(modalId) {
    $(`#${modalId}`).addClass("hidden");
    $("body").css("overflow", "auto");
}

function applyMask(input) {
    $(input).maskMoney({prefix:'R$ ', allowNegative: true, thousands:'.', decimal:',', affixesStay: false});
}


