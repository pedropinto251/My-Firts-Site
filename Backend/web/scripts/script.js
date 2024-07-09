function selecionarTipoProduto() {
    var categoryExpiration = event.target.options[event.target.selectedIndex].dataset.expiration;

    if (categoryExpiration == 1) {
        document.getElementById("divExpirationDate").style.display = "block";
    } else {
        document.getElementById("divExpirationDate").style.display = "none";
    }
}

function goBackProduto(input) {
    
    switch (input) {
        case 'Nome':
            alert("Insira um nome válido.");
            history.go(-1);
            break;
        case 'Descricao':
            alert("A descrição não pode ter mais de 500 caracteres.");
            history.go(-1);
            break;
        case 'Preco':
            alert("Insira um preço válido.");
            history.go(-1);
            break;
        case 'Quantidade':
            alert("Insira uma quantidade válida.");
            history.go(-1);
            break;
        case 'ImagensTamanho':
            alert("Só pode inserir 3 imagens por produto.");
            history.go(-1);
            break;
        case 'ImagensExtensao':
            alert("A imagem inserida não é válida.");
            history.go(-1);
            break;
        case 'Categoria':
            alert("Tem de inserir uma categoria.");
            history.go(-1);
            break;
        case 'TaxaIva':
            alert("Tem de inserir uma taxa de iva.");
            history.go(-1);
            break;
    }
}

function goBackCategoria(input) {
    
    switch (input) {
        case 'Nome':
            alert("Insira um nome válido.");
            history.go(-1);
            break;
    }
}

function goBackTaxaIva(input) {
    
    switch (input) {
        case 'TaxaIva':
            alert("Insira uma taxa de iva válida.");
            history.go(-1);
            break;
    }
}

function goBackDiscount(input) {
    
    switch (input) {
        case 'Produto':
            alert("Insira um produto.");
            history.go(-1);
            break;
        case 'PercentagemDesconto':
            alert("Insira uma percentagem de desconto válida.");
            history.go(-1);
            break;
    }
}

function back(){
    history.go(-1);
}

function logout(){
    $.ajax({
        url: "../../../common/Logout.php",
        success: function() {
        }                        
    });
}