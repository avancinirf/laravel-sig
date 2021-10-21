(function(){
    "use strict";

    const config = (function() {

        //Init BaseMaps
        var baseLayers = {
            'Satélite': L.tileLayer('http://{s}.google.com/vt/lyrs=s&x={x}&y={y}&z={z}',
            {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }),
            'Terreno': L.tileLayer('http://{s}.google.com/vt/lyrs=p&x={x}&y={y}&z={z}',
            {
                maxZoom: 20,
                subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
            }),
            'Mapa': L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png'),
            'Sem Mapa': L.tileLayer('',{ maxZoom: 20 }),
        };


        // TODO - Pegar o center de um layer específico padrão, assim como o zoom.
        const options = {
            'zoom': 16,
            'center': [-22.222108, -43.123072], // TODO - Alterar para automatizar a camada aos layers
            'zoomControl': false, // Whether the zoom control buttons is added to the map
            'zoomAnimation': false, // animations on zoom (performance)
            'maxZoom': 20, // The maximum zoom lvl
            'minZoom': 1, // minimum zoom lvl
            'boxZoom': true, // Whether the map can be zoomed to a rectangular area specified by dragging the mouse while pressing shift.
            'closePopupOnClick': true, // Set it to false if you don't want popups to close when user clicks the map.
            'layers': [baseLayers['Satélite']]
        };

        return {
            options,
            baseLayers
        };

    })();


    // Map Controller
    const MC = (function MapController() {

        var overlayMaps = [];

        const $modalLayer = $('#modal-layer-mapa'),
                $modalLayerTitle = $('#modal-layer-mapa-title'),
                $modalLayerBody = $('#modal-layer-mapa-body');

        // Inicialização do mapa
        var map = L.map('mapa', config.options);
        //var layerControl = L.control.layers(config.baseLayers, overlayMaps).addTo(map);
		L.control.scale({ imperial: false }).addTo(map);
		L.control.zoom({ position: 'bottomright' }).addTo(map);


        /*
        TODO: Remover esta parte.
        Exemplo de como inserir um arquivo kml no mapa utilizando a lib
        // var teste123 = omnivore.kml('http://consigsa.test/linha_teste.kml');


        // Esta parte utiliza a função de download que devolve o nome corrigido do ficheiro para kml
        //omnivore.kml('http://consigsa.test/app/geometria/download/1').addTo(map);
        //omnivore.kml('http://consigsa.test/app/geometria/download/2').addTo(map);
        */

        function mostrarDados() {
            //console.log('teste 1');
        }

        // Adiciona todos os arquivos kml no mapa
        projeto.geometrias.forEach(kml => {
            overlayMaps[kml.nome] = omnivore.kml(`http://consigsa.test/app/geometria/download/${kml.id}`)
            /* POPUP original do leaflet com os dados de cada layer
            .bindPopup(
                function (layer) {
                    let textoPopup = '';
                    for (const [key, value] of Object.entries(layer.feature.properties)) {
                        textoPopup += `<label><b>${key.toUpperCase()}:</b> ${value}</label><br>`
                    }
                    if (kml.arquivos) {
                        textoPopup += `<hr>
                                        <label><b>ARQUIVOS RELACIONADOS</b></label>
                                        <ul class="map-popul-list">`;
                        kml.arquivos.forEach(function(arquivo) {
                            const nome = `${arquivo.nome}.${arquivo.arquivo.split('.')[1]}`;
                            textoPopup += `<li><a href="/app/arquivo/download/${arquivo.id}"><i class="bi bi-box-arrow-down"></i></a> ${nome}</li>`;
                            textoPopup += `<li><a href="/app/arquivo/download/${arquivo.id}"><i class="bi bi-box-arrow-down"></i></a> ${nome}</li>`;
                        });
                        textoPopup += '</ul>';
                    }

                    return textoPopup;
                }
            );
            */

            overlayMaps[kml.nome].addTo(map);
            //omnivore.kml(`http://consigsa.test/app/geometria/download/${kml.id}`).addTo(map);
            //kmls[kml.nome] = omnivore.kml(`http://consigsa.test/app/geometria/download/${kml.id}`);
        });

        L.control.layers(config.baseLayers, overlayMaps).addTo(map);



        map.eachLayer(function(layer) {
            layer.on('click', function(e) {
                showFeatureInfo(e);
            });
        });

        function showFeatureInfo(e) {
            let nomeGeometria = '';
            for (var [key, value] of Object.entries(overlayMaps)) {
                if (value._leaflet_id == e.target._leaflet_id) nomeGeometria = key;
            }
            let geometria = projeto.geometrias.find(e => e.nome == nomeGeometria);
            if (!nomeGeometria) return;

            // Exibir os dados do kml em uma div modal ou algo do tipo
            console.log(nomeGeometria)
            console.log(geometria)

            preencheModalLayer(nomeGeometria, geometria, e.layer.feature.properties)
            $modalLayer.modal('show');
        }

        function preencheModalLayer(nomeGeometria, geometria, atributos) {

            let textoModalBody = '';

            for (const [key, value] of Object.entries(atributos)) {
                textoModalBody += `<label class="modal-layer-mapa-body-label"><b>${key.toUpperCase()}:</b> ${value}</label><br>`;
            }
            if (geometria.arquivos) {
                textoModalBody += `
                                <label class="modal-layer-mapa-body-subtitulo"><b>ARQUIVOS RELACIONADOS</b></label>
                                <ul class="map-popup-list">`;
                geometria.arquivos.forEach(function(arquivo) {
                    const nome = `${arquivo.nome}.${arquivo.arquivo.split('.')[1]}`;
                    textoModalBody += `<a href="/app/arquivo/download/${arquivo.id}"><li><i class="bi bi-box-arrow-down"></i> ${nome}</li></a>`;
                });
                textoModalBody += '</ul>';
            }

            if (!nomeGeometria.length) nomeGeometria = 'Nome da geometria não informado!!!';
            if (!atributos.length && !geometria.arquivos.length) textoModalBody = 'Nenhuma informação ou arquivo disponível para a geometria selecionada!!!';


            $modalLayerTitle.html(nomeGeometria.split('.')[0]);
            $modalLayerBody.html(textoModalBody);
        }


        // Centraliza o mapa pelas layers
        //map.fitBounds(municipiosLayer.getBounds());

    })();


})();

//# sourceURL=mapa.js
