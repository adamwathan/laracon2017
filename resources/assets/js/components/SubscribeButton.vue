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
        props: ['subscribeUrl', 'unsubscribeUrl', 'dataSubscribed'],
        data() {
            return {
                hovering: false,
                subscribed: this.dataSubscribed,
                working: false,
            }
        },
        computed: {
            subscribedText() {
                return this.hovering ? 'Unsubscribe' : 'Subscribed'
            }
        },
        methods: {
            subscribe() {
                this.working = true

                axios.post(this.subscribeUrl)
                    .takeAtLeast(300)
                    .then(response => {
                        this.subscribed = true
                        this.working = false
                        this.hovering = false
                    })
            },
            unsubscribe() {
                this.working = true

                axios.post(this.unsubscribeUrl)
                    .takeAtLeast(300)
                    .then(response => {
                        this.subscribed = false
                        this.working = false
                        this.hovering = false
                    })
            },
        }
    }
</script>
