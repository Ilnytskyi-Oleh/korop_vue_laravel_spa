<template>
    <div class="flex flex-col h-screen">
        <header>
            <div class="container mx-auto flex gap-x-4 my-5">
                  <localized-link :to="{name:'home'}">Home</localized-link>
                  <localized-link :to="{name:'posts'}">Posts</localized-link>
            </div>
        </header>
        <main class="grow ">
            <router-view class="container mx-auto "></router-view>
        </main>
        <footer>
            <div class="container mx-auto">
                footer
            </div>

        </footer>
    </div>
</template>

<script>
export default {
    name: "Index"
}
</script>

<style scoped>
</style>
