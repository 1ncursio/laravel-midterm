<template>
    <div class="p-4 flex justify-between p-4 rounded-md shadow-md bg-white">
        <Link :href="route('subjects.show', subject)">
            <b>{{ subject.name }}</b></Link
        >
        <div>{{ subject.credit }}</div>
        <p>{{ subject.description }}</p>
    </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";
import { defineComponent } from "@vue/runtime-core";

export default defineComponent({
    props: ["subject"],
    components: {
        Link,
    },
});
</script>
<style lang=""></style>
