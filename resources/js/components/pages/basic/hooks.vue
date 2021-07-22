<template>
    <div>
        <h2 ref="myref">Hook tutorial</h2>
        <p>My name is: {{ name }}</p>
    </div>
</template>

<script>
export default {
    data() {
        return {
            name: 'Thao abc'
        }
    },

    beforeCreate() {
        console.log('beforeCreate', this.name);
    },

    created() {
        // call mostly initial data from it...
        console.log('created', this.$refs.myref);
    },

    mounted() {
        console.log('mounted', this.$refs.myref);
    }
}
</script>
