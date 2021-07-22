<template>
    <div>
        <h2>the number is: {{ counter }}</h2>
        <button @click="updateCounter(1)">Increase</button>
        <button @click="updateCounter(-1)">Decrease</button>
        <br><br><br>
        <div v-for="(blog, i) in blogs" :key="i">
            <h3>{{ blog.title }}</h3>
            <p>{{ blog.post }}</p>
        </div>
        <br><br><br>
        <div>
            <h3 v-if="showItem">Show this item if "showItem" is true</h3>
            <h3 v-else>Show this item if "showItem" is false</h3>
        </div>

        <button @click="showItem = !showItem">Change showItem</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            views: 0,
            blogs: [],
            showItem: false
        }
    },

    methods: {
        updateCounter(number) {
            this.counter += number;
        },
    },

    created() {
        // Call the server to get views of this blog post...
        this.counter = 100;
        let posts = [
                {title: 'this is blog title 1', 'post': 'this is the blog post 1', id: 1},
                {title: 'this is blog title 2', 'post': 'this is the blog post 2', id: 2},
                {title: 'this is blog title 3', 'post': 'this is the blog post 3', id: 3},
                {title: 'this is blog title 4', 'post': 'this is the blog post 4', id: 4}
            ];
        this.blogs = posts;
    }
}
</script>
