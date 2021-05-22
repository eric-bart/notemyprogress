define(["local_fliplearning/vue",
        "local_fliplearning/vuetify",
        "local_fliplearning/axios",
        "local_fliplearning/moment",
        "local_fliplearning/pagination",
        "local_fliplearning/pageheader",
        "local_fliplearning/helpdialog",
    ],
    function(Vue, Vuetify, Axios, Moment, Pagination, Pageheader, HelpDialog) {
        "use strict";

        function init(content) {
            const timeout = 60 * 120 * 1000
            Axios.defaults.timeout = timeout
            console.log(content);
            Vue.use(Vuetify);
            Vue.component('pagination', Pagination);
            Vue.component('pageheader', Pageheader);
            Vue.component('helpdialog', HelpDialog);
            let vue = new Vue({
                delimiters: ["[[", "]]"],
                el: "#logs",
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
                        help_dialog: false,
                        help_contents: [],
                        dateRules: [
                            v => !!v || this.strings.logs_invalid_date
                        ]

                    }
                },
                beforeMount() {
                    document.querySelector("#downloadButtonMoodle").style.display = "none";
                    document.querySelector("#downloadButtonNMP").style.display = "none";
                },
                mounted(){
                    document.querySelector(".v-application--wrap").style.minHeight = "60vh";
                    document.querySelector("#sessions-loader").style.display = "none";
                    document.querySelector("#logs").style.display = "block";
                    document.querySelector("#helpMoodle").style.display = "block";
                    document.querySelector("#helpNMP").style.display = "block";
                    document.querySelector("#downloadButtonMoodle").style.display = "block";
                    document.querySelector("#downloadButtonNMP").style.display = "block";
                    document.querySelector("#logsSetpointMoodle").style.display = "block";
                    document.querySelector("#logsSetpointNMP").style.display = "block";
                },
                methods : {
                    get_Moodlefile() {
                        let lastDate = document.querySelector("#lastDateMoodle");
                        let beginDate = document.querySelector("#beginDateMoodle");
                        this.url = false;
                        this.loading = true;
                        var data = {
                            action : "downloadMOODLElogs",
                            courseid : this.courseid,
                            userid : this.userid,
                            beginDate : beginDate.value,
                            lastDate : lastDate.value,
                            currentUrl : window.location.href,
                        }
                        if(beginDate.value!="" && lastDate.value!="") {
                            document.querySelector('#downloadButtonMoodle').innerHTML = this.strings.logs_download_btn;
                            document.getElementById('downloadButtonMoodle').disabled = true;
                            Axios({
                                method: 'get',
                                url: M.cfg.wwwroot + "/local/fliplearning/ajax.php",
                                timeout: timeout,
                                params: data,
                            }).then((response) => {
                                this.loading = false
                                console.log("ATTENTION...");
                                console.log(response);
                                if (response.status == 200 && response.data.ok) {
                                    if (beginDate.value != "" || lastDate.value != "") {
                                        console.log("good");
                                        let path = M.cfg.wwwroot + "/local/fliplearning/downloads/"
                                        let url = path + response.data.data.filename;
                                        console.log(response.data.data.filename);
                                        this.url = url
                                        var link = document.createElement('a');
                                        link.href = this.url;
                                        link.download = "MoodleLogs_" + beginDate.value + "_" + lastDate.value + ".csv";
                                        link.click();
                                        document.querySelector('#downloadButtonMoodle').innerHTML = this.strings.logs_valid_Moodlebtn;
                                        document.getElementById('downloadButtonMoodle').disabled = false;
                                    } else {
                                        console.log("Problème données");
                                        document.querySelector('#downloadButtonMoodle').innerHTML = this.strings.logs_valid_Moodlebtn;
                                        document.getElementById('downloadButtonMoodle').disabled = false;
                                    }
                                }
                            }).catch((e) => {
                                this.loading = false
                            });
                        }
                        /**
                            if(lastDate.value!='' && beginDate!='') {
                                var xhr = new getXhr();
                                xhr.onreadystatechange= function() {
                                    if(xhr.readyState===4) {
                                        var blob=new Blob([xhr.responseText]);
                                        var link=document.createElement('a');
                                        link.href=window.URL.createObjectURL(blob);
                                        link.download="Logs_"+beginDate.value+"_to_"+lastDate.value+".csv";
                                        link.click();
                                    }
                                }
                                xhr.open('GET', M.cfg.wwwroot + "/local/fliplearning/ajax.php?action=downloadlogs&beginDate="+beginDate.value+"&lastDate="+lastDate.value+"&courseid=3&userid=2", true);
                                xhr.send();
                            }**/
                    },

                    get_NMPfile() {
                        let lastDate = document.querySelector("#lastDateNMP");
                        let beginDate = document.querySelector("#beginDateNMP");
                        this.url = false;
                        this.loading = true;
                        var data = {
                            action : "downloadNMPlogs",
                            courseid : this.courseid,
                            userid : this.userid,
                            beginDate : beginDate.value,
                            lastDate : lastDate.value,
                            currentUrl : window.location.href,
                        }
                        if(beginDate.value!="" && lastDate.value!="") {
                            document.querySelector('#downloadButtonNMP').innerHTML = this.strings.logs_download_btn;
                            document.getElementById('downloadButtonNMP').disabled = true;
                            Axios({
                                method: 'get',
                                url: M.cfg.wwwroot + "/local/fliplearning/ajax.php",
                                timeout: timeout,
                                params: data,
                            }).then((response) => {
                                this.loading = false
                                console.log("ATTENTION...");
                                console.log(response);
                                if (response.status == 200 && response.data.ok) {
                                    if (beginDate.value != "" || lastDate.value != "") {
                                        console.log("good");
                                        let path = M.cfg.wwwroot + "/local/fliplearning/downloads/"
                                        let url = path + response.data.data.filename;
                                        console.log(response.data.data.filename);
                                        this.url = url
                                        var link = document.createElement('a');
                                        link.href = this.url;
                                        link.download = "NMPLogs_" + beginDate.value + "_" + lastDate.value + ".csv";
                                        link.click();
                                        document.querySelector('#downloadButtonNMP').innerHTML = this.strings.logs_valid_NMPbtn;
                                        document.getElementById('downloadButtonNMP').disabled = false;
                                    } else {
                                        console.log("Problème données");
                                        document.querySelector('#downloadButtonNMP').innerHTML = this.strings.logs_valid_NMPbtn;
                                        document.getElementById('downloadButtonNMP').disabled = false;
                                    }
                                }
                            }).catch((e) => {
                                this.loading = false
                            });
                        }
                        /**
                         if(lastDate.value!='' && beginDate!='') {
                                var xhr = new getXhr();
                                xhr.onreadystatechange= function() {
                                    if(xhr.readyState===4) {
                                        var blob=new Blob([xhr.responseText]);
                                        var link=document.createElement('a');
                                        link.href=window.URL.createObjectURL(blob);
                                        link.download="Logs_"+beginDate.value+"_to_"+lastDate.value+".csv";
                                        link.click();
                                    }
                                }
                                xhr.open('GET', M.cfg.wwwroot + "/local/fliplearning/ajax.php?action=downloadlogs&beginDate="+beginDate.value+"&lastDate="+lastDate.value+"&courseid=3&userid=2", true);
                                xhr.send();
                            }**/
                    },

                    is_today(date) {
                      var today = new Date();
                      var dd= String(today.getDate()).padStart(2,'0');
                      var mm= String(today.getMonth() + 1).padStart(2,'0');
                      var yyyy = today.getFullYear();
                      today = yyyy+"-"+mm+"-"+dd;
                      var date = new Date(date);
                      if(date>=today) {
                          return true;
                      }
                      return false;
                    },

                    get_help_content() {
                        var help_contents = [];
                        var help = new Object();
                        help.title = this.strings.title;
                        help.description = this.strings.description;
                        help_contents.push(help);
                        return help_contents;
                    },

                    open_chart_help(chart) {
                        let contents = [];
                        if (chart == 'download_moodle') {
                            contents.push({
                                title: this.strings.logs_download_moodle_help_title,
                                description: this.strings.logs_download_moodle_help_description,
                            });
                        } else if (chart == "download_nmp") {
                            contents.push({
                                title: this.strings.logs_download_nmp_help_title,
                                description: this.strings.logs_download_nmp_help_description,
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
            /* Listeners */
            document.querySelector('#downloadButtonMoodle').addEventListener('click', function() {
                console.log('click');
            })
        }
/**
        function getXhr() {
            var xhr = null;
            if(window.XMLHttpRequest) {
                xhr = new XMLHttpRequest();
            } else if(window.ActiveXObject) {
                try {
                    xhr = new ActiveXObject("Msxml2.XMLHTTP");
                } catch(e) {
                    xhr = new ActiveXObject("Microsoft.XMLHTTP");
                }
            } else {
                alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest");
                xhr = false;
            }
            return xhr;
        }**/

        return {
            init : init
        };
    });