<template>
    <div id="comments">
        <div class="card-footer py-3 border-0" style="background-color: #f8f9fa;">
            <div class="d-flex flex-start w-100">
                <img class="rounded-circle shadow-1-strong me-3"
                     src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="40"
                     height="40" />
                <div class="form-outline w-100">
                                        <textarea class="form-control" id="textAreaExample" rows="2"
                                                  style="background: #fff;"></textarea>
                    <label class="form-label" for="textAreaExample">Message</label>
                </div>
            </div>
            <div class="float-end mt-2 pt-1">
                <button type="button" class="btn btn-primary btn-sm">Post comment</button>
                <button type="button" class="btn btn-outline-primary btn-sm">Cancel</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CommentsComponent",
    props: ['post_id'],
    data(){
        return {
            comments: [],
        }
    },
    methods: {
        getComments(){
            axios
                .get(
                    `/api/comments/list`,
                    {
                        params: {
                            post_id: this.post_id
                        },
                    }
                )
                .then((response) => {
                    console.log("comments: ", this.comments);
                });
        }
    },
    watch: {

    },
    computed: {

    },
    created() {
        console.log('post_id: ', this.post_id);
        this.getComments();
    },
    mounted() {
    }
}
</script>

<style scoped>

</style>
