<template>
    <header>
        <div class="container mx-auto flex gap-x-4 my-5">
            <localized-link :to="{name:'home'}">{{$t('nav.home')}}</localized-link>
            <localized-link :to="{name:'posts'}">{{$t('nav.posts')}}</localized-link>
            <language-switcher
                v-slot="{ links }"
                active-class=""
            >
                <div class="py-2 pl-3 md:p-0">
                    <div class="relative group  flex  lg:block">
                        <div class="" v-for="link in links" :key="link.langIndex">
                            <router-link class="inline-block mr-5" v-if="link.activeClass" :to="link.url">
                                {{ link.langName }}
                            </router-link>
                        </div>
                        <div class="lg:absolute lg:hidden inset-x-0 lg:group-hover:block lg:w-full lg:pt-6 ">
                            <div v-for="link in links" :key="link.langIndex">
                                <router-link class=" inline-block w-full" v-if="!link.activeClass" :to="link.url">
                                    {{ link.langName }}
                                </router-link>
                            </div>
                        </div>
                    </div>
                </div>
            </language-switcher>
        </div>
    </header>
</template>

<script>
export default {
    name: "Header"
}
</script>

<style scoped>

</style>
