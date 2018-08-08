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

            <!--
              commenting out, restricted with time to research scout and eager loading
              and relationships
              categories
            <div class="autocomplete">

            <md-autocomplete
              @md-changed="getCategories"
              @md-opened="getCategories"
              v-model="state.categoriesValue"
              :md-options="state.categories"
              md-term
              :md-open-on-focus="false">
              <template slot="md-autocomplete-empty" slot-scope="{ term }">
                No Categories matching "{{ term }}" were found
              </template>
              <label>Pick category</label>

            </md-autocomplete>
             </div>  -->

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
// Temp hack just because of autcomplete
.autocomplete {
  margin-bottom: 200px;
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
        categoriesDetails: [],
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
    fetchBusiness(url) {
      url = url || 'api/business';
      const params = {};

      // declare search params
      params.query = this.state.businessTitle;

      //This is bad. auth sould not be hardcoded into code
      const auth ='Bearer ' + env('TOKEN');

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
    const auth ='Bearer ' + env('TOKEN');

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
          this.state.categoriesDetails = response.data.data;
          this.state.categories = this.state.categoriesDetails.map(item => item.name);
        })
        .catch(error => {
          console.log(error.response);
        });
    }
  }
};
</script>