<template>
    <div>
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

                        <md-card-expand-content>
                            <md-card-content v-html="business.description">
                                {{ business.description }}
                            </md-card-content>
                        </md-card-expand-content>
                    </md-card-expand>
                </md-card>
                <br>
            </div>
        </div>
    </div>
</template>


<script>
export default {
    props: ['businessList'],

    data() {
        return {

        }

    }
}
</script>

