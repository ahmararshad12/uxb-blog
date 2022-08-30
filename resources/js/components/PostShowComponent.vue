<template>
    <div id="post-show-component">
        <section>
            <div class="container my-2 py-2">
                <div class="row d-flex justify-content-center">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex flex-start align-items-center">
                                    <img class="rounded-circle shadow-1-strong me-3"
                                         src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="60"
                                         height="60" />
                                    <div>
                                        <h6 class="fw-bold text-primary mb-1">{{ current_post.user.name }}</h6>
                                        <p class="text-muted small mb-0">
                                            Shared publicly - {{ current_post.created_at }}
                                        </p>
                                    </div>
                                </div>

                                <p class="mt-3 mb-4 pb-2">
                                    {{ current_post.description }}
                                </p>
                            </div>
                            <comments-component :post_id="current_post.id" :sender="JSON.parse(current_user)"></comments-component>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</template>

<script>
import CommentsComponent from "./CommentsComponent.vue";
export default {
    name: "PostShowComponent",
    components: { CommentsComponent },
    props: ['post', 'canUpdate', 'current_user'],
    data(){
        return {
            current_post: null
        }
    },
    methods: {

    },
    watch: {

    },
    computed: {

    },
    created() {
        this.current_post = JSON.parse(this.post);
    },
    mounted() {

    }
}
</script>

<style scoped>

</style>
