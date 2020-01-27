import 'material-design-icons-iconfont/dist/material-design-icons.css'
import Vuetify from 'vuetify/lib'


const opts = {
        theme: {
            light: true,
            themes: {
                light: {
                    primary: '#2f2248',
                    secondary: '#e2cde1',
                    accent: '#8c9eff',
                    error: '#b71c1c',
                },
            },
        },
        icons: {
            iconfont: 'mdiSvg'
        }
    };

export default new Vuetify(opts)