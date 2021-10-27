<template>
    <app-layout>
        <div class="w-1/2 mx-auto flex flex-col gap-4">
            <div class="p-4 flex justify-between">
                <b>과목명</b>
                <div>학점</div>
                <p>과목 설명</p>
            </div>
            <hr />
            <subject-card
                :subject="subject"
                v-for="(subject, i) in subjects.data"
                :key="i"
            />
        </div>
        <pagination class="mt-6" :links="subjects.links" />
    </app-layout>
</template>
<script>
import { defineComponent } from "@vue/runtime-core";
import AppLayout from "@/Layouts/AppLayout.vue";
import SubjectCard from "./SubjectCard.vue";
import Pagination from "@/Components/Pagination.vue";

export default defineComponent({
    props: ["subjects"],
    components: {
        AppLayout,
        SubjectCard,
        Pagination,
    },
    setup(props) {
        console.log({ subjects: props.subjects });
    },
});
</script>
<style lang=""></style>
