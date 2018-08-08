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
      const auth =
        'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImVhYTU5N2ViZjg0YzY2YjgzY2JjZjcxNDViYTQ0YWNmOGIyYmQwYmQzOTA3ZDY2MjAxMzYxMWE2MWJhYjk1MDk3ZmNmNDUxODllOTI1ODFhIn0.eyJhdWQiOiIyIiwianRpIjoiZWFhNTk3ZWJmODRjNjZiODNjYmNmNzE0NWJhNDRhY2Y4YjJiZDBiZDM5MDdkNjYyMDEzNjExYTYxYmFiOTUwOTdmY2Y0NTE4OWU5MjU4MWEiLCJpYXQiOjE1MzM2OTM4NjYsIm5iZiI6MTUzMzY5Mzg2NiwiZXhwIjoxNTY1MjI5ODY2LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Fc6OQhmyYl4Vpg1oP2EPyFy0NGwRntic4KV7ltdEJd6-uG5Tk_1j-oNg83SWNDbCwd4V1-tMGFmbnzVkOY9m_oiXw132qt4ilnCI99fHRexYFDlffY9utix5O2KKbQS5LHfNjFATplKJ5jEDc1yqWcJfqdx5hTwb45F1U8KvME066PZzLoNfK3ww7gcrbwfStIl5ACC_0r0WPuq6RRogrMGy1xw0NB6dft58MmaNQLjsec7mlGr5fMlp79EfuP_Xc3bqUI-S3eKmYvCB4_Z91_fNR0FxUCQOsZf3lnicGqoKAzWwWul7xaqIi3ANYjXrJr065PegzJAIBB2FpQkNiu9nYnmceFHl2tn2FTSDs7lNk7HQKBOAjle1h8gSvpTi2fsYAyB6GVl_7u6Ro7MIPXkTNCcUY1EOCXDSYHlGhP2bNewKATxKccEQJ0qjTN4gXC60Si9YGd6fMeLeYxWlVG0S-lwTM2djruiAq98m4CirbOoOk1vSiXDxEAnIgot2IhfpRIkBVFeDnPvQjSq6i3bBNpqz9X9cNJFzJyzXGT8DAKj3c05t7c1TUxeuPEMiJ1YcCtoo_Q6u26NolS7jg9tpomtAqu3sJocw4zMDSjjO7eh_Fqr6eRrkqTpEMhssmzkxeSQiTbGaXX5pprLF3wq7Ca61nLpD8XUNtrw_1FY';

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
        'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6ImVhYTU5N2ViZjg0YzY2YjgzY2JjZjcxNDViYTQ0YWNmOGIyYmQwYmQzOTA3ZDY2MjAxMzYxMWE2MWJhYjk1MDk3ZmNmNDUxODllOTI1ODFhIn0.eyJhdWQiOiIyIiwianRpIjoiZWFhNTk3ZWJmODRjNjZiODNjYmNmNzE0NWJhNDRhY2Y4YjJiZDBiZDM5MDdkNjYyMDEzNjExYTYxYmFiOTUwOTdmY2Y0NTE4OWU5MjU4MWEiLCJpYXQiOjE1MzM2OTM4NjYsIm5iZiI6MTUzMzY5Mzg2NiwiZXhwIjoxNTY1MjI5ODY2LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.Fc6OQhmyYl4Vpg1oP2EPyFy0NGwRntic4KV7ltdEJd6-uG5Tk_1j-oNg83SWNDbCwd4V1-tMGFmbnzVkOY9m_oiXw132qt4ilnCI99fHRexYFDlffY9utix5O2KKbQS5LHfNjFATplKJ5jEDc1yqWcJfqdx5hTwb45F1U8KvME066PZzLoNfK3ww7gcrbwfStIl5ACC_0r0WPuq6RRogrMGy1xw0NB6dft58MmaNQLjsec7mlGr5fMlp79EfuP_Xc3bqUI-S3eKmYvCB4_Z91_fNR0FxUCQOsZf3lnicGqoKAzWwWul7xaqIi3ANYjXrJr065PegzJAIBB2FpQkNiu9nYnmceFHl2tn2FTSDs7lNk7HQKBOAjle1h8gSvpTi2fsYAyB6GVl_7u6Ro7MIPXkTNCcUY1EOCXDSYHlGhP2bNewKATxKccEQJ0qjTN4gXC60Si9YGd6fMeLeYxWlVG0S-lwTM2djruiAq98m4CirbOoOk1vSiXDxEAnIgot2IhfpRIkBVFeDnPvQjSq6i3bBNpqz9X9cNJFzJyzXGT8DAKj3c05t7c1TUxeuPEMiJ1YcCtoo_Q6u26NolS7jg9tpomtAqu3sJocw4zMDSjjO7eh_Fqr6eRrkqTpEMhssmzkxeSQiTbGaXX5pprLF3wq7Ca61nLpD8XUNtrw_1FY';

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