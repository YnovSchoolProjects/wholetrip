export default {
  namespaced: true,

  state: {
      actionAdd: null,
      excludedActionRoute: ['Dashboard', 'List', 'AddList', 'AddEvent', 'Family'],
      prevRoute: null,
      showPopup: false,
      popup: {text: '', color: 'primary'}
  },

  getters: {
    getActionAdd(state) {
      return state.actionAdd;
    },
    getExcludedActionRoute(state) {
      return state.excludedActionRoute;
    },
    getPrevRoute(state) {
      return state.prevRoute;
    },
    getShowPopup(state) {
      return state.showPopup;
    },
    getPopup(state) {
      return state.popup;
    }
  },

  mutations: {
    SET_ACTION_ADD (state, payload) {
      state.actionAdd = payload;
    },
    SET_PREV_ROUTE (state, payload) {
      state.prevRoute = payload;
    },
    SET_SHOW_POPUP (state, payload) {
      state.showPopup = payload
    },
    SET_POPUP (state, payload) {
      if (payload.color) {
        state.popup = payload
      } else {
        state.popup = {text: payload.text, color: 'primary'}
      }
    }
  },

  actions: {
    async setPreviousRoute({ commit }, route) {
      try {
        commit('SET_PREV_ROUTE', route)
      }catch (e) {
        console.log(e)
      }
    },
    showPopup({ commit }, {color, text}) {
      commit('SET_SHOW_POPUP', true)
      commit('SET_POPUP', {color, text})
    }
  }
};