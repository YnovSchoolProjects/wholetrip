import Service from "../../helpers/services";
const NAMESPACE = "profiles";
let service = new Service(NAMESPACE);

export default {
  namespaced: true,

  actions: {
    async createProfile(_, data) {
      try {
        const response = await service.post("/", undefined, data);
        return response;
      } catch (e) {
        console.log(e);
        return null;
      }
    },
    async deleteProfile(_, data) {
      try {
        const response = await service.delete("/", data, undefined);
        return response;
      } catch (e) {
        console.log(e);
        return null;
      }
    },
  },
};
