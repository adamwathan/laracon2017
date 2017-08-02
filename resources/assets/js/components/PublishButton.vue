<template>
    <transition mode="out-in">
        <button v-if="podcast.published" type="button" class="btn btn-sm" :class="{'btn-primary': !hovering && !working, 'btn-danger': hovering && !working, 'btn-loading btn-secondary': working}" key="published" @mouseenter="hovering = true" @mouseleave="hovering = false" @click="unpublish" :disabled="working">
            {{ publishedText }}
        </button>
        <button v-if="!podcast.published" type="button" class="btn btn-sm btn-secondary" :class="{'btn-loading': working}"key="unpublished" @click="publish" :disabled="working">
            Publish
        </button>
    </transition>
</template>

<script>
export default {
    props: ['dataPodcast'],
    data() {
        return {
            hovering: false,
            podcast: this.dataPodcast,
            working: false,
        }
    },
    computed: {
        publishedText() {
            return this.hovering ? 'Unpublish' : 'Published'
        }
    },
    methods: {
        publish() {
            this.working = true

            axios.post('/published-podcasts', { podcast_id: this.podcast.id })
                .takeAtLeast(300)
                .then(response => {
                    this.podcast = response.data
                    this.working = false
                    this.hovering = false
                })
        },
        unpublish() {
            this.working = true

            axios.delete(`/published-podcasts/${this.podcast.id}`)
                .takeAtLeast(300)
                .then(response => {
                    this.podcast = response.data
                    this.working = false
                    this.hovering = false
                })
        },
    }
}
</script>
