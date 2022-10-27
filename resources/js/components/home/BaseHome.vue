<template>
  <div>

    <form v-on:submit.prevent="onSubmit" class="knd-form-x">
        <div class="knd-form-field-x">
            <h3>Upload your post</h3>
            <label for="">Content</label>
            <textarea name="content" id="content" rows="5" cols="30" class="textarea has-fix-size" v-model="content"></textarea>
        </div>
        <div class="knd-form-field">
            <div class="knd-form-field-group">
                <vs-button>
                    Update
                </vs-button>
                <vs-button>
                    Close
                </vs-button>
            </div>
            <vs-button class="knd-form-button">
                Posting
            </vs-button>
        </div>
    </form>
    <div class="knd-card-container">
        <div v-for="post in fetchPost" :key="post.id">

            <div class="knd-card-header">

           <vs-card>
                <template #title>
                <h3>Post:{{post.id}}</h3>
                </template>
                <template #text>
                <p>
                    {{post.content}}
                </p>
                </template>
                <template #interactions>
                </template>
            </vs-card>
                <vs-button >
                    <i class='bx bx-edit'></i>
                </vs-button>
                <vs-button color="danger" v-on:click="handleClickDelete(post.id)">
                    <i class='bx bxs-trash' ></i>
                </vs-button>
            </div>
        </div>
                <template>
                    <div class="center">
                    <vs-pagination v-model="page" :length="20" />
                    </div>
                 </template>
    </div>

  </div>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {

    data:() => ({
        page: 1,
        id: 0,
        content: '',

    }),

    computed: mapGetters(['fetchPost']),

    methods: {

        ...mapActions(['createPost', 'fetchData','deletePost', 'updatePost']),

        onSubmit() {
            let data;
            if(this.id){

                data ={
                    content: this.content,
                }
            }else{

                data = {
                    id: this.id,
                    content: this.content,
                }
                    this.updatePost(data).then((result) => {
                        this.$$store.commit('UPDATE_POST', res.data.result)
                        this.$vs.notification({
                            flat: true,
                            color:'success',
                            position:'top-center',
                            title: 'Delete Successful',
                            text: res.data.message,
                        })
                        this.content = '';
                    }).catch((err) => {

                    });
            }


            this.createPost(data).then((res) => {
                this.$store.commit('CREATE_POST', res.data.result)
                this.$vs.notification({
                    flat: true,
                    color:'success',
                    position:'top-center',
                    title: 'Post Successful',
                    text: res.data.message,
                })
            }).catch((err) => {

            });
        },

        handleClickDelete(pk){
            this.deletePost(pk).then((res) => {
                this.$store.commit('DELETE_POST',pk)
                this.$vs.notification({
                    flat: true,
                    color:'success',
                    position:'top-center',
                    title: 'Delete Successful',
                    text: res.data.message,
                })
            }).catch((err) => {

            });
        },

        handleClickUpdate(pk, content){
            this.id = pk
            this.content = content

        },

        onUpdate(){


        }
    },
    mounted() {
        this.fetchData();
    },
}
</script>

<style>
    .knd-card-container{
        width: 50%;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .knd-card{
        padding: 1.25rem;
        box-shadow: 0 1px 2px 0 rgba(60,64, 67,0, 302), 0 1px 3px 1px rgba(60,64, 67,0, 149);
        border-radius: 10px ;
        margin-bottom: 1.25rem;
    }

    .knd-card-header{
        display: flex;
        align-items: center;
    }

    .knd-push{
        flex: 1 1 0%;
    }

    .knd-form-x{
        width: 50%;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }

    .knd-form-button{
        width: 160px;
    }

    .textarea{
       width: 57rem;
    }
    .vs-card__text{
        width: 57rem;
    }
</style>
