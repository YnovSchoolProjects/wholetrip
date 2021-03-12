import Service from "../../helpers/services";
const NAMESPACE = "auth";
let service = new Service(NAMESPACE);

export default {
  namespaced: true,

  state: {
    family: null,
    profil: null,
    isAuthenticated: false,
    createFamily: false,
  },
  getters: {
    getFamily(state) {
      return state.family;
    },
    getProfile(state) {
      return state.profil;
    },
    getAuthenticated(state) {
      return state.isAuthenticated;
    },
  },
  mutations: {
    SET_AUTHENTICATED(state, payload) {
      state.isAuthenticated = payload;
    },
    SET_FAMILY(state, payload) {
      state.family = payload.family;
    },
    SET_PROFIL(state, payload) {
      state.profil = payload;
    },
    LOGIN(state, payload) {
      localStorage.setItem("jwt", payload);
      if (state.profil !== null) state.isAuthenticated = true;
    },
    DISCONNECT(state) {
      localStorage.removeItem("jwt");
      state.isAuthenticated = false;
    },
  },

  actions: {
    async getAccountInfo({ commit }) {
      try {
        const response = await service.get("/accountInfo");
        if (response.status === 200) {
          commit("SET_FAMILY", response.data);
          commit("SET_PROFIL", response.data.profile);
          commit("SET_AUTHENTICATED", true);
        } else {
          commit("SET_AUTHENTICATED", false);
        }
      } catch (e) {
        console.log(e);
        commit("DISCONNECT");
      }
    },
    async login({ commit }, data) {
      const response = await service.post("/login", "", data);
      if (response.status === 200) commit("LOGIN", response.data.token);
      if (response.status === 200) commit("SET_PROFIL", response.data);
      return response;
    },
    async register({ commit }, data) {
      const response = await service.post("/register", "", data);
      if (response.status === 201) commit("ABLE_CREATE_FAMILY");
      return response;
    },
    disconnect({ commit }) {
      commit("DISCONNECT");
    }
  },
};
