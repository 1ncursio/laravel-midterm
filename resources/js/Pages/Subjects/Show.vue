<template>
    <app-layout>
        <div class="w-1/2 mx-auto flex flex-col gap-4">
            <div class="p-4 flex justify-between">
                <b>과목명</b>
                <div>학점</div>
                <p>과목 설명</p>
            </div>
            <hr />
            <subject-card :subject="subject" />
            <div>
                <small class="text-sm text-gray-700"
                    >등록일 : {{ relativeCreatedAt }}</small
                >
                <small class="text-sm text-gray-700"
                    >변경일 : {{ relativeUpdatedAt }}</small
                >
            </div>
            <div class="flex gap-4">
                <button
                    class="bg-indigo-500 rounded-md text-white p-2"
                    v-if="!isTakingClass($page.props.user.id)"
                    @click="takeClass"
                >
                    수강신청하기
                </button>
                <button
                    class="bg-indigo-500 rounded-md text-white p-2"
                    v-else
                    @click="cancelTakingClass"
                >
                    수강신청취소
                </button>
            </div>
            <div class="flex text-gray-700 gap-2">
                <Link :href="route('subjects.edit', subject)">수정</Link>
                <button @click="onDelete">삭제</button>
            </div>
        </div>
    </app-layout>
</template>
<script>
import { computed, defineComponent } from "@vue/runtime-core";
import AppLayout from "@/Layouts/AppLayout.vue";
import SubjectCard from "./SubjectCard.vue";
import { Link } from "@inertiajs/inertia-vue3";
import dayjs from "dayjs";
import relativeTime from "dayjs/plugin/relativeTime";
import "dayjs/locale/ko";
import { Inertia } from "@inertiajs/inertia";

dayjs.extend(relativeTime);
dayjs.locale("ko");

export default defineComponent({
    props: ["subject", "takers"],
    components: {
        AppLayout,
        SubjectCard,
        Link,
    },
    setup(props) {
        const relativeCreatedAt = computed(() =>
            dayjs(props.subject.created_at).fromNow()
        );
        const relativeUpdatedAt = computed(() =>
            dayjs(props.subject.updated_at).fromNow()
        );

        async function onDelete() {
            if (!confirm("정말 삭제하시겠습니까?")) return;

            try {
                await axios.delete(`/subjects/${props.subject.id}`);
                Inertia.get("/subjects");
            } catch (error) {
                alert("에러 발생");
                console.error(error);
            }
        }

        function isTakingClass(id) {
            return props.takers.some((v) => v.id === id);
        }

        console.log({ subjects: props.subject, takers: props.takers });

        async function takeClass() {
            if (!confirm("정말 수강신청 하시겠습니까?")) return;

            try {
                await axios.post(`/subjects/${props.subject.id}/user`);
                Inertia.reload({ only: ["subject"] });
            } catch (error) {
                console.error(error);
            }
        }

        async function cancelTakingClass() {
            if (!confirm("정말 수강취소 하시겠습니까?")) return;

            try {
                await axios.delete(`/subjects/${props.subject.id}/user`);
                Inertia.reload({ only: ["subject"] });
            } catch (error) {
                console.error(error);
            }
        }
        return {
            onDelete,
            relativeCreatedAt,
            relativeUpdatedAt,
            isTakingClass,
            takeClass,
            cancelTakingClass,
        };
    },
});
</script>
<style lang=""></style>
