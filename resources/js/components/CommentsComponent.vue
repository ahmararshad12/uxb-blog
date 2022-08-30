<template>
    <div id="comments">
        <div class="card-footer py-3 border-0" style="background-color: #eee;">
            <h3>Comments</h3>
            <div class="row d-flex justify-content-center mt-3" v-for="(comment, index) in comments" :key="index">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-1">
                                    <img class="rounded-circle shadow-1-strong me-3"
                                         src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="40"
                                         height="40" />
                                </div>
                                <div class="col-md-11">
                                    <a href="#" class="m-0 p-0">{{ comment.sender }}</a>
                                    <p class="p-0 m-0">{{ comment.comment }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-start mt-3 w-100">
                <img class="rounded-circle shadow-1-strong me-3"
                     src="https://mdbcdn.b-cdn.net/img/Photos/Avatars/img%20(19).webp" alt="avatar" width="40"
                     height="40" />
                <div class="form-outline w-100">
                    <label class="form-label" for="textAreaExample">Comment</label>
                    <textarea v-model="new_comment" class="form-control" id="textAreaExample" rows="2" style="background: #fff;"></textarea>
                </div>
            </div>
            <div class="float-end mt-2 mb-2 pt-1">
                <button type="button" class="btn btn-primary btn-sm" @click="addNewComment" :disabled="!new_comment">Post comment</button>
                <button type="button" class="btn btn-outline-primary btn-sm" @click="resetCommentForm">Cancel</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "CommentsComponent",
    props: ['post_id', 'sender'],
    data(){
        return {
            comments: [],
            sender_id: null,
            new_comment: null,
        }
    },
    methods: {
        resetCommentForm(){
            this.sender_id = null;
            this.new_comment = null;
        },
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
                    this.comments = response.data.data
                });
        },
        addNewComment(){
            axios
                .post(`/api/comments/create`, {
                    comment: this.new_comment,
                    sender_id: this.sender.id,
                    post_id: this.post_id
                })
                .then((res) => {
                    this.comments.push(res.data.data);
                })
                .catch((err) => console.log('error'));

            this.resetCommentForm();
        }
    },
    watch: {

    },
    computed: {

    },
    created() {
        this.getComments();
    },
    mounted() {
    }
}
</script>

<style scoped>

</style>
