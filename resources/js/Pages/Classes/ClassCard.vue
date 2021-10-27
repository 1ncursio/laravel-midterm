<template>
    <div class="p-4 flex justify-between p-4 rounded-md shadow-md bg-white">
        <Link :href="route('subjects.show', subject)">
            <b>{{ subject.name }}</b></Link
        >
        <div>{{ subject.credit }}</div>
        <p>{{ subject.description }}</p>
        <button
            class="w-8 h-8 bg-indigo-500 rounded-full text-white"
            @click="onClickUsers"
        >
            {{ subject.users.length }}
        </button>
    </div>
    <div v-if="isOpenUsers">
        <div
            v-for="(user, index) in subject.users"
            :key="index"
            class="flex gap-2 p-4 items-center"
        >
            <img
                class="w-12 h-12 rounded-full object-cover mr-4 shadow"
                :src="user.profile_photo_url"
                alt="avatar"
            />
            <div class="font-bold">
                {{ user.name }}
            </div>
            <div>
                {{ user.email }}
            </div>
        </div>
    </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";
import { defineComponent, ref } from "@vue/runtime-core";

export default defineComponent({
    props: ["subject"],
    components: {
        Link,
    },

    setup(props) {
        const isOpenUsers = ref(false);

        function onClickUsers() {
            isOpenUsers.value = !isOpenUsers.value;
        }

        return { isOpenUsers, onClickUsers };
    },
});
</script>
<style lang=""></style>
