<template>
    <div class="md-layout md-alignment-center">
        <div class="md-layout-item md-size-60">
          <h2>Search Tool </h2>
            <div v-for="business in businesses" v-bind:key="business.id">
              <div class="card-expansion">
                <md-card >
                    <md-card-header>
                        <div class="md-title">{{ business.title }}</div>
                    </md-card-header>

                    <md-card-expand>
                        <md-card-actions md-alignment="space-between">
                            <div>
                                <md-button>Action</md-button>
                            </div>

                            <md-card-expand-trigger>
                                <md-button>Learn more</md-button>
                            </md-card-expand-trigger>
                        </md-card-actions>

                        <md-card-expand-content>
                            <md-card-content>
                                {{ business.description }}
                            </md-card-content>
                        </md-card-expand-content>
                    </md-card-expand>
                </md-card>
                <br>
              </div>
            </div>
        </div>
    </div>
</template>

<script>
import axios from 'axios';
export default {
  data() {
    return {
      businesses: [],
      business: {
        id: '',
        title: '',
        description: ''
      },
      pagination: {}
    };
  },

  created() {
    this.fetchBusiness();
  },

  methods: {
    fetchBusiness() {
      const auth =
        'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiIsImp0aSI6IjJmMjEzMDBlZmQxNDhkZTZmM2E4MjI4MGIwMGJiNjE5Nzk1ZjU0NWVlM2RjMGJjY2JhMTE5M2FjZjk0YmU5YzgwYTg2MjVmYjJmOWI2NTlhIn0.eyJhdWQiOiIyIiwianRpIjoiMmYyMTMwMGVmZDE0OGRlNmYzYTgyMjgwYjAwYmI2MTk3OTVmNTQ1ZWUzZGMwYmNjYmExMTkzYWNmOTRiZTljODBhODYyNWZiMmY5YjY1OWEiLCJpYXQiOjE1MzM1MTAxNTUsIm5iZiI6MTUzMzUxMDE1NSwiZXhwIjoxNTY1MDQ2MTU1LCJzdWIiOiIxIiwic2NvcGVzIjpbXX0.GZIQyIZ_1wGzn6lPxjb8mdqbiCaosKkbUB7ksaeYXJGLwiuoejMGW9VjMfkKY2FOu8luCKCDd_nkSAvneuH8cgzpwJRMIUeG4ELiDfK8Ag18qcqL3OYntN8lW0nb7Rb7GZMoKorTUjIkZwiKigumkYrru0ZaSIi9IGh4Pv2pMmedTCxMi4eSp0tv-_dAGYAzg-erf5Rb7n7QKqxQsMOrUj_HQmCYVixCe45NkgfGfVn_nk11cNskRq60-SfF_XjDerM0x5SaYD2fWABX0ReR9YMvFd7ly_JdDrsGINPbPTKzXNTWrX8IxE8zEBN66pkDKBH9ZsRKC_7V4wm4XC0U3O1e-fbiVglP8YOX1EUfis15PigMsdCFmZMEnFKKyT-sYX1h3XL-8bDY99MzySXuNGi46Tz3wrSFXjqnn7lmJLwVuN0AmaxaFKRRP1rgqFSx1OLpJCPYOEcRYo7EU7w70FIstww5PJjxkMgolsgjzQi_30EgkqUsYNn0fuewCJCa7K-9O05xAOwwW57JWM-LJJGVdKqE3NfDRyD7Dmbo-8ZX3sGSchBQVOQIjbqKmarDZvPFOixTg0QQ0NvBVC_43C2ymHtaaRscv-3Eu4CHWeuj6ZMRfsYQKtYBozKuUhU8vwrzdyKqg1ie4wlGJpFLHss3hxk5nBDlsCqFzr5KSEk';
      axios({
        method: 'GET',
        url: 'api/business',
        headers: {
          Accept: 'application/json',
          Authorization: auth
        }
      })
        .then(response => {
          this.businesses = response.data.data;

        })
        .catch(error => {
          console.log(error.response.data);
        });
    }
  }
};
</script>