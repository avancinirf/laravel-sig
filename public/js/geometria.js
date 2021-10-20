var gestaoGeometrias = (function() {
    const $projeto_id = $('#projeto_id'),
    $geometria_arquivos = $('#geometria_arquivos');

    $projeto_id.on('change', function(){
        setArquivosOptions(this.value);
    })

    function setArquivosOptions(projeto_id) {
        DS.getArquivosPorProjetoId(projeto_id);
    };

    function atualizaArquivosOptions(arquivos) {
        $geometria_arquivos.empty();
        arquivos.forEach(arquivo => {
            $geometria_arquivos.append(`<option value=${arquivo.id}>${arquivo.nome}</option>`);
        });

    };



    const DS = (function() {

        const getArquivosPorProjetoId = function(projeto_id) {
            $.ajax({
                type: "GET",
                url: "getArquivosPorProjeto/" + projeto_id,
                success: function(resultado) {
                    atualizaArquivosOptions(resultado);
                },
                error: function(error) {
                    debugger
                },
            });
            /*
            $.ajax({
                type: 'GET',
                url: 'arquivo',
                data: formData,
                success: function(response){
                    console.log('teste success')
                    console.log(response)
                    alert(response);
                },
                error: function(error) {
                    $mensagemAlerta.html(error.responseJSON.message).show();
                    console.log(error.responseJSON.message);
                },
                complete: function() {
                    console.log('teste complete')
                }
            });*/
        }

        const editar = function() {
            console.log('DS-editar');
        }

        const remover = function() {
            console.log('DS-remover');
        }

        return {
            getArquivosPorProjetoId
        }

    })();


})()


//# sourceURL=geometria.js
