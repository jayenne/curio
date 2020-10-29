<template>
    <ais-instant-search
    :search-client="searchClient"
    index-name="users_index"
    >

        <ais-configure
            :hitsPerPage="5"
            :restrictSearchableAttributes="['username']"
        />
        
        <ais-search-box placeholder="Get more curious..."></ais-search-box>
            	        	        
        <ais-state-results>
            <template slot-scope="{ query }">
                <ais-hits v-if="query.length > 0">
                    <template
                        slot="item"
                        slot-scope="{ item }"
                    >
          
                        <span v-if="item.avatar">
                            <img :src="item.avatar" :alt="item.username" />
                        </span>
                        <span v-else>
                            <img src="/img/svg/user-circle.svg" :alt="item.username" />
                        </span>
                        
                        <span v-if="item.username" >
                            <ais-highlight
                                :hit="item"
                                attribute="username"
                            />
                        </span>
                        <span v-else>
                            <ais-highlight
                                :hit="item"
                                attribute="first_name"
                            />
                        </span>
                    </template>
                </ais-hits>
                <div v-else></div>
            </template>
        </ais-state-results>
    

   
    </ais-instant-search>
  
</template>

<script>
import algoliasearch from 'algoliasearch/lite';

export default {
  data() {
    return {
      searchClient: algoliasearch(
        process.env.MIX_ALGOLIA_APP_ID,
        process.env.MIX_ALGOLIA_SEARCH,
        
      ),
    };
  },
};
</script>
