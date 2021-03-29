<template>
    <v-container class="center-menu">
      <v-row>
        <v-col>
          <v-data-table
            :headers="headers"
            :items="projets"
            sort-by="calories"
            class="elevation-1"
          >
            <template v-slot:top>
              <v-toolbar flat>
                <v-toolbar-title>Mes projets de voyage</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
                <v-dialog v-model="dialog" max-width="500px">
                  <template v-slot:activator="{ on, attrs }">
                    <v-btn
                      color="primary"
                      dark
                      class="mb-2"
                      v-bind="attrs"
                      v-on="on"
                    >
                      Nouveau projet
                    </v-btn>
                  </template>
                  <projet-form
                    @save="save"
                    @close="close"
                    :projet="editedItem"
                    :edit="editForm"
                  />
                </v-dialog>
                <v-dialog v-model="dialogDelete" max-width="500px">
                  <v-card>
                    <v-card-title class="headline"
                      >Etes vous sûr de vouloir supprimer ce projet
                      ?</v-card-title
                    >
                    <v-card-actions>
                      <v-spacer></v-spacer>
                      <v-btn color="blue darken-1" text @click="closeDelete"
                        >Annuler</v-btn
                      >
                      <v-btn
                        color="blue darken-1"
                        text
                        @click="deleteItemConfirm"
                        >Valider</v-btn
                      >
                      <v-spacer></v-spacer>
                    </v-card-actions>
                  </v-card>
                </v-dialog>
              </v-toolbar>
            </template>
            <template v-slot:item.actions="{ item }">
              <v-icon small class="mr-2" @click="editItem(item)">
                mdi-pencil
              </v-icon>
              <v-icon small class="mr-2" @click="deleteItem(item)">
                mdi-delete
              </v-icon>
              <v-icon small :to="{ name: 'Gallery', params: { id: item.id } }">
                mdi-arrow-right-bold-circle
              </v-icon>
            </template>
            <template v-slot:no-data>
              Aucune donnée
            </template>
          </v-data-table>
        </v-col>
      </v-row>
      <v-row>
        <v-col>
          <v-data-table
            :headers="headers"
            :items="sharedProjets"
            sort-by="calories"
            class="elevation-1"
          >
            <template v-slot:top>
              <v-toolbar flat>
                <v-toolbar-title>Mes voyages partagé</v-toolbar-title>
                <v-divider class="mx-4" inset vertical></v-divider>
                <v-spacer></v-spacer>
              </v-toolbar>
            </template>
            <template v-slot:item.actions="{ item }">
              <v-icon small :to="{ name: 'Gallery', params: { id: item.id } }">
                mdi-arrow-right-bold-circle
              </v-icon>
            </template>
            <template v-slot:no-data>
              Aucune donnée
            </template>
          </v-data-table>
        </v-col>
      </v-row>
    </v-container>
</template>

<script>
import ProjetForm from "../components/projetForm.vue";

export default {
  name: "Dashboard",
  components: { ProjetForm },
  data: () => {
    return {
      dialog: false,
      dialogDelete: false,
      headers: [
        { text: "Numéro", value: "id" },
        { text: "Nom", value: "name" },
        { text: "Date début", value: "dateDebut" },
        { text: "Date fin", value: "dateFin" },
        { text: "Etat", value: "etat" },
        { text: "Token", value: "token" },
        { text: "Actions", value: "actions", sortable: false },
      ],
      projets: [],
      sharedProjets: [],
      editedIndex: -1,
      editedItem: {
        name: "",
        dateDebut: "",
        dateFin: "",
        etat: "",
        token: "",
      },
      editForm: false,
      defaultItem: {
        name: "",
        dateDebut: "",
        dateFin: "",
        etat: "",
        token: "",
      },
    };
  },

  computed: {
    formTitle() {
      return this.editedIndex === -1 ? "Nouveau projet" : "Modifier un projet";
    },
  },

  watch: {
    dialog(val) {
      val || this.close();
    },
    dialogDelete(val) {
      val || this.closeDelete();
    },
  },

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      this.projets = [
        {
          name: "Voyage en italie",
          dateDebut: "29/10/2020",
          dateFin: "29/11/2020",
          etat: "PROTEGE",
          token: "sfkjklf34sdqo23",
        },
      ];
    },

    save(projet) {
      if (this.editForm) {
        Object.assign(this.projets[this.editedIndex], projet);
        this.editForm = false;
      } else {
        this.projets.push(projet);
      }
      this.close();
    },

    editItem(item) {
      this.editedIndex = this.projets.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialog = true;
      this.editForm = true;
    },

    deleteItem(item) {
      this.editedIndex = this.projets.indexOf(item);
      this.editedItem = Object.assign({}, item);
      this.dialogDelete = true;
    },

    deleteItemConfirm() {
      this.projets.splice(this.editedIndex, 1);
      this.closeDelete();
    },

    close() {
      this.dialog = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },

    closeDelete() {
      this.dialogDelete = false;
      this.$nextTick(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      });
    },
  },
};
</script>

<style scoped>
.center-menu .row .col {
  margin: 0 auto;
}

.card {
  justify-content: center;
  color: white;
  border-radius: 20px !important;
}

.card-family {
  height: 35vh;
}

.card-family div {
  justify-content: center;
  align-items: center;
  height: 100%;
}

.card-calendar {
  height: 35vh;
  width: 40vw;
  display: flex !important;
}

.card-list {
  height: 35vh;
  width: 40vw;
  display: flex !important;
}

.dash-card-title {
  font-size: 1.4rem !important;
  font-weight: 800 !important;
}
</style>
