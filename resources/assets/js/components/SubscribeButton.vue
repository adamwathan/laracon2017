<template>
    <transition mode="out-in">
        <button v-if="subscribed" type="button" class="btn btn-sm" :class="{'btn-primary': !hovering && !working, 'btn-danger': hovering && !working, 'btn-loading btn-secondary': working}" key="subscribed" @mouseenter="hovering = true" @mouseleave="hovering = false" @click="unsubscribe" :disabled="working">
            {{ subscribedText }}
        </button>
        <button v-if="!subscribed" type="button" class="btn btn-sm btn-secondary" :class="{'btn-loading': working}"key="unsubscribed" @click="subscribe" :disabled="working">
            Subscribe
        </button>
    </transition>
</template>

<script>
    export default {
        props: ['dataSubscription', 'podcast'],
        data() {
            return {
                hovering: false,
                subscription: this.dataSubscription,
                working: false,
            }
        },
        computed: {
            subscribed() {
                return this.subscription !== null
            },
            subscribedText() {
                return this.hovering ? 'Unsubscribe' : 'Subscribed'
            }
        },
        methods: {
            subscribe() {
                this.working = true

                axios.post('/subscriptions', {
                        podcast_id: this.podcast.id
                    })
                    .takeAtLeast(300)
                    .then(response => {
                        this.subscription = response.data
                        this.working = false
                        this.hovering = false
                    })
            },
            unsubscribe() {
                this.working = true

                axios.delete(`/subscriptions/${this.subscription.id}`)
                    .takeAtLeast(300)
                    .then(response => {
                        this.subscription = null
                        this.working = false
                        this.hovering = false
                    })
            },
        }
    }
</script>
