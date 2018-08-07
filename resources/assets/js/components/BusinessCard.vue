<template>
  <div>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <div v-for="business in businessList" v-bind:key="business.id">
      <div class="card-expansion">
        <md-card >
          <md-card-header>
              <div class="md-title">{{ business.title }}</div>
          </md-card-header>

          <md-card-expand>
            <md-card-actions md-alignment="space-between">
                <md-card-expand-trigger>
                    <md-button>More Info</md-button>
                </md-card-expand-trigger>
            </md-card-actions>

            <!-- Expanded content -->
            <md-card-expand-content>
              <md-card-content >
                <md-card-area md-inset v-html="business.description">
                    {{ business.description }}
                </md-card-area>

                <p></p>
                <hr>

                <!-- social links -->
                <md-card-area md-inset>
                  <div class="md-layout md-gutter">

                    <div class="md-layout-item" v-if="business.website">
                      <md-button
                        :href="'http://' + business.website"
                        class="md-primary"
                      >
                        <md-icon class="fa fa-globe"></md-icon>
                        website
                      </md-button>
                    </div>

                    <div class="md-layout-item"  v-if="business.facebook">
                      <md-button
                        class="md-primary"
                        :href="business.facebook"
                      >
                        <md-icon class="fa fa-facebook-square"></md-icon>
                      </md-button>
                    </div>

                    <div class="md-layout-item" v-if="business.twitter">
                      <md-button
                      class="md-primary"
                      :href="business.twitter"
                      >
                        <md-icon class="fa fa-twitter-square"></md-icon>
                      </md-button>
                    </div>

                    <div class="md-layout-item" v-if="business.youtube">
                      <md-button
                        class="md-primary"
                        :href="business.youtube">
                        <md-icon class="fa fa-youtube"></md-icon>
                      </md-button>
                    </div>

                  </div>

                </md-card-area>
                <p></p>
                <hr>

                <!-- Map and Contact -->
                <md-card-area>
                  <div class="md-layout md-gutter">
                    <div class="md-layout-item md-size-60">
                      Map here
                    </div>

                    <!-- More info -->
                    <div class="md-layout-item md-size-40">
                      <div>
                        <h3  v-if="business.email || business.telephone">Contact Us</h3>
                        <p v-if="business.email">
                          <strong>Email: </strong>
                          {{ business.email }}
                        </p>
                        <p v-if="business.telephone">
                          <strong>Tel:</strong>
                          {{ business.telephone}}</p>
                      </div>

                      <div v-if="business.monday">
                        <h3>Opening Hours</h3>

                        <p class="opening">
                          <strong>Monday:</strong>
                          {{ business.monday}}
                        </p>

                        <p class="opening">
                          <strong>Tuesday:</strong>
                          {{ business.tuesday}}
                        </p>

                        <p class="opening">
                          <strong>Wednesday:</strong>
                          {{ business.wednesday}}
                        </p>

                        <p class="opening">
                          <strong>Thursday:</strong>
                          {{ business.thursday}}
                        </p>

                        <p class="opening">
                          <strong>Friday:</strong>
                          {{ business.friday}}
                        </p>

                        <p class="opening">
                          <strong>Saturday:</strong>
                          {{ business.saturday}}
                        </p>

                        <p class="opening">
                          <strong>Sunday:</strong>
                          {{ business.sunday}}
                        </p>

                        <p class="opening">
                          <strong>Bank Holidays:</strong>
                          {{ business.bank_holiday}}
                        </p>

                        <p class="opening">
                          <strong>Monday:</strong>
                          {{ business.monday}}
                        </p>

                      </div>
                    </div>

                  </div>
                </md-card-area>

              </md-card-content>

            </md-card-expand-content>

          </md-card-expand>
        </md-card>
        <br>
      </div>
    </div>
  </div>
</template>

<style lang="scss" scoped>
.opening {
  font-size: 10px;
}
</style>


<script>
export default {
  props: ['businessList'],

  data() {
    return {
      state: {
        markers: [
          {
            position: {
              lat: Number(51.507351),
              long: Number(-0.127758)
            }
          }
        ],
        googlePosition: {
          lat: 51.507351,
          long: -0.127758
        }
      }
    };
  }
};
</script>

