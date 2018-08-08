<template>
    <div class="md-layout md-alignment-center">
        <div class="md-layout-item md-size-60">
          <h2>Search Tool </h2>

          <!-- Search Box -->
            <md-field>
              <label>Search Business</label>
              <md-input
                v-model="state.businessTitle"
                v-on:input="fetchBusiness()"></md-input>
            </md-field>

            <!-- categories -->
            <div class="autocomplete">
          <!-- Autocomplete search -->
            <md-autocomplete
              @md-changed="getCategories"
              @md-opened="getCategories"
              v-model="state.categoriesValue"
              :md-options="state.categories"
              md-layout="box"
              md-dense
              md-term
              :md-open-on-focus="false">
              <template slot="md-autocomplete-empty" slot-scope="{ term }">
                No Business matching "{{ term }}" were found
              </template>
              <label>Search Business</label>

            </md-autocomplete>
             </div>

          <!-- Pagination -->
          <ul class="pagination">
            <li v-bind:class="[{disabled: !state.pagination.prev}]">
              <a href="#" @click="fetchBusiness(state.pagination.prev)">Prev</a>
            </li>
            <li class="info">
                {{ state.meta.current_page }} of {{ state.meta.last_page }}
            </li>
            <li v-bind:class="[{disabled: !state.pagination.next}]">
              <a href="#" @click="fetchBusiness(state.pagination.next)">Next</a>
            </li>
            <li>
            </li>
          </ul>

          <p><strong>Total ({{ state.meta.total }})</strong></p>

          <business-card v-bind:businessList="state.businesses"></business-card>


            <!-- Pagination -->
          <ul class="pagination">
            <li v-bind:class="[{disabled: !state.pagination.prev}]">
              <a href="#" @click="fetchBusiness(state.pagination.prev)">Prev</a>
            </li>
            <li class="info">
                {{ state.meta.current_page }} of {{ state.meta.last_page }}
            </li>
            <li v-bind:class="[{disabled: !state.pagination.next}]">
              <a href="#" @click="fetchBusiness(state.pagination.next)">Next</a>
            </li>
            <li>
            </li>
          </ul>

        </div>
    </div>
</template>

<style lang="scss" scoped>
.md-autocomplete {
background: white;
  }
.md-input {
  border-bottom: 1px solid #d5d5d5;
}
.pagination {
  list-style: none;
  margin: 0;
  padding: 0;
  text-align: center;

  li {
    display: inline-block;
    border: 1px solid #d5d5d5;
    box-sizing: border-box;
    margin-left: -1px;

    a {
      padding: 0.5rem 0.75rem;
      text-decoration: none;
      position: relative;
      display: block;
      color: rgb(15, 25, 71);
    }
  }
  .disabled {
    background: rgb(155, 155, 155);
    pointer-events: none;
    cursor: default;
    text-decoration: none;

    a {
      color: #eee;
    }
  }
  .active {
    background: rgb(38, 105, 206);

    a {
      color: #eee;
    }
  }
  .info {
    display: inline-block;
    border: none !important;
  }
}
label {
  color: #a2a2a2;
}
</style>


<script>
import axios from 'axios';
import BusinessCard from './BusinessCard.vue';
export default {
  components: {
    'business-card': BusinessCard
  },
  data() {
    return {
      state: {
        businesses: [],
        businessTitle: '',
        categories: [],
        categoriesValue: null,
        pagination: {},
        meta: {}
      }
    };
  },

  created() {
    this.fetchBusiness();
  },

  methods: {
    /**
     * get all businesses with filters and search
     * @param {string} url - url endpoint
     * @param {object} params - object containing search parameters
     */
    fetchBusiness(url, params) {
      url = url || 'api/business';
      if (!params) params = {};

      // declare search params
      params.query = this.state.businessTitle;

      //This is bad. auth sould not be hardcoded into code
      const auth =
        'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjJmMjEzMDBlZmQxNDhkZTZmM2E4MjI4MGIwMGJiNjE5Nzk1ZjU0NWVlM2RjMGJjY2JhMTE5M2FjZjk0YmU5YzgwYTg2MjVmYjJmOWI2NTlhIn0.eyJhdWQiOiIyIiwianRpIjoiMmYyMTMwMGVmZDE0OGRlNmYzYTgyMjgwYjAwYmI2MTk3OTVmNTQ1ZWUzZGMwYmNjYmExMTkzYWNmOTRiZTljODBhODYyNWZiMmY5YjY1OWEiLCJpYXQiOjE1MzM1MTAxNTUsIm5iZiI6MTUzMzUxMDE1NSwiZXhwIjoxNTY1MDQ2MTU1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.GZIQyIZ_1wGzn6lPxjb8mdqbiCaosKkbUB7ksaeYXJGLwiuoejMGW9VjMfkKY2FOu8luCKCDd_nkSAvneuH8cgzpwJRMIUeG4ELiDfK8Ag18qcqL3OYntN8lW0nb7Rb7GZMoKorTUjIkZwiKigumkYrru0ZaSIi9IGh4Pv2pMmedTCxMi4eSp0tv-_dAGYAzg-erf5Rb7n7QKqxQsMOrUj_HQmCYVixCe45NkgfGfVn_nk11cNskRq60-SfF_XjDerM0x5SaYD2fWABX0ReR9YMvFd7ly_JdDrsGINPbPTKzXNTWrX8IxE8zEBN66pkDKBH9ZsRKC_7V4wm4XC0U3O1e-fbiVglP8YOX1EUfis15PigMsdCFmZMEnFKKyT-sYX1h3XL-8bDY99MzySXuNGi46Tz3wrSFXjqnn7lmJLwVuN0AmaxaFKRRP1rgqFSx1OLpJCPYOEcRYo7EU7w70FIstww5PJjxkMgolsgjzQi_30EgkqUsYNn0fuewCJCa7K-9O05xAOwwW57JWM-LJJGVdKqE3NfDRyD7Dmbo-8ZX3sGSchBQVOQIjbqKmarDZvPFOixTg0QQ0NvBVC_43C2ymHtaaRscv-3Eu4CHWeuj6ZMRfsYQKtYBozKuUhU8vwrzdyKqg1ie4wlGJpFLHss3hxk5nBDlsCqFzr5KSEk';

      // Get paginated results
      axios({
        method: 'GET',
        url,
        params,
        headers: {
          Accept: 'application/json',
          Authorization: auth
        }
      })
        .then(response => {
          this.state.businesses = response.data.data;
          this.state.pagination = response.data.links;
          this.state.meta = response.data.meta;
        })
        .catch(error => {
          console.log(error.response);
        });
    },
    getCategories() {
      const url ='api/categories';

      //This is bad. auth sould not be hardcoded into code
      const auth =
        'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjJmMjEzMDBlZmQxNDhkZTZmM2E4MjI4MGIwMGJiNjE5Nzk1ZjU0NWVlM2RjMGJjY2JhMTE5M2FjZjk0YmU5YzgwYTg2MjVmYjJmOWI2NTlhIn0.eyJhdWQiOiIyIiwianRpIjoiMmYyMTMwMGVmZDE0OGRlNmYzYTgyMjgwYjAwYmI2MTk3OTVmNTQ1ZWUzZGMwYmNjYmExMTkzYWNmOTRiZTljODBhODYyNWZiMmY5YjY1OWEiLCJpYXQiOjE1MzM1MTAxNTUsIm5iZiI6MTUzMzUxMDE1NSwiZXhwIjoxNTY1MDQ2MTU1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.GZIQyIZ_1wGzn6lPxjb8mdqbiCaosKkbUB7ksaeYXJGLwiuoejMGW9VjMfkKY2FOu8luCKCDd_nkSAvneuH8cgzpwJRMIUeG4ELiDfK8Ag18qcqL3OYntN8lW0nb7Rb7GZMoKorTUjIkZwiKigumkYrru0ZaSIi9IGh4Pv2pMmedTCxMi4eSp0tv-_dAGYAzg-erf5Rb7n7QKqxQsMOrUj_HQmCYVixCe45NkgfGfVn_nk11cNskRq60-SfF_XjDerM0x5SaYD2fWABX0ReR9YMvFd7ly_JdDrsGINPbPTKzXNTWrX8IxE8zEBN66pkDKBH9ZsRKC_7V4wm4XC0U3O1e-fbiVglP8YOX1EUfis15PigMsdCFmZMEnFKKyT-sYX1h3XL-8bDY99MzySXuNGi46Tz3wrSFXjqnn7lmJLwVuN0AmaxaFKRRP1rgqFSx1OLpJCPYOEcRYo7EU7w70FIstww5PJjxkMgolsgjzQi_30EgkqUsYNn0fuewCJCa7K-9O05xAOwwW57JWM-LJJGVdKqE3NfDRyD7Dmbo-8ZX3sGSchBQVOQIjbqKmarDZvPFOixTg0QQ0NvBVC_43C2ymHtaaRscv-3Eu4CHWeuj6ZMRfsYQKtYBozKuUhU8vwrzdyKqg1ie4wlGJpFLHss3hxk5nBDlsCqFzr5KSEk';

      // Get paginated results
      axios({
        method: 'GET',
        url,
        params: {
          perPage: 'all'
        },
        headers: {
          Accept: 'application/json',
          Authorization: auth
        }
      })
        .then(response => {
          const categories = response.data.data;
          this.state.categories = categories.map(item => item.name);
        })
        .catch(error => {
          console.log(error.response);
        });
    }
  }
};
</script>