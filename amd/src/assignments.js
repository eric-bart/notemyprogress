define(["local_fliplearning/vue",
        "local_fliplearning/vuetify",
        "local_fliplearning/axios",
        "local_fliplearning/moment",
        "local_fliplearning/pagination",
        "local_fliplearning/chartdynamic",
        "local_fliplearning/pageheader",
        "local_fliplearning/emailform",
        "local_fliplearning/helpdialog",
    ],
    function(Vue, Vuetify, Axios, Moment, Pagination, ChartDynamic, PageHeader, EmailForm, HelpDialog) {
        "use strict";

        function init(content) {
            // console.log(content);
            Vue.use(Vuetify)
            Vue.component('pagination', Pagination);
            Vue.component('chart', ChartDynamic);
            Vue.component('pageheader', PageHeader);
            Vue.component('emailform', EmailForm);
            Vue.component('helpdialog', HelpDialog);
            let vue = new Vue({
                delimiters: ["[[", "]]"],
                el: "#submissions",
                vuetify: new Vuetify(),
                data() {
                    return {
                        dialog : false,
                        selected_users : [],
                        modulename : "",
                        moduleid : false,
                        strings : content.strings,
                        groups : content.groups,
                        userid : content.userid,
                        courseid : content.courseid,
                        timezone : content.timezone,
                        render_has : content.profile_render,
                        scriptname: content.scriptname,
                        loading : false,
                        errors : [],
                        pages : content.pages,
                        submissions: content.submissions,
                        email_strings: content.strings.email_strings,

                        access: content.access,
                        assigns_submissions_colors: content.assigns_submissions_colors,
                        access_content_colors: content.access_content_colors,
                        access_chart_categories: [],
                        access_chart_series: [],
                        access_chart_users: [],

                        help_dialog: false,
                        help_contents: [],
                    }
                },
                beforeMount(){
                    this.generate_access_content_data();
                },
                mounted(){
                    document.querySelector("#sessions-loader").style.display = "none";
                    document.querySelector("#submissions").style.display = "block";
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
                            action : "assignments",
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
                                this.submissions = response.data.data.submissions;
                                this.access = response.data.data.access;
                                this.generate_access_content_data();
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

                    build_assigns_submissions_chart() {
                        let chart = new Object();
                        chart.chart = {
                            type: 'column',
                            backgroundColor: null,
                            style: {fontFamily: 'poppins'},
                        };
                        chart.title = {
                            text: null,
                        };
                        chart.colors = this.assigns_submissions_colors;
                        chart.xAxis = {
                            categories: this.submissions.categories,
                            crosshair: true,
                        };
                        chart.yAxis = {
                            min: 0,
                            title: {
                                text: this.strings.assignsubs_chart_yaxis
                            },
                            allowDecimals: false,
                        };
                        chart.tooltip = {
                            formatter: function () {
                                let label = this.x.split('</b>');
                                label = label[0] || '';
                                label = label.split('<b>');
                                label = label[1] || '';
                                let serie_name = this.series.name;
                                let value = this.y;
                                let students_label = vue.strings.students_text;
                                let send_mail = vue.strings.send_mail;
                                if (value == 1) {
                                    students_label = vue.strings.student_text;
                                }
                                let text = '<b>' + label +'</b><br/>' + '<b>' + serie_name +': </b>' +
                                            value + ' ' + students_label + '<br/>' + send_mail;
                                return text;
                            }
                        };
                        chart.plotOptions = {
                            series: {
                                cursor: 'pointer',
                                    point: {
                                    events: {
                                        click: function () {
                                            let serie_name = this.category.split('</b>');
                                            serie_name = serie_name[0] || '';
                                            serie_name = serie_name.split('<b>');
                                            serie_name = serie_name[1] || '';
                                            vue.email_strings.subject = vue.email_strings.subject_prefix+" - "+serie_name;

                                            let x = this.x;
                                            let column = this.series.colorIndex;
                                            vue.dialog = true;
                                            vue.selected_users = vue.submissions.users[x][column];
                                            vue.moduleid = vue.submissions.modules[x];
                                            vue.modulename = "assign";
                                            vue.scriptname = "test";
                                        }
                                    }
                                }
                            }
                        };
                        chart.series = this.submissions.data;
                        return chart;
                    },

                    build_access_content_chart() {
                        let chart = new Object();
                        chart.chart = {
                            type: 'bar',
                            backgroundColor: null,
                            style: {fontFamily: 'poppins'},
                        };
                        chart.title = {text: null};
                        chart.colors = this.access_content_colors;
                        chart.xAxis = {
                            categories: this.access_chart_categories,
                            title: { text: null },
                            crosshair: true,
                        };
                        chart.yAxis = {
                            min: 0,
                            title: {
                                text: this.strings.access_chart_yaxis_label,
                            },
                            labels: {
                                overflow: 'justify'
                            },
                            allowDecimals: false,
                        };
                        chart.tooltip = {
                            formatter: function () {
                                let label = this.x;
                                let serie_name = this.series.name;
                                let value = this.y;
                                let students_label = vue.strings.students_text;
                                let send_mail = vue.strings.send_mail;
                                if (value == 1) {
                                    students_label = vue.strings.student_text;
                                }
                                let text = '<b>' + label +'</b><br/>' + '<b>' + serie_name +': </b>' +
                                    value + ' ' + students_label + '<br/>' + send_mail;
                                return text;
                            }
                        };
                        chart.plotOptions = {
                            bar: {
                                dataLabels: {
                                    enabled: false
                                }
                            },
                            series: {
                                cursor: 'pointer',
                                    point: {
                                    events: {
                                        click: function () {
                                            let serie_name = this.category;
                                            vue.email_strings.subject = vue.email_strings.subject_prefix+" - "+serie_name;
                                            let x = this.x;
                                            let column = this.series.colorIndex;
                                            let users = vue.get_users(vue.access_chart_users[x][column]);
                                            vue.selected_users = users;
                                            let module = vue.get_moduletype(this.category);
                                            vue.modulename = module.type;
                                            vue.moduleid = module.id;
                                            vue.dialog = true;
                                            vue.scriptname = "test";
                                        }
                                    }
                                }
                            }
                        };
                        chart.series = this.access_chart_series;
                        return chart;
                    },

                    update_dialog (value) {
                        this.dialog = value;
                    },

                    generate_access_content_data() {
                        let usersIds = [];
                        this.access.users.forEach(user => {
                            usersIds.push(Number(user.id));
                        });
                        let selected_types_labels = [];
                        this.access.types.forEach(item => {
                            if (item.show) {
                                selected_types_labels.push(item.type);
                            }
                        });
                        let selected_modules = [];
                        this.access.modules.forEach(module => {
                            if (selected_types_labels.includes(module.type)) {
                                selected_modules.push(module);
                            }
                        });
                        let categories = [];
                        let modules_users = [];
                        let access_users_data = [];
                        let no_access_users_data = [];
                        selected_modules.forEach(module => {
                            categories.push(module.name);
                            let access_users = module.users;
                            let no_access_users = usersIds.filter(x => !access_users.includes(x));
                            access_users_data.push(access_users.length);
                            no_access_users_data.push(no_access_users.length);
                            modules_users.push([access_users, no_access_users]);
                        });
                        let series = [
                            { name: this.strings.access, data: access_users_data },
                            { name: this.strings.no_access, data: no_access_users_data },
                        ];
                        this.access_chart_categories = categories;
                        this.access_chart_series = series;
                        this.access_chart_users = modules_users;
                    },

                    get_users(ids) {
                        let users = [];
                        this.access.users.forEach(user => {
                            let userid = Number(user.id);
                            if (ids.includes(userid)) {
                                users.push(user);
                            }
                        });
                        return users;
                    },

                    get_moduletype(modulename) {
                        let mod;
                        this.access.modules.forEach(module => {
                            if (module.name === modulename) {
                                mod = module;
                            }
                        });
                        return mod;
                    },

                    open_chart_help(chart) {
                        let contents = [];
                        if (chart == "assigns_submissions") {
                            contents.push({
                                title: this.strings.assigns_submissions_help_title,
                                description: this.strings.assigns_submissions_help_description_p1,
                            });
                            contents.push({
                                description: this.strings.assigns_submissions_help_description_p2,
                            });
                        } else if (chart == "access_content") {
                            contents.push({
                                title: this.strings.access_content_help_title,
                                description: this.strings.access_content_help_description_p1,
                            });
                            contents.push({
                                description: this.strings.access_content_help_description_p2,
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
                //setFiltersContentAccess();
            }, 1000);

            function setEventListeners() {
                //Ajoute les sondes sur les différents boutons de téléchargement de graphique
                let button = document.getElementsByClassName('highcharts-a11y-proxy-button');
                button[0].id = "filterSubmissions";
                button[1].id = "filterSubmissions";
                button[2].id = "filterSubmissions";
                button[3].id = "submissions";
                button[6].id = "accessContent";

                var action = "";
                var objectName = "";
                var objectType = "";
                var objectDescription = "";
                for (let i = 0; i < button.length; i++) {
                    button[i].addEventListener('click', function () {
                            let id = this.id;
                            let downloadButtons = document.getElementsByClassName('highcharts-menu');
                            for (i = 0; i < downloadButtons.length; i++) {
                                downloadButtons[i].addEventListener('mouseenter', function () {
                                    this.id = id;
                                    let downloadButtonsChilds = this.children;
                                    for (let v = 0; v < downloadButtonsChilds.length; v++) {
                                        downloadButtonsChilds[v].id = this.id;
                                        downloadButtonsChilds[v].addEventListener('click', addLogsDownload);
                                    }
                                });
                            }
                            switch (this.id) {
                                case "filterSubmissions":
                                    addLogsIntoDB("filtered", "submissions", "graphic","Filter that allows to see only certain information of the graph submissions");
                                    break;
                            }
                    });

                }



                let graphics = document.querySelectorAll('.highcharts-container');
                graphics[0].id="submissions";
                graphics[1].id="accessContent";
                graphics.forEach((graph) => {
                    graph.addEventListener('mouseenter', addLogsViewGraphic);
                })

                let filtersButtonsAccessed = document.querySelectorAll('.v-input--selection-controls__ripple');
                filtersButtonsAccessed.forEach((button) => {
                    button.addEventListener('click', function() {
                        addLogsIntoDB("filtered", "accessed_content", "graphic", "Filter that allows to see only certain information of the graph access content");
                        //setFiltersContentAccess();
                    })
                })


                //Ajoute les sondes pour les clicks sur le menu de selection des differentes semaines
                let selectedPage = document.querySelectorAll('.pa-1.pr-4.pl-4.page.selected-page');
                selectedPage.forEach((page) => {
                    page.addEventListener('click', function() {
                        addLogsIntoDB("viewed", page.innerHTML, "week_section", "Week section that allows you to obtain information on a specific week");
                        setTimeout(setEventListeners, 1000);
                    });
                })

                //Ajoute les sondes pour les clicks sur les menus d'aide des différents graphiques
                let help = document.querySelectorAll('.caption');
                help.forEach((help) => {
                    help.addEventListener('click', addLogsHelp);
                })


            }

            function addLogsViewGraphic(e) {
                event.stopPropagation();
                var action = "";
                var objectName = "";
                var objectType = "";
                var objectDescription = "";
                switch(this.id) {
                    case "submissions":
                        action = "viewed";
                        objectName = "submissions";
                        objectType = "graphic";
                        objectDescription = "Graph showing the work submited by the students";
                        break;
                    case "accessContent":
                        action = "viewed";
                        objectName = "accessContent";
                        objectType = "graphic";
                        objectDescription = "Graph showing the course content accessed by the students";
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
                        objectDescription = "Help section that provides information about the invested time graph";
                        break;
                    case "helpAccessContent":
                        action = "viewed";
                        objectType = "help";
                        objectName = "accessed_content";
                        objectDescription = "Help section that provides information about the sessions per hour graph";
                        break;
                    default:
                        action = "viewed";
                        objectType = "help";
                        objectName = "";
                        objectDescription = "Help section of a graph";
                        break;
                }
                addLogsIntoDB(action, objectName, objectType, objectDescription);
            }

            /**
            function setFiltersContentAccess() {
                let filterAccessContent = document.getElementsByClassName('highcharts-legend-item highcharts-bar-series highcharts-color-0 highcharts-series-0');
                filterAccessContent[0].addEventListener('click', function() {
                    addLogsIntoDB("filtered", "accessed_content", "graphic", "Filter that allows to see only certain information of the graph access content");
                });

                let filterAccessContentBis = document.getElementsByClassName('highcharts-legend-item highcharts-bar-series highcharts-color-1 highcharts-series-1');
                filterAccessContentBis[0].addEventListener('click', function() {
                    addLogsIntoDB("filtered", "accessed_content", "graphic", "Filter that allows to see only certain information of the graph access content");
                })
            }**/

            function addLogsDownload(e) {
                this.removeEventListener('click', addLogsDownload);
                var action = "";
                var objectName = "";
                var objectType = "";
                var objectDescription = "";
                switch(this.id) {
                    case "submissions":
                        action = "downloaded";
                        objectName = "submissions";
                        objectType = "graphic";
                        objectDescription = "Bar graph that shows submissed works by students";
                        break;
                    case "accessContent":
                        action = "downloaded";
                        objectName = "accessed_content";
                        objectType = "graphic";
                        objectDescription = "Graph showing the content wich have been accessed by students";
                        break;
                    default:
                        action = "downloaded";
                        objectName = "";
                        objectType = "graphic";
                        objectDescription = "Downloaded a graph";
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