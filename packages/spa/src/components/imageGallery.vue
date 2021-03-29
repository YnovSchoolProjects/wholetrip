<template>
  <v-row>
    <v-col
      v-for="(image, key) in images"
      :key="key"
      class="d-flex child-flex"
      cols="4"
    >
        <v-img
        :src="image"
        :lazy-src="image"
        aspect-ratio="1"
        class="grey lighten-2"
        @click='getZoom(image)'
        >

        </v-img>
    </v-col>
      <template>
        <v-row justify="center">
        <v-dialog
            v-model="dialog"
            max-width="1000"
        >
      <v-card>
          <v-img
            :src='currentSrc'
            :lazy-src="`https://picsum.photos/10/6?image=${1 * 5 + 10}`"
            class="grey lighten-2"
          >

        </v-img>
      </v-card>
    </v-dialog>
    </v-row>
      </template>
    </v-row>
</template>




<script>
    export default {
        name: "ImageGallery",
        data () {
        return {
            dialog: false,
            currentSrc:null,
            images:
            [
                "https://i.pinimg.com/originals/08/2f/67/082f678d7336fd479c3cc70f2d88dab9.jpg",
                "https://i.pinimg.com/736x/57/49/86/574986d423b07a7d77f253af0d68a3c2.jpg",
                "https://aws-cf.imdoc.fr/prod/photos/2/4/3/8595243/20418617/img-20418617cf0.jpg?v=11",
                "https://images.salaun-holidays.com/(Image)-image-Italie-Venise-Grand-Ganal-63-it_75725429-09032017.jpg",
                "https://paysages.photos/wp-content/uploads/2017/07/photo-paysage-venise-6-1024x657.jpg",
                "https://ae01.alicdn.com/kf/HTB1OweMaTlYBeNjSszcq6zwhFXah/Pont-du-rialto-venise-italie-grand-canal-belle-paysage-urbain-salon-accueil-art-d-cor-bois.jpg",
                "https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSfvZ8st9kk0CP9rQhZktoLG0kjypBAL2hz5g&usqp=CAU",
                "https://paysages.photos/wp-content/uploads/2017/07/paysage-venise-3-2.jpg",
                "http://www.10wallpaper.com/wallpaper/2560x1600/1210/venice_at_night-City_landscape_wallpaper_2560x1600.jpg",
                "https://ae01.alicdn.com/kf/HTB1Mqn4PXXXXXc4XpXXq6xXFXXXk.jpg",
                "https://image.freepik.com/photos-gratuite/paysage-mer-bateau-architecture-ile-murano-venise-tourisme-dans-iles-venise_245974-2188.jpg",
                "https://thumbs.dreamstime.com/b/paysage-urbain-de-murano-avec-le-canal-d-anges-venise-italie-82842049.jpg",
                "https://photo.comptoir.fr/photos/voyage/564/italie/verone/festival-des-arenes-de-verone-region-de-la-venetie-italie-534140-1280x640.jpg",
                "https://cdn2.civitatis.com/italia/venecia/guia/verona.jpg",
                "https://www.okvoyage.com/wp-content/uploads/2015/08/verone-italie-810x607.jpg",
                "https://lepetitjournal.com/sites/default/files/styles/main_article/public/2018-04/800px-Verona_-_piazza_Erbe_from_Lamberti_tower.jpg?itok=XIzL0ett",
                "https://dynamic-media-cdn.tripadvisor.com/media/photo-o/15/33/f8/08/verona.jpg?w=1100&h=600&s=1",
                "https://milesandlove.com/system/attachments/2256/xxlarge/arena-de-verone.jpg?1509450868",
                "http://www.italia.it/uploads/RTEmagicC_Verona_panoramica_03.jpg.jpg",
                "https://media.boalingua.ch/images/_italien_verona_header_1.jpg"
            ]
        }
    },
    methods:{
        getZoom(src)
        {
            this.dialog=true;
            this.currentSrc=src;
        }
    }

    }
</script>
