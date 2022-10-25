//aqui só tem funções genéricas, por exemplo, inserir() é a mesma tanto para usuários quanto para produtos, o título dela ao invés de Inserir Usuário e Inserir Produto, será Inserir Registro, funções que não sejam genéricas, como limparCampos(), devem estar na própria página, por exemplo, em usuarios.php

$(document).ready(function () {
    listar();
});

function listar() {
    $.ajax({
        url: 'paginas/' + pag + "/listar.php", //apesar de ajax.js ser chamado em usuarios.php, que está dentro da pasta páginas, usuarios.php é chamado dentro de painel/index.php, que está fora da pasta páginas 
        //os campos method e data a seguir não fazem diferença, pois não haverá serialização de dados de nenhum formulário
        method: 'POST',
        data: $('#form').serialize(),
        dataType: "html", //não é texto, é html

        success: function (result) {
            $("#listar").html(result); //joga o resultado que trazer de listar.php na div com id listar
            $('#mensagem-excluir').text('');
        }
    });
}

function excluir(id) {
    $.ajax({
        url: 'paginas/' + pag + "/excluir.php",
        method: 'POST',
        data: { id },
        dataType: "text",

        success: function (mensagem) {
            if (mensagem.trim() == "Excluído com Sucesso") {
                listar();
            } else {
                $('#mensagem-excluir').addClass('text-danger')
                $('#mensagem-excluir').text(mensagem)
            }

        },

    });
}

function ativar(id, acao) {
    $.ajax({
        url: 'paginas/' + pag + "/mudar-status.php",
        method: 'POST',
        data: { id, acao },
        dataType: "text",

        success: function (mensagem) {
            if (mensagem.trim() == "Alterado com Sucesso") {
                listar();
            } else {
                $('#mensagem-excluir').addClass('text-danger')
                $('#mensagem-excluir').text(mensagem)
            }

        },

    });
}

function inserir() {
    $('#mensagem').text('');
    $('#titulo_inserir').text('Inserir Registro');
    $('#modalForm').modal('show');
    limparCampos();
}

$("#form").submit(function () {

    event.preventDefault();
    var formData = new FormData(this);

    $.ajax({
        url: 'paginas/' + pag + "/salvar.php",
        type: 'POST',
        data: formData,

        success: function (mensagem) {
            $('#mensagem').text('');
            $('#mensagem').removeClass()
            if (mensagem.trim() == "Salvo com Sucesso!") {

                $('#btn-fechar').click();
                listar();

            } else {

                $('#mensagem').addClass('text-danger')
                $('#mensagem').text(mensagem)
            }


        },

        cache: false,
        contentType: false,
        processData: false,

    });

});

