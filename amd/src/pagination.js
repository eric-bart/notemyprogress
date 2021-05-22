define([], function (){
    const pagination = {
        template:`
                <v-main mt-10>
                    <v-layout class="mb-2" justify-center>
                        <span v-text="title" class="fliplearning-sub-title"></span>
                    </v-layout>
                    <v-layout justify-center>
                        <v-flex d-flex justify-end align-center no-wrap id="fliplearning-display-weeks" class="flex-grow-0 pl-4">
                            <span class="subtitle-1 pr-3" v-text="name"></span>
                            <v-layout v-for="(page, index, key) in pages" :key="key" class="flex-grow-0">
                                <v-tooltip top attach>
                                    <template v-slot:activator="{ on }">
                                        <span 
                                                v-on="on" 
                                                v-text="page.number" 
                                                :class="['pa-1 pr-4 pl-4 page', {'selected-page' : page.selected}]" 
                                                @click="update_selected_week(index)"></span>
                                    </template>
                                    <span v-text="get_week_dates(page)"></span>
                                </v-tooltip>
                            </v-layout>
                        </v-flex>
                    </v-layout>
                    <v-divider></v-divider>
               </v-main>
                `,
        props:['pages','name','nameseparator','title'],
        data(){
            return{
            }
        },
        methods : {
            get_week_dates(week){
                return `${week.weekstart} ${this.nameseparator} ${week.weekend}`;
            },
            update_selected_week(index_page){
                this.loading = true
                let page = this.change_selected_week(index_page);
                this.$emit('changepage',this.get_selected_week());
            },
            change_selected_week(selected_page){
                let current_selection = this.get_selected_week();
                current_selection = this.pages.indexOf(current_selection);
                this.pages[current_selection].selected = false;
                this.pages[selected_page].selected = true;
                return this.pages[selected_page];
            },
            get_selected_week(){
                let selected = null
                this.pages.forEach((page) => {
                    if(page.selected){
                        selected = page;
                    }
                })
                return selected;
            },
        },
    }
    return pagination;
})