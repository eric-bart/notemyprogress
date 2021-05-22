define([],
    function (){
        const modulesform = {
        template:`
                <v-main mt-10>
                    <v-row>
                        <v-dialog
                            v-model="dialog"
                            max-width="700px"
                            @click:outside="closeDialog()"
                            @keydown.esc="closeDialog()"
                        >    
                            <v-card>
                                <v-card-title v-text="strings.title"></v-card-title>
                                <v-card-text v-for="section in sections" :key="section.id">
                                    <h5 v-text="section.name"></h5>
                                    <div v-for="module in section.modules" :key="module.id">
                                        <v-row>
                                            <v-col cols="6">
                                                <img :src="get_module_icon(module.modname)" width="25" height="25">
                                                <a :href="get_module_url(module)" target="_blank">
                                                    <span v-text="module.name"></span>
                                                </a>
    
                                                <span v-text="get_interactions_number(module.interactions)"></span>
                                            </v-col>
                                            <v-col cols="6" class="text-right">
                                                <v-chip v-if="!module.viewed" color="#EF476F" text-color="white">
                                                    <v-avatar left>
                                                        <v-icon v-text="'mdi-eye-off'" small></v-icon>
                                                    </v-avatar>
                                                    <span class="d-flex justify-space-between caption"
                                                        v-text="strings.modules_no_viewed">
                                                    </span>
                                                </v-chip>
    
                                                <v-chip v-if="module.viewed" color="#FFD166" text-color="white">
                                                    <v-avatar left>
                                                        <v-icon v-text="'mdi-eye'" small></v-icon>
                                                    </v-avatar>
                                                    <span class="d-flex justify-space-between caption"
                                                        v-text="strings.modules_viewed">
                                                    </span>
                                                </v-chip>
    
                                                <v-chip v-if="module.complete" color="#06D6A0" text-color="white">
                                                    <v-avatar left>
                                                        <v-icon v-text="'mdi-checkbox-marked-circle-outline'" small>
                                                        </v-icon>
                                                    </v-avatar>
                                                    <span class="d-flex justify-space-between caption"
                                                        v-text="strings.modules_complete">
                                                    </span>
                                                </v-chip>
                                            </v-col>
                                        </v-row>
                                    </div>
                                </v-card-text>
    
                                <v-card-actions>
                                    <v-btn color="primary darken-1" 
                                        text 
                                        @click="closeDialog"
                                        v-text="strings.close_button">
                                    </v-btn>
                                </v-card-actions>
                            </v-card>
                        </v-dialog>
                    </v-row>
               </v-main>
                `,
        props:['dialog', 'sections', 'strings'],
        methods : {
            closeDialog() {
                this.$emit('update_dialog', false);
            },

            get_module_icon(modname){
                return `${M.cfg.wwwroot}/theme/image.php/boost/${modname}/1/icon`;
            },

            get_module_url(module){
                return `${M.cfg.wwwroot}/mod/${module.modname}/view.php?id=${module.id}`;
            },

            get_interactions_number(interactions){
                let interactions_text = (interactions == 1) ? this.strings.modules_interaction : this.strings.modules_interactions;
                return `(${interactions} ${interactions_text})`;
            },
        },
    }
    return modulesform;
})