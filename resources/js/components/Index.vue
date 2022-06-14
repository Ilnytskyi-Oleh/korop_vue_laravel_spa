<template>
    <div class="flex flex-col h-screen relative">
        <Header />
        <main class="grow ">
            <router-view class="container mx-auto "></router-view>
        </main>
        <Footer />
    </div>
</template>

<script>
import Header from "./Header.vue";
import Footer from "./Footer.vue";
export default {
    name: "Index",
    components: {
        Header, Footer
    },


}
</script>

<style scoped>
</style>
