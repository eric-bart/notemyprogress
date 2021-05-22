define([
        'highcharts',
        'highcharts/highcharts-3d',
        'highcharts/highcharts-more',
        'highcharts/modules/heatmap',
        'highcharts/modules/exporting',
        'highcharts/modules/export-data',
        'highcharts/modules/accessibility',
        'highcharts/modules/no-data-to-display'],
    function(Highcharts) {
        return {
            template: `<div v-bind:id="container"></div>`,
            props: ['container', 'chart', 'lang', 'test'],
            data() {
                return { }
            },
            mounted() {
                (this.lang) && Highcharts.setOptions({
                    lang: this.lang,
                    credits: { enabled: false },
                    exporting: {
                        buttons: {
                            contextButton: {
                                menuItems: [{
                                    text: this.lang.downloadPNG,
                                    onclick: function () {
                                        this.exportChart({
                                            type: 'image/png'
                                        });
                                        console.log(this.lang.scriptname);
                                    }
                                },{
                                    text: this.lang.downloadJPEG,
                                    onclick: function () {
                                        this.exportChart({
                                            type: 'image/jpeg'
                                        });
                                        //ici logs
                                    }
                                },{
                                    text: this.lang.downloadPDF,
                                    onclick: function () {
                                        this.exportChart({
                                            type: 'application/pdf'
                                        });
                                        //ici logs
                                    }
                                },{
                                    text: this.lang.downloadSVG,
                                    onclick: function () {
                                        this.exportChart({
                                            type: 'image/svg+xml'
                                        });
                                        //ici logs
                                    }
                                },{
                                    text: this.lang.downloadXLS,
                                    onclick: function () {
                                        this.downloadXLS();
                                        //ici logs
                                    }
                                },{
                                    text: this.lang.downloadCSV,
                                    onclick: function () {
                                        this.downloadCSV();
                                        //ici logs
                                    }
                                }],
                                symbol: 'menuball',
                                symbolStroke: '#118AB2'
                            }
                        }
                    }
                });
                this._highchart = Highcharts.chart(this.container, this.chart);
            }
        };
    });