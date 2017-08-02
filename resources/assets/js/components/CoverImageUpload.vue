<template>
    <form :action="action" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="_token" :value="csrfToken">
        <input type="hidden" name="_method" value="PUT">
        <div class="row pull-x-4">
            <div class="col-4 px-4">
                <img :src="previewSrc" class="img-fit">
            </div>
            <div class="col-8 px-4 flex-y-end">
                <div class="flex-fill">
                    <div class="mb-8 flex-center">
                        <input name="cover_image" type="file" class="form-control-file" @change="updateImagePreview">
                    </div>
                    <div class="text-right">
                        <button class="btn btn-sm btn-primary" :disabled="newImage === null">Save Image</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</template>

<script>
export default {
    props: ['podcast'],
    data() {
        return {
            newImage: null,
        }
    },
    computed: {
        csrfToken() {
            return document.head.querySelector('meta[name="csrf-token"]').content
        },
        action() {
            return this.podcast.links.update_cover_image
        },
        previewSrc() {
            return this.newImage ? this.newImage : this.podcast.cover_url
        },
    },
    methods: {
        updateImagePreview(e) {
            const files = e.target.files

            if (files.length === 0) {
                this.newImage = null
                return
            }

            const reader = new FileReader()

            reader.onload = (e) => {
                this.newImage = e.target.result
            }

            reader.readAsDataURL(files[0])
        }
    }
}
</script>
