<template>
    <div class="flex flex-col items-center py-4">
        <NewPost />
        <p v-if="loading">Posts loading ...</p>
        <Post v-else v-for="post in posts.data" :key="post.data.post_id" :post="post" />
    </div>
</template>

<script>
    import NewPost from "../components/NewPost";
    import Post from "../components/Post";
    export default {
        name: "NewsFeed",
        components: { Post, NewPost },
        data: () => {
            return {
                posts: [],
                loading: true
            }
        },
        mounted() {
            this.fetchPosts()
        },
        methods: {
            async fetchPosts(){
                try {
                    const res = await axios.get('/api/posts');
                    this.posts = res.data;
                    this.loading = false;
                } catch (e) {
                    console.log(e);
                    this.loading = false;
                }
            }
        }
    }
</script>
