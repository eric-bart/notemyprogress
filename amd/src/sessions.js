define(["local_fliplearning/vue",
        "local_fliplearning/vuetify",
        "local_fliplearning/axios",
        "local_fliplearning/moment",
        "local_fliplearning/pagination",
        "local_fliplearning/chartstatic",
        "local_fliplearning/pageheader",
        "local_fliplearning/helpdialog",
    ],
    function(Vue, Vuetify, Axios, Moment, Pagination, ChartStatic, PageHeader, HelpDialog) {
        "use strict";

        function init(content) {
            // console.log(content);
            Vue.use(Vuetify);
            Vue.component('pagination', Pagination);
            Vue.component('chart', ChartStatic);
            Vue.component('pageheader', PageHeader);
            Vue.component('helpdialog', HelpDialog);
            let vue = new Vue({
                delimiters: ["[[", "]]"],
                el: "#work_sessions",
                vuetify: new Vuetify(),
                data() {
                    return {
                        strings : content.strings,
                        groups : content.groups,
                        userid : content.userid,
                        courseid : content.courseid,
                        timezone : content.timezone,
                        render_has : content.profile_render,
                        loading : false,
                        errors : [],

                        pages : content.pages,
                        hours_sessions: content.indicators.sessions,
                        session_count: content.indicators.count,
                        inverted_time: content.indicators.time,
                        inverted_time_colors: content.inverted_time_colors,
                        sessions_count_colors: content.sessions_count_colors,
                        search: null,

                        help_dialog: false,
                        help_contents: [],
                    }
                },
                mounted(){
                    document.querySelector("#sessions-loader").style.display = "none";
                    document.querySelector("#work_sessions").style.display = "block";
                },
                methods : {
                    get_help_content(){
                        let contents = [];
                        contents.push({
                            title: this.strings.section_help_title,
                            description: this.strings.section_help_description,
                        });
                        return contents;
                    },

                    update_interactions(week){
                        this.loading = true;
                        this.errors = [];
                        let data = {
                            action : "worksessions",
                            userid : this.userid,
                            courseid : this.courseid,
                            weekcode : week.weekcode,
                            profile : this.render_has,
                        }
                        Axios({
                            method:'get',
                            url: M.cfg.wwwroot + "/local/fliplearning/ajax.php",
                            params : data,
                        }).then((response) => {
                            if (response.status == 200 && response.data.ok) {
                                this.hours_sessions = response.data.data.indicators.sessions;
                                this.session_count = response.data.data.indicators.count;
                                this.inverted_time = response.data.data.indicators.time;
                            } else {
                                this.error_messages.push(this.strings.error_network);
                            }
                        }).catch((e) => {
                            this.errors.push(this.strings.api_error_network);
                        }).finally(() => {
                            this.loading = false;
                        });
                        return this.data;
                    },

                    get_point_category_name(point, dimension) {
                        let series = point.series,
                            isY = dimension === 'y',
                            axis = series[isY ? 'yAxis' : 'xAxis'];
                        return axis.categories[point[isY ? 'y' : 'x']];
                    },

                    build_hours_sessions_chart() {
                        let chart = new Object();
                        chart.title = {
                            text: null,
                        };
                        chart.chart = {
                            type: 'heatmap',
                            backgroundColor: null,
                            style: {fontFamily: 'poppins'},
                        };
                        chart.xAxis = {
                            categories: this.strings.days,
                        };
                        chart.yAxis = {
                            categories: this.strings.hours,
                            title: null,
                            reversed: true,
                        };
                        chart.colorAxis = {
                            min: 0,
                            minColor: '#E0E0E0',
                            maxColor: '#118AB2'
                        };
                        chart.legend = {
                            layout: 'horizontal',
                            verticalAlign: 'bottom',
                        };
                        chart.tooltip = {
                            formatter: function () {
                                let xCategoryName = vue.get_point_category_name(this.point, 'x');
                                let yCategoryName = vue.get_point_category_name(this.point, 'y');
                                let label = vue.strings.sessions_text;
                                if (this.point.value == 1) {
                                    label = vue.strings.session_text;
                                }
                                return '<b>' + xCategoryName + ' ' + yCategoryName + '</b>: '
                                    + this.point.value +' ' + label;
                            }
                        };
                        chart.series = [{
                            borderWidth: 2,
                            borderColor: '#FAFAFA',
                            data: this.hours_sessions,
                        }];
                        return chart;
                    },

                    build_inverted_time_chart() {
                        let chart = new Object();
                        chart.chart = {
                            type: 'bar',
                            backgroundColor: null,
                            style: {fontFamily: 'poppins'},
                        };
                        chart.title = {
                            text: null,
                        };
                        chart.colors = this.inverted_time_colors;
                        chart.xAxis = {
                            type: 'category',
                            crosshair: true,
                        };
                        chart.yAxis = {
                            title: {
                                text: this.strings.time_inverted_x_axis,
                            }
                        };
                        chart.tooltip = {
                            shared:true,
                            useHTML:true,
                            formatter: function () {
                                let category_name = this.points[0].key;
                                let time = vue.convert_time(this.y);
                                return `<b>${category_name}: </b>${time}`;
                            }
                        };
                        chart.legend = {
                            enabled: false
                        };
                        chart.series = [{
                            colorByPoint: true,
                            data: this.inverted_time.data
                        }];
                        return chart;
                    },

                    build_sessions_count_chart() {
                        let chart = new Object();
                        chart.chart = {
                            backgroundColor: null,
                            style: {fontFamily: 'poppins'},
                        };
                        chart.title = {
                            text: null,
                        };
                        chart.colors = this.sessions_count_colors;
                        chart.yAxis = {
                            title: {
                                text: this.strings.session_count_yaxis_title,
                            },
                            allowDecimals: false
                        };
                        chart.xAxis = {
                            categories: this.session_count.categories,
                        };
                        chart.tooltip = {
                            valueSuffix: this.strings.session_count_tooltip_suffix,
                        };
                        chart.legend = {
                            layout: 'horizontal',
                            verticalAlign: 'bottom',
                        };
                        chart.series = this.session_count.data
                        return chart;
                    },

                    convert_time(time) {
                        time *= 3600; // pasar las horas a segundos
                        let h = this.strings.hours_short;
                        let m = this.strings.minutes_short;
                        let s = this.strings.seconds_short;
                        let hours = Math.floor(time / 3600);
                        let minutes = Math.floor((time % 3600) / 60);
                        let seconds = Math.floor(time % 60);
                        let text;
                        if (hours >= 1) {
                            if (minutes >= 1) {
                                text = `${hours}${h} ${minutes}${m}`;
                            } else {
                                text = `${hours}${h}`;
                            }
                        } else if ((minutes >= 1)) {
                            if (seconds >= 1) {
                                text = `${minutes}${m} ${seconds}${s}`;
                            } else {
                                text = `${minutes}${m}`;
                            }
                        } else {
                            text = `${seconds}${s}`;
                        }
                        return text;
                    },

                    open_chart_help(chart) {
                        let contents = [];
                        if (chart == "inverted_time") {
                            contents.push({
                                title: this.strings.inverted_time_help_title,
                                description: this.strings.inverted_time_help_description_p1,
                            });
                            contents.push({
                                description: this.strings.inverted_time_help_description_p2,
                            });
                        } else if (chart == "hours_sessions") {
                            contents.push({
                                title: this.strings.hours_sessions_help_title,
                                description: this.strings.hours_sessions_help_description_p1,
                            });
                            contents.push({
                                description: this.strings.hours_sessions_help_description_p2,
                            });
                        } else if (chart == "sessions_count") {
                            contents.push({
                                title: this.strings.sessions_count_help_title,
                                description: this.strings.sessions_count_help_description_p1,
                            });
                            contents.push({
                                description: this.strings.sessions_count_help_description_p2,
                            });
                        }
                        this.help_contents = contents;
                        if (this.help_contents.length) {
                            this.help_dialog = true;
                        }
                    },

                    update_help_dialog (value) {
                        this.help_dialog = value;
                    },

                    get_timezone(){
                        let information = `${this.strings.ss_change_timezone} ${this.timezone}`
                        return information;
                    },
                }
            })

            setTimeout(function() {
                setEventListeners();
            }, 1000);

            function setEventListeners() {

                //Ajoute les sondes sur les différents boutons de téléchargement de graphique
                let button = document.getElementsByClassName('highcharts-a11y-proxy-button');
                button[0].id = "investedTime"; //button[0] is the button of the investedTime graphic
                button[1].id = "sessionsPerHour"; //button[1] is the button of the sessionsPerHour graphic
                button[2].id = "filterSessionsPerWeek"; //button[2] is the button to filter the sessionsPerWeek graphic per less than 30 minutes
                button[3].id = "filterSessionsPerWeek"; //button[3] is the button to filter the sessionsPerWeek graphic per more than 30 minutes
                button[4].id = "filterSessionsPerWeek"; //button[4] is the button to filter the sessionsPerWeek graphic per more than 60 minutes
                button[5].id = "sessionsPerWeek"; //button[5] is the button of the sessionsPerWeek graphic
                var action = "";
                var objectName = "";
                var objectType = "";
                var objectDescription = "";
                for(let i = 0; i<button.length;i++) {
                    button[i].addEventListener('click', function () {
                        let downloadButtons = document.getElementsByClassName('highcharts-menu');
                        for(i = 0; i<downloadButtons.length;i++) {
                            downloadButtons[i].addEventListener('mouseenter', function () {
                                this.id = this.parentElement.parentElement.id;
                                let downloadButtonsChilds = this.children;
                                for (let v = 0; v < downloadButtonsChilds.length; v++) {
                                    downloadButtonsChilds[v].id = this.id;
                                    downloadButtonsChilds[v].addEventListener('click', addLogsDownload);
                                }
                            });
                        }
                        if(this.id=="filterSessionsPerWeek") {
                            addLogsIntoDB("filtered", "graphic", "sessions_week", "Filter that allows to see only certain information of the graph sessions by weeks");
                        }
                    })
                }

                //Ajoute les sondes pour lorsque l'utilisateur entre sur les différents graphiques
                let graphics = document.querySelectorAll('.highcharts-container');
                graphics[0].id="investedTime";
                graphics[1].id="sessionsPerHour";
                graphics[2].id="sessionsPerWeek";
                graphics.forEach((graph) => {
                    graph.addEventListener('mouseenter', addLogsViewGraphic);
                })


                //Ajoute les sondes pour les clicks sur le menu de selection des differentes semaines
                let selectedPage = document.querySelectorAll('.pa-1.pr-4.pl-4.page.selected-page');
                selectedPage.forEach((page) => {
                    page.addEventListener('click', function() {
                        addLogsIntoDB("viewed", page.innerHTML, "week_section", "Week section that allows you to obtain information on a specific week");
                        setTimeout(setEventListeners, 1000);
                    });
                })


                let investedTimeStudent = document.getElementsByClassName('highcharts-series highcharts-series-0 highcharts-bar-series highcharts-tracker')[0].children;
                for(let i = 0; i<investedTimeStudent.length;i++) {
                    switch(investedTimeStudent[i].className.baseVal) {
                        case "highcharts-point highcharts-color-0":
                            investedTimeStudent[i].id="averageTime";
                            //document.getElementById('averageTime').addEventListener('mouseover', addLogsIntoDB("viewed", "data_graphic", "average_time", "Data informations from the graphic invested time wich give you informations about the average time spent by students"));

                            break;
                        case "highcharts-point highcharts-color-1":
                            investedTimeStudent[i].id="totalTime";
                            //document.getElementById('totalTime').addEventListener('mouseover', addLogsIntoDB("viewed", "data_graphic", "total_time", "Data informations from the graphic invested time wich give you informations about the total time to spend by students"));
                            break;
                    }
                }

                //Ajoute les sondes pour les clicks sur les menus d'aide des différents graphiques
                let help = document.querySelectorAll('.caption');
                help.forEach((help) => {
                    help.addEventListener('click', addLogsHelp);
                })


            }


                function addLogsHelp(e) {
                    event.stopPropagation();
                    var action = "";
                    var objectName = "";
                    var objectType = "";
                    var objectDescription = "";
                    switch(this.id) {
                        case "helpSubmissions":
                            action = "viewed";
                            objectType = "help";
                            objectName = "submissions"
                            objectDescription = "Help section that provides information about the submissions graph";
                            break;
                        case "helpContentAccess":
                            action = "viewed";
                            objectType = "help";
                            objectName = "content_access";
                            objectDescription = "Help section that provides information about the content accessed graph";
                            break;
                    }
                    addLogsIntoDB(action, objectName, objectType, objectDescription);
                }

                /**
                 * Add logs when a user are looking at the differents graphics
                 * @param e  the event
                 */
                function addLogsViewGraphic(e) {
                    event.stopPropagation();
                    var action = "";
                    var objectName = "";
                    var objectType = "";
                    var objectDescription = "";
                    switch(this.id) {
                        case "investedTime":
                            action = "viewed";
                            objectName = "invested_time";
                            objectType = "graphic";
                            objectDescription = "Bar graph that shows the average time invested by students as a function of the expected invested time";
                            break;
                        case "sessionsPerHour":
                            action = "viewed";
                            objectName = "sessions_hour";
                            objectType = "graphic";
                            objectDescription = "Graph showing the number of sessions performed according to the time of day";
                            break;
                        case "sessionsPerWeek":
                            action = "viewed";
                            objectName = "sessions_week";
                            objectType = "graphic";
                            objectDescription = "Graph showing the number of sessions performed per week";
                            break;
                        default:
                            action = "viewed";
                            objectName = "";
                            objectType = "graphic";
                            objectDescription = "A graphic";
                            break;
                    }
                   addLogsIntoDB(action, objectName, objectType, objectDescription);
                }

                /**
                 * Add a logs when a user is downloading a graphic
                 * @param e the event
                 */
                function addLogsDownload(e) {
                    this.removeEventListener('click', addLogsDownload);
                    var action = "";
                    var objectName = "";
                    var objectType = "";
                    var objectDescription = "";
                    switch(this.id) {
                        case "investedTime":
                            action = "downloaded";
                            objectName = "invested_time";
                            objectType = "graphic";
                            objectDescription = "Bar graph that shows the average time invested by students as a function of the expected invested time";
                            break;
                        case "sessionsPerHour":
                            action = "downloaded";
                            objectName = "sessions_hour";
                            objectType = "graphic";
                            objectDescription = "Graph showing the number of sessions performed according to the time of day";
                            break;
                        case "sessionsPerWeek":
                            action = "downloaded";
                            objectName = "sessions_week";
                            objectType = "graphic";
                            objectDescription = "Graph showing the number of sessions performed per week";
                            break;
                    }
                    addLogsIntoDB(action, objectName, objectType, objectDescription);
                }


                /**
                 * Add logs into the mongoDB database
                 *
                 */
                function addLogsIntoDB(action, objectName, objectType, objectDescription) {
                    console.log("Action: " + action + ", ObjectName: " + objectName + ", ObjectType: " + objectType + ", ObjectDescription: " + objectDescription);
                        let data = {
                            courseid: content.courseid,
                            userid: content.userid,
                            action: "addLogs",
                            sectionname: "TEACHER_STUDY_SESSIONS",
                            actiontype: action,
                            objectType: objectType,
                            objectName: objectName,
                            currentUrl: document.location.href,
                            objectDescription: objectDescription,
                        };
                        Axios({
                            method:'get',
                            url: M.cfg.wwwroot + "/local/fliplearning/ajax.php",
                            params : data,
                        }).then((response) => {
                            if (response.status == 200 && response.data.ok) {
                                console.log("Information envoyée");
                            } else {
                                console.log("Information non envoyée");
                            }
                        }).catch((e) => {
                            console.log("Problème rencontré");
                        });
                    }

        }

        return {
            init : init
        };
    });