<template>
    <app-layout>
        <div class="w-1/2 mx-auto flex flex-col gap-4">
            <div class="p-4 flex justify-between">
                <b></b>
                <div>총 수강학점 : {{ creditSum }}</div>
                <p>과목수 {{ length }}</p>
            </div>
            <div class="p-4 flex justify-between">
                <b>과목명</b>
                <div>학점</div>
                <p>과목 설명</p>
                <p>수강자 수</p>
            </div>
            <hr />
            <class-card
                :subject="subject"
                v-for="(subject, i) in subjects.data"
                :key="i"
            />
        </div>
        <pagination class="mt-6" :links="subjects.links" />
    </app-layout>
</template>
<script>
import { computed, defineComponent, ref } from "@vue/runtime-core";
import AppLayout from "@/Layouts/AppLayout.vue";
import ClassCard from "./ClassCard.vue";
import Pagination from "@/Components/Pagination.vue";

export default defineComponent({
    props: ["subjects", "length"],
    components: {
        AppLayout,
        ClassCard,
        Pagination,
    },
    setup(props) {
        const creditSum = computed(() =>
            props.subjects.data.map((v) => v.credit).reduce((a, c) => a + c, 0)
        );

        console.log({ subjects: props.subjects.data });

        console.log({ creditSum });
        return { creditSum };
    },
});
</script>
<style lang=""></style>
