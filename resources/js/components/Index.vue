<template>
    <div>
        <div >
            <div class="container mx-auto flex gap-x-4 my-5">
                  <localized-link :to="{name:'home'}">Home</localized-link>
                  <localized-link :to="{name:'posts'}">Posts</localized-link>
            </div>
        </div>

        <router-view></router-view>
    </div>
</template>

<script>
export default {
    name: "Index"
}
</script>

<style scoped>
</style>
