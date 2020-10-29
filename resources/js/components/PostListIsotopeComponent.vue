<template>

    <div id="root_layout">
        <b-container fluid>

            <h2>Filter</h2>
              <div class="button-group">
                <button v-for="(val, key) in option.getFilterData" class="btn btn-link" :class="[key===filterOption? 'is-checked' : '']" @click="filter(key)">{{key}}
                </button>
              </div>

              <h2>Sort</h2>
              <div class="button-group">
                <button class="button" :class="[sortOption==='original-order'? 'is-checked' : '']" @click="sort('original-order')">original order</button>
                <button v-for="(val, key) in option.getSortData" class="btn btn-link" :class="[key===sortOption? 'is-checked' : '']" @click="sort(key)">{{key}}</button>
              </div>

              <h2>Layout</h2>
              <div>
                <button v-for="layout in option.layouts" :class="[layout===currentLayout? 'is-checked' : '']" class="button" @click="changeLayout(layout)">
                  {{layout}}
                </button>
              </div>
        </b-container>

        <b-container fluid>
            <isotope
                id="root_isotope"
                class="masonry"
                ref="cpt"
                :options="option"
                :list="list"
                @filter="filterOption=arguments[0]"
                @sort="sortOption=arguments[0]"
                v-images-loaded:on.progress="layout"
            >
            <div v-for="item in list" :key="item.id" :class='[item.language]'>
                <b-card 
                    no-body
                    img-top
                    tag="article"
                    sm="6" md="4" lg="3"
                    class="mb-2"
                >   
                    <div v-if="item.media" v-for="medium in item.media" :key="medium.id"> 
                        <video v-if="medium.type === 'video'" :src="medium.url" :class="medium.type" controls muted :alt="item.title" top/>
                        <video v-else-if="medium.type === 'animated_gif'" :src="medium.url" :class="medium.type" autoplay loop muted :alt="item.title" top />
                        <b-card-img v-else-if="medium.type === 'photo'" :src="urls.url" :class="medium.type" :alt="item.title" top></b-card-img>
                        <b-card-img v-else :src="medium.url" :class="medium.type" :alt="item.title" top></b-card-img>
                    </div>
                    
                    <b-card-title v-if="item.title" class="title">{{item.title}}</b-card-title>
                    <b-card-body v-if="item.body" class="body">{{item.body}}</b-card-body>
                    <b-card-body v-if="item.text" class="text">{{item.text}}</b-card-body>

                    <b-link v-for="link in item.urls" :key="link.id" :class="link">
                        <img v-if="link.image" :src="link.image" :alt="link.alt"/>
                        <p v-if="link.title">{{link.title}}</p>
                        <p v-if="link.body">{{link.body}}</p>
                        <a v-if="link.url" class="link" :href="link.url" target="_blank"><i class="fa fa-link"></i><span v-if="link.site">{{link.site}}</span><span v-else=>{{ __('source')}}</span></span></a>
                    </b-link>
                </b-card>
            </div>
                <!--postReaction :key="index"></postReaction-->
            </isotope>
        </b-container>

        <infinite-loading @infinite="infiniteHandler" spinner="spiral">
            <span slot="no-more">
                No more posts
            </span>
        </infinite-loading>

    </div>

</template>

<script>
import isotope from 'vueisotope'
import VuePackeryPlugin from 'vue-packery-plugin'
import VueDraggabillyPlugin from 'vue-packery-draggabilly-plugin'
import imagesLoaded from 'vue-images-loaded'
import InfiniteLoading from 'vue-infinite-loading'
import axios from 'axios'
//import PostReactions from './PostReactions'
//Vue.use(VuePackeryPlugin);
//Vue.use(VueDraggabillyPlugin);

export default {

    data() {
        
        return {
            list: [],
            url: '/api/posts?page=1',
            num_items: process.env.MIX_PAGINATION_POSTS,
            currentLayout: 'masonry',
            selected: null,
            sortOption: "original-order",
            filterOption: "show all",
            option: {
                masonry: {
                    itemSelector: '.item',
                    columnWidth: 320,
                    isFitWidth: true,
                },
                layouts: [
                    "masonry",
                    "vertical",
                    "packery",
                    "cellsByColumn",
                ],
                getFilterData: {
                    "show all": function() {
                      return true;
                    },
                    "index < 10": function(el) {
                      return el.index < 10;
                    },
                    "public": function(el) {
                      return el.access == 0;
                    },
                    "owner": function(el) {
                      return el.access == 1;
                    },
                    "subscriber": function(el) {
                      return el.access == 2;
                    },
                    "follower": function(el) {
                      return el.access == 3;
                    },
                    "by_invite": function(el) {
                      return el.access == 4;
                    },

                },
                getSortData: {
                    id: "id",
                    title: "title",
                    lang: "lang",
                    body: "body",
                  }
            },

        }

    },

    computed: {

    },

    components: {
        isotope: isotope,
        infiniteLoading: InfiniteLoading,
        //PostReactions: PostReactions,
    },

    directives: {
        imagesLoaded
    },

    methods: {
        sort: function(key) {
          this.$refs.cpt.sort(key);
        },
        filter: function(key) {
            this.$refs.cpt.filter(key);
        },
        changeLayout: function(key) {
          this.$refs.cpt.layout(key);
        },
        layout() {
            this.$refs.cpt.layout('masonry');
            console.log('layout');
        },
        
        infiniteHandler($state) {

            let api = this.url;

            axios.get(api).then(({
                data
            }) => {

                let rdata = data.data;

                if (rdata.length) {

                    this.list = this.list.concat(rdata);
                    $state.loaded()
                    if (rdata.length < this.num_items) {

                        $state.complete()
                    }
                } else {

                    $state.complete();

                }
                // if data.links.next does't exist the notify 'no more posts'
                console.log(data);
                console.log(data.meta.pagination.links.next);

                this.url = data.meta.pagination.links.next;
                //this.url = data.next_page_url;

            })
        }
    }
}
</script>

<style lang="scss" scoped>
#root_layout {
    width: 100%;
    margin: 0 auto 2rem;
    background-color: #fff;
}

#root_isotope {
    width: 100%;
    display: block;
    margin: 2rem auto 0rem;
}

/* clear fix */
#root_isotope:after {
    content: '';
    display: block;
    clear: both;
}

.item {
    float: left;
    padding: 0;
    height: auto;
    box-sizing: border-box;
    cursor: pointer;
    border:1px dashed #00f;

    -webkit-box-shadow: 0px 17px 53px -9px rgba(252,252,253,1);
    -moz-box-shadow: 0px 17px 53px -9px rgba(252,252,253,1);
    box-shadow: 0px 17px 53px -9px rgba(252,252,253,1);
}

.item img, .item video {
    width: 100%;
}
</style>