import { createStore } from "vuex";

const storedTheme = localStorage.getItem('theme') || 'dark';

export default createStore({
    state() {
        return{
            theme: storedTheme,
            user: false,
            popMoadal: false,
            client: false,
            hotel_id: '',
            searchedData: [],
            property:''
        }
    },

    getters: {
       
    },

    mutations: {
        setUpdateUser(state, data) {
            state.user = data;
        },

        setHotelId(state, data) {
            state.hotel_id = data;
        },

        setUpdateClient(state, data) {
            state.client = data;
        },

        searchData(state, data) {
            state.searchedData = data;
        },

        propertyData(state, data) {
            state.property = data;
        },

        SET_THEME(state, theme) {
            state.theme = theme;
            localStorage.setItem('theme', theme);
        },
    },

    actions:{
        toggleTheme({ commit, state }) {
            const newTheme = state.theme === 'light' ? 'dark' : 'light';
            commit('SET_THEME', newTheme);
        },  

        setTheme({ commit }, theme) {
            commit('SET_THEME', theme);
        },
    },

    getters: {
        currentTheme: state => state.theme,
    }
    
});
