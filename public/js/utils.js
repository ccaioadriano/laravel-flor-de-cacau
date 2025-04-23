const Utils = {
    formatCurrency: (value) => {
        return new Intl.NumberFormat("pt-BR", {
            style: "currency",
            currency: "BRL",
        }).format(value);
    },

    sendMessageWhatsapp: (message, number) => {
        const encodedMessage = encodeURIComponent(message? message : "Olá Gostaria de fazer um pedido.");

        window.open(`https://wa.me/${number}?text=${encodedMessage}`, "_blank");
    }
}

//crie um objeto no navegador com as funções que eu preciso globalmente
window.Utils = Utils;
