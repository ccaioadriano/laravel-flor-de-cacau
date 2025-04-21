const Utils = {
    formatCurrency: (value) => {
        return new Intl.NumberFormat("pt-BR", {
            style: "currency",
            currency: "BRL",
        }).format(value);
    }
}

//crie um objeto no navegador com as funções que eu preciso globalmente
window.Utils = Utils;
