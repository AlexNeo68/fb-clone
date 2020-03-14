<template>
    <div class="flex flex-col items-center">
        <div class="relative mb-8 z-10">
            <div class="w-100 h-64 overflow-hidden">
                <img src="https://images.unsplash.com/photo-1583934555852-537536e49071?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2119&q=80" alt="User profile photo" class="object-cover w-full">
            </div>
            <div class="absolute flex items-center bottom-0 left-0 -mb-8 ml-12 z-20">
                <div class="w-32">
                    <img src="https://images.unsplash.com/photo-1583934555852-537536e49071?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=2119&q=80" alt="User profile photo" class="object-cover w-32 h-32 border-4 border-gray-200 rounded-full shadow-lg">
                </div>

                <p class="text-2xl text-gray-100 ml-4">{{ user.data.attributes.name }}</p>
            </div>
        </div>
        <p v-if="loadingPosts||!posts">Posts loading ...</p>
        <p v-else-if="posts.data.length<1">No posts get starting ...</p>
        <Post v-else v-for="post in posts.data" :post="post" :key="post.post_id"/>
    </div>
</template>

<script>
    import Post from "../../components/Post";
    export default {
        name: "Show",
        components: {Post},
        data: () => ({
            user: null,
            posts: null,
            loadingUser: false,
            loadingPosts: false,
        }),
        mounted(){
            this.fetchUser();
            this.fetchPosts();
        },
        methods: {
            async fetchUser(){
                try {
                    const res = await axios.get(`/api/users/${this.$route.params.userId}`);
                    this.user = res.data;
                    this.loadingUser = false;
                } catch(e){
                    console.log(e.response);
                    this.loadingUser = false;
                }
            },
            async fetchPosts(){
                try {
                    const res = await axios.get(`/api/users/${this.$route.params.userId}/posts`);
                    this.posts = res.data;
                    this.loadingPosts = false;
                } catch(e){
                    console.log(e.response);
                    this.loadingPosts = false;
                }
            }
        }
    }
</script>
