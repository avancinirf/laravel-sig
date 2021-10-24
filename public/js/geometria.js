var gestaoGeometrias = (function() {
    const $projeto_id = $('#projeto_id'),
    $geometria_arquivos = $('#geometria_arquivos');

    $projeto_id.on('change', function(){
        setArquivosOptions(this.value);
    })

    async function setArquivosOptions(projeto_id) {
        const arquivos = await DS.getArquivosPorProjetoId(projeto_id);
        atualizaArquivosOptions(arquivos);
    };

    function atualizaArquivosOptions(arquivos) {
        $geometria_arquivos.empty();
        if (!Array.isArray(arquivos)) return;
        arquivos.forEach(arquivo => {
            $geometria_arquivos.append(`<option value=${arquivo.id}>${arquivo.nome}</option>`);
        });
    };

    function preencheOldArquivosOptions(old_geometria_arquivos) {
        old_geometria_arquivos.forEach(arquivo => {
            $(`#geometria_arquivos option[value=${arquivo}]`).attr('selected', 'selected');
        });
    }



    const DS = (function() {

        const getArquivosPorProjetoId = async function(projeto_id) {
            try {
                const response = await axios.get(`getArquivosPorProjeto/${projeto_id}`);
                return response.data;
            } catch(error) {
                console.log(error); // Tratar a validação e enviar um erro ao utuário!
            }

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



    if (typeof(old_projeto_id) !== "undefined") {
        setArquivosOptions(old_projeto_id);
        if (typeof(old_geometria_arquivos) !== "undefined") {
            preencheOldArquivosOptions(old_geometria_arquivos);
        }
    }

})()


//# sourceURL=geometria.js
