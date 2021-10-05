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
            'zoom': 15,
            'center': [-22.33015, -43.096734], // TODO - Alterar para automatizar a camada aos layers
            'zoomControl': false, // Whether the zoom control buttons is added to the map
            'zoomAnimation': false, // animations on zoom (performance)
            'maxZoom': 20, // The maximum zoom lvl
            'minZoom': 15, // minimum zoom lvl
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

        // Inicialização do mapa
        var map = L.map('mapa', config.options);
        var layerControl = L.control.layers(config.baseLayers).addTo(map);
		L.control.scale({ imperial: false }).addTo(map);

    })();


})();

//# sourceURL=mapa.js
