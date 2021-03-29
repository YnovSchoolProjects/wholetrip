import Vue from 'vue';
import Vuetify from 'vuetify/lib';

Vue.use(Vuetify);

export default new Vuetify({
    theme: {
        light: true,
        options: {
            customProperties: true
        },
        themes: {
            light: {
                primary: "#fbb03b",
            },
        }
    },
});
